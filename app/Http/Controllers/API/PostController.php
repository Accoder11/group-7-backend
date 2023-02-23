<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::latest()->get();
    }

    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'required',
        ]);

        $post->title = $request->title;
        $post->category = $request->category;
        $post->description = $request->description;

        $post->save();
        return $post;
    }

    public function show(Post $post)
    {
        return $post;
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'required',
        ]);

        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
        ], 200);
    }

    public function searchPosts(Request $request)
    {
        $searchQuery = $request->input('q');

        $posts = Post::search($searchQuery)->get();

        return response()->json($posts);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            return response()->json(['filename' => $filename], 200);
        } else {
            return response()->json(['message' => 'Image not found.'], 400);
        }
    }

    public function postsByCategory($category)
    {
        $posts = Post::where('category', $category)->get();
        return response()->json($posts);
    }
}
