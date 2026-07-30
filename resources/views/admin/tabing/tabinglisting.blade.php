@extends('admin.layouts.app')

@section('title', 'Tabing Listing')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Tabing Listing</h3>
                <a href="{{ route('tabing.create') }}" class="btn btn-primary">+ Add Tabing</a>
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
                        <th>Category</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tabings as $key => $tabing)
                        <tr>
                            <td>{{ $tabings->firstItem() + $key }}</td>
                            <td>{{ optional($tabing->category)->name }}</td>
                            <td>{{ $tabing->name }}</td>
                            <td>{{ $tabing->url }}</td>
                            <td>
                                <span class="badge {{ $tabing->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $tabing->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>{{ optional($tabing->created_at)->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('tabing.edit', $tabing->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('tabing.destroy', $tabing->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this tabing?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No tabing records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $tabings->links() }}
        </div>
    </div>
</div>
@endsection