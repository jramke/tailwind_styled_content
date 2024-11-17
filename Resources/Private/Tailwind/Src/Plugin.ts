import type { PluginCreator } from 'tailwindcss/types/config';
import type { TscConfig } from '../types';

import tailwindPlugin from 'tailwindcss/plugin';
import { defaultConfig } from './Config';
import { frameStyles, containerStyles, tableStyles } from './Styles';
import { deepMerge } from './Utils';

const mainFunction: PluginCreator = (pluginApi) => {
	const pluginConfig = pluginApi.config('tsc') as Partial<TscConfig>;
	const tscConfig = deepMerge(defaultConfig, pluginConfig);

	frameStyles(tscConfig.frame, pluginApi);
	containerStyles(pluginApi);
	tableStyles(pluginApi);
};

export default tailwindPlugin(mainFunction);
