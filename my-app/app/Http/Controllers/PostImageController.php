<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;

class PostImageController extends Controller
{
    public function store(Request $request, Post $post)
    {
        if (!$request->hasFile('images')) {
            return;
        }

        $request->validate([
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($request->file('images') as $image) {
            $postImage = new PostImage();
            $postImage->post_id = $post->id;
            $postImage->url = $image->store('post_images', 'public');
            $postImage->save();
        }
    }
}
