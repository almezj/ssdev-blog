const colors = require('tailwindcss/colors')

module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      blue: colors.black,
      white: colors.white,
      gray: colors.gray,
      emerald: colors.emerald,
      indigo: colors.indigo,
      yellow: colors.yellow,
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ],
}