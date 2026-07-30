@include('layouts.frontheader')

<style>
    .grey_btn { transition: all 0.3s ease; }
    .grey_btn.active {
        background-color: #9D9CC2 !important;
        color: #fff !important;
        border-color: #9D9CC2 !important;
    }
    .grey_btn.active svg { filter: brightness(0.5); }

    .error-text {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 8px;
        display: block;
        font-weight: 500;
    }

    /* SKY BLUE BORDER 100% HATANE KA CODE */
    .form-control,
    input[type="text"],
    input[type="email"],
    input[type="tel"] {
        border: none !important;
        
        border-radius: 0 !important;
        box-shadow: none !important;
        outline: none !important;
        background: transparent !important;
        padding: 12px 0 !important;
        font-size: 16px;
    }
    
   

/* FORCE REMOVE CHROME BLUE AUTOFILL */
input:-webkit-autofill,
input:-webkit-autofill:focus,
input:-webkit-autofill:hover,
textarea:-webkit-autofill,
select:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px #fff inset !important;
    box-shadow: 0 0 0 1000px #fff inset !important;
    -webkit-text-fill-color: #000 !important;
}

    
</style>

<section>
    <div class="contact_hero">
        <div class="container">
            <h2 class="title_72">Start Your Project</h2>
        </div>
    </div>
</section>

