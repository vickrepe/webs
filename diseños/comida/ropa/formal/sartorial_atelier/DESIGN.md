# Design System: The Editorial Monolith

## 1. Overview & Creative North Star
**Creative North Star: "The Digital Atelier"**
This design system moves away from the "commodity" feel of standard e-commerce grids. It is built on the philosophy of an elite, physical boutique: spacious, silent, and curated. We reject the "boxed-in" nature of the web. Instead, we embrace **Intentional Asymmetry** and **Tonal Depth** to create a sense of architectural permanence. 

The system breaks the "template" look by treating the browser as a high-end fashion editorial. Elements overlap, typography is used at extreme scales (monumental headlines vs. microscopic labels), and "Sartorial Black" acts as an anchor for a palette that mimics the textures of fine linen and warm studio lighting.

## 2. Colors: The Tonal Spectrum
Our palette is a study in "Warm Noir." We avoid harsh digital whites and grays in favor of a sophisticated, bone-and-charcoal foundation.

### Palette Strategy
- **Primary (#625d5b / #1C1917 context):** While the base primary is a muted stone, the brand's heart is "Sartorial Black." Use `primary` for high-intent actions and `on_surface` for the heaviest typography to maintain a grounded, professional weight.
- **The "No-Line" Rule:** Sectioning must never be achieved with a 1px solid border. Prohibit them. Boundaries are created through background shifts. A `surface_container_low` section sitting against a `surface` background is the only acceptable way to define a new content area.
- **Surface Hierarchy:** Treat the UI as layers of fine stationery.
    - **Base:** `surface` (#fff8f5) — The canvas.
    - **Elevated:** `surface_container_low` (#fbf2ed) — For secondary content areas.
    - **Inlaid:** `surface_container_highest` (#ede0d8) — For deep-set interactive areas like search bars or filters.
- **The "Glass & Gradient" Rule:** For floating navigation or quick-buy overlays, use Glassmorphism. Apply `surface` at 80% opacity with a `24px` backdrop blur. For primary CTAs, use a subtle linear gradient from `primary` to `primary_dim` at a 15-degree angle to provide a "sheen" reminiscent of silk.

## 3. Typography: Editorial Authority
The interplay between the sharp serifs of Noto Serif (representing the classicism of Playfair) and the functional precision of Inter creates a "Modern Heritage" aesthetic.

- **Display (Noto Serif):** Used for "The Statement." `display-lg` (3.5rem) should be used with tight letter-spacing (-0.02em) to evoke the masthead of a high-end magazine.
- **Headline (Noto Serif):** Reserved for product names and editorial storytelling. 
- **Title & Body (Inter):** The utilitarian balance. Body text should be set with generous line-height (1.6) to ensure the "whitespace" of the palette is reflected within the text blocks themselves.
- **Label (Inter):** Used for metadata (Size, Material, Origin). These should often be `all-caps` with `+0.05em` letter spacing to feel like a premium garment tag.

## 4. Elevation & Depth: Tonal Layering
We do not use shadows to represent "height"; we use tone to represent "presence."

- **The Layering Principle:** To highlight a product card, do not add a shadow. Instead, place the card (using `surface_container_lowest`) onto a `surface_container` background. The slight shift in "paper weight" provides all the hierarchy needed.
- **Ambient Shadows:** Only for "Floating" elements (e.g., a cart drawer or a modal). Shadows must be `on_surface` color at 4% opacity with a `48px` blur and `12px` Y-offset. It should feel like a soft glow, not a drop shadow.
- **The "Ghost Border" Fallback:** If a boundary is strictly required for accessibility (e.g., form inputs), use `outline_variant` at 20% opacity. It should be barely perceptible—a "whisper" of a line.
- **0px Roundedness:** This system uses a strict **0px radius** across all elements. Sharp corners communicate the precision of bespoke tailoring.

## 5. Components: The Bespoke Library

### Buttons
- **Primary:** `primary` background, `on_primary` text. Rectangular, 0px radius. High-padding (16px 32px).
- **Secondary:** Transparent background, `on_surface` text, 1px "Ghost Border" (20% opacity).
- **Tertiary:** `on_surface` text with a 1px underline that expands on hover. No container.

### Input Fields
- Underline-only style. Use `outline` for the bottom border. Labels should use `label-sm` and sit above the input. Error states use `error` text but keep the 0px sharp-edge aesthetic.

### Cards & Lists
- **Forbid Dividers:** Use `80px` or `120px` of vertical whitespace to separate product rows. 
- **Product Cards:** Images should use `surface_variant` as a placeholder background. Text metadata should be left-aligned and tightly grouped to maximize the surrounding "negative space."

### Interactive Chips
- **Selection Chips:** No border. Use `surface_container_high` for unselected and `primary` with `on_primary` text for selected. 

### Custom Component: The "Atelier Overlay"
- A full-screen, low-opacity `surface` overlay with a heavy backdrop blur used for transitions. It mimics the "reveal" of unboxing a luxury item.

## 6. Do’s and Don’ts

### Do:
- **Do** use asymmetrical layouts. A product image can be 60% width while the description sits in a 30% column, leaving 10% as pure "dead" space.
- **Do** prioritize studio photography with high-contrast lighting. The UI is designed to frame the photography, not compete with it.
- **Do** use `title-lg` for product prices to give them the same weight as the product name.

### Don’t:
- **Don’t** use rounded corners. Ever.
- **Don’t** use "pure" black (#000) or "pure" white (#FFF). Use `on_surface` and `surface`.
- **Don’t** use icons for everything. If a word (e.g., "Menu," "Search," "Bag") can be used instead of an icon, use the word in `label-md` all-caps. It feels more "bespoke."
- **Don’t** use standard "Hover" states like 100% opacity shifts. Use subtle color transitions between surface containers or a slight "zoom" on photography.