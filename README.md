# Tailwind Styled Content

Easily use TYPO3 with Tailwind CSS. Tailwind Styled Content is an alternative for `fluid_styled_content` using Tailwind CSS, providing a clean, robust and modern starting point for building websites with TYPO3.

![TYPO3 + Tailwind CSS](https://github.com/user-attachments/assets/a2819c93-4682-4e61-9486-03519adad2ad)

## Whats covered

### Content Elements

Tailwind Styled Content ships basic templates for (not all) default content elements. Its important to say, that we made some opinionated adjustments and settings. Thats why it is not a drop in replacement for `fluid_styled_content` and is more suitable for new projects.
- Simplified content elements layout
- Removed and added some `frame_class` options
- New `.frame` spacing api
- Overhaul of the textmedia template and gallery partial
- Removed and added some `imageorient` options
- Disabled the following content elements 
    - textpic (in favor of textmedia)
    - table (in favor of RTE table)
    - bullets (in favor of RTE lists)

*Check the individual files for more information.*

We also introduce a `Prose` partial that can be used like this:

```html
<f:render partial="Prose" contentAs="content">
    <!-- content -->
</f:render>
```

### Form Elements

We override the default form element classes via yaml, because they where designed to work with Bootstrap. **Currently the gridrow element is not ported to tailwind yet**. We use the form templates of `version2`.

### Tailwind Plugins and Preset

Tailwind Styled Content comes with a tailwind preset, a safelist and a plugin which you can directly import from the composer package. No need for a additional npm package.

The preset extends the default tailwind theme to make it more suitable for building TYPO3 websites rather than web app interfaces. It also includes the needed plugins. Tailwind Styled Content includes [daisyUI](https://daisyui.com/) plugin which makes tailwind usable for non-component-based JS frameworks and [tailwindcss/typography](https://tailwindcss.com/docs/typography-plugin) plugin to enhance the RTE and default heading styling.

The Tailwind Styled Content plugin enhances the `.frame` component, which is used for each content element. It adds robust spacing to your elements, which also can be adjusted by the combo classes applied by the `space_before_class` and `space_after_class` fields in the backend. The combo classes pattern looks like this: `frame-space-(before|after)-(none|small|large)`. For customization details, you can read more in the [customization section](#customization)

## Getting started

### 1. Install Tailwind Styled Content (TSC)

Install Tailwind Styled Content via Composer.
```bash
ddev composer req jramke/tailwind-styled-content
```
NOTE: If you are using a legacy installation you have to install the extension via the extension manager in the backend. Remember to adapt the paths in the generated tailwind config to your setup.

### 2. Initialize Tailwind

Then, you need to initialize Tailwind. The recommended way is to use PostCSS. Follow the steps here: [Tailwind CSS Installation using PostCSS](https://tailwindcss.com/docs/installation/using-postcss).

The easiest way to get your `main.css` running is using `vite-asset-collector`, a great extension from [Simon Praetorius](https://github.com/s2b). Then you simply need to  import the css file in your js entry file. Read more here: [Vite Asset Collector](https://github.com/s2b/vite-asset-collector).

### 3. Install additional dependencies

As mentioned, Tailwind Styled Content is based on `daisyUI` and `@tailwindcss/typography` So we need to install them as dev dependencies as well.
```bash
npm i -D daisyui@latest @tailwindcss/typography
```

### 4. Setup your tailwind config

Now you have to add Tailwind Styled Content to your `tailwind.config.js`. You have to set the `content` paths and `safelist` yourself, because these values arent merged with the preset.

```js
import { preset, safelist } from './vendor/jramke/tailwind-styled-content';
 
/** @type {import('tailwindcss').Config} */
module.exports = {
	presets: [preset],
	content: [
		'./vendor/jramke/tailwind-styled-content/**/*.{html,yaml,typoscript,tsconfig}',
		'packages/**/*.{html,js,yaml,typoscript,tsconfig}',
	],
	safelist: [...safelist],
}
```

## Customization

### Tailwind
For basic Tailwind customization you can simply follow the [Tailwind docs](https://tailwindcss.com/docs/configuration).

### daisyUI
For customizing daisyUI i would recommend [this approach](https://daisyui.com/docs/themes/#-7), where we extend an existing theme with the needed brand colors, because we often dont need dark and light mode for simple websites. For more information check out [their docs](https://daisyui.com/docs/customize/).

### Tailwind Styled Content (TSC)
For customizing Tailwind Styled Content you can use the `tsc` object in your Tailwind config.

You can adjust the generated CSS for the `.frame` component by changing the default vertical padding, the default padding for a given Tailwind breakpoint and the amount of increase or decrease when using the combo classes. If you set `frame: false` you can opt-out for the styles and use your own.

The default config looks like this:
```js
tsc: {
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
}
```

### Tailwind Typography

For customizing the typography styles you can simply extend your tailwind config or override the `Prose.html` partial in your distribution extension and add the desired element modifiers or other classes. Read more [here](https://tailwindcss.com/docs/typography-plugin).


## Development

The development setup is based on this [example](https://github.com/a-r-m-i-n/ddev-for-typo3-extensions).
TODO: more details
TODO: we now only need to load the output.css
TODO: rename tailwind folder to something development enviromentally?
TODO: add setup vor v11 and v13