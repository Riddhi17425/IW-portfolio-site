@extends('admin.layouts.app')
@section('title', 'Edit Project')
@section('content')
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h3 class="fw-bold mb-0">Edit Project</h3>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" enctype="multipart/form-data" action="{{ route('product.update', $product->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-3">
                            <div class="row g-3 align-items-center mt-2">
                <div class="col-md-6 position-relative">
    <label class="form-label">Category</label>
    
    <button type="button" 
        class="btn btn-outline-secondary w-100 text-start d-flex justify-content-between align-items-center"
        onclick="toggleCheckboxDropdown()"
        id="dropdownBtn">
        Select Categories
        <span>▼</span>
    </button>
    
    <div id="checkboxDropdown" 
         class="border rounded bg-white position-absolute mt-1 w-100"
         style="display:none; max-height: 180px; overflow-y: auto; z-index: 1050;">
         
        @php
    $selectedCats = old(
        'category_id',
        explode(',', $product->category_id ?? '')
    );
@endphp


       @foreach($categories as $cat)
    <div class="form-check px-3 py-1">
        <input class="form-check-input" type="checkbox" 
               name="category_id[]" 
               id="cat{{ $cat->id }}" 
               value="{{ $cat->id }}"
               {{ in_array($cat->id, $selectedCats) ? 'checked' : '' }}>
        <label class="form-check-label" for="cat{{ $cat->id }}">
            {{ $cat->name }}
        </label>
    </div>
@endforeach
    </div>

    @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
</div>

                            <div class="col-md-6">
                                <label class="form-label">Industry</label>
                                <select name="industry_id" class="form-control">
                                    <option value="">Select Industry</option>
                                    @foreach($industries as $indus)
                                        <option value="{{ $indus->id }}" {{ old('industry_id', $product->industry_id) == $indus->id ? 'selected' : '' }}>{{ $indus->title }}</option>
                                    @endforeach
                                </select>
                                @error('industry_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label">Tabing</label>
                                <button type="button"
                                    class="btn btn-outline-secondary w-100 text-start d-flex justify-content-between align-items-center"
                                    id="tabingDropdownBtn">
                                    <span id="selectedTabingText">Select Tabings</span>
                                    <span>▼</span>
                                </button>

                                <div id="tabingCheckboxDropdown"
                                    class="border rounded bg-white position-absolute mt-1 w-100"
                                    style="display:none; max-height: 180px; overflow-y: auto; z-index: 1050;">
                                </div>

                                <small class="text-muted">Only tabings from selected categories are shown.</small>
                                @error('tabing_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            

                            <div class="col-md-6">
                                <label class="form-label">Product Name</label>
                                <input type="text" id="product_name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">URL</label>
                                <input type="text" id="product_url" name="url" class="form-control" value="{{ old('url', $product->url) }}" required>
                                @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Image</label>
                                <input type="file" id="product_main_image" name="image" class="form-control dropify" accept="image/*">
                                @if($product->image)
                                    <div id="productMainImagePreview" class="product-image-preview-grid">
                                        <div class="product-image-preview-card">
                                            <img src="{{ asset('public/product_images/'.$product->image) }}" alt="{{ $product->name }}" class="product-image-preview-thumb">
                                            <div class="product-image-preview-meta">
                                                <div class="product-image-preview-title">Current Main Image</div>
                                                <div class="product-image-preview-name">{{ $product->image }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div id="productMainImagePreview" class="product-image-preview-grid">
                                        <div class="product-image-preview-empty">No main image selected.</div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control summernote">{{ old('description', $product->description) }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Detail Description</label>
                                <textarea name="detail_description" class="form-control summernote">{{ old('detail_description', $product->detail_description) }}</textarea>
                                @error('detail_description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                                <label class="form-label">Website URL</label>
                                <textarea name="website_url" class="form-control summernote">{{ old('website_url', $product->website_url) }}</textarea>
                                @error('website_url') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                                <label class="form-label">Linkedin Link</label>
                                <input type="text" name="linkedin_link" class="form-control" value="{{ old('linkedin_link', $product->linkedin_link) }}" >
                                @error('linkedin_link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-md-6">
                                <label class="form-label">Instagram Link</label>
                                <input type="text" name="instagram_link" class="form-control" value="{{ old('instagram_link', $product->instagram_link) }}" >
                                @error('instagram_link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                         <div class="col-md-6">
                                <label class="form-label">Facebook Link</label>
                                <input type="text" name="facebook_link" class="form-control" value="{{ old('facebook_link', $product->facebook_link) }}" >
                                @error('facebook_link') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6">
                                <label class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $product->phone) }}" >
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                         <!--<div class="col-md-6">-->
                         <!--       <label class="form-label">Detail Image</label>-->
                         <!--       <input type="file" name="detail_image" class="form-control dropify">-->
                         <!--       @if($product->image)-->
                         <!--           <img src="{{ asset('public/product_detail_images/'.$product->image) }}" width="80" class="mt-2">-->
                         <!--       @endif-->
                         <!--   </div>-->

                            <div class="col-md-6">
                                <label class="form-label">Product Image</label>
                                <input type="file" id="product_gallery_images" name="product_image[]" class="form-control dropify" accept="image/*" multiple>
                                @if($product->product_image)
                                    @php
                                        $productImages = json_decode($product->product_image, true);
                                    @endphp
                                    <div id="productGalleryPreview" class="product-image-preview-grid">
                                        @foreach($productImages as $image)
                                        <div class="product-image-preview-card">
                                            <img src="{{ asset('public/product_multiple_images/'.$image) }}" alt="{{ $image }}" class="product-image-preview-thumb">
                                            <div class="product-image-preview-meta">
                                                <div class="product-image-preview-title">Current Gallery Image</div>
                                                <div class="product-image-preview-name">{{ $image }}</div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div id="productGalleryPreview" class="product-image-preview-grid">
                                        <div class="product-image-preview-empty">No gallery images selected.</div>
                                    </div>
                                @endif
                            </div>
                        <!-- Product Features Section -->
                            
                            <div class="col-md-6">
                                <label class="form-label">Sector</label>
                                <input type="text" name="sector" class="form-control" value="{{ old('sector', $product->sector) }}">
                                @error('sector') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <label class="form-label">Technology</label>-->
                            <!--    <input type="text" name="technology" class="form-control" value="{{ old('technology', $product->technology) }}" required>-->
                            <!--    @error('technology') <span class="text-danger">{{ $message }}</span> @enderror-->
                            <!--</div>-->

                        <button type="submit" class="btn btn-primary px-5">Update Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/admin/dist/assets/plugin/dropify/dist/css/dropify.min.css') }}">
<style>
    .product-image-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 12px;
        margin-top: 12px;
    }

    .product-image-preview-card {
        overflow: hidden;
        border: 1px solid #dee2e6;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.08);
    }

    .product-image-preview-thumb {
        width: 100%;
        height: 140px;
        object-fit: cover;
        display: block;
        background: #f8f9fa;
    }

    .product-image-preview-meta {
        padding: 10px;
    }

    .product-image-preview-title {
        margin-bottom: 4px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        color: #6c757d;
    }

    .product-image-preview-name {
        font-size: 13px;
        font-weight: 600;
        color: #212529;
        word-break: break-word;
    }

    .product-image-preview-size {
        margin-top: 4px;
        font-size: 12px;
        color: #6c757d;
    }

    .product-image-preview-empty {
        padding: 14px;
        border: 1px dashed #ced4da;
        border-radius: 12px;
        background: #f8f9fa;
        color: #6c757d;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="{{ asset('public/admin/dist/assets/bundles/dropify.bundle.js') }}"></script>
<script>
    window.PRODUCT_TABINGS = @json($tabings->values());
    window.PRODUCT_SELECTED_TABINGS = @json(old('tabing_id', $selectedTabingIds));
</script>
<script src="{{ asset('public/admin/js/product/product-form.js') }}"></script>
<script src="{{ asset('public/admin/js/product/product-tabing.js') }}"></script>
<script>
    $(document).ready(function(){
        if ($.fn.summernote) {
            $('.summernote').summernote({ height: 200 });
        }

        if ($.fn.dropify) {
            $('.dropify').dropify();
        }

        // Update selected features dynamically
        function updateSelectedFeatures() {
            var selectedFeatures = [];
            $("input[name='keyfeature[]']:checked").each(function() {
                selectedFeatures.push($(this).next("label").text());
            });
            if (selectedFeatures.length > 0) {
                $("#selectedFeaturesText").text(selectedFeatures.join(", "));
            } else {
                $("#selectedFeaturesText").text("None");
            }
        }

        // Update selected features when a checkbox is checked or unchecked
        $("input[name='keyfeature[]']").on('change', function() {
            updateSelectedFeatures();
        });

        // Initialize the selected features on page load
        updateSelectedFeatures();
    });
</script>
<script>
function toggleCheckboxDropdown() {
    const dropdown = document.getElementById('checkboxDropdown');
    dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
}

// Close dropdown if clicked outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('checkboxDropdown');
    const btn = document.getElementById('dropdownBtn');
    if (!btn.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = 'none';
    }
});
</script>

@endpush
