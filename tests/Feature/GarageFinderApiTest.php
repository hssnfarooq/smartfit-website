<?php

namespace Tests\Feature;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GarageFinderApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_autocomplete_returns_normalized_bounded_postcode_suggestions(): void
    {
        Http::fake([
            'api.postcodes.io/*' => Http::response([
                'status' => 200,
                'result' => ['pe1 3sa', 'PE1 3QQ'],
            ]),
        ]);

        $response = $this->getJson('/garage-finder/postcodes?query=pe1+3');

        $response->assertOk()->assertExactJson([
            'suggestions' => ['PE1 3SA', 'PE1 3QQ'],
        ]);
    }

    public function test_autocomplete_uses_the_cached_result_on_a_repeated_query(): void
    {
        Http::fakeSequence()
            ->push(['status' => 200, 'result' => ['PE1 3SA']], 200)
            ->pushStatus(500);

        $this->getJson('/garage-finder/postcodes?query=PE1+3')->assertOk();
        $this->getJson('/garage-finder/postcodes?query=pe1+3')
            ->assertOk()
            ->assertJsonPath('suggestions.0', 'PE1 3SA');
    }

    public function test_invalid_postcode_is_rejected_without_calling_the_external_service(): void
    {
        Http::fake();

        $this->getJson('/garage-finder/nearest?postcode=not-a-postcode&registration=AO23+LUW')
            ->assertUnprocessable()
            ->assertJsonValidationErrors('postcode');

        Http::assertNothingSent();
    }

    public function test_unknown_postcode_returns_a_useful_not_found_response(): void
    {
        Http::fake([
            'api.postcodes.io/*' => Http::response(['status' => 404, 'error' => 'Postcode not found'], 404),
        ]);

        $this->getJson('/garage-finder/nearest?postcode=ZZ1+1ZZ&registration=AO23+LUW')
            ->assertNotFound()
            ->assertJson(['message' => 'We could not find that postcode. Please check it and try again.']);
    }

    public function test_nearest_returns_the_closest_catalogue_garage(): void
    {
        Http::fake([
            'api.postcodes.io/*' => Http::response([
                'status' => 200,
                'result' => [
                    'postcode' => 'PE1 3SA',
                    'latitude' => 52.596556,
                    'longitude' => -0.240931,
                ],
            ]),
        ]);

        $this->getJson('/garage-finder/nearest?postcode=pe1+3sa&registration=ao23+luw')
            ->assertOk()
            ->assertJsonPath('searched_postcode', 'PE1 3SA')
            ->assertJsonPath('registration', 'AO23 LUW')
            ->assertJsonPath('garage.slug', 'hiq-welland-road')
            ->assertJsonPath('garage.distance_miles', 0)
            ->assertJsonStructure(['garage' => ['name', 'address', 'directions_url']]);
    }

    public function test_nearest_accepts_the_special_gir_uk_postcode(): void
    {
        Http::fake([
            'api.postcodes.io/*' => Http::response([
                'status' => 200,
                'result' => [
                    'postcode' => 'GIR 0AA',
                    'latitude' => 51.792324,
                    'longitude' => -0.169712,
                ],
            ]),
        ]);

        $this->getJson('/garage-finder/nearest?postcode=GIR+0AA&registration=AO23+LUW')
            ->assertOk()
            ->assertJsonPath('searched_postcode', 'GIR 0AA');
    }

    public function test_nearest_has_a_reviewable_server_rendered_fallback_without_javascript(): void
    {
        Http::fake([
            'api.postcodes.io/*' => Http::response([
                'status' => 200,
                'result' => [
                    'postcode' => 'PE1 3SA',
                    'latitude' => 52.596556,
                    'longitude' => -0.240931,
                ],
            ]),
        ]);

        $this->from('/')
            ->get('/garage-finder/nearest?postcode=PE1+3SA&registration=AO23+LUW')
            ->assertRedirect('/#garage-finder-result')
            ->assertSessionHas('garage_finder_result', function (array $result) {
                return $result['garage']['slug'] === 'hiq-welland-road'
                    && $result['registration'] === 'AO23 LUW';
            })
            ->assertSessionHasInput('postcode', 'PE1 3SA')
            ->assertSessionHasInput('registration', 'AO23 LUW');
    }

    public function test_postcode_service_failure_returns_a_controlled_retry_response(): void
    {
        Http::fake(function () {
            throw new ConnectionException('Timed out');
        });

        $this->getJson('/garage-finder/nearest?postcode=PE1+3SA&registration=AO23+LUW')
            ->assertStatus(503)
            ->assertJson(['message' => 'Postcode search is temporarily unavailable. Please try again.']);
    }

    public function test_select_stores_a_known_garage_and_redirects_to_booking_with_registration(): void
    {
        $response = $this->post('/garage-finder/select', [
            'garage' => 'hiq-welland-road',
            'registration' => ' ao23 luw ',
        ]);

        $response->assertRedirect('/booking/order?registration=AO23%20LUW');
        $response->assertSessionHas(env('LOKACIJA_KUKI', 'lokacija'), function ($garage) {
            return $garage->slug === 'hiq-welland-road'
                && $garage->title === 'HiQ Tyres & Autocare'
                && $garage->address === '7 Welland Rd, Dogsthorpe, Peterborough, PE1 3SA';
        });
    }

    public function test_select_rejects_a_forged_garage_slug(): void
    {
        $this->from('/')
            ->post('/garage-finder/select', [
                'garage' => 'forged-garage',
                'registration' => 'AO23 LUW',
            ])
            ->assertRedirect('/')
            ->assertSessionHasErrors('garage')
            ->assertSessionMissing(env('LOKACIJA_KUKI', 'lokacija'));
    }
}
