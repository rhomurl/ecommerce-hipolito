const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: ['./**/*.html'],
    darkMode: 'class', // or 'media'
    theme: {
        themeVariants: ['dark', 'light'],
        extend: {
            maxHeight: {
                0: '0',
                xl: '36rem',
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        backgroundColor: ['hover', 'focus', 'active', 'odd', 'dark'],
        display: ['responsive', 'dark'],
        textColor: ['focus-within', 'hover', 'active', 'dark'],
        placeholderColor: ['focus', 'dark'],
        borderColor: ['focus', 'hover', 'dark'],
        divideColor: ['dark'],
        boxShadow: ['focus'],
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
}
