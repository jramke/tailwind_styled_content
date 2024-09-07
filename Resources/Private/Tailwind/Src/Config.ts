import type { TscConfig } from '../types';

export const defaultConfig: TscConfig = {
    frame: {
        default: '2.5rem',
        screens: {
            lg: '3.5rem',
        },
        multipliers: {
            small: '1.5',
            large: '1.5',
        },
    },
};