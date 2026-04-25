# Design System Document: Caregiving & Human Connection

## 1. Overview & Creative North Star: "The Compassionate Sanctuary"
This design system rejects the clinical, cold aesthetic often found in caregiving platforms. Our Creative North Star is **"The Compassionate Sanctuary."** We aim to create a digital environment that feels like a warm, sunlit room—structured yet soft, professional yet deeply human.

To move beyond the "template" look, this system utilizes **Editorial Asymmetry**. We break the rigid 12-column grid by using generous white space and overlapping elements. Text is not just functional; it is a design element. By pairing the architectural strength of Raleway with the approachable softness of Nunito, we create a rhythmic, high-end editorial feel that signals both authority and empathy.

---

## 2. Colors: Tonal Depth & The "No-Line" Rule
Our palette is rooted in `primary` (#742fe5), a warm purple that balances the wisdom of blue with the energy of red.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders to define sections. Layout boundaries must be achieved through:
1.  **Background Shifts:** Transitioning from `surface` (#fef7fe) to `surface-container-low` (#f8f1fa).
2.  **Soft Volume:** Using `surface-container-highest` (#e7e0ec) to ground a sidebar against a lighter main content area.

### Surface Hierarchy & Nesting
Treat the UI as physical layers of fine paper.
*   **Base:** `surface` (#fef7fe)
*   **Structural Sections:** `surface-container-low` (#f8f1fa)
*   **Interactive Cards:** `surface-container-lowest` (#ffffff) sitting on top of `surface-container` to create a "lifted" appearance without heavy shadows.

### The "Glass & Gradient" Rule
To add "soul," use a subtle linear gradient for Hero sections or primary CTAs: `primary` (#742fe5) to `primary-container` (#8342f4) at a 135° angle. For floating navigation or over-image overlays, use Glassmorphism: `surface` at 70% opacity with a `24px` backdrop-blur.

---

## 3. Typography: Editorial Authority
We utilize a sophisticated scale to ensure the "Compassionate" tone is felt through legibility and hierarchy.

*   **Headings (Raleway):** Used for `display` and `headline` roles. Raleway’s elegant, slightly geometric curves provide a sense of premium reliability. Use `headline-lg` for impactful, human-centric statements.
*   **Body (Nunito):** Used for `title`, `body`, and `label` roles. Nunito’s rounded terminals make long-form information feel accessible and less intimidating for caregivers and families.

| Role | Token | Font | Size | Weight | Intent |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Display** | `display-lg` | Raleway | 3.5rem | 700 | Hero editorial moments |
| **Headline** | `headline-md` | Raleway | 1.75rem | 600 | Section entry points |
| **Title** | `title-lg` | Nunito | 1.375rem | 600 | Card titles, sub-headers |
| **Body** | `body-lg` | Nunito | 1rem | 400 | Standard reading text |
| **Label** | `label-md` | Nunito | 0.75rem | 700 | Small metadata, buttons |

---

## 4. Elevation & Depth: Tonal Layering
Traditional shadows are often too "tech-heavy" for a caregiving context. We use **Tonal Layering** to convey importance.

*   **The Layering Principle:** To highlight a profile card, place a `surface-container-lowest` (#ffffff) container inside a `surface-container-low` (#f8f1fa) wrapper. The contrast in "cleanliness" creates a natural focal point.
*   **Ambient Shadows:** If a floating element (like a FAB) is required, use a shadow with a 32px blur, 0px offset-y, and 6% opacity using the `on-surface` (#34313a) color. This mimics soft, diffused natural light.
*   **The "Ghost Border":** If a border is required for accessibility in forms, use `outline-variant` (#b6b0bb) at **15% opacity**. Never use a 100% opaque border.

---

## 5. Components: Soft Geometry
All components follow a strict **4px to 6px corner radius** (`DEFAULT` to `md` tokens). This provides a modern, "tailored" look that is softer than sharp corners but more professional than fully rounded bubbles.

### Buttons & Inputs
*   **Primary Button:** `primary` (#742fe5) background with `on-primary` (#fdf7ff) text. No border. Use a slight horizontal stretch in padding (12px vertical / 24px horizontal) to feel grounded.
*   **Input Fields:** Use `surface-container-highest` (#e7e0ec) as the fill. When focused, transition the background to `surface-container-lowest` (#ffffff) and add a 2px "Ghost Border" of `primary`.

### Cards & Lists
*   **The Divider Prohibition:** Forbid the use of horizontal lines between list items. Use **Vertical White Space** (24px - 32px) or alternating background tints (`surface` vs `surface-container-low`) to separate content.
*   **Caregiver Profiles:** Use asymmetrical layouts—place the photo slightly overlapping the top-left edge of the card container to break the "box-in-a-box" feel.

### Specialized Components
*   **The "Vibe" Tag:** Instead of standard chips, use small text in `primary` with a `primary-fixed-dim` (#7632e7) background at 10% opacity. No border.
*   **Progressive Disclosure Triggers:** Use `tertiary` (#7d516e) for secondary actions like "View Details" to keep the visual hierarchy calm and non-competitive with primary CTAs.

---

## 6. Do's and Don'ts

### Do
*   **Do** use intentional asymmetry. Offset images from their background containers by 16px.
*   **Do** use `primary-dim` (#681ad9) for hover states to create a "deepening" effect rather than a "brightening" one.
*   **Do** prioritize "Breathing Room." If a layout feels crowded, increase the `surface` padding before decreasing font size.

### Don't
*   **Don't** use black (#000000) for text. Use `on-surface` (#34313a) to maintain a soft, human touch.
*   **Don't** use standard "Drop Shadows" from UI kits. They feel "app-like" rather than "editorial."
*   **Don't** use pure white backgrounds for large sections. Use `surface` (#fef7fe) to reduce eye strain and feel "warmer."