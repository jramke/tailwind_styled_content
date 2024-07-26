export type TscConfig = {
    frameSpacing: {
        default: string;
        screens?: Record<string, string>;
        multipliers: {
            small: string;
            large: string;
        };
    };
};