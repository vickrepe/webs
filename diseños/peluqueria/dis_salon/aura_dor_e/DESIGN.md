# Design System Strategy: The High-End Editorial Salon

## 1. Overview & Creative North Star: "The Ethereal Atelier"
The Creative North Star for this design system is **"The Ethereal Atelier."** We are not building a website; we are curating a digital flagship store that mirrors the sensory experience of a high-end European salon. 

To achieve this, we move away from "Bootstrap-style" rigid grids. Our approach is rooted in **Intentional Asymmetry** and **Tonal Depth**. By utilizing overlapping elements—such as a serif headline partially bleeding over a soft-edged image—and extreme whitespace, we create a layout that feels "breathed into existence" rather than snapped to a grid. The goal is a "Quiet Luxury" aesthetic where the interface recedes to let the artistry of the salon take center stage.

---

## 2. Colors: Tonal Atmosphere
The palette is a sophisticated blend of warmth and light. We avoid "pure" blacks and clinical whites in favor of organic, creamy neutrals and metallic-inspired accents.

### The Color Tokens
- **Primary (`#735b28` / `#C8A96E`):** Used for "The Golden Touch." Reserve for high-intent CTAs or subtle accents.
- **Secondary (`#7b5455` / `#D4A5A5`):** The "Dusty Rose" soul of the brand. Use for softer interactions or romantic highlights.
- **Surface Tiers:**
    - `surface`: `#fcf9f4` (The base "Cream" canvas)
    - `surface-container-low`: `#f6f3ee` (For subtle content grouping)
    - `surface-container-highest`: `#e5e2dd` (For deeply recessed or high-contrast sections)

### The "No-Line" Rule
**Explicit Instruction:** 1px solid borders are strictly prohibited for sectioning or containment. Boundaries must be defined solely through background color shifts. A `surface-container-low` section sitting on a `surface` background provides all the definition a premium brand needs. Lines create "noise"; color shifts create "mood."

### Surface Hierarchy & Nesting
Treat the UI as physical layers of fine vellum paper. To emphasize a booking card, do not draw a box; place a `surface-container-lowest` (#ffffff) card on a `surface-container-low` (#f6f3ee) background. This creates a "lift" that feels organic and soft.

### Signature Textures & Glass
To avoid a flat, "template" look, use linear gradients (e.g., `primary` to `primary-container`) for hero backgrounds or buttons. Use **Glassmorphism** for navigation bars or floating action panels:
- `background`: `rgba(252, 249, 244, 0.8)`
- `backdrop-filter`: `blur(12px)`

---

## 3. Typography: Editorial Authority
The typography leverages a high-contrast scale to create an "Editorial" feel, mimicking a luxury fashion magazine.

- **Display & Headlines (Noto Serif):** These are your "Statement Pieces." The generous tracking and large scale (`display-lg` at 3.5rem) convey authority and elegance. Use `on-surface` (#1c1c19) for maximum legibility.
- **Body & Labels (Manrope):** The modern Sans-serif provides a clean, breathable counterpoint. High line-height (1.6+) is mandatory to maintain the "Airy" feel.
- **Title & Labeling:** Use `label-md` in all-caps with 0.1em letter-spacing for category tags or "Step 01" indicators to add a touch of technical precision to the organic layout.

---

## 4. Elevation & Depth: Tonal Layering
Traditional "material" shadows are too heavy for this system. We use **Ambient Light** principles.

- **The Layering Principle:** Depth is achieved by stacking surface tokens. A `surface-container-lowest` card on a `surface` background creates a natural, soft lift.
- **Ambient Shadows:** If a shadow is required for a floating "Book Now" button, it must be ultra-diffused: 
  - `box-shadow: 0 10px 40px rgba(115, 91, 40, 0.06)` (A tint of the primary color, never black).
- **The "Ghost Border" Fallback:** If a border is required for accessibility in input fields, use the `outline-variant` token at 20% opacity. It should feel like a suggestion, not a cage.

---

## 5. Components: The Atelier Library

### Buttons
- **Primary:** Gradient fill (`primary` to `primary-container`), white text, `xl` (0.75rem) roundedness. No border.
- **Secondary:** `surface-container-lowest` background with a `primary` label. 
- **Interaction:** On hover, a subtle 2px lift via ambient shadow—never a color change that is too jarring.

### Cards & Lists
- **The "No-Divider" Rule:** Lists and card groups must never use horizontal lines. Use vertical whitespace (refer to the `32px` or `48px` spacing tokens) to separate items.
- **Cards:** Use `surface-container-low` for the card body. Images inside cards should have a `md` (0.375rem) corner radius to feel "tailored."

### Input Fields
- Floating labels using `notoSerif` for the label itself to make the form feel like a "Personal Consultation" rather than a data entry task.
- Background: `surface-container-lowest`. 
- Border: `Ghost Border` (outline-variant at 20%).

### Interactive Chips
- Pill-shaped (`full` roundedness). 
- State: Selected chips should use a `secondary-container` background with `on-secondary-container` text.

---

## 6. Do’s and Don’ts

### Do:
- **Do** use intentional white space. If you think there is enough space, add 16px more.
- **Do** overlap elements. Let a high-resolution image of a salon interior tuck slightly under a text container.
- **Do** use "Soft Entry" transitions. All hover states and page loads should have a `300ms` cubic-bezier ease-in-out.

### Don’t:
- **Don’t** use pure black (#000000). It breaks the warm minimalism. Use `on-surface` (#1c1c19).
- **Don’t** use hard corners. Even "square" elements should have the `DEFAULT` (0.25rem) radius to soften the visual impact.
- **Don’t** use iconography from generic libraries without customizing the stroke weight. Icons should be "Light" or "Thin" (1px - 1.5px stroke) to match the Manrope body text weight.