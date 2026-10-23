# Homepage Garage Finder Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Build a postcode-assisted homepage search that identifies the nearest of Smartfit's six real garages and lets the customer carry that garage and their registration into booking.

**Architecture:** A central `config/garages.php` catalogue feeds both the homepage cards and a focused `GarageCatalog` distance service. A controller proxies cached Postcodes.io autocomplete/lookup calls and handles the explicit booking selection; a Blade partial owns the progressively enhanced result UI.

**Tech Stack:** Laravel 10, PHP 8.1, Blade, Laravel HTTP client/cache, Bootstrap 5, vanilla JavaScript, PHPUnit 10.

**Spec:** `docs/superpowers/specs/2026-10-23-homepage-garage-finder-design.md`

## Global Constraints

- The six garage addresses currently displayed on the homepage are authoritative.
- Use Postcodes.io without an API key for postcode autocomplete and coordinate lookup.
- Search shows a reviewable result and never redirects automatically.
- External API failure must leave the homepage usable and display a clear retry message.
- Proximity is a straight-line distance, not driving distance.
- Keep the existing DVSA vehicle verification workflow; do not add it to garage search.
- Execute natively in this task; never use the Subagent-Driven approach.

## Review Focus

- A malformed or missing postcode receives a validation response and never calls Postcodes.io.
- A syntactically valid but unknown postcode receives a useful not-found response.
- Postcodes.io timeout or server failure returns a controlled service-unavailable response.
- Rapid autocomplete responses cannot replace newer input with stale suggestions.
- A forged garage slug cannot be saved to the booking session.

---

### Task 1: Canonical garage catalogue and proximity service

**Files:**
- Create: `config/garages.php`
- Create: `app/Support/GarageCatalog.php`
- Create: `tests/Unit/GarageCatalogTest.php`

**Interfaces:**
- Produces: `GarageCatalog::all(): array`, `GarageCatalog::find(string $slug): ?array`, and `GarageCatalog::nearest(float $latitude, float $longitude): array`.

- [ ] **Step 1: Write the failing catalogue tests**
  Assert all six exact homepage postcodes are present, slugs are unique, `find()` rejects unknown slugs, and `nearest()` chooses the expected garage for coordinates near PE1 3SA and PE29 3RJ.
- [ ] **Step 2: Run the unit test and verify it fails**
  Run `php artisan test tests/Unit/GarageCatalogTest.php`; expect missing-class/config failures.
- [ ] **Step 3: Add the six-garage configuration and `GarageCatalog` methods**
  Store each garage's slug, area, name, address, postcode, latitude, longitude, common phone, and email. Calculate miles with the Haversine formula and include rounded `distance_miles` in the nearest result.
- [ ] **Step 4: Run the unit test and verify it passes**
  Run `php artisan test tests/Unit/GarageCatalogTest.php`; expect PASS.
- [ ] **Step 5: Commit the scoped files**
  Commit message: `feat: add canonical garage catalogue`.

### Task 2: Postcode and nearest-garage endpoints

**Files:**
- Create: `app/Http/Controllers/GarageFinderController.php`
- Modify: `routes/web.php`
- Create: `tests/Feature/GarageFinderApiTest.php`

**Interfaces:**
- Consumes: `GarageCatalog::nearest()` and `GarageCatalog::find()` from Task 1.
- Produces: `GET /garage-finder/postcodes?query=...`, `GET /garage-finder/nearest?postcode=...&registration=...`, and `POST /garage-finder/select`.

- [ ] **Step 1: Write failing endpoint tests**
  Fake Postcodes.io and assert normalized autocomplete output, nearest-garage JSON, caching, invalid/unknown postcode responses, timeout handling, successful session selection plus booking redirect, and rejection of a forged slug.
- [ ] **Step 2: Run the feature test and verify it fails**
  Run `php artisan test tests/Feature/GarageFinderApiTest.php`; expect route-not-found failures.
- [ ] **Step 3: Implement routes and controller methods**
  Use `Http::acceptJson()->timeout(5)`, bounded autocomplete results, `Cache::remember`, strict request validation, normalized uppercase registration/postcode values, and existing `LOKACIJA_KUKI` session storage.
- [ ] **Step 4: Run the feature test and verify it passes**
  Run `php artisan test tests/Feature/GarageFinderApiTest.php`; expect PASS.
- [ ] **Step 5: Commit the scoped files**
  Commit message: `feat: add postcode garage finder endpoints`.

### Task 3: Homepage search and shared garage rendering

**Files:**
- Create: `resources/views/site/partials/home-garage-finder.blade.php`
- Modify: `resources/views/frontend/index.blade.php`
- Modify: `resources/views/site/blocks/banner-2-boxa.blade.php`
- Create: `tests/Feature/HomeGarageFinderContractTest.php`

**Interfaces:**
- Consumes: the three Task 2 routes and `GarageCatalog::all()`.
- Produces: accessible autocomplete markup, nearest-garage result card, directions link, and CSRF-protected "Book This Garage" form.

- [ ] **Step 1: Write the failing homepage contract tests**
  Assert the finder partial exposes labelled registration/postcode inputs, an ARIA listbox, status region, all six catalogue cards exactly once, and no duplicated hardcoded garage addresses.
- [ ] **Step 2: Run the feature test and verify it fails**
  Run `php artisan test tests/Feature/HomeGarageFinderContractTest.php`; expect missing partial/contract failures.
- [ ] **Step 3: Build the shared Blade UI**
  Add debounced suggestions with keyboard support and request cancellation, loading/error/empty states, result distance/address/directions, and a selection form. Render "Our Garages" from `GarageCatalog::all()`.
- [ ] **Step 4: Keep the CMS block consistent**
  Replace the duplicate non-functional finder in `banner-2-boxa.blade.php` with the same partial so alternate homepage rendering cannot drift.
- [ ] **Step 5: Run the feature test and verify it passes**
  Run `php artisan test tests/Feature/HomeGarageFinderContractTest.php`; expect PASS.
- [ ] **Step 6: Commit the scoped files**
  Commit message: `feat: add homepage nearest garage experience`.

### Task 4: Booking registration handoff and final verification

**Files:**
- Modify: `app/Http/Livewire/Modals/Auto.php`
- Modify: `resources/views/livewire/modals/auto.blade.php`
- Create: `tests/Feature/GarageFinderBookingHandoffTest.php`

**Interfaces:**
- Consumes: normalized `registration` query value from the Task 2 selection redirect.
- Produces: a prefilled registration input in the existing booking vehicle modal; DVSA lookup still occurs only when the customer searches there.

- [ ] **Step 1: Write the failing handoff tests**
  Assert an allowed registration query value prefills the Livewire modal, whitespace is normalized, unsafe/oversized values are discarded, and no DVSA request happens during the redirect.
- [ ] **Step 2: Run the handoff test and verify it fails**
  Run `php artisan test tests/Feature/GarageFinderBookingHandoffTest.php`; expect missing-prefill failures.
- [ ] **Step 3: Implement safe registration prefill**
  Add `mount()` to initialize the public registration property from the normalized query value without performing lookup, and preserve the current explicit Search/Save flow.
- [ ] **Step 4: Run focused and complete test suites**
  Run the four new test files, then `php artisan test`; expect PASS with no regressions.
- [ ] **Step 5: Perform browser verification**
  Check desktop and mobile autocomplete, keyboard selection, AO23 LUW plus PE1 3SA, invalid postcode, API-error presentation, directions, and booking handoff.
- [ ] **Step 6: Commit the scoped files**
  Commit message: `feat: complete garage finder booking handoff`.
