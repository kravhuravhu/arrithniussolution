<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <a href="/" class="logo" id="footerLogoLink">
                    <picture>
                        <source srcset="{{ secure_asset('images/original_logo_lt.png') }}" media="(prefers-color-scheme: dark)">
                        <source srcset="{{ secure_asset('images/original_logo_bg.png') }}" media="(prefers-color-scheme: light)">
                        <img id="footerLogo" 
                             src="{{ secure_asset('images/original_logo_bg.png') }}" 
                             alt="Arrithnius Solution Logo" 
                             class="footer-logo-img"
                             style="height: 50px; width: auto; object-fit: contain;" />
                    </picture>
                </a>
                <p>Full-stack digital solutions: Web development, Flutter mobile apps, VM hosting, cloud storage, and database systems. Based in South Africa.</p>
                <p><i class="far fa-clock"></i> {{ env('BUSINESS_HOURS', 'Mon-Fri: 9:00 - 17:00 SAST') }}</p>
            </div>
            
            <div class="footer-column">
                <h4><i class="fas fa-cogs"></i> Services</h4>
                <ul>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'devops\']')?.click(); return false;">DevOps & GitHub</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'web\']')?.click(); return false;">Web Development</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'mobile\']')?.click(); return false;">Mobile Apps (Flutter)</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'cloud\']')?.click(); return false;">VM & Cloud Hosting</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'storage\']')?.click(); return false;">Cloud Storage</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'database\']')?.click(); return false;">Database Solutions</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4><i class="fas fa-link"></i> Quick Links</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('services') }}">All Services</a></li>
                    <li><a href="{{ route('packages') }}">Packages</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4></i> Contact Info</h4>
                <br>
                <ul>
                    <li><i class="fas fa-phone-alt"></i>  {{ env('COMPANY_PHONE', '+27 XX XXX XXXX') }}</li>
                    <li><i class="fas fa-envelope"></i>  {{ env('COMPANY_EMAIL', 'info@arrithnius.co.za') }}</li>
                    <li><i class="fas fa-map-marker-alt"></i>  Remote, South Africa</li>
                    <li><i class="fab fa-github"></i>  Github:
                        <b>
                            <a href="{{ env('GITHUB_URL', 'https://github.com/kravhuravhu') }}" target="_blank" style="color: var(--primary);">
                                {{ env('GITHUB_USERNAME', 'kravhuravhu') }}
                            </a>
                        </b>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Arrithnius Solution. All Rights Reserved. | <i class="fas fa-mobile-alt"></i> Mobile • <i class="fas fa-globe"></i> Web • <i class="fas fa-cloud"></i> Cloud • <i class="fas fa-database"></i> Storage</p>
        </div>

        <!-- for seo -->
        <div class="seo-links" style="display: none;">
            <a href="https://www.arrithnius.co.za/">Home</a>
            <a href="https://www.arrithnius.co.za/services">Services</a>
            <a href="https://www.arrithnius.co.za/design">Design</a>
            <a href="https://www.arrithnius.co.za/packages">Packages</a>
            <a href="https://www.arrithnius.co.za/why-us">Why Us</a>
            <a href="https://www.arrithnius.co.za/contact">Contact</a>
        </div>
    </div>
</footer>

<script>
(function() {
    function updateFooterLogo() {
        const footerLogo = document.getElementById('footerLogo');
        if (!footerLogo) return;
        
        const theme = document.documentElement.getAttribute('data-theme') || 'dark';
        
        if (theme === 'light') {
            footerLogo.src = '{{ secure_asset("images/original_logo_bg.png") }}';
        } else {
            footerLogo.src = '{{ secure_asset("images/original_logo_lt.png") }}';
        }
    }

    window.addEventListener('themeChanged', function(e) {
        updateFooterLogo();
    });
    
    // Initial update
    updateFooterLogo();
})();
</script>