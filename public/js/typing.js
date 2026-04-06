(function() {
    const phrases = [
        '24/7 managed hosting with 99.9% uptime guarantee.',
        'Custom Laravel websites that scale with your business.',
        'Flutter mobile apps for iOS & Android from one codebase.',
        'Full SSH access to your own Linux virtual machines.',
        'Secure cloud storage for images, videos & backups.',
        'GitHub version control & CI/CD pipelines.',
        'Stand-alone database applications for your data.',
    ];
    
    let currentPhrase = 0;
    let currentChar = 0;
    let isDeleting = false;
    let typingSpeed = 80;
    
    const typingElement = document.getElementById('typing-text');
    if (!typingElement) return;
    
    function type() {
        const fullText = phrases[currentPhrase];
        
        if (isDeleting) {
            typingElement.textContent = fullText.substring(0, currentChar - 1);
            currentChar--;
            typingSpeed = 40;
        } else {
            typingElement.textContent = fullText.substring(0, currentChar + 1);
            currentChar++;
            typingSpeed = 80;
        }
        
        if (!isDeleting && currentChar === fullText.length) {
            isDeleting = true;
            typingSpeed = 2000;
        } else if (isDeleting && currentChar === 0) {
            isDeleting = false;
            currentPhrase = (currentPhrase + 1) % phrases.length;
            typingSpeed = 500;
        }
        
        setTimeout(type, typingSpeed);
    }
    
    type();
})();