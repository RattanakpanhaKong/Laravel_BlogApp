<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\error;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::all();
        return response()->json($blog);
    }

    public function store(StoreBlogRequest $storeBlogRequest)
    {
        $data = $storeBlogRequest->validated();
        if ($storeBlogRequest->hasFile('image')) {
            $data['image'] = $storeBlogRequest->file('image')->store('images', 'public');
        }
        Blog::create($data);

        return response()->json([
            "message" => "Blog created",
            "data" => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return response()->json($blog);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Blog $blog, UpdateBlogRequest $request)
    {
        $data = $request->validated();

        if ($request->file('image')) {
            if (Storage::disk('local')->exists('public/' . $blog->image)) {
                Storage::delete('public/' . $blog->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $blog->update($data);

        return response()->json('Blog Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if (!$blog) {
            return response()->json(['message' => 'Blog not found !'], 404);
        }
        $blog->delete();
        return response()->json(['message' => 'Blog deleted successfully !'], 200);
    }
}
