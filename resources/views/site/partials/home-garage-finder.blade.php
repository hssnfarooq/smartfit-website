@php($garageFinderResult = session('garage_finder_result'))

<section class="home-garage-finder py-5 bg-white" aria-labelledby="garage-finder-title">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-12 text-center">
                <h2 id="garage-finder-title" class="display-4 fw-extrabold text-dark mb-0">
                    FIND A GARAGE NEAR YOU
                </h2>
            </div>

            <div class="col-lg-6">
                <p class="home-garage-finder__intro text-dark fs-5 mb-4 fw-bold">
                    Enter your registration number and postcode to find your nearest Smartfit garage.
                </p>

                <form
                    id="home-garage-finder-form"
                    action="{{ route('garage-finder.nearest') }}"
                    method="GET"
                    data-postcodes-url="{{ route('garage-finder.postcodes') }}"
                    data-nearest-url="{{ route('garage-finder.nearest') }}"
                >
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="garage-registration" class="form-label text-uppercase fw-bold text-muted small mb-1">
                                REGISTRATION NUMBER
                            </label>
                            <input
                                id="garage-registration"
                                type="text"
                                name="registration"
                                class="form-control form-control-lg bg-light border-0 text-uppercase fw-bold"
                                placeholder="AB12 CDE"
                                maxlength="10"
                                autocomplete="off"
                                value="{{ old('registration', data_get($garageFinderResult, 'registration')) }}"
                                required
                            >
                        </div>
                        <div class="col-md-6">
                            <label for="garage-postcode" class="form-label text-uppercase fw-bold text-muted small mb-1">
                                POSTCODE
                            </label>
                            <div class="home-garage-finder__postcode-wrap">
                                <input
                                    id="garage-postcode"
                                    type="text"
                                    name="postcode"
                                    class="form-control form-control-lg bg-light border-0 text-uppercase fw-bold"
                                    placeholder="PE1 3SA"
                                    maxlength="8"
                                    autocomplete="postal-code"
                                    value="{{ old('postcode', data_get($garageFinderResult, 'searched_postcode')) }}"
                                    role="combobox"
                                    aria-autocomplete="list"
                                    aria-controls="garage-postcode-options"
                                    aria-expanded="false"
                                    required
                                >
                                <ul
                                    id="garage-postcode-options"
                                    class="home-garage-finder__suggestions list-unstyled"
                                    role="listbox"
                                    aria-label="Postcode suggestions"
                                    hidden
                                ></ul>
                            </div>
                        </div>
                    </div>

                    <div id="garage-finder-status" class="home-garage-finder__status mb-3" role="status" aria-live="polite">
                        @if(isset($errors) && $errors->any())
                            {{ $errors->first() }}
                        @endif
                    </div>

                    <button type="submit" class="btn btn-danger fw-bold text-uppercase d-inline-flex align-items-center gap-2 sf-cta sf-cta--primary">
                        <span>SEARCH GARAGES</span>
                        <i class="fa-solid fa-arrow-right sf-cta__icon" aria-hidden="true"></i>
                    </button>
                </form>

                <article id="garage-finder-result" class="home-garage-finder__result mt-4" aria-labelledby="garage-finder-result-name"{!! $garageFinderResult ? '' : ' hidden' !!}>
                    <p class="home-garage-finder__eyebrow mb-1">YOUR NEAREST GARAGE</p>
                    <h3 id="garage-finder-result-name" class="home-garage-finder__name mb-2">{{ data_get($garageFinderResult, 'garage.name') }}</h3>
                    <p id="garage-finder-result-address" class="home-garage-finder__address mb-1">{{ data_get($garageFinderResult, 'garage.address') }}</p>
                    <p id="garage-finder-result-distance" class="home-garage-finder__distance mb-3">
                        @if($garageFinderResult)
                            @if(data_get($garageFinderResult, 'garage.distance_miles', 0) < 0.1)
                                Less than 1 mile from {{ data_get($garageFinderResult, 'searched_postcode') }}
                            @else
                                Approximately {{ data_get($garageFinderResult, 'garage.distance_miles') }} miles from {{ data_get($garageFinderResult, 'searched_postcode') }}
                            @endif
                        @endif
                    </p>

                    <div class="home-garage-finder__actions">
                        <form action="{{ route('garage-finder.select') }}" method="POST">
                            @csrf
                            <input id="garage-finder-selected-slug" type="hidden" name="garage" value="{{ data_get($garageFinderResult, 'garage.slug') }}">
                            <input id="garage-finder-selected-registration" type="hidden" name="registration" value="{{ data_get($garageFinderResult, 'registration') }}">
                            <button type="submit" class="sf-cta sf-cta--primary">BOOK THIS GARAGE</button>
                        </form>
                        <a id="garage-finder-directions" class="sf-cta sf-cta--outline-dark" href="{{ data_get($garageFinderResult, 'garage.directions_url', '#') }}" target="_blank" rel="noopener">
                            GET DIRECTIONS
                            <i class="fa-solid fa-arrow-right sf-cta__icon" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
            </div>

            <div class="col-lg-6">
                <div class="overflow-hidden rounded-3 shadow-sm">
                    <img src="{{ asset('assets/images/home/garage-interior.webp') }}" alt="Smartfit garage interior" class="img-fluid w-100 object-fit-cover home-garage-finder__image" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.home-garage-finder h2 {
    font-family: Montserrat, sans-serif;
    font-weight: 800;
    text-transform: uppercase;
}
.home-garage-finder__intro {
    font-family: Mulish, sans-serif;
    text-align: left !important;
}
.home-garage-finder .form-control {
    height: 48px;
    color: #171717 !important;
    caret-color: #171717;
    -webkit-text-fill-color: #171717;
    font-size: 15px;
}
.home-garage-finder .form-control::placeholder {
    color: #68707c !important;
    -webkit-text-fill-color: #68707c;
    opacity: 1;
}
.home-garage-finder .form-control:focus {
    border-color: #ed1e24 !important;
    box-shadow: 0 0 0 3px rgba(237, 30, 36, 0.14);
}
.home-garage-finder__postcode-wrap {
    position: relative;
}
.home-garage-finder__suggestions {
    position: absolute;
    z-index: 20;
    top: calc(100% + 4px);
    right: 0;
    left: 0;
    max-height: 230px;
    margin: 0;
    padding: 6px;
    overflow-y: auto;
    border: 1px solid #dadce0;
    border-radius: 6px;
    background: #fff;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
}
.home-garage-finder__suggestion {
    padding: 9px 11px;
    color: #171717;
    border-radius: 4px;
    font-family: Mulish, sans-serif;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
}
.home-garage-finder__suggestion:hover,
.home-garage-finder__suggestion[aria-selected="true"] {
    color: #fff;
    background: #ed1e24;
}
.home-garage-finder__status {
    min-height: 22px;
    color: #b11218;
    font-family: Mulish, sans-serif;
    font-size: 14px;
    font-weight: 700;
}
.home-garage-finder__result {
    padding: 24px;
    border: 1px solid #dedede;
    border-left: 5px solid #ed1e24;
    border-radius: 8px;
    background: #f7f7f8;
}
.home-garage-finder__eyebrow {
    color: #ed1e24;
    font-family: Montserrat, sans-serif;
    font-size: 11px !important;
    font-weight: 800 !important;
    letter-spacing: 0.08em;
}
.home-garage-finder__name {
    color: #171717;
    font-family: Montserrat, sans-serif;
    font-size: 22px !important;
    font-weight: 800 !important;
}
.home-garage-finder__address,
.home-garage-finder__distance {
    color: #4f5359;
    font-family: Mulish, sans-serif;
    font-size: 15px !important;
    line-height: 1.5 !important;
    text-align: left !important;
}
.home-garage-finder__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}
.home-garage-finder__image {
    height: 320px;
    border-radius: 8px;
}
@media (max-width: 575.98px) {
    .home-garage-finder__actions,
    .home-garage-finder__actions form,
    .home-garage-finder__actions .sf-cta {
        width: 100%;
    }
}
</style>

