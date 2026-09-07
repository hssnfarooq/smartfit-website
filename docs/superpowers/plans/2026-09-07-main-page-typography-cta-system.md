# SmartFit Main-Page Typography and CTA System Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Give SmartFit's Homepage, MOT, Repairs, Services, Tyres, and Fleet pages one responsive, professional typography scale and one consistent conversion-CTA system.

**Architecture:** Add a page identity class at the shared frontend layout boundary, then define all approved typography and CTA tokens in the existing central stylesheet. Migrate only conversion actions in the six scoped templates to semantic shared classes, remove the JavaScript and inline declarations that currently defeat central styling, and verify rendered output at desktop and mobile sizes.

**Tech Stack:** Laravel 10, Blade, Livewire 2, CSS custom properties and `clamp()`, PHPUnit, Chrome in-app browser QA

**Spec:** `docs/superpowers/specs/2026-09-07-main-page-typography-cta-system-design.md`

## Global Constraints

- Scope main-content styling to `/`, `/mot`, `/repairs`, `/car-servicing`, `/tyres`, and `/fleet-and-contract-work` only.
- Leave the empty `/services` page connection, shared header, shared footer, booking, checkout, admin, and secondary CMS pages unchanged.
- Preserve every existing heading and button label, href, Livewire binding, form behavior, image, color, section order, and page-specific layout.
- Use Montserrat for headings/labels and Mulish for reading copy; do not add another font or stylesheet request.
- Use H1 `32px` to `48px` at weight `800` and line-height `1.08`.
- Use H2 `28px` to `36px` at weight `800` and line-height `1.14`.
- Use H3 `20px` to `22px` at weight `700` to `800` and line-height `1.25`; use H4 `18px/700/1.35`.
- Use body copy `16px/400/1.65`, supporting copy `14px/1.55`, and labels `13px/700/1.4`.
- Use conversion CTA minimum height `48px`, horizontal padding `26px`, Montserrat `13px/800/1`, `2px` border, `999px` radius, and `0.35px` letter spacing.
- Preserve map chips, tyre filter fields, carousel arrows, FAQ controls, header navigation, and header search as compact controls; the Tyres Search button is a CTA and is included.
- Do not introduce horizontal overflow at `390px`; preserve reduced-motion behavior and visible keyboard focus.

## File Responsibility Map

- `resources/views/frontend/index.blade.php`: derive the scoped page key, add body classes, remove global DOM typography mutation, tag conversion CTAs in the four large inline page branches, and correct two malformed closing tags.
- `public/assets/css/style.css`: own the scoped typography tokens, shared CTA base/variants/states, and narrowly targeted legacy mappings.
- `resources/views/livewire/components/home/auto-search.blade.php`: apply shared CTA classes to the Homepage hero actions without changing Livewire behavior.
- `resources/views/livewire/components/mot/ispis-mota.blade.php`: apply shared CTA classes to MOT actions, remove conflicting inline sizes, and correct its malformed closing tag.
- `resources/views/livewire/gume-katalog.blade.php`: apply the shared primary CTA to the Tyres Search action.
- `tests/Feature/MainPageDesignSystemContractTest.php`: provide database-free source contracts for scope, tokens, script removal, and CTA migration.

---

### Task 1: Add a database-free design-system contract and scoped page identity

**Files:**
- Create: `tests/Feature/MainPageDesignSystemContractTest.php`
- Modify: `resources/views/frontend/index.blade.php`

**Interfaces:**
- Consumes: `$item->slug` already supplied by the frontend controller.
- Produces: `$sfPageKey` as `?string`, `.sf-main-page`, and `.sf-page-{home|mot|repairs|services|tyres|fleet}` on `<body>`.

- [ ] **Step 1: Write the failing scope contract**

Create the test class with path helpers and the first test:

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;

class MainPageDesignSystemContractTest extends TestCase
{
    private function source(string $path): string
    {
        $source = file_get_contents(base_path($path));
        $this->assertNotFalse($source, "Unable to read {$path}");

        return $source;
    }

