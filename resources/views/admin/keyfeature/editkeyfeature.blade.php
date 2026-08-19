@extends('admin.layouts.app')

@section('title', 'Edit key Features')

@section('content')
<div class="container-xxl">
    <h3>Edit key Features</h3>
    <form method="POST" enctype="multipart/form-data" action="{{ route('keyfeature.update', $keyfeatures->id) }}">
        @csrf
        @method('PUT')

        <div class="card mb-3 p-3">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-md-6">
                    <label class="form-label">key Features</label>
                    <input type="text" name="name" class="form-control" value="{{ $keyfeatures->name }}" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update </button>
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

@endpush

