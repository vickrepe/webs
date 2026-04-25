# Design System Document: The Urban Curator

## 1. Overview & Creative North Star
**Creative North Star: "Dynamic Proximity"**
This design system moves away from the rigid, sterile grids of traditional e-commerce. Instead, it embraces a "Dynamic Proximity" philosophy—capturing the raw, kinetic energy of urban life while maintaining a premium, editorial feel. We are not just building a shop; we are creating a digital "hangout" that feels close, tactile, and intentionally unpolished yet sophisticated.

To break the "template" look, designers must lean into **intentional asymmetry**. Hero images should bleed off-edge, and typography should overlap container boundaries. We avoid the "boxed-in" feeling by using expansive white space and light gray transitions to create a layout that feels like a high-end streetwear lookbook rather than a database.

---

## 2. Colors & Surface Philosophy
The palette is centered around a high-energy primary amber, supported by a sophisticated range of architectural grays.

### The "No-Line" Rule
**Strict Mandate:** Traditional 1px solid borders are prohibited for sectioning. We define space through "Tonal Shifts."
- Use `surface` (#f6f6f6) for the main body.
- Use `surface_container_low` (#f0f1f1) for secondary content blocks.
- Use `surface_container_highest` (#dbdddd) for deep-set interactive areas.
Boundaries are felt through these subtle shifts in value, not drawn with lines.

### Surface Hierarchy & Nesting
Treat the UI as physical layers of urban materials.
1.  **Base Layer:** `background` (#f6f6f6) – The street level.
2.  **The Canvas:** `surface_container_lowest` (#ffffff) – Use this for primary product cards to make them "pop" against the gray background.
3.  **The Detail:** `surface_container_high` (#e1e3e3) – Use for utility bars or secondary navigation.

### The "Glass & Gradient" Rule
To elevate the primary `#F59E0B` (mapped to `primary_fixed`), avoid flat applications on large surfaces.
- **Signature Gradient:** For Hero CTAs, use a linear gradient from `primary` (#815100) to `primary_container` (#f8a010) at a 135-degree angle. This adds a "metallic" urban sheen.
- **Urban Glass:** Use `surface_container_lowest` at 70% opacity with a `20px` backdrop-blur for floating navigation headers or quick-buy overlays.

---

## 3. Typography: The Editorial Voice
We contrast the friendly, rounded nature of Nunito (customized as `plusJakartaSans` in our tokens) with the functional clarity of Open Sans (mapped to `beVietnamPro`).

*   **Display & Headlines (`plusJakartaSans`):** These are your "vibe" setters. Use `display-lg` for hero statements. Apply a slight negative letter-spacing (-0.02em) to make the rounded forms feel tighter and more premium.
*   **Body & Labels (`beVietnamPro`):** These are your workhorses. `body-md` is the standard for product descriptions. The high x-height ensures readability against complex urban photography.
*   **The Power Scale:** Always pair a `display-md` headline with a much smaller `label-md` uppercase sub-header. This extreme contrast in scale is what creates the "high-end editorial" look.

---

## 4. Elevation & Depth
Depth is achieved through **Tonal Layering**, mimicking the way shadows fall in a city alleyway—diffused and atmospheric.

*   **The Layering Principle:** Instead of shadows, place a `surface_container_lowest` card on a `surface_dim` background. The color difference provides all the "lift" required.
*   **Ambient Shadows:** For floating elements (Modals, Hovered Cards), use: `box-shadow: 0 20px 40px rgba(45, 47, 47, 0.06);`. The shadow color must be derived from `on_surface`, never pure black.
*   **The "Ghost Border" Fallback:** If a container absolutely requires a boundary (e.g., a white card on a white background), use `outline_variant` (#acadad) at **15% opacity**. It should be a whisper, not a statement.
*   **Motion:** Transitions must be `300ms cubic-bezier(0.4, 0, 0.2, 1)`. Hover states should involve a subtle vertical lift (2px) and a slight increase in shadow diffusion.

---

## 5. Components

### Buttons (The 6px Standard)
All buttons use the **6px (0.375rem)** rounding (`md` scale).
*   **Primary:** Background: `primary_fixed` (#f8a010); Text: `on_primary_fixed` (#2a1700). On hover, transition to `primary_fixed_dim`.
*   **Secondary:** Background: `surface_container_highest`; Text: `on_surface`.
*   **Tertiary:** No background. Text: `primary`. Use a 2px underline that expands on hover.

### Cards & Product Grids
*   **Rules:** Forbid dividers. Use `24px` to `32px` of vertical white space to separate items.
*   **Image Treatment:** Images should have the same 6px corner radius. Suggest using "Product-on-Model" shots with the background removed, placed on `surface_container_low` for a high-fashion look.

### Input Fields
*   **Style:** Minimalist. No bottom line or full box. Use a subtle `surface_container_low` fill with 6px rounding.
*   **Focus State:** The background shifts to `surface_container_lowest` and a 2px "Ghost Border" appears using `primary`.

### Navigation Chips
*   Used for sizing (S, M, L, XL).
*   **Unselected:** `surface_container_high` with `on_surface_variant` text.
*   **Selected:** `primary` with `on_primary` text.

---

## 6. Do's and Don'ts

### Do:
*   **Do** use asymmetrical margins. If the left margin is 80px, try a right margin of 40px for editorial sections.
*   **Do** overlap elements. Let a product image partially cover a `headline-lg` text block.
*   **Do** use "Optical Centering." Because Nunito is rounded, it may look physically lower than it is. Adjust vertically by 1-2px in buttons.

### Don't:
*   **Don't** use 1px solid black or dark gray borders. It kills the "Urban" flow and makes the site look like a legacy bootstrap template.
*   **Don't** use standard "Drop Shadows." If the shadow is visible enough to be identified as a "shadow," it’s too dark.
*   **Don't** use dividers (`<hr>`). If you need to separate content, use a `1px` height `surface_container_highest` block that only spans 60% of the container width, centered.

### Accessibility Note:
While we lean into light grays, ensure that all functional text (Body and Labels) uses `on_surface` (#2d2f2f) to maintain a high contrast ratio against `surface` (#f6f6f6). The `primary` yellow should only be used for interactive elements or accents, never for long-form body text.