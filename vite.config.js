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
                'resources/js/admin/dashboard-transisi.js',
                'resources/js/admin/sidebar-transisi.js',
                'resources/js/admin/dashboard-waktu.js',
                'resources/js/admin/kalender.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: 'localhost',
        port: 3000,
    },
});