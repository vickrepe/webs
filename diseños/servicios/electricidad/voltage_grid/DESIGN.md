```markdown
# Design System Document: Technical Precision & Tonal Depth

## 1. Overview & Creative North Star: "The Master Circuit"
The creative North Star for this design system is **"The Master Circuit."** Much like a perfectly wired electrical panel, the UI must communicate absolute order, technical mastery, and invisible complexity. We are moving away from the "friendly consumer app" aesthetic toward a high-end, industrial-grade editorial experience.

This system rejects the "boxed-in" look of standard web templates. Instead, it utilizes **Tonal Architecture**—defining space through subtle shifts in light and surface rather than rigid lines. The layout should feel like a blueprint: precise, expansive, and authoritative, using intentional asymmetry to guide the eye through technical data and service offerings.

---

## 2. Colors: The Electric Spectrum
We utilize a sophisticated palette of blues and neutrals to evoke reliability and high-voltage precision. 

### Surface Hierarchy & The "No-Line" Rule
**Explicit Directive:** 1px solid borders are strictly prohibited for sectioning. Structural boundaries are defined solely through background color shifts.
- **Surface Nesting:** Treat the interface as a physical stack. A `surface-container-low` section should sit directly on the `surface` background. Any card-level elements inside that section should then transition to `surface-container-lowest` (pure white) to create a natural, "lifted" focal point.
- **The Glass & Gradient Rule:** To avoid a flat, "software-default" appearance, use semi-transparent `surface` colors with a 12px-20px backdrop blur for floating navigation or overlays. 
- **Signature Texture:** Apply a subtle linear gradient to Hero sections or Primary CTAs (transitioning from `primary` #004ac6 to `primary_container` #2563eb at a 135-degree angle). This mimics the sheen of high-quality electrical components.

| Token | Value | Role |
| :--- | :--- | :--- |
| `primary` | #004ac6 | High-action focal points, branding. |
| `primary_container` | #2563eb | The "Electric Blue" core; used for active states. |
| `surface` | #faf8ff | The base "paper" of the application. |
| `surface_container_low` | #f3f3fe | Used for secondary content blocks to create depth. |
| `tertiary` | #943700 | "Safety Orange" – use sparingly for warnings or high-priority alerts. |

---

## 3. Typography: Editorial Utility
The pairing of **Work Sans** (Headings) and **Inter** (Body) creates a "Technical Editorial" vibe—combining the structural geometry of engineering with the readability of a premium journal.

- **Display & Headlines (Work Sans):** Use `display-lg` (3.5rem) with tight letter-spacing (-0.02em) for hero statements. This font's geometric construction feels "built," mirroring architectural precision.
- **Body & Labels (Inter):** Inter is our workhorse. Use `body-md` (0.875rem) for technical descriptions. The high x-height ensures legibility in dense data environments.
- **Hierarchy Tip:** Use `label-md` in all-caps with 0.05em tracking for category tags (e.g., "COMMERCIAL SERVICES") to create a sophisticated, "blueprint label" look.

---

## 4. Elevation & Depth: Tonal Layering
Traditional shadows are often too "muddy" for a precise technical brand. We achieve depth through light and atmospheric physics.

- **The Layering Principle:** Instead of shadows, stack `surface-container` tiers. A `surface-container-highest` element placed on a `surface-container-low` background creates immediate hierarchy without visual clutter.
- **Ambient Shadows:** If an element must float (e.g., a modal), use a "Long-Throw Shadow": `0px 20px 40px rgba(25, 27, 35, 0.06)`. The shadow color is derived from `on_surface`, creating a natural atmospheric falloff.
- **The Ghost Border:** If a separator is required for accessibility, use `outline_variant` at **15% opacity**. It should be felt, not seen.
- **Glassmorphism:** Navigation bars should use `surface` at 80% opacity with a `saturate(180%) blur(20px)` backdrop filter. This keeps the "Electric Blue" accents visible as the user scrolls, maintaining brand presence.

---

## 5. Components: Rectangular Rigor
All components adhere to a strict **4px - 6px roundness scale** (`DEFAULT` to `md`). This reinforces the "Technical" tone—avoiding the "pill-shaped" softness of social media apps.

- **Buttons:** 
    - *Primary:* No border. `primary` background with `on_primary` text. 4px radius. 
    - *Secondary:* `surface_container_high` background. No border.
- **Input Fields:** Use `surface_container_lowest` for the field background with a `ghost border` (outline-variant @ 20%). On focus, transition the border to `primary` #004ac6.
- **Cards & Lists:** **Prohibit Divider Lines.** Separate list items using 16px of vertical whitespace or a subtle background hover state (`surface_container_low`).
- **Circuit Indicators (Custom):** Use small 8px circular status dots (using `primary` for "Active" and `tertiary` for "Attention Required") to mimic physical LED indicators on electrical equipment.
- **Data Chips:** Use rectangular `primary_fixed` chips with `on_primary_fixed` text for technical specs (e.g., "240V", "Certified").

---

## 6. Do's and Don'ts

### Do:
- **Do** use generous whitespace (32px, 64px, 128px) to let technical information breathe.
- **Do** use "Optical Alignment." Because we use rectangular components, ensure icons and text are perfectly centered to maintain the "Precise" tone.
- **Do** utilize `surface_variant` for background regions where you want to "recess" secondary information (like a technical footer or sidebar).

### Don't:
- **Don't** use 100% black. Use `on_surface` (#191b23) for text to keep the UI feeling "premium" rather than "default."
- **Don't** use standard drop shadows with high opacity. They break the "Technical Blueprint" aesthetic.
- **Don't** use rounded "pill" buttons. Stick to the 4-6px rectangular constraint to maintain the industrial, reliable brand persona.
- **Don't** use high-contrast dividers. Let the background color shifts do the heavy lifting.

---
**Director's Note:** This system is not a kit of parts; it is a philosophy of light and space. Every pixel should feel like it was placed by a master electrician: intentional, grounded, and essential.**```