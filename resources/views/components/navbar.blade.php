@php
    $navItems = [
        ['href' => route('home'), 'label' => 'Home', 'id' => 'home', 'path' => '/'],
        ['href' => route('services'), 'label' => 'Services', 'id' => 'all-services', 'path' => '/services'],
        ['href' => route('design'), 'label' => 'Design', 'id' => 'design-services', 'path' => '/design'],
        ['href' => route('packages'), 'label' => 'Packages', 'id' => 'packages', 'path' => '/packages'],
        ['href' => route('why-us'), 'label' => 'Why Us', 'id' => 'why-choose-us', 'path' => '/why-us'],
        ['href' => route('contact'), 'label' => 'Contact', 'id' => 'contact', 'path' => '/contact'],
    ];
    
    $currentPath = $_SERVER['REQUEST_URI'] ?? '/';
    $activeSectionFromUrl = $activeSection ?? 'home';
@endphp

<nav class="navbar" id="navbar">
    <div class="nav-container">
        <a href="/" class="logo" id="logoLink">
            <img id="navLogo" src="{{ secure_asset('images/original_logo_bg.png') }}" alt="Arrithnius Solution (Pty) Ltd Logo" style="display: block;"/>
        </a>
        
        <div class="nav-links">
            @foreach($navItems as $item)
                <a href="{{ $item['href'] }}" 
                   class="nav-link {{ $activeSectionFromUrl === $item['id'] ? 'active' : '' }}" 
                   data-section="{{ $item['id'] }}"
                   data-path="{{ $item['path'] }}">{{ $item['label'] }}</a>
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
            <a href="{{ $item['href'] }}" 
               class="mobile-nav-link {{ $activeSectionFromUrl === $item['id'] ? 'active' : '' }}"
               data-section="{{ $item['id'] }}"
               data-path="{{ $item['path'] }}">{{ $item['label'] }}</a>
        @endforeach
    </div>
</div>
<div class="overlay" id="overlay"></div>

