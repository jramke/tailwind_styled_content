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