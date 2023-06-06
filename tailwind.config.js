/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  ],
  theme: {
    colors: {
      'primary': '#3661ED',
      'secondary': '#EBF0FE',
      'dark-primary': '#1B253B',
      'dark-secondary': '#232D45',
      'dark-card': '#28334E',
      'dark-text': '#CBD5E1',
      'non-active': '#C0C0C0',
      'warning': '#EDBA36',
      'danger': '#ED3636',
      'danger-secondary':'#FEEBEB',
      'success':'#3AED36',
      'success-secondary':'#EBFEF0',
      'body': '#F5F7F9',
      'white': '#FFFFFF',
    },
    fontFamily: {
      'nunito': ['Nunito, sans-serif'],
    },
    minWidth: {
      'max': 'max-content',
      '10': '100px',
      '15': '150px',
      '20': '200px',
      '25': '250px',
    },
    boxShadow: {
      'card': '0px 0px 2px rgba(0, 0, 0, 0.25)',
    },
    extend: {},
  },
  plugins: [],
}