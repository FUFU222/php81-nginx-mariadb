<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'url'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function saveImage($image, int $postId): PostImage
    {
        $image->validate([
            'images.*' => 'required|file|image|mimes:jpeg,png,jpg,gif'
        ]);

        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $postImage = new PostImage();
        $postImage->post_id = $postId;
        $postImage->url = 'images/'. $imageName;
        $postImage->save();
        return $postImage;
    }
}
