<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function createPost($data)
    {
        $post = new Post();
        $post->image = $data['image'];
        $post->caption = $data['caption'];
        $post->user_id = auth()->user()->id;
        $post->save();
        return $post;
    }

    public static function GetPostsWithNormalSql()
    {
        $posts = DB::select('SELECT * FROM posts');
        return $posts;
    }

    public function createPostWithNormalSql($data)
    {
        $post = DB::insert(
            'INSERT INTO posts (user_id, title, body) 
            VALUES (?, ?, ?)', 
            [$data->user_id, $data->title, $data->body]
            );
        return $post;
    }

    public function updatePostWithNormalSql($data)
    {
        $post = DB::insert(
            'UPDATE posts SET title = ?, body = ? WHERE id = ?',
            [$data->title, $data->body, $data->id]
            );
        return $post;
    }

    public function deletePostWithNormalSql($data)
    {
        // $post = DB::table('posts')->where('id', $data->id)->delete();
        $post = DB::delete('DELETE FROM posts WHERE id = ?', [$data->id]);
        return $post;
    }

    public function createBulkPostWithNormalSql()
    {
        DB::transaction(function () {
            $user_id = "1";
            $title = "Transaction";
            $content = "This is Transaction Test";

            DB::insert('INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)', [$user_id, $title, $content]);
            
        
            $title = "Second Transaction";
            $content = "This is Second Transaction Test";

            DB::insert('INSERT INTO posts (title, content) VALUES (?, ?)', [$title, $content]);
        });
    }

    public function createPostWithQueryBuilder($data)
    {
        $post = DB::table('posts')->insert([
            'user_id' => $data->user_id,
            'title' => $data->title,
            'body' => $data->body,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return $post;
    }

    public function getPostWithQueryBuilder()
    {
        $posts = DB::table('posts')->get();
        #dd($posts);
        return $posts;
    }

    public function updatePostWithQueryBuilder($data)
    {
        $posts = DB::table('posts')->where('id', $data->id)->update([
            'title' => $data->title,
            'body' => $data->body,
            'updated_at' => now()
        ]);
        return $posts;
    }


    public function deletePostWithQueryBuilder($data)
    {
        $post = DB::table('posts')->where('id', $data->id)->delete();
        return $post;
    }

    public function getPostWithQueryBuilderByFilter()
    {
        // $posts = DB::table('posts')
        // ->where('title', 'like', '%Sample%')
        // ->whereIn('id', [1, 2, 3])
        // ->orderBy('created_at', 'desc')
        // ->get();
        $posts = DB::table('posts')->paginate(5);
        return $posts;
    }

    public function getCountPosts()
    {
    $count = DB::table('posts')->count();
    return $count;
    }

    public function getPostAndUserWithQueryBuilder()
    {
        $posts = DB::table('posts')
            ->join('users', 'posts.user_id',
            '=', 'users.id')
            ->select('posts.*', 'users.name as author_name')
            ->get();
        return $posts;
    }

    public function getPostWithQueryBuilderBySubQuery()
    {
        $posts = DB::table('posts')
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('posts')
                    ->groupBy('user_id');
            })
            ->get();
        return $posts;
    }

    public function getPostWithEloquent()
    {
        $posts = Post::all();
        return $posts;
    }

    public function getPostWithEloquentById($id)
    {
        $posts = Post::find($id);
        $posts->tags;
        return $posts;
    }

    public function getTrashedPostWithEloquent()
    {
        $posts = Post::onlyTrashed()->get();
        return $posts;
    }


    public function createPostWithEloquent($data)
    {
        $post = new Post;
        $post->user_id = $data->user_id;
        $post->title = $data->title;
        $post->body = $data->body;
        $post->save();
        return $post;
    }

    public function updatePostWithEloquent($data)
    {
        $post = Post::find($data->id);
        $post->title = $data->title;
        $post->body = $data->body;
        $post->save();
        return $post;
    }

    public function deletePostWithEloquent($id)
    {
        $post = Post::find($id);
        $post->delete();
        return $post;
    }
}