<section class="contact">
    <div class="container">
        <form method="POST" action="{{ route('contact.store') }}" id="contactForm" novalidate>
            @csrf
            <div class="row gx-md-5">
                <div class="col-12 col-md-6">
                    <div class="inputs_field">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>Your Name*</span>
                        </label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}"
                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();" maxlength="70">
                        
                    </div>
                    <span class="error-text" id="error-name"></span>
                </div>
                <div class="col-12 col-md-6">
                    <div class="inputs_field">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>Company Name*</span>
                        </label>
                        <input type="text" name="company_name" class="form-control" placeholder="Enter your company name" value="{{ old('company_name') }}" maxlength="70">
                        
                    </div>
                    <span class="error-text" id="error-company"></span>
                </div>
                <div class="col-12 col-md-6">
                    <div class="inputs_field">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>Your Email*</span>
                        </label>
                        <input 
                        type="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}">
                    </div>
                    <span class="error-text" id="error-email"></span>
                </div>
                <div class="col-12 col-md-6">
                    <div class="inputs_field">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>Contact No.*</span>
                        </label>
                        <input type="text" name="number" class="form-control" placeholder="Enter your contact number" value="{{ old('number') }}"
                         oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,15);">
                    </div>
                    <span class="error-text" id="error-number"></span>
                </div>
                <div class="col-12 col-md-12">
                    <div class="inputs_field">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>What are you looking for?*</span>
                        </label>

                        <div class="met_ind_right_btns my-0" id="services-container">

                            <a href="#" class="grey_btn" data-value="Brand Strategy & Identity">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>Brand Strategy & Identity</span>
                            </a>
                            <a href="#" class="grey_btn" data-value="Creative Design">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>Creative Design</span>
                            </a>
                            <a href="#" class="grey_btn" data-value="Web Design & Development">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>Web Design & Development</span>
                            </a>
                            <a href="#" class="grey_btn" data-value="E-Commerce Solutions">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>E-Commerce Solutions</span>
                            </a>
                            <a href="#" class="grey_btn" data-value="3D Modeling">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>3D Modeling</span>
                            </a>
                            <a href="#" class="grey_btn" data-value="Content Creation & Campaigns">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>Content Creation & Campigns</span>
                            </a>
                            <a href="#" class="grey_btn" data-value="Photography">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>Photography</span>
                            </a>
                            <a href="#" class="grey_btn" data-value="Packaging Design">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>Packaging Design</span>
                            </a>
                            <a href="#" class="grey_btn" data-value="Social Media Strategy">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                    </svg>
                                </span>
                                <span>Social Media Strategy </span>
                            </a>

                        </div>

                        <p class="sub_head mb-0"><span class="text-muted">Others:</span> 
                            <input type="text" name="other_service_details" placeholder="Please specify if needed" value="{{ old('other_service_details') }}">
                        </p>
                        
                    </div>
                    <span class="error-text" id="error-services"></span>
                </div>

                <input type="hidden" name="interested_in" id="selected_services">
                <input type="hidden" name="timeline" id="selected_timeline">
                <input type="hidden" name="budget" id="selected_budget">

                <div class="col-12 col-md-12">
                    <div class="inputs_field">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>Tell us about your project</span>
                        </label>
                        <input type="text" name="project_description" class="form-control" placeholder="a short description of what you need and your vision for your brand." value="{{ old('project_description') }}">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="inputs_field">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>Are you starting a new venture or aiming to grow your current business?*</span>
                        </label>
                        <input type="text" name="venture_or_growth" class="form-control" placeholder="are you beginning fresh, or do you want to elevate your existing brand/business?" value="{{ old('venture_or_growth') }}">
                    </div>
                    <span class="error-text" id="error-venture"></span>
                </div>
                <!-- TIMELINE SECTION -->
                <div class="col-12 col-md-12">
                    <div class="inputs_field border-0 pb-0">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>What is your expected timeline to begin?*</span>
                        </label>
                
                        <div class="met_ind_right_btns my-0">
                            <a href="#" class="grey_btn timeline_btn" data-value="As soon as possible">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                </svg></span>
                                <span>As soon as possible</span>
                            </a>
                            <a href="#" class="grey_btn timeline_btn" data-value="1-2 Months">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                </svg></span>
                                <span>1-2 Months</span>
                            </a>
                            <a href="#" class="grey_btn timeline_btn" data-value="3+ Months">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                </svg></span>
                                <span>3+ Months</span>
                            </a>
                            <a href="#" class="grey_btn timeline_btn" data-value="Still in the exploration phase">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                </svg></span>
                                <span>Still in the exploration phase</span>
                            </a>
                        </div>
                    </div>
                    <span class="error-text" id="error-timeline"></span>
                </div>

                <!-- BUDGET SECTION -->
                <div class="col-12 col-md-12">
                    <div class="inputs_field border-0 pb-0">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>What’s your budget range?*</span>
                        </label>
                
                        <div class="met_ind_right_btns my-0">
                            <a href="#" class="grey_btn budget_btn" data-value="₹50K - ₹100K">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                </svg></span>
                                <span>₹50K - ₹100K</span>
                            </a>
                            <a href="#" class="grey_btn budget_btn" data-value="₹100K - ₹200K">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                </svg></span>
                                <span>₹100K - ₹200K</span>
                            </a>
                            <a href="#" class="grey_btn budget_btn" data-value="₹200K +">
                                <span><svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="4" cy="4" r="4" fill="#9D9CC2" />
                                </svg></span>
                                <span>₹200K +</span>
                            </a>
                        </div>
                    </div>
                    <span class="error-text" id="error-budget"></span>
                </div>
                <div class="col-12 col-md-12">
                    <div class="inputs_field mb-0">
                        <label class="title_24">
                            <span><img src="{{ asset('public/front/images/right_arrow.svg') }}" alt="arrow-right"></span>
                            <span>Any extra details that could help us better assist you?</span>
                        </label>
                         <input type="text" name="extra_details" class="form-control" placeholder="tell us about your brand, your vision, or anything else you’d like us to consider." value="{{ old('extra_details') }}">
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-auto">
                    <img id="captcha-image" src="{{ route('captcha.image') }}" alt="CAPTCHA" style="height: 45px; border: 1px solid #ccc; border-radius: 6px;">
                </div>
                <div class="col-auto">
                    <svg style="cursor: pointer;" id="reload-captcha" width="23" height="20" viewBox="0 0 23 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.539 9.54947C19.539 4.46972 15.5667 0.755859 10.4869 0.755859C5.40715 0.755859 1.34335 4.81966 1.34335 9.89941C1.34335 14.9792 5.40715 19.043 10.4869 19.043C12.9252 19.043 14.9571 18.027 16.5826 16.6047" stroke="#333333" stroke-miterlimit="10" stroke-linecap="round"/>
                        <path d="M21.5833 5.86837L19.589 9.66244L15.4799 8.32953" stroke="#333" stroke-miterlimit="10" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="col-auto">
                    <input 
                        type="text" 
                        name="captcha" 
                        id="captcha-input" 
                        placeholder="Enter code" 
                        maxlength="5" 
                    
                        style="width: 130px;border: 1px solid #ddd !important;
                        padding: 9px 10px !important;
                        border-radius: 5px !important;" 
                        autocomplete="off">
                </div>
                <div class="col-12">
                    <small id="captcha-error" class="text-danger" style="display: none; font-weight: 500;"></small>
                </div>
            </div>

            <button type="submit" class="head_btn" alt="Start a Project">
                <span class="btn-text">Submit</span>
                <span class="btn-icon"><svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M18.75 11.1346V17.3654C18.75 17.7326 18.6041 18.0848 18.3445 18.3445C18.0848 18.6041 17.7326 18.75 17.3654 18.75H2.13462C1.76739 18.75 1.41521 18.6041 1.15554 18.3445C0.895879 18.0848 0.75 17.7326 0.75 17.3654V2.13462C0.75 1.76739 0.895879 1.41521 1.15554 1.15554C1.41521 0.895879 1.76739 0.75 2.13462 0.75H8.36538"
                            stroke="#0A101C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.9039 0.750034H18.7501V5.59619" stroke="#0A101C" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18.7499 0.750034L9.74988 9.75003" stroke="#0A101C" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </button>
        </form>
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    
    const disposableDomains = [
    'mailinator.com', '10minutemail.com', 'guerrillamail.com', 'tempmail.com',
    'temp-mail.org', 'throwawaymail.com', 'maildrop.cc', 'dispostable.com',
    'getairmail.com', 'moakt.com', 'spamgourmet.com', 'yopmail.com',
    'sharklasers.com', 'mailnesia.com', 'fakemail.net', 'emailondeck.com',
    'trashmail.com', 'mintemail.com', 'mytemp.email'
];


    const form = document.getElementById('contactForm');
    const selected = { services: new Set(), timeline: null, budget: null };

    const errorEls = {
        name: document.getElementById('error-name'),
        company: document.getElementById('error-company'),
        email: document.getElementById('error-email'),
        number: document.getElementById('error-number'),
        services: document.getElementById('error-services'),
        venture: document.getElementById('error-venture'),
        timeline: document.getElementById('error-timeline'),
        budget: document.getElementById('error-budget'),
        captcha: document.getElementById('captcha-error')
    };

    const captchaImage = document.getElementById('captcha-image');
    const captchaInput = document.getElementById('captcha-input');
    const reloadBtn = document.getElementById('reload-captcha');

    let currentCaptchaCode = null;

    function loadCaptcha() {
        fetch('{{ route('captcha.image') }}?' + new Date().getTime(), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            captchaImage.src = data.image;
            currentCaptchaCode = data.code;
            captchaInput.value = '';
            errorEls.captcha.style.display = 'none';
        })
        .catch(err => console.error('Captcha load error:', err));
    }

    reloadBtn.addEventListener('click', e => { e.preventDefault(); loadCaptcha(); });
    captchaInput.addEventListener('input', () => errorEls.captcha.style.display = 'none');
    loadCaptcha();

    function updateHidden() {
        document.getElementById('selected_services').value = Array.from(selected.services).join(', ');
        document.getElementById('selected_timeline').value = selected.timeline || '';
        document.getElementById('selected_budget').value = selected.budget || '';
    }

    function hideError(el) { if (el) el.style.display = 'none'; }
    function showError(el, msg) { if (el) { el.textContent = msg; el.style.display = 'block'; } }

    // =============== SMART LIVE VALIDATION ===============
    // Jab type kare → error hide, jab delete karke khaali kare → error wapas show

    ['name', 'company_name', 'email', 'number', 'venture_or_growth'].forEach(fieldName => {
    const input = document.querySelector(`[name="${fieldName}"]`);
    if (input) {
        input.addEventListener('input', function() {
            let errorKey;
            if (fieldName === 'company_name') errorKey = 'company';
            else if (fieldName === 'venture_or_growth') errorKey = 'venture';
            else errorKey = fieldName;

            const errorEl = errorEls[errorKey];
            const value = this.value.trim();

            // 🔹 CONTACT NUMBER VALIDATION
            if (fieldName === 'number') {
                if (value === '') {
                    showError(errorEl, 'Contact number is required');
                } else if (value.length < 10 || value.length > 15) {
                    showError(errorEl, 'Contact number must be 10 to 15 digits');
                } else {
                    hideError(errorEl);
                }
                return;
            }
            
            if (fieldName === 'email') {
    if (value === '') {
        showError(errorEl, 'Email is required');
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
        showError(errorEl, 'Please enter a valid email address');
    } else {
        const domain = value.split('@')[1]?.toLowerCase();
        if (disposableDomains.includes(domain)) {
            showError(errorEl, 'Dispossable email addresses are not allowed');
        } else {
            hideError(errorEl);
        }
    }
    return;
}

            // 🔹 OTHER FIELDS
            if (value === '') {
                const msg =
                    fieldName === 'name' ? 'Name is required' :
                    fieldName === 'company_name' ? 'Company name is required' :
                    
                    'This field is required';

                showError(errorEl, msg);
            } else {
                hideError(errorEl);
            }
        });
    }
});


    // Services - koi select ho to error hide, sab deselect to error show (submit par check hoga)
    document.querySelectorAll('#services-container .grey_btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (selected.services.size > 0) {
                hideError(errorEls.services);
            }
            // Note: Agar sab deselect kar diya to error submit par hi aayega
        });
    });

    // Timeline & Budget - select karne par error hide
    document.querySelectorAll('.timeline_btn, .budget_btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const isTimeline = btn.classList.contains('timeline_btn');
            hideError(isTimeline ? errorEls.timeline : errorEls.budget);
        });
    });

    // =============== BUTTON SELECTION ===============
    document.querySelectorAll('.grey_btn:not(.timeline_btn):not(.budget_btn)').forEach(btn => {
        btn.addEventListener('click', e => {
            e.preventDefault();
            const val = btn.getAttribute('data-value');
            if (selected.services.has(val)) {
                selected.services.delete(val);
                btn.classList.remove('active');
            } else {
                selected.services.add(val);
                btn.classList.add('active');
            }
            updateHidden();
        });
    });

    ['timeline_btn', 'budget_btn'].forEach(className => {
        document.querySelectorAll('.' + className).forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault();
                document.querySelectorAll('.' + className).forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                const value = btn.getAttribute('data-value');
                if (className === 'timeline_btn') selected.timeline = value;
                else selected.budget = value;
                updateHidden();
            });
        });
    });

    // =============== FORM SUBMIT ===============
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        let valid = true;

        Object.values(errorEls).forEach(el => el && (el.style.display = 'none'));

        const get = (name) => document.querySelector(`[name="${name}"]`)?.value.trim() || '';

        if (!get('name')) showError(errorEls.name, 'Name is required'), valid = false;
        if (!get('company_name')) showError(errorEls.company, 'Company name is required'), valid = false;
        const numberVal = get('number');

            if (!numberVal) {
                showError(errorEls.number, 'Contact number is required');
                valid = false;
            } else if (numberVal.length < 10 || numberVal.length > 15) {
                showError(errorEls.number, 'Contact number must be 10 to 15 digits');
                valid = false;
            }
            
        const emailVal = get('email');

