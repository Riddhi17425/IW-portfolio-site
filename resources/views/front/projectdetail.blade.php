@push('styles')
    <link rel="stylesheet" href="{{ asset('public/frontend/project-detail/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/project-detail/css/responsive.css') }}">
    <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.164.0/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.164.0/examples/jsm/"
            }
        }
    </script>
@endpush

@include('layouts.frontheader')

{{-- ================= HERO ================= --}}
<section class="new-hero">
    <div class="new-hero-bg-line"></div>

    <div class="new-container" style="position: relative; z-index: 2;">
        <div class="new-hero-content">
            <h1>
                {!! nl2br(e($project->hero_heading)) !!}
            </h1>
            <p>{!! strip_tags($project->hero_description) !!}</p>
        </div>
    </div>

    @if ($project->hero_model)
        <div id="canvas-container" class="new-threejs-model-container"
            data-model="{{ asset('public/newportfolio/hero_models/' . $project->hero_model) }}">
            <div class="left-bar"></div>
            <div id="zoom-hint" style="display: none;">
                <svg class="new-mouse-icon" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect x="6" y="3" width="12" height="18" rx="6" stroke="currentColor"
                        stroke-width="2" />
                    <circle class="new-scroll-wheel" cx="12" cy="9" r="2" fill="currentColor" />
                </svg>
                <span class="new-hint-text">Click to Zoom</span>
            </div>
        </div>
    @endif
</section>

{{-- ================= FULL WIDTH BANNER ================= --}}
@if ($project->banner_image)
    <section class="new-full-width-banner">
        <img src="{{ asset('public/newportfolio/banners/' . $project->banner_image) }}" alt="{{ $project->name }}">
    </section>
@endif

{{-- ================= OVERVIEW / INDUSTRY / SERVICES / CHALLENGES-APPROACH ================= --}}
<section class="new-project-details-section">
    <div class="new-container">
        <div class="new-details-row new-top-row">
            <div class="new-overview-col">
                <h3>OVERVIEW</h3>
                <p>{!! $project->overview_description !!}</p>
            </div>
            @if ($industryNames->count())
                <div class="new-industry-col">
                    <h3>INDUSTRY</h3>
                    <p>{!! $industryNames->implode('<br>') !!}</p>
                </div>
            @endif
        </div>

        @if ($servicesList && count($servicesList))
            <div class="new-details-row new-services-row">
                <h3>SERVICES</h3>
                <div class="new-services-tags">
                    @foreach ($servicesList as $service)
                        <span class="new-tag">{{ $service }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="new-details-row new-bottom-row">
            @if ($project->challenge_description)
                <div class="new-challenges-col">
                    <h3>CHALLENGES</h3>
                    {!! $project->challenge_description !!}
                </div>
            @endif
            @if ($project->approach_description)
                <div class="new-approach-col">
                    <h3>APPROACH</h3>
                    {!! $project->approach_description !!}
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ================= GALLERY ================= --}}
@if ($project->gallery_heading || $project->gallery_description || $galleryGroups->count())
    <section class="new-golden-harbour-section">
        <div class="new-container">
            @if ($project->gallery_heading || $project->gallery_description)
                <div class="new-brand-text-header">
                    @if ($project->gallery_heading)
                        <h2>{!! nl2br(e($project->gallery_heading)) !!}</h2>
                    @endif

                    @if ($project->gallery_description)
                        <p>{!! $project->gallery_description !!}</p>
                    @endif
                </div>
            @endif

            {{-- Gallery Media Title --}}
            @if ($galleryGroups->count() > 0)
                @php
                    $firstGroupTitle = $galleryGroups[0]->first()->title ?? null;
                @endphp

                @if ($firstGroupTitle)
                    <h3>{{ $firstGroupTitle }}</h3>
                @endif
            @endif

            {{-- First gallery group: shown with no title, images only, matching "Brand Experience Grid" style --}}
            @if ($galleryGroups->count() > 0)
                @php $firstGroup = $galleryGroups[0]; @endphp
                @foreach ($firstGroup as $item)
                    @if (in_array($item->media_type, ['image', 'gif']))
                        <img src="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}"
                            alt="{{ $project->name }}" class="new-brand-grid-image">
                    @elseif($item->media_type === 'video')
                        <video
                            src="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}"
                            class="new-brand-grid-image" controls></video>
                    @endif
                @endforeach
            @endif
        </div>
    </section>