    public function test_frontend_layout_scopes_the_design_system_to_the_six_main_pages(): void
    {
        $view = $this->source('resources/views/frontend/index.blade.php');

        foreach ([
            "'home-page' => 'home'",
            "'home' => 'home'",
            "'mot' => 'mot'",
            "'mot-peterborough' => 'mot'",
            "'mots' => 'mot'",
            "'repairs' => 'repairs'",
            "'car-servicing' => 'services'",
            "'tyres' => 'tyres'",
            "'fleet-and-contract-work' => 'fleet'",
        ] as $mapping) {
            $this->assertStringContainsString($mapping, $view);
        }

        $this->assertStringContainsString("'sf-main-page' => \$sfPageKey !== null", $view);
        $this->assertStringContainsString('"sf-page-{$sfPageKey}" => $sfPageKey !== null', $view);
        $this->assertStringNotContainsString("'services' => 'services'", $view);
    }
}
```

- [ ] **Step 2: Run the scope test and confirm the contract fails**

Run:

```bash
php artisan test --filter=test_frontend_layout_scopes_the_design_system_to_the_six_main_pages
```

Expected: FAIL because the aliases and `sf-main-page` body class do not exist.

- [ ] **Step 3: Derive the page key before `<body>` and apply conditional classes**

In `resources/views/frontend/index.blade.php`, insert this immediately after `</head>` and replace the plain `<body>` opening tag:

```blade
@php
    $sfPageAliases = [
        'home-page' => 'home',
        'home' => 'home',
        'mot' => 'mot',
        'mot-peterborough' => 'mot',
        'mots' => 'mot',
        'repairs' => 'repairs',
        'car-servicing' => 'services',
        'tyres' => 'tyres',
        'fleet-and-contract-work' => 'fleet',
    ];
    $sfCurrentSlug = isset($item) ? ($item->slug ?? '') : '';
    $sfPageKey = $sfPageAliases[$sfCurrentSlug] ?? ($sfCurrentSlug === '' && isset($item) ? 'home' : null);
@endphp
</head>
<body @class([
    'sf-main-page' => $sfPageKey !== null,
    "sf-page-{$sfPageKey}" => $sfPageKey !== null,
])>
```

Keep the existing `$currentSlug` branch variable because the page-selection logic already uses it. Do not map the deferred `services` slug.

- [ ] **Step 4: Run the scope test and compile Blade views**

Run:

```bash
php artisan test --filter=test_frontend_layout_scopes_the_design_system_to_the_six_main_pages
php artisan view:clear
php artisan view:cache
```

Expected: PASS; Blade compilation completes without an exception.

- [ ] **Step 5: Commit the scoped page identity**

```bash
git add tests/Feature/MainPageDesignSystemContractTest.php resources/views/frontend/index.blade.php
git commit -m "feat: scope main page design system"
```

---

### Task 2: Centralize the approved typography scale and remove global mutation

**Files:**
- Modify: `tests/Feature/MainPageDesignSystemContractTest.php`
- Modify: `public/assets/css/style.css`
- Modify: `resources/views/frontend/index.blade.php`
- Modify: `resources/views/livewire/components/mot/ispis-mota.blade.php`

**Interfaces:**
- Consumes: `.sf-main-page` from Task 1 and the existing `--bs-font-heading`/`--bs-font-body` variables.
- Produces: `--sf-type-*` scoped custom properties and deterministic computed type styles inside `.page_content`.

- [ ] **Step 1: Add failing typography and mutation-removal contracts**

Add these methods to `MainPageDesignSystemContractTest`:

```php
public function test_central_stylesheet_defines_the_approved_scoped_type_tokens(): void
{
    $css = $this->source('public/assets/css/style.css');

    foreach ([
        '--sf-type-h1: clamp(2rem, 1.5rem + 2vw, 3rem)',
        '--sf-type-h2: clamp(1.75rem, 1.5rem + 1vw, 2.25rem)',
        '--sf-type-h3: clamp(1.25rem, 1.18rem + 0.3vw, 1.375rem)',
        '--sf-type-h4: 1.125rem',
        '--sf-type-body: 1rem',
        '--sf-type-supporting: 0.875rem',
        '--sf-type-label: 0.8125rem',
        '.sf-main-page .page_content h1',
        '.sf-main-page .page_content h2',
        '.sf-main-page .page_content h3',
    ] as $contract) {
        $this->assertStringContainsString($contract, $css);
    }
}

