// TODO: adjust safelist handling after stable tailwind v4
import * as fs from 'fs';
import * as path from 'path';

function safelistGrid(minGridCols: number, maxGridCols: number) {
    let classes: string[] = [];

    for (let i = minGridCols; i <= maxGridCols; i++) {
        classes.push(`col-span-${i}`, `grid-cols-${i}`);
    }

    const variants = ['sm', 'md', 'lg', 'xl', '2xl'];

    let classesWithVariants: string[] = [];
    variants.forEach(variant => {
        classes.map(className => {
            classesWithVariants.push(`${variant}:${className}`);
        });
    });

    return [...classes, ...classesWithVariants];
};

(() =>  {
    const safelist = [
        ...safelistGrid(1, 12),
        ...['text-center', 'text-left', 'text-right'],
    ];    

    const filePath = path.resolve(import.meta.dirname, '../__tsc.safelist');

    fs.writeFileSync(filePath, safelist.join('\n'), 'utf8');
    console.log(`Safelist classes written to ${filePath}`);

    return safelist;
})();