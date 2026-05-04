<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body { font-family: Arial, sans-serif; color: #333; line-height: 1.6; margin: 0; padding: 0; background: #f4f4f4; }
    .wrapper { max-width: 600px; margin: 30px auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
    .header { background: #01354B; padding: 28px 32px; }
    .header h2 { color: #fff; margin: 0; font-size: 20px; }
    .body { padding: 32px; }
    .greeting { font-size: 16px; margin-bottom: 18px; }
    .message-box { background: #f8f9fa; border-left: 4px solid #01354B; padding: 18px 20px; border-radius: 4px; font-size: 15px; white-space: pre-wrap; }
    .footer { padding: 20px 32px; border-top: 1px solid #eee; color: #888; font-size: 12px; text-align: center; }
</style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h2>Message from TRACE</h2>
    </div>
    <div class="body">
        <p class="greeting">Dear {{ $recipientName }},</p>
        <div class="message-box">{{ $replyMessage }}</div>
        <p style="margin-top:24px; font-size:14px; color:#555;">
            Thank you for reaching out to us. Please feel free to reply to this email if you have any further questions.
        </p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} TRACE. All rights reserved.
    </div>
</div>
</body>
</html>