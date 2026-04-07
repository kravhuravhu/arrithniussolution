/**
 * Form Handler with Full-Page Overlay
 * Handles contact and quote form submissions with loading states
 */

class FormHandler {
    constructor() {
        this.overlay = null;
        this.isSubmitting = false;
        this.autoCloseTimeout = null;
        this.init();
    }

    init() {
        this.createOverlay();
        this.bindForms();
    }

    createOverlay() {
        // Create overlay element if it doesn't exist
        if (!document.getElementById('formOverlay')) {
            const overlayHTML = `
                <div id="formOverlay" class="form-overlay" style="display: none;">
                    <div class="form-overlay-content">
                        <button class="form-overlay-close" id="formOverlayClose">&times;</button>
                        <div class="form-overlay-status">
                            <div class="status-icon">
                                <svg class="loading-spinner" viewBox="0 0 50 50">
                                    <circle class="spinner-circle" cx="25" cy="25" r="20" fill="none" stroke="currentColor" stroke-width="4"/>
                                </svg>
                                <svg class="success-icon" viewBox="0 0 50 50" style="display: none;">
                                    <circle cx="25" cy="25" r="22" fill="none" stroke="currentColor" stroke-width="3"/>
                                    <polyline points="15,25 22,32 35,18" fill="none" stroke="currentColor" stroke-width="3"/>
                                </svg>
                                <svg class="error-icon" viewBox="0 0 50 50" style="display: none;">
                                    <circle cx="25" cy="25" r="22" fill="none" stroke="currentColor" stroke-width="3"/>
                                    <line x1="18" y1="18" x2="32" y2="32" stroke="currentColor" stroke-width="3"/>
                                    <line x1="32" y1="18" x2="18" y2="32" stroke="currentColor" stroke-width="3"/>
                                </svg>
                            </div>
                            <h3 class="status-title">Sending Message...</h3>
                            <p class="status-message">Please wait while we process your request.</p>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', overlayHTML);
            
            // Add styles for the overlay
            this.addStyles();
        }
        
        this.overlay = document.getElementById('formOverlay');
        const closeBtn = document.getElementById('formOverlayClose');
        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeOverlay());
        }
    }

    addStyles() {
        const styles = `
            <style>
                .form-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.85);
                    backdrop-filter: blur(8px);
                    z-index: 10000;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    opacity: 0;
                    transition: opacity 0.3s ease;
                }
                
                .form-overlay.active {
                    opacity: 1;
                }
                
