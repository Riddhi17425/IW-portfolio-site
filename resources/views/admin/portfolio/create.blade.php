@extends('admin.layouts.app')
@section('title', 'Add Portfolio Project')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <div class="card-header py-3 bg-transparent border-bottom">
                <h3 class="fw-bold mb-0">Add Portfolio Project</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('portfolio.store') }}">
            @csrf
            <div class="card mb-3 p-3">
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Project Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" value="{{ old('url') }}">
                        @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Hero heading / description --}}
                    <div class="col-md-12">
                        <label class="form-label">Hero Heading</label>
                       <textarea name="hero_heading" class="form-control" rows="3" placeholder="Press Enter to control line breaks">{{ old('hero_heading') }}</textarea>
                        @error('hero_heading') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Hero Description</label>
                        <textarea name="hero_description" class="form-control summernote">{{ old('hero_description') }}</textarea>
                        @error('hero_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Hero 3D model --}}
                    <div class="col-md-6">
                        <label class="form-label">Hero 3D Model (.glb / .gltf only)</label>
                        <input type="file" id="heroModelInput" name="hero_model" class="form-control" accept=".glb,.gltf">
                        @error('hero_model') <span class="text-danger">{{ $message }}</span> @enderror
                        <div id="heroModelPreviewWrap" class="mt-2" style="display:none;">
                            <model-viewer id="heroModelPreview" camera-controls auto-rotate style="width:220px;height:180px;"></model-viewer>
                        </div>
                    </div>

                    {{-- Banner image --}}
                   <div class="col-md-6">
                    <label class="form-label">Banner Image</label>
                    <input type="file" id="bannerImageInput" name="banner_image" class="form-control dropify" accept="image/*">
                    @error('banner_image') <span class="text-danger">{{ $message }}</span> @enderror

                    <div id="bannerImagePreviewWrap" class="mt-2" style="display:none;">
                        <img id="bannerImagePreview" src="" style="max-height:140px;border-radius:8px;border:1px solid #e2e2e2;">
                    </div>
                </div>

                <div class="col-md-6">
                <label class="form-label">Listing Image</label>
                <input type="file" id="listingImageInput" name="listing_image" class="form-control dropify" accept="image/*">
                @error('listing_image') <span class="text-danger">{{ $message }}</span> @enderror

                <div id="listingImagePreviewWrap" class="mt-2" style="display:none;">
                    <img id="listingImagePreview" src="" style="max-height:140px;border-radius:8px;border:1px solid #e2e2e2;">
                </div>
            </div>

                    {{-- Overview --}}
                    <div class="col-md-12">
                        <label class="form-label">Overview Description</label>
                        <textarea name="overview_description" class="form-control summernote">{{ old('overview_description') }}</textarea>
                        @error('overview_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Industry multiselect --}}
                    <div class="col-md-6 position-relative">
                        <label class="form-label">Industry</label>
                        <button type="button"
                            class="btn btn-outline-secondary w-100 text-start d-flex justify-content-between align-items-center"
                            id="industryDropdownBtn">
                            Select Industries
                            <span>▼</span>
                        </button>
                        <div id="industryCheckboxDropdown"
                             class="border rounded bg-white position-absolute mt-1 w-100"
                             style="display:none; max-height: 180px; overflow-y: auto; z-index: 1050;">
                            @foreach($industries as $indus)
                                <div class="form-check px-3 py-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="industry_id[]"
                                           id="indus{{ $indus->id }}"
                                           value="{{ $indus->id }}"
                                           {{ collect(old('industry_id', []))->contains($indus->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="indus{{ $indus->id }}">{{ $indus->title }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('industry_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Services tag input --}}
                    <div class="col-md-6">
                        <label class="form-label">Services</label>
                        <div id="servicesTagWrapper" class="form-control d-flex flex-wrap align-items-center" style="min-height:44px;">
                            <input type="text" id="servicesTagInput" class="border-0 flex-grow-1" style="outline:none; min-width:120px;" placeholder="Type a service and press Enter">
                        </div>
                        <input type="hidden" id="servicesHidden" name="services" value="{{ old('services') }}">
                        @error('services') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Challenge / Approach --}}
                    <div class="col-md-12">
                        <label class="form-label">Challenge Description</label>
                        <textarea name="challenge_description" class="form-control summernote">{{ old('challenge_description') }}</textarea>
                        @error('challenge_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Approach Description</label>
                        <textarea name="approach_description" class="form-control summernote">{{ old('approach_description') }}</textarea>
                        @error('approach_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Gallery title / description --}}
                    <div class="col-md-12">
                        <label class="form-label">Gallery Title</label>
                        <input type="text" name="gallery_heading" class="form-control" value="{{ old('gallery_heading') }}">
                        @error('gallery_heading') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Gallery Description</label>
                        <textarea name="gallery_description" class="form-control summernote">{{ old('gallery_description') }}</textarea>
                        @error('gallery_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" {{ old('status', 1) ? 'checked' : '' }}>
                            <label class="form-check-label" for="statusSwitch">Active</label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Media repeater --}}
           <div class="card mb-3 p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Media Items</h5>
                    <button type="button" id="mediaAddGlobal" class="btn btn-success btn-sm">+ Add Media</button>
                </div>
                <div id="media-rows">
                    <div class="row g-3 align-items-center media-row border-bottom pb-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="media[0][title]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Type</label>
                            <select name="media[0][type]" class="form-control media-type-select">
                                <option value="">Select Type</option>
                                @foreach($mediaTypes as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">File</label>
                           <input type="file" name="media[0][file][]" class="form-control media-file-input" multiple>
                            <div class="media-preview-wrap mt-2"></div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end gap-2">
                            <button type="button" class="btn btn-danger btn-sm media-remove" style="display:none;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary px-5">Save</button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/admin/dist/assets/plugin/dropify/dist/css/dropify.min.css') }}">
<style>
.media-preview-wrap {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}
.media-thumb {
    position: relative;
    width: 90px;
    height: 90px;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e2e2e2;
    box-shadow: 0 2px 6px rgba(0,0,0,.08);
    background: #f8f9fa;
    transition: transform .15s ease;
}
.media-thumb:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,.15);
}
.media-thumb img,
.media-thumb video,
.media-thumb model-viewer {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.media-thumb .thumb-remove {
    position: absolute;
    top: 3px;
    right: 3px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: rgba(220, 53, 69, .92);
    color: #fff;
    border: none;
    font-size: 13px;
    line-height: 1;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    z-index: 2;
}
.media-thumb .thumb-remove:hover {
    background: #dc3545;
}
.media-thumb .thumb-badge {
    position: absolute;
    bottom: 3px;
    left: 3px;
    background: rgba(0,0,0,.65);
    color: #fff;
    font-size: 9px;
    padding: 1px 5px;
    border-radius: 4px;
    text-transform: uppercase;
    letter-spacing: .3px;
}
.media-file-count {
    font-size: 12px;
    color: #6c757d;
    margin-top: 4px;
}
#statusSwitch {
    width: 3.2em;
    height: 1.6em;
    cursor: pointer;
}
.form-check.form-switch {
    padding-left: 3.5em;
    display: flex;
    align-items: center;
    gap: 10px;
}
.form-check.form-switch .form-check-label {
    font-size: 1rem;
    cursor: pointer;
}
</style>
@endpush

@push('scripts')
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/4.0.0/model-viewer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="{{ asset('public/admin/dist/assets/bundles/dropify.bundle.js') }}"></script>
<script>
$(document).ready(function () {
    if ($.fn.summernote) { $('.summernote').summernote({ height: 200 }); }
    if ($.fn.dropify) { $('.dropify').dropify(); }
});
</script>
<script src="{{ asset('public/admin/js/portfolio/portfolio-form.js') }}"></script>
@endpush
