@extends('admin.layouts.app')

@section('title', 'key Features Listing')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center 
                        px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">key Features Listing</h3>
                <a href="{{ route('keyfeature.create') }}" class="btn btn-primary">+ Add key Features</a>
            </div>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>key Features Name</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keyfeatures as $key => $keyfeature)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $keyfeature->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('keyfeature.edit', $keyfeature->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('keyfeature.destroy', $keyfeature->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this keyfeature?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No Cloth Size Found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $keyfeatures->links() }}
        </div>
    </div>
</div>
@endsection
