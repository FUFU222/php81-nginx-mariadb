@php
    $verificationUrl = \Illuminate\Support\Facades\URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Verify Your Email Address</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f5; font-family: Arial, Helvetica, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f5; padding:32px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="480" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="padding:32px; text-align:left; color:#1f2937;">
                            <h1 style="font-size:18px; margin:0 0 16px;">Verify Your Email Address</h1>

                            <p style="font-size:14px; line-height:1.6; margin:0 0 24px;">
                                Hi {{ $user->name }},<br>
                                Please click the button below to verify your email address.
                            </p>

                            <table role="presentation" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="border-radius:6px; background-color:#4f46e5;">
                                        <a href="{{ $verificationUrl }}"
                                           style="display:inline-block; padding:12px 24px; font-size:14px; color:#ffffff; text-decoration:none;">
                                            Verify Email Address
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <p style="font-size:12px; line-height:1.6; color:#6b7280; margin:24px 0 0;">
                                If you did not create an account, no further action is required.
                            </p>

                            <p style="font-size:12px; line-height:1.6; color:#9ca3af; margin:16px 0 0;">
                                This link will expire in 60 minutes.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
