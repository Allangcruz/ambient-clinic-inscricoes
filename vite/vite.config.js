import { defineConfig } from 'vite';

export default defineConfig({
  build: {
    // Gera o manifest para o PHP saber onde estão os arquivos com hash
    manifest: true, 
    outDir: 'public/vite/assets/js',
    rollupOptions: {
      // Substitua pelo caminho real do seu arquivo JS
      input: 'public/assets/js', 
    },
  },
  server: {
    // Necessário para o HMR (Hot Module Replacement) funcionar no CI4
    origin: 'http://localhost',
  },
});