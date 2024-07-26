# Tailwind Styled Content

A modern replacement for `fluid_styled_content` using Tailwind CSS, providing a better starting point for building websites with TYPO3.

## Whats covered

### Content Elements

Tailwind Styled Content ships basic templates for (not all) default content elements. We removed several content elements and adjusted some settings. For more information, please have a look into the tsconfig files. The content elements layout got simplified, too.
<br>
We also introduce a `Prose` partial that can be used like this:
```html
<f:render partial="Prose" contentAs="content">
    <!-- content -->
</f:render>
```

### Form Elements

We override the default form element classes because they where designed for Bootstrap.

### Tailwind Plugin, Preset & Boilerplate

Tailwind Styled Content comes with a TYPO3 command to generate a tailwind config boilerplate. This boilerplate adds a preset, the needed content paths, a basic safelist and the needed plugins to your tailwind setup.
<br>
The preset extends the default tailwind theme to make it more suitable for building TYPO3 websites rather than web app interfaces.
<br>
The plugin adds the `.frame` component, wich is used for each content element. It adds robust spacing to your elements, wich also can be adjusted by the combo classes applied by the `space_before_class` and `space_after_class` fields in the backend. The combo classes pattern looks like this: `frame-space-(before|after)-(none|small|large)`. For customization details, you can read more in the [customization section](#customization)

The boilerplate also includes [daisyUI](https://daisyui.com/) wich makes tailwind usable for non-component-based JS frameworks and [tailwindcss/typography](https://tailwindcss.com/docs/typography-plugin) to enhance the RTE and default heading styling.

## Getting started

### 1. Install Tailwind Styled Content (TSC)

Install Tailwind Styled Content via Composer.
```bash
ddev composer req jramke/tailwind-styled-content
```
NOTE: If you are using a legacy installation you have to install the extension via the extension manager in the backend. Remember to adapt the paths in the generated tailwind config to your setup.

### 2. Initialize Tailwind

Then, you need to initialize Tailwind. The recommended way is to use PostCSS. Follow the steps here: [Tailwind CSS Installation using PostCSS](https://tailwindcss.com/docs/installation/using-postcss).
<br>
The easiest way to get your `main.css` running is using `vite-asset-collector` and importing the file in your js entry file. Read more here: [Vite Asset Collector](https://github.com/s2b/vite-asset-collector).

### 3. Install additional dependencies

As mentioned, Tailwind Styled Content is based on `daisyUI` and `@tailwindcss/typography` So we need to install them as dev dependencies as well.
```bash
npm i -D daisyui@latest @tailwindcss/typography
```

### 4. Generate the tailwind config

Use the typo3 command to generate a boilerplate tailwind config file. You may need to add the `--force` option since `tailwind init` generates an empty config file.

DDEV installation
```bash
ddev typo3 tailwind:config --force
```

Legacy installation
```bash
vendor/bin/typo3 tailwind:config --force
```

## Customization

### Tailwind
For basic Tailwind customization you can simply follow the [Tailwind docs](https://tailwindcss.com/docs/configuration).

### daisyUI
For customizing daisyUI i would recommend [this approach](https://daisyui.com/docs/themes/#-7), were we extend an existing theme with the needed brand colors, because we often dont need dark and light mode for simple websites. For more information check out [their docs](https://daisyui.com/docs/customize/).

### Tailwind Styled Content (TSC)
For customizing Tailwind Styled Content you can extend the `tsc` object in your Tailwind config.
<br>
You can adjust the generated CSS for the `.frame` component by changing the default vertical padding, the default padding for a given Tailwind breakpoint and the amount of increase or decrease when using the combo classes.
<br>
The current default config looks like this:
```js
{
    frameSpacing: {
        default: '2.5rem',
        screens: {
            lg: '3.5rem',
        },
        multipliers: {
            small: '1.5',
            large: '1.5',
        },
    },
}
```

### Tailwind Typography

For customizing the typography styles you can simply extend your tailwind config or override the `Prose.html` partial in your distribution extension and add the desired element modifiers or other classes. Read more [here](https://tailwindcss.com/docs/typography-plugin).
