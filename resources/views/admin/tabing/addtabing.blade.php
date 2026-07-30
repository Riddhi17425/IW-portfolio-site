@extends('admin.layouts.app')

@section('title', 'Add Tabing')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <div class="card-header py-3 no-bg bg-transparent d-flex justify-content-between align-items-center border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Add Tabing</h3>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('tabing.store') }}">
            @csrf

            <div class="card mb-3 p-3">
                <div class="card-header py-3 p-0 bg-transparent border-bottom-0">
                    <h6 class="mb-0 fw-bold">Tabing Information</h6>
                </div>

                <div class="row g-3 align-items-center mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-select" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Name</label>
                        <input type="text" id="tabing_name" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">URL</label>
                        <input type="text" id="tabing_url" name="url" class="form-control" value="{{ old('url') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status</label> 
                        <select name="status" class="form-select" required>
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary py-2 px-5 text-uppercase">Save</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="{!! asset('public/admin/js/tabing/tabing.js') !!}"></script>
@endpush