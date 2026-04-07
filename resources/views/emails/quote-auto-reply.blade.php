<!DOCTYPE html>
<html>
<head>
    <title>Your Quote Request - Arrithnius Solution</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #a460bf, #1d2052); color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; background: #f9f9f9; }
        .button { display: inline-block; padding: 12px 24px; background: #a460bf; color: white; text-decoration: none; border-radius: 8px; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; }
        .next-steps { background: white; padding: 15px; border-radius: 8px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Quote Request Received!</h2>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            
            <p>Thank you for requesting a quote from <strong>Arrithnius Solution</strong> for your <strong>{{ $service }}</strong> project.</p>
            
            <div class="next-steps">
                <h3>📋 What happens next?</h3>
                <ol>
                    <li>We'll review your project requirements within <strong>24 hours</strong></li>
                    <li>We may reach out for clarification if needed</li>
                    <li>You'll receive a detailed custom quote with pricing breakdown</li>
                    <li>Once approved, we'll schedule the project kickoff</li>
                </ol>
            </div>
            
            <p><strong>Your request summary:</strong></p>
            <ul>
                <li>🏢 Company: {{ $company }}</li>
                <li>📱 Service: {{ $service }}</li>
                <li>💰 Budget: {{ $budget }}</li>
                <li>⏱️ Timeline: {{ $timeline }}</li>
            </ul>
            
            <div style="text-align: center;">
                <a href="{{ env('WHATSAPP_URL') }}" class="button">💬 Have questions? Chat with us</a>
            </div>
            
            <p>We look forward to working with you!</p>
            
            <p>Best regards,<br>
            <strong>Arrithnius Solution Team</strong></p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Arrithnius Solution. All rights reserved.</p>
        </div>
    </div>
</body>
</html>