@endif

{{-- ================= REMAINING GALLERY GROUPS (2nd onward) ================= --}}
@if ($galleryGroups->count() > 1)
    @foreach ($galleryGroups->slice(1) as $group)
        @php
            $groupTitle = $group->first()->title;
            $has3dModel = $group->contains(fn($item) => in_array($item->media_type, ['glb', 'gltf']));
        @endphp

        <section class="new-products-showcase-section new-mt_100">
            <div class="new-container">
                @if ($groupTitle)
                    <h2 class="new-section-heading">{{ $groupTitle }}</h2>
                @endif

                @if ($has3dModel)
                    {{-- 3D model group: render each model in its own viewer, grid style like Product Series 01 --}}
                    <div class="new-products-grid">
                        @foreach ($group as $item)
                            @if (in_array($item->media_type, ['glb', 'gltf']))
                                <div class="new-product-card">
                                    <div class="new-threejs-model-container"
                                        data-model="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    {{-- Image/video group: full-width showcase image(s), same style as Product Series 02-05 --}}
                    @foreach ($group as $item)
                        @if (in_array($item->media_type, ['image', 'gif']))
                            <img src="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}"
                                alt="{{ $groupTitle ?? $project->name }}" class="new-products-showcase-image">
                        @elseif($item->media_type === 'video')
                            <video
                                src="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}"
                                class="new-products-showcase-image" controls></video>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
    @endforeach
@endif


