import type { PluginAPI } from "tailwindcss/types/config";
import type { TscConfig } from "../../types";

export function frameStyles(frameConfig: TscConfig['frame'], pluginApi: PluginAPI) {
    if (frameConfig === false) {
        return;
    }

    const { theme, addBase, addComponents } = pluginApi;

    const frameVars = {
        ':root': {
            '--frame-spacing-default': frameConfig.default,
            '--frame-spacing-small-multiplier': frameConfig.multipliers.small,
            '--frame-spacing-large-multiplier': frameConfig.multipliers.large,
        }
    };
    addBase(frameVars);

    if (frameConfig.screens && Object.keys(frameConfig.screens).length > 0) {
        Object.entries(frameConfig.screens).forEach(([screen, value]) => {
            const screens = theme('screens');
            if (typeof screens === 'undefined' || !(screen in screens)) {
                console.warn(`Screen ${screen} is not defined in the theme.`);
                return;
            }
            addBase({
                [`@screen ${screen}`]: {
                    ':root': {
                        '--frame-spacing-default': value,
                    }
                }
            });
        });
    }

    const defaultFrame = {
        '.frame': {
            '--frame-spacing-before': 'var(--frame-spacing-default)',
            '--frame-spacing-after': 'var(--frame-spacing-default)',
            'padding-top': 'var(--frame-spacing-before)',
            'padding-bottom': 'var(--frame-spacing-after)',
        },
        '.frame .frame:not([class*="frame-space-before"]):not([class*="frame-space-after"])': {
            '--frame-spacing-before': '0px',
            '--frame-spacing-after': '0px',
        },
        '.frame .container .container:not(.container--keep-padding)': {
            'padding-left': '0px',
            'padding-right': '0px',
        }
    };
    addComponents(defaultFrame);

    const directions = ['before', 'after'] as const;
    const sizes = {
        none: '0px',
        small: 'calc(var(--frame-spacing-default) / var(--frame-spacing-small-multiplier))',
        large: 'calc(var(--frame-spacing-default) * var(--frame-spacing-large-multiplier))',
    };

    const frameUtilities = {};
    directions.forEach((direction) => {
        Object.entries(sizes).forEach(([size, value]) => {
            frameUtilities[`.frame.frame-space-${direction}-${size}`] = {
                [`--frame-spacing-${direction}`]: value,
            };
        });
    });
    addComponents(frameUtilities);
}