if (!emailVal) {
    showError(errorEls.email, 'Email is required');
    valid = false;
} else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailVal)) {
    showError(errorEls.email, 'Please enter a valid email address');
    valid = false;
} else {
    const domain = emailVal.split('@')[1]?.toLowerCase();
    if (disposableDomains.includes(domain)) {
        showError(errorEls.email, 'Dispossable email addresses are not allowed');
        valid = false;
    }
}


        if (!get('venture_or_growth')) showError(errorEls.venture, 'This field is required'), valid = false;
        

        if (selected.services.size === 0) showError(errorEls.services, 'Please select at least one service'), valid = false;
        if (!selected.timeline) showError(errorEls.timeline, 'Please select a timeline'), valid = false;
        if (!selected.budget) showError(errorEls.budget, 'Please select a budget range'), valid = false;

        const userCaptcha = captchaInput.value.trim();
        if (!userCaptcha) {
            showError(errorEls.captcha, 'Please enter the CAPTCHA code');
            valid = false;
        } else if (currentCaptchaCode && userCaptcha !== currentCaptchaCode) {
            showError(errorEls.captcha, 'Please enter the right CAPTCHA');
            loadCaptcha();
            valid = false;
        }

        if (valid) {
            form.submit();
        } else {
            document.querySelector('.error-text[style*="block"], .text-danger[style*="block"]')
                ?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    });
});
</script>
@include('layouts.frontfooter')