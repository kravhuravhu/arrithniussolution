<!DOCTYPE html>
<html>
<head>
    <title>Thank you for contacting Arrithnius Solutions</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 600px; width: 100%;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #a460bf, #1d2052); padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0;">
                            <h2 style="color: #ffffff; margin: 0; font-weight: 600; font-size: 24px;">Thank You for Contacting Us!</h2>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px 25px; background-color: #f9f9f9;">
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 0 0 15px 0;">Dear <strong>{{ $name }}</strong>,</p>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 0 0 15px 0;">
                                Thank you for reaching out to <strong>Arrithnius Solutions</strong>. We have received your message and will get back to you within <strong>24 hours</strong>.
                            </p>
                            
                            <!-- Message Summary -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 15px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #a460bf;">
                                <tr>
                                    <td>
                                        <h3 style="color: #1d2052; margin: 0 0 10px 0; font-size: 16px;">Your Message Summary:</h3>
                                        <p style="font-size: 14px; color: #555555; margin: 5px 0;"><strong>Subject:</strong> {{ $subject }}</p>
                                        <p style="font-size: 14px; color: #555555; margin: 5px 0;"><strong>Message:</strong> {{ Str::limit($userMessage, 200) }}</p>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 0 0 10px 0;">In the meantime, feel free to:</p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 10px 0 20px 0;">
                                <tr>
                                    <td style="padding: 5px 0; font-size: 15px; color: #333333;">
                                        <span style="color: #a460bf; font-weight: bold;">Phone / WhatsApp:</span> <strong>{{ env('COMPANY_PHONE') }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; font-size: 15px; color: #333333;">
                                        <span style="color: #a460bf; font-weight: bold;">Email:</span> <strong>{{ env('COMPANY_EMAIL') }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; font-size: 15px; color: #333333;">
                                        <span style="color: #a460bf; font-weight: bold;">LinkedIn:</span> <a href="{{ env('LINKEDIN_URL') }}" style="text-decoration: none;">Connect with us</a>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- WhatsApp Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding: 15px 0;">
                                        <a href="{{ env('WHATSAPP_URL') }}" style="display: inline-block; padding: 12px 30px; background-color: #25D366; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px;">
                                            Chat on WhatsApp
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 20px 0 0 0;">
                                Best regards,<br>
                                <strong>Arrithnius Solutions Team</strong><br>
                                <span style="font-size: 14px; color: #666666;">Full-Stack Digital Solutions • Web • Mobile • Cloud • Storage</span>
                            </p>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 25px; text-align: center; border-top: 1px solid #e0e0e0;">
                            <p style="font-size: 12px; color: #888888; margin: 0 0 5px 0;">
                                &copy; {{ date('Y') }} Arrithnius Solutions. All rights reserved.
                            </p>
                            <p style="font-size: 11px; color: #aaaaaa; margin: 0;">
                                This is an automated confirmation. Please do not reply to this email.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>