public function test_frontend_layout_does_not_mutate_typography_after_render(): void
{
    $view = $this->source('resources/views/frontend/index.blade.php');

    $this->assertStringNotContainsString("querySelectorAll('h1')", $view);
    $this->assertStringNotContainsString("querySelectorAll('h2')", $view);
    $this->assertStringNotContainsString("querySelectorAll('h3')", $view);
    $this->assertStringNotContainsString("querySelectorAll('ul li')", $view);
}
```

- [ ] **Step 2: Run the two tests and confirm they fail**

Run:

```bash
php artisan test --filter='test_central_stylesheet_defines_the_approved_scoped_type_tokens|test_frontend_layout_does_not_mutate_typography_after_render'
```

Expected: FAIL because the scoped tokens are absent and four DOM mutation blocks remain.

- [ ] **Step 3: Add the scoped type system to the end of the central stylesheet**

Append this section to `public/assets/css/style.css`:

```css
/* SmartFit main-page design system: scoped to the six primary public pages. */
.sf-main-page {
  --sf-type-h1: clamp(2rem, 1.5rem + 2vw, 3rem);
  --sf-type-h2: clamp(1.75rem, 1.5rem + 1vw, 2.25rem);
  --sf-type-h3: clamp(1.25rem, 1.18rem + 0.3vw, 1.375rem);
  --sf-type-h4: 1.125rem;
  --sf-type-body: 1rem;
  --sf-type-supporting: 0.875rem;
  --sf-type-label: 0.8125rem;
}

.sf-main-page .page_content h1,
.sf-main-page .page_content .page_title,
.sf-main-page .page_content .fm-hero-title {
  font-family: var(--bs-font-heading) !important;
  font-size: var(--sf-type-h1) !important;
  font-weight: 800 !important;
  line-height: 1.08 !important;
  letter-spacing: -0.02em;
}

.sf-main-page .page_content h2,
.sf-main-page .page_content p.display-4,
.sf-main-page .page_content .section_heading .heading_text {
  font-family: var(--bs-font-heading) !important;
  font-size: var(--sf-type-h2) !important;
  font-weight: 800 !important;
  line-height: 1.14 !important;
  letter-spacing: -0.015em;
}

.sf-main-page .page_content h3,
.sf-main-page .page_content .product_item .item_title {
  font-family: var(--bs-font-heading) !important;
  font-size: var(--sf-type-h3) !important;
  font-weight: 700 !important;
  line-height: 1.25 !important;
  letter-spacing: -0.01em;
}

.sf-main-page .page_content h4 {
  font-family: var(--bs-font-heading) !important;
  font-size: var(--sf-type-h4) !important;
  font-weight: 700 !important;
  line-height: 1.35 !important;
}

.sf-main-page .page_content p,
.sf-main-page .page_content li,
.sf-main-page .page_content .section_heading .heading_description {
  font-family: var(--bs-font-body) !important;
  font-size: var(--sf-type-body) !important;
  font-weight: 400;
  line-height: 1.65 !important;
}

.sf-main-page .page_content small,
.sf-main-page .page_content .small,
.sf-main-page .page_content .text-muted,
.sf-main-page .page_content .product_item .item_brand {
  font-family: var(--bs-font-body) !important;
  font-size: var(--sf-type-supporting) !important;
  line-height: 1.55 !important;
}

