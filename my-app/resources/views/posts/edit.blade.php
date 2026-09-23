@extends('layouts.app')

@section('title', '投稿編集')

@section('content')
    <div class="max-w-lg mx-auto my-8 px-4">
        <div class="text-left mb-2">
            <a href="{{ route('post.show', ['post' => $post]) }}"
                class="inline-flex items-center gap-1 text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 text-sm font-medium transition-colors">
                <span aria-hidden="true">&larr;</span> 戻る
            </a>
        </div>
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">投稿編集</h2>

            <form action="{{ route('post.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data"
                class="space-y-5">
                @csrf

                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        画像
                    </label>
                    <input type="file" name="images[]" id="images" multiple
                        class="w-full text-gray-800 dark:text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-500 file:text-white file:font-bold hover:file:bg-blue-700 file:cursor-pointer">

                    @if ($post->postImages->count() > 0)
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach ($post->postImages as $image)
                                <img src="{{ asset('storage/' . $image->url) }}" alt="{{ $post->title }}" width="100"
                                    class="rounded-lg object-cover">
                            @endforeach
                        </div>
                    @endif
                </div>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        タイトル
                    </label>
                    <input type="text" name="title" id="title" value="{{ $post->title }}"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        内容
                    </label>
                    <textarea name="body" id="body" rows="6"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $post->body }}</textarea>
                </div>

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full cursor-pointer transition-colors">
                    更新
                </button>
            </form>
        </div>
    </div>
@endsection
