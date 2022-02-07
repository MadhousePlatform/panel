const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Red Hat Display', ...defaultTheme.fontFamily.sans],
                mono: ['Overpass Mono', ...defaultTheme.fontFamily.mono],
                display: ['Architects Daughter', 'Atma'],
                'flow-bl': ['Flow Block'],
                'flow-rd': ['Flow Rounded'],
                'flow-ci': ['Flow Circular'],
            },
            colors: {
                mh: {
                    100: "#f6f5fc",
                    200: "#e4e0f8",
                    300: "#d6d0f4",
                    400: "#c0b6ef",
                    500: "#aea1ea",
                    600: "#9c8ce5",
                    700: "#8a77e1",
                    800: "#7862dc",
                    900: "#5740bc",
                    "accent": "#a1eaae"
                },
            },
            maxWidth: {
                '8xl': '92em'
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
