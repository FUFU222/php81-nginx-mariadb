<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        // GitHub側との通信に失敗した場合の確認
        try {
            $githubUser = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            Log::error('GitHub認証に失敗しました: ' . $e->getMessage());
            return redirect()->route('login')
                ->withErrors(['error' => 'GitHub認証に失敗しました。もう一度お試しください']);
        }

        $user = User::where('github_id', $githubUser->getId())
            ->orWhere('email', $githubUser->getEmail())
            ->first();

        if ($user) {
            // GitHubがメールアドレスの所有権を検証済みのため、未認証のままなら認証済みにする
            // (これをしないとメール認証コマンドが対象から外れず送信し続けてしまう)
            $user->update([
                'github_id' => $user->github_id ?? $githubUser->getId(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
        } else {
            $user = User::create([
                'name' => $githubUser->getName() ?? $githubUser->getNickname(),
                'email' => $githubUser->getEmail(),
                'github_id' => $githubUser->getId(),
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(32)),
            ]);
        }

        Auth::login($user);

        return redirect()->route('posts.index');
    }
}
