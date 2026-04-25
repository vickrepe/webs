# The Design System: Architectural Efficiency

## 1. Overview & Creative North Star: "The Kinetic Grid"
Moving is a transition from chaos to order. This design system rejects the "cluttered utility" look of traditional logistics. Instead, it adopts a Creative North Star we call **"The Kinetic Grid."** 

The Kinetic Grid treats the layout as a series of perfectly organized cargo units. It breaks the "template" look by using intentional, high-contrast typography scales and **Tonal Layering**. We avoid the rigid, boxed-in feel of traditional web design by using overlapping elements and sophisticated background shifts. The goal is to make the user feel that their life is being handled with surgical precision and premium care.

## 2. Colors: The Palette of Confidence
Our palette is rooted in `primary` (#006948), a deep "Confidence Green" that signals reliability. We move beyond flat design by utilizing the full Material spectrum to create depth.

### The "No-Line" Rule
**Borders are a failure of hierarchy.** Within this design system, 1px solid borders for sectioning are strictly prohibited. Boundaries must be defined solely through background color shifts. 
*   *Implementation:* A `surface-container-low` section should sit directly against a `surface` background. The change in tone is the boundary.

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers. We use the `surface-container` tiers to create "nested" importance:
1.  **Base Layer:** `surface` (#d8fff0) for the main page background.
2.  **Structural Zones:** `surface-container-low` (#befee8) for large content areas.
3.  **Active Cards:** `surface-container-lowest` (#ffffff) to make interactive elements "pop" against the minty base.

### The "Glass & Gradient" Rule
To add soul to the "Efficient" tone, use **Glassmorphism** for floating navigation bars or quote calculators. 
*   *Token usage:* Combine `surface` at 70% opacity with a `backdrop-filter: blur(12px)`.
*   *Signature Gradients:* For primary CTAs, use a subtle linear gradient from `primary` (#006948) to `primary_dim` (#005b3e) at a 135° angle. This adds a "machined" premium finish.

## 3. Typography: Editorial Authority
We pair the geometric authority of **Montserrat** (Headings) with the high-legibility of **Open Sans** (Body) to balance "Dynamic" with "Efficient."

*   **Display (Montserrat):** Used for "Hero" moments. Use `display-lg` (3.5rem) with tight letter-spacing (-0.02em) to create an editorial, high-end feel.
*   **Headline (Montserrat):** Use `headline-md` (1.75rem) for section titles. Ensure these have significant top-margin to breathe.
*   **Body (Open Sans):** All functional text uses `body-lg` (1rem). The slightly larger base size ensures the "Organized" tone isn't lost in small, cramped text.
*   **Labels (Open Sans):** Use `label-md` (0.75rem) in all-caps with +0.05em tracking for secondary metadata or "Step" indicators.

## 4. Elevation & Depth: Tonal Layering
We move away from the 2010s "drop shadow" era. Depth is now a property of light and material.

*   **The Layering Principle:** Place a `surface-container-lowest` card on a `surface-container-low` background. This creates a soft, natural lift that feels like high-quality paper.
*   **Ambient Shadows:** If a floating element (like a "Book Now" FAB) requires a shadow, it must be tinted. 
    *   *Spec:* `box-shadow: 0 12px 32px rgba(0, 54, 42, 0.08);` (Using a low-opacity version of `on_surface`).
*   **The "Ghost Border" Fallback:** If accessibility requires a stroke (e.g., in high-glare environments), use `outline-variant` at 15% opacity. Never use 100% opaque lines.

## 5. Components: Precision Machined
All components follow a strict **4px to 6px (`md`) corner radius** to maintain the "Rectangular/Organized" requirement while softening the touchpoints.

### Buttons
*   **Primary:** `primary` background with `on_primary` text. No border. 4px radius.
*   **Secondary:** `primary_container` background with `on_primary_container` text.
*   **Tertiary:** Transparent background, `primary` text. No border.

### Input Fields
*   **Surface:** Use `surface_container_highest` for the input track.
*   **Indicator:** A 2px bottom-bar in `primary` color when focused, rather than a full box stroke.

### Cards & Lists
*   **Forbidden:** Divider lines between list items.
*   **Requirement:** Use 24px of vertical white space or a subtle `surface-container-low` hover state to separate items.
*   **The "Inventory Item" Card:** For moving inventories, use `surface-container-lowest` with a 4px `outline-variant` (at 10% opacity) "Ghost Border" to suggest a physical box.

### Signature Component: The "Transition Progressor"
A custom component for the moving industry. A horizontal bar using `secondary_container` as the track and a `primary` moving "truck" icon that sits on a `surface-container-highest` floating pill. It visualizes the state of the move without cluttering the UI.

## 6. Do's and Don'ts

### Do
*   **Do** use asymmetrical margins. For example, a 15% left-margin on a headline while body text stays at 10% creates a sophisticated, non-generic look.
*   **Do** use `tertiary_container` (#00dcfe) sparingly for "Success" or "Live Updates" to contrast the greens.
*   **Do** use `surface_bright` to highlight the most important "Action Center" on a page.

### Don't
*   **Don't** use pure black (#000000). Always use `on_surface` (#00362a) for text to maintain the tonal green sophistication.
*   **Don't** use standard "Material Blue" for links. Use `primary` or `tertiary`.
*   **Don't** use rounded "pill" buttons. Stick to the 4-6px `md` radius to maintain the architectural, organized feel.
*   **Don't** use 1px dividers. If content needs separation, use a 8px tall `surface-container-low` horizontal "spacer" block instead.