@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container-xxl">
    <h3>Edit Category</h3>
    <form method="POST" enctype="multipart/form-data" action="{{ route('category.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="card mb-3 p-3">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-md-6">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>
                

                <div class="col-md-6">
                    <label class="form-label">URL</label>
                    <input type="text" name="url" class="form-control" value="{{ $category->url }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Category Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ $category->meta_title }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Category Meta Description</label>
                    <input type="text" name="meta_description" class="form-control" value="{{ $category->meta_description }}">
                </div>
                
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
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
$(document).ready(function(){
    $('.dropify').dropify();
    $('textarea[name="description"]').summernote({
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });
});
</script>
@endpush

