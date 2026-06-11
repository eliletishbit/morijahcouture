import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/assets/css/theme.min.css',
            ],
            refresh: true,
            // C'est crucial : cela indique à Laravel de regarder dans le dossier public
            publicDirectory: 'public',
        }),
    ],
    // La configuration serveur ci-dessous ne concerne que le mode "npm run dev"
    // Elle est ignorée en production (npm run build), ce qui est normal.
    server: {
        cors: true,
        hmr: {
            host: 'localhost',
        },
    },
    build: {
        // Force le build à sortir dans public/build
        outDir: 'public/build',
        manifest: true,

        rollupOptions: {
        output: {
            entryFileNames: `assets/[name].js`,
            chunkFileNames: `assets/[name].js`,
            assetFileNames: `assets/[name].[ext]`
        }
    }
    }
});