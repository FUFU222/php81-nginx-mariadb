<x-guest-layout>
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200">
            管理者ダッシュボード
        </h2>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 cursor-pointer">
                ログアウト
            </button>
        </form>
    </div>

    <p class="text-gray-600 dark:text-gray-300">
        ようこそ、{{ Auth::guard('admin')->user()->name }} さん。
    </p>
</x-guest-layout>
