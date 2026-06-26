<!DOCTYPE html>
<html>
<head>
    <title>New Quote Request</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, Helvetica, sans-serif; background-color: #f5f5f5; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f5f5f5; padding: 20px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); max-width: 600px; width: 100%;">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #a460bf, #1d2052); padding: 30px 20px; text-align: center; border-radius: 8px 8px 0 0;">
                            <h2 style="color: #ffffff; margin: 0; font-weight: 600; font-size: 24px;">New Quote Request</h2>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td style="padding: 30px 25px; background-color: #f9f9f9;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <!-- Company -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Company:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0; font-size: 16px; color: #1d2052; font-weight: 600;">
                                        {{ $company }}
                                    </td>
                                </tr>
                                
                                <!-- Contact Person -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Contact Person:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0; font-size: 15px; color: #333333;">
                                        {{ $name }}
                                    </td>
                                </tr>
                                
                                <!-- Email -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Email:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0; font-size: 15px; color: #333333;">
                                        <a href="mailto:{{ $email }}" style="color: #a460bf; text-decoration: none;">{{ $email }}</a>
                                    </td>
                                </tr>
                                
                                <!-- Phone -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Phone:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0; font-size: 15px; color: #333333;">
                                        {{ $phone }}
                                    </td>
                                </tr>
                                
                                <!-- Service -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Service Requested:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0;">
                                        <span style="display: inline-block; padding: 4px 12px; background-color: #a460bf20; color: #a460bf; border-radius: 20px; font-size: 14px; font-weight: 600;">
                                            {{ $service }}
                                        </span>
                                    </td>
                                </tr>
                                
                                <!-- Budget -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Budget Range:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0; font-size: 15px; color: #333333;">
                                        {{ $budget }}
                                    </td>
                                </tr>
                                
                                <!-- Timeline -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Timeline:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0; font-size: 15px; color: #333333;">
                                        {{ $timeline }}
                                    </td>
                                </tr>
                                
                                <!-- Existing Branding -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Existing Branding:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0; font-size: 15px; color: #333333;">
                                        {{ $has_branding }}
                                    </td>
                                </tr>
                                
                                <!-- Existing Hosting -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Existing Hosting:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0 0 15px 0; font-size: 15px; color: #333333;">
                                        {{ $has_hosting }}
                                    </td>
                                </tr>
                                
                                <!-- Message -->
                                <tr>
                                    <td style="padding: 8px 0;">
                                        <span style="font-weight: bold; color: #a460bf;">Project Details:</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #ffffff; padding: 15px; border-left: 4px solid #a460bf; border-radius: 4px; font-size: 15px; color: #333333; line-height: 1.6;">
                                        {{ nl2br(e($userMessage)) }}
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Meta Information -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 25px; padding-top: 20px; border-top: 1px solid #e0e0e0;">
                                <tr>
                                    <td style="padding: 5px 0; font-size: 14px; color: #666666;">
                                        <strong>Submitted from IP:</strong> {{ $ip }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; font-size: 14px; color: #666666;">
                                        <strong>Submitted at:</strong> {{ $submitted_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 5px 0; font-size: 14px; color: #666666;">
                                        <strong>User Agent:</strong> {{ $user_agent ?? 'N/A' }}
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Quick Actions -->
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top: 25px; background-color: #ffffff; padding: 15px; border-radius: 8px;">
                                <tr>
                                    <td style="text-align: center;">
                                        <p style="font-size: 14px; color: #333333; margin: 0 0 10px 0;">
                                            <strong>Respond to this quote request within 24 hours.</strong>
                                        </p>
                                        <p style="font-size: 13px; color: #666666; margin: 0;">
                                            <a href="mailto:{{ $email }}" style="color: #a460bf; text-decoration: none;">Reply to {{ $name }}</a>
                                            &nbsp;|&nbsp;
                                            <a href="tel:{{ $phone }}" style="color: #a460bf; text-decoration: none;">Call {{ $phone }}</a>
                                            &nbsp;|&nbsp;
                                            <a href="{{ env('WHATSAPP_URL') }}" style="color: #25D366; text-decoration: none;">WhatsApp</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <!-- Footer -->
                    <tr>
                        <td style="padding: 20px 25px; text-align: center; border-top: 1px solid #e0e0e0;">
                            <p style="font-size: 12px; color: #888888; margin: 0;">
                                This message was sent from the quote request form on your website.
                            </p>
                            <p style="font-size: 12px; color: #888888; margin: 5px 0 0 0;">
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