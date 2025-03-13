import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/admin/css/app.css',
                'resources/admin/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
