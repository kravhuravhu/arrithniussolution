<!DOCTYPE html>
<html>
<head>
    <title>New Contact Form Submission</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #a460bf, #1d2052); color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .field { margin-bottom: 15px; }
        .field-label { font-weight: bold; color: #a460bf; }
        .message-box { background: white; padding: 15px; border-left: 3px solid #a460bf; margin-top: 10px; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>
        <div class="content">
            <div class="field">
                <div class="field-label">Name:</div>
                <div>{{ $name }}</div>
            </div>
            <div class="field">
                <div class="field-label">Email:</div>
                <div>{{ $email }}</div>
            </div>
            <div class="field">
                <div class="field-label">Phone:</div>
                <div>{{ $phone }}</div>
            </div>
            <div class="field">
                <div class="field-label">Company:</div>
                <div>{{ $company }}</div>
            </div>
            <div class="field">
                <div class="field-label">Subject:</div>
                <div>{{ $subject }}</div>
            </div>
            <div class="field">
                <div class="field-label">Message:</div>
                <div class="message-box">{{ nl2br(e($userMessage)) }}</div>
            </div>
            <hr>
            <div class="field">
                <div class="field-label">Submitted from IP:</div>
                <div>{{ $ip }}</div>
            </div>
            <div class="field">
                <div class="field-label">Submitted at:</div>
                <div>{{ $submitted_at }}</div>
            </div>
        </div>
        <div class="footer">
            <p>This message was sent from the contact form on your website.</p>
        </div>
    </div>
</body>
</html>