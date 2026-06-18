<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
    body {
        font-family: 'Be Vietnam Pro', Arial, sans-serif;
        background: #f3f4f6;
        margin: 0;
        padding: 20px;
    }

    .email-box {
        max-width: 500px;
        margin: 0 auto;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .email-header {
        background: linear-gradient(135deg, #065f46, #059669);
        padding: 32px;
        text-align: center;
    }

    .email-header img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }

    .email-header h1 {
        color: white;
        font-size: 24px;
        margin-top: 16px;
    }

    .email-body {
        padding: 32px;
        text-align: center;
    }

    .otp-code {
        font-size: 48px;
        font-weight: 700;
        color: #065f46;
        letter-spacing: 8px;
        background: #d1fae5;
        padding: 20px 32px;
        border-radius: 12px;
        display: inline-block;
        margin: 20px 0;
    }

    .email-body p {
        color: #6b7280;
        font-size: 15px;
        line-height: 1.7;
    }

    .email-footer {
        background: #f9fafb;
        padding: 20px;
        text-align: center;
        color: #9ca3af;
        font-size: 13px;
    }
    </style>
</head>

<body>
    <div class="email-box">
        <div class="email-header">
            <h1>Bánh Trung Thu 🥮</h1>
        </div>
        <div class="email-body">
            <h2 style="color:#1f2937;">
                {{ $type === 'verify email' ? 'Xác Thực Tài Khoản' : 'Đặt Lại Mật Khẩu' }}
            </h2>
            <p>Mã OTP của bạn là:</p>
            <div class="otp-code">{{ $otp }}</div>
            <p>Mã này có hiệu lực trong <strong>5 phút</strong>.<br>Vui lòng không chia sẻ mã này với bất kỳ ai.</p>
        </div>
        <div class="email-footer">
            © {{ date('Y') }} Bánh Trung Thu. All rights reserved.
        </div>
    </div>
</body>

</html>