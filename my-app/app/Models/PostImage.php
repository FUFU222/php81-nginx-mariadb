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

    public function saveImage($data): PostImage
    {
        $postImage = new PostImage();
        $postImage->post_id = $data['post_id'];
        $postImage->url = $data('url');
        $postImage->save();
        return $postImage;
    }
}
