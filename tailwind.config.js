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
                    "Figtree",
                    "Inter",
                    "League Spartan",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            colors: {
                primary: "#D21312",
                secondary: "#ED2B2A",
                info: "#F15A59",
                danger: "#D21312",
                success: "#5D9C59",
                warning: "#F7D060",
                light: "#F2F2F2",
                dark: "#070A52",
                black: "#2E3840",
                white: "#FFFFFF",
            },
        },
    },

    plugins: [forms],
};
