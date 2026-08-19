@extends('admin.layouts.app')
@section('title', 'Add Project')
@section('content')
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <div class="card-header py-3 bg-transparent border-bottom">
                <h3 class="fw-bold mb-0">Add Project</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" enctype="multipart/form-data" action="{{ route('product.store') }}">
            @csrf
            <div class="card mb-3 p-3">
                <div class="row g-3">
                    
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
                         
                        @foreach($categories as $cat)
                            <div class="form-check px-3 py-1">
                                <input class="form-check-input" type="checkbox" 
                                       name="category_id[]" 
                                       id="cat{{ $cat->id }}" 
                                       value="{{ $cat->id }}"
                                       {{ collect(old('category_id', isset($industry) ? explode(',', $industry->category_id) : []))->contains($cat->id) ? 'checked' : '' }}>
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
                                <option value="{{ $indus->id }}" {{ old('industry_id') == $indus->id ? 'selected' : '' }}>{{ $indus->title }}</option>
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
                        <input type="text" id="product_name" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">URL</label>
                        <input type="text" id="product_url" name="url" class="form-control" value="{{ old('url') }}" >
                        @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label" for="image">Front Image</label>
                        <input type="file" id="product_main_image" name="image" class="form-control dropify" accept="image/*">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        <div id="productMainImagePreview" class="product-image-preview-grid">
                            <div class="product-image-preview-empty">No main image selected.</div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control summernote">{{ old('description') }}</textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Detail Description</label>
                        <textarea name="detail_description" class="form-control summernote">{{ old('detail_description') }}</textarea>
                        @error('detail_description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Website URL</label>
                        <textarea name="website_url" class="form-control summernote">{{ old('website_url') }}</textarea>
                        @error('website_url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                     <div class="col-md-6">
                        <label class="form-label">Linkedin Link</label>
                        <input type="text" name="linkedin_link" class="form-control" value="{{ old('linkedin_link') }}">
                        @error('linkedin_link') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Facebook Link</label>
                        <input type="text" name="facebook_link" class="form-control" value="{{ old('facebook_link') }}">
                        @error('facebook_link') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Instagram Link</label>
                        <input type="text" name="instagram_link" class="form-control" value="{{ old('instagram_link') }}">
                        @error('instagram_link') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" >
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    
                    <!--<div class="col-md-6">-->
                    <!--    <label class="form-label" for="detail_image">Detail Image</label>-->
                    <!--    <input type="file" id="detail_image" name="detail_image" class="form-control dropify">-->
                    <!--    @error('detail_image') <span class="text-danger">{{ $message }}</span> @enderror-->
                    <!--</div>-->
                    <div class="col-md-6">
                        <label class="form-label" for="product_image">Product Image</label>
                        <input type="file" id="product_gallery_images" name="product_image[]" class="form-control dropify" accept="image/*" multiple>
                        @error('product_image') <span class="text-danger">{{ $message }}</span> @enderror
                        <div id="productGalleryPreview" class="product-image-preview-grid">
                            <div class="product-image-preview-empty">No gallery images selected.</div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Sector</label>
                        <input type="text" name="sector" class="form-control" value="{{ old('sector') }}">
                        @error('sector') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!--<div class="col-md-6">-->
                    <!--    <label class="form-label">Technology</label>-->
                    <!--    <input type="text" name="technology" class="form-control" value="{{ old('technology') }}">-->
                    <!--    @error('technology') <span class="text-danger">{{ $message }}</span> @enderror-->
                    <!--</div>-->

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
window.PRODUCT_SELECTED_TABINGS = @json(old('tabing_id', []));
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

    function updateButtons() {
        $('.brand-size-row').each(function(index) {
            if (index === $('.brand-size-row').length - 1) {
                $(this).find('.add-more').show();
                $(this).find('.remove').hide();
            } else {
                $(this).find('.add-more').hide();
                $(this).find('.remove').show();
            }
        });
    }

    // Add More
    $(document).on('click', '.add-more', function(){
        let newIndex = $('.brand-size-row').length;
        let clone = $('.brand-size-row:first').clone();
        clone.find('select').val('');
        clone.find('.brand-preview').hide().attr('src', '');
        clone.find('.dropify').attr('data-default-file', '');
        clone.find('.dropify-wrapper').removeClass('has-preview');
        clone.find('.dropify-preview').hide();
        clone.find('.dropify-clear').trigger('click');
        clone.find('input[type=hidden]').remove();
        clone.find('select[name^="brand_id"]').attr('name', 'brand_id[' + newIndex + ']');
        clone.find('select[name^="size_id"]').attr('name', 'size_id[' + newIndex + ']');
        clone.find('select[name^="color_id"]').attr('name', 'color_id[' + newIndex + ']');
        clone.find('input[name^="product_image"]').attr('name', 'product_image[' + newIndex + ']');
        $('#dynamic-fields').append(clone);
        if ($.fn.dropify) {
            clone.find('.dropify').dropify();
        }
        updateButtons();
    });

    // Remove row
    $(document).on('click', '.remove', function(){
        if ($('.brand-size-row').length > 1) {
            $(this).closest('.brand-size-row').remove();
            $('.brand-size-row').each(function(index) {
                $(this).find('select[name^="brand_id"]').attr('name', 'brand_id[' + index + ']');
                $(this).find('select[name^="size_id"]').attr('name', 'size_id[' + index + ']');
                $(this).find('select[name^="color_id"]').attr('name', 'color_id[' + index + ']');
                $(this).find('input[name^="product_image"]').attr('name', 'product_image[' + index + ']');
            });
            updateButtons();
        }
    });

    // Auto show brand image
    $(document).on('change', '.brand-select', function(){
        let image = $(this).find(':selected').data('image');
        let preview = $(this).closest('.brand-size-row').find('.brand-preview');
        if(image && image !== '') {
            preview.attr('src', "{{ asset('public/brand_images') }}/" + image).show();
        } else {
            preview.hide().attr('src', '');
        }
    });

    // Trigger brand image preview on page load for pre-selected brands
    $('.brand-select').each(function() {
        let image = $(this).find(':selected').data('image');
        let preview = $(this).closest('.brand-size-row').find('.brand-preview');
        if(image && image !== '') {
            preview.attr('src', "{{ asset('public/brand_images') }}/" + image).show();
        }
    });

    updateButtons();
});
</script>
<script>
    $(document).ready(function() {
        // This will update the selected features text dynamically
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