.sf-main-page .page_content label,
.sf-main-page .page_content .eyebrow,
.sf-main-page .page_content .widget_title {
  font-family: var(--bs-font-heading) !important;
  font-size: var(--sf-type-label) !important;
  font-weight: 700 !important;
  line-height: 1.4 !important;
}

.sf-main-page .page_content h1,
.sf-main-page .page_content h2,
.sf-main-page .page_content h3,
.sf-main-page .page_content h4 {
  overflow-wrap: anywhere;
}
```

During implementation, verify the existing variables resolve to Montserrat and Mulish. If their exact names differ in the current stylesheet, use the already-defined heading/body variables and update the test strings to match the real variable names while retaining every numeric value above.

- [ ] **Step 4: Remove declarations that can defeat the central type system**

In `resources/views/frontend/index.blade.php`:

- Remove the four complete `DOMContentLoaded` scripts that call `querySelectorAll('h1')`, `querySelectorAll('h2')`, `querySelectorAll('h3')`, and `querySelectorAll('ul li')`.
- Remove `font-size` and `line-height` declarations carrying `!important` from inline styles on scoped main-page headings and body copy; retain their layout, color, alignment, and margin declarations.
- Remove the top-of-file global H1-H6/p/fs-5 type overrides after confirming the new scoped rules cover their six-page usages; retain unrelated hero layout rules.
- Correct the Fleet CTA-banner paragraph that opens as `<p ...>` but closes as `</h2>` so it closes as `</p>`.

In `resources/views/livewire/components/mot/ispis-mota.blade.php`:

- Remove inline heading/body `font-size` and `line-height` declarations that use `!important`; retain layout and color declarations.
- Correct the CTA-banner paragraph that opens as `<p ...>` but closes as `</h2>` so it closes as `</p>`.

Use targeted edits; do not mechanically remove sizing from header, footer, carousel arrows, map chips, FAQ controls, or tyre filter inputs.

- [ ] **Step 5: Run contracts, compile views, and scan for the removed mutations**

Run:

```bash
php artisan test --filter=MainPageDesignSystemContractTest
php artisan view:clear
php artisan view:cache
rg -n "querySelectorAll\('(h1|h2|h3|ul li)'\)|font-size:\s*(25px|18px)\s*!important" resources/views/frontend/index.blade.php resources/views/livewire/components/mot/ispis-mota.blade.php
```

Expected: tests PASS; views compile; `rg` returns no global mutation and no conflicting scoped `25px`/`18px` inline-important declarations. Review any remaining matches manually before removing them because an excluded compact control may legitimately own its size.

- [ ] **Step 6: Commit the centralized typography system**

```bash
git add public/assets/css/style.css resources/views/frontend/index.blade.php resources/views/livewire/components/mot/ispis-mota.blade.php tests/Feature/MainPageDesignSystemContractTest.php
git commit -m "feat: centralize main page typography"
```

---

### Task 3: Centralize CTA geometry and interaction states

**Files:**
- Modify: `tests/Feature/MainPageDesignSystemContractTest.php`
- Modify: `public/assets/css/style.css`

**Interfaces:**
- Consumes: `.sf-main-page` from Task 1 and the existing SmartFit red/dark palette.
- Produces: `.sf-cta`, `.sf-cta--primary`, `.sf-cta--outline-light`, and `.sf-cta--outline-dark` for links and buttons.

- [ ] **Step 1: Add the failing CTA token contract**

Add this method to the contract test:

```php
public function test_central_stylesheet_defines_shared_cta_geometry_and_variants(): void
{
    $css = $this->source('public/assets/css/style.css');

    foreach ([
        '.sf-main-page .page_content .sf-cta',
        'min-height: 48px',
        'padding: 0 26px',
        'font-size: 13px',
        'font-weight: 800',
        'border: 2px solid transparent',
        'border-radius: 999px',
        'letter-spacing: 0.35px',
        '.sf-cta--primary',
        '.sf-cta--outline-light',
        '.sf-cta--outline-dark',
        '.sf-cta:focus-visible',
        '.sf-cta:disabled',
    ] as $contract) {
        $this->assertStringContainsString($contract, $css);
    }
}
```

- [ ] **Step 2: Run the CTA token test and confirm it fails**

Run:

```bash
php artisan test --filter=test_central_stylesheet_defines_shared_cta_geometry_and_variants
```

Expected: FAIL because `.sf-cta` does not exist.

- [ ] **Step 3: Add the shared CTA base and variants**

Append this after the type system in `public/assets/css/style.css`, substituting only the exact already-used SmartFit red and dark color values if the current stylesheet exposes them under different variables:

```css
.sf-main-page .page_content .sf-cta {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  min-height: 48px;
  padding: 0 26px;
  font-family: var(--bs-font-heading) !important;
  font-size: 13px !important;
  font-weight: 800 !important;
  line-height: 1 !important;
  letter-spacing: 0.35px;
  text-align: center;
  text-decoration: none;
  border: 2px solid transparent;
  border-radius: 999px;
  cursor: pointer;
  transition: background-color 180ms ease, border-color 180ms ease, color 180ms ease, transform 180ms ease;
}

