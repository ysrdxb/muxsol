# Muxsol.com - Frontend Design System

> A sophisticated, modern design system inspired by leading tech companies like Anthropic (Claude), Linear, Stripe, and Vercel.

---

## Design Philosophy

### Core Principles

1. **Clarity Over Complexity**
   - Every element should serve a purpose
   - Remove visual clutter and unnecessary decoration
   - Let content breathe with generous whitespace

2. **Subtle Sophistication**
   - Refined color palette with muted tones
   - Soft shadows and gentle gradients
   - Micro-interactions that feel natural

3. **Professional Trust**
   - Clean typography that conveys authority
   - Consistent visual language throughout
   - Accessibility as a first-class citizen

4. **Performance First**
   - Lightweight animations (CSS-based)
   - Optimized assets
   - Fast load times

---

## Color System

### Primary Palette

```css
/* Neutral - The Foundation */
--gray-50:  #FAFAFA;   /* Background, cards */
--gray-100: #F4F4F5;   /* Subtle backgrounds */
--gray-200: #E4E4E7;   /* Borders, dividers */
--gray-300: #D4D4D8;   /* Disabled states */
--gray-400: #A1A1AA;   /* Placeholder text */
--gray-500: #71717A;   /* Secondary text */
--gray-600: #52525B;   /* Body text */
--gray-700: #3F3F46;   /* Headings */
--gray-800: #27272A;   /* Primary text */
--gray-900: #18181B;   /* High contrast text */
--gray-950: #09090B;   /* Maximum contrast */

/* Brand Colors */
--brand-50:  #EEF2FF;
--brand-100: #E0E7FF;
--brand-500: #6366F1;  /* Primary brand */
--brand-600: #4F46E5;  /* Primary hover */
--brand-700: #4338CA;  /* Primary active */

/* Semantic Colors */
--success: #10B981;
--warning: #F59E0B;
--error:   #EF4444;
--info:    #3B82F6;
```

### Color Usage Guidelines

| Element | Color | Usage |
|---------|-------|-------|
| Page Background | `gray-50` or `white` | Primary backgrounds |
| Card Background | `white` | Cards, modals, dropdowns |
| Primary Text | `gray-900` | Headings, important text |
| Secondary Text | `gray-600` | Body copy, descriptions |
| Muted Text | `gray-500` | Captions, timestamps |
| Borders | `gray-200` | Dividers, card borders |
| Primary Actions | `brand-500` | CTAs, links, highlights |

---

## Typography

### Font Stack

```css
/* Primary Font - Inter or similar clean sans-serif */
--font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;

/* Monospace - For code and technical content */
--font-mono: 'JetBrains Mono', 'Fira Code', 'Consolas', monospace;
```

### Type Scale

| Name | Size | Weight | Line Height | Usage |
|------|------|--------|-------------|-------|
| Display | 72px / 4.5rem | 700 | 1.1 | Hero headlines |
| H1 | 48px / 3rem | 700 | 1.2 | Page titles |
| H2 | 36px / 2.25rem | 600 | 1.25 | Section titles |
| H3 | 24px / 1.5rem | 600 | 1.3 | Subsections |
| H4 | 20px / 1.25rem | 600 | 1.4 | Card titles |
| Body Large | 18px / 1.125rem | 400 | 1.6 | Lead paragraphs |
| Body | 16px / 1rem | 400 | 1.6 | Default text |
| Small | 14px / 0.875rem | 400 | 1.5 | Captions, labels |
| XSmall | 12px / 0.75rem | 500 | 1.4 | Badges, tags |

### Typography Guidelines

- **Headlines**: Bold, confident, minimal. Use sentence case.
- **Body**: Readable, comfortable line length (65-75 characters).
- **Links**: Underline on hover, not by default. Use brand color.
- **Letter Spacing**: Slightly tighter for large text (-0.02em), normal for body.

---

## Spacing System

Based on 4px grid with common multipliers:

```css
--space-1:  4px;    /* 0.25rem */
--space-2:  8px;    /* 0.5rem */
--space-3:  12px;   /* 0.75rem */
--space-4:  16px;   /* 1rem */
--space-5:  20px;   /* 1.25rem */
--space-6:  24px;   /* 1.5rem */
--space-8:  32px;   /* 2rem */
--space-10: 40px;   /* 2.5rem */
--space-12: 48px;   /* 3rem */
--space-16: 64px;   /* 4rem */
--space-20: 80px;   /* 5rem */
--space-24: 96px;   /* 6rem */
--space-32: 128px;  /* 8rem */
```

### Section Spacing

| Section Type | Padding (Y-axis) | Usage |
|--------------|------------------|-------|
| Hero | 120-160px | First section, maximum impact |
| Standard | 80-96px | Regular content sections |
| Compact | 48-64px | Dense information areas |
| CTA | 64-80px | Call-to-action strips |

