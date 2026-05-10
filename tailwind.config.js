import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'second': {
                    '50': '#fffee7',
                    '100': '#fffec1',
                    '200': '#fff886',
                    '300': '#ffec41',
                    '400': '#ffdb0d',
                    '500': '#ffcc00',
                    '600': '#d19500',
                    '700': '#a66a02',
                    '800': '#89530a',
                    '900': '#74430f',
                    '950': '#442304',
                },
                "black": "#28282B",
                "main": "#00aeef",
                "main-100": "#dce9fd",
                "main-200": "#c1dafc",
                "main-300": "#97c3f9",
                "main-400": "#65a3f5",
                "main-500": "#417ff0",
                "main-600": "#2c61e4",
                "main-700": "#234dd2",
                "main-800": "#2340aa",
                "main-900": "#233c8c",
                "main-950": "#192552"
            }
        },
    },

    plugins: [forms],
};
