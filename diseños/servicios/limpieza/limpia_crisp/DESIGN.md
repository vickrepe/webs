# Design System Document: The Clinical Editorial

## 1. Overview & Creative North Star
**Creative North Star: "The Pristine Canvas"**
This design system moves beyond the utility of a "cleaning app" and enters the territory of high-end hygiene editorial. We are not just organizing tasks; we are curate-ing environments. The aesthetic is "Pristine Canvas"—a philosophy where negative space is as active as the content itself. 

By utilizing intentional asymmetry, oversized type scales, and a "No-Line" architectural approach, we break the "template" feel. We replace rigid, boxy grids with a breathable, layered flow that feels as fresh as a newly sanitized space.

## 2. Colors: Tonal Purity
The palette is rooted in `#0EA5E9` (Clean Blue), but its power comes from the surrounding "Air"—the neutral surface tiers that define the atmosphere.

### The "No-Line" Rule
**Strict Mandate:** Prohibit 1px solid borders for sectioning. 
Boundaries must be defined solely through background color shifts. For example, a `surface-container-low` section sitting on a `surface` background creates a sophisticated, soft edge that feels organic rather than mechanical.

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers—stacked sheets of fine, translucent paper.
*   **Base:** `surface` (#f6faff)
*   **Sectioning:** `surface-container-low` (#f0f4fa)
*   **Primary Interaction Cards:** `surface-container-lowest` (#ffffff) for maximum "pop" and perceived cleanliness.
*   **Floating Elements:** Use `surface-bright` with a 10% opacity `surface-tint` overlay for depth.

### The "Glass & Gradient" Rule
To avoid a flat, "SaaS-standard" look:
*   **Glassmorphism:** Use semi-transparent `surface` colors with a `backdrop-filter: blur(20px)` for navigation bars and floating action headers.
*   **Signature Textures:** Apply a subtle linear gradient (Top-Left to Bottom-Right) from `primary` (#006591) to `primary-container` (#0ea5e9) on hero CTAs to provide a "liquid" depth that feels high-end.

## 3. Typography: The Editorial Voice
We pair the soft, approachable geometry of **Nunito** with the clinical precision of **Inter**.

*   **Display & Headlines (Nunito):** Used for large-scale storytelling. The rounded terminals of Nunito suggest "gentle care" and "hygiene," but when scaled up to `display-lg` (3.5rem), they feel authoritative and bespoke.
*   **Body & Labels (Inter):** Used for data and functional instructions. Inter provides the "orderly" half of the "fresh and orderly" tone, ensuring legibility at small scales (`body-sm` 0.75rem).

**Typography as Brand:** Use `headline-lg` with tight letter-spacing (-0.02em) to create an editorial "masthead" feel for page titles, contrasting against wide-tracked `label-md` (uppercase) for category tags.

## 4. Elevation & Depth: Tonal Layering
Traditional shadows are often "dirty." In this system, we use light to define space.

*   **The Layering Principle:** Stack surfaces. Place a `surface-container-lowest` card on a `surface-container-low` background. This creates a natural "lift" without visual clutter.
*   **Ambient Shadows:** If a floating effect is required (e.g., a modal), use an ultra-diffused shadow: `box-shadow: 0 20px 40px rgba(0, 101, 145, 0.05)`. The blue tint in the shadow maintains the "Clean Blue" atmosphere even in the shadows.
*   **The "Ghost Border":** If a boundary is required for accessibility, use the `outline-variant` (#bec8d2) at **15% opacity**. Never use a 100% opaque border.
*   **Glassmorphism Depth:** Use a `1px` inner-stroke (border-top) in `surface-container-lowest` at 40% opacity on glass elements to mimic the "catch-light" on the edge of a clean glass pane.

## 5. Components: Pristine Primitives

### Buttons
*   **Primary:** Gradient fill (`primary` to `primary-container`), 6px radius (`md`), no border. Text: `label-md` (Bold).
*   **Secondary:** `secondary-container` fill with `on-secondary-container` text.
*   **Tertiary:** No fill. `primary` text. Use for low-emphasis actions.

### Cards & Lists
*   **Forbid Dividers:** Do not use line-rules between list items. Use 16px or 24px of vertical white space to separate content.
*   **Selection States:** Indicate selection by shifting the background color to `primary-fixed` (#c9e6ff) rather than adding a checkmark or border.

### Input Fields
*   **Field Style:** Use `surface-container-high` as the background fill. 
*   **Focus State:** Shift background to `surface-container-lowest` and add a 2px `primary` ghost-border (20% opacity). This "glows" rather than "snaps."

### Signature Component: The "Sanity Gauge"
A custom progress bar or data viz element using a `primary-container` track and a `primary` indicator, utilizing a soft glow (drop shadow) of the same color to suggest "active cleaning" or "shining" status.

## 6. Do's and Don'ts

### Do
*   **Do** embrace extreme white space. If you think there is enough padding, add 8px more.
*   **Do** use asymmetrical margins (e.g., a wider left margin for headlines) to create a high-end editorial feel.
*   **Do** use `primary-fixed-dim` for inactive states to keep the "Blue" DNA present even in disabled elements.

### Don't
*   **Don't** use pure black (#000000) for text. Always use `on-surface` (#171c20).
*   **Don't** use 90-degree sharp corners. Stick strictly to the 4px-6px (`md`) radius to maintain the "Fresh" tone.
*   **Don't** use "Alert Red" for everything. Use `error-container` (#ffdad6) for soft warnings to avoid breaking the "Orderly" calm of the interface.