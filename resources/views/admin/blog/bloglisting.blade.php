@extends('admin.layouts.app')

@section('title', 'Blog Listing')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center 
                        px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0">Blog Listing</h3>
                <a href="{{ route('blog.create') }}" class="btn btn-primary">+ Add Blog</a>
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
                        <th>Blog Name</th>
                        <th>URL</th>
                        <th>Front Image</th>
                        <th>Created</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $key => $blog)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $blog->blog_name }}</td>
                            <td>{{ $blog->url }}</td>
                            <td>
                                @if($blog->front_image)
                                    <img src="{{ asset('public/blog_front_images/'.$blog->front_image) }}" width="60">
                                @endif
                            </td>
                            <td>{{ $blog->created_at->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">No blogs found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $data->links() }}
        </div>
    </div>
</div>
@endsection
