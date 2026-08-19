@extends('admin.layouts.app')

@section('title', 'Add Blog')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <div class="card-header py-3 no-bg bg-transparent d-flex justify-content-between align-items-center border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Add Blog</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('blog.store') }}">
            @csrf
            <div class="card mb-3 p-3">
                <div class="card-header py-3 p-0 bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold">Blog Information</h6>
                </div>

                <div class="row g-3 align-items-center mt-2">

                    <!-- Blog Name -->
                    <div class="col-md-6">
                        <label class="form-label">Blog Name</label>
                        <input type="text" name="blog_name" class="form-control" value="{{ old('blog_name') }}" required>
                    </div>

                    <!-- URL -->
                    <div class="col-md-6">
                        <label class="form-label">URL</label>
                        <input type="text" name="url" class="form-control" value="{{ old('url') }}" required>
                    </div>

                    <!-- Blog Header Description -->
                    <div class="col-md-12">
                        <label class="form-label">Blog Header Description</label>
                        <textarea id="header_des" name="blog_header_des" class="form-control">{{ old('blog_header_des') }}</textarea>
                    </div>

                    <!-- Blog Short Description -->
                    <div class="col-md-12">
                        <label for="description" class="form-label">Blog Short Description</label>
                        <textarea id="description" name="blog_shortdescription" class="form-control">{{ old('blog_shortdescription') }}</textarea>
                    </div>
                    <!-- Blog Description -->
                    <div class="col-md-12">
                        <label for="description" class="form-label">Blog Description</label>
                        <textarea id="blog_shortdescription" name="blog_description" class="form-control">{{ old('blog_description') }}</textarea>
                    </div>

                    <!-- Date -->
                    <div class="col-md-6">
                        <label class="form-label">Date</label>
                        <input type="text" name="date" class="form-control datepicker" value="{{ old('date') }}">
                    </div>

                    <!-- Front Image + Alt -->
                    <div class="col-md-6">
                        <label class="form-label">Front Image</label>
                        <input type="file" name="front_image" class="form-control dropify" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label">Alt Text</label>
                        <input type="text" name="alt" class="form-control mt-2" placeholder="Alt text" value="{{ old('alt') }}">
                    </div>
                    <!-- Detail Header Image + Header Alt -->
                    <div class="col-md-6">
                        <label class="form-label">Detail Header Image</label>
                        <input type="file" name="detail_header_image" class="form-control dropify">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Header Alt Text</label>
                        <input type="text" name="header_alt" class="form-control mt-2" placeholder="Header Alt text" value="{{ old('header_alt') }}">
                    </div>
                    <!-- Detail Image -->
                    <div class="col-md-6">
                        <label class="form-label">Detail Image</label>
                        <input type="file" name="detail_image" class="form-control dropify">
                    </div>

                    <!-- Meta Title -->
                    <div class="col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
                    </div>

                    <!-- Meta Description -->
                    <div class="col-md-6">
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
<script src="{!! asset('public/admin/dist/assets/bundles/dropify.bundle.js') !!}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
$(document).ready(function() {
    // Summernote
    $('#description, #header_des, #blog_shortdescription').summernote({
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });

    // Dropify
    $('.dropify').dropify();

    // Datepicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
});
</script>
@endpush
