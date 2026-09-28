<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postImages()
    {
        return $this->hasMany(PostImage::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function createPost($data): Post
    {
        $user = Auth::user();

        $post = new Post;
        $post->user_id = $user->id;
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save();
        return $post;
    }

    public function updatePost($data, $id): Post
    {
        $post = Post::findOrFail($id);
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save();
        return $post;
    }

    public function deletePost($id): Post
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $post;
    }
}
