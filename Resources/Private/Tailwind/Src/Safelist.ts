function safelistGrid(minGridCols: number, maxGridCols: number) {
    let gridColsRegexPatterns: string[] = [];
    for (let i = minGridCols; i <= maxGridCols; i++) {
        gridColsRegexPatterns.push(`(col-span|grid-cols)-${i}`);
    }

    if (gridColsRegexPatterns.length > 0) {
        return {
            pattern: new RegExp(gridColsRegexPatterns.join('|')),
            variants: ['sm', 'md', 'lg', 'xl', '2xl'],
        };
    } else {
        return null;
    }
};

export default [
    safelistGrid(1, 12),
    {
        pattern: /text-(left|center|right)/,
    },
];