.sf-main-page .page_content .sf-cta--primary {
  color: #fff !important;
  background: #ed1e24;
  border-color: #ed1e24;
}

.sf-main-page .page_content .sf-cta--primary:hover {
  color: #fff !important;
  background: #c9141a;
  border-color: #c9141a;
  transform: translateY(-1px);
}

.sf-main-page .page_content .sf-cta--outline-light {
  color: #fff !important;
  background: transparent;
  border-color: #fff;
}

.sf-main-page .page_content .sf-cta--outline-light:hover {
  color: #181818 !important;
  background: #fff;
  transform: translateY(-1px);
}

.sf-main-page .page_content .sf-cta--outline-dark {
  color: #181818 !important;
  background: transparent;
  border-color: #181818;
}

.sf-main-page .page_content .sf-cta--outline-dark:hover {
  color: #fff !important;
  background: #181818;
  transform: translateY(-1px);
}

.sf-main-page .page_content .sf-cta:focus-visible {
  outline: 3px solid #f8b4b7;
  outline-offset: 3px;
}

.sf-main-page .page_content .sf-cta:active {
  transform: translateY(0);
}

.sf-main-page .page_content .sf-cta:disabled,
.sf-main-page .page_content .sf-cta[aria-disabled='true'] {
  opacity: 0.55;
  cursor: not-allowed;
  pointer-events: none;
  transform: none;
}

