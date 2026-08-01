{{-- resources/views/admin/portfolio/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Portfolio Projects')
@section('content')
<div class="container-xxl">
    <div class="row align-items-center mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h3 class="fw-bold mb-0">Portfolio Projects</h3>
            <a href="{{ route('portfolio.create') }}" class="btn btn-primary">+ Add Project</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Listing Image</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($projects as $project)
                        <tr>
                            <td>{{ $loop->iteration + ($projects->currentPage() - 1) * $projects->perPage() }}</td>
                            <td>
                                @if($project->listing_image)
                                    <img src="{{ asset('public/newportfolio/listing/'.$project->listing_image) }}"
                                        style="width:60px;height:40px;object-fit:cover;border-radius:4px;">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->url }}</td>
                            <td>
                                @if($project->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $project->created_at->format('d M Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('portfolio.edit', $project->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('portfolio.destroy', $project->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No projects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $projects->links() }}
        </div>
    </div>
</div>
@endsection
