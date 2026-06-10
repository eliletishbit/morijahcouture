// import { defineConfig } from 'vite';
// import laravel from 'laravel-vite-plugin';

// export default defineConfig({
//     plugins: [
//         laravel({
//            input: [
//                 'resources/sass/app.scss',
//                 'resources/js/app.js',
//                 'resources/assets/css/theme.min.css',
//             ],
//             refresh: true,
//         }),
//     ],

// });

// nouveau vite js

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
        }),
    ],
    build: {
        manifest: true,
        rollupOptions: {
            output: {
                assetFileNames: 'assets/[name]-[hash][extname]',
                chunkFileNames: 'assets/[name]-[hash].js',
                entryFileNames: 'assets/[name]-[hash].js',
            }
        }
    },
    base: '/',  // ← Force les chemins relatifs pour la production
});