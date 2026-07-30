@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/project-detail/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/project-detail/css/responsive.css') }}">
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
<section class="hero">
    <div class="hero-bg-line"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="hero-content">
            <h1>BUILDING A<br>GLOBAL DIGITAL<br>IDENTITY FOR</h1>
            <p>AN INDUSTRIAL ENGINEERING LEADER</p>
        </div>
    </div>

    <div id="canvas-container" class="threejs-model-container"
         data-model="{{ asset('frontend/project-detail/assets/models/DOUBLE-GIMBAL-ASSEM.glb') }}">
        <div id="zoom-hint" style="display: none;">
            <svg class="mouse-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="6" y="3" width="12" height="18" rx="6" stroke="currentColor" stroke-width="2"/>
                <circle class="scroll-wheel" cx="12" cy="9" r="2" fill="currentColor"/>
            </svg>
            <span class="hint-text">Click to Zoom</span>
        </div>
    </div>
</section>

{{-- ================= FULL WIDTH BANNER ================= --}}
<section class="full-width-banner">
    <img src="{{ asset('frontend/project-detail/assets/images/Web-Banner.jpg') }}" alt="Full Width Banner">
</section>

{{-- ================= OVERVIEW / INDUSTRY / SERVICES / CHALLENGES-APPROACH ================= --}}
<section class="project-details-section">
    <div class="container">
        <div class="details-row top-row">
            <div class="overview-col">
                <h3>OVERVIEW</h3>
                <p>Flexibel is a UAE-based manufacturer specializing in high-performance metallic expansion joints, rubber expansion joints, fabric expansion joints, metal hoses, and engineered piping solutions. Serving industries such as power, oil & gas, marine, HVAC, cement, and process industries, the company delivers customized solutions.</p>
            </div>
            <div class="industry-col">
                <h3>INDUSTRY</h3>
                <p>Manufacturing &<br>Industrial Engineering</p>
            </div>
        </div>

        <div class="details-row services-row">
            <h3>SERVICES</h3>
            <div class="services-tags">
                <span class="tag">Branding & Visual Identity</span>
                <span class="tag">Graphic Design & Marketing Collaterals</span>
                <span class="tag">Social Media Management</span>
                <span class="tag">Website Design & Development</span>
                <span class="tag">3D Product Texturing & Rendering</span>
                <span class="tag">Lead Generation Strategy</span>
                <span class="tag">SEO & Organic Visibility</span>
                <span class="tag">Exhibition & Expo Support</span>
            </div>
        </div>

        <div class="details-row bottom-row">
            <div class="challenges-col">
                <h3>CHALLENGES</h3>
                <ul>
                    <li>Complex industrial products required a simplified yet technically accurate presentation.</li>
                    <li>Existing digital assets failed to communicate the brand's engineering expertise effectively.</li>
                    <li>Previous website attempts lacked scalability, user experience, and search visibility.</li>
                    <li>Limited visual content made it difficult to showcase highly technical products digitally.</li>
                    <li>Needed a unified brand identity across online and offline marketing platforms.</li>
                </ul>
            </div>
            <div class="approach-col">
                <h3>APPROACH</h3>
                <ul>
                    <li>Built a modern, technically structured website focused on user experience and product discoverability.</li>
                    <li>Developed a consistent brand language across digital, print, and social media platforms.</li>
                    <li>Created high-quality 3D product renders to communicate complex engineering solutions visually.</li>
                    <li>Designed marketing collaterals that balanced technical specifications with clean, engaging design.</li>
                    <li>Implemented an SEO-focused website architecture to strengthen organic visibility and global reach.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ================= BRAND EXPERIENCE GRID ================= --}}
<section class="golden-harbour-section">
    <div class="container">
        <div class="brand-text-header">
            <h2>Creating a Consistent<br>Brand Experience</h2>
            <p>A cohesive visual identity was developed across print, digital, and corporate communication, ensuring every customer interaction reinforced the brand's technical expertise and professionalism.</p>
        </div>
        <img src="{{ asset('frontend/project-detail/assets/images/image 136eradf.png') }}" alt="Brand Experience Grid" class="brand-grid-image">
    </div>
</section>

{{-- ================= PRODUCT SERIES 01 (3D models grid) ================= --}}
<section class="products-showcase-section mt_100">
    <div class="container">
        <h2 class="section-heading">PRODUCT SERIES 01</h2>

        <div class="products-grid">
            <div class="product-card">
                <div class="threejs-model-container" data-model="{{ asset('frontend/project-detail/assets/models/DOUBLE-GIMBAL-ASSEM.glb') }}"></div>
            </div>
            <div class="product-card">
                <div class="threejs-model-container" data-model="{{ asset('frontend/project-detail/assets/models/DOUBLE-HINGED.glb') }}"></div>
            </div>
            <div class="product-card">
                <div class="threejs-model-container" data-model="{{ asset('frontend/project-detail/assets/models/DOUBLE-MITER-RECTANGULAR-EXPANSION-JOINT.glb') }}"></div>
            </div>
            <div class="product-card">
                <div class="threejs-model-container" data-model="{{ asset('frontend/project-detail/assets/models/EXTERNALLLY-PRESSURIZED.glb') }}"></div>
            </div>
            <div class="product-card">
                <div class="threejs-model-container" data-model="{{ asset('frontend/project-detail/assets/models/PANTOGRAPGHIC-EXPANSION-JOINT.glb') }}"></div>
            </div>
        </div>
    </div>
</section>

{{-- ================= PRODUCT SERIES 02-05 ================= --}}
<section class="products-showcase-section mt_100">
    <div class="container">
        <h2 class="section-heading">Product Series 02</h2>
        <img src="{{ asset('frontend/project-detail/assets/images/image 132.png') }}" alt="Expansion Joints Showcase 2" class="products-showcase-image">
    </div>
</section>

<section class="products-showcase-section mt_100">
    <div class="container">
        <h2 class="section-heading">Product Series 03</h2>
        <img src="{{ asset('frontend/project-detail/assets/images/image 133.png') }}" alt="Expansion Joints Showcase 3" class="products-showcase-image">
    </div>
</section>

<section class="products-showcase-section mt_100">
    <div class="container">
        <h2 class="section-heading">Product Series 04</h2>
        <img src="{{ asset('frontend/project-detail/assets/images/image 134.png') }}" alt="Expansion Joints Showcase 4" class="products-showcase-image">
    </div>
</section>

<section class="products-showcase-section mt_100">
    <div class="container">
        <h2 class="section-heading">Product Series 05</h2>
        <img src="{{ asset('frontend/project-detail/assets/images/image 135.png') }}" alt="Expansion Joints Showcase 5" class="products-showcase-image">
    </div>
</section>

{{-- ================= LOADING / ERROR OVERLAYS ================= --}}
<div id="loading-screen">
    <div id="loading-text">Loading... 0%</div>
</div>
<div id="error-message">Failed to load the 3D model. Please check the file path.</div>

@push('scripts')
    <script type="module" src="{{ asset('frontend/project-detail/js/script.js') }}"></script>
@endpush

@include('layouts.frontfooter')