<script>
    (function() {
        const SECTION_MAP = [
            { id: 'home', selector: '#home', path: '/', index: 0 },
            { id: 'all-services', selector: '#all-services', path: '/services', index: 1 },
            { id: 'design-services', selector: '#design-services', path: '/design', index: 2 },
            { id: 'packages', selector: '#packages', path: '/packages', index: 3 },
            { id: 'why-choose-us', selector: '#why-choose-us', path: '/why-us', index: 4 },
            { id: 'contact', selector: '#contact', path: '/contact', index: 5 }
        ];
        
        let currentActiveSection = '{{ $activeSectionFromUrl }}';
        let isScrolling = false;
        let scrollTimeout = null;
        let pendingScroll = null;
        
        const navbar = document.getElementById('navbar');
        const allNavLinks = document.querySelectorAll('.nav-links a, .mobile-nav-links a');
        const mobileMenu = document.getElementById('mobileMenu');
        const overlay = document.getElementById('overlay');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeMenuBtn = document.getElementById('closeMenuBtn');
        
        function getNavbarHeight() {
            return navbar ? navbar.offsetHeight : 80;
        }
        
        function getSectionById(sectionId) {
            return SECTION_MAP.find(s => s.id === sectionId);
        }
        
        function getSectionElement(sectionId) {
            const section = getSectionById(sectionId);
            return section ? document.querySelector(section.selector) : null;
        }
        
        function updateActiveState(sectionId) {
            if (currentActiveSection === sectionId) return;
            
            currentActiveSection = sectionId;
            
            allNavLinks.forEach(link => {
                const linkSection = link.getAttribute('data-section');
                if (linkSection === sectionId) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }
        
        function updateUrl(sectionId) {
            const section = getSectionById(sectionId);
            if (!section) return;
            
            const newPath = section.path;
            const currentPath = window.location.pathname;
            
            if (currentPath !== newPath) {
                history.pushState({ section: sectionId }, '', newPath);
            }
        }
        
        function updateMetaTags(sectionId) {
            if (typeof window.updateSectionMeta === 'function') {
                window.updateSectionMeta(sectionId);
            }
        }
        
        function scrollToSection(sectionId, smooth = true) {
            if (!sectionId) return;
            
            // Special case for home
            if (sectionId === 'home') {
                window.scrollTo({
                    top: 0,
                    behavior: smooth ? 'smooth' : 'auto'
                });
                return;
            }
            
            const targetElement = getSectionElement(sectionId);
            if (!targetElement) return;
            
            isScrolling = true;
            
            const navbarHeight = getNavbarHeight();
            const targetPosition = targetElement.offsetTop - navbarHeight - 20;
            
            window.scrollTo({
                top: Math.max(0, targetPosition),
                behavior: smooth ? 'smooth' : 'auto'
            });
            
            setTimeout(() => {
                isScrolling = false;
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
            for (const section of SECTION_MAP) {
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
            if (isScrolling) return;
            
            if (scrollTimeout) clearTimeout(scrollTimeout);
            
            scrollTimeout = setTimeout(() => {
                const currentSection = getCurrentSectionFromScroll();
                
                if (currentSection && currentSection !== currentActiveSection) {
                    updateActiveState(currentSection);
                    updateUrl(currentSection);
                    updateMetaTags(currentSection);
                }

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
            const targetPath = link.getAttribute('data-path');
            
            if (!targetSection) return;

            if (mobileMenu && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }

            updateActiveState(targetSection);
            updateUrl(targetSection);
            updateMetaTags(targetSection);
            
            // Scroll to section
            scrollToSection(targetSection, true);
        }
        
        function handleHashClick(e) {
            const href = this.getAttribute('href');
            if (!href || !href.startsWith('#')) return;
            
            e.preventDefault();
            e.stopPropagation();
            
            const targetId = href.substring(1);
            const section = SECTION_MAP.find(s => s.id === targetId);
            
            if (section) {
                updateActiveState(section.id);
                updateUrl(section.id);
                updateMetaTags(section.id);
                scrollToSection(section.id, true);
            }
        }
        
        function openMobileMenu() {
            if (mobileMenu) mobileMenu.classList.add('active');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileMenu() {
            if (mobileMenu) mobileMenu.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        function handlePopState(e) {
            const path = window.location.pathname;
            let targetSection = 'home';
            
            for (const section of SECTION_MAP) {
                if (section.path === path) {
                    targetSection = section.id;
                    break;
                }
            }
            
            updateActiveState(targetSection);
            updateMetaTags(targetSection);
            
            pendingScroll = { sectionId: targetSection, smooth: false };
            if (!isScrolling) {
                scrollToSection(targetSection, false);
            }
        }

        function init() {
            if (navbar && window.scrollY > 50) {
                navbar.classList.add('scrolled');
            }
            
            allNavLinks.forEach(link => {
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

            if (mobileMenuBtn) {
                mobileMenuBtn.removeEventListener('click', openMobileMenu);
                mobileMenuBtn.addEventListener('click', openMobileMenu);
            }
            if (closeMenuBtn) {
                closeMenuBtn.removeEventListener('click', closeMobileMenu);
                closeMenuBtn.addEventListener('click', closeMobileMenu);
            }
            if (overlay) {
                overlay.removeEventListener('click', closeMobileMenu);
                overlay.addEventListener('click', closeMobileMenu);
            }
            
            const initialPath = window.location.pathname;
            if (initialPath !== '/') {
                let initialSection = 'home';
                for (const section of SECTION_MAP) {
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
                    const servicesLink = document.querySelector('.nav-links a[data-section="all-services"], .mobile-nav-links a[data-section="all-services"]');
                    if (servicesLink && currentActiveSection !== 'all-services') {
                        updateActiveState('all-services');
                        updateUrl('all-services');
                        updateMetaTags('all-services');
                    }
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