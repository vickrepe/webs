# Design System Strategy: The Modern Craftsman

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Digital Atelier."** We are not building a standard service app; we are crafting a digital extension of the barber’s chair—a space defined by tactile luxury, quiet confidence, and architectural precision. 

The system moves beyond the "template" aesthetic by embracing **Intentionally Rigid Asymmetry**. While most modern UIs rely on rounded corners and soft "friendliness," this system utilizes sharp 0px radii and heavy-weight typography to evoke the precision of a straight razor. We break the grid through overlapping editorial layouts, where large-scale display type bleeds behind high-resolution imagery of leather, wood, and steel.

## 2. Color & Atmospheric Tonalism
The palette is rooted in a "Deep-Dark" philosophy. We do not use "pure" black for everything; we use a tiered charcoal system to create a sense of environmental depth.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders to define sections. Boundaries must be established through color-blocking and background shifts. 
- Use `surface-container-low` (#1C1B1B) for secondary sections sitting on the `surface` (#131313) background.
- Use `surface-container-lowest` (#0E0E0E) for deep-set interactive areas to create a "recessed" feel.

### Surface Hierarchy & Nesting
Treat the UI as physical layers of premium materials:
- **Base Layer:** `surface` (#131313) - The primary floor.
- **Floating Glass:** Use `surface-bright` (#393939) with a 60% opacity and a 20px backdrop-blur for navigation bars and floating menus.
- **Signature Accents:** Use `primary_container` (#8B1A1A) for moments of high-impact brand authority.

### The "Glass & Gradient" Rule
To avoid a flat "Bootstrap" appearance, apply a subtle radial gradient to hero backgrounds, transitioning from `surface_container_highest` (#353534) at the center to `surface` (#131313) at the edges. This mimics the focused lighting of a barbershop mirror.

## 3. Typography: The Editorial Voice
The typography is designed to command the page, utilizing **Space Grotesk** for its mechanical, masculine precision and **Inter** for its neutral, high-utility clarity.

- **Display & Headlines (Space Grotesk):** These are your "Statement" pieces. Headlines should be tracked tight (-2% to -4%) to feel like a solid block of metal. Use `display-lg` for section headers that overlap images to create an editorial feel.
- **Body & Labels (Inter):** These provide the functional "Contract" with the user. Keep line heights generous (1.5x - 1.6x) to ensure the high-contrast white-on-black text remains legible and doesn't "vibrate" for the reader.
- **Tonal Hierarchy:** Primary information uses `on_surface` (#E5E2E1), while metadata or "whisper" text should use `outline` (#A78A87) to recede visually.

## 4. Elevation & Depth: Tonal Layering
In this system, elevation is not a shadow; it is a **Light Shift**.

- **The Layering Principle:** Instead of traditional shadows, elevate a card by moving it from `surface_container_low` to `surface_container_high`. The increase in "brightness" represents physical proximity to the light source.
- **Ambient Shadows:** Only use shadows for "Floating" elements (e.g., Modals). Shadows must be `surface_container_lowest` at 40% opacity, with a 40px - 60px blur. This creates an atmospheric glow rather than a harsh drop-shadow.
- **The "Ghost Border":** If a separation is required for accessibility, use the `outline_variant` (#58413F) at 15% opacity. It should be felt, not seen.
- **Glassmorphism:** Use `surface_variant` (#353534) at 70% opacity with a `backdrop-filter: blur(12px)`. This creates a "frosted steel" effect essential for the navigation and sticky headers.

## 5. Components
### Buttons (The "Sharp-Edge" Primitive)
- **Primary:** `primary` (#FFB3AC) text on `primary_container` (#8B1A1A) background. **Radius: 0px**. These should feel like a heavy brass or wood block.
- **Secondary:** `secondary` (#E9C349) outline (using the Ghost Border rule) with `on_surface` text.
- **States:** On hover, primary buttons should transition to `on_primary_container` (#FF9A91) to simulate light reflecting off a polished surface.

### Inputs & Fields
- **Styling:** Underline-only or fully enclosed in `surface_container_highest`. 
- **Focus State:** Transition the "Ghost Border" to `secondary` (#E9C349) at 100% opacity. No "glow" effects—just a sharp color change.

### Cards & Lists
- **Rule:** Forbid divider lines. 
- **Execution:** Separate list items using 16px of vertical whitespace or by alternating backgrounds between `surface_container_low` and `surface_container`.
- **Specialty Component: "The Service Slot":** A custom component for booking times. Use a rigid grid of `0px` boxes. Selected states use the `secondary` gold highlight to feel like a premium selection.

## 6. Do's and Don'ts

### Do
- **Do** use large amounts of "Macro-whitespace" (64px+) between sections to allow the dark tones to breathe.
- **Do** use high-quality photography with deep blacks and warm wood tones.
- **Do** ensure all CTAs have a minimum 4.5:1 contrast ratio against the deep backgrounds.
- **Do** align all text-heavy blocks to a rigid left-margin to maintain the "Urban/Modern" structure.

### Don't
- **Don't** use a 1px border to separate the Navbar from the Hero. Use a backdrop-blur or a tonal shift.
- **Don't** use any border-radius. Rounded corners dilute the "Straight-Razor" precision of the brand.
- **Don't** use generic icons. Use "Thin-Stroke" or "Duo-Tone" icons that match the `outline` (#A78A87) weight.
- **Don't** use pure #000000. It feels "dead" digitally. Use our `surface_container_lowest` (#0E0E0E) for the deepest blacks to maintain color depth.