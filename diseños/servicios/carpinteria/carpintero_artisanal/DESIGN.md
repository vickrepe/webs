```markdown
# Design System Document: The Artisanal Workshop

## 1. Overview & Creative North Star: "The Master’s Workbench"
This design system rejects the clinical coldness of modern SaaS in favor of "The Master’s Workbench"—a creative direction rooted in tactile warmth, structural integrity, and the quiet confidence of a craftsman. We move beyond the "template" look by treating the digital interface as a physical workspace where materials (surfaces) are layered, not just placed.

The "Signature Polish" of this system comes from intentional asymmetry and high-contrast typography scales. By pairing a wide-set, architectural display font with a functional, humanistic body face, we create an editorial rhythm that feels curated rather than generated. We prioritize "breathable density"—tightly organized information surrounded by generous, purposeful negative space.

---

## 2. Colors: Tonal Integrity
Our palette is anchored in the richness of raw timber (`primary: #712c00`) and the softness of natural light (`surface: #fcf9f7`). 

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders for sectioning. Boundaries must be defined solely through background color shifts or tonal transitions. To separate a hero section from a feature list, transition from `surface` to `surface-container-low`.

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers. Use the surface-container tiers to define importance:
- **Base Layer:** `surface` (#fcf9f7) for the main canvas.
- **Structural Sections:** `surface-container-low` (#f6f3f1) for large background blocks.
- **Interactive Containers:** `surface-container-highest` (#e5e2e0) for cards or navigation elements that need to feel "closer" to the user.

### The "Glass & Gradient" Rule
To avoid a flat, "out-of-the-box" appearance:
- **CTAs:** Use a subtle linear gradient for primary buttons, transitioning from `primary` (#712c00) to `primary_container` (#92400e) at a 45-degree angle. This adds "soul" and depth.
- **Overlays:** For modals or floating menus, use `surface_container_lowest` at 85% opacity with a `20px` backdrop-blur to create a "frosted glass" effect that allows wood-toned accents to bleed through.

---

## 3. Typography: Editorial Craft
We pair **Raleway** (Headings) for its architectural, open-ended character with **Lato** (Body) for its approachable, sturdy legibility.

*   **Display-LG (Raleway):** 3.5rem. Used for hero statements. Kerned slightly tighter (-0.02em) to feel like a premium furniture mark.
*   **Headline-MD (Raleway):** 1.75rem. The "Workhorse" header. Always high-contrast (`on_surface`).
*   **Body-LG (Lato):** 1rem. Used for long-form descriptions. Increased line-height (1.6) to ensure the "artisanal" tone feels relaxed and unhurried.
*   **Label-MD (Lato):** 0.75rem. All-caps with +0.05em tracking for technical specs or metadata, mimicking stamped serial numbers on lumber.

---

## 4. Elevation & Depth: Tonal Layering
Traditional structural lines are replaced with atmospheric depth.

*   **The Layering Principle:** Depth is achieved by "stacking." A card (`surface_container_lowest`) placed on a background (`surface_container_low`) creates a natural, soft lift.
*   **Ambient Shadows:** When a "floating" element is required, use a shadow with a 24px blur, 4% opacity, using the `on_surface` color as the shadow base. This mimics natural ambient light in a workshop rather than a digital drop shadow.
*   **The "Ghost Border" Fallback:** If a border is required for accessibility, use `outline_variant` (#dcc1b6) at **15% opacity**. 100% opaque borders are strictly forbidden.
*   **Glassmorphism:** Navigation bars should use a semi-transparent `surface` with backdrop-blur to soften the edges of the layout and integrate the content.

---

## 5. Components: Functional Minimalism

### Buttons
*   **Primary:** Rectangular with `DEFAULT: 0.25rem` (4px) roundness. Gradient fill (Primary to Primary Container). Label is `on_primary` (White).
*   **Secondary:** Ghost-style but without a border. Use `secondary_container` as a hover-state background shift.
*   **Tertiary:** Bold `label-md` typography with a `primary` underline that expands on hover.

### Cards & Lists
*   **Strict Rule:** No dividers. Use vertical white space (32px or 48px) to separate list items.
*   **Images:** All imagery should have the `sm: 0.125rem` (2px) radius—nearly sharp, conveying precision cutting.

### Input Fields
*   **Styling:** Fields use `surface_container_high` with no border. On focus, a 2px bottom-bar of `primary` emerges. This mimics a carpenter’s pencil line on a surface.

### Specialty Component: The "Grain" Chip
*   Used for tags or categories. High-contrast (`on_secondary_fixed`) background with `label-sm` text. These should feel like small wood-burned labels.

---

## 6. Do’s and Don’ts

### Do:
*   **Embrace Asymmetry:** Align a heading to the far left while the body copy sits in a 6-column grid to the right. It feels bespoke.
*   **Use Generous Padding:** If you think there’s enough padding, add 16px more. Craftsmanship requires room to breathe.
*   **Mix Weights:** Pair a `Display-LG` (Thin 200 weight) with a `Title-SM` (Bold 700 weight) for visual tension.

### Don’t:
*   **No Rounded Pills:** Never use `full` (9999px) roundness. It contradicts the "linear craftsmanship" of the brand. Stick to `0.25rem` to `0.5rem`.
*   **No Pure Greys:** Never use #000 or #888. All neutrals must be tinted with the `secondary` or `outline` tones to maintain the "warm" artisanal glow.
*   **No Heavy Dividers:** If a separator is vital, use a `1px` line of `outline_variant` at 10% opacity that doesn't span the full width of the container.

---

**Director’s Final Note:** 
This system is about the "invisible hand" of the designer. Every margin and every tonal shift should feel as intentional as a dovetail joint. If the layout feels like a standard grid, you haven't pushed the tonal layering far enough.```