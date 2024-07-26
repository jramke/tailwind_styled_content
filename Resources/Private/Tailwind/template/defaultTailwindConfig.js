import { tscPlugin, tscPreset, tscSafelist } from './vendor/jramke/tailwind-styled-content/Resources/Private/Tailwind';

/** @type {import('tailwindcss').Config} */
export default {
	presets: [ tscPreset ],
	content: [ 
		'packages/**/*.{html,js,yaml,typoscript,tsconfig}',
		'vendor/jramke/tailwind-styled-content/**/*.{html,js,yaml,typoscript,tsconfig}',
	],
	safelist: [
		...tscSafelist,
	],
	theme: {
		extend: {},
	},
	plugins: [
		require('@tailwindcss/typography'),
		require('daisyui'),
		tscPlugin,
	],
	tsc: {},
};