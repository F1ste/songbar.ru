declare module 'vite-plugin-handlebars' {
  import { Plugin } from 'vite';

  interface HandlebarsPluginOptions {
    partialDirectory?: string;
    context?: Record<string, any>;
  }

  export default function handlebarsPlugin(options?: HandlebarsPluginOptions): Plugin;
}