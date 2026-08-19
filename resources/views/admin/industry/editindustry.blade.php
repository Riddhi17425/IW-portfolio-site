@extends('admin.layouts.app')

@section('title', 'Edit Industry')

@section('content')
<div class="container-xxl">
    <h3>Edit Industry</h3>
    <form method="POST" enctype="multipart/form-data" action="{{ route('industry.update', $industry->id) }}">
        @csrf
        @method('PUT')

        <div class="card mb-3 p-3">
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
            $selectedCats = old('category_id', isset($industry) ? explode(',', $industry->category_id) : []);
        @endphp

        @foreach($categories as $cat)
            <div class="form-check px-3 py-1">
                <input class="form-check-input" type="checkbox" 
                       name="category_id[]" 
                       id="cat{{ $cat->id }}" 
                       value="{{ $cat->id }}"
                       {{ collect($selectedCats)->contains($cat->id) ? 'checked' : '' }}>
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
                    <input type="text" name="title" class="form-control" value="{{ $industry->title }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Industry Url</label>
                    <input type="text" name="url" class="form-control" value="{{ $industry->url }}" required>
                </div>
                
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
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

