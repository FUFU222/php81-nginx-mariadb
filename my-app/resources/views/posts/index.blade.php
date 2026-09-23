@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')

    <div class="grid grid-cols-1 gap-4 my-4">
        <div>
            <a href="/post/create"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full cursor-pointer inline-block">
                新規投稿
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @foreach ($posts as $post)
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
                @else
                    <img alt="blog photo" src="https://picsum.photos/200?random={{ $post->id }}"
                        class="max-h-40 w-full object-cover">
                @endif
                <a href="{{ route('post.show', ['post' => $post]) }}" class="w-full block">
                    <div class="bg-white dark:bg-gray-800 w-full p-4">
                        <p class="text-gray-800 dark:text-white text-xl font-medium mb-2">
                            {{ $post->title }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-300 font-light text-md">
                            {{ $post->body }}
                        </p>
                    </div>
                </a>
            </div>
        @endforeach
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.post-swiper').forEach(function (el) {
                new Swiper(el, {
                    loop: true,
                    pagination: {
                        el: el.querySelector('.swiper-pagination'),
                        clickable: true,
                    },
                    navigation: {
                        nextEl: el.querySelector('.swiper-button-next'),
                        prevEl: el.querySelector('.swiper-button-prev'),
                    },
                });
            });
        });
    </script>
@endsection
