function safelistGenerator(minGridCols: number, maxGridCols: number) {
    let gridSafelistEntry: any;
    let gridColsRegexPatterns: string[] = [];
    for (let i = minGridCols; i <= maxGridCols; i++) {
        gridColsRegexPatterns.push(`(col-span|grid-cols)-${i}`);
    }

    if (gridColsRegexPatterns.length > 0) {
        gridSafelistEntry = { 
            pattern: new RegExp(gridColsRegexPatterns.join('|')),
            variants: ['sm', 'md', 'lg', 'xl', '2xl'],
        };
    }

    return [
        {
            pattern: /frame-space-(before|after)-(none|small|large)/,
        },
        gridSafelistEntry
    ]
};

export default safelistGenerator(1, 12);