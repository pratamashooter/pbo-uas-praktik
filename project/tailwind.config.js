/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#00ebc7",
                danger: "#ff5470",
                warning: "#fde24f",
                success: "#00ebc7",
                dark: "#00214d",
                white: "#fffffe",
            },
            fontFamily: {
                sans: "Poppins, sans-serif",
            },
        },
    },
    plugins: [],
};
