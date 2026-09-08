# SmartFit Homepage Hero Design QA

- Source visual truth: `/var/folders/wj/7k74ngmx3yd9sl0y2cs50w680000gp/T/codex-clipboard-594bb726-34b0-4279-b2c3-ad4087276fb6.png`
- Source asset: `/Users/hassangondal/Downloads/Hero section.jpg`
- Implementation capture: `/private/tmp/smartfit-hero-1440x900.png`
- Mobile implementation capture: `/private/tmp/smartfit-hero-mobile-regression.png`
- Combined comparison: `/private/tmp/smartfit-hero-comparison.jpg`
- Comparison viewport: 1440 x 900 CSS px at 1x
- Source pixels: 2880 x 1364, normalized to 1440 x 682 in the combined comparison
- Implementation capture pixels: 1440 x 900 at 1x
- Mobile viewport and capture: 390 x 844 CSS px at 1x
- State: initial homepage hero; mobile input-filled/focus behavior also verified

## Full-view comparison evidence

The source preview and final 1440 x 900 implementation were stacked in `/private/tmp/smartfit-hero-comparison.jpg` and opened together in one comparison pass. The supplied BMW remains the dominant subject, the floor is visible beneath it, and the expendable ceiling area is cropped before the car. The oversized white/red title and standalone registration controls retain the approved composition.

## Focused region evidence

- Wide desktop: at 1440 x 900, the complete BMW body and a clear strip of floor remain visible while the top of the garage absorbs the crop.
- Default desktop: at 1280 x 720, the main car, its wheels, the floor, full two-line title, input, and button remain visible.
- Mobile hero: measured at 390 x 650 CSS px within a 390 x 844 viewport. Title and form are 358 px wide with no horizontal overflow.
- Supporting image: the supplied BMW steering image renders sharply in the reputation section with the existing crop and radius treatment.
- Interaction: the registration field accepts and focuses correctly; submitting an empty value continues to the booking route as before.
- Console: no browser log entries were reported during the final desktop/mobile checks.

## Comparison history

1. P2: The original implementation used a fixed 760 px minimum hero height, which put the red title line and CTA below the fold at 1280 x 720. Fixed with viewport-aware hero sizing and reduced default bottom padding.
2. P2: At the wide reference viewport, the production container made the title and form too narrow and too far inward. Fixed with a 1720 px hero container, a responsive title up to 8rem, a 500 px form, and matched tall-viewport vertical alignment.
3. P2: The form controls were too short relative to the wide mock. Fixed with responsive control heights and a larger tall-viewport gap while retaining the compact mobile dimensions.
4. Post-fix desktop and mobile captures show no clipping, overlap, unintended wrapping, or horizontal overflow.
5. P1 user feedback: the desktop center crop hid too much of the main car and floor. Fixed by changing only the desktop hero anchor from `center center` to `center bottom`; the tablet and mobile position overrides were intentionally left unchanged.
6. Post-fix 1280 x 720, 1440 x 900, and 390 x 844 captures confirm the main car and floor are visible on desktop and the approved mobile composition is preserved.

## Required fidelity surfaces

- Fonts and typography: passed. Existing Montserrat heading family retained; 900 weight, tight tracking, responsive scale, and two fixed display lines match the intended hierarchy.
- Spacing and layout rhythm: passed. The desktop background now anchors to the bottom, retaining the floor and full car; title and form share a lower visual baseline and stack cleanly on mobile.
- Colors and visual tokens: passed. SmartFit white, near-black, and `#ed1e24` red are preserved with accessible focus treatment.
- Image quality and asset fidelity: passed. Both user-supplied JPEGs were converted to optimized WebP files; no placeholders or reconstructed artwork are used.
- Copy and content: passed. Headline, registration placeholder, and CTA copy match the supplied direction; shared DVSA dates now use UK numeric `dd/mm/yyyy` formatting.

## Findings

No actionable P0, P1, or P2 findings remain.

## Follow-up polish

- P3: The legacy Livewire multiple-root warning can be investigated separately; it is not produced by this hero change and does not affect the verified flow.

final result: passed
