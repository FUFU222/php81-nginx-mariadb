<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\CreatePostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['postImages', 'user'])->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        $post = new Post;
        $result = $post->createPost($request->all());

        if ($request->hasFile('images')) {
            $postImageController = new PostImageController();
            $postImageController->store($request, $result);
        }
        return redirect()->route('posts.index')->with('toast', ['type' => 'created', 'message' => '投稿を作成しました']);
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $result = $post->updatePost($request->all(), $post->id);

        if ($request->hasFile('images')) {
            $postImageController = new PostImageController();
            $postImageController->store($request, $result);
        }
        return redirect()->route('posts.index')->with('toast', ['type' => 'updated', 'message' => '投稿を更新しました']);
    }

    public function delete(Post $post)
    {
        $this->authorize('delete', $post);

        $post->deletePost($post->id);
        return redirect()->route('posts.index')->with('toast', ['type' => 'deleted', 'message' => '投稿を削除しました']);
    }
}
