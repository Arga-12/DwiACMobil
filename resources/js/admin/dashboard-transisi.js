/**
 * Dashboard Mode Transition Handler
 * Mengelola transisi smooth antara mode Bengkel dan Website
 */

class DashboardTransition {
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
        const bengkelDashboard = document.getElementById('bengkelDashboard');
        const websiteDashboard = document.getElementById('websiteDashboard');

        if (!bengkelDashboard || !websiteDashboard) {
            console.warn('Dashboard elements not found');
            return;
        }

        // Set initial state
        this.switchMode(this.currentMode, false);

        // Listen for mode switch events from sidebar
        document.addEventListener('dashboardModeSwitch', (e) => {
            this.switchMode(e.detail.mode);
        });

        // Also listen for clicks on sidebar mode buttons if they exist
        const modeButtons = document.querySelectorAll('[data-dashboard-mode]');
        modeButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const mode = button.getAttribute('data-dashboard-mode');
                this.switchMode(mode);
            });
        });
    }

    switchMode(mode, animate = true) {
        const bengkelDashboard = document.getElementById('bengkelDashboard');
        const websiteDashboard = document.getElementById('websiteDashboard');

        if (!bengkelDashboard || !websiteDashboard) {
            return;
        }

        // Validate mode
        if (mode !== 'bengkel' && mode !== 'website') {
            console.warn(`Invalid mode: ${mode}`);
            return;
        }

        this.currentMode = mode;
        localStorage.setItem('dashboardMode', mode);

        // Dispatch event for sidebar transition
        document.dispatchEvent(new CustomEvent('dashboardModeSwitched', {
            detail: { mode }
        }));

        if (animate) {
            // Animate transition
            if (mode === 'bengkel') {
                this.fadeOut(websiteDashboard, () => {
                    this.fadeIn(bengkelDashboard);
                });
            } else {
                this.fadeOut(bengkelDashboard, () => {
                    this.fadeIn(websiteDashboard);
                });
            }
        } else {
            // Set initial state without animation
            if (mode === 'bengkel') {
                bengkelDashboard.classList.remove('hidden', 'opacity-0');
                bengkelDashboard.classList.add('opacity-100');
                websiteDashboard.classList.add('hidden', 'opacity-0');
                websiteDashboard.classList.remove('opacity-100');
            } else {
                websiteDashboard.classList.remove('hidden', 'opacity-0');
                websiteDashboard.classList.add('opacity-100');
                bengkelDashboard.classList.add('hidden', 'opacity-0');
                bengkelDashboard.classList.remove('opacity-100');
            }
        }
    }

    fadeOut(element, callback) {
        if (!element) return;
        
        element.style.transition = `opacity ${this.transitionDuration}ms ease-in-out`;
        element.style.opacity = '0';
        
        setTimeout(() => {
            element.classList.add('hidden');
            element.style.opacity = '';
            if (callback) callback();
        }, this.transitionDuration);
    }

    fadeIn(element) {
        if (!element) return;
        
        element.classList.remove('hidden');
        element.style.transition = `opacity ${this.transitionDuration}ms ease-in-out`;
        element.style.opacity = '0';
        
        // Force reflow to ensure transition works
        element.offsetHeight;
        
        requestAnimationFrame(() => {
            element.style.opacity = '1';
        });
        
        // Clean up after transition
        setTimeout(() => {
            element.style.transition = '';
        }, this.transitionDuration);
    }

    getCurrentMode() {
        return this.currentMode;
    }
}

// Initialize dashboard transition
const dashboardTransition = new DashboardTransition();

// Export for use in other scripts if needed
if (typeof window !== 'undefined') {
    window.dashboardTransition = dashboardTransition;
}

// Dispatch custom event to switch mode (can be called from anywhere)
window.switchDashboardMode = function(mode) {
    const event = new CustomEvent('dashboardModeSwitch', {
        detail: { mode }
    });
    document.dispatchEvent(event);
};

export default dashboardTransition;

