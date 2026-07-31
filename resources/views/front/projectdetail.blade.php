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
<section class="hero">
    <div class="hero-bg-line"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="hero-content">
            <h1>{!! nl2br(e($project->hero_heading)) !!}</h1>
            <p>{!! strip_tags($project->hero_description) !!}</p>
        </div>
    </div>

    @if($project->hero_model)
        <div id="canvas-container" class="threejs-model-container"
             data-model="{{ asset('public/newportfolio/hero_models/' . $project->hero_model) }}">
            <div id="zoom-hint" style="display: none;">
                <svg class="mouse-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="6" y="3" width="12" height="18" rx="6" stroke="currentColor" stroke-width="2"/>
                    <circle class="scroll-wheel" cx="12" cy="9" r="2" fill="currentColor"/>
                </svg>
                <span class="hint-text">Click to Zoom</span>
            </div>
        </div>
    @endif
</section>

{{-- ================= FULL WIDTH BANNER ================= --}}
@if($project->banner_image)
<section class="full-width-banner">
    <img src="{{ asset('public/newportfolio/banners/' . $project->banner_image) }}" alt="{{ $project->name }}">
</section>
@endif

{{-- ================= OVERVIEW / INDUSTRY / SERVICES / CHALLENGES-APPROACH ================= --}}
<section class="project-details-section">
    <div class="container">
        <div class="details-row top-row">
            <div class="overview-col">
                <h3>OVERVIEW</h3>
                <p>{!! $project->overview_description !!}</p>
            </div>
            @if($industryNames->count())
            <div class="industry-col">
                <h3>INDUSTRY</h3>
                <p>{!! $industryNames->implode('<br>') !!}</p>
            </div>
            @endif
        </div>

        @if($servicesList && count($servicesList))
        <div class="details-row services-row">
            <h3>SERVICES</h3>
            <div class="services-tags">
                @foreach($servicesList as $service)
                    <span class="tag">{{ $service }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <div class="details-row bottom-row">
            @if($project->challenge_description)
            <div class="challenges-col">
                <h3>CHALLENGES</h3>
                {!! $project->challenge_description !!}
            </div>
            @endif
            @if($project->approach_description)
            <div class="approach-col">
                <h3>APPROACH</h3>
                {!! $project->approach_description !!}
            </div>
            @endif
        </div>
    </div>
</section>

{{-- ================= GALLERY ================= --}}
@if($project->gallery_heading || $project->gallery_description || $galleryGroups->count())
<section class="golden-harbour-section">
    <div class="container">
        @if($project->gallery_heading || $project->gallery_description)
        <div class="brand-text-header">
            @if($project->gallery_heading)<h2>{!! nl2br(e($project->gallery_heading)) !!}</h2>@endif
            @if($project->gallery_description){!! $project->gallery_description !!}@endif
        </div>
        @endif

        {{-- First gallery group: shown with no title, images only, matching "Brand Experience Grid" style --}}
        @if($galleryGroups->count() > 0)
            @php $firstGroup = $galleryGroups[0]; @endphp
            @foreach($firstGroup as $item)
                @if(in_array($item->media_type, ['image', 'gif']))
                    <img src="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}" alt="{{ $project->name }}" class="brand-grid-image">
                @elseif($item->media_type === 'video')
                    <video src="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}" class="brand-grid-image" controls></video>
                @endif
            @endforeach
        @endif
    </div>
</section>
@endif

{{-- ================= REMAINING GALLERY GROUPS (2nd onward) ================= --}}
@if($galleryGroups->count() > 1)
    @foreach($galleryGroups->slice(1) as $group)
        @php
            $groupTitle = $group->first()->title;
            $has3dModel = $group->contains(fn($item) => in_array($item->media_type, ['glb', 'gltf']));
        @endphp

        <section class="products-showcase-section mt_100">
            <div class="container">
                @if($groupTitle)
                    <h2 class="section-heading">{{ $groupTitle }}</h2>
                @endif

                @if($has3dModel)
                    {{-- 3D model group: render each model in its own viewer, grid style like Product Series 01 --}}
                    <div class="products-grid">
                        @foreach($group as $item)
                            @if(in_array($item->media_type, ['glb', 'gltf']))
                                <div class="product-card">
                                    <div class="threejs-model-container" data-model="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}"></div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    {{-- Image/video group: full-width showcase image(s), same style as Product Series 02-05 --}}
                    @foreach($group as $item)
                        @if(in_array($item->media_type, ['image', 'gif']))
                            <img src="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}" alt="{{ $groupTitle ?? $project->name }}" class="products-showcase-image">
                        @elseif($item->media_type === 'video')
                            <video src="{{ asset('public/newportfolio/media/' . $item->media_type . '/' . $item->file_path) }}" class="products-showcase-image" controls></video>
                        @endif
                    @endforeach
                @endif
            </div>
        </section>
    @endforeach
@endif

{{-- ================= LOADING / ERROR OVERLAYS ================= --}}
<div id="loading-screen">
    <div id="loading-text">Loading... 0%</div>
</div>
<div id="error-message">Failed to load the 3D model. Please check the file path.</div>

@push('scripts')
    <script type="module" src="{{ asset('public/frontend/project-detail/js/script.js') }}"></script>
@endpush

@include('layouts.frontfooter')
