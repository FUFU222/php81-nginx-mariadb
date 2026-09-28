<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostImageController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        if (!$request->hasFile('images')) {
            return;
        }

        $request->validate([
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($request->file('images') as $image) {
            try {
                $postImage = new PostImage();
                $postImage->post_id = $post->id;
                $postImage->url = $image->store('post_images', 'public');
                $postImage->save();
            } catch (\Exception $e) {
                // 1枚の保存に失敗しても、投稿自体や他の画像の処理は続ける
                Log::error('画像の保存に失敗しました: ' . $e->getMessage());
            }
        }
    }
}
