<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset – SCC ReportHub</title>
</head>
<body style="margin:0;padding:0;background-color:#f0f4f8;font-family:'Segoe UI',Arial,sans-serif;color:#333;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f4f8;padding:40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">

                    {{-- ── Header ── --}}
                    <tr>
                        <td style="background:linear-gradient(135deg,#1a3a5c 0%,#2563a8 100%);padding:40px 40px 32px;text-align:center;">
                            <img src="{{ config('app.url') }}/images/scc-logo.png"
                                 alt="SCC Logo"
                                 width="72" height="72"
                                 style="display:block;margin:0 auto 16px;border-radius:50%;background:#ffffff;padding:6px;object-fit:contain;">
                            <p style="margin:0;font-size:11px;letter-spacing:2px;text-transform:uppercase;color:rgba(255,255,255,0.65);font-weight:600;">Southern Christian College</p>
                            <h1 style="margin:6px 0 0;font-size:22px;font-weight:700;color:#ffffff;letter-spacing:0.3px;">SCC ReportHub</h1>
                        </td>
                    </tr>

                    {{-- ── Divider badge ── --}}
                    <tr>
                        <td align="center" style="background:#ffffff;padding:0;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background:#2563a8;color:#ffffff;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:8px 20px;border-radius:0 0 10px 10px;">
                                        Password Reset Request
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- ── Body ── --}}
                    <tr>
                        <td style="padding:40px 48px 32px;">
                            <p style="margin:0 0 8px;font-size:16px;color:#1a1a2e;">Hi <strong>{{ $userName }}</strong>,</p>
                            <p style="margin:0 0 24px;font-size:15px;line-height:1.7;color:#555;">
                                We received a request to reset the password for your <strong>SCC ReportHub</strong> account.
                                Click the button below to create a new password.
                            </p>

                            {{-- CTA Button --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center" style="padding:8px 0 28px;">
                                        <a href="{{ $resetUrl }}"
                                           style="display:inline-block;background:linear-gradient(135deg,#1a3a5c,#2563a8);color:#ffffff;text-decoration:none;font-size:15px;font-weight:700;padding:14px 40px;border-radius:8px;letter-spacing:0.4px;">
                                            Reset My Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            {{-- Notice box --}}
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background:#f8f9fb;border-left:4px solid #2563a8;border-radius:6px;padding:14px 18px;">
                                        <p style="margin:0;font-size:13px;color:#555;line-height:1.6;">
                                            ⏱ &nbsp;This link will expire in <strong>60 minutes</strong>.<br>
                                            If you didn't request a password reset, you can safely ignore this email — your password will remain unchanged.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            {{-- Fallback URL --}}
                            <p style="margin:24px 0 0;font-size:12px;color:#aaa;line-height:1.6;">
                                If the button doesn't work, copy and paste this link into your browser:<br>
                                <span style="color:#2563a8;word-break:break-all;">{{ $resetUrl }}</span>
                            </p>
                        </td>
                    </tr>

                    {{-- ── Footer ── --}}
                    <tr>
                        <td style="background:#f8f9fb;border-top:1px solid #eee;padding:24px 48px;text-align:center;">
                            <p style="margin:0 0 4px;font-size:12px;color:#aaa;">&copy; {{ date('Y') }} Southern Christian College &mdash; SCC ReportHub</p>
                            <p style="margin:0;font-size:11px;color:#ccc;">This is an automated message, please do not reply.</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
