# Design System: The Michelin Star Table

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Michelin Star Table."** 

In world-class dining, the experience is defined by what is *absent* as much as what is present. We are moving away from the "template" look of cluttered digital interfaces toward a **High-End Editorial** experience. This system rejects the safety of the grid in favor of intentional asymmetry, vast "darkspace," and a sense of "The Private Gallery." 

The design must feel like a physical object—a heavy cardstock menu or a dark stone tabletop. We achieve this through "The Void"—using large areas of `surface` (#100e0c) to let a single piece of typography or a high-resolution image breathe. Layouts should utilize overlapping elements and staggered text placement to break the traditional vertical scroll, creating a rhythmic, curated journey.

---

## 2. Colors: Tonal Depth & The "No-Line" Rule
This system utilizes a monochromatic, high-contrast palette to evoke a sense of nocturnal elegance.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders for sectioning or containment. Traditional lines are "noise." Boundaries must be defined solely through background color shifts. 
*   *Example:* A `surface-container-low` section sitting directly on a `surface` background.

### Surface Hierarchy & Nesting
Instead of a flat grid, treat the UI as physical layers.
*   **Base:** `surface` (#100e0c) is your foundation.
*   **The Inset:** Use `surface-container-lowest` (#000000) for deep, recessed areas like footer backgrounds or immersive media galleries.
*   **The Lift:** Use `surface-container-high` (#241f1a) for interactive elements that need to feel closer to the user.

### Glass & Signature Textures
To prevent the dark theme from feeling "flat," use the **Glassmorphism Rule** for floating navigation and overlays. Use `surface` at 80% opacity with a `24px` backdrop-blur. 
For CTAs, apply a subtle linear gradient from `primary` (#ccc5c2) to `primary-container` (#4a4643) at a 45-degree angle. This adds a "metallic" sheen reminiscent of fine silver cutlery.

---

## 3. Typography: The Editorial Voice
Our typography scale is designed to mimic a prestige lifestyle magazine. We pair the authoritative, high-contrast serifs of **Playfair Display** (mapped to NotoSerif tokens) with the functional precision of **Inter**.

*   **Display (Playfair Display):** Use `display-lg` for hero statements. These should often be center-aligned or dramatically offset to one side of the screen.
*   **Headings (Playfair Display):** `headline-lg` and `md` should use generous letter spacing (-0.02em) to maintain a modern, tight look.
*   **Body (Inter):** `body-lg` is our workhorse. Keep line heights generous (1.6 - 1.8) to ensure the text feels airy and readable against dark backgrounds.
*   **Labels (Inter):** `label-md` should always be Uppercase with +10% letter spacing to evoke a "branded" feel, often used for overlines or category tags.

---

## 4. Elevation & Depth: Tonal Layering
We reject "Material" shadows in favor of **Tonal Layering** and **Ambient Light.**

*   **The Layering Principle:** Depth is achieved by "stacking." A `surface-container-low` card placed on a `surface` background creates a soft, natural lift without the need for a stroke.
*   **Ambient Shadows:** If a floating element (like a Reservation Modal) requires a shadow, it must be "Atmospheric":
    *   *Blur:* 60px
    *   *Spread:* -10px
    *   *Color:* `rgba(0, 0, 0, 0.5)`
*   **The "Ghost Border" Fallback:** If a border is required for accessibility, use the `outline-variant` token at **15% opacity**. 100% opaque borders are strictly forbidden as they break the "Michelin Star" aesthetic.

---

## 5. Components: Rectangular & Sharp
All components follow a strict **0px border-radius** policy. Sharp corners convey precision, architectural intent, and a high-fashion sensibility.

### Buttons
*   **Primary:** Solid `primary` (#ccc5c2) background with `on-primary` (#433f3d) text. No rounding.
*   **Secondary:** Ghost style. No background, `outline` (#7d746d) at 20% opacity for the border. 
*   **Interaction:** On hover, primary buttons should shift to `primary_dim` (#beb7b4). Transitions should be slow (400ms ease-out) to feel "weighted."

### Input Fields
Text inputs should be "Minimalist Underlines." No boxes. Use a 1px line of `outline-variant` that transforms into `primary` upon focus. Helper text uses `body-sm` in `on-surface-variant`.

### Cards & Menus
*   **The Rule of Silence:** Forbid the use of divider lines between list items or menu sections. 
*   **Spacing:** Use vertical white space (64px+) from the spacing scale to separate courses or content blocks. 
*   **Interactive State:** On hover, a card should shift its background from `surface` to `surface-bright` (#322b25).

### Signature Component: The "Dégustation" Carousel
A horizontal scroll component for showcasing dishes. Images should be edge-to-edge, utilizing a `surface-container-lowest` (#000000) backdrop to make food photography appear as if it is emerging from the dark.

---

## 6. Do’s and Don’ts

### Do:
*   **Do** use extreme whitespace. If a section feels "finished," add 40px more padding.
*   **Do** use asymmetrical layouts (e.g., a heading on the left, body text shifted to the right 3 columns).
*   **Do** prioritize high-quality, moody photography with deep blacks.

### Don’t:
*   **Don't** use icons unless absolutely necessary. Rely on clear, beautiful typography.
*   **Don't** use rounded corners (`0px` is the only value).
*   **Don't** use vibrant, saturated colors. If you need an accent, use the muted `error_dim` (#ba573f).
*   **Don't** use "Drop Shadows" that look like they belong on a standard SaaS dashboard. Keep them ambient and soft.