<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AccessLogger
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
     * ログに残してはいけない入力項目・ヘッダー
     */
    private const SENSITIVE_INPUT_KEYS = ['password', 'password_confirmation', 'current_password'];
    private const SENSITIVE_HEADER_KEYS = ['authorization', 'cookie'];

    public function handle(Request $request, Closure $next): Response
    {
        $headers = $request->header();
        foreach (self::SENSITIVE_HEADER_KEYS as $key) {
            if (isset($headers[$key])) {
                $headers[$key] = ['***REDACTED***'];
            }
        }

        // リクエストのログを出力(パスワード等の秘匿項目は除外)
        $log = sprintf(
            "REQUEST URI: %s\nREQUEST METHOD: %s\nREQUEST HEADER: %s\nREQUEST BODY: %s\n",
            $request->getUri(),
            $request->getMethod(),
            json_encode($headers),
            json_encode($request->except(self::SENSITIVE_INPUT_KEYS))
        );
        Log::info('リクエストスタート:', [$log]);

        // リクエストを処理
        $response = $next($request);

        // レスポンスのログを出力
        $log = sprintf(
            "RESPONSE STATUS: %s\nRESPONSE HEADER: %s\nRESPONSE BODY: %s\n",
            $response->getStatusCode(),
            json_encode($response->headers),
            $response->getContent()
        );
        Log::info('リクエスト終了:', [$log]);

        return $response;
    }
}
