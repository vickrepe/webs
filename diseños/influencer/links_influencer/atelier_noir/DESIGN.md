# Design System Document: The Editorial Lens

## 1. Overview & Creative North Star
**Creative North Star: "The Digital Atelier"**
This design system moves away from the "grid-of-boxes" found in standard social templates and moves toward the intentionality of a high-end fashion editorial. The aesthetic is defined by **The Digital Atelier**: a space that feels curated, quiet, and profoundly intentional. 

We break the "template" look through **intentional asymmetry**—where imagery and typography are allowed to bleed, overlap, and breathe. By prioritizing whitespace as a functional element rather than "empty" space, we create a sense of luxury. This system is not just about displaying content; it is about *framing* it with the same reverence a gallery curator gives to a masterpiece.

---

## 2. Colors
Our palette is rooted in a "Warm Monochrome" philosophy. We use `#1C1917` (Primary) not just as a color, but as an anchor of authority against a landscape of nuanced greys and off-whites.

### The "No-Line" Rule
**Traditional 1px solid borders are strictly prohibited for sectioning.** 
Structural boundaries must be defined solely through background color shifts. For example, a `surface-container-low` section should sit directly against a `surface` background to denote a change in context. This creates a seamless, fluid transition that feels more like a physical magazine page and less like a software interface.

### Surface Hierarchy & Nesting
Treat the UI as a series of layered sheets of fine vellum.
*   **Base:** `surface` (#f9f9fb) for the primary background.
*   **Nesting:** Use `surface-container-low` (#f2f4f7) for large content areas. Place `surface-container-lowest` (#ffffff) cards on top of these areas to create a "soft lift."
*   **Contrast:** Use `inverse_surface` (#0c0e10) sparingly for high-impact callouts or dark-mode-style sections within a light page.

### The "Glass & Gradient" Rule
To add "soul" to the digital canvas, use **Glassmorphism** for navigation bars and floating action elements. Apply a semi-transparent `surface` color with a `20px` backdrop-blur. 
*   **Signature Gradient:** For primary CTAs or Hero section highlights, use a subtle linear gradient transitioning from `primary` (#625d5b) to `primary_container` (#e9e1dd). This prevents the "flat" look of generic UI and adds a tactile, fabric-like depth.

---

## 3. Typography
The typographic soul of this system lies in the tension between the classic elegance of **Playfair Display** (Noto Serif) and the functional modernity of **Inter**.

*   **Display & Headlines (Playfair Display):** These are your "Editorial Voices." Use `display-lg` and `headline-lg` with tight letter-spacing (-2%) to create a high-fashion masthead feel. 
*   **Body & Titles (Inter):** These provide the "Curatorial Notes." Use `body-lg` for long-form reading with a generous line-height (1.6) to ensure the sophisticated breathing room required for fashion content.
*   **Labels (Inter):** All-caps `label-sm` with increased letter-spacing (+10%) should be used for categories (e.g., "MENSWEAR," "LIFESTYLE") to mimic high-end garment tags.

---

## 4. Elevation & Depth
We eschew the heavy shadows of "Material Design" in favor of **Tonal Layering**.

*   **The Layering Principle:** Depth is achieved by stacking. A card in `surface-container-lowest` (#ffffff) sitting on a `surface-container-low` (#f2f4f7) background provides all the "elevation" needed for the human eye to perceive hierarchy.
*   **Ambient Shadows:** If a floating element (like a modal) is required, use a shadow with a `40px` blur at `4%` opacity, using the `on_surface` color as the tint. It should look like a soft glow, not a drop shadow.
*   **The "Ghost Border" Fallback:** If a border is required for accessibility in input fields, use `outline_variant` at **20% opacity**. Never use a 100% opaque border; it breaks the editorial fluidity.
*   **Glassmorphism:** Use for persistent headers. It allows the rich photography of the "Moda" theme to bleed through, maintaining a connection to the content even while navigating.

---

## 5. Components

### Buttons
*   **Primary:** Solid `primary` (#625d5b) with `on_primary` text. No shadows. 4px corner radius.
*   **Secondary:** `primary_fixed_dim` background with `on_primary_fixed` text. 
*   **Tertiary:** Text-only in `primary` with a 1px `primary` underline that sits 4px below the baseline.

### Cards & Lists
*   **The Rule of Zero Dividers:** Never use horizontal lines to separate list items. Use vertical whitespace (referencing our `1.5rem` spacing scale) or a subtle shift to `surface-container-highest` on hover.
*   **Image-First Cards:** Cards should feature 4px rounded corners and use `surface-container-lowest` for the container. Text should be inset with generous padding (`1.5rem` minimum).

### Input Fields
*   **Style:** Minimalist. No background fill. Only a bottom border using `outline_variant` at 40% opacity. Upon focus, the border transitions to `primary` (#625d5b) at 1px thickness.

### Additional Signature Components
*   **The "Lookbook" Carousel:** A horizontal scroll component where images are intentionally offset in height, creating an asymmetrical rhythm.
*   **Editorial Pull-Quote:** Using `headline-md` (Playfair Display) with a `tertiary` (#6f5d37) accent color to break up long-form lifestyle articles.

---

## 6. Do’s and Don’ts

### Do:
*   **Do** use asymmetrical margins (e.g., a wider left margin than right) to create an editorial layout.
*   **Do** allow images to be the primary drivers of the color experience.
*   **Do** use `primary_container` (#e9e1dd) for soft, large-scale background blocks to highlight featured text.

### Don’t:
*   **Don’t** use pure black (#000000) for text. Use `on_surface` (#2d3338) for better readability and a premium feel.
*   **Don’t** use "Card Shadows" to define structure. Use background tonal shifts.
*   **Don’t** crowd the interface. If you feel like you need a divider line, you likely need more whitespace.
*   **Don’t** use large corner radii. Stick strictly to the **4px (0.25rem)** DEFAULT to maintain a sharp, tailored architectural feel.