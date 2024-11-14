import type { PluginAPI } from "tailwindcss/types/config";

export function tableStyles(pluginApi: PluginAPI) {
    const { addComponents } = pluginApi;

    // CKEditor wraps the table in a figure with the class "table". This causes overflow issues because it tells tailwind to set the display to table.
    // Because its not so easy to change this behavior in CKEditor, we need this css.
    addComponents({
        '.prose figure.table': {
            display: 'initial'
        },
    });
}