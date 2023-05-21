/** @type {import('tailwindcss').Config} */
//Agregamos los tailwinds a nuestra página (son estilos).
// esa ese una manera larga de hacerlo: "./resources/views/layouts/app.blade.php"
//la manera corta:
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

