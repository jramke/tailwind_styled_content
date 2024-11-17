# Tailwind Styled Content

![Total downloads](https://typo3-badges.dev/badge/tailwind_styled_content/downloads/shields.svg)
![Stability](https://typo3-badges.dev/badge/tailwind_styled_content/stability/shields.svg)
![TYPO3 versions](https://typo3-badges.dev/badge/tailwind_styled_content/typo3/shields.svg)
![Latest version](https://typo3-badges.dev/badge/tailwind_styled_content/version/shields.svg)

Easily use TYPO3 with Tailwind CSS. Tailwind Styled Content is an alternative for `fluid_styled_content` using Tailwind CSS, providing a clean, robust and modern starting point for building websites with TYPO3.

![TYPO3 + Tailwind CSS](https://github.com/user-attachments/assets/a2819c93-4682-4e61-9486-03519adad2ad)

## What's Included

### Content Elements

Tailwind Styled Content ships basic templates for (not all) default content elements. Its important to say, that we made some opinionated adjustments and settings. Thats why it is not a drop in replacement for `fluid_styled_content` and is more suitable for new projects.
- Simplified content elements layout
- Removed and added some `frame_class` options
- New `.frame` spacing api
- Overhauled textmedia template and gallery partial
- Removed and added some `imageorient` options
- Disabled the following content elements
    - textpic (in favor of textmedia)
    - table (in favor of RTE table)
    - bullets (in favor of RTE lists)

*Refer to the individual files for more details.*

We’ve also introduced a `Prose` partial, which can be used as follows:

```html
<f:render partial="Prose" contentAs="content">
    <!-- content -->
</f:render>
```

### Form Elements

We override the default form element classes via YAML, as they were originally designed for Bootstrap. We use the form templates of `version2`.

### Tailwind Plugins and Preset

Tailwind Styled Content comes with a Tailwind preset, a safelist and a plugin, which you can directly import from the composer package. No need for an additional npm package.

The preset extends Tailwind's default theme to better suit TYPO3 websites. It also includes the needed plugins like [daisyUI](https://daisyui.com/), which makes Tailwind usable for non-component-based JS frameworks and [tailwindcss/typography](https://tailwindcss.com/docs/typography-plugin) for RTE and default heading styling.

The Tailwind Styled Content plugin uses the `.frame` class to add robust and flexible spacing to all content elements. The combo classes added by the `space_before_class` and `space_after_class` fields, to adjusts the spacing of individual content elements, look like this: `frame-space-(before|after)-(none|small|large)`. For further customization, check out the [customization section](#customization).

## Getting Started

### 1. Install Tailwind Styled Content (TSC)

Install it via Composer:

```bash
composer req jramke/tailwind-styled-content
```

*Note:* For legacy installations, use the Extension Manager in the backend. Make sure to adjust the paths in your Tailwind config.

### 2. Initialize Tailwind

To initialize Tailwind, use PostCSS as recommended. Follow these instructions: [Tailwind CSS Installation using PostCSS](https://tailwindcss.com/docs/installation/using-postcss).

For an easy setup, use `vite-asset-collector` by [Simon Praetorius](https://github.com/s2b) and simply import the your CSS file in your JS entry file. More info here: [Vite Asset Collector](https://github.com/s2b/vite-asset-collector).

### 3. Install Additional Dependencies

As Tailwind Styled Content relies on `daisyUI` and `@tailwindcss/typography`, you need to install them as development dependencies:

```bash
npm i -D daisyui@latest @tailwindcss/typography
```

### 4. Set Up Your Tailwind Config

Add Tailwind Styled Content to your `tailwind.config.js`. You'll need to define the `content` paths and `safelist` yourself, as they’re not merged with the preset.

```js
import { preset, safelist } from './vendor/jramke/tailwind-styled-content';

/** @type {import('tailwindcss').Config} */
module.exports = {
    presets: [preset],
    content: [
        './vendor/jramke/tailwind-styled-content/**/*.{html,yaml,typoscript,tsconfig}',
        'packages/**/*.{html,js,yaml,typoscript,tsconfig,xml}',
    ],
    safelist: [...safelist],
}
```

## Customization

### Tailwind

For basic Tailwind customization, refer to the [Tailwind docs](https://tailwindcss.com/docs/configuration).

### daisyUI

To customize daisyUI, I would recommend [this approach](https://daisyui.com/docs/themes/#-7), where you extend an existing theme with your brand colors. More details are available in the [daisyUI docs](https://daisyui.com/docs/customize/).

### Tailwind Styled Content (TSC)

To customize Tailwind Styled Content, use the `tsc` object in your Tailwind config.

You can tweak the `.frame` component’s CSS by adjusting the default vertical padding, breakpoint-specific padding, and spacing for the combo classes. Set `frame: false` to opt-out of these styles entirely.

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

To customize the typography styles, extend your Tailwind config or override the `Prose.html` partial in your distribution extension. Learn more [here](https://tailwindcss.com/docs/typography-plugin).

## Development

The development setup uses DDEV and is based on this [example](https://github.com/a-r-m-i-n/ddev-for-typo3-extensions).

### Start DDEV Project

```bash
ddev start
```

### Install JavaScript Dependencies

```bash
npm install
```

### TYPO3

**1. Setup the TYPO3 development environment for the needed version**

```bash
ddev install-v11
ddev install-v12
ddev install-v13
```

The installations are then available at:
- https://v11.tailwind-styled-content.ddev.site
- https://v12.tailwind-styled-content.ddev.site
- https://v13.tailwind-styled-content.ddev.site

You can log into the backend with username `admin` and password `Password1#`.

**2. Restore base database**
```bash
ddev snapshot restore dev-base
```

or manually include the Tailwind Styled Content static TypoScript file and add this to the template:

```typoscript
page.includeCSS {
    tailwind = output.css
    tailwind {
        disableCompression = 1
        excludeFromConcatenation = 1
    }
}
```

**4. Start the Tailwind CLI build process**

Replace `[VERSION]` with the desired installation version (e.g. `v12`):

```bash
ddev exec -d /var/www/html/[VERSION] npm run tailwind
```
