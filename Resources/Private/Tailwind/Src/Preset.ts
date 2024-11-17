import type { Config } from 'tailwindcss';

import plugin from './Plugin';
import typography from '@tailwindcss/typography';
import daisyui from 'daisyui';

export default {
	theme: {
		extend: {
			container: {
				center: true,
				padding: '1.5rem',
			},
			spacing: {
				reading: '80ch',
			},
			typography: {
				DEFAULT: {
					css: {
						maxWidth: 'none',
					},
				},
			},
		},
	},
	plugins: [typography, daisyui, plugin],
} satisfies Omit<Config, 'content'>;