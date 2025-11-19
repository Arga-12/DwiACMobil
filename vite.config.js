import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/dashboard_user/sidebar.js',
                'resources/js/admin/dashboard-transition.js',
                'resources/js/admin/sidebar-transition.js',
                'resources/js/admin/kalender.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});