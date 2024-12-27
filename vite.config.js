import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd());
    const devServerUrl = new URL(env.VITE_DEV_SERVER_URL);

    return {
        server: {
            host: '0.0.0.0',
            hmr: {
                host: devServerUrl.hostname
            }
        },
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
<<<<<<< HEAD
            }),
        ],
    };
});
=======
            },
        }),
    ],
    build: {
        manifest: true,          // Enable manifest generation
        outDir: 'public/build',  // Specify output directory
        assetsDir: 'assets',     // Directory for assets (optional)
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});
>>>>>>> origin/feature/jbst-04
