<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset – SCC ReportHub</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #333;
        }
        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
        .header {
            background: linear-gradient(135deg, #1a3a5c 0%, #2563a8 100%);
            padding: 32px 40px;
            text-align: center;
        }
        .header img {
            height: 52px;
            margin-bottom: 12px;
        }
        .header h1 {
            color: #ffffff;
            font-size: 22px;
            margin: 0;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .body {
            padding: 40px;
        }
        .body p {
            font-size: 15px;
            line-height: 1.7;
            margin: 0 0 16px;
            color: #444;
        }
        .btn-reset {
            display: inline-block;
            margin: 24px 0;
            padding: 14px 36px;
            background: #2563a8;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .note {
            background: #f8f9fb;
            border-left: 4px solid #2563a8;
            border-radius: 4px;
            padding: 14px 18px;
            font-size: 13px;
            color: #666;
            margin-top: 8px;
        }
        .url-fallback {
            word-break: break-all;
            font-size: 12px;
            color: #888;
            margin-top: 6px;
        }
        .footer {
            border-top: 1px solid #eee;
            padding: 24px 40px;
            text-align: center;
            font-size: 12px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>SCC ReportHub</h1>
        </div>
        <div class="body">
            <p>Hi <strong>{{ $userName }}</strong>,</p>
            <p>We received a request to reset the password for your SCC ReportHub account. Click the button below to set a new password:</p>

            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="btn-reset">Reset My Password</a>
            </div>

            <div class="note">
                ⏱ This reset link will expire in <strong>60 minutes</strong>.<br>
                If you did not request a password reset, you can safely ignore this email — your password will remain unchanged.
            </div>

            <p class="url-fallback">
                If the button above doesn't work, copy and paste this URL into your browser:<br>
                {{ $resetUrl }}
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Southern Christian College – SCC ReportHub<br>
            This is an automated message, please do not reply.
        </div>
    </div>
</body>
</html>
