import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    'Lexend Deca',
                    "Rubik",
                    "Figtree",
                    "Inter",
                    "League Spartan",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            colors: {
                primary: "#2A70FB",
                secondary: "#2E3840",
                info: "#F15A59",
                danger: "#D21312",
                success: "#5D9C59",
                warning: "#FD8D14",
                light: "#F2F2F2",
                dark: "#070A52",
                black: "#2E3840",
                white: "#FFFFFF",
                gray: {
                    100: "#F2F2F2",
                    200: "#E0E0E0",
                    300: "#BDBDBD",
                    400: "#828282",
                    500: "#4F4F4F",
                    600: "#333333",
                    700: "#1A1A1A",
                    800: "#070A52",
                    900: "#000000",
                },
            },
            fontSize: {
                xxs: ".625rem",
                xs: ".75rem",
                sm: ".875rem",
                md: "1rem",
                lg: "1.125rem",
                xl: "1.25rem",
                "2xl": "1.5rem",
                "3xl": "1.875rem",
                "4xl": "2.25rem",
                "5xl": "3rem",
                "6xl": "4rem",
            },
        },
    },

    plugins: [forms],
};
