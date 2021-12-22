module.exports = {
    content: [
      './resources/views/**/*.blade.php',
      './resources/css/**/*.css',
    ],
    theme: {
      extend: {}
    },
    variants: {},
    plugins: [
      require('@tailwindcss/ui'),
    ]
  }
