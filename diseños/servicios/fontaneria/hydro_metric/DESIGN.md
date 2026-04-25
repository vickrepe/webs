# Design System Document: Technical Precision & Fluidity

## 1. Overview & Creative North Star: "The Industrial Blueprint"

This design system is built to move beyond the "neighborhood handyman" cliché. Our Creative North Star is **The Industrial Blueprint**. It treats the digital interface with the same level of technical rigor and structural integrity as high-end hydraulic engineering. 

We reject the generic "blue-box" plumber aesthetic. Instead, we embrace a sophisticated, editorial approach that feels authoritative and unwavering. To break the "template" look, we utilize **intentional asymmetry**—offsetting large, technical typography against precise, architectural layouts. We prioritize breathing room and tonal depth over decorative elements, ensuring that every pixel feels like it was placed with a master craftsman’s precision.

---

## 2. Colors: Tonal Immersion

The palette is anchored in `#1D4ED8` (Water Blue), but it is used as a strategic tool rather than a decorative wash.

### The "No-Line" Rule
Traditional plumbing sites are cluttered with borders. In this system, **1px solid borders are strictly prohibited for sectioning.** Boundaries must be defined solely through background shifts. For example, a `surface-container-low` section should sit directly against a `surface` background. The shift in tone creates a modern, high-end boundary that feels integrated, not "boxed in."

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers. Use the surface-container tiers to create depth:
*   **Base Layer:** `surface` (#faf8ff)
*   **Secondary Context:** `surface-container-low` (#f3f2fe)
*   **Floating Elements:** `surface-container-lowest` (#ffffff) for maximum "lift."

### The "Glass & Gradient" Rule
To evoke the properties of water and professional polish, use **Glassmorphism** for floating navigation or overlays. Utilize semi-transparent versions of `surface` with a `backdrop-blur` of 12px-20px. 
*   **Signature Texture:** For hero sections or primary CTAs, apply a subtle linear gradient transitioning from `primary` (#0037b0) to `primary_container` (#1D4ED8) at a 135-degree angle. This adds a "weighted" feel that flat colors lack.

---

## 3. Typography: The Engineering Font Stack

The typography creates a tension between the rigid, industrial nature of `Oswald` and the functional clarity of `Inter` (enhanced from Roboto for better digital legibility).

*   **Display & Headlines (Oswald):** Used for "Hard Data" and big statements. Oswald’s condensed nature mimics the verticality of structural piping. 
    *   *Note:* Always use `uppercase` for `display-lg` to reinforce the "Professional/Technical" tone.
*   **Body & Labels (Inter):** Chosen for its high x-height and readability. It acts as the "Instruction Manual" of the system—clear, sober, and reliable.

**Hierarchy as Identity:** 
We use an "Aggressive Scale" shift. A `display-lg` (3.5rem) should often sit near a `body-md` (0.875rem). This high contrast removes the "middle-ground" and makes the design feel like a high-end technical journal.

---

## 4. Elevation & Depth: Tonal Layering

We do not use shadows to represent "cheap" plastic elevation. We use it to represent physical mass and ambient light.

*   **The Layering Principle:** Depth is achieved by stacking. Place a `surface-container-lowest` card on top of a `surface-container-high` background. The natural contrast provides all the "lift" needed.
*   **Ambient Shadows:** If a floating element (like a modal) is required, use a shadow color tinted with the `on-surface` token (#1a1b23) at 6% opacity, with a 32px blur and 16px Y-offset. It should feel like a soft glow, not a dark smudge.
*   **The "Ghost Border" Fallback:** If accessibility requires a border, use the `outline-variant` (#c4c5d7) at **15% opacity**. It should be felt, not seen.

---

## 5. Components: Technical Primitives

All components adhere to a strict **4px - 6px corner radius** (`md` scale). This maintains a "rectangular" professional feel while softening the "sharpness" of the industrial tone.

### Buttons
*   **Primary:** Uses the "Signature Texture" gradient. No border. Text is `label-md` uppercase Oswald for a "heavy" feel.
*   **Secondary:** `surface-container-highest` background with `on-surface` text.
*   **Tertiary:** No background. Uses `primary` text with a bottom-aligned 2px "pipe" underline that expands on hover.

### Input Fields
*   **Style:** Minimalist. Use `surface-variant` backgrounds with a subtle `outline-variant` (20% opacity) bottom-stroke.
*   **Focus State:** The bottom-stroke transitions to `primary` (#0037b0) and increases to 2px thickness.

### Cards & Lists
*   **Strict Rule:** **Forbid the use of divider lines.** 
*   Separate list items using `spacing-4` (16px) or by alternating background tones between `surface` and `surface-container-low`.
*   Content within cards should be flush-left to maintain the "Blueprint" alignment.

### Custom Component: The "Technical Spec" Chip
For plumbers, specs matter. Use small `secondary-container` chips with `label-sm` Inter text to denote pipe material, pressure ratings, or emergency status. These should be strictly rectangular (2px radius).

---

## 6. Do’s and Don’ts

### Do:
*   **Use Asymmetry:** Offset your headlines to the left while keeping body text in a narrower right-hand column.
*   **Embrace White Space:** Use `surface` colors to "push" content apart. If it feels too empty, add more space.
*   **Technical Accents:** Use the `tertiary` (#7f2500) color sparingly for "Critical Alerts" or "Heat-related" technical data.

### Don't:
*   **Don't use 100% Black:** Always use `on-surface` (#1a1b23) for text to maintain the premium, soft-technical feel.
*   **Don't use Rounded Corners > 8px:** This is a professional system, not a consumer social app. Keep it architectural.
*   **Don't use Drop Shadows on Buttons:** Use tonal contrast or the signature gradient to indicate interactability instead.