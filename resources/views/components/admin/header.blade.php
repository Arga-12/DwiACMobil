<!-- Admin Header Component dengan Toggle Mode -->
<header class="bg-[#0F044C] text-white h-16 sm:h-18 md:h-20 lg:h-24 relative flex items-center shadow-lg">
    <div class="grid grid-cols-3 items-center w-full px-3 sm:px-4 md:px-6 lg:px-8">
        <!-- Logo - Left -->
        <div class="flex items-center space-x-2 sm:space-x-3 md:space-x-4">
            <img src="{{ asset('images/logo.png') }}" alt="Dwi AC Mobil Logo" class="h-8 w-auto sm:h-10 md:h-12 lg:h-16">
        </div>

        <!-- Welcome Text - Center -->
        <div class="flex justify-center">
            <p class="bigparagraf text-xs sm:text-sm md:text-base lg:text-lg whitespace-nowrap text-center">
                Selamat Datang, {{ auth()->user()->nama }}!
            </p>
        </div>

        <!-- Mode Toggle Switch - Right -->
        <div class="flex justify-end">
            <div class="flex items-center space-x-3 bg-white/10 backdrop-blur-sm rounded-full px-4 py-2 border border-white/20">
                <!-- Bengkel Mode Label -->
                <div class="flex items-center space-x-2 transition-opacity duration-300" id="bengkelLabel">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                        <path fill="currentColor" fill-rule="evenodd" d="M6 1a1.75 1.75 0 0 0-1.75 1.75V4H3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.25V2.75A1.75 1.75 0 0 0 10 1zm4.25 3V2.75A.25.25 0 0 0 10 2.5H6a.25.25 0 0 0-.25.25V4zM3 5.5h10a.5.5 0 0 1 .5.5v1h-11V6a.5.5 0 0 1 .5-.5m-.5 3V13a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8.5H9V10H7V8.5z" clip-rule="evenodd"/>
                    </svg>
                    <span class="defparagraf text-xs sm:text-sm font-medium">Bengkel</span>
                </div>

                <!-- Toggle Switch -->
                <button
                    type="button"
                    id="modeToggle"
                    onclick="toggleDashboardMode()"
                    class="relative inline-flex h-6 w-11 sm:h-7 sm:w-14 items-center rounded-full transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#0F044C]"
                    role="switch"
                    aria-checked="false"
                    aria-label="Toggle dashboard mode"
                >
                    <!-- Background -->
                    <span class="absolute inset-0 rounded-full bg-[#787A91]"></span>

                    <!-- Slider -->
                    <span
                        id="toggleSlider"
                        class="relative inline-block h-4 w-4 sm:h-5 sm:w-5 transform rounded-full bg-white shadow-lg transition-transform duration-300 translate-x-1"
                    >
                        <span class="absolute inset-0 flex items-center justify-center p-0.5">
                            <!-- Icon inside slider -->
                            <svg class="w-full h-full text-[#0F044C]" id="sliderIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                                <path fill="currentColor" fill-rule="evenodd" d="M6 1a1.75 1.75 0 0 0-1.75 1.75V4H3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.25V2.75A1.75 1.75 0 0 0 10 1zm4.25 3V2.75A.25.25 0 0 0 10 2.5H6a.25.25 0 0 0-.25.25V4zM3 5.5h10a.5.5 0 0 1 .5.5v1h-11V6a.5.5 0 0 1 .5-.5m-.5 3V13a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8.5H9V10H7V8.5z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </span>
                </button>

                <!-- Website Mode Label -->
                <div class="flex items-center space-x-2 transition-opacity duration-300 opacity-50" id="websiteLabel">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M22 12a10 10 0 1 1-20.001 0A10 10 0 0 1 22 12Z"/>
                            <path d="M16 12c0 1.313-.104 2.614-.305 3.827c-.2 1.213-.495 2.315-.867 3.244c-.371.929-.812 1.665-1.297 2.168c-.486.502-1.006.761-1.531.761s-1.045-.259-1.53-.761c-.486-.503-.927-1.24-1.298-2.168c-.372-.929-.667-2.03-.868-3.244A23.6 23.6 0 0 1 8 12c0-1.313.103-2.614.304-3.827s.496-2.315.868-3.244c.371-.929.812-1.665 1.297-2.168C10.955 2.26 11.475 2 12 2s1.045.259 1.53.761c.486.503.927 1.24 1.298 2.168c.372.929.667 2.03.867 3.244C15.897 9.386 16 10.687 16 12Z"/>
                            <path stroke-linecap="round" d="M2 12h20"/>
                        </g>
                    </svg>
                    <span class="defparagraf text-xs sm:text-sm font-medium">Website</span>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Dashboard Mode Toggle Functionality
    // Menggunakan sistem transisi dari dashboard-transition.js
    let currentMode = localStorage.getItem('dashboardMode') || 'bengkel';

    function toggleDashboardMode() {
        const toggle = document.getElementById('modeToggle');
        const slider = document.getElementById('toggleSlider');
        const sliderIcon = document.getElementById('sliderIcon');
        const bengkelLabel = document.getElementById('bengkelLabel');
        const websiteLabel = document.getElementById('websiteLabel');

        // Toggle mode
        currentMode = currentMode === 'bengkel' ? 'website' : 'bengkel';

        // Update toggle UI
        if (currentMode === 'website') {
            toggle.setAttribute('aria-checked', 'true');
            slider.classList.remove('translate-x-1');
            slider.classList.add('translate-x-6', 'sm:translate-x-8');
            bengkelLabel.classList.add('opacity-50');
            websiteLabel.classList.remove('opacity-50');

            // Change slider icon to globe (scaled to fit 16x16 viewBox)
            sliderIcon.setAttribute('viewBox', '0 0 24 24');
            sliderIcon.innerHTML = '<g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12a10 10 0 1 1-20.001 0A10 10 0 0 1 22 12Z"/><path d="M16 12c0 1.313-.104 2.614-.305 3.827c-.2 1.213-.495 2.315-.867 3.244c-.371.929-.812 1.665-1.297 2.168c-.486.502-1.006.761-1.531.761s-1.045-.259-1.53-.761c-.486-.503-.927-1.24-1.298-2.168c-.372-.929-.667-2.03-.868-3.244A23.6 23.6 0 0 1 8 12c0-1.313.103-2.614.304-3.827s.496-2.315.868-3.244c.371-.929.812-1.665 1.297-2.168C10.955 2.26 11.475 2 12 2s1.045.259 1.53.761c.486.503.927 1.24 1.298 2.168c.372.929.667 2.03.867 3.244C15.897 9.386 16 10.687 16 12Z"/><path stroke-linecap="round" d="M2 12h20"/></g>';
        } else {
            toggle.setAttribute('aria-checked', 'false');
            slider.classList.add('translate-x-1');
            slider.classList.remove('translate-x-6', 'sm:translate-x-8');
            bengkelLabel.classList.remove('opacity-50');
            websiteLabel.classList.add('opacity-50');

            // Change slider icon back to briefcase
            sliderIcon.setAttribute('viewBox', '0 0 16 16');
            sliderIcon.innerHTML = '<path fill="currentColor" fill-rule="evenodd" d="M6 1a1.75 1.75 0 0 0-1.75 1.75V4H3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.25V2.75A1.75 1.75 0 0 0 10 1zm4.25 3V2.75A.25.25 0 0 0 10 2.5H6a.25.25 0 0 0-.25.25V4zM3 5.5h10a.5.5 0 0 1 .5.5v1h-11V6a.5.5 0 0 1 .5-.5m-.5 3V13a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8.5H9V10H7V8.5z" clip-rule="evenodd"/>';
        }

        // Trigger dashboard transition using the new system
        if (typeof window.switchDashboardMode === 'function') {
            window.switchDashboardMode(currentMode);
        } else {
            // Fallback if transition script not loaded yet
            const event = new CustomEvent('dashboardModeSwitch', {
                detail: { mode: currentMode }
            });
            document.dispatchEvent(event);
        }
    }

    // Initialize toggle state on page load
    document.addEventListener('DOMContentLoaded', function() {
        const savedMode = localStorage.getItem('dashboardMode') || 'bengkel';
        currentMode = savedMode;

        const toggle = document.getElementById('modeToggle');
        const slider = document.getElementById('toggleSlider');
        const sliderIcon = document.getElementById('sliderIcon');
        const bengkelLabel = document.getElementById('bengkelLabel');
        const websiteLabel = document.getElementById('websiteLabel');

        if (savedMode === 'website') {
            toggle.setAttribute('aria-checked', 'true');
            slider.classList.remove('translate-x-1');
            slider.classList.add('translate-x-6', 'sm:translate-x-8');
            bengkelLabel.classList.add('opacity-50');
            websiteLabel.classList.remove('opacity-50');

            // Same globe icon as website label (scaled to fit)
            sliderIcon.setAttribute('viewBox', '0 0 24 24');
            sliderIcon.innerHTML = '<g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12a10 10 0 1 1-20.001 0A10 10 0 0 1 22 12Z"/><path d="M16 12c0 1.313-.104 2.614-.305 3.827c-.2 1.213-.495 2.315-.867 3.244c-.371.929-.812 1.665-1.297 2.168c-.486.502-1.006.761-1.531.761s-1.045-.259-1.53-.761c-.486-.503-.927-1.24-1.298-2.168c-.372-.929-.667-2.03-.868-3.244A23.6 23.6 0 0 1 8 12c0-1.313.103-2.614.304-3.827s.496-2.315.868-3.244c.371-.929.812-1.665 1.297-2.168C10.955 2.26 11.475 2 12 2s1.045.259 1.53.761c.486.503.927 1.24 1.298 2.168c.372.929.667 2.03.867 3.244C15.897 9.386 16 10.687 16 12Z"/><path stroke-linecap="round" d="M2 12h20"/></g>';
        }
    });
</script>
