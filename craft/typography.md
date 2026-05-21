# craft/typography.md
> Reglas universales de tipografía — aplican a TODO proyecto independientemente de la marca.

---

## Principios fundamentales

1. **Jerarquía siempre obvia** — el usuario sabe al instante qué es más importante
2. **Escala, no decoración** — la variedad tipográfica viene del tamaño y peso, no del color
3. **Espacio que respira** — line-height generoso (1.6–1.75) en body siempre
4. **Máximo 2 familias** — display/heading + body; el mono es opcional y técnico
5. **Variable fonts primero** — si la familia tiene variable font, usarla (mejor rendimiento)

---

## Selección de fuentes

### Combinaciones premium (Google Fonts, gratuitas)

| Display | Body | Personalidad |
|---|---|---|
| **Outfit** 800/900 | **Inter** 400/500/600 | Moderno, limpio, agencia |
| **Plus Jakarta Sans** | **DM Sans** | Amigable, startup |
| **Syne** | **Inter** | Bold, creativo, editorial |
| **Bricolage Grotesque** | **Inter** | Expresivo, humano |
| **Cabinet Grotesk** | **Satoshi** | Premium, tech |
| **Clash Display** | **General Sans** | Lujo, minimal |
| **Space Grotesk** | **DM Sans** | Tech, SaaS |
| **Fraunces** | **Nunito Sans** | Orgánico, confiable |

### Cargar siempre con preconnect

```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=[Display]:wght@700;800;900&family=[Body]:wght@400;500;600&display=swap" rel="stylesheet">
```

### font-display obligatorio

```css
/* En @font-face custom o asegurar que Google Fonts lo incluya vía display=swap */
@font-face {
  font-display: swap;
}
```

---

## Escala tipográfica — Sistema fluido

```css
:root {
  /* Display (hero) */
  --text-hero:    clamp(3rem, 6vw, 6.5rem);
  
  /* Headings */
  --text-h1:      clamp(2.2rem, 4.5vw, 4rem);
  --text-h2:      clamp(1.75rem, 3.2vw, 2.75rem);
  --text-h3:      clamp(1.25rem, 2vw, 1.75rem);
  --text-h4:      1.25rem;
  
  /* Body */
  --text-lead:    clamp(1.0625rem, 1.5vw, 1.25rem);
  --text-body:    1rem;
  --text-small:   0.875rem;
  
  /* UI */
  --text-label:   0.75rem;
  --text-caption: 0.6875rem;
}
```

### Aplicación base

```css
h1, h2, h3, h4, h5, h6 {
  font-family: var(--font-display);
  text-wrap: balance;               /* Siempre */
  letter-spacing: -0.02em;          /* Headings grandes necesitan tightening */
}

h1 { font-size: var(--text-h1); font-weight: 800; line-height: 1.05; }
h2 { font-size: var(--text-h2); font-weight: 700; line-height: 1.1;  }
h3 { font-size: var(--text-h3); font-weight: 600; line-height: 1.2;  }
h4 { font-size: var(--text-h4); font-weight: 600; line-height: 1.25; }

p, li {
  font-family: var(--font-body);
  font-size: var(--text-body);
  line-height: 1.65;
  color: var(--color-text);
  max-width: 68ch;                  /* Legibilidad óptima */
}

.lead {
  font-size: var(--text-lead);
  line-height: 1.6;
  color: var(--color-text-muted);
}
```

---

## Reglas críticas

### 1. ALL CAPS siempre con letter-spacing

```css
/* ❌ Nunca */
.label { text-transform: uppercase; }

/* ✅ Siempre */
.label {
  text-transform: uppercase;
  letter-spacing: 0.08em;    /* Mínimo. 0.1em para tamaños muy pequeños */
}
```

### 2. text-wrap: balance en headings

```css
/* ✅ En todos los h1–h4 y elementos de heading */
h1, h2, h3, h4, .heading { text-wrap: balance; }

/* Para párrafos largos de intro */
.hero-lead { text-wrap: pretty; }
```

### 3. Números grandes con tabular nums

```css
.stat-number {
  font-variant-numeric: tabular-nums;
  font-feature-settings: "tnum";
  font-weight: 800;
  letter-spacing: -0.03em;
}
```

### 4. Palabras de acento en headings

```html
<!-- Usando span inline (compatible con cualquier brand) -->
<h2>
  El diseño que convierte
  <span style="color: var(--color-accent);">en resultados reales</span>
</h2>
```

### 5. Máximo 68 caracteres por línea en body

```css
/* Para legibilidad óptima */
.prose p,
.content p {
  max-width: 68ch;
}

/* En secciones centradas */
.section-intro {
  max-width: 720px;
  margin: 0 auto;
  text-align: center;
}
```

### 6. Contraste mínimo obligatorio

| Contexto | Ratio mínimo | Standard |
|---|---|---|
| Texto normal | 4.5:1 | WCAG AA |
| Texto grande (>18px bold) | 3:1 | WCAG AA |
| Objetivo | 7:1 | WCAG AAA |

### 7. Responsive — nunca font-size fijo en headings

```css
/* ❌ Nunca */
h1 { font-size: 64px; }

/* ✅ Siempre fluid */
h1 { font-size: clamp(2.2rem, 4.5vw, 4rem); }
```

---

## Anti-patrones tipográficos

| ❌ Evitar | ✅ Alternativa |
|---|---|
| 3+ familias de fuente | Máximo 2 (display + body) |
| `font-size` fijo en headings | `clamp()` siempre |
| ALL CAPS sin `letter-spacing` | `letter-spacing: 0.08em` mínimo |
| Texto body con `line-height: 1.2` | `line-height: 1.6–1.75` |
| Justificado (`text-align: justify`) | Left-align siempre (o center para < 4 líneas) |
| Cursiva para párrafos largos | Solo para énfasis, citas, etiquetas |
| Colores de texto con < 4.5:1 | Verificar contraste siempre |
| `word-break: break-all` | `overflow-wrap: break-word` |
