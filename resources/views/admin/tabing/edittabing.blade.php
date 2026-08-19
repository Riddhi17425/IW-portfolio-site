@extends('admin.layouts.app')

@section('title', 'Edit Tabing')

@section('content')
<div class="container-xxl">
    <h3>Edit Tabing</h3>

    <form method="POST" action="{{ route('tabing.update', $tabing->id) }}">
        @csrf
        @method('PUT')

        <div class="card mb-3 p-3">
            <div class="row g-3 align-items-center mt-2">
                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $tabing->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" id="tabing_name" name="name" class="form-control" value="{{ old('name', $tabing->name) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">URL</label>
                    <input type="text" id="tabing_url" name="url" class="form-control" value="{{ old('url', $tabing->url) }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="1" {{ old('status', (string) $tabing->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', (string) $tabing->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Tabing</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="{!! asset('public/admin/js/tabing/tabing.js') !!}"></script>
@endpush