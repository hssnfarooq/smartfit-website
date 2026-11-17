<?php

namespace App\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class SiteSeo
{
    /**
     * Resolve consistent metadata for CMS pages and transactional views.
     */
    public static function resolve(
        mixed $page = null,
        ?string $livewireComponent = null,
        ?string $detailSlug = null,
        ?Request $request = null,
    ): array {
        $request ??= request();
        $pageSlug = (string) data_get($page, 'slug', '');
        $key = self::pageKey($pageSlug, $livewireComponent, $detailSlug, $request);
        $presets = self::presets();

        if (isset($presets[$key])) {
            [$title, $description] = $presets[$key];
        } else {
            $label = self::pageLabel(
                (string) data_get($page, 'title', ''),
                $detailSlug ?: $pageSlug ?: $key,
            );
            $title = self::fallbackTitle($label);
            $description = self::existingDescription($page)
                ?: "Book {$label} in Peterborough with Smartfit Autos. Get honest advice, experienced technicians and reliable workmanship for your vehicle. Call 01733 569998.";
        }

        return [
            'title' => $title,
            'description' => Str::limit(Str::squish(strip_tags($description)), 160, '…', true),
            'canonical' => $request->url(),
            'locale' => 'en_GB',
            'language' => 'en-GB',
        ];
    }

    private static function pageKey(
        string $pageSlug,
        ?string $livewireComponent,
        ?string $detailSlug,
        Request $request,
    ): string {
        $componentKeys = [
            'booking-stranica' => 'booking',
            'payment-page' => 'payment',
            'payment-finish' => 'payment-complete',
            'proizvod-opsirno' => 'tyre-detail',
        ];

        if ($livewireComponent && isset($componentKeys[$livewireComponent])) {
            return $componentKeys[$livewireComponent];
        }

        $aliases = [
            'home-page' => 'home',
            'home' => 'home',
            'mot-peterborough' => 'mot',
            'mots' => 'mot',
            'servicing' => 'car-servicing',
            'tyres-2' => 'tyres',
            'contacts-kennings-auto-centre' => 'contact',
        ];

        if ($pageSlug !== '') {
            return $aliases[$pageSlug] ?? $pageSlug;
        }

        if ($detailSlug) {
            return 'tyre-detail';
        }

        $path = trim($request->path(), '/');

        return $path === '' ? 'home' : $path;
    }

    private static function presets(): array
    {
        return [
            'home' => [
                'Smartfit Autos | MOT, Servicing, Repairs & Tyres',
                'Smartfit Autos provides trusted MOT testing, car servicing, repairs and tyre services across Peterborough. Book online or call 01733 569998.',
            ],
            'mot' => [
                'MOT Testing in Peterborough | Smartfit Autos',
                'Book professional Class 4, Class 5 and Class 7 MOT testing in Peterborough with Smartfit Autos. Same-day slots and transparent pricing available.',
            ],
            'repairs' => [
                'Car Repairs in Peterborough | Smartfit Autos',
                'Reliable car repairs in Peterborough from experienced Smartfit Autos technicians, including diagnostics, brakes, suspension and urgent repairs.',
            ],
            'car-servicing' => [
                'Car Servicing in Peterborough | Smartfit Autos',
                'Book interim, full or major car servicing in Peterborough with Smartfit Autos. Professional vehicle maintenance, honest advice and clear pricing.',
            ],
            'services' => [
                'Vehicle Services in Peterborough | Smartfit Autos',
                'Explore MOT testing, servicing, repairs, diagnostics, tyres and specialist vehicle services from Smartfit Autos in Peterborough.',
            ],
            'tyres' => [
                'Tyres in Peterborough | Smartfit Autos',
                'Buy tyres in Peterborough with professional fitting from Smartfit Autos. Choose trusted tyre brands, wheel alignment and mobile fitting services.',
            ],
            'fleet-and-contract-work' => [
                'Fleet Servicing in Peterborough | Smartfit Autos',
                'Fleet servicing, MOT testing, maintenance and repairs for businesses across Peterborough. Keep company cars and vans safe, reliable and road-ready.',
            ],
            'about-us' => [
                'About Smartfit Autos | Peterborough Garage',
                'Learn about Smartfit Autos, a trusted Peterborough garage providing professional MOT testing, servicing, repairs and tyre services.',
            ],
            'contact' => [
                'Contact Smartfit Autos | Peterborough',
                'Contact Smartfit Autos in Peterborough for MOT testing, servicing, repairs and tyres. Call 01733 569998 or send an online enquiry.',
            ],
            'booking' => [
                'Book a Garage Service Online | Smartfit Autos',
                'Book your MOT, car service or vehicle repair online with Smartfit Autos. Choose a Peterborough service centre and a convenient appointment time.',
            ],
            'payment' => [
                'Secure Booking Payment | Smartfit Autos',
                'Complete your Smartfit Autos booking securely online. Review your selected services and pay using the available secure payment methods.',
            ],
            'payment-complete' => [
                'Booking Payment Confirmation | Smartfit Autos',
                'Your Smartfit Autos payment and booking status. Review the confirmation details for your vehicle service appointment.',
            ],
            'booking-success' => [
                'Booking Confirmation | Smartfit Autos',
                'Your Smartfit Autos booking has been received. Review your appointment confirmation and the details sent to your email address.',
            ],
            'booking-cancellation' => [
                'Booking Cancellation Policy | Smartfit Autos',
                'Read the Smartfit Autos booking cancellation policy, including how to change or cancel a vehicle service appointment.',
            ],
            'terms-and-conditions' => [
                'Terms and Conditions | Smartfit Autos',
                'Read the terms and conditions that apply when using the Smartfit Autos website and booking vehicle services with our Peterborough garages.',
            ],
            'vehicle-servicing-terms-and-conditions' => [
                'Vehicle Servicing Terms | Smartfit Autos',
                'Read the Smartfit Autos vehicle servicing terms and conditions for MOT tests, maintenance, repairs and related garage services.',
            ],
        ];
    }

    private static function existingDescription(mixed $page): ?string
    {
        if (! $page) {
            return null;
        }

        $metadataDescription = null;
        if (is_object($page) && method_exists($page, 'metadata')) {
            $metadataDescription = data_get($page, 'metadata.description');
        }

        $description = Str::squish(strip_tags((string) ($metadataDescription ?: data_get($page, 'description', ''))));

        return mb_strlen($description) >= 60
            ? Str::limit($description, 160, '…', true)
            : null;
    }

    private static function pageLabel(string $title, string $slug): string
    {
        $label = $title !== '' ? $title : Str::headline($slug);
        $label = Str::of($label)->lower()->title()->toString();

        return str_ireplace(
            ['Mot', 'Dpf', 'Tpms', 'Ev', 'Ad Blue'],
            ['MOT', 'DPF', 'TPMS', 'EV', 'AdBlue'],
            $label,
        );
    }

    private static function fallbackTitle(string $label): string
    {
        $title = "{$label} in Peterborough | Smartfit Autos";

        if (mb_strlen($title) <= 60) {
            return $title;
        }

        return Str::limit($label, 41, '') . ' | Smartfit Autos';
    }
}
