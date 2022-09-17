const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",
    content: [
        "./resources/**/**/**/*.blade.php",
        "./resources/**/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
    ],
    theme: {
        screens: {
            xxs: "414px",
            xs: "520px",
            sm: "640px",
            md: "768px",
            lg: "1024px",
            xl: "1280px",
            "2xl": "1536px",
        },
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                slate:{
                    1000 : "#080d1a"
                },
                evertec: {
                    25: "#FFE6D6",
                    50: "#FFDFC9",
                    100: "#ffd0b1",
                    200: "#FFB98C",
                    300: "#ffa266",
                    400: "#FF8434",
                    500: "#FF7820",
                    600: "#ff6c0c",
                    700: "#eb640a",
                    800: "#a14406",
                    900: "#7A3202",
                },
            },
            spacing:{
                "0.25": "0.0625rem"
            },
            lineHeight:{
                0: '0rem'
            },
            transitionProperty: {
                'fill': 'fill',
            }
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};
