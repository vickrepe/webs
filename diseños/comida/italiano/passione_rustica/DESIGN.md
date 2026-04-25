# Design System Document: The Artisanal Table

## 1. Overview & Creative North Star
### Creative North Star: "The Curated Heirloom"
This design system moves away from the sterile, "digital-first" look of modern SaaS platforms and instead embraces the "La Dolce Vita" spirit—a life lived with passion, warmth, and a touch of cinematic nostalgia. We are not building a website; we are setting a table. 

To achieve this, the system utilizes **Editorial Asymmetry**. Instead of a rigid, centered grid, we lean into intentional white space, overlapping imagery (like a linen napkin draped over a table edge), and high-contrast typography scales. The goal is to make the digital interface feel as tactile and storied as a hand-written menu in a Roman trattoria.

---

## 2. Colors: Tonal Passion
The palette is rooted in the rich, sun-drenched hues of Italy. We use a "warm-analogous" approach, where the "Italian Red" acts as the heartbeat of the system.

### Core Palette
- **Primary (#B70011):** The deep, aged red of a vintage Chianti. Use for high-impact brand moments.
- **Primary Container (#DC2626):** The vibrant, passionate red of a fresh San Marzano tomato. Use for primary CTAs.
- **Secondary (#5A632E):** The muted olive of a Tuscan grove. This provides the "Artisanal" counterweight to the red.
- **Background (#FFF8F1):** Antique White. This isn't just a color; it’s the canvas. It mimics the warmth of heavy cardstock or a sun-lit stone wall.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders for sectioning. 
Structure is created through **Background Color Shifts**. For instance, a menu category section should sit on `surface-container-low`, while the global background remains `surface`. The eye should perceive the change in depth through color, not lines.

### Glass & Gradient Rule
To add soul, use subtle gradients for Hero backgrounds, transitioning from `primary` to `primary-container` at a 45-degree angle. For floating navigation or "Daily Special" overlays, use **Glassmorphism**: 
- **Surface:** `surface` at 80% opacity.
- **Effect:** Backdrop-blur (12px to 20px). This softens the layout, making it feel integrated and "airy" rather than heavy.

---

## 3. Typography: The Editorial Voice
We pair the structured elegance of **Raleway** (Headings) with the approachable clarity of **Plus Jakarta Sans** (Body/Labels) to bridge the gap between tradition and modern usability.

- **Display (Raleway):** Used for large, evocative statements. The `display-lg` (3.5rem) should be used sparingly to create a "Hero" moment.
- **Headline (Raleway):** These are your "Chapter Titles." Use `headline-md` (1.75rem) to introduce menu sections.
- **Body (Plus Jakarta Sans):** Selected for its modern legibility, ensuring that even long ingredient lists are easy to scan.
- **Labels (Plus Jakarta Sans):** High-tracking (letter-spacing) labels in `label-sm` should be used for metadata like "Vegetarian" or "Gluten-Free," adding a refined, "boutique" touch.

---

## 4. Elevation & Depth: Tonal Layering
In this design system, depth is a physical property. We treat the UI as a series of stacked, fine papers.

- **The Layering Principle:** 
    - Level 0: `surface` (The Tablecloth)
    - Level 1: `surface-container-low` (The Place Setting)
    - Level 2: `surface-container-highest` (The Plate/Active Element)
- **Ambient Shadows:** Forget dark shadows. Use a "Sunlight Shadow": Blur 40px, Spread -10px, Color: `on-surface` at 6% opacity. It should look like a soft shadow cast by an afternoon sun.
- **The "Ghost Border":** If a separation is mandatory for accessibility, use the `outline-variant` token at **15% opacity**. It should be a whisper of a line, never a statement.

---

## 5. Components: Inviting & Handcrafted

### Buttons
- **Primary:** `primary-container` background with `on-primary` text. Use `lg` roundedness (0.5rem). 
- **Secondary:** Transparent background with a `Ghost Border` and `primary` text.
- **Interaction:** On hover, buttons should not just change color; they should "lift" slightly using a subtle `surface-container-high` shift.

### Cards & Menu Items
- **Rule:** **No Divider Lines.** 
- Separate menu items using `spacing-6` (vertical white space). To highlight a "Chef's Special," wrap the item in a `surface-container` box with `xl` (0.75rem) rounded corners.

### Input Fields
- **Style:** Underlined or "Minimalist Box." Use `surface-variant` for the fill and a `Ghost Border` for the bottom edge. When focused, the border transitions to `primary` (#B70011).

### Signature Component: The "Artisanal Chip"
- Used for food categories (Pasta, Antipasti). 
- **Style:** `secondary-container` background with `on-secondary-container` (Olive) text. Rounding: `full`. This creates a soft, organic feel that mimics an olive or a grape.

---

## 6. Do’s and Don’ts

### Do:
- **Use Intentional Asymmetry:** Offset images of food so they break the container edge.
- **Embrace the Background:** Let the Antique White (#FFF8F0) breathe. It is the "warmth" of the brand.
- **Use Tonal Shifts:** Create hierarchy by nesting `surface-container-high` inside `surface-container-low`.

### Don’t:
- **No Pure Black (#000000):** Use `on-background` (#1E1B17) for all text to maintain the soft, traditional feel.
- **No Hard Grids:** Avoid layouts that look like a spreadsheet. If you have four cards, consider making two larger and two smaller to create visual rhythm.
- **No Heavy Borders:** Never use a 100% opaque border. It breaks the "La Dolce Vita" flow.

---

## 7. Accessibility Note
While we prioritize aesthetics, the `primary` (#B70011) and `secondary` (#5A632E) colors have been selected to ensure a high contrast ratio against the `surface` (#FFF8F1) background, meeting WCAG AA standards for legibility. Always ensure `body-md` text is at least `on-surface` for maximum readability.