@media (prefers-reduced-motion: reduce) {
  .sf-main-page .page_content .sf-cta {
    transition: none;
  }
}
```

If an existing page-specific selector has greater specificity, map only the legacy CTA selectors (`fm-*`, `rp-*`, `sv-*`, `mot-*`) to these declarations inside the `.sf-main-page .page_content` scope. Do not change global `.btn` because it serves secondary pages and compact controls.

- [ ] **Step 4: Run the CTA token test**

Run:

```bash
php artisan test --filter=test_central_stylesheet_defines_shared_cta_geometry_and_variants
```

Expected: PASS.

- [ ] **Step 5: Commit the shared CTA primitives**

```bash
git add public/assets/css/style.css tests/Feature/MainPageDesignSystemContractTest.php
git commit -m "feat: add shared main page CTA styles"
```

---

### Task 4: Migrate all six pages' conversion actions to the CTA system

**Files:**
- Modify: `tests/Feature/MainPageDesignSystemContractTest.php`
- Modify: `resources/views/frontend/index.blade.php`
- Modify: `resources/views/livewire/components/home/auto-search.blade.php`
- Modify: `resources/views/livewire/components/mot/ispis-mota.blade.php`
- Modify: `resources/views/livewire/gume-katalog.blade.php`

**Interfaces:**
- Consumes: the four CTA classes from Task 3.
- Produces: semantic CTA markup on Homepage, MOT, Repairs, Services, Tyres, and Fleet while retaining every existing action target and binding.

- [ ] **Step 1: Add a failing template migration contract**

Add this method to the contract test:

```php
public function test_main_page_templates_use_the_shared_cta_classes(): void
{
    $templates = [
        'resources/views/frontend/index.blade.php',
        'resources/views/livewire/components/home/auto-search.blade.php',
        'resources/views/livewire/components/mot/ispis-mota.blade.php',
        'resources/views/livewire/gume-katalog.blade.php',
    ];

    foreach ($templates as $template) {
        $this->assertStringContainsString('sf-cta', $this->source($template), $template);
    }

    $tyres = $this->source('resources/views/livewire/gume-katalog.blade.php');
    $this->assertMatchesRegularExpression(
        '/<button[^>]+type="submit"[^>]+sf-cta[^>]+sf-cta--primary/s',
        $tyres
    );
}
```

- [ ] **Step 2: Run the template contract and confirm it fails**

Run:

```bash
php artisan test --filter=test_main_page_templates_use_the_shared_cta_classes
```

Expected: FAIL because the shared classes are not present in all four templates.

- [ ] **Step 3: Tag Homepage conversion actions**

In `resources/views/livewire/components/home/auto-search.blade.php`:

- Add `sf-cta sf-cta--primary` to the red Get a Quote action.
- Add `sf-cta sf-cta--primary` to the vehicle-confirmation action if it is presented as the primary action.
- Add `sf-cta sf-cta--outline-dark` to the “Not my vehicle” secondary action.
- Remove inline min-height, height, padding, font-size, border-width, and border-radius from those actions while preserving widths that are required by the hero form layout.

In the Homepage branch of `resources/views/frontend/index.blade.php`, add `sf-cta` plus the contextually correct variant to the four conversion links already using red, white-outline, or dark page-specific button styling. Do not add `sf-cta` to testimonial carousel arrows or the brand logo links.

- [ ] **Step 4: Tag MOT conversion actions**

In `resources/views/livewire/components/mot/ispis-mota.blade.php`:

- Map `mot-btn-red` and `mot-cta-btn-red` actions to `sf-cta sf-cta--primary`.
- Map white-on-dark `mot-btn-outline` and `mot-cta-btn-outline` actions to `sf-cta sf-cta--outline-light`.
- Add a shared CTA class and suitable variant to the currently classless inline-styled conversion link.
- Remove button-specific inline height, padding, font-size, border-width, and border-radius declarations from these actions.
- Leave review arrows and FAQ disclosure controls unchanged.

- [ ] **Step 5: Tag Repairs, Services, and Fleet conversion actions**

In the corresponding branches of `resources/views/frontend/index.blade.php`:

- Map red `rp-*`, `sv-*`, and `fm-*` conversion actions to `sf-cta sf-cta--primary`.
- Map white buttons on dark/image backgrounds to `sf-cta sf-cta--outline-light` when they are outlined, or keep the existing white-fill visual by adding a narrowly scoped legacy color mapping without changing shared geometry.
- Map dark outlined actions on light backgrounds to `sf-cta sf-cta--outline-dark`.
- Remove only inline CTA height, padding, font-size, border-width, and border-radius declarations.
- Leave map/location chips, testimonial carousel arrows, FAQ disclosures, and non-conversion controls unchanged.

- [ ] **Step 6: Tag the Tyres Search action**

Change the submit button in `resources/views/livewire/gume-katalog.blade.php` to:

```blade
<button type="submit" class="btn btn-primary sf-cta sf-cta--primary">
    <span class="btn_text">Search</span>
