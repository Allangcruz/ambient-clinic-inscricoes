import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    manifest: true, 
    outDir: '../public/vite/',
    rollupOptions: {
      // Substitua pelo caminho real do seu arquivo JS
      input: './src/main.js', 
    },
  },
  server: {
    host: '0.0.0.0', // Permite acesso externo ao contêiner
    port: 5173,
    strictPort: true,
    hmr: {
      host: 'localhost', // O navegador do Allan acessa via localhost
    },
    watch: {
      usePolling: true, // Necessário para detectar mudanças em volumes Docker
    },
  },
  css: {
     preprocessorOptions: {
        scss: {
          quietDeps: true,
          silenceDeprecations: [
            'import',
            'mixed-decls',
            'color-functions',
            'global-builtin',
          ],
        },
     },
  },
});