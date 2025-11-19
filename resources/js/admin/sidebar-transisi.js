/**
 * Sidebar Mode Transition Handler
 * Mengelola transisi smooth untuk menampilkan/menyembunyikan menu sidebar sesuai mode
 */

class SidebarTransition {
    constructor() {
        this.currentMode = localStorage.getItem('dashboardMode') || 'bengkel';
        this.transitionDuration = 300; // ms
        this.init();
    }

    init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    setup() {
        const bengkelSection = document.getElementById('sidebar-bengkel-section');
        const websiteSection = document.getElementById('sidebar-website-section');

        if (!bengkelSection || !websiteSection) {
            console.warn('Sidebar mode sections not found');
            return;
        }

        // Set initial state
        this.switchMode(this.currentMode, false);

        // Listen for mode switch events from dashboard
        document.addEventListener('dashboardModeSwitched', (e) => {
            this.currentMode = e.detail.mode;
            this.switchMode(this.currentMode, true);
        });

        // Also listen for the old event name for compatibility
        document.addEventListener('dashboardModeSwitch', (e) => {
            this.currentMode = e.detail.mode;
            this.switchMode(this.currentMode, true);
        });

        // Listen for localStorage changes (in case mode is changed in another tab)
        window.addEventListener('storage', (e) => {
            if (e.key === 'dashboardMode') {
                this.currentMode = e.newValue || 'bengkel';
                this.switchMode(this.currentMode, true);
            }
        });
    }

    switchMode(mode, animate = true) {
        const bengkelSection = document.getElementById('sidebar-bengkel-section');
        const websiteSection = document.getElementById('sidebar-website-section');

        if (!bengkelSection || !websiteSection) {
            return;
        }

        // Validate mode
        if (mode !== 'bengkel' && mode !== 'website') {
            console.warn(`Invalid mode: ${mode}`);
            return;
        }

        this.currentMode = mode;

        if (animate) {
            // Animate transition
            if (mode === 'bengkel') {
                this.fadeOut(websiteSection, () => {
                    this.fadeIn(bengkelSection);
                });
            } else {
                this.fadeOut(bengkelSection, () => {
                    this.fadeIn(websiteSection);
                });
            }
        } else {
            // Set initial state without animation
            if (mode === 'bengkel') {
                bengkelSection.classList.remove('hidden', 'opacity-0');
                bengkelSection.classList.add('opacity-100');
                websiteSection.classList.add('hidden', 'opacity-0');
                websiteSection.classList.remove('opacity-100');
            } else {
                websiteSection.classList.remove('hidden', 'opacity-0');
                websiteSection.classList.add('opacity-100');
                bengkelSection.classList.add('hidden', 'opacity-0');
                bengkelSection.classList.remove('opacity-100');
            }
        }
    }

    fadeOut(element, callback) {
        if (!element) return;
        
        element.style.transition = `opacity ${this.transitionDuration}ms ease-in-out, max-height ${this.transitionDuration}ms ease-in-out`;
        element.style.opacity = '0';
        element.style.maxHeight = element.scrollHeight + 'px';
        
        // Wait for opacity to fade
        setTimeout(() => {
            element.style.maxHeight = '0px';
        }, 50);
        
        setTimeout(() => {
            element.classList.add('hidden');
            element.style.opacity = '';
            element.style.maxHeight = '';
            element.style.transition = '';
            if (callback) callback();
        }, this.transitionDuration);
    }

    fadeIn(element) {
        if (!element) return;
        
        element.classList.remove('hidden');
        element.style.transition = `opacity ${this.transitionDuration}ms ease-in-out, max-height ${this.transitionDuration}ms ease-in-out`;
        element.style.opacity = '0';
        element.style.maxHeight = '0px';
        
        // Force reflow to ensure transition works
        element.offsetHeight;
        
        requestAnimationFrame(() => {
            element.style.maxHeight = element.scrollHeight + 'px';
            element.style.opacity = '1';
        });
        
        // Clean up after transition
        setTimeout(() => {
            element.style.maxHeight = '';
            element.style.transition = '';
        }, this.transitionDuration);
    }

    getCurrentMode() {
        return this.currentMode;
    }
}

// Initialize sidebar transition
const sidebarTransition = new SidebarTransition();

// Export for use in other scripts if needed
if (typeof window !== 'undefined') {
    window.sidebarTransition = sidebarTransition;
}

export default sidebarTransition;