---

## Layout System

### Container Widths

```css
--container-sm:  640px;   /* Narrow content */
--container-md:  768px;   /* Article width */
--container-lg:  1024px;  /* Standard content */
--container-xl:  1280px;  /* Wide layouts */
--container-2xl: 1440px;  /* Maximum width */
```

### Grid System

- 12-column grid for complex layouts
- CSS Grid preferred over Flexbox for page structure
- Flexbox for component-level alignment

### Responsive Breakpoints

```css
/* Mobile First */
sm:  640px   /* Small tablets */
md:  768px   /* Tablets */
lg:  1024px  /* Small desktops */
xl:  1280px  /* Desktops */
2xl: 1536px  /* Large screens */
```

---

## Components

### Buttons

#### Primary Button
```html
<button class="btn-primary">
  Get Started
</button>
```
- Background: `brand-500`
- Text: White
- Padding: 12px 24px
- Border Radius: 8px (or full for pill style)
- Hover: Darken 10%, subtle lift
- Active: Darken 15%, no lift

#### Secondary Button
```html
<button class="btn-secondary">
  Learn More
</button>
```
- Background: Transparent
- Border: 1px `gray-200`
- Text: `gray-700`
- Hover: Background `gray-50`

#### Ghost Button
```html
<button class="btn-ghost">
  View Details
</button>
```
- Background: Transparent
- Text: `brand-500`
- Hover: Background `brand-50`

### Cards

```css
.card {
  background: white;
  border-radius: 12px;
  border: 1px solid var(--gray-200);
  padding: 24px;
  transition: all 0.2s ease;
}

.card:hover {
  border-color: var(--gray-300);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
```

### Badges / Tags

```css
.badge {
  display: inline-flex;
  align-items: center;
  padding: 4px 12px;
  font-size: 12px;
  font-weight: 500;
  border-radius: 9999px;
  background: var(--brand-50);
  color: var(--brand-600);
}
```

---

## Shadows & Depth

### Shadow Scale

```css
/* Subtle - Cards at rest */
--shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);

/* Default - Elevated elements */
--shadow: 0 1px 3px rgba(0, 0, 0, 0.06),
          0 1px 2px rgba(0, 0, 0, 0.04);

/* Medium - Dropdowns, popovers */
--shadow-md: 0 4px 6px rgba(0, 0, 0, 0.05),
             0 2px 4px rgba(0, 0, 0, 0.03);

/* Large - Modals, dialogs */
--shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.05),
             0 4px 6px rgba(0, 0, 0, 0.03);

/* XL - Maximum elevation */
--shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.08),
             0 10px 10px rgba(0, 0, 0, 0.04);
```

### Elevation Guidelines

| Level | Shadow | Use Case |
|-------|--------|----------|
| 0 | None | Flat elements, dividers |
| 1 | `shadow-sm` | Cards, wells |
| 2 | `shadow` | Elevated cards, hover states |
| 3 | `shadow-md` | Dropdowns, tooltips |
| 4 | `shadow-lg` | Modals, dialogs |
| 5 | `shadow-xl` | Full-screen overlays |

---

## Animation & Motion

### Timing Functions

```css
/* Smooth, professional easing */
--ease-out: cubic-bezier(0.16, 1, 0.3, 1);
--ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);

/* Spring-like bounce */
--ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
```

### Duration Scale

```css
--duration-fast:   100ms;  /* Micro-interactions */
--duration-normal: 200ms;  /* Standard transitions */
--duration-slow:   300ms;  /* Complex animations */
--duration-slower: 500ms;  /* Page transitions */
```

### Animation Guidelines

1. **Be Subtle**: Animations should enhance, not distract
2. **Be Purposeful**: Every animation should communicate something
3. **Be Fast**: Users shouldn't wait for animations
4. **Be Consistent**: Same actions = same animations

### Common Animations

```css
/* Fade In Up - For content reveals */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Scale In - For modals, popovers */
@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scale(0.95);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

/* Pulse - For loading states */
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}
```

---

## Section Templates

### Hero Section

**Key Elements:**
- Large, bold headline (Display size)
- Concise subheadline (Body Large, muted)
- Primary CTA button + optional secondary
- Subtle background treatment (gradient orbs, patterns)
- Optional badge/tag above headline

**Layout:**
- Centered or left-aligned
- Maximum content width: 800px
- Generous vertical padding (120-160px)

### Features Section

**Presentation Options:**
1. **Grid Layout**: 2x2 or 3x3 feature cards
2. **Alternating**: Image left/right with text
3. **Bento Grid**: Mixed-size cards

