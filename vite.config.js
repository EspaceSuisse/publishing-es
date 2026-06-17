import { defineConfig } from 'vite'

export default defineConfig({
  build: {
    outDir: 'web',
    emptyOutDir: false,
    manifest: true,
    rollupOptions: {
      input: 'src/css/app.css',
      output: {
        // stable filename so your template reference never changes
        assetFileNames: 'css/app.[hash].css'
      }
    }
  }
})