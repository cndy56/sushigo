import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    // Tambahkan safelist agar class dinamis tidak dihapus
    safelist: [
        'bg-yellow-100', 'text-yellow-700', 'border-yellow-200',
        'bg-blue-100',   'text-blue-700',   'border-blue-200',
        'bg-green-100',  'text-green-700',  'border-green-200',
        'bg-red-100',    'text-red-600',    'border-red-200',
        'bg-gray-100',   'text-gray-600',   'border-gray-200',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};