<script>
(function () {
    function initHomeGarageFinder() {
        const form = document.getElementById('home-garage-finder-form');
        if (!form || form.dataset.initialized === 'true') return;
        form.dataset.initialized = 'true';

        const registrationInput = document.getElementById('garage-registration');
        const postcodeInput = document.getElementById('garage-postcode');
        const suggestions = document.getElementById('garage-postcode-options');
        const status = document.getElementById('garage-finder-status');
        const result = document.getElementById('garage-finder-result');
        const submit = form.querySelector('button[type="submit"]');
        let debounceTimer;
        let suggestionRequest;
        let suggestionRequestNumber = 0;
        let activeSuggestion = -1;

        function normalize(value) {
            return value.trim().replace(/\s+/g, ' ').toUpperCase();
        }

        function setStatus(message, isError) {
            status.textContent = message;
            status.style.color = isError ? '#b11218' : '#4f5359';
        }

        function closeSuggestions() {
            suggestions.hidden = true;
            suggestions.innerHTML = '';
            postcodeInput.setAttribute('aria-expanded', 'false');
            postcodeInput.removeAttribute('aria-activedescendant');
            activeSuggestion = -1;
        }

        function chooseSuggestion(value) {
            postcodeInput.value = value;
            closeSuggestions();
            postcodeInput.focus();
        }

        function setActiveSuggestion(index) {
            const options = Array.from(suggestions.querySelectorAll('[role="option"]'));
            if (!options.length) return;
            activeSuggestion = (index + options.length) % options.length;
            options.forEach(function (option, optionIndex) {
                option.setAttribute('aria-selected', optionIndex === activeSuggestion ? 'true' : 'false');
            });
            postcodeInput.setAttribute('aria-activedescendant', options[activeSuggestion].id);
            options[activeSuggestion].scrollIntoView({ block: 'nearest' });
        }

        function renderSuggestions(items) {
            suggestions.innerHTML = '';
            if (!items.length) {
                closeSuggestions();
                return;
            }

            items.forEach(function (postcode, index) {
                const option = document.createElement('li');
                option.id = 'garage-postcode-option-' + index;
                option.className = 'home-garage-finder__suggestion';
                option.setAttribute('role', 'option');
                option.setAttribute('aria-selected', 'false');
                option.textContent = postcode;
                option.addEventListener('mousedown', function (event) {
                    event.preventDefault();
                    chooseSuggestion(postcode);
                });
                suggestions.appendChild(option);
            });

            suggestions.hidden = false;
            postcodeInput.setAttribute('aria-expanded', 'true');
        }

        postcodeInput.addEventListener('input', function () {
            postcodeInput.value = postcodeInput.value.toUpperCase();
            result.hidden = true;
            window.clearTimeout(debounceTimer);
            if (suggestionRequest) suggestionRequest.abort();

            const query = normalize(postcodeInput.value);
            if (query.length < 2) {
                closeSuggestions();
                return;
            }

            const requestNumber = ++suggestionRequestNumber;
            debounceTimer = window.setTimeout(async function () {
                suggestionRequest = new AbortController();
                const url = new URL(form.dataset.postcodesUrl, window.location.origin);
                url.searchParams.set('query', query);

                try {
                    const response = await fetch(url, {
                        headers: { Accept: 'application/json' },
                        signal: suggestionRequest.signal
                    });
                    if (!response.ok) throw new Error('Postcode suggestions are unavailable.');
                    const data = await response.json();
                    if (requestNumber === suggestionRequestNumber) {
                        renderSuggestions(data.suggestions || []);
                    }
                } catch (error) {
                    if (error.name !== 'AbortError' && requestNumber === suggestionRequestNumber) {
                        closeSuggestions();
                    }
                }
            }, 250);
        });

        postcodeInput.addEventListener('keydown', function (event) {
            const options = suggestions.querySelectorAll('[role="option"]');
            if (suggestions.hidden || !options.length) return;

            if (event.key === 'ArrowDown') {
                event.preventDefault();
                setActiveSuggestion(activeSuggestion + 1);
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                setActiveSuggestion(activeSuggestion - 1);
            } else if (event.key === 'Enter' && activeSuggestion >= 0) {
                event.preventDefault();
                chooseSuggestion(options[activeSuggestion].textContent);
            } else if (event.key === 'Escape') {
                closeSuggestions();
            }
        });

        document.addEventListener('click', function (event) {
            if (!postcodeInput.contains(event.target) && !suggestions.contains(event.target)) {
                closeSuggestions();
            }
        });

        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            closeSuggestions();
            result.hidden = true;

            if (!form.reportValidity()) return;

            const registration = normalize(registrationInput.value);
            const postcode = normalize(postcodeInput.value);
            registrationInput.value = registration;
            postcodeInput.value = postcode;
            submit.disabled = true;
            setStatus('Finding your nearest garage…', false);

            const url = new URL(form.dataset.nearestUrl, window.location.origin);
            url.searchParams.set('registration', registration);
            url.searchParams.set('postcode', postcode);

            try {
                const response = await fetch(url, { headers: { Accept: 'application/json' } });
                const data = await response.json();
                if (!response.ok) {
                    const validationMessage = data.errors
                        ? Object.values(data.errors).flat()[0]
                        : data.message;
                    throw new Error(validationMessage || 'We could not complete that search.');
                }

                document.getElementById('garage-finder-result-name').textContent = data.garage.name;
                document.getElementById('garage-finder-result-address').textContent = data.garage.address;
                document.getElementById('garage-finder-result-distance').textContent = data.garage.distance_miles < 0.1
                    ? 'Less than 1 mile from ' + data.searched_postcode
                    : 'Approximately ' + data.garage.distance_miles + ' miles from ' + data.searched_postcode;
                document.getElementById('garage-finder-selected-slug').value = data.garage.slug;
                document.getElementById('garage-finder-selected-registration').value = data.registration;
                document.getElementById('garage-finder-directions').href = data.garage.directions_url;
                result.hidden = false;
                setStatus('Nearest garage found.', false);
                result.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } catch (error) {
                setStatus(error.message || 'Postcode search is temporarily unavailable. Please try again.', true);
            } finally {
                submit.disabled = false;
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHomeGarageFinder);
    } else {
        initHomeGarageFinder();
    }
})();
</script>
