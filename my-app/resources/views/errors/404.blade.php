<x-app-layout>
    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-center">
                    <p class="text-sm font-semibold text-blue-500">404</p>
                    <h1 class="mt-2 text-2xl font-bold text-gray-800 dark:text-gray-200">
                        ページが見つかりません
                    </h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        お探しの投稿またはページは、削除されたか、URLが間違っている可能性があります。
                    </p>
                    <a href="{{ route('posts.index') }}"
                        class="mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        投稿一覧に戻る
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
