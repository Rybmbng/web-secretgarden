import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: { // Tambahkan blok server ini, Bang!
        host: '0.0.0.0',
        hmr: {
            host: '192.168.2.242', // Sesuaikan dengan IP server Abang
        },
    },
});