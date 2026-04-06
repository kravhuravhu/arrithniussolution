<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    
    <title>Privacy Policy | {{ env('COMPANY_NAME') }}</title>
    <link rel="icon" type="image/png" href="{{ secure_asset('images/original_icon.png') }}" style="border-radius:50px;">\

    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ secure_asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('components/navbar.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('components/footer.css') }}">
    
    <style>
        .privacy-container {
            max-width: 900px;
            margin: 120px auto 60px;
            padding: 0 var(--space-lg);
        }
        
        .privacy-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: var(--space-2xl);
        }
        
        .privacy-header {
            text-align: center;
            margin-bottom: var(--space-2xl);
            padding-bottom: var(--space-xl);
            border-bottom: 1px solid var(--border);
        }
        
        .privacy-header h1 {
            font-size: var(--text-4xl);
            margin-bottom: var(--space-sm);
        }
        
        .privacy-header .last-updated {
            color: var(--text-secondary);
            font-size: var(--text-sm);
        }
        
        .privacy-section {
            margin-bottom: var(--space-xl);
        }
        
        .privacy-section h2 {
            font-size: var(--text-xl);
            margin-bottom: var(--space-md);
            color: var(--primary);
        }
        
        .privacy-section h3 {
            font-size: var(--text-base);
            margin-bottom: var(--space-sm);
            color: var(--text-primary);
        }
        
        .privacy-section p {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: var(--space-md);
        }
        
        .privacy-section ul {
            list-style: none;
            padding-left: var(--space-lg);
            margin-bottom: var(--space-md);
        }
        
        .privacy-section ul li {
            color: var(--text-secondary);
            line-height: 1.6;
            margin-bottom: var(--space-xs);
            position: relative;
            padding-left: var(--space-md);
        }
        
        .privacy-section ul li::before {
            content: '•';
            color: var(--primary);
            position: absolute;
            left: 0;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: var(--space-sm);
            margin-top: var(--space-xl);
            padding: var(--space-sm) var(--space-lg);
            background: transparent;
            border: 1px solid var(--border);
            border-radius: 40px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all var(--transition-fast);
        }
        
        .back-link:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateX(-5px);
        }
        
        @media screen and (max-width: 768px) {
            .privacy-container {
                margin: 100px auto 40px;
                padding: 0 var(--space-md);
            }
            
            .privacy-card {
                padding: var(--space-xl);
            }
            
            .privacy-header h1 {
                font-size: var(--text-2xl);
            }
        }
        
        @media screen and (max-width: 576px) {
            .privacy-card {
                padding: var(--space-lg);
            }
        }
    </style>
</head>
<body>

<canvas id="springCanvas"></canvas>

@include('components.navbar')

<main>
    <div class="privacy-container">
        <div class="privacy-card">
            <div class="privacy-header">
                <h1>Privacy Policy</h1>
                <div class="last-updated">Last Updated: {{ date('F d, Y') }}</div>
            </div>
            
            <div class="privacy-section">
                <h2>1. Information We Collect</h2>
                <p>When you use our services or contact us, we may collect the following information:</p>
                <ul>
                    <li>Name and contact information (email address, phone number)</li>
                    <li>Company name and business details</li>
                    <li>Project requirements and specifications</li>
                    <li>Technical data related to hosting and server access</li>
                    <li>Communication preferences</li>
                </ul>
            </div>
            
            <div class="privacy-section">
                <h2>2. How We Use Your Information</h2>
                <p>We use the information we collect for the following purposes:</p>
                <ul>
                    <li>To provide and maintain our services</li>
                    <li>To respond to your inquiries and quote requests</li>
                    <li>To process payments and manage billing (if applicable)</li>
                    <li>To provide technical support and server management</li>
                    <li>To improve our website and services</li>
                    <li>To comply with legal obligations</li>
                </ul>
            </div>
            
            <div class="privacy-section">
                <h2>3. Data Storage & Security</h2>
                <p>We take data security seriously. We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.</p>
                <p>For clients using our VM hosting and cloud storage services, you retain full control over your data. We do not access your servers or stored files without explicit permission or as required for technical support.</p>
            </div>
            
            <div class="privacy-section">
                <h2>4. Third-Party Services</h2>
                <p>We may use third-party services to operate our business, including:</p>
                <ul>
                    <li>Email and communication platforms</li>
                    <li>Payment processors</li>
                    <li>Cloud infrastructure providers</li>
                    <li>Analytics tools (if applicable)</li>
                </ul>
                <p>These third parties have their own privacy policies and are only granted access to the information necessary to perform their functions.</p>
            </div>
            
            <div class="privacy-section">
                <h2>5. Cookies & Tracking</h2>
                <p>Our website uses cookies to enhance your browsing experience. Cookies are small text files stored on your device that help us understand how you use our site and improve functionality.</p>
                <p>You can control cookie preferences through your browser settings. However, disabling cookies may affect certain features of our website.</p>
            </div>
            
            <div class="privacy-section">
                <h2>6. Your Rights</h2>
                <p>Depending on your location, you may have the following rights regarding your personal information:</p>
                <ul>
                    <li>Access to your personal data</li>
                    <li>Correction of inaccurate information</li>
                    <li>Deletion of your data (subject to legal obligations)</li>
                    <li>Restriction or objection to processing</li>
                    <li>Data portability</li>
                </ul>
                <p>To exercise any of these rights, please contact us at {{ env('COMPANY_EMAIL') }}.</p>
            </div>
            
            <div class="privacy-section">
                <h2>7. Data Retention</h2>
                <p>We retain your personal information only as long as necessary to fulfill the purposes for which it was collected, including for legal, accounting, or reporting requirements.</p>
            </div>
            
            <div class="privacy-section">
                <h2>8. Children's Privacy</h2>
                <p>Our services are not intended for individuals under the age of 16. We do not knowingly collect personal information from children. If you believe a child has provided us with personal information, please contact us immediately.</p>
            </div>
            
            <div class="privacy-section">
                <h2>9. International Data Transfers</h2>
                <p>Your information may be transferred to and processed in countries other than your own. We ensure appropriate safeguards are in place to protect your data in accordance with this Privacy Policy.</p>
            </div>
            
            <div class="privacy-section">
                <h2>10. Changes to This Policy</h2>
                <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated "Last Updated" date. We encourage you to review this policy periodically.</p>
            </div>
            
            <div class="privacy-section">
                <h2>11. Contact Us</h2>
                <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
                <ul>
                    <li>Email: {{ env('COMPANY_EMAIL') }}</li>
                    <li>Phone: {{ env('COMPANY_PHONE') }}</li>
                    <li>WhatsApp: <a href="{{ env('WHATSAPP_URL') }}" target="_blank" style="color: var(--primary);">{{ env('COMPANY_PHONE') }}</a></li>
                </ul>
            </div>
            
            <a href="/" class="back-link">← Back to Home</a>
        </div>
    </div>
</main>

@include('components.footer')

<script src="{{ secure_asset('js/darkmode.js') }}"></script>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('navbar');
        if (window.scrollY > 50) {
            nav.classList.add('scrolled');
        } else {
            nav.classList.remove('scrolled');
        }
    });
</script>
</body>
</html>