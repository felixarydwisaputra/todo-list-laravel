/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        display: "Fredoka, sans-serif", // Adds a new `font-display` class
      }
    },
  },
  plugins: [],
}