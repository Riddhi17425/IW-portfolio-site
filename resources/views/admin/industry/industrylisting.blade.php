@extends('admin.layouts.app')

@section('title', 'Industry Listing')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center 
                        px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Industry Listing</h3>
                <a href="{{ route('industry.create') }}" class="btn btn-primary">+ Add Industry</a>
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
                        <th>Title</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($industries as $key => $indus)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $indus->title }}</td>
                            <td class="text-center">
                                <a href="{{ route('industry.edit', $indus->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('industry.destroy', $indus->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this industry?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No Industry Found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $industries->links() }}
        </div>
    </div>
</div>
@endsection
