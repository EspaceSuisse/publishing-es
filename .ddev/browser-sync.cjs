module.exports = {
  files: [
    'templates/**/*.twig',
    'templates/**/*.html',
    'web/theme/**/*.css',
    'web/theme/**/*.js',
  ],
  watchOptions: {
    ignored: [
      'node_modules',
      'vendor',
      'storage',
      'web/cpresources',
      '.git',
      '.ddev',
      '**/.DS_Store',
    ],
    ignoreInitial: true,
    usePolling: true,          // ← critical on macOS
    interval: 500,             // poll every 500ms
    binaryInterval: 1000,      // less frequent for images
    followSymlinks: false,
    awaitWriteFinish: {
      stabilityThreshold: 200,
      pollInterval: 100,
    },
  },
  proxy: {
    target: 'localhost:80',
  },
  open: false,
  ui: false,
  notify: true,
  reloadDebounce: 300,
  injectChanges: true,
  logLevel: 'info',
  logPrefix: 'BS',
};