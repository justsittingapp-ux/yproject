/**
 * Cookies Consent Banner
 * Displays a GDPR-compliant cookies consent banner on first visit
 */

(function() {
    'use strict';

    // Configuration
    const CONSENT_KEY = 'phagchen-ling-cookies-consent';
    const CONSENT_EXPIRY_DAYS = 365;

    /**
     * Check if consent has been given previously
     */
    function hasConsentBeenGiven() {
        const consent = localStorage.getItem(CONSENT_KEY);
        if (!consent) return null;

        const data = JSON.parse(consent);
        if (new Date().getTime() > data.expiry) {
            localStorage.removeItem(CONSENT_KEY);
            return null;
        }

        return data.accepted;
    }

    /**
     * Save consent choice to localStorage
     */
    function setConsent(accepted) {
        const expiry = new Date().getTime() + (CONSENT_EXPIRY_DAYS * 24 * 60 * 60 * 1000);
        localStorage.setItem(CONSENT_KEY, JSON.stringify({
            accepted: accepted,
            expiry: expiry,
            date: new Date().toISOString()
        }));
    }

    /**
     * Create and show the consent banner
     */
    function createBanner() {
        // Detect current language
        const lang = document.documentElement.lang || 'en';
        const isRomanian = lang.startsWith('ro');

        const bannerHTML = `
            <div id="cookies-consent-banner" class="cookies-consent-banner">
                <div class="cookies-consent-content">
                    <div class="cookies-consent-text">
                        <h3 class="cookies-consent-title">${isRomanian ? 'Politica de Cookies' : 'Cookies Policy'}</h3>
                        <p class="cookies-consent-message">
                            ${isRomanian 
                                ? 'Utilizez cookie-uri pentru a îmbunătăți experiența ta și pentru analitică anonimă. Citește <a href="' + getLocalizedPath('cookies-policy') + '" class="cookies-consent-link">politica de cookies</a> pentru mai multe detalii.'
                                : 'I use cookies to improve your experience and for anonymous analytics. Read the <a href="' + getLocalizedPath('cookies-policy') + '" class="cookies-consent-link">cookies policy</a> for more details.'
                            }
                        </p>
                    </div>
                    <div class="cookies-consent-actions">
                        <button id="cookies-accept-btn" class="cookies-consent-btn cookies-consent-btn-primary">
                            ${isRomanian ? 'Accept' : 'Accept'}
                        </button>
                        <button id="cookies-reject-btn" class="cookies-consent-btn cookies-consent-btn-secondary">
                            ${isRomanian ? 'Doar esențiale' : 'Essential Only'}
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('afterbegin', bannerHTML);

        // Attach event listeners
        document.getElementById('cookies-accept-btn').addEventListener('click', function() {
            setConsent(true);
            loadGoogleAnalytics();
            removeBanner();
        });

        document.getElementById('cookies-reject-btn').addEventListener('click', function() {
            setConsent(false);
            removeBanner();
        });

        // Add CSS styles
        injectStyles();
    }

    /**
     * Get localized path for a route
     */
    function getLocalizedPath(route) {
        const lang = document.documentElement.lang || 'en';
        const basePath = document.querySelector('meta[name="base-path"]')?.content || '';

        if (lang.startsWith('ro')) {
            const routeMap = {
                'cookies-policy': '/ro/politica-cookies'
            };
            return basePath + (routeMap[route] || '/ro/' + route);
        } else {
            const routeMap = {
                'cookies-policy': '/en/cookies-policy'
            };
            return basePath + (routeMap[route] || '/en/' + route);
        }
    }

    /**
     * Remove the banner from the DOM
     */
    function removeBanner() {
        const banner = document.getElementById('cookies-consent-banner');
        if (banner) {
            banner.classList.add('cookies-consent-hide');
            setTimeout(() => {
                banner.remove();
            }, 300);
        }
    }

    /**
     * Load Google Analytics if consent is given
     */
    function loadGoogleAnalytics() {
        // Google Analytics is already loaded in head.php
        // This function is here for future extensibility
    }

    /**
     * Inject CSS styles for the banner
     */
    function injectStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .cookies-consent-banner {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                box-sizing: border-box;
                background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
                border-top: 3px solid #D4AF37;
                padding: 1.5rem;
                z-index: 9999;
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.3);
                animation: slideUp 0.3s ease-out;
            }

            @keyframes slideUp {
                from {
                    transform: translateY(100%);
                    opacity: 0;
                }
                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }

            .cookies-consent-hide {
                animation: slideDown 0.3s ease-out;
            }

            @keyframes slideDown {
                from {
                    transform: translateY(0);
                    opacity: 1;
                }
                to {
                    transform: translateY(100%);
                    opacity: 0;
                }
            }

            .cookies-consent-content {
                max-width: 1200px;
                margin: 0 auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 2rem;
                flex-wrap: wrap;
            }

            .cookies-consent-text {
                flex: 1;
                min-width: 300px;
                color: #e0e0e0;
            }

            .cookies-consent-title {
                margin: 0 0 0.5rem 0;
                font-size: 1.1rem;
                color: #D4AF37;
                font-weight: 600;
            }

            .cookies-consent-message {
                margin: 0;
                font-size: 0.95rem;
                line-height: 1.5;
                color: #b0b0b0;
            }

            .cookies-consent-link {
                color: #D4AF37;
                text-decoration: none;
                border-bottom: 1px solid #D4AF37;
                transition: opacity 0.2s;
            }

            .cookies-consent-link:hover {
                opacity: 0.8;
            }

            .cookies-consent-actions {
                display: flex;
                gap: 1rem;
                flex-shrink: 0;
                white-space: nowrap;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .cookies-consent-btn {
                padding: 0.7rem 1.5rem;
                border: none;
                border-radius: 4px;
                font-size: 0.95rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.2s;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .cookies-consent-btn-primary {
                background-color: #D4AF37;
                color: #1a1a1a;
            }

            .cookies-consent-btn-primary:hover {
                background-color: #e6c547;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(212, 175, 55, 0.3);
            }

            .cookies-consent-btn-secondary {
                background-color: transparent;
                color: #D4AF37;
                border: 1px solid #D4AF37;
            }

            .cookies-consent-btn-secondary:hover {
                background-color: rgba(212, 175, 55, 0.1);
                border-color: #e6c547;
                color: #e6c547;
            }

            @media (max-width: 768px) {
                .cookies-consent-content {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1rem;
                }

                .cookies-consent-actions {
                    width: 100%;
                    justify-content: stretch;
                }

                .cookies-consent-btn {
                    flex: 1;
                }

                .cookies-consent-banner {
                    padding: 1rem;
                }

                .cookies-consent-message {
                    font-size: 0.9rem;
                }
            }
        `;
        document.head.appendChild(style);
    }

    /**
     * Initialize the banner on page load
     */
    function init() {
        // Wait for DOM to be fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                const hasConsent = hasConsentBeenGiven();
                if (hasConsent === null) {
                    // No previous consent, show banner
                    createBanner();
                }
            });
        } else {
            // DOM is already loaded
            const hasConsent = hasConsentBeenGiven();
            if (hasConsent === null) {
                createBanner();
            }
        }
    }

    // Start initialization
    init();
})();