</button>
```

Do not add CTA classes to the filter inputs or select controls.

- [ ] **Step 7: Run the migration contracts and compile all Blade views**

Run:

```bash
php artisan test --filter=MainPageDesignSystemContractTest
php artisan view:clear
php artisan view:cache
```

Expected: all contract tests PASS and view compilation succeeds.

- [ ] **Step 8: Audit conversion markup and commit the migration**

Run:

```bash
rg -n "fm-btn|rp-btn|sv-btn|mot-btn|mot-cta-btn|type=\"submit\"" resources/views/frontend/index.blade.php resources/views/livewire/components/home/auto-search.blade.php resources/views/livewire/components/mot/ispis-mota.blade.php resources/views/livewire/gume-katalog.blade.php
```

Review every match: each conversion action must include `sf-cta` and one variant; each excluded compact control must remain without `sf-cta`.

```bash
git add resources/views/frontend/index.blade.php resources/views/livewire/components/home/auto-search.blade.php resources/views/livewire/components/mot/ispis-mota.blade.php resources/views/livewire/gume-katalog.blade.php tests/Feature/MainPageDesignSystemContractTest.php
git commit -m "feat: standardize main page conversion actions"
```

---

### Task 5: Run static regression gates and inspect the complete diff

**Files:**
- Modify only if a failing gate identifies a scoped defect in a file from Tasks 1-4.

**Interfaces:**
- Consumes: all scoped type and CTA changes.
- Produces: a clean, compiled, reviewable implementation ready for browser verification.

- [ ] **Step 1: Run the focused and full test suites**

Run:

```bash
php artisan test --filter=MainPageDesignSystemContractTest
php artisan test
```

Expected: all focused tests PASS. If the pre-existing database-backed example test cannot connect to the stopped local database, record that separately and do not confuse it with a design-system failure.

- [ ] **Step 2: Rebuild the compiled view cache**

Run:

```bash
php artisan view:clear
php artisan view:cache
```

Expected: both commands complete successfully.

- [ ] **Step 3: Run whitespace, placeholder, and scope scans**

Run:

```bash
git diff --check
rg -n "querySelectorAll\('(h1|h2|h3|ul li)'\)" resources/views/frontend/index.blade.php
rg -n "sf-main-page|sf-page-(home|mot|repairs|services|tyres|fleet)" resources/views/frontend/index.blade.php public/assets/css/style.css
rg -n "font-size:\s*(5[4-9]|6[0-9])px" resources/views/frontend/index.blade.php resources/views/livewire/components/mot/ispis-mota.blade.php public/assets/css/style.css
```

Expected: no whitespace errors; no global mutation scripts; scoped selectors exist; any remaining 54-69px match is outside the scoped main content or is removed after manual confirmation.

- [ ] **Step 4: Review the diff against the exclusions**

Run:

```bash
git diff --stat
git diff -- resources/views/frontend/index.blade.php public/assets/css/style.css resources/views/livewire/components/home/auto-search.blade.php resources/views/livewire/components/mot/ispis-mota.blade.php resources/views/livewire/gume-katalog.blade.php tests/Feature/MainPageDesignSystemContractTest.php
```

Confirm the diff contains no copy, href, Livewire binding, image, header/footer, `/services`, booking, checkout, or admin changes.

- [ ] **Step 5: Commit any regression-only corrections**

If the gates required a correction, stage only the corrected scoped files and commit:

```bash
git add public/assets/css/style.css resources/views/frontend/index.blade.php resources/views/livewire/components/home/auto-search.blade.php resources/views/livewire/components/mot/ispis-mota.blade.php resources/views/livewire/gume-katalog.blade.php tests/Feature/MainPageDesignSystemContractTest.php
git commit -m "fix: close main page style regressions"
```

If no correction was required, do not create an empty commit.

---

### Task 6: Verify all six pages in Chrome at desktop and mobile sizes

**Files:**
- Modify only if browser evidence reveals a scoped visual or interaction regression.
- Evidence: `/private/tmp/smartfit-typography-after-{desktop|mobile}-{homepage|mot|repairs|services|tyres|fleet}.png`

**Interfaces:**
- Consumes: a working local Laravel/database runtime and the completed implementation.
- Produces: screenshots, computed-style evidence, console checks, and interaction results for the six-route matrix.

- [ ] **Step 1: Start the known local SmartFit database and Laravel server**

Use the existing project-local MariaDB configuration on port `3307`, then run:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Expected: `http://127.0.0.1:8000` responds and database-backed page rendering succeeds. Keep this process in its own terminal session for the QA run.

