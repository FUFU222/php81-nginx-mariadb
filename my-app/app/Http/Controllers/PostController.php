<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = [
            (object)[
                'title' => 'Post 1',
                'body' => 'Content 1',
            ],
            (object)[
                'title' => 'Post 2',
                'body' => 'Content 2',
            ],
            (object)[
                'title' => 'Post 3',
                'body' => 'Content 3',
            ],
        ];
        return view('posts.index', ['posts' => $posts]);
    }


    public function index2()
    {}

    public function indexNormalSql()
    {
        $post = new Post();
        $posts = Post::GetPostsWithNormalSql();
        return $posts;
    }

    public function store(Request $request)
    
    {   
        $request->validate([
            'image' => 'required | image',
            'caption' => 'nullable | string | max:255',
        ]);
        $path = $request->file('image')->store('images');
        Post::createPost([
            'image' => $path,
            'caption' => $request->caption,
        ]);
        return response()->json(['message' => 'Post created successfully']);
    }
    
    public function createPostWithNormalSql()
    {
        $dummyData = (object)[
            'user_id' => 1,
            'title' => '巣のSQL新しい投稿',
            'body' => '巣のSQL新しい投稿の内容',
        ];
        $post = new Post();
        $post->createPostWithNormalSql($dummyData);
    }

    public function createBulkPostWithNormalSql()
    {
        $post = new Post();
        $post->createBulkPostWithNormalSql();
    }

#QueryBuilder

    public function createPostWithQueryBuilder()
    {
        $dummyData = (object)[
            'user_id' => 1,
            'title' => 'QueryBuilderの新しい投稿',
            'body' => 'QueryBuilderの新しい投稿の内容',
        ];
        $post = new Post();
        $post->createPostWithQueryBuilder($dummyData);
    }
 
    public function createPostWithEloquent()
    {
        $dummyData = (object)[
            'user_id' => 1,
            'title' => 'Eloquentの新しい投稿',
            'body' => 'Eloquentの新しい投稿の内容',
        ];
        $post = new Post();
        $posts = $post->createPostWithEloquent($dummyData);
    }



    public function getPostWithQueryBuilder()
    {
        $post = new Post();
        $posts = $post->getPostWithQueryBuilder();
        return $posts;
    }


    public function updatePostWithQueryBuilder()
    {
        $dummyData = (object)[
            'id' => 11,
            'title' => 'Updateの新しい投稿',
            'body' => 'Updateの新しい投稿の内容',
        ];
        $post = new Post();
        $post->updatePostWithQueryBuilder($dummyData);
    }

    public function updatePostWithNormalSql()
    {
        $dummyData = (object) [
            'id' => 12,
            'title' => '更新された投稿',
            'body' => '更新された投稿の内容です',
        ];
        $post = new Post();
        $post->updatePostWithNormalSql($dummyData);
    }

    public function updatePostWithEloquent()
    {
        $dummyData = (object)[
            'id' => 16,
            'title' => 'Eloquentで更新された投稿',
            'body' => 'Eloquentで更新された内容',
        ];
        $pots = new Post();
        $pots->updatePostWithEloquent($dummyData);
    }



    public function deletePostWithNormalSql()
    {
        $dummyData = (object)[
            'id' =>12,
        ];
        $post = new Post();
        $post->deletePostWithNormalSql($dummyData);
    }

    public function deletePostWithQueryBuilder()
    {
        $dummyData = (object)[
            'id' =>11,
        ];
        $post = new Post();
        $post->deletePostWithQueryBuilder($dummyData);
    }

    public function deletePostWithEloquent(int$id)
    {
        $post = new Post();
        $post->deletePostWithEloquent($id);
    }



    public function getPostWithQueryBuilderByFilter()
    {
        $post = new Post();
        $posts = $post->getPostWithQueryBuilderByFilter();
        return $posts;
    }

    public function getCountPosts()
    {
        $post = new Post();
        $count = $post->getCountPosts();
        return $count;
    }

    public function getPostAndUserWithQueryBuilder()
    {
        $post = new Post();
        $posts = $post->getPostAndUserWithQueryBuilder();
        return $posts;
    }

    public function getPostWithQueryBuilderBySubQuery()
    {
        $post = new Post();
        $posts = $post->getPostWithQueryBuilderBySubQuery();
        return $posts;
    }

    public function getPostWithEloquentById($id)
    {
        $id = $id;
        $post = new Post();
        $posts = $post->getPostWithEloquentById($id);
        return $posts;
    }

    public function getTrashedPostWithEloquent()
    {
        $post = new Post();
        $posts = $post->getTrashedPostWithEloquent();
        return $posts;
    }
}
