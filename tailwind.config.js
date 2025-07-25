import { fontFamily as _fontFamily } from "tailwindcss/defaultTheme";

export const content = [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
];
export const theme = {
    extend: {
        fontFamily: {
            sans: ["Figtree", ..._fontFamily.sans],
        },
        colors: {
            primary: {
                50: "#fef7f0",
                100: "#fdeee0",
                200: "#fad9c1",
                300: "#f6be97",
                400: "#f08a5d", // Main color
                500: "#e96b3a",
                600: "#d9532f",
                700: "#b54229",
                800: "#903628",
                900: "#742e23",
            },
            secondary: {
                50: "#f0f9ff",
                100: "#e0f2fe",
                200: "#bae6fd",
                300: "#7dd3fc",
                400: "#38bdf8",
                500: "#0ea5e9",
                600: "#0284c7",
                700: "#0369a1",
                800: "#075985",
                900: "#0c4a6e",
            },
        },
        spacing: {
            "128": "32rem",
            "144": "36rem",
        },
        borderRadius: {
            "4xl": "2rem",
        },
    },
};
export const plugins = [
    require("@tailwindcss/forms"),
];
