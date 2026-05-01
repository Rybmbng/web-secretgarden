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
    theme: {
        extend: {
            colors: {
                "pantone-9180c": "var(--variable-collection-pantone-9180c)",
                "black-6c": "var(--variable-collection-black-6c)",
                "clean-beauty": "var(--variable-collection-clean-beauty)",
                "pantone-black-6c": "var(--variable-collection-pantone-black-6c)",
                "figma-black-60": "var(--www-figma-com-color-black-60)",
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                "cinzel": ["Cinzel Decorative", "serif"],
                "avenir": ["Avenir Next", "Helvetica", "sans-serif"],
                "avenir-roman": ["Avenir-Roman", "Helvetica", "sans-serif"],
                "avenir-medium": ["Avenir-Medium", "Helvetica", "sans-serif"],
                "roxborough": ["Roxborough CF-Medium", "serif"],
            },
            letterSpacing: {
                'widest-brand': '1.60px', // Sesuai button di index.html
            }
        },
    },
    plugins: [],
};