- [ ] **Step 2: Open a named Chrome in-app browser session at desktop size**

Use the Chrome in-app browser, name the session `smartfit-main-page-style-qa`, set the viewport to `1440x900`, and visit these exact routes:

```text
http://127.0.0.1:8000/
http://127.0.0.1:8000/mot
http://127.0.0.1:8000/repairs
http://127.0.0.1:8000/car-servicing
http://127.0.0.1:8000/tyres
http://127.0.0.1:8000/fleet-and-contract-work
```

For each route, assert the URL/title identify the intended page, main content is nonblank, no Laravel exception/overlay is visible, and no relevant console error appears.

- [ ] **Step 3: Collect desktop computed-style evidence and screenshots**

For representative visible H1, H2, H3, body, and `.sf-cta` elements, collect `fontFamily`, `fontSize`, `fontWeight`, `lineHeight`, `minHeight`, rendered `height`, `padding`, `borderWidth`, and `borderRadius`.

Expected:

```text
H1 <= 48px; H2 <= 36px; H3 <= 22px; H4 = 18px
Body = 16px with approximately 26.4px line height
Conversion CTA rendered height >= 48px, 13px label, 2px border, pill radius
```

Capture a full-page screenshot for each route using the desktop evidence paths declared above and inspect each image visually.

- [ ] **Step 4: Repeat the full route matrix at mobile size**

Set the viewport to `390x844`, reload each route, repeat identity/nonblank/overlay/console checks, collect the same computed styles, and save the six mobile screenshots.

Expected:

```text
H1 = 32px; H2 = 28px; H3 = 20px; body = 16px
No horizontal overflow: document.documentElement.scrollWidth <= window.innerWidth
No clipped heading, CTA label, overlap, or forced single-line long heading
```

- [ ] **Step 5: Prove representative interactions still work**

Perform and record these non-destructive checks:

- Homepage: type a syntactically valid registration into the hero field and confirm the action remains enabled/operable without completing an external booking.
- MOT, Repairs, Services, and Fleet: open and close one FAQ and inspect one primary and one outline CTA destination without completing a purchase.
- Tyres: change one filter and submit Search; confirm the request/Livewire update completes and the results area remains rendered.
- Keyboard: Tab to one CTA on a light section and one on a dark section; confirm a visible focus outline.

- [ ] **Step 6: Fix only evidence-backed defects and rerun their matrix cells**

For each defect, first save its route, viewport, selector, computed values, and screenshot. Apply the smallest scoped CSS or class correction, rerun the matching automated test, rebuild views, and repeat that route at both viewports. Do not broaden selectors to header/footer or secondary pages.

- [ ] **Step 7: Finalize browser resources and report QA**

Restore any changed viewport state, close/finalize the Chrome in-app browser tabs as the final browser action, and report:

- all six desktop and six mobile route checks;
- computed type/CTA values;
- console health;
- interaction results;
- screenshot paths;
- any full-suite limitation caused only by the local database runtime.

If Task 6 required source corrections, finish with:

```bash
git diff --check
php artisan test --filter=MainPageDesignSystemContractTest
git add public/assets/css/style.css resources/views/frontend/index.blade.php resources/views/livewire/components/home/auto-search.blade.php resources/views/livewire/components/mot/ispis-mota.blade.php resources/views/livewire/gume-katalog.blade.php tests/Feature/MainPageDesignSystemContractTest.php
git commit -m "fix: resolve main page visual QA findings"
```
