import type { TscConfig } from './types';

import tailwindPlugin from 'tailwindcss/plugin';
import { defaultConfig } from './Src/Config';
import { frameStyles } from './Src/Styles/Frame';
import { deepMerge } from './Src/Utils';

export default tailwindPlugin(async (pluginApi) => {
	const pluginConfig = pluginApi.config('tsc') as Partial<TscConfig>;
	const tscConfig = deepMerge(defaultConfig, pluginConfig);

	frameStyles(tscConfig.frame, pluginApi);
});
