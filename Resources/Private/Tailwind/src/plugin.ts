import type { PluginCreator } from "tailwindcss/types/config";
import tailwindPlugin from 'tailwindcss/plugin';
import { defaultConfig } from "./config";
import { frameStyles } from "./styles/frame";

const mainFunction: PluginCreator = (pluginApi) => {
    const tscConfig = Object.assign({}, defaultConfig, pluginApi.config('tsc'));

    frameStyles(tscConfig, pluginApi);
};

export default tailwindPlugin(mainFunction);
