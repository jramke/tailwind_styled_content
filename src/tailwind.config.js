import { preset, safelist } from '../../tailwind_styled_content';

/** @type {import('tailwindcss').Config} */
module.exports = {
    presets: [preset],
    content: [
        './vendor/jramke/tailwind-styled-content/**/*.{html,yaml,typoscript,tsconfig}'
    ],
    safelist: [...safelist]
}