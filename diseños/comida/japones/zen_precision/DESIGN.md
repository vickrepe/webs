# Design System: Zen Precision

## 1. Overview & Creative North Star
**Creative North Star: The Silent Architect**

This design system is a digital manifestation of *Ma* (negative space)—the Japanese concept of the "gap" or "space between." We are moving beyond standard minimalist templates to create a high-end, editorial experience that feels as intentional as a karesansui (zen garden). 

The goal is to break the "web-standard" grid through **intentional asymmetry** and **tonal depth**. By utilizing sharp, 0px border radii and high-contrast typography, we create an atmosphere of "Zen Precision." The UI should never feel "crowded" or "decorated"; every pixel must justify its existence. We achieve premium quality not through complexity, but through the extreme refinement of the essentials: light, space, and razor-sharp geometry.

---

## 2. Colors & Surface Philosophy

The palette is anchored in **Indigo Black (`#0F172A`)** and **Cool Slate White (`#F8FAFC`)**, evoking the ink-on-paper feel of traditional calligraphy reimagined for a modern architectural setting.

### The "No-Line" Rule
To maintain the "Zen" atmosphere, **1px solid borders are strictly prohibited for sectioning.** Boundaries must be defined solely through background color shifts. 
- A secondary section should sit on `surface_container_low`.
- A call-to-action block should emerge from a shift to `surface_container_highest`.
- Lines interrupt the flow of the eye; tonal shifts guide it.

### Surface Hierarchy & Nesting
Treat the UI as physical layers of fine slate and rice paper.
- **Base Layer:** `surface` (#f7f9fb).
- **Secondary Content:** `surface_container_low` (#f0f4f7).
- **Interactive Elements/Cards:** `surface_container_lowest` (#ffffff) to provide a subtle "glow" against the cool background.

### The Glass & Gradient Rule
While the theme is minimalist, flat design can feel "cheap." 
- Use **Glassmorphism** for floating navigation bars or modal overlays. Utilize `surface` at 80% opacity with a `backdrop-filter: blur(20px)`.
- Use **Signature Textures**: Apply a subtle linear gradient from `primary` (#565e74) to `primary_dim` (#4a5268) on main CTAs. This creates a "satin" finish that feels bespoke and professional.

---

## 3. Typography: Editorial Authority

We use a high-contrast scale to create an editorial feel, pairing the geometric authority of Montserrat (Headings) with the functional precision of Inter (Body).

*   **Display (Montserrat):** Used for hero headers and menu categories. Massive scale (`display-lg` at 3.5rem) with `-0.02em` tracking to create a "dense" architectural feel.
*   **Headlines (Montserrat):** Used for section titles. Always in `on_surface` (#2a3439).
*   **Title & Body (Inter):** The "Workhorse." Inter provides a neutral, modern balance to the sharp headings. 
*   **Label (Inter):** Used for micro-copy (e.g., "Gluten Free," "Chef's Special"). Always uppercase with `+0.05em` letter spacing for a refined, premium touch.

---

## 4. Elevation & Depth

In a system with `0px` roundedness, depth must be handled with extreme delicacy to avoid looking like a legacy Windows application.

*   **The Layering Principle:** Depth is achieved by "stacking." Place a `surface_container_lowest` card on top of a `surface_container_low` background. The contrast is the elevation.
*   **Ambient Shadows:** If a floating element (like a cart drawer) requires a shadow, use a "Cloud Shadow": 
    - `box-shadow: 0 24px 48px -12px rgba(15, 23, 42, 0.08);`
    - This creates a soft, ambient lift that mimics natural light filtering through a shoji screen.
*   **The "Ghost Border" Fallback:** If high-key accessibility is required, use the `outline_variant` (#a9b4b9) at **15% opacity**. It should be barely perceptible.

---

## 5. Components

### Buttons
- **Primary:** `primary` background, `on_primary` text. Sharp corners (`0px`). Padding: `16px 32px`. 
- **Secondary:** Transparent background with a `primary` label and a "Ghost Border" (15% opacity `outline_variant`).
- **Interaction:** On hover, the primary button should shift to `primary_dim`. No bounce animations; only smooth, linear fades (200ms).

### Cards & Menu Items
- **Rule:** Forbid divider lines between menu items.
- **Layout:** Use vertical white space (32px - 48px) to separate the "Sashimi" section from the "Nigiri" section.
- **Imagery:** Photos should be framed in sharp, 1:1 or 4:5 aspect ratios.

### Input Fields
- **Style:** Underline only. No box containers. Use a 2px stroke of `outline_variant` that transitions to `primary` on focus.
- **Labels:** `label-md` in `on_surface_variant`, floating above the input.

### Signature Component: The "Zen" Divider
Instead of a full-width line, use a 40px horizontal rule, 2px thick, in `primary_fixed_dim`, centered. This acts as a visual "breath" between content blocks.

---

## 6. Do’s and Don’ts

### Do:
- **Do use "Oversized" White Space:** If you think there is enough margin, double it. This creates the "Quiet" atmosphere.
- **Do use Asymmetric Layouts:** Place a menu image slightly off-center to create a dynamic, modern feel.
- **Do use Tonal Shifts:** Use `surface_container_high` for footers to anchor the page.

### Don’t:
- **Don’t use Border Radius:** Every corner must be a sharp 90-degree angle. This is non-negotiable for "Zen Precision."
- **Don’t use Pure Black:** Always use the Indigo Black (`#0F172A`) for text and primary elements to maintain tonal depth.
- **Don’t use Standard Shadows:** Avoid heavy, dark drop-shadows. If the surface hierarchy is correct, you won't need them.
- **Don't use Icons for everything:** Rely on high-quality typography labels first. Only use icons when they serve a functional, navigational purpose.