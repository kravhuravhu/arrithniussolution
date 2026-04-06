(function() {
    const revealElements = document.querySelectorAll('.reveal, .fall-reveal');
    
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                
                // Add staggered delay for children elements
                const children = entry.target.querySelectorAll('.service-card, .package-card, .why-card, .design-item, .testimonial-card');
                children.forEach((child, index) => {
                    child.style.transitionDelay = `${index * 0.05}s`;
                });
                
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);
    
    revealElements.forEach(el => observer.observe(el));
})();