                .form-overlay-content {
                    background: var(--bg-card, #111118);
                    border-radius: 32px;
                    padding: 48px 32px;
                    max-width: 400px;
                    width: 90%;
                    text-align: center;
                    position: relative;
                    border: 1px solid var(--border, #2a2a3a);
                    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                    transform: scale(0.9);
                    transition: transform 0.3s ease;
                }
                
                .form-overlay.active .form-overlay-content {
                    transform: scale(1);
                }
                
                .form-overlay-close {
                    position: absolute;
                    top: 16px;
                    right: 20px;
                    background: none;
                    border: none;
                    font-size: 28px;
                    cursor: pointer;
                    color: var(--text-secondary, #aaabdc);
                    transition: all 0.2s ease;
                    padding: 8px;
                    line-height: 1;
                }
                
                .form-overlay-close:hover {
                    color: var(--primary, #a460bf);
                    transform: rotate(90deg);
                }
                
                .status-icon {
                    width: 80px;
                    height: 80px;
                    margin: 0 auto 24px;
                    color: var(--primary, #a460bf);
                }
                
                .loading-spinner {
                    animation: spin 1s linear infinite;
                    width: 100%;
                    height: 100%;
                }
                
                .spinner-circle {
                    stroke-dasharray: 126;
                    stroke-dashoffset: 126;
                    animation: dash 1.5s ease-in-out infinite;
                }
                
                .success-icon, .error-icon {
                    width: 100%;
                    height: 100%;
                    animation: scaleIn 0.3s ease-out;
                }
                
                .success-icon {
                    color: #4caf50;
                }
                
                .error-icon {
                    color: #f44336;
                }
                
                .status-title {
                    font-size: 24px;
                    font-weight: 700;
                    margin-bottom: 12px;
                    color: var(--text-primary, #e5e6ff);
                }
                
                .status-message {
                    font-size: 14px;
                    color: var(--text-secondary, #aaabdc);
                    line-height: 1.5;
                }
                
                @keyframes spin {
                    100% { transform: rotate(360deg); }
                }
                
                @keyframes dash {
                    0% { stroke-dashoffset: 126; }
                    50% { stroke-dashoffset: 63; transform: rotate(135deg); }
                    100% { stroke-dashoffset: 126; transform: rotate(450deg); }
                }
                
                @keyframes scaleIn {
                    0% { transform: scale(0); opacity: 0; }
                    80% { transform: scale(1.1); }
                    100% { transform: scale(1); opacity: 1; }
                }
                
                @media (max-width: 576px) {
                    .form-overlay-content {
                        padding: 32px 24px;
                        width: 85%;
                    }
                    
                    .status-icon {
                        width: 60px;
                        height: 60px;
                    }
                    
                    .status-title {
                        font-size: 20px;
                    }
                }
            </style>
        `;
        if (!document.querySelector('#form-handler-styles')) {
            const styleEl = document.createElement('div');
            styleEl.id = 'form-handler-styles';
            styleEl.innerHTML = styles;
            document.head.appendChild(styleEl);
        }
    }

    showOverlay() {
        if (this.overlay) {
            this.overlay.style.display = 'flex';
            // Force reflow
            this.overlay.offsetHeight;
            this.overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    closeOverlay() {
        if (this.autoCloseTimeout) {
            clearTimeout(this.autoCloseTimeout);
            this.autoCloseTimeout = null;
        }
        
        if (this.overlay) {
            this.overlay.classList.remove('active');
            setTimeout(() => {
                this.overlay.style.display = 'none';
                document.body.style.overflow = '';
                // Reset to loading state for next submission
                this.resetOverlayState();
            }, 300);
        }
    }

    resetOverlayState() {
        const spinner = this.overlay?.querySelector('.loading-spinner');
        const successIcon = this.overlay?.querySelector('.success-icon');
        const errorIcon = this.overlay?.querySelector('.error-icon');
        const title = this.overlay?.querySelector('.status-title');
        const message = this.overlay?.querySelector('.status-message');
        
        if (spinner) spinner.style.display = 'block';
        if (successIcon) successIcon.style.display = 'none';
        if (errorIcon) errorIcon.style.display = 'none';
        if (title) title.textContent = 'Sending Message...';
        if (message) message.textContent = 'Please wait while we process your request.';
    }

    setLoadingState() {
        const spinner = this.overlay?.querySelector('.loading-spinner');
        const successIcon = this.overlay?.querySelector('.success-icon');
        const errorIcon = this.overlay?.querySelector('.error-icon');
        const title = this.overlay?.querySelector('.status-title');
        const message = this.overlay?.querySelector('.status-message');
        
        if (spinner) spinner.style.display = 'block';
        if (successIcon) successIcon.style.display = 'none';
        if (errorIcon) errorIcon.style.display = 'none';
        if (title) title.textContent = 'Sending Message...';
        if (message) message.textContent = 'Please wait while we process your request.';
    }

    setSuccessState(message) {
        const spinner = this.overlay?.querySelector('.loading-spinner');
        const successIcon = this.overlay?.querySelector('.success-icon');
        const title = this.overlay?.querySelector('.status-title');
        const msgEl = this.overlay?.querySelector('.status-message');
        
        if (spinner) spinner.style.display = 'none';
        if (successIcon) successIcon.style.display = 'block';
        if (title) title.textContent = '✓ Message Sent!';
        if (msgEl) msgEl.textContent = message || 'Your message has been sent successfully. We\'ll get back to you within 24 hours.';
        
        // Auto close after 7 seconds
        this.autoCloseTimeout = setTimeout(() => {
            this.closeOverlay();
        }, 7000);
    }

    setErrorState(message, errors = null) {
        const spinner = this.overlay?.querySelector('.loading-spinner');
        const errorIcon = this.overlay?.querySelector('.error-icon');
        const title = this.overlay?.querySelector('.status-title');
        const msgEl = this.overlay?.querySelector('.status-message');
        
        if (spinner) spinner.style.display = 'none';
        if (errorIcon) errorIcon.style.display = 'block';
        if (title) title.textContent = '✗ Something Went Wrong';
        
        let errorMessage = message || 'An error occurred. Please try again.';
        if (errors) {
            const errorList = Object.values(errors).flat().join(', ');
            errorMessage += `<br><small style="display: block; margin-top: 8px;">${errorList}</small>`;
        }
        if (msgEl) msgEl.innerHTML = errorMessage;
        
        // Auto close after 7 seconds
        this.autoCloseTimeout = setTimeout(() => {
            this.closeOverlay();
        }, 7000);
    }

    async submitForm(form, url) {
        if (this.isSubmitting) return;
        
        this.isSubmitting = true;
        this.showOverlay();
        this.setLoadingState();
        
        const formData = new FormData(form);
        
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                this.setSuccessState(data.message);
                form.reset(); // Clear the form on success
            } else {
                const errorMessage = data.message || 'Submission failed. Please try again.';
                this.setErrorState(errorMessage, data.errors);
            }
        } catch (error) {
            console.error('Form submission error:', error);
            this.setErrorState('Network error. Please check your connection and try again.');
        } finally {
            this.isSubmitting = false;
        }
    }

    bindForms() {
        // Bind contact form
        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.submitForm(contactForm, '/contact/send');
            });
        }
        
        // Bind quote form
        const quoteForm = document.getElementById('quoteForm');
        if (quoteForm) {
            quoteForm.addEventListener('submit', (e) => {
                e.preventDefault();
                this.submitForm(quoteForm, '/quote/request');
            });
        }
    }
}

// Initialize the form handler when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.formHandler = new FormHandler();
});