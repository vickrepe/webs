# Design System: The Neighborhood Living Room

## 1. Overview & Creative North Star
The Creative North Star for this system is **"The Neighborhood Living Room."** 

We are moving away from the "sterile corporate cafe" aesthetic toward an atmosphere that feels artisanal, lived-in, and deeply intentional. This system rejects the rigid, boxy constraints of traditional web grids in favor of a **High-End Editorial** layout. 

To achieve this, we utilize **Intentional Asymmetry** and **Tonal Depth**. Instead of lining elements up in a perfect, predictable row, we use overlapping layers—like a beautifully arranged coffee table book—to create a sense of human touch. This design system breaks the "template" look by prioritizing breathing room (whitespace) that carries a warm, cream-toned soul rather than a cold, clinical white.

---

## 2. Colors & Surface Philosophy
The palette is rooted in the rich, tactile world of roasted beans and steamed milk. We use a sophisticated hierarchy of warm neutrals to define structure without the need for harsh dividers.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders to define sections. Boundaries must be established through background color shifts or subtle tonal transitions. A `surface-container-low` section sitting on a `surface` background is the standard for separation.

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers—fine paper or artisanal cardstock. 
*   **Base Layer:** `surface` (#FFF8F1)
*   **Structural Depth:** Use `surface-container-lowest` through `surface-container-highest` to create "nested" importance. 
*   **Example:** A featured menu item should sit on a `surface-container-lowest` (#FFFFFF) card, placed over a `surface-container-low` (#F9F3EB) section. This creates a soft, natural lift.

### The "Glass & Gradient" Rule
To elevate the "professional" requirement, use **Glassmorphism** for floating elements (like navigation bars or modals). Apply a semi-transparent `surface` color with a `backdrop-blur` of 12px-20px. 

### Signature Textures
Main CTAs and Hero sections should utilize a subtle linear gradient transitioning from `primary` (#712C00) to `primary_container` (#92400E). This adds "visual soul" and mimics the oily, rich sheen of a fresh espresso roast.

---

## 3. Typography
The typography scale balances the approachable roundness of Nunito with the clean, professional legibility of Lato (implemented here via Plus Jakarta Sans and Be Vietnam Pro for a premium digital-first edge).

*   **Display (Plus Jakarta Sans):** Used for "Editorial Moments"—large, welcoming statements that set the mood.
*   **Headline (Plus Jakarta Sans):** Authoritative yet warm. Used to categorize the "Living Room" experience (e.g., "The Morning Roast," "The Evening Pour").
*   **Body (Be Vietnam Pro):** High legibility for menus and descriptions. The generous x-height ensures readability even in low-light bar environments.
*   **Labels (Be Vietnam Pro):** Small caps or tight tracking used for utility, maintaining a sense of artisanal craft.

---

## 4. Elevation & Depth
In this system, depth is a feeling, not a shadow.

*   **The Layering Principle:** Stacking surface tiers is the primary method of hierarchy. By placing a `surface-container-high` element inside a `surface` area, you create focal points without adding visual noise.
*   **Ambient Shadows:** If an element must float (like a floating action button or a modal), use an **extra-diffused shadow**. 
    *   *Spec:* `0px 12px 32px rgba(30, 27, 23, 0.06)`. 
    *   *Note:* Never use pure black; always tint shadows with the `on-surface` color.
*   **The "Ghost Border" Fallback:** If a container requires a boundary for accessibility, use the `outline-variant` token at **15% opacity**. This creates a "suggestion" of a container rather than a hard cage.
*   **Glassmorphism Depth:** Use backdrop blurs on `surface_variant` overlays to allow the warm background tones to bleed through, softening the interface and making it feel integrated into the "room."

---

## 5. Components

### Buttons (The 4px Signature)
All buttons follow a strict **4px radius** (`DEFAULT`).
*   **Primary:** A gradient of `primary` to `primary_container`. White text. High-contrast, authoritative.
*   **Secondary:** `secondary_container` background with `on_secondary_container` text. Warm and approachable.
*   **Tertiary:** No background. Text-only with a heavy weight. Use for low-priority actions like "Learn More."

### Cards & Lists
**Strict Rule:** No divider lines.
*   Separate list items (like coffee bean varieties) using vertical white space and `surface-container` shifts. 
*   Use `body-lg` for item names and `label-md` for prices to create a clear, editorial hierarchy.

### Input Fields
*   **Style:** Minimalist. Only a bottom border using `outline_variant` (20% opacity). 
*   **Focus State:** The bottom border transitions to `primary` (#712C00) with a subtle 2px thickness. 

### Signature Component: The "Ritual Card"
A custom component for El Tostado. An asymmetrical card featuring a high-quality image of a drink overlapping a `surface-container-highest` text block. This breaks the grid and emphasizes the "Artisanal" nature of the brand.

---

## 6. Do's and Don'ts

### Do:
*   **Do** use asymmetrical margins. If a text block is left-aligned, try right-aligning the supporting image to create a dynamic flow.
*   **Do** embrace "Active Whitespace." Let the `surface` color breathe; it is the "air" in the neighborhood living room.
*   **Do** use the `primary_fixed_dim` for subtle hover states on interactive cards.

### Don't:
*   **Don't** use 100% black text. Use `on_surface` (#1E1B17) for a softer, premium feel.
*   **Don't** use sharp 0px corners or overly round pill shapes. Stick to the **4px radius** to maintain the "Trustworthy/Professional" balance.
*   **Don't** use standard "Drop Shadows." If it looks like a default plugin, it’s wrong. It should look like ambient light.
*   **Don't** crowd the interface. If you feel the need to add a divider line, you probably need more whitespace instead.