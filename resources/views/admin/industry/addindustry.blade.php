@extends('admin.layouts.app')

@section('title', 'Add Industry')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <div class="card-header py-3 no-bg bg-transparent d-flex justify-content-between align-items-center border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Add Industry</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('industry.store') }}">
            @csrf
            <div class="card mb-3 p-3">
                <div class="card-header py-3 p-0 bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold">Industry Information</h6>
                </div>

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
                        <label class="form-label">Industry Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" >
                    </div>
                  
                    <div class="col-md-6">
                        <label class="form-label">Industry Url</label>
                        <input type="text" name="url" class="form-control" value="{{ old('url') }}" >
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase">Save</button>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
<link rel="stylesheet" href="{!! asset('public/admin/dist/assets/plugin/dropify/dist/css/dropify.min.css') !!}">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="{!! asset('public/admin/dist/assets/bundles/dropify.bundle.js') !!}"></script>

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
