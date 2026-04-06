(function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#' || href === '') return;
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.section, .hero').forEach(section => {
        section.style.opacity = '0';
        observer.observe(section);
    });
    
    const style = document.createElement('style');
    style.textContent = `
        .section, .hero {
            opacity: 0;
        }
        .section.animate-fade-up, .hero.animate-fade-up {
            opacity: 1;
        }
    `;
    document.head.appendChild(style);
})();