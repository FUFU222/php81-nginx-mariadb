@extends('layouts.app')

@section('title', '投稿詳細')

@section('content')
    <div class="grid grid-cols-1 gap-4">
        <div class="overflow-hidden shadow-lg rounded-lg w-60 md:w-80 cursor-pointer m-auto">
            @if ($post->postImages->count() > 0)
                <div class="swiper post-swiper h-40">
                    <div class="swiper-wrapper">
                        @foreach ($post->postImages as $image)
                            <div class="swiper-slide">
                                <img alt="{{ $post->title }}" src="{{ asset('storage/' . $image->url) }}"
                                    class="w-full h-40 object-cover">
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <style>
                    .post-swiper .swiper-button-next,
                    .post-swiper .swiper-button-prev {
                        --swiper-navigation-size: 14px;
                        width: 26px;
                        height: 26px;
                        background-color: rgba(0, 0, 0, 0.35);
                        border-radius: 9999px;
                        color: #fff;
                    }

                    .post-swiper .swiper-button-next:hover,
                    .post-swiper .swiper-button-prev:hover {
                        background-color: rgba(0, 0, 0, 0.55);
                    }
                </style>
            @else
                <img alt="blog photo" src="https://picsum.photos/200?random={{ $post->id }}"
                    class="max-h-40 w-full object-cover">
            @endif
            <div class="bg-white dark:bg-gray-800 w-full p-4">
                <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">
                    {{ $post->title }}
                </p>
                <p class="text-gray-600 dark:text-gray-300 font-light text-md">
                    {{ $post->body }}
                </p>
            </div>
        </div>
        <a href="{{ route('post.edit', ['post' => $post]) }}"
            class="inline-block w-fit m-auto bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-full cursor-pointer transition-colors">
            編集する
        </a>

        <button type="button" id="delete-trigger"
            class="w-fit m-auto bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full cursor-pointer transition-colors">
            削除する
        </button>

        <form id="delete-form" action="{{ route('post.delete', ['post' => $post]) }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>

    <div id="delete-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 px-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 max-w-sm w-full">
            <p class="text-gray-800 dark:text-white font-medium mb-6">
                この投稿を本当に削除しますか？
            </p>
            <div class="flex justify-end gap-3">
                <button type="button" id="delete-cancel"
                    class="px-4 py-2 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                    キャンセル
                </button>
                <button type="submit" form="delete-form"
                    class="px-4 py-2 rounded-full bg-red-500 hover:bg-red-700 text-white font-bold cursor-pointer transition-colors">
                    削除する
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var trigger = document.getElementById('delete-trigger');
            var modal = document.getElementById('delete-modal');
            var cancel = document.getElementById('delete-cancel');

            trigger.addEventListener('click', function () {
                modal.classList.remove('hidden');
            });
            cancel.addEventListener('click', function () {
                modal.classList.add('hidden');
            });
            modal.addEventListener('click', function (e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        });
    </script>

    @if ($post->postImages->count() > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                new Swiper('.post-swiper', {
                    loop: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        </script>
    @endif
@endsection