{{-- ================= LET'S CONNECT SECTION ================= --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.7/build/css/intlTelInput.css">
<style>
    .new-math-captcha-box {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .captcha-question-text {
        color: #fff;
        font-weight: 600;
    }

    .captcha-input-row {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .captcha-input-row .new-connect-input {
        flex: 1;
    }

    .captcha-refresh-btn {
        background: transparent;
        border: 1px solid #555;
        color: #fff;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        flex-shrink: 0;
    }

    /* intl-tel-input ko dark theme ke sath match karne ke liye */
    .iti {
        width: 100%;
    }

    #connect-phone {
        width: 100%;
    }


    .iti__flag-container {
        z-index: 10;
    }

    /* Dropdown box */
    .iti__dropdown-content {
        background: #1a1a1a;
        color: #fff;
        border: 1px solid #555;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
    }

    /* Search input top pe dikhe */
    .iti__search-input {
        background: #111;
        color: #fff;
        border: 1px solid #555;

    }

    /* Country list */
    .iti__country-list {
        max-height: 200px;
        overflow-y: auto;
        background: #1a1a1a;
        color: #fff;

    }

    .iti__country {
        list-style: none;
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        cursor: pointer;
    }

    .iti__country.iti__highlight {
        background-color: #333;
    }
</style>
<section class="new-connect-section new-mt_100">
    <div class="new-container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="new-connect-grid">
            {{-- Left Column: Form --}}
            <div class="new-connect-form-col">
                <h2 class="new-connect-title">Let's Connect</h2>

                <form action="{{ route('connect.store') }}" method="POST" class="new-connect-form" id="connectForm"
                    novalidate>
                    @csrf

                    <div class="new-connect-field-group">
                        <label for="connect-name" class="new-connect-label">
                            <img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow"
                                class="new-connect-arrow">
                            <span>Your Name *</span>
                        </label>
                        <input type="text" id="connect-name" name="name" class="new-connect-input"
                            placeholder="Enter your full name" required value="{{ old('name') }}"
                            oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                            maxlength="70">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="new-connect-field-group">
                        <label for="connect-phone" class="new-connect-label">
                            <img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow"
                                class="new-connect-arrow">
                            <span>Contact No. *</span>
                        </label>
                        <input type="tel" id="connect-phone" name="contact_number" class="new-connect-input"
                            placeholder="Enter contact number" required maxlength="15"
                            value="{{ old('contact_number') }}" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">

                        {{-- Selected country code yahan hidden input me save hoga --}}
                        <input type="hidden" id="country_code" name="country_code"
                            value="{{ old('country_code', '+91') }}">
                        @error('contact_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @error('country_code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="new-connect-field-group">
                        <label for="connect-email" class="new-connect-label">
                            <img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow"
                                class="new-connect-arrow">
                            <span>Your Email ID *</span>
                        </label>
                        <input type="email" id="connect-email" name="email" class="new-connect-input"
                            placeholder="Enter your email" required value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="new-connect-field-group">
                        <label for="connect-message" class="new-connect-label">
                            <img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow"
                                class="new-connect-arrow">
                            <span>Message</span>
                        </label>
                        <textarea id="connect-message" name="message" class="new-connect-textarea" rows="1"
                            placeholder="Write your message here...">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Math Captcha Widget --}}
                    <div class="new-connect-field-group">
                        <label class="new-connect-label">
                            <img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow"
                                class="new-connect-arrow">
                            <span>Security Check *</span>
                        </label>
                        <div class="new-math-captcha-box">
                            <span class="captcha-question-text">What is <span id="captchaQuestion">--</span> ?</span>
                            <div class="captcha-input-row">
                                <input type="text" id="captcha_answer" name="captcha_answer"
                                    class="new-connect-input" placeholder="Enter answer" required autocomplete="off">
                                <button type="button" id="refreshCaptcha" class="captcha-refresh-btn"
                                    title="Refresh">↻</button>
                            </div>
                        </div>
                        @error('captcha_answer')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="new-connect-submit-btn">
                        <span class="btn-text">Submit</span>
                        <span class="btn-icon">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15 10.8333V15.8333C15 16.2754 14.8244 16.6993 14.5118 17.0118C14.1993 17.3244 13.7754 17.5 13.3333 17.5H4.16667C3.72464 17.5 3.30072 17.3244 2.98816 17.0118C2.67559 16.6993 2.5 16.2754 2.5 15.8333V6.66667C2.5 6.22464 2.67559 5.80072 2.98816 5.48816C3.30072 5.17559 3.72464 5 4.16667 5H9.16667"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                                <path d="M12.5 2.5H17.5V7.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M8.33334 11.6667L17.5 2.5" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </button>
                </form>
            </div>

            {{-- Right Column: Image --}}
            <div class="new-connect-image-col">
                <img src="{{ asset('public/frontend/project-detail/assets/images/connect-img.svg') }}"
                    alt="Let's Connect" class="new-connect-img">
            </div>
        </div>
    </div>
</section>

{{-- Step 1: CDN library pehle load karo (standalone tag) --}}
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.7/build/js/intlTelInput.min.js"></script>
{{-- Step 2: Aapka existing script block, usme merge karke --}}
<script>
    // ===== intl-tel-input init =====
    const phoneInputField = document.querySelector("#connect-phone");
    const countryCodeField = document.querySelector("#country_code");

    const iti = window.intlTelInput(phoneInputField, {
        initialCountry: "in",
        preferredCountries: ["in", "us", "gb", "ae"],
        showSelectedDialCode: true,
        countrySearch: true, // search box explicitly on (default bhi true hai)
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.7/build/js/utils.js")
    });

    phoneInputField.addEventListener("countrychange", function() {
        const countryData = iti.getSelectedCountryData();
        countryCodeField.value = "+" + countryData.dialCode;
    });

    // ===== Captcha =====
    function loadMathCaptcha() {
        fetch("{{ route('captcha.math') }}")
            .then(res => res.json())
            .then(data => {
                document.getElementById('captchaQuestion').innerText = data.question;
                document.getElementById('captcha_answer').value = '';
            });
    }

    // ===== DOMContentLoaded (dono kaam yahin ek sath) =====
    document.addEventListener('DOMContentLoaded', function() {
        loadMathCaptcha();

        // intl-tel-input ka initial country code set karna
        const countryData = iti.getSelectedCountryData();
        countryCodeField.value = "+" + countryData.dialCode;

        // Auto-scroll to first server-side validation error (if any)
        const firstError = document.querySelector('.new-connect-form .text-danger');
        if (firstError) {
            firstError.closest('.new-connect-field-group').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }
    });

    document.getElementById('refreshCaptcha').addEventListener('click', loadMathCaptcha);

    // ===== Client-side validation =====
    function showError(inputEl, message) {
        clearError(inputEl);
        const errorEl = document.createElement('span');
        errorEl.className = 'text-danger js-error';
        errorEl.innerText = message;
        inputEl.closest('.new-connect-field-group').appendChild(errorEl);
        inputEl.style.borderColor = 'red';
    }

    function clearError(inputEl) {
        const group = inputEl.closest('.new-connect-field-group');
        const existing = group.querySelector('.js-error');
        if (existing) existing.remove();
        inputEl.style.borderColor = '';
    }

    document.getElementById('connectForm').addEventListener('submit', function(e) {
        e.preventDefault(); // ab hamesha default rokenge, khud control karenge submit

        let isValid = true;
        const form = this;

        const name = document.getElementById('connect-name');
        const phone = document.getElementById('connect-phone');
        const email = document.getElementById('connect-email');
        const captcha = document.getElementById('captcha_answer');

        // --- (yeh saare existing checks jaise-ke-taise rehne do) ---
        if (!name.value.trim()) {
            showError(name, 'Please enter your name.');
            isValid = false;
        } else if (!/^[a-zA-Z\s]+$/.test(name.value.trim())) {
            showError(name, 'Name must contain only letters.');
            isValid = false;
        } else {
            clearError(name);
        }

        if (!phone.value.trim()) {
            showError(phone, 'Please enter your contact number.');
            isValid = false;
        } else if (!/^[0-9]{8,15}$/.test(phone.value.trim())) {
          showError(phone, 'Contact number must be 8 to 15 digits only.');
            isValid = false;
        } else {
            clearError(phone);
        }

        if (!email.value.trim()) {
            showError(email, 'Please enter your email address.');
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            showError(email, 'Please enter a valid email address.');
            isValid = false;
        } else {
            clearError(email);
        }

        if (!captcha.value.trim()) {
            showError(captcha, 'Please answer the security question.');
            isValid = false;
        } else {
            clearError(captcha);
        }

        if (!isValid) return; // basic checks hi fail ho gaye, aage mat badho

        // --- Naya hissa: captcha ko server se AJAX verify karo ---
        const token = document.querySelector('#connectForm input[name="_token"]').value;

        fetch("{{ route('captcha.verifyMath') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    captcha_answer: captcha.value.trim()
                })
            })
            .then(res => res.json())
            .then(data => {
                if (!data.valid) {
                    showError(captcha, 'Incorrect answer. Please try again.');
                    loadMathCaptcha(); // naya question aa jaayega, page reload nahi hoga
                    captcha.focus();
                } else {
                    clearError(captcha);
                    HTMLFormElement.prototype.submit.call(
                    form); // ab asli submit — page navigate karega save + thank-you redirect ke liye
                }
            })
            .catch(() => {
                showError(captcha, 'Something went wrong verifying captcha. Please try again.');
            });
    });
</script>


{{-- ================= LOADING / ERROR OVERLAYS ================= --}}
<div id="loading-screen">
    <div id="loading-text">Loading... 0%</div>
</div>
<div id="error-message">Failed to load the 3D model. Please check the file path.</div>

@push('scripts')
    <script type="module" src="{{ asset('public/frontend/project-detail/js/script.js') }}"></script>
@endpush

@include('layouts.frontfooter')
