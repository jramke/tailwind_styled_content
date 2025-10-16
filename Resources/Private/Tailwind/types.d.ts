import createPlugin from 'tailwindcss/plugin';

export type TscConfig = {
    frame: {
        default: string;
        screens?: Record<string, string>;
        multipliers: {
            small: string;
            large: string;
        };
    } | false;
};

// Somehow not exported by Tailwind
export type PluginAPI = Parameters<Parameters<typeof createPlugin>[0]>[0];