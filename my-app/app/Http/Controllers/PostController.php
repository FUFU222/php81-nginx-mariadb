<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('postImages')->get();
        return view('posts.index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required | string | max:255',
            'body' => 'required | string',
        ]);

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

    public function edit(int $id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required | string | max:255',
            'body' => 'required | string',
        ]);

        $post = new Post;
        $result = $post->updatePost($request->all(), $id);

        if ($request->hasFile('images')) {
            $postImageController = new PostImageController();
            $postImageController->store($request, $result);
        }
        return redirect()->route('posts.index')->with('toast', ['type' => 'updated', 'message' => '投稿を更新しました']);
    }

    public function delete(int $id)
    {
        $post = new Post();
        $result = $post->deletePost($id);
        return redirect()->route('posts.index')->with('toast', ['type' => 'deleted', 'message' => '投稿を削除しました']);
    }




//     public function indexRedirect()
//     {
//         return redirect()->route('posts.index_redirect_route');
//     }

//     public function index2()
//     {}

//     public function indexNormalSql()
//     {
//         $post = new Post();
//         $posts = Post::GetPostsWithNormalSql();
//         return $posts;
//     }

//     public function store(Request $request)
    
//     {   
//         $request->validate([
//             'image' => 'required | image',
//             'caption' => 'nullable | string | max:255',
//         ]);
//         $path = $request->file('image')->store('images');
//         Post::createPost([
//             'image' => $path,
//             'caption' => $request->caption,
//         ]);
//         return response()->json(['message' => 'Post created successfully']);
//     }
    
//     public function createPostWithNormalSql()
//     {
//         $dummyData = (object)[
//             'user_id' => 1,
//             'title' => '巣のSQL新しい投稿',
//             'body' => '巣のSQL新しい投稿の内容',
//         ];
//         $post = new Post();
//         $post->createPostWithNormalSql($dummyData);
//     }

//     public function createBulkPostWithNormalSql()
//     {
//         $post = new Post();
//         $post->createBulkPostWithNormalSql();
//     }

// #QueryBuilder

//     public function createPostWithQueryBuilder()
//     {
//         $dummyData = (object)[
//             'user_id' => 1,
//             'title' => 'QueryBuilderの新しい投稿',
//             'body' => 'QueryBuilderの新しい投稿の内容',
//         ];
//         $post = new Post();
//         $post->createPostWithQueryBuilder($dummyData);
//     }
 
//     public function createPostWithEloquent()
//     {
//         $dummyData = (object)[
//             'user_id' => 1,
//             'title' => 'Eloquentの新しい投稿',
//             'body' => 'Eloquentの新しい投稿の内容',
//         ];
//         $post = new Post();
//         $posts = $post->createPostWithEloquent($dummyData);
//     }



//     public function getPostWithQueryBuilder()
//     {
//         $post = new Post();
//         $posts = $post->getPostWithQueryBuilder();
//         return $posts;
//     }


//     public function updatePostWithQueryBuilder()
//     {
//         $dummyData = (object)[
//             'id' => 11,
//             'title' => 'Updateの新しい投稿',
//             'body' => 'Updateの新しい投稿の内容',
//         ];
//         $post = new Post();
//         $post->updatePostWithQueryBuilder($dummyData);
//     }

//     public function updatePostWithNormalSql()
//     {
//         $dummyData = (object) [
//             'id' => 12,
//             'title' => '更新された投稿',
//             'body' => '更新された投稿の内容です',
//         ];
//         $post = new Post();
//         $post->updatePostWithNormalSql($dummyData);
//     }

//     public function updatePostWithEloquent()
//     {
//         $dummyData = (object)[
//             'id' => 16,
//             'title' => 'Eloquentで更新された投稿',
//             'body' => 'Eloquentで更新された内容',
//         ];
//         $pots = new Post();
//         $pots->updatePostWithEloquent($dummyData);
//     }



//     public function deletePostWithNormalSql()
//     {
//         $dummyData = (object)[
//             'id' =>12,
//         ];
//         $post = new Post();
//         $post->deletePostWithNormalSql($dummyData);
//     }

//     public function deletePostWithQueryBuilder()
//     {
//         $dummyData = (object)[
//             'id' =>11,
//         ];
//         $post = new Post();
//         $post->deletePostWithQueryBuilder($dummyData);
//     }

//     public function deletePostWithEloquent(int$id)
//     {
//         $post = new Post();
//         $post->deletePostWithEloquent($id);
//     }



//     public function getPostWithQueryBuilderByFilter()
//     {
//         $post = new Post();
//         $posts = $post->getPostWithQueryBuilderByFilter();
//         return $posts;
//     }

//     public function getCountPosts()
//     {
//         $post = new Post();
//         $count = $post->getCountPosts();
//         return $count;
//     }

//     public function getPostAndUserWithQueryBuilder()
//     {
//         $post = new Post();
//         $posts = $post->getPostAndUserWithQueryBuilder();
//         return $posts;
//     }

//     public function getPostWithQueryBuilderBySubQuery()
//     {
//         $post = new Post();
//         $posts = $post->getPostWithQueryBuilderBySubQuery();
//         return $posts;
//     }

//     public function getPostWithEloquentById($id)
//     {
//         $id = $id;
//         $post = new Post();
//         $posts = $post->getPostWithEloquentById($id);
//         return $posts;
//     }

//     public function getTrashedPostWithEloquent()
//     {
//         $post = new Post();
//         $posts = $post->getTrashedPostWithEloquent();
//         return $posts;
//     }

}
