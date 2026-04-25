# Design System Document: The Hearth & Harvest

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Golden Crust."** 

We are moving away from the "industrial efficiency" of standard e-commerce. Instead, this system evokes the sensory experience of an artisanal bakery: the warmth of a pre-heated oven, the tactile nature of dusted flour, and the nostalgic comfort of a neighborhood staple. 

To achieve a "High-End Editorial" feel, we reject rigid, boxed-in layouts. This design system utilizes **intentional asymmetry**, where imagery of golden-brown pastries breaks out of their containers, and **tonal depth**, where elements feel layered like sheets of parchment paper. We prioritize a "handmade" digital architecture—one that feels curated, not manufactured.

---

## 2. Colors: Tonal Warmth
Our palette is rooted in the transition from raw flour to toasted wheat. We utilize a sophisticated Material 3-based hierarchy to ensure depth without clutter.

*   **Primary (#8d4b00) & Primary-Container (#b15f00):** These represent the "Golden Wheat" and "Toasted Crust." Use these for high-emphasis actions and brand-defining moments.
*   **Surface (#fdf9e9) & Background (#fdf9e9):** Our "Buttery White." This is the canvas. It provides a warm, organic alternative to stark digital white.
*   **Tertiary (#006096):** A deep, nostalgic blue. Use this sparingly for "Special Edition" callouts or secondary navigational cues to provide a "cool" counterpoint to the warmth.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders for sectioning or containment. Boundaries must be defined solely through background color shifts. For instance, a `surface-container-low` section should sit against a `surface` background to create a soft, natural edge.

### Surface Hierarchy & Nesting
Treat the UI as a physical stack of fine papers.
*   **Nesting:** Place a `surface-container-lowest` card (Pure White) on top of a `surface-container-high` (Creamy Tan) section. This creates a "lifted" effect that feels premium and intentional.
*   **The "Glass & Gradient" Rule:** To add "soul," use subtle linear gradients (Primary to Primary-Container) on main CTAs. For floating navigation or pastry-detail overlays, apply Glassmorphism: semi-transparent surface colors with a `20px` backdrop-blur to mimic the glass of a boutique pastry case.

---

## 3. Typography: Editorial Rhythm
The typography scale is designed to create a "Signature" rhythm, blending the authority of a modern editorial with the approachability of a local bakery.

*   **Display & Headline (Plus Jakarta Sans):** These are our "Voice." Use `display-lg` (3.5rem) for hero statements to create impact. The wide apertures of Plus Jakarta Sans feel friendly yet premium.
*   **Body & Title (Be Vietnam Pro):** Our "Information." Be Vietnam Pro offers a clean, humanist touch that ensures legibility while maintaining the "warm" aesthetic. 
*   **Hierarchy Note:** Use `headline-lg` for product names and `body-lg` for descriptions. Always ensure generous line-heights (1.6+) to allow the text to "breathe," mimicking the airy crumb of a sourdough loaf.

---

## 4. Elevation & Depth: Tonal Layering
We do not use shadows to create "distance"; we use tonal layering to create "presence."

*   **The Layering Principle:** Depth is achieved by stacking surface-container tiers. A card should not "float" with a shadow; it should "sit" on a slightly darker surface.
*   **Ambient Shadows:** If a floating effect is required (e.g., a "Quick Add" FAB), use an extra-diffused shadow: `box-shadow: 0 10px 40px rgba(28, 28, 19, 0.06)`. The shadow color must be a tint of `on-surface` (#1c1c13), never pure black.
*   **The "Ghost Border" Fallback:** If a container requires definition for accessibility (e.g., an input field), use the `outline-variant` token at **20% opacity**. 100% opaque borders are strictly forbidden.

---

## 5. Components: Approachable Sophistication

### Buttons
*   **Primary:** Pill-shaped (`rounded-full`), using the Primary gradient. No borders.
*   **Secondary:** Pill-shaped, `surface-container-high` background with `on-surface` text.
*   **Interactions:** On hover, a button should not "glow"; it should subtly shift in tonal depth (e.g., moving from `primary` to `primary-container`).

### Cards & Lists
*   **No Dividers:** Forbid the use of horizontal rules. Use vertical white space from the spacing scale (e.g., `32px` or `48px`) or subtle shifts in background color between items.
*   **Asymmetric Imagery:** Product images should slightly overlap the edge of the card, creating a sense of "handmade" imperfection.

### Input Fields
*   **Styling:** Use `rounded-lg` (2rem) for input containers. The background should be `surface-container-lowest`. 
*   **Focus State:** Instead of a heavy border, a focused input should trigger a subtle `surface-tint` glow and a `10%` opacity `outline`.

### Signature Component: The "Dusted" Tooltip
*   **Style:** `surface-container-highest` background with a heavy backdrop-blur. The corners must be `rounded-md` (1.5rem) to maintain the soft, approachable theme.

---

## 6. Do's and Don'ts

### Do:
*   **Embrace Asymmetry:** Offset text blocks and images to create an editorial, "scrapbook" feel.
*   **Use Generous Spacing:** Think of white space as flour dusting—it lightens the composition.
*   **Layer Colors:** Use the full range of `surface-container` tokens to create a 3D feel without using shadows.

### Don't:
*   **Use 1px Borders:** This immediately breaks the premium, organic feel and makes the UI look like a generic template.
*   **Use High-Contrast Shadows:** These feel "tech-heavy" and ruin the nostalgic, warm atmosphere.
*   **Crowd the Content:** Artisanal products need room to be admired. Avoid "grid-bloat" where too many items are packed into a single row.

---

## 7. Token Quick Reference
*   **Primary Action:** `#8d4b00`
*   **Background:** `#fdf9e9`
*   **Headline Font:** Plus Jakarta Sans
*   **Body Font:** Be Vietnam Pro
*   **Corner Radius (Standard):** `1rem` (16px)
*   **Corner Radius (Signature):** `3rem` (48px) for Hero elements.