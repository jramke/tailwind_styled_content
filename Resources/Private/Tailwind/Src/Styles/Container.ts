import type { PluginAPI } from "tailwindcss/types/config";

export function containerStyles(pluginApi: PluginAPI) {
    const { addComponents } = pluginApi;

    addComponents({
        '.container.none': {
            'max-width': 'none',
        },
        '.container.full': {
            'max-width': 'none',
            'padding-left': '0px',
            'padding-right': '0px',
        },
        '.frame:has(.container.indent-right)': {
            'margin-right': '33.33%',
        },
        '.frame:has(.container.indent-left)': {
            'margin-left': '33.33%',
        },
    });
}