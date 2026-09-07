# SmartFit Main-Page Typography and CTA System

Date: 2026-09-07

## Objective

Create one consistent, responsive typography and call-to-action system for SmartFit's six main public pages while preserving their existing content, section order, imagery, colors, and page-specific layouts.

## Page Scope

The system applies only to these routes and their main-page content:

- `/` (Homepage)
- `/mot` (MOT)
- `/repairs` (Repairs)
- `/car-servicing` (Services)
- `/tyres` (Tyres)
- `/fleet-and-contract-work` (Fleet)

The empty `/services` CMS page and its navigation connection are explicitly excluded from this change and will be handled separately.

Shared header and footer typography are excluded. Their existing styling remains unchanged.

## Current Problems

The production audit found that:

- Desktop H1 sizes range from approximately 55px to 66px.
- Desktop H2 sizes commonly reach 56px, including long multi-line headings.
- Mobile H2 sizes remain approximately 34px and H3 sizes remain 25px.
- Most body copy remains 18px across desktop and mobile, with line heights ranging from approximately 27px to 33px.
- Heading-like paragraph elements use Mulish while semantic headings use Montserrat.
- Equivalent CTA buttons range from approximately 33px to 60px tall.
- CTA font size, padding, border width, radius, and hover treatment vary by page.

## Design Principles

1. Preserve SmartFit's existing visual identity: Montserrat for display text and Mulish for reading text.
2. Reduce display scale so long headings remain prominent without overwhelming their sections.
3. Use fluid sizes between mobile and desktop breakpoints instead of abrupt page-specific values.
4. Standardize primary CTA geometry and interaction states while retaining light and dark contextual variants.
5. Scope all rules to the six named pages to avoid changing secondary CMS, booking, checkout, or admin pages.
6. Keep compact controls distinct from conversion CTAs.

## Typography Tokens

The central stylesheet will define the following scoped tokens:

| Role | Mobile | Desktop maximum | Weight | Line height | Font |
| --- | ---: | ---: | ---: | ---: | --- |
| Page/Hero H1 | 32px | 48px | 800 | 1.08 | Montserrat |
| Section H2 | 28px | 36px | 800 | 1.14 | Montserrat |
| Card/Step H3 | 20px | 22px | 700-800 | 1.25 | Montserrat |
| H4 | 18px | 18px | 700 | 1.35 | Montserrat |
| Body copy | 16px | 16px | 400 | 1.65 | Mulish |
| Supporting copy | 14px | 14px | 400-600 | 1.55 | Mulish |
| Labels/eyebrows | 13px | 13px | 700 | 1.4 | Montserrat |

Fluid heading values will use `clamp()` so intermediate viewport sizes scale smoothly. Existing uppercase/title-case choices and visible copy remain unchanged.

Large CTA-banner text currently implemented as paragraph elements will receive the section-heading token rather than body styling.

## CTA Tokens and Variants

All conversion CTAs on the six pages will use one shared base treatment:

- Minimum height: 48px
- Horizontal padding: 26px
- Font: Montserrat
- Font size: 13px
- Font weight: 800
- Line height: 1
- Border: 2px
- Radius: 999px
- Letter spacing: 0.35px
- Uppercase presentation retained where currently used
- Visible hover, active, and keyboard-focus states
- Disabled state with reduced opacity and no misleading hover movement

Supported variants:

- Primary: SmartFit red background, red border, white text
- Light outline: transparent background, white border and text for dark/image sections
- Dark outline: transparent background, dark border and text for light sections

Page-specific classes such as `fm-*`, `rp-*`, `sv-*`, and `mot-*` will be mapped to these shared tokens or replaced with shared utility classes. Inline padding and size declarations that conflict with the centralized system will be removed or overridden within the scoped system.

The following compact controls are not conversion CTAs and will keep separate sizing:

- Map/location selector chips
- Tyre filter fields
- Carousel arrow buttons
- FAQ disclosure controls
- Header navigation and search controls

The Tyres filter Search button is a primary form action and will adopt the shared CTA height, typography, radius, and red treatment.

## Implementation Structure

1. Add a route-aware class to the frontend `<body>` for the six scoped pages.
2. Add typography and CTA tokens to the existing central stylesheet, `public/assets/css/style.css`.
3. Add semantic shared CTA classes to conversion links and buttons in the main page templates.
4. Map unavoidable legacy page-specific classes to the same shared declarations.
5. Remove or neutralize conflicting inline typography and CTA sizing only where it affects the six scoped pages.
6. Preserve all current hrefs, form behavior, Livewire bindings, colors, content, images, section structure, and non-CTA controls.

No new stylesheet request will be introduced, avoiding an additional render-blocking asset.

## Accessibility and Responsive Behavior

- Body copy remains at least 16px.
- Conversion CTAs provide at least a 48px target height.
- Keyboard focus uses a high-contrast outline that is visible on light and dark sections.
- Heading hierarchy remains semantic; visual styles also cover legacy heading-like elements without changing their content.
- Long headings wrap naturally with no forced single-line behavior at narrow widths.
- The system must not introduce horizontal overflow at 390px.
- Existing reduced-motion behavior is preserved.

## Verification Matrix

Each route will be checked at 1440x900 and 390x844:

| Route | Typography | CTA variants | Layout/reflow | Console | Interaction |
| --- | --- | --- | --- | --- | --- |
| `/` | H1-H3, body, CTA banner | Primary | Hero/form and section wrapping | No relevant errors | Registration CTA remains operable |
| `/mot` | H1-H3, FAQ, body | Primary, light/dark outline | Long section headings | No relevant errors | CTA hrefs and FAQ behavior |
| `/repairs` | H1-H3, FAQ, body | Primary, light/dark outline | Hero and process sections | No relevant errors | CTA hrefs and FAQ behavior |
| `/car-servicing` | H1-H3, FAQ, body | Primary, light/dark outline | Hero and service sections | No relevant errors | CTA hrefs and FAQ behavior |
| `/tyres` | Page/product headings, filter labels | Primary form action | Product grid and filters | No relevant errors | Search form still submits |
| `/fleet-and-contract-work` | H1-H3, FAQ, body | Primary, light/dark outline | Hero and fleet sections | No relevant errors | CTA hrefs and FAQ behavior |

Verification will include computed font sizes, line heights, CTA dimensions, DOM content, screenshots, console health, and at least one representative interaction per component type. Header/footer and the deferred `/services` connection are expected intentional exclusions.

## Acceptance Criteria

- All six pages use the approved type scale in rendered output.
- All body copy in the scoped main content uses a consistent 16px base and 1.65 line height unless explicitly classified as supporting text.
- Conversion CTAs share the same 48px base height, typography, radius, and state treatment.
- No scoped page retains a visibly oversized 56-66px section heading.
- No conversion CTA remains below 44px tall or expands to 60px because of legacy padding.
- Desktop and mobile screenshots show no clipped headings, button text, overlaps, or horizontal overflow.
- The six pages preserve existing content, routes, imagery, forms, and interactive behavior.
- No secondary page changes visually as a result of the scoped rules.
