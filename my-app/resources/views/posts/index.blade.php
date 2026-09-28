<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            投稿一覧
        </h2>
    </x-slot>

    <div class="py-6">
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
                            <div class="flex items-center gap-1.5 mt-3 pt-3 border-t border-gray-100 dark:border-gray-700 text-xs text-gray-500 dark:text-gray-400">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 8a3 3 0 100-6 3 3 0 000 6zM3.465 14.493a1.23 1.23 0 00.41 1.412A9.957 9.957 0 0010 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 00-13.074.003z" clip-rule="evenodd" />
                                </svg>
                                <span>{{ $post->user->name }}</span>
                            </div>
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
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.post-swiper').forEach(function(el) {
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
    </div>
</x-app-layout>
