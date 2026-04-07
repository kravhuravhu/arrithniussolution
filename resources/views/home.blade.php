@php
    $activeSection = $activeSection ?? 'home';
@endphp
<!DOCTYPE html>
<html lang="en" data-theme="dark">
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
        
        <title>{{ env('SITE_TITLE') }}</title>
        <link rel="icon" type="image/png" href="{{ secure_asset('images/original_icon.png') }}" style="border-radius:50px;">
        <link rel="apple-touch-icon" href="{{ secure_asset('images/original_icon.png') }}">
        
        <!-- Primary SEO Meta Tags -->
        <meta name="description" content="{{ env('SITE_DESCRIPTION') }}">
        <meta name="keywords" content="{{ env('SITE_KEYWORDS') }}">
        <meta name="author" content="{{ env('COMPANY_NAME') }}">
        <meta name="robots" content="index, follow">
        <meta name="language" content="English">
        <meta name="revisit-after" content="7 days">
        
        <!-- Canonical URL -->
        <link rel="canonical" href="{{ url('/') }}">
        
        <!-- Open Graph / Social Media Meta Tags -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ env('SITE_TITLE') }}">
        <meta property="og:description" content="{{ env('SITE_SEO_DESCRIPTION') }}">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:site_name" content="{{ env('COMPANY_NAME') }}">
        <meta property="og:locale" content="en_ZA">
        <meta property="og:image" content="{{ secure_asset('images/original_logo_bg.png') }}">
        <meta property="og:image:alt" content="{{ env('COMPANY_NAME') }} - Digital Solutions Provider">
        
        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ env('SITE_TITLE') }}">
        <meta name="twitter:description" content="{{ env('SITE_SEO_DESCRIPTION') }}">
        <meta name="twitter:image" content="{{ secure_asset('images/original_logo_bg.png') }}">

        <meta name="theme-color" content="#a460bf">
        <meta name="geo.region" content="ZA">
        <meta name="geo.position" content="-26.195;28.034">
        <meta name="ICBM" content="-26.195, 28.034">
        
        <!-- Preconnect for performance -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Stylesheets -->
        <link rel="stylesheet" href="{{ secure_asset('css/main.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ secure_asset('components/navbar.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ secure_asset('components/footer.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ secure_asset('css/services-expanded.css') }}" type="text/css">
        
        <!-- Structured Data / Schema.org -->
        @verbatim
            <script type="application/ld+json"> 
                { 
                    "@context": "https://schema.org", 
                    "@type": "Organization", 
                    "name": "Arrithnius Solutions", 
                    "url": "https://arrithnius.co.za", 
                    "logo": "https://arrithnius.co.za/images/original_logo_bg.png", 
                    "description": "Full-stack development agency specializing in Laravel websites, Flutter mobile apps, cloud VM hosting, database solutions, and secure file storage. Based in South Africa.", 
                    "email": "info@arrithnius.co.za", 
                    "telephone": "0677343682", 
                    "address": { 
                        "@type": "PostalAddress", 
                        "addressLocality": "Gauteng", 
                        "addressCountry": "ZA" 
                    }, 
                    "sameAs": [
                        "https://wa.me/27677343682", 
                        "https://linkedin.com/company/arrithnius-solutions", 
                        "https://github.com/kravhuravhu" 
                    ] 
                } 
            </script> 
                
            <script type="application/ld+json"> 
                { 
                    "@context": "https://schema.org", 
                    "@type": "WebSite", 
                    "name": "Arrithnius Solutions", 
                    "url": "https://arrithnius.co.za", 
                    "description": "Full-stack development agency specializing in Laravel websites, Flutter mobile apps, cloud VM hosting, database solutions, and secure file storage. Based in South Africa.", 
                    "potentialAction": 
                    { 
                        "@type": "SearchAction", 
                        "target": "https://arrithnius.co.za/?s=@{{search_term_string}}", 
                        "query-input": "required name=search_term_string" 
                    } 
                }
            </script>

            <!-- Dynamic Section SEO Meta Tags -->
            <script>
                const sectionSEO = {
                    'home': {
                        title: 'Arrithnius Solution | Full-Stack Digital Agency South Africa',
                        description: 'Full-stack development agency specializing in Laravel websites, Flutter mobile apps, cloud VM hosting, database solutions, and secure cloud storage. Based in South Africa. 100+ projects delivered.',
                        keywords: 'Web development South Africa, Flutter app development, Laravel developer, digital agency Johannesburg',
                        ogTitle: 'Arrithnius Solution - High-Performance Digital Platforms',
                        canonical: '{{ url("/") }}'
                    },
                    'all-services': {
                        title: 'Web, Mobile, Cloud & Storage Services | Arrithnius Solution',
                        description: 'Complete digital solutions: Custom Laravel websites, Flutter mobile apps for iOS/Android, VM hosting with SSH root access, database solutions, secure cloud storage, and DevOps with GitHub. Get a free quote today.',
                        keywords: 'Laravel websites, Flutter mobile apps, VM hosting, SSH access, database solutions, cloud storage, DevOps GitHub, South Africa',
                        ogTitle: 'Complete Digital Solutions - Web • Mobile • Cloud • Storage',
                        canonical: '{{ url("/services") }}'
                    },
                    'design-services': {
                        title: 'Professional Design Services | Logo, Branding & Graphics | Arrithnius',
                        description: 'Creative design services including logo design, business cards, company profiles, presentations, brochures, social media graphics, and more. Professional branding solutions for your business.',
                        keywords: 'logo design South Africa, business cards, company profile design, graphic design, branding services, presentation design',
                        ogTitle: 'Creative Design Services - Logo to Complete Brand Identity',
                        canonical: '{{ url("/design") }}'
                    },
                    'packages': {
                        title: 'Affordable Development Packages | {{ env("FIRST_CLIENT_DISCOUNT") }}% OFF | Arrithnius Solutions',
                        description: 'Flexible pricing for Laravel websites, Flutter mobile apps, VM hosting, and cloud storage. Get {{ env("FIRST_CLIENT_DISCOUNT") }}% off your first project. Free consultation included.',
                        keywords: 'web development pricing, mobile app cost South Africa, VM hosting prices, cloud storage packages, affordable developer',
                        ogTitle: 'Pricing & Packages - {{ env("FIRST_CLIENT_DISCOUNT") }}% Off First Project',
                        canonical: '{{ url("/packages") }}'
                    },
                    'why-choose-us': {
                        title: 'Why Choose Arrithnius | South African Tech Experts',
                        description: '100% custom built solutions, full SSH root access, GitHub integration, 24/7 support, and enterprise-grade cloud storage. Based in Gauteng, serving clients worldwide.',
                        keywords: 'custom web development, SSH root access, GitHub integration, South African tech company, why choose us',
                        ogTitle: 'Why Choose Us - 100% Custom Digital Solutions',
                        canonical: '{{ url("/why-us") }}'
                    },
                    'contact': {
                        title: 'Contact Arrithnius Solution | Free Quote | {{ env("COMPANY_PHONE") }}',
                        description: 'Get in touch for web development, mobile apps, or hosting. Call {{ env("COMPANY_PHONE") }} or email {{ env("COMPANY_EMAIL") }}. Free consultation available. Request a quote today!',
                        keywords: 'contact web developer South Africa, get quote, WhatsApp business, Laravel developer contact, Flutter app developer',
                        ogTitle: 'Contact Us - Request a Free Quote Today',
                        canonical: '{{ url("/contact") }}'
                    }
                };

                function updateSectionMeta(sectionId) {
                    const seo = sectionSEO[sectionId];
                    if (!seo) return;
                    document.title = seo.title;
                    let metaDesc = document.querySelector('meta[name="description"]');
                    if (metaDesc) metaDesc.setAttribute('content', seo.description);
                    let metaKeywords = document.querySelector('meta[name="keywords"]');
                    if (metaKeywords) metaKeywords.setAttribute('content', seo.keywords);
                    let ogTitle = document.querySelector('meta[property="og:title"]');
                    if (ogTitle) ogTitle.setAttribute('content', seo.ogTitle);
                    let ogDesc = document.querySelector('meta[property="og:description"]');
                    if (ogDesc) ogDesc.setAttribute('content', seo.description);
                    let ogUrl = document.querySelector('meta[property="og:url"]');
                    if (ogUrl) ogUrl.setAttribute('content', seo.canonical);
                    let twitterTitle = document.querySelector('meta[name="twitter:title"]');
                    if (twitterTitle) twitterTitle.setAttribute('content', seo.ogTitle);
                    let twitterDesc = document.querySelector('meta[name="twitter:description"]');
                    if (twitterDesc) twitterDesc.setAttribute('content', seo.description);
                    let canonical = document.querySelector('link[rel="canonical"]');
                    if (canonical) canonical.setAttribute('href', seo.canonical);
                }

                const phpSection = '{{ $activeSection }}';
                if (phpSection && sectionSEO[phpSection]) {
                    updateSectionMeta(phpSection);
                }
            </script>
        @endverbatim
    </head>
    <body>
        <canvas id="springCanvas"></canvas>

        @include('components.navbar')

        <main>
            <!-- HERO SECTION -->
            <section id="home" class="hero">
                <div class="container">
                    <div class="hero-content fall-reveal">
                        <div class="hero-badge">Full-Stack Digital Solutions Agency</div>
                        <h1>High-Performance<br><span class="gradient-text">Digital Platforms</span><br>That Scale With You</h1>
                        <div class="typing-container">
                            <span class="typing-text" id="typing-text"></span>
                            <span class="typing-cursor"></span>
                        </div>
                        <p class="hero-description">
                            Right from Laravel websites and Flutter mobile apps to enterprise VM hosting and secure cloud storage — we build complete digital ecosystems that scale with your business.
                        </p>
                        <div class="hero-buttons">
                            <a href="#contact" class="btn btn-primary btn-large">Start Your Project →</a>
                            <a href="#all-services" class="btn btn-outline btn-large">Explore All Services</a>
                        </div>
                        <div class="hero-stats">
                            <div class="stat"><div class="number gradient-text">100+</div><div class="label">Projects Delivered</div></div>
                            <div class="stat"><div class="number gradient-text">99.9%</div><div class="label">Uptime SLA</div></div>
                            <div class="stat"><div class="number gradient-text">24/7</div><div class="label">Technical Support</div></div>
                            <div class="stat"><div class="number gradient-text">SSH</div><div class="label">Root Access</div></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tech Stack -->
            <div class="container">
                <div class="tech-stack reveal">
                    <div class="tech-icons">
                        <div class="tech-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 4h16v16H4z"/></svg><span>Laravel</span></div>
                        <div class="tech-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/></svg><span>Flutter</span></div>
                        <div class="tech-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/></svg><span>Dart</span></div>
                        <div class="tech-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/></svg><span>VM/SSH</span></div>
                        <div class="tech-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2L2 7l10 5 10-5-10-5z"/></svg><span>GitHub</span></div>
                        <div class="tech-item"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/></svg><span>Cloud Storage</span></div>
                    </div>
                </div>
            </div>

            <!-- ALL SERVICES SECTION -->
            <section id="all-services" class="section">
                <div class="container">
                    <div class="section-header reveal">
                        <h2>Complete <span class="gradient-text">Digital Solutions</span></h2>
                        <p>End-to-end development and infrastructure services for modern businesses</p>
                    </div>
                    
                    <div class="service-categories-tabs reveal">
                        <button class="service-cat-btn active" data-cat="web">🌐 Web Development</button>
                        <button class="service-cat-btn" data-cat="mobile">📱 Mobile Apps</button>
                        <button class="service-cat-btn" data-cat="cloud">☁️ Cloud & VM</button>
                        <button class="service-cat-btn" data-cat="database">🗄️ Database Solutions</button>
                        <button class="service-cat-btn" data-cat="storage">💾 Cloud Storage</button>
                        <button class="service-cat-btn" data-cat="devops">⚙️ DevOps & Version Control</button>
                    </div>
                    
                    <div class="service-category-pane active" id="cat-web">
                        <div class="services-grid">
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🌐</div><h3>Custom Laravel Websites</h3><p>Bespoke web applications built with Laravel PHP framework. Scalable, secure, and optimized for performance.</p><ul class="service-features-list"><li>✓ Custom Business Websites</li><li>✓ E-commerce Platforms</li><li>✓ Web Portals & Dashboards</li><li>✓ RESTful API Development</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">⚡</div><h3>Performance Optimization</h3><p>Lightning-fast loading speeds with advanced caching, CDN integration, and database tuning.</p><ul class="service-features-list"><li>✓ Redis/Memcached Caching</li><li>✓ Database Query Optimization</li><li>✓ Image & Asset Optimization</li><li>✓ Lighthouse 90+ Scores</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🔧</div><h3>Maintenance & Support</h3><p>Ongoing website maintenance, security updates, and 24/7 technical support.</p><ul class="service-features-list"><li>✓ Security Patches & Updates</li><li>✓ Bug Fixes & Improvements</li><li>✓ Performance Monitoring</li><li>✓ Priority Support Channel</li></ul></div>
                        </div>
                    </div>
                    
                    <div class="service-category-pane" id="cat-mobile">
                        <div class="services-grid">
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">📱</div><h3>Flutter Mobile Apps</h3><p>Cross-platform mobile applications built with Flutter & Dart. One codebase for iOS & Android.</p><ul class="service-features-list"><li>✓ iOS & Android Apps</li><li>✓ Custom UI/UX Design</li><li>✓ Smooth Animations</li><li>✓ App Store & Play Store Deployment</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🔌</div><h3>API Integration</h3><p>Seamless integration with REST APIs, Firebase, and third-party services.</p><ul class="service-features-list"><li>✓ REST API Integration</li><li>✓ Firebase Backend</li><li>✓ Payment Gateways</li><li>✓ Social Media Login</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">📲</div><h3>App Maintenance</h3><p>Ongoing app updates, bug fixes, and feature enhancements.</p><ul class="service-features-list"><li>✓ Regular Updates</li><li>✓ Performance Optimization</li><li>✓ Crash Analytics & Fixes</li><li>✓ Version Migration Support</li></ul></div>
                        </div>
                    </div>
                    
                    <div class="service-category-pane" id="cat-cloud">
                        <div class="services-grid">
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🖥️</div><h3>Remote VM Hosting</h3><p>Enterprise-grade virtual machines with full root access via SSH. Choose your Linux distro.</p><ul class="service-features-list"><li>✓ Ubuntu / Debian / CentOS</li><li>✓ Full SSH Root Access</li><li>✓ Apache / Nginx Servers</li><li>✓ 99.9% Uptime Guarantee</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🔐</div><h3>Managed Server Setup</h3><p>Complete server configuration, security hardening, and ongoing management.</p><ul class="service-features-list"><li>✓ Firewall Configuration</li><li>✓ SSL Certificate Installation</li><li>✓ Automated Backups</li><li>✓ 24/7 Server Monitoring</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🚀</div><h3>Application Deployment</h3><p>Deploy your web applications to production environments with CI/CD pipelines.</p><ul class="service-features-list"><li>✓ Laravel/Node.js Deployment</li><li>✓ Docker Containerization</li><li>✓ Load Balancing</li><li>✓ Auto-scaling Configuration</li></ul></div>
                        </div>
                    </div>
                    
                    <div class="service-category-pane" id="cat-database">
                        <div class="services-grid">
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🗄️</div><h3>Stand-alone Database Apps</h3><p>Custom database applications for data management, reporting, and analytics.</p><ul class="service-features-list"><li>✓ MySQL / PostgreSQL</li><li>✓ MongoDB / NoSQL</li><li>✓ Custom Admin Panels</li><li>✓ Data Import/Export Tools</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🔄</div><h3>Database Management</h3><p>Ongoing database optimization, backup, and maintenance.</p><ul class="service-features-list"><li>✓ Performance Tuning</li><li>✓ Automated Backups</li><li>✓ Security Hardening</li><li>✓ Query Optimization</li></ul></div>
                        </div>
                    </div>
                    
                    <div class="service-category-pane" id="cat-storage">
                        <div class="services-grid">
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">☁️</div><h3>Secure Cloud Storage</h3><p>Enterprise-grade storage for images, videos, documents, and backups.</p><ul class="service-features-list"><li>✓ Object Storage (S3-compatible)</li><li>✓ CDN Integration</li><li>✓ File Versioning</li><li>✓ Encrypted at Rest</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">📁</div><h3>Media Management</h3><p>Organized storage and delivery for all your media assets.</p><ul class="service-features-list"><li>✓ Image Optimization</li><li>✓ Video Streaming Ready</li><li>✓ Automatic Compression</li><li>✓ Custom Access Controls</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">💾</div><h3>Backup Solutions</h3><p>Automated backup systems for databases, files, and entire servers.</p><ul class="service-features-list"><li>✓ Daily Automated Backups</li><li>✓ Off-site Storage</li></ul></div>
                        </div>
                    </div>
                    
                    <div class="service-category-pane" id="cat-devops">
                        <div class="services-grid">
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon"><svg height="40" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/></svg></div><h3>GitHub Version Control</h3><p>Professional Git workflow setup, repository management, and collaboration tools.</p><ul class="service-features-list"><li>✓ Repository Setup & Management</li><li>✓ Branch Strategy Implementation</li><li>✓ Code Review Processes</li><li>✓ GitHub Actions CI/CD</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">🔄</div><h3>CI/CD Pipelines</h3><p>Automated testing and deployment pipelines for faster releases.</p><ul class="service-features-list"><li>✓ Automated Testing</li><li>✓ Staging Environments</li><li>✓ Zero-downtime Deployments</li><li>✓ Rollback Capabilities</li></ul></div>
                            <div class="service-card reveal"><div class="shiny-overlay"></div><div class="service-icon">📦</div><h3>Docker & Containerization</h3><p>Containerize your applications for consistent deployment across environments.</p><ul class="service-features-list"><li>✓ Dockerfile Creation</li><li>✓ Docker Compose Setup</li><li>✓ Container Orchestration</li><li>✓ Registry Management</li></ul></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- DESIGN SERVICES SECTION -->
            <section id="design-services" class="section">
                <div class="container">
                    <div class="section-header reveal">
                        <h2>Creative <span class="gradient-text">Design Services</span></h2>
                        <p>Complete branding and creative solutions for your business</p>
                    </div>
                    <div class="design-grid">
                        <div class="design-item reveal"><div class="shiny-overlay"></div>🎨 Logo Design</div>
                        <div class="design-item reveal"><div class="shiny-overlay"></div>🃏 Business Cards</div>
                        <div class="design-item reveal"><div class="shiny-overlay"></div>📄 Company Profiles</div>
                        <div class="design-item reveal"><div class="shiny-overlay"></div>📊 Presentations</div>
                        <div class="design-item reveal"><div class="shiny-overlay"></div>📖 Brochures</div>
                        <div class="design-item reveal"><div class="shiny-overlay"></div>📝 Resume/CV</div>
                        <div class="design-item reveal"><div class="shiny-overlay"></div>📱 Social Media Graphics</div>
                        <div class="design-item reveal"><div class="shiny-overlay"></div>🖼️ Posters & Flyers</div>
                    </div>
                </div>
            </section>

            <!-- PACKAGES SECTION -->
            <section id="packages" class="section">
                <div class="container">
                    <div class="section-header reveal">
                        <h2>Flexible <span class="gradient-text">Package</span> Deals</h2>
                        <p>Choose the perfect package for your business needs</p>
                    </div>
                    <div class="packages-grid">
                        <div class="package-card reveal"><div class="shiny-overlay"></div><div class="discount-badge">🎉 {{ env('FIRST_CLIENT_DISCOUNT') }}% OFF First Clients</div><h3>Web Development</h3><div class="price-note">One-time setup</div><ul class="package-features"><li>Custom Laravel Website (5-10 pages)</li><li>Fully Responsive Design</li><li>SEO Optimized</li><li>1 Month Free Maintenance</li></ul><a href="#contact" class="btn btn-primary">Get Quote →</a></div>
                        <div class="package-card featured reveal"><div class="shiny-overlay"></div><div class="featured-badge">MOST POPULAR</div><h3>Flutter Mobile App</h3><div class="price-note">iOS + Android</div><ul class="package-features"><li>Cross-platform App (iOS/Android)</li><li>Custom UI/UX Design</li><li>API Integration Ready</li><li>App Store & Play Store Submission</li></ul><a href="#contact" class="btn btn-primary">Get Started →</a></div>
                        <div class="package-card reveal"><div class="shiny-overlay"></div><h3>VM Hosting</h3><div class="price-note">SSH root access</div><ul class="package-features"><li>From 2 vCPU | 4GB RAM | 10GB</li><li>Full SSH Root Access</li><li>Choose Your Linux Distro</li><li>24/7 Server Monitoring</li></ul><a href="#contact" class="btn btn-outline">Get Quote →</a></div>
                        <div class="package-card reveal"><div class="shiny-overlay"></div><h3>Cloud Storage</h3><div class="price-note">100GB - 1TB options</div><ul class="package-features"><li>Secure Object Storage</li><li>CDN Integration</li><li>File Versioning</li><li>API Access</li></ul><a href="#contact" class="btn btn-outline">Contact Us →</a></div>
                    </div>
                </div>
            </section>

            <!-- WHY CHOOSE US SECTION -->
            <section id="why-choose-us" class="section">
                <div class="container">
                    <div class="section-header reveal">
                        <h2>Why <span class="gradient-text">Choose Us</span></h2>
                        <p>What makes Arrithnius Solution different from the rest</p>
                    </div>
                    <div class="why-grid">
                        <div class="why-card reveal"><div class="shiny-overlay"></div><div class="why-icon">✅</div><h4>100% Custom Built</h4><p>No templates or page builders. Every website and app is crafted specifically for your unique business needs.</p></div>
                        <div class="why-card reveal"><div class="shiny-overlay"></div><div class="why-icon">📱</div><h4>Full-Stack Expertise</h4><p>From Laravel backends to Flutter mobile apps, we handle the entire technology stack.</p></div>
                        <div class="why-card reveal"><div class="shiny-overlay"></div><div class="why-icon">🖥️</div><h4>SSH Root Access</h4><p>Full control over your VM with root access. Install any software, configure networks and access endpoints as needed.</p></div>
                        <div class="why-card reveal"><div class="shiny-overlay"></div><div class="why-icon">💾</div><h4>Secure Cloud Storage</h4><p>Enterprise-grade storage with encryption, CDN, and automatic backup solutions.</p></div>
                        <div class="why-card reveal"><div class="shiny-overlay"></div><div class="why-icon"><svg height="50" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/></svg></div><h4>GitHub Integration</h4><p>Professional version control, CI/CD pipelines, and collaborative development workflows.</p></div>
                        <div class="why-card reveal"><div class="shiny-overlay"></div><div class="why-icon">📍</div><h4>Remote, South African</h4><p>Based in South Africa. Remote & international support, and personalized service you can trust.</p></div>
                    </div>
                </div>
            </section>

            <!-- TECHNOLOGY SHOWCASE -->
            <section class="section">
                <div class="container">
                    <div class="section-header reveal">
                        <h2>Technologies <span class="gradient-text">We Master</span></h2>
                        <p>Modern tools and frameworks for enterprise-grade solutions</p>
                    </div>
                    <div class="tech-showcase reveal">
                        <div class="tech-category"><h4>Backend & Web</h4><div class="tech-badges"><span>Laravel</span><span>PHP</span><span>Node.js</span><span>MySQL</span><span>PostgreSQL</span><span>Redis</span></div></div>
                        <div class="tech-category"><h4>Mobile Development</h4><div class="tech-badges"><span>Flutter</span><span>Dart</span><span>Firebase</span><span>REST APIs</span><span>GraphQL</span></div></div>
                        <div class="tech-category"><h4>DevOps & Cloud</h4><div class="tech-badges"><span>Docker</span><span>GitHub Actions</span><span>CI/CD</span><span>Ubuntu</span><span>Nginx</span><span>Apache</span></div></div>
                        <div class="tech-category"><h4>Storage & Databases</h4><div class="tech-badges"><span>S3 Storage</span><span>CDN</span><span>MongoDB</span><span>Backup Solutions</span></div></div>
                    </div>
                </div>
            </section>

            <!-- CONTACT & QUOTE SECTION -->
            <section id="contact" class="section">
                <div class="container">
                    <div class="section-header reveal">
                        <h2>Get In <span class="gradient-text">Touch</span></h2>
                        <p>We'd love to hear about your project. Reach out to us today!</p>
                    </div>
                    
                    <div class="contact-tabs-container reveal">
                        <div class="contact-tabs-header">
                            <button class="contact-tab-btn active" data-contact-tab="contact-us">📞 Contact Us</button>
                            <button class="contact-tab-btn" data-contact-tab="request-quote">💰 Request a Quote</button>
                        </div>
                        
                        <div class="contact-tab-pane active" id="contact-us">
                            <div class="contact-grid">
                                <div class="contact-info">
                                    <h3>Contact Information</h3>
                                    <div class="contact-details">
                                        <div class="contact-item"><span class="contact-icon">📞</span><div><strong>Phone / WhatsApp</strong><p><a href="{{ env('WHATSAPP_URL') }}" target="_blank">{{ env('COMPANY_PHONE') }}</a></p></div></div>
                                        <div class="contact-item"><span class="contact-icon">✉️</span><div><strong>Email</strong><p><a href="mailto:{{ env('COMPANY_EMAIL') }}">{{ env('COMPANY_EMAIL') }}</a></p></div></div>
                                        <div class="contact-item"><span class="contact-icon">📍</span><div><strong>Location</strong><p>{{ env('COMPANY_ADDRESS') }}</p></div></div>
                                        <div class="contact-item"><span class="contact-icon">🕒</span><div><strong>Business Hours</strong><p>{{ env('BUSINESS_HOURS') }}</p></div></div>
                                    </div>
                                    <div class="contact-social">
                                        <h4>Follow Us</h4>
                                        <div class="social-links">
                                            <a href="{{ env('WHATSAPP_URL') }}" target="_blank" class="social-link">📱 WhatsApp</a>
                                            <a href="{{ env('LINKEDIN_URL') }}" target="_blank" class="social-link">🔗 LinkedIn</a>
                                            <a href="https://github.com/kravhuravhu" target="_blank" class="social-link"><svg height="15" viewBox="0 0 16 16" fill="currentColor"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/></svg> GitHub</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="contact-form-wrapper">
                                    <form id="contactForm" class="contact-form" method="POST" action="">
                                        @csrf
                                        <div class="form-row"><div class="form-group"><label>Full Name <span>*</span></label><input type="text" name="name" placeholder="Enter your full name" required></div><div class="form-group"><label>Company / Organization</label><input type="text" name="company" placeholder="Enter your company name"></div></div>
                                        <div class="form-row"><div class="form-group"><label>Email Address <span>*</span></label><input type="email" name="email" placeholder="your.email@company.com" required></div><div class="form-group"><label>Phone Number <span>*</span></label><input type="tel" name="phone" placeholder="+27 XX XXX XXXX" required></div></div>
                                        <div class="form-group"><label>Subject <span>*</span></label><input type="text" name="subject" placeholder="Brief subject line" required></div>
                                        <div class="form-group"><label>Message <span>*</span></label><textarea name="message" rows="5" placeholder="Tell us about your inquiry..." required></textarea></div>
                                        <div class="checkbox-group"><input type="checkbox" name="consent" id="contact_consent" required><label for="contact_consent">I consent to being contacted regarding this inquiry. <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a></label></div>
                                        <button type="submit" class="submit-btn"><span>Send Message</span><i class="arrow">→</i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contact-tab-pane" id="request-quote">
                            <div class="quote-grid">
                                <div class="quote-info">
                                    <h3>Request a Custom Quote</h3>
                                    <p>Tell us about your project requirements and we'll get back to you with a tailored solution and pricing.</p>
                                    <div class="quote-features"><div class="quote-feature"><span>✅</span><div><strong>Free Consultation</strong><p>Initial consultation to understand your needs</p></div></div><div class="quote-feature"><span>✅</span><div><strong>Customized Solutions</strong><p>Tailored recommendations based on your requirements</p></div></div><div class="quote-feature"><span>✅</span><div><strong>Transparent Pricing</strong><p>No hidden costs, clear breakdown of services</p></div></div><div class="quote-feature"><span>✅</span><div><strong>24hr Response Time</strong><p>Quick turnaround on all quote requests</p></div></div></div>
                                </div>
                                <div class="quote-form-wrapper">
                                    <form id="quoteForm" class="contact-form" method="POST" action="">
                                        @csrf
                                        <div class="form-row"><div class="form-group"><label>Full Name <span>*</span></label><input type="text" name="name" placeholder="Enter your full name" required></div><div class="form-group"><label>Company / Organization <span>*</span></label><input type="text" name="company" placeholder="Enter your company name" required></div></div>
                                        <div class="form-row"><div class="form-group"><label>Email Address <span>*</span></label><input type="email" name="email" placeholder="your.email@company.com" required></div><div class="form-group"><label>Phone Number <span>*</span></label><input type="tel" name="phone" placeholder="+27 XX XXX XXXX" required></div></div>
                                        <div class="form-group"><label>Service of Interest <span>*</span></label><select name="service" required><option value="">Select a service</option><option value="web-development">Web Development (Laravel)</option><option value="mobile-app">Mobile App (Flutter)</option><option value="vm-hosting">VM Hosting & Server Management</option><option value="cloud-storage">Cloud Storage Solutions</option><option value="database">Database Solutions</option><option value="devops">DevOps & GitHub</option><option value="design">Design Services</option><option value="multiple">Multiple / Custom Package</option></select></div>
                                        <div class="form-group"><label>Project Budget Range</label><select name="budget"><option value="">Select budget range (optional)</option><option value="under-5k">Under R5,000</option><option value="5k-10k">R5,000 - R10,000</option><option value="10k-20k">R10,000 - R20,000</option><option value="20k-50k">R20,000 - R50,000</option><option value="50k-plus">R50,000+</option></select></div>
                                        <div class="form-group"><label>Project Timeline</label><select name="timeline"><option value="">Select timeline (optional)</option><option value="asap">ASAP (within 2 weeks)</option><option value="1-month">1 month</option><option value="1-3-months">1-3 months</option><option value="3-plus">3+ months</option><option value="flexible">Flexible / Not sure</option></select></div>
                                        <div class="form-group"><label>Project Details / Requirements <span>*</span></label><textarea name="message" rows="5" placeholder="Please describe your project requirements, goals, and any specific features you need..." required></textarea></div>
                                        <div class="form-row"><div class="form-group"><label>Do you have existing branding?</label><select name="has_branding"><option value="">Select</option><option value="yes">Yes, I have existing branding</option><option value="no">No, need design services</option><option value="partial">Partially / In progress</option></select></div><div class="form-group"><label>Do you have existing hosting?</label><select name="has_hosting"><option value="">Select</option><option value="yes">Yes, I have hosting</option><option value="no">No, need hosting</option><option value="unsure">Not sure / Need advice</option></select></div></div>
                                        <div class="checkbox-group"><input type="checkbox" name="consent" id="quote_consent" required><label for="quote_consent">I consent to being contacted regarding this quote request. <a href="{{ route('privacy') }}" target="_blank">Privacy Policy</a></label></div>
                                        <button type="submit" class="submit-btn"><span>Request Quote</span><i class="arrow">→</i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <div class="container">
                <div class="cta-section reveal">
                    <h2>Ready to Build Your Digital Presence?</h2>
                    <p>Get {{ env('FIRST_CLIENT_DISCOUNT') }}% off your first project — web development, mobile app, or hosting package.</p>
                    <div class="hero-buttons" style="justify-content: center;">
                        <a href="{{ env('WHATSAPP_URL') }}" target="_blank" class="btn btn-primary btn-large">📱 WhatsApp Us</a>
                        <a href="mailto:{{ env('COMPANY_EMAIL') }}" class="btn btn-outline btn-large">📧 Email Us</a>
                        <a href="#contact" class="btn btn-outline btn-large">📋 Request Quote</a>
                    </div>
                </div>
            </div>
        </main>

        @include('components.footer')

        <script src="{{ secure_asset('js/darkmode.js') }}"></script>
        <script src="{{ secure_asset('js/typing.js') }}"></script>
        <script src="{{ secure_asset('js/reveal.js') }}"></script>
        <script src="{{ secure_asset('js/spring-animation.js') }}"></script>
        <script src="{{ secure_asset('js/form-handler.js') }}"></script>

        <script>
            (function() {
                const SECTIONS = [
                    { id: 'home', path: '/', name: 'Home' },
                    { id: 'all-services', path: '/services', name: 'Services' },
                    { id: 'design-services', path: '/design', name: 'Design' },
                    { id: 'packages', path: '/packages', name: 'Packages' },
                    { id: 'why-choose-us', path: '/why-us', name: 'Why Us' },
                    { id: 'contact', path: '/contact', name: 'Contact' }
                ];

                let currentActiveSection = '{{ $activeSection }}';
                let isScrollingProgrammatically = false;
                let scrollTimeout = null;
                let pendingScroll = null;

                function getNavbarHeight() {
                    const navbar = document.getElementById('navbar');
                    return navbar ? navbar.offsetHeight : 80;
                }

                function getSectionElement(sectionId) {
                    return document.getElementById(sectionId);
                }

                function updateActiveState(sectionId) {
                    if (currentActiveSection === sectionId) return;
                    
                    currentActiveSection = sectionId;
                    
                    // Update all nav links
                    document.querySelectorAll('.nav-links a, .mobile-nav-links a').forEach(link => {
                        const linkSection = link.getAttribute('data-section');
                        if (linkSection === sectionId) {
                            link.classList.add('active');
                        } else {
                            link.classList.remove('active');
                        }
                    });
                }

                function updateUrl(sectionId) {
                    const section = SECTIONS.find(s => s.id === sectionId);
                    if (!section) return;
                    
                    const newPath = section.path;
                    const currentPath = window.location.pathname;
                    
                    if (currentPath !== newPath) {
                        history.pushState(null, '', newPath);
                    }
                }

                function updateMetaTags(sectionId) {
                    if (typeof window.updateSectionMeta === 'function') {
                        window.updateSectionMeta(sectionId);
                    }
                }

                function scrollToSection(sectionId, smooth = true) {
                    if (!sectionId) return;
                    
                    if (isScrollingProgrammatically) {
                        pendingScroll = { sectionId, smooth };
                        return;
                    }
                    
                    if (sectionId === 'home') {
                        isScrollingProgrammatically = true;
                        window.scrollTo({
                            top: 0,
                            behavior: smooth ? 'smooth' : 'auto'
                        });
                        setTimeout(() => {
                            isScrollingProgrammatically = false;
                            if (pendingScroll) {
                                const pending = pendingScroll;
                                pendingScroll = null;
                                scrollToSection(pending.sectionId, pending.smooth);
                            }
                        }, 800);
                        return;
                    }
                    
                    const targetElement = getSectionElement(sectionId);
                    if (!targetElement) return;
                    
                    isScrollingProgrammatically = true;
                    
                    const navbarHeight = getNavbarHeight();
                    const targetPosition = targetElement.offsetTop - navbarHeight - 20;
                    
                    window.scrollTo({
                        top: Math.max(0, targetPosition),
                        behavior: smooth ? 'smooth' : 'auto'
                    });
                    
                    setTimeout(() => {
                        isScrollingProgrammatically = false;
                        if (pendingScroll) {
                            const pending = pendingScroll;
                            pendingScroll = null;
                            scrollToSection(pending.sectionId, pending.smooth);
                        }
                    }, 800);
                }

                function getCurrentSectionFromScroll() {
                    const scrollY = window.scrollY;
                    const navbarHeight = getNavbarHeight();
                    const viewportHeight = window.innerHeight;
                    const totalHeight = document.body.scrollHeight;
                    
                    // At the very top
                    if (scrollY < navbarHeight + 50) {
                        return 'home';
                    }
                    
                    // Near the bottom
                    if (scrollY + viewportHeight >= totalHeight - 100) {
                        return 'contact';
                    }
                    
                    // Check each section
                    for (const section of SECTIONS) {
                        const element = getSectionElement(section.id);
                        if (element) {
                            const offsetTop = element.offsetTop - navbarHeight - 50;
                            const offsetBottom = element.offsetTop + element.offsetHeight - navbarHeight;
                            
                            if (scrollY >= offsetTop && scrollY < offsetBottom) {
                                return section.id;
                            }
                        }
                    }
                    
                    return currentActiveSection;
                }

                function handleScroll() {
                    if (isScrollingProgrammatically) return;
                    
                    if (scrollTimeout) clearTimeout(scrollTimeout);
                    
                    scrollTimeout = setTimeout(() => {
                        const currentSection = getCurrentSectionFromScroll();
                        
                        if (currentSection && currentSection !== currentActiveSection) {
                            updateActiveState(currentSection);
                            updateUrl(currentSection);
                            updateMetaTags(currentSection);
                        }
                        
                        const navbar = document.getElementById('navbar');
                        if (navbar) {
                            if (window.scrollY > 50) {
                                navbar.classList.add('scrolled');
                            } else {
                                navbar.classList.remove('scrolled');
                            }
                        }
                    }, 50);
                }

                function handleNavClick(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const link = e.currentTarget;
                    const targetSection = link.getAttribute('data-section');
                    
                    if (!targetSection) return;
                    
                    const mobileMenu = document.getElementById('mobileMenu');
                    const overlay = document.getElementById('overlay');
                    if (mobileMenu && mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        if (overlay) overlay.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                    
                    updateActiveState(targetSection);
                    updateUrl(targetSection);
                    updateMetaTags(targetSection);
                    
                    scrollToSection(targetSection, true);
                }

                function handleHashClick(e) {
                    const href = this.getAttribute('href');
                    if (!href || !href.startsWith('#')) return;
                    
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const targetId = href.substring(1);
                    const section = SECTIONS.find(s => s.id === targetId);
                    
                    if (section) {
                        updateActiveState(section.id);
                        updateUrl(section.id);
                        updateMetaTags(section.id);
                        scrollToSection(section.id, true);
                    }
                }

                function handlePopState() {
                    const path = window.location.pathname;
                    let targetSection = 'home';
                    
                    for (const section of SECTIONS) {
                        if (section.path === path) {
                            targetSection = section.id;
                            break;
                        }
                    }
                    
                    updateActiveState(targetSection);
                    updateMetaTags(targetSection);
                    
                    if (!isScrollingProgrammatically) {
                        scrollToSection(targetSection, false);
                    }
                }

                function openMobileMenu() {
                    const mobileMenu = document.getElementById('mobileMenu');
                    const overlay = document.getElementById('overlay');
                    if (mobileMenu) mobileMenu.classList.add('active');
                    if (overlay) overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
                
                function closeMobileMenu() {
                    const mobileMenu = document.getElementById('mobileMenu');
                    const overlay = document.getElementById('overlay');
                    if (mobileMenu) mobileMenu.classList.remove('active');
                    if (overlay) overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }

                function init() {
                    document.querySelectorAll('.nav-links a, .mobile-nav-links a').forEach(link => {
                        link.removeEventListener('click', handleNavClick);
                        link.addEventListener('click', handleNavClick);
                    });
                    
                    document.querySelectorAll('a[href^="#"]').forEach(link => {
                        if (!link.closest('.nav-links') && !link.closest('.mobile-nav-links')) {
                            link.removeEventListener('click', handleHashClick);
                            link.addEventListener('click', handleHashClick);
                        }
                    });
                    
                    window.removeEventListener('scroll', handleScroll);
                    window.addEventListener('scroll', handleScroll);
                    
                    window.removeEventListener('popstate', handlePopState);
                    window.addEventListener('popstate', handlePopState);

                    const menuBtn = document.getElementById('mobileMenuBtn');
                    const closeBtn = document.getElementById('closeMenuBtn');
                    const overlay = document.getElementById('overlay');
                    
                    if (menuBtn) {
                        menuBtn.removeEventListener('click', openMobileMenu);
                        menuBtn.addEventListener('click', openMobileMenu);
                    }
                    if (closeBtn) {
                        closeBtn.removeEventListener('click', closeMobileMenu);
                        closeBtn.addEventListener('click', closeMobileMenu);
                    }
                    if (overlay) {
                        overlay.removeEventListener('click', closeMobileMenu);
                        overlay.addEventListener('click', closeMobileMenu);
                    }

                    const initialPath = window.location.pathname;
                    if (initialPath !== '/') {
                        let initialSection = 'home';
                        for (const section of SECTIONS) {
                            if (section.path === initialPath) {
                                initialSection = section.id;
                                break;
                            }
                        }
                        
                        if (initialSection !== 'home') {
                            updateActiveState(initialSection);
                            setTimeout(() => {
                                scrollToSection(initialSection, false);
                            }, 100);
                        }
                    }
                    
                    document.querySelectorAll('.service-cat-btn').forEach(btn => {
                        btn.addEventListener('click', function() {
                            if (currentActiveSection !== 'all-services') {
                                updateActiveState('all-services');
                                updateUrl('all-services');
                                updateMetaTags('all-services');
                            }
                        });
                    });
                    
                    const navbar = document.getElementById('navbar');
                    if (navbar && window.scrollY > 50) {
                        navbar.classList.add('scrolled');
                    }
                }
                
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', init);
                } else {
                    init();
                }
            })();
        </script>

        <script>
            (function() {
                const contactTabBtns = document.querySelectorAll('.contact-tab-btn');
                const contactTabPanes = document.querySelectorAll('.contact-tab-pane');
                
                if (contactTabBtns.length > 0) {
                    function switchContactTab(tabId) {
                        contactTabBtns.forEach(btn => {
                            btn.classList.remove('active');
                        });
                        contactTabPanes.forEach(pane => {
                            pane.classList.remove('active');
                        });

                        const selectedBtn = document.querySelector(`.contact-tab-btn[data-contact-tab="${tabId}"]`);
                        if (selectedBtn) {
                            selectedBtn.classList.add('active');
                        }
                        
                        const selectedPane = document.getElementById(tabId);
                        if (selectedPane) {
                            selectedPane.classList.add('active');
                        }
                        
                        const newHash = tabId === 'contact-us' ? 'contact' : 'quote';
                        if (window.location.hash !== `#${newHash}`) {
                            history.pushState(null, null, `#${newHash}`);
                        }
                    }
                    
                    contactTabBtns.forEach(btn => {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            const tabId = this.getAttribute('data-contact-tab');
                            if (tabId) {
                                switchContactTab(tabId);
                            }
                        });
                    });

                    function checkHashForTab() {
                        const hash = window.location.hash;
                        if (hash === '#quote') {
                            switchContactTab('request-quote');
                        } else if (hash === '#contact') {
                            switchContactTab('contact-us');
                        }
                    }

                    window.addEventListener('hashchange', checkHashForTab);

                    checkHashForTab();
                }
            })();
        </script>

        <script>
            (function() {
                const serviceCatBtns = document.querySelectorAll('.service-cat-btn');
                const serviceCatPanes = document.querySelectorAll('.service-category-pane');
                
                if (serviceCatBtns.length > 0 && serviceCatPanes.length > 0) {
                    function switchServiceCategory(categoryId) {
                        serviceCatBtns.forEach(btn => {
                            const btnCat = btn.getAttribute('data-cat');
                            if (btnCat === categoryId) {
                                btn.classList.add('active');
                            } else {
                                btn.classList.remove('active');
                            }
                        });
                        
                        serviceCatPanes.forEach(pane => {
                            const paneId = pane.getAttribute('id');
                            if (paneId === `cat-${categoryId}`) {
                                pane.classList.add('active');
                            } else {
                                pane.classList.remove('active');
                            }
                        });
                    }
                    
                    serviceCatBtns.forEach(btn => {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            const categoryId = this.getAttribute('data-cat');
                            if (categoryId) {
                                switchServiceCategory(categoryId);
                            }
                        });
                    });
                }
            })();
        </script>
    </body>
</html>