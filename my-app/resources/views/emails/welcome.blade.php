<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ようこそ！インスタ風写真投稿アプリへ！</title>
</head>
<body style="margin:0; padding:0; background-color:#f3f4f6; font-family: -apple-system, BlinkMacSystemFont, 'Helvetica Neue', Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6; padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="background-color:#3b82f6; padding:24px; text-align:center;">
                            <span style="color:#ffffff; font-size:20px; font-weight:bold;">インスタ風写真投稿アプリ</span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:32px 24px;">
                            <p style="font-size:16px; color:#1f2937; margin:0 0 16px;">
                                {{ $user->name }} 様
                            </p>
                            <p style="font-size:14px; color:#374151; line-height:1.7; margin:0 0 16px;">
                                この度はご登録いただき、誠にありがとうございます。<br>
                                さっそく投稿を作成して、写真をシェアしてみましょう。
                            </p>
                            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:24px 0;">
                                <tr>
                                    <td style="background-color:#3b82f6; border-radius:9999px;">
                                        <a href="{{ route('posts.index') }}"
                                            style="display:inline-block; padding:12px 24px; color:#ffffff; text-decoration:none; font-size:14px; font-weight:bold;">
                                            投稿一覧を見る
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 24px; background-color:#f9fafb; text-align:center;">
                            <span style="font-size:12px; color:#9ca3af;">
                                &copy; {{ date('Y') }} インスタ風写真投稿アプリ
                            </span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
