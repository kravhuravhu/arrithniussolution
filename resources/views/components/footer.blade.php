<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <a href="/" class="logo">
                    <span>Arrithnius</span>
                    <span style="color: var(--primary); font-weight: 600;">SOLUTION</span>
                </a>
                <p>Full-stack digital solutions: Web development, Flutter mobile apps, VM hosting, cloud storage, and database systems. Based in South Africa.</p>
                <p>{{ env('BUSINESS_HOURS') }}</p>
            </div>
            
            <div class="footer-column">
                <h4>Services</h4>
                <ul>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'devops\']')?.click()">DevOps & GitHub</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'web\']')?.click()">Web Development</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'mobile\']')?.click()">Mobile Apps (Flutter)</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'cloud\']')?.click()">VM & Cloud Hosting</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'storage\']')?.click()">Cloud Storage</a></li>
                    <li><a href="#all-services" onclick="document.querySelector('.service-cat-btn[data-cat=\'database\']')?.click()">Database Solutions</a></li>
                </ul>
            </div>
            
            <div class="footer-column">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#all-services">All Services</a></li>
                    <li><a href="#packages">Packages</a></li>
                    <li><a href="#contact-tab">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-contact">
                <h4>Contact Info</h4>
                <ul><br>
                    <li>📞  {{ env('COMPANY_PHONE') }}</li>
                    <li>✉️  {{ env('COMPANY_EMAIL') }}</li>
                    <li>📍  Remote, South Africa</li>
                    <li>github.com/kravhuravhu</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Arrithnius Solution. All Rights Reserved. | Mobile • Web • Cloud • Storage</p>
        </div>
    </div>
</footer>