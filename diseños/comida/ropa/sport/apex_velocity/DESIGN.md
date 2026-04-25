```markdown
# Design System Strategy: Apex Performance

## 1. Overview & Creative North Star
**Creative North Star: "Kinetic Brutalism"**

This design system is built to mirror the visceral intensity of elite performance. We are moving away from the "standard e-commerce grid" and toward a high-impact, editorial experience that feels like a sports documentary in motion. By leveraging **Kinetic Brutalism**, we use heavy typography, stark contrasts, and intentional asymmetry to create a sense of forward momentum. 

The layout should never feel static. Through the use of overlapping elements, "bleeding" imagery that breaks container boundaries, and a ruthless commitment to tonal depth over structural lines, we create a digital environment that feels as powerful as the athletes it serves.

---

## 2. Colors & Surface Philosophy
The palette is dominated by **Energy Red (#DC2626)**, anchored by a deep obsidian black and crisp white. Our goal is to use color as a rhythmic pulse throughout the experience.

### The "No-Line" Rule
To maintain a premium, modern aesthetic, **1px solid borders are strictly prohibited for sectioning.** Boundaries are defined exclusively through background shifts. For example, a `surface-container-low` section should sit directly against a `surface` background. The change in tone is the divider.

### Surface Hierarchy & Nesting
Treat the UI as a physical stack of materials. 
- **Base Layer:** `surface` (#0e0e0e) or `surface-container-lowest` (#000000).
- **Secondary Layer:** `surface-container` (#191919) for content blocks.
- **Top Layer:** `surface-bright` (#2c2c2c) for interactive cards.
Nesting these layers creates a sophisticated "stealth" depth that feels integrated into the hardware of the screen.

### The "Glass & Gradient" Rule
For floating elements (modals, persistent navigation), use **Glassmorphism**. Apply `surface` colors at 80% opacity with a `20px` backdrop-blur. 
- **Signature Polish:** Use a subtle linear gradient on primary CTAs transitioning from `primary_dim` (#e02928) to `primary` (#ff8e82). This "inner glow" prevents the red from feeling flat and adds a technical, high-performance sheen.

---

## 3. Typography: The Power Scale
Typography is our primary visual driver. We pair the industrial, condensed strength of **Oswald** with the hyper-legibility of **Inter**.

*   **Display & Headlines (Oswald):** Must always be **Uppercase**. Use tight letter-spacing (-0.02em) to create a "block" of text that feels like a physical barrier.
*   **Body & Titles (Inter):** Provides the technical counterpoint. Use generous line-height (1.6) for body text to balance the heavy density of the headlines.

**Hierarchy Role:**
- **Display-LG/MD:** Reserved for Hero statements. These should often overlap image boundaries to create depth.
- **Headline-SM:** Used for product categories and section starts.
- **Label-MD:** Used for technical specs (e.g., "MOISTURE-WICKING", "4-WAY STRETCH") in all-caps Inter with increased tracking (+0.1em).

---

## 4. Elevation & Depth: Tonal Layering
We reject the traditional "drop shadow" in favor of light and shadow behavior found in high-end photography.

### The Layering Principle
Depth is achieved by "stacking" the `surface-container` tiers. A `surface-container-highest` card placed on a `surface` background provides a natural, subtle lift that feels architectural rather than digital.

### Ambient Shadows
When a component must float (e.g., a "Quick Add" FAB), use an **Extra-Diffused Ambient Shadow**:
- `box-shadow: 0 24px 48px rgba(0, 0, 0, 0.4);`
Avoid grey shadows on dark backgrounds; ensure the shadow is a pure black or a deep tint of the underlying surface to maintain "inkiness."

### The "Ghost Border" Fallback
If accessibility requires a container edge, use a **Ghost Border**: `outline-variant` (#484848) at **15% opacity**. This provides a "hint" of an edge without interrupting the visual flow of the Kinetic Brutalism style.

---

## 5. Components

### Buttons: The Action Drivers
All buttons utilize a **4px (0.25rem)** corner radius—sharp enough to feel aggressive, rounded enough to feel engineered.
- **Primary:** `primary` background with `on_primary_fixed` (black) text. Use a subtle `primary_container` top-border (1px) for a "lit from above" effect.
- **Secondary:** Transparent background with a `Ghost Border` and white text.
- **States:** On hover, Primary buttons should "shimmer" using a slight increase in brightness; they do not change color, they gain intensity.

### Cards & Product Grids
**Forbid the use of divider lines.** Separate product information from imagery using a shift from `surface-container-low` to `surface-container-high`. 
- **Imagery:** Use action-oriented, high-contrast photography. Images should have a slight "grain" overlay to add texture and grit.

### Inputs & Fields
- **Background:** `surface-container-highest`.
- **Active State:** A 2px bottom-bar of `primary` (Energy Red). Do not wrap the entire input in a red box; a single high-contrast line is more authoritative.

### Kinetic Components (App Specific)
- **The "Power Slider":** A custom range selector for filtering intensity/compression levels, using a thick `primary` track and a `surface-bright` oversized handle.
- **Performance Tickers:** Horizontal scrolling text ribbons using `display-sm` (Oswald) at low opacity, moving behind product images to create a parallax effect.

---

## 6. Do’s and Don’ts

### Do:
- **Use "Active" Whitespace:** Use large, asymmetrical gaps (e.g., 128px vs 64px) to drive the user's eye toward the "Energy Red" CTAs.
- **Crop Aggressively:** Crop lifestyle photography so that the athlete's limbs break the frame, implying movement that cannot be contained by the UI.
- **Contrast for Clarity:** Ensure `on_background` white text always sits on `surface` or `surface-container` tiers for maximum "pop."

### Don’t:
- **No Centered Layouts:** Avoid centering everything. Left-aligned headlines with right-aligned body copy create the "tension" required for this brand.
- **No Soft Grays:** Avoid mid-tone grays. Stay in the deep blacks or the bright whites. Mid-grays sap the energy from the Energy Red.
- **No Standard Transitions:** Avoid "fade" transitions. Use "slide" or "power-scale" (slight growth) transitions to maintain the "Apex" performance feel.

---

**Director’s Final Note:** 
Remember, this is not a library—it’s a toolkit for movement. Every pixel should feel like it's caught in the middle of an Olympic sprint. If a layout feels "safe," break the grid. If a color feels "dull," check your surface nesting. Speed is our aesthetic.