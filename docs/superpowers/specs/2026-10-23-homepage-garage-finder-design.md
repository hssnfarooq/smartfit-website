# Homepage Garage Finder Design

## Intent

Make the homepage garage finder return the closest real Smartfit garage for a UK postcode. The six garages already displayed in the homepage "Our Garages" section are the authoritative catalogue. Customers review the match before choosing it for booking.

## Goals

- Offer UK postcode suggestions while the customer types.
- Find the nearest of the six homepage garages and show its name, full address, approximate road-independent distance, and directions link.
- Provide a clear "Book This Garage" action that carries the entered registration and selected garage into the booking flow.
- Render the homepage garage cards from the same central catalogue so the displayed and searchable locations cannot drift apart.
- Keep the homepage responsive and accessible, with useful loading, empty, and error states.

## Non-goals

- Property-level address lookup.
- Route or drive-time calculation; proximity is straight-line distance.
- Changing the six garage addresses through the existing locations administration screen.
- Automatically sending a customer into booking before they review the result.

## Constraints

- Postcodes.io is the external postcode source because it is free, requires no API key, and supports lookup and autocomplete.
- The six homepage garages remain authoritative even though the existing database currently contains fewer locations.
- External postcode failures must not break the homepage. The form will explain the problem and allow retrying.
- Postcode responses will be cached and requested through the Laravel application, keeping third-party details out of the page code.

## Approaches considered

1. **Review-first nearest result (selected).** Show the closest garage and distance, then let the customer explicitly book it. This is clear and prevents accidental garage selection.
2. **Immediate booking redirect.** Select the closest garage and redirect as soon as search completes. This is faster but gives customers no chance to confirm the result.
3. **Browser-only postcode calls.** Call Postcodes.io directly from page JavaScript. This is simpler initially but provides weaker timeout, caching, and error control.

## Proposed implementation

- Add one central garage catalogue containing the six names, areas, addresses, postcodes, coordinates, and booking contact details.
- Replace the six duplicated homepage card definitions with a loop over that catalogue.
- Add read-only endpoints for postcode suggestions and nearest-garage lookup. Validate and normalize the registration and postcode server-side.
- Cache postcode autocomplete and lookup results. Calculate each distance using the Haversine formula and return only the closest catalogue entry.
- Enhance the existing homepage form with a debounced accessible suggestion list and an inline result card. Keep the page usable if JavaScript or the postcode service fails by displaying a clear validation/error message.
- When "Book This Garage" is clicked, store the catalogue garage in the existing selected-location session and pass the registration to the booking page. Vehicle verification remains in the existing DVSA booking workflow rather than slowing the garage search.

## Verification

- Automated tests will cover the six-location catalogue, postcode proxy validation/caching, distance selection, booking selection, and homepage contract.
- Manual checks will cover desktop/mobile suggestion interaction, keyboard selection, invalid postcodes, API failure, directions, and arrival at booking with the chosen garage and registration available.
