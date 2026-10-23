<?php

namespace App\Http\Controllers;

use App\Support\GarageCatalog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Throwable;

class GarageFinderController extends Controller
{
    private const POSTCODES_API = 'https://api.postcodes.io';

    public function postcodes(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'query' => ['required', 'string', 'min:2', 'max:8', 'regex:/^[A-Za-z0-9 ]+$/'],
        ]);

        $query = $this->normalizeInput($validated['query']);

        try {
            $suggestions = Cache::remember(
                'garage-finder:postcodes:'.sha1($query),
                now()->addDay(),
                function () use ($query): array {
                    $response = Http::acceptJson()
                        ->timeout(5)
                        ->get(self::POSTCODES_API.'/postcodes/'.rawurlencode($query).'/autocomplete', [
                            'limit' => 8,
                        ]);

                    if ($response->failed()) {
                        $response->throw();
                    }

                    return array_values(array_map(
                        fn ($postcode) => $this->normalizeInput((string) $postcode),
                        array_slice($response->json('result') ?? [], 0, 8)
                    ));
                }
            );
        } catch (Throwable) {
            return $this->serviceUnavailable();
        }

        return response()->json(['suggestions' => $suggestions]);
    }

    public function nearest(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'postcode' => ['required', 'string', 'max:8', 'regex:/^(?:GIR ?0AA|[A-Za-z]{1,2}[0-9][A-Za-z0-9]? ?[0-9][A-Za-z]{2})$/i'],
            'registration' => ['required', 'string', 'max:10', 'regex:/^[A-Za-z0-9 ]+$/'],
        ]);

        $postcode = $this->normalizeInput($validated['postcode']);
        $registration = $this->normalizeInput($validated['registration']);

        try {
            $location = Cache::remember(
                'garage-finder:postcode:'.sha1($postcode),
                now()->addDay(),
                function () use ($postcode): ?array {
                    $response = Http::acceptJson()
                        ->timeout(5)
                        ->get(self::POSTCODES_API.'/postcodes/'.rawurlencode($postcode));

                    if ($response->status() === 404) {
                        return null;
                    }

                    if ($response->failed()) {
                        $response->throw();
                    }

                    return $response->json('result');
                }
            );
        } catch (Throwable) {
            return $this->postcodeError(
                $request,
                'Postcode search is temporarily unavailable. Please try again.',
                503
            );
        }

        if (! is_array($location)
            || ! isset($location['latitude'], $location['longitude'], $location['postcode'])) {
            return $this->postcodeError(
                $request,
                'We could not find that postcode. Please check it and try again.',
                404
            );
        }

        $garage = GarageCatalog::nearest(
            (float) $location['latitude'],
            (float) $location['longitude']
        );
        $garage['directions_url'] = 'https://www.google.com/maps/dir/?api=1&destination='.
            rawurlencode($garage['address']);

        $result = [
            'searched_postcode' => $this->normalizeInput($location['postcode']),
            'registration' => $registration,
            'garage' => $garage,
        ];

        if (! $request->expectsJson()) {
            return redirect('/#garage-finder-result')
                ->with('garage_finder_result', $result)
                ->withInput([
                    'postcode' => $result['searched_postcode'],
                    'registration' => $registration,
                ]);
        }

        return response()->json($result);
    }

    public function select(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'garage' => ['required', 'string', 'max:80'],
            'registration' => ['required', 'string', 'max:10', 'regex:/^[A-Za-z0-9 ]+$/'],
        ]);

        $garage = GarageCatalog::find($validated['garage']);

        if ($garage === null) {
            throw ValidationException::withMessages([
                'garage' => 'Please select one of our available garages.',
            ]);
        }

        $selectedGarage = (object) [
            'slug' => $garage['slug'],
            'title' => $garage['name'],
            'address' => $garage['address'],
            'postcode' => $garage['postcode'],
            'phone' => $garage['phone'],
            'email' => $garage['email'],
        ];

        $request->session()->put(env('LOKACIJA_KUKI', 'lokacija'), $selectedGarage);

        return redirect()->route('booking', [
            'registration' => $this->normalizeInput($validated['registration']),
        ]);
    }

    private function normalizeInput(string $value): string
    {
        return strtoupper(preg_replace('/\s+/', ' ', trim($value)) ?? '');
    }

    private function serviceUnavailable(): JsonResponse
    {
        return response()->json([
            'message' => 'Postcode search is temporarily unavailable. Please try again.',
        ], 503);
    }

    private function postcodeError(Request $request, string $message, int $status): JsonResponse|RedirectResponse
    {
        if (! $request->expectsJson()) {
            return redirect('/#home-garage-finder-form')
                ->withErrors(['postcode' => $message])
                ->withInput();
        }

        return response()->json(['message' => $message], $status);
    }
}
