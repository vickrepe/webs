# Design System Document: Melbourne Morning

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Luminous Laneway."** 

Inspired by the elevated breakfast culture of Melbourne, this system rejects the "standard" cafe template in favor of an editorial, high-end digital experience. It is designed to feel like a sun-drenched morning: bright, airy, and vital. We achieve this through **Organic Brutalism**—combining the clean, geometric structure of urban architecture with the soft, fluid textures of nature. 

To break the "standard" UI look, this system utilizes:
*   **Intentional Asymmetry:** Breaking the grid with overlapping imagery and offset typography.
*   **Breathable Composition:** Excessive white space (Honeydew White) that acts as "digital oxygen."
*   **High-Contrast Scales:** Dramatic shifts between massive Display type and delicate functional labels.

---

## 2. Colors: The Tonal Ecosystem
Our palette is rooted in the lushness of fresh ingredients and the crispness of early morning light.

### The "No-Line" Rule
**Standard 1px borders are strictly prohibited.** We define boundaries through tonal transitions. To separate sections, shift the background color from `surface` (#f0fdf4) to `surface-container-low` (#eaf7ee). This creates a sophisticated, "borderless" interface that feels continuous and architectural.

### Surface Hierarchy & Nesting
Treat the UI as physical layers of fine paper. 
*   **Base:** `surface` (#f0fdf4) for the main canvas.
*   **Floating Elements:** Use `surface-container-lowest` (#ffffff) for cards to create a subtle "pop" against the honeydew background.
*   **Deep Pockets:** Use `surface-container-high` (#deebe3) for recessed areas like search bars or footer backgrounds.

### The "Glass & Gradient" Rule
To mimic the refraction of light through a glass juice carafe:
*   **Glassmorphism:** Use `surface` colors at 70% opacity with a `20px` backdrop-blur for navigation bars and floating action menus.
*   **Signature Gradients:** For primary CTAs, use a subtle linear gradient from `primary` (#006948) to `primary_container` (#00855d) at a 135-degree angle. This adds a "weighted" premium feel that flat hex codes cannot achieve.

---

## 3. Typography: Editorial Authority
The typography bridges the gap between urban sophistication and natural warmth.

*   **Display & Headlines (Plus Jakarta Sans):** These are our "hero" moments. Use `display-lg` for menu categories and `headline-lg` for dish names. The geometric nature of Jakarta Sans provides an architectural "Melbourne" feel.
*   **Body & Labels (Be Vietnam Pro):** Chosen for its humanist warmth and exceptional legibility. `body-lg` is the workhorse for descriptions, while `label-md` provides a technical, clean look for nutritional facts or pricing.
*   **The Hierarchy Strategy:** Always pair a `display-sm` heading with a significantly smaller `label-md` eyebrow text. This "Large-Small" contrast is the hallmark of high-end editorial design.

---

## 4. Elevation & Depth: Tonal Layering
We move away from the "shadow-heavy" web. Depth is achieved through light and color.

*   **The Layering Principle:** Place a `surface-container-lowest` card on a `surface-container-low` section. This creates a natural "lift" based on color value rather than structural shadows.
*   **Ambient Shadows:** If a shadow is required for a floating Modal or Fab, it must be tinted. Use 6% opacity of `on-surface` (#131e19) with a 40px blur and 10px Y-offset. It should look like a soft glow, not a dark smudge.
*   **The "Ghost Border":** For interactive states (like a focused text input), use the `outline-variant` (#bccac0) at 20% opacity. This "barely there" line maintains the luminous aesthetic while providing necessary affordance.

---

## 5. Components: Clean, Airy, Bespoke

### Buttons
*   **Primary:** Pill-shaped (`full` roundedness), using the Signature Gradient. No border. Text in `on-primary` (#ffffff).
*   **Secondary:** `surface-container-highest` background with `on-secondary-container` text.
*   **Tertiary:** Text-only in `primary` with a `title-sm` weight.

### Cards & Lists
*   **The Rule:** No dividers. Use `24px` or `32px` of vertical whitespace to separate list items. 
*   **Menu Cards:** Use `xl` (1.5rem) corner radius. Place high-resolution, top-down food photography flush to the top, allowing the image to "bleed" to the edges.

### Inputs & Fields
*   **Fields:** Use `surface-container-low` with a `md` (0.75rem) corner radius. Labels should sit above the field in `label-sm` uppercase for a "boutique" look.
*   **States:** Error states use `error` (#ba1a1a) but only for the text and a subtle 10% opacity background wash in the input field.

### Selection Chips
*   For dietary filters (e.g., "Vegan," "Gluten-Free"). Use `secondary_fixed` (#c0edd3) for unselected and `primary` for selected. Roundedness must be `full`.

---

## 6. Do's and Don'ts

### Do:
*   **Do** use "Negative Space" as a functional element. If a screen feels cluttered, increase the honeydew background area.
*   **Do** use asymmetric image placement (e.g., a dish image overflowing the right side of the screen) to create movement.
*   **Do** ensure all primary actions use the `primary` (#006948) green to symbolize freshness and growth.

### Don't:
*   **Don't** use pure black (#000000) for text. Use `on-surface` (#131e19) to maintain the soft, natural light feel.
*   **Don't** use 1px solid dividers to separate menu items. Use whitespace or a subtle background shift.
*   **Don't** use "Default" shadows. If the shadow doesn't look like ambient morning light, it’s too heavy.
*   **Don't** use sharp corners. Our lowest roundedness should be `sm` (0.25rem), but favor `xl` and `full` for a friendly, organic touch.