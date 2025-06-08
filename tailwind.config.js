/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.css",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
    safelist: [
        'bg-[url(/img/development.jpg)]',
        'bg-[url(/img/telegram.jpg)]',
        'bg-[url(/img/application.jpg)]',
        'bg-[url(/img/lk.jpg)]',
        'bg-[url(/img/tech.jpg)]',
        'bg-[url(/img/consulting.jpg)]',
    ],
}

