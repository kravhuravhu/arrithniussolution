<!DOCTYPE html>
<html>
<head>
    <title>Your Quote Request - Arrithnius Solutions</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 600px; width: 100%;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #a460bf, #1d2052); padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0;">
                            <h2 style="color: #ffffff; margin: 0; font-weight: 600; font-size: 24px;">Quote Request Received!</h2>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px 25px; background-color: #f9f9f9;">
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 0 0 15px 0;">Dear <strong>{{ $name }}</strong>,</p>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 0 0 15px 0;">
                                Thank you for requesting a quote from <strong>Arrithnius Solutions</strong> for your <strong>{{ $service }}</strong> project.
                            </p>
                            
                            <!-- Next Steps -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; padding: 20px; border-radius: 8px; margin: 20px 0;">
                                <tr>
                                    <td>
                                        <h3 style="color: #1d2052; margin: 0 0 15px 0; font-size: 16px;">What happens next?</h3>
                                        <ol style="margin: 0; padding-left: 20px; font-size: 15px; color: #333333; line-height: 1.8;">
                                            <li>We will review your project requirements within <strong>24 hours</strong></li>
                                            <li>We may reach out for clarification if needed</li>
                                            <li>You will receive a detailed custom quote with pricing breakdown</li>
                                            <li>Once approved, we will schedule the project kickoff</li>
                                        </ol>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Request Summary -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 20px 0; background-color: #ffffff; padding: 15px; border-radius: 8px; border-left: 4px solid #a460bf;">
                                <tr>
                                    <td>
                                        <h3 style="color: #1d2052; margin: 0 0 10px 0; font-size: 16px;">Your Request Summary:</h3>
                                        <p style="font-size: 14px; color: #555555; margin: 5px 0;"><strong>Company:</strong> {{ $company }}</p>
                                        <p style="font-size: 14px; color: #555555; margin: 5px 0;"><strong>Service:</strong> {{ $service }}</p>
                                        <p style="font-size: 14px; color: #555555; margin: 5px 0;"><strong>Budget:</strong> {{ $budget }}</p>
                                        <p style="font-size: 14px; color: #555555; margin: 5px 0;"><strong>Timeline:</strong> {{ $timeline }}</p>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Contact Options -->
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 0 0 10px 0;">Have questions? Connect with us:</p>
                            
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin: 10px 0 20px 0;">
                                <tr>
                                    <td style="padding: 5px 0; font-size: 15px; color: #333333;">
                                        <span style="color: #a460bf; font-weight: bold;">WhatsApp:</span> <a href="{{ env('WHATSAPP_URL') }}" style="text-decoration: none;">Chat with us</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; font-size: 15px; color: #333333;">
                                        <span style="color: #a460bf; font-weight: bold;">LinkedIn:</span> <a href="{{ env('LINKEDIN_URL') }}" style="text-decoration: none;">Connect with us</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; font-size: 15px; color: #333333;">
                                        <span style="color: #a460bf; font-weight: bold;">Email:</span> <a href="mailto:{{ env('COMPANY_EMAIL') }}" style="text-decoration: none;">{{ env('COMPANY_EMAIL') }}</a>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- WhatsApp Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding: 10px 0;">
                                        <a href="{{ env('WHATSAPP_URL') }}" style="display: inline-block; padding: 12px 30px; background-color: #25D366; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 600; font-size: 16px;">
                                            Chat on WhatsApp
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 20px 0 0 0;">
                                We look forward to working with you!
                            </p>
                            
                            <p style="font-size: 16px; line-height: 1.6; color: #333333; margin: 20px 0 0 0;">
                                Yours sincerely,<br>
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
                            <p style="font-size: 11px; color: #aaaaaa; margin: 5px 0 0 0;">
                                <a href="{{ env('APP_URL') }}" style="color: #a460bf; text-decoration: none;">{{ env('APP_URL') }}</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>