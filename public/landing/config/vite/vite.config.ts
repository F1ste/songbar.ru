import { defineConfig,  } from 'vite';
import {resolveRoot} from './utils';
import handlebars from 'vite-plugin-handlebars';
import autoprefixer from 'autoprefixer';

const outDir = resolveRoot('dist');
const root = resolveRoot('src');

const pages = {
  main: resolveRoot( 'src', 'index.html'),
}
export default defineConfig({
  base: './',
  publicDir: resolveRoot( 'public'),
  root,
  resolve: {
    alias: {
      '@components': resolveRoot('src', 'components'),
      '@public': resolveRoot( 'public'),
      '@pages': resolveRoot('src', 'pages'),
      '@scss': resolveRoot('src', 'scss'),
      '@ts': resolveRoot('src', 'ts'),
    },
  },
  server: {
    port: 3000,
    open: true,
  },
  build: {
    minify: false,
    outDir,
    emptyOutDir: true,
    rollupOptions: {
      input: pages,
      output: {
        entryFileNames: 'assets/[name].js',
        chunkFileNames: 'assets/[name]-[hash].js',
        assetFileNames: 'assets/[name]-[hash].[ext]',
      }

    }
  },
  css: {
    preprocessorOptions: {
      scss: {
        api: 'modern-compiler',
      },
      postcss:{
        plugins: [autoprefixer],
      }
    },
  },
  plugins: [
    handlebars({
      partialDirectory: resolveRoot('src', 'components'),
    }),
  ],
});
