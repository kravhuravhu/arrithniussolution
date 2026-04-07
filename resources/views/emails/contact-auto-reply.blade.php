<!DOCTYPE html>
<html>
<head>
    <title>Thank you for contacting Arrithnius Solution</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #a460bf, #1d2052); color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .button { display: inline-block; padding: 12px 24px; background: #a460bf; color: white; text-decoration: none; border-radius: 8px; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
        .contact-info { background: white; padding: 15px; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thank You for Contacting Us!</h2>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            
            <p>Thank you for reaching out to <strong>Arrithnius Solutions</strong>. We have received your message and will get back to you within <strong>24 hours</strong>.</p>
            
            <div class="contact-info">
                <h3>Your Message Summary:</h3>
                <p><strong>Subject:</strong> {{ $subject }}</p>
                <p><strong>Message:</strong> {{ Str::limit($userMessage, 200) }}</p>
            </div>
            
            <p>In the meantime, feel free to:</p>
            <ul>
                <li>📞 Call/WhatsApp us at: <strong>{{ env('COMPANY_PHONE') }}</strong></li>
                <li>📧 Email us directly: <strong>{{ env('COMPANY_EMAIL') }}</strong></li>
                <li>💬 Chat with us on WhatsApp for quick questions</li>
            </ul>
            
            <div style="text-align: center;">
                <a href="{{ env('WHATSAPP_URL') }}" class="button">💬 Chat on WhatsApp</a>
            </div>
            
            <p>Best regards,<br>
            <strong>Arrithnius Solution Team</strong><br>
            <small>Full-Stack Digital Solutions • Web • Mobile • Cloud • Storage</small></p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Arrithnius Solution. All rights reserved.</p>
            <p><small>This is an automated confirmation. Please do not reply to this email.</small></p>
        </div>
    </div>
</body>
</html>