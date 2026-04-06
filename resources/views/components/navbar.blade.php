@php
    $navItems = [
        ['href' => '/#home', 'label' => 'Home', 'id' => 'home'],
        ['href' => '/#all-services', 'label' => 'Services', 'id' => 'all-services'],
        ['href' => '/#design-services', 'label' => 'Design', 'id' => 'design-services'],
        ['href' => '/#packages', 'label' => 'Packages', 'id' => 'packages'],
        ['href' => '/#why-choose-us', 'label' => 'Why Us', 'id' => 'why-choose-us'],
        ['href' => '/#contact', 'label' => 'Contact', 'id' => 'contact'],
    ];
@endphp

<nav class="navbar" id="navbar">
    <div class="nav-container">
        <a href="/" class="logo" id="logoLink">
            <img id="navLogo" src="{{ secure_asset('images/original_logo_bg.png') }}" alt="Arrithnius Solution Logo" style="display: block;"/>
        </a>
        
        <div class="nav-links">
            @foreach($navItems as $item)
                <a href="{{ $item['href'] }}" class="nav-link" data-section="{{ $item['id'] }}">{{ $item['label'] }}</a>
            @endforeach
        </div>
        
        <div class="nav-actions">
            <button class="darkmode-toggle" aria-label="Toggle theme" id="themeToggle">☾</button>
            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">☰</button>
        </div>
    </div>
</nav>

<div class="mobile-menu" id="mobileMenu">
    <button class="close-btn" id="closeMenuBtn" aria-label="Close">✕</button>
    <div class="mobile-nav-links">
        @foreach($navItems as $item)
            <a href="{{ $item['href'] }}" data-section="{{ $item['id'] }}">{{ $item['label'] }}</a>
        @endforeach
    </div>
</div>
<div class="overlay" id="overlay"></div>

<script>
    (function() {
        const navbar = document.getElementById('navbar');
        const menuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeBtn = document.getElementById('closeMenuBtn');
        const overlay = document.getElementById('overlay');
        const navLinks = document.querySelectorAll('.nav-links a');
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-links a');
        const allNavLinks = [...navLinks, ...mobileNavLinks];

        function getSections() {
            const sections = [];
            const navItemIds = ['home', 'all-services', 'design-services', 'packages', 'why-choose-us', 'contact'];
            
            navItemIds.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    sections.push(element);
                }
            });
            
            return sections;
        }

        function updateActiveLink() {
            const sections = getSections();
            if (sections.length === 0) return;
            
            const scrollPosition = window.scrollY;
            const viewportHeight = window.innerHeight;
            
            let activeSectionId = null;

            if (scrollPosition < 100) {
                activeSectionId = 'home';
            } else {
                for (let i = 0; i < sections.length; i++) {
                    const section = sections[i];
                    const sectionId = section.getAttribute('id');
                    const sectionTop = section.offsetTop;
                    const sectionBottom = sectionTop + section.offsetHeight;
                    
                    const triggerPoint = scrollPosition + viewportHeight * 0.3; // 30% down from top
                    
                    if (triggerPoint >= sectionTop && triggerPoint < sectionBottom) {
                        activeSectionId = sectionId;
                        break;
                    }
                    
                    if (i === sections.length - 1 && scrollPosition + viewportHeight >= sectionBottom - 100) {
                        activeSectionId = sectionId;
                        break;
                    }
                }
            }
            
            allNavLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (!href || href === '#') return;
                
                let linkSectionId = href.split('#')[1];
                if (!linkSectionId) return;
                
                if (linkSectionId === activeSectionId) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
            
            if (activeSectionId === 'all-services') {
                allNavLinks.forEach(link => {
                    if (link.getAttribute('href') === '/#all-services') {
                        link.classList.add('active');
                    }
                });
            }
        }

        function handleNavClick(e) {
            const link = e.currentTarget;
            const href = link.getAttribute('href');
            
            if (href && href !== '#' && href !== '') {
                const targetId = href.split('#')[1];
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    e.preventDefault();
                    
                    if (mobileMenu && mobileMenu.classList.contains('active')) {
                        closeMenu();
                    }
                    
                    const navbarHeight = navbar ? navbar.offsetHeight : 80;
                    const targetPosition = targetElement.offsetTop - navbarHeight - 20;
                    
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    history.pushState(null, null, href);
                    
                    allNavLinks.forEach(navLink => {
                        navLink.classList.remove('active');
                    });
                    link.classList.add('active');
                    
                    setTimeout(() => {
                        updateActiveLink();
                    }, 500);
                }
            }
        }

        let scrollTimeout;
        function handleScroll() {
            if (scrollTimeout) clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                updateActiveLink();
                handleNavbarScroll();
            }, 10);
        }
        
        function openMenu() {
            if (mobileMenu) mobileMenu.classList.add('active');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMenu() {
            if (mobileMenu) mobileMenu.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        function handleNavbarScroll() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }
        
        function init() {
            allNavLinks.forEach(link => {
                link.addEventListener('click', handleNavClick);
            });
            
            window.addEventListener('scroll', handleScroll);
            
            if (menuBtn) menuBtn.addEventListener('click', openMenu);
            if (closeBtn) closeBtn.addEventListener('click', closeMenu);
            if (overlay) overlay.addEventListener('click', closeMenu);
            
            window.addEventListener('hashchange', function() {
                updateActiveLink();
            });
            
            setTimeout(() => {
                updateActiveLink();
                handleNavbarScroll();
            }, 100);
            
            window.addEventListener('resize', function() {
                setTimeout(updateActiveLink, 100);
            });
            
            document.querySelectorAll('.service-cat-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    allNavLinks.forEach(link => {
                        if (link.getAttribute('href') === '/#all-services') {
                            link.classList.add('active');
                        }
                    });
                });
            });
        }
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
        } else {
            init();
        }
    })();
</script>