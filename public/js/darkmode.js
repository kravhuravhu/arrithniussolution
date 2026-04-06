(function() {
    const getTheme = () => localStorage.getItem('theme') || 'dark';
    
    const setTheme = (theme) => {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        updateIcon(theme);
        updateLogo(theme);
        updateButtonIcon(theme);
        
        window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme } }));
    };
    
    const updateIcon = (theme) => {
        const btn = document.querySelector('.darkmode-toggle');
        if (!btn) return;
        btn.innerHTML = theme === 'light' ? '☾' : '☀';
    };
    
    const updateButtonIcon = (theme) => {
        const themeBtns = document.querySelectorAll('.theme-toggle');
        themeBtns.forEach(btn => {
            btn.innerHTML = theme === 'light' ? '☾' : '☀';
        });
    };
    
    const updateLogo = (theme) => {
        const logo = document.getElementById('navLogo');
        if (!logo) return;
        
        if (theme === 'light') {
            logo.src = '/images/original_logo_bg.png';
        } else {
            logo.src = '/images/original_logo_lt.png';
        }
        
        logo.style.display = 'block';
    };
    
    const cycleTheme = () => {
        const current = getTheme();
        const newTheme = current === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    };
    
    const init = () => {
        setTheme(getTheme());
        
        const btn = document.querySelector('.darkmode-toggle');
        if (btn) {
            btn.addEventListener('click', cycleTheme);
        }
        
        const observer = new MutationObserver(() => {
            const newBtn = document.querySelector('.darkmode-toggle');
            if (newBtn && !newBtn.hasListener) {
                newBtn.addEventListener('click', cycleTheme);
                newBtn.hasListener = true;
            }
        });
        observer.observe(document.body, { childList: true, subtree: true });
    };
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();