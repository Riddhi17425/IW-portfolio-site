<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $data = Blog::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.blog.bloglisting', compact('data'));
    }

    public function create()
    {
        return view('admin.blog.addblog');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'blog_name' => 'required',
            'url' => 'required',
        ]);

        $post = new Blog;
        $post->blog_name = $request->blog_name;
        $post->blog_header_des = $request->blog_header_des;
        $post->blog_description = $request->blog_description;
        $post->blog_shortdescription = $request->blog_shortdescription;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->url = $request->url;
        $post->date = $request->date;
        $post->alt = $request->alt;
        $post->header_alt = $request->header_alt;

        // front image
        if ($request->hasFile('front_image')) {
            $filename = time().'_'.$request->front_image->getClientOriginalName();
            $request->front_image->move(public_path('blog_front_images'), $filename);
            $post->front_image = $filename;
        }

        // detail header image
        if ($request->hasFile('detail_header_image')) {
            $filename = time().'_'.$request->detail_header_image->getClientOriginalName();
            $request->detail_header_image->move(public_path('blog_header_images'), $filename);
            $post->detail_header_image = $filename;
        }

        // detail image
        if ($request->hasFile('detail_image')) {
            $filename = time().'_'.$request->detail_image->getClientOriginalName();
            $request->detail_image->move(public_path('blog_detail_images'), $filename);
            $post->detail_image = $filename;
        }

        $post->save();

        return redirect()->route('blog.index')->with('success', 'Blog Added Successfully');
    }

    public function edit($id)
    {
        $data = Blog::findOrFail($id);
        return view('admin.blog.editblog', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $post = Blog::findOrFail($id);

        $post->blog_name = $request->blog_name;
        $post->blog_header_des = $request->blog_header_des;
        $post->blog_description = $request->blog_description;
        $post->blog_shortdescription = $request->blog_shortdescription;
        $post->meta_title = $request->meta_title;
        $post->meta_description = $request->meta_description;
        $post->url = $request->url;
        $post->date = $request->date;
        $post->alt = $request->alt;
        $post->header_alt = $request->header_alt;

        // front image
        if ($request->hasFile('front_image')) {
            $filename = time().'_'.$request->front_image->getClientOriginalName();
            $request->front_image->move(public_path('blog_front_images'), $filename);
            $post->front_image = $filename;
        }

        // detail header image
        if ($request->hasFile('detail_header_image')) {
            $filename = time().'_'.$request->detail_header_image->getClientOriginalName();
            $request->detail_header_image->move(public_path('blog_header_images'), $filename);
            $post->detail_header_image = $filename;
        }

        // detail image
        if ($request->hasFile('detail_image')) {
            $filename = time().'_'.$request->detail_image->getClientOriginalName();
            $request->detail_image->move(public_path('blog_detail_images'), $filename);
            $post->detail_image = $filename;
        }

        $post->save();

        return redirect()->route('blog.index')->with('success', 'Blog Updated Successfully');
    }

    public function destroy($id)
    {
        $data = Blog::findOrFail($id);

        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Blog Has Been Deleted Successfully');
        }

        return redirect()->back()->with('error', 'Blog Not Found');
    }
}
