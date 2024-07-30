const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require("tailwindcss/colors")

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        "./node_modules/vue-tailwind-datepicker/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'mostepe-green': {
                    'dark': '#1d6b39',
                    'light': '#56c67e'
                },
                'mostepe-yellow': {
                    'dark': '#b1a611',
                    'light': '#fcea00',
                },
                "vtd-primary": colors.green, // Light mode Datepicker color
                "vtd-secondary": colors.gray, // Dark mode Datepicker color
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