**Feature Card Anatomy:**
- Icon (40-48px, brand color background)
- Title (H4)
- Description (Body, muted)
- Optional link

### Testimonials

**Styles:**
1. **Cards**: Quote cards with avatar, name, role
2. **Carousel**: Single featured testimonial
3. **Wall**: Multiple small testimonials

**Quote Card:**
- Large quote marks (decorative)
- Testimonial text (Body Large, italic optional)
- Avatar (48px, rounded)
- Name (Body, bold)
- Role/Company (Small, muted)

### Pricing

**Best Practices:**
- Highlight recommended plan
- Clear feature comparison
- Annual/Monthly toggle
- Clear CTAs

**Pricing Card:**
- Plan name (H4)
- Price (Display, brand color for featured)
- Billing period (Small, muted)
- Feature list (checkmarks)
- CTA button

### CTA Section

**Effective Patterns:**
- Clear value proposition
- Single, focused action
- Contrasting background (dark or brand)
- Social proof element

---

## Header Design

### Anatomy

```
┌─────────────────────────────────────────────────────────────┐
│  [Logo]        [Nav Links...]              [CTA Button]     │
└─────────────────────────────────────────────────────────────┘
```

**Specifications:**
- Height: 64-72px
- Background: White with subtle bottom border
- Sticky on scroll (optional blur effect)
- Logo: Max height 32-40px

**Navigation:**
- Font: 14-15px, medium weight
- Color: Gray-600, hover Gray-900
- Active: Brand color
- Spacing: 32px between items

**Mobile:**
- Hamburger menu (right aligned)
- Full-screen or slide-in drawer

---

## Footer Design

### Structure

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│  [Logo + Description]    [Links Col 1]  [Col 2]  [Col 3]   │
│                                                             │
│  [Newsletter Signup (optional)]                             │
│                                                             │
├─────────────────────────────────────────────────────────────┤
│  [Copyright]                    [Social Links] [Legal]      │
└─────────────────────────────────────────────────────────────┘
```

**Specifications:**
- Background: Gray-900 or Gray-50
- Padding: 64-80px top, 32px bottom
- Link columns: 4-6 items each
- Social icons: 20-24px

---

## Imagery Guidelines

### Photography

- **Style**: Authentic, candid, diverse
- **Treatment**: Subtle desaturation, consistent tone
- **Aspect Ratios**: 16:9 (hero), 4:3 (cards), 1:1 (avatars)

### Illustrations

- **Style**: Minimal, geometric, brand colors
- **Use**: Empty states, features, onboarding
- **Size**: Appropriate to context, not overwhelming

### Icons

- **Style**: Outline or subtle fill, consistent weight
- **Size**: 20-24px for UI, 40-48px for features
- **Source**: Heroicons, Lucide, or custom

---

## Accessibility

### Color Contrast

- Normal text: Minimum 4.5:1 ratio
- Large text: Minimum 3:1 ratio
- UI components: Minimum 3:1 ratio

### Focus States

```css
:focus-visible {
  outline: 2px solid var(--brand-500);
  outline-offset: 2px;
}
```

### Interactive Elements

- Minimum tap target: 44x44px
- Clear hover/active states
- Keyboard navigable

---

## Implementation Checklist

### New Page Checklist

- [ ] Consistent header/footer
- [ ] Proper heading hierarchy (H1 → H2 → H3)
- [ ] Responsive at all breakpoints
- [ ] Fast load time (<3s)
- [ ] Working links and CTAs
- [ ] Meta tags and OG images
- [ ] Accessibility audit passed

### Component Checklist

- [ ] Hover states defined
- [ ] Focus states defined
- [ ] Loading states (if applicable)
- [ ] Error states (if applicable)
- [ ] Mobile responsive
- [ ] Animation is subtle and purposeful

---

## Code Patterns

### CSS Class Naming

Use utility-first with Tailwind, supplemented by semantic classes:

```html
<!-- Utility-first for layout -->
<div class="flex items-center gap-4 p-6">

<!-- Semantic for components -->
<button class="btn btn-primary">
```

### Component Structure

```html
<!-- Section Template -->
<section class="section-padding">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Title</h2>
      <p class="section-description">Description</p>
    </div>
    <div class="section-content">
      <!-- Content here -->
    </div>
  </div>
</section>
```

---

## Quick Reference

### Spacing Tokens
`4 8 12 16 20 24 32 40 48 64 80 96 128`

### Border Radius
`4px (sm) | 8px (md) | 12px (lg) | 16px (xl) | 9999px (full)`

### Font Weights
`400 (regular) | 500 (medium) | 600 (semibold) | 700 (bold)`

### Z-Index Scale
`10 (dropdown) | 20 (sticky) | 30 (overlay) | 40 (modal) | 50 (toast)`

---

*Last Updated: 2026-01-17*
