import { preset, safelist } from './vendor/jramke/tailwind-styled-content';

/** @type {import('tailwindcss').Config} */
module.exports = {
    presets: [preset],
    content: [
        './vendor/jramke/tailwind-styled-content/**/*.{html,yaml,typoscript,tsconfig}'
    ],
    safelist: [...safelist]
}