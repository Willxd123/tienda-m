import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            colors: {
        'custom-red': '#ff0000',
        'custom-blue': '#0000ff',
        'custom-green': '#00ff00',
        'custom-yellow': '#ffff00',
        'custom-purple': '#800080',
        'custom-gray': '#808080',
            },
        },
    },

    plugins: [forms, typography,
        require('flowbite/plugin')
    ],
};
