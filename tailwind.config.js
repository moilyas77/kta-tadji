/** @type {import('tailwindcss').Config} */
import daisyui from 'daisyui';

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue"
  ],
  theme: {
    extend: {},
  },
  daisyui: {
    themes: [
      "light",
      "dark"
    ],
  },
  plugins: [
    daisyui
  ],
  darkMode: [
    'class', '[data-theme="dark"]'
  ]
}

