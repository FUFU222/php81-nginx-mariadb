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
    public function handle(Request $request, Closure $next): Response
    {
        // リクエストのログを出力
        $log = sprintf(
            "REQUEST URI: %s\nREQUEST METHOD: %s\nREQUEST HEADER: %s\nREQUEST BODY: %s\n",
            $request->getUri(),
            $request->getMethod(),
            json_encode($request->header()),
            json_encode($request->all())
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
