# [Brand Name] — Design System
> Generado por WebGen · Fase 1 output  
> Estado: BORRADOR — pendiente aprobación del cliente  
> Fecha: [YYYY-MM-DD]

---

## 1. Visual Theme & Atmosphere

**Mood general:**  
[Describe el feeling en 2–3 líneas. Ej: "Preciso, confiado, un poco oscuro. Como una herramienta de precisión que también sabe dónde va. Inspira confianza sin sonar corporativo."]

**Referencias de diseño inspiradoras:**

| Empresa | Qué tomamos de su diseño |
|---|---|
| [Referencia 1] | [Ej: "Su uso del espacio negativo y tipografía grande"] |
| [Referencia 2] | [Ej: "El contraste dark + acento eléctrico"] |
| [Referencia 3] | [Ej: "La claridad del layout en móvil"] |

**Palabras clave visuales:**  
[5 adjetivos que definen la identidad visual. Ej: "moderno, claro, confiable, ágil, humano"]

**Atmósfera de sección:**
- Hero: [Ej: "oscuro con acento cálido — impacta y genera confianza"]
- Secciones internas: [Ej: "alterna blanco y gris muy suave — respira, no satura"]
- CTA final: [Ej: "fondo de acento — convierte con urgencia suave"]

---

## 2. Color Palette & Roles

```css
:root {
  /* Fondos */
  --color-bg:         [#valor];   /* Fondo principal */
  --color-bg-subtle:  [#valor];   /* Secciones alternativas */
  --color-bg-dark:    [#valor];   /* Hero oscuro, CTAs dark */

  /* Superficies */
  --color-surface:    [#valor];   /* Cards, paneles */
  --color-surface-2:  [#valor];   /* Hover, estado activo */

  /* Texto */
  --color-text:       [#valor];   /* Texto principal (7:1 sobre --color-bg) */
  --color-text-muted: [#valor];   /* Texto secundario, labels */
  --color-text-on-dark: [#valor]; /* Texto sobre fondos oscuros */

  /* Acento de marca */
  --color-accent:     [#valor];   /* Acento principal — CTAs, highlights */
  --color-accent-2:   [#valor];   /* Acento secundario (usar con moderación) */

  /* Bordes */
  --color-border:     [#valor];   /* Bordes, separadores */
  --color-border-strong: [#valor]; /* Bordes con más énfasis */
}
```

**Swatches visuales:**

| Token | Valor | Uso principal | Frecuencia |
|---|---|---|---|
| `--color-bg` | `[#valor]` | Fondo de página | Base |
| `--color-bg-subtle` | `[#valor]` | Secciones alternadas | ~50% |
| `--color-surface` | `[#valor]` | Cards y paneles | Componentes |
| `--color-text` | `[#valor]` | Texto corriente | Mayoría |
| `--color-text-muted` | `[#valor]` | Labels, meta info | ~30% del texto |
| `--color-accent` | `[#valor]` | **MARCA** — CTAs, highlights | Máx 2x/pantalla |
| `--color-accent-2` | `[#valor]` | Acento secundario | Solo cuando refuerza |
| `--color-border` | `[#valor]` | Todos los bordes | Consistente |

**Reglas de uso del color:**
1. `--color-accent` aparece máximo **2 veces por pantalla**
2. Nunca usar colores absolutos fuera de los tokens
3. `--color-text` cumple WCAG AA (4.5:1) sobre `--color-bg-subtle` también
4. [Regla específica de esta marca]

---

## 3. Typography Rules

```css
:root {
  --font-display: '[Display Font]', sans-serif;  /* Headings, hero, números grandes */
  --font-body:    '[Body Font]', sans-serif;      /* Texto corriente, UI */
  --font-mono:    '[Mono Font]', monospace;       /* Código, datos técnicos (opcional) */
}
```

**Fuentes seleccionadas:**

| Rol | Familia | Pesos | Razón |
|---|---|---|---|
| Display | [Fuente] | 700, 800, 900 | [Por qué encaja con la marca] |
| Body | [Fuente] | 400, 500, 600 | [Por qué encaja] |

**Escala tipográfica:**

| Rol | `font-size` | `font-weight` | `line-height` | Uso |
|---|---|---|---|---|
| Hero | `clamp(3rem, 6vw, 6.5rem)` | 900 | 0.95 | H1 en hero |
| H1 | `clamp(2.2rem, 4.5vw, 4rem)` | 800 | 1.05 | Heading de página |
| H2 | `clamp(1.8rem, 3.2vw, 2.8rem)` | 700 | 1.1 | Secciones |
| H3 | `clamp(1.3rem, 2vw, 1.8rem)` | 600 | 1.2 | Subsecciones |
| H4 | `1.25rem` | 600 | 1.3 | Cards, aside |
| Body L | `1.125rem` | 400 | 1.7 | Leads, intros |
| Body | `1rem` | 400 | 1.65 | Texto corriente |
| Small | `0.875rem` | 500 | 1.5 | Meta, helpers |
| Label | `0.75rem` | 600 | 1.4 | UI labels, badges |
| Caption | `0.6875rem` | 500 | 1.4 | Pies de foto, legal |

**Reglas tipográficas:**
- `text-wrap: balance` en **todos** los `<h1>–<h4>`
- ALL CAPS labels siempre con `letter-spacing: 0.08em` mínimo
- Números de stat: `font-variant-numeric: tabular-nums`
- Palabras clave en headings: usar `<span style="color: var(--color-accent)">` o `--color-accent-2`
- Máximo 70–75 chars por línea en body (`max-width: 65ch`)
- `font-display: swap` en el `@font-face`

---

## 4. Component Stylings

### Buttons

```css
/* Primary — acción principal */
.btn-primary {
  background: var(--color-accent);
  color: var(--color-bg);           /* texto oscuro sobre acento claro */
  padding: 14px 28px;
  border-radius: [valor];
  font-weight: 600;
  font-size: 0.9375rem;
  border: 2px solid transparent;
  transition: opacity 150ms ease, transform 150ms ease;
}
.btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }

/* Secondary */
.btn-secondary {
  background: var(--color-surface);
  color: var(--color-text);
  border: 1px solid var(--color-border);
}

/* Outline */
.btn-outline {
  background: transparent;
  color: var(--color-accent);
  border: 2px solid var(--color-accent);
}

/* Ghost */
.btn-ghost {
  background: transparent;
  color: var(--color-text-muted);
  border: none;
}
```

**Tamaños de botón:**  
`sm` — 10px 20px | `md` — 14px 28px | `lg` — 18px 36px

### Cards

```css
.card {
  background: var(--color-surface);
  border: 1px solid var(--color-border);
  border-radius: [valor];
  padding: [valor];
  transition: border-color 200ms ease, box-shadow 200ms ease;
}
.card:hover {
  border-color: var(--color-accent);
  box-shadow: 0 8px 32px rgba(0,0,0,0.08);
}

.card--dark {
  background: var(--color-bg-dark);
  color: var(--color-text-on-dark);
  border-color: rgba(255,255,255,0.1);
}
```

### Kicker / Eyebrow badge

```css
.kicker {
  display: inline-flex;
  padding: 5px 12px;
  border-radius: 999px;
  background: rgba(var(--color-accent-rgb), 0.12);
  border: 1px solid rgba(var(--color-accent-rgb), 0.3);
  font-size: 0.75rem;
  font-weight: 700;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--color-accent);
  font-family: var(--font-display);
  margin-bottom: 16px;
}
```

### Form inputs

```css
.input {
  padding: 12px 16px;
  border: 1px solid var(--color-border);
  border-radius: [valor];
  background: var(--color-surface);
  color: var(--color-text);
  font-size: 1rem;
  transition: border-color 150ms ease, box-shadow 150ms ease;
}
.input:focus {
  outline: none;
  border-color: var(--color-accent);
  box-shadow: 0 0 0 3px rgba(var(--color-accent-rgb), 0.2);
}
```

### Border radius

| Token | Valor | Uso |
|---|---|---|
| `--radius-sm` | [valor] | Badges, tags |
| `--radius-md` | [valor] | Inputs, botones |
| `--radius-lg` | [valor] | Cards |
| `--radius-xl` | [valor] | Paneles grandes, hero |
| `--radius-pill` | `999px` | Chips, kickers |

---

## 5. Layout Principles

```css
/* Container */
.container { width: min(1280px, 92vw); margin: 0 auto; }

/* Section */
.section { padding: clamp(64px, 8vw, 120px) 0; }

/* Grids */
.grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 32px; }
.grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
.grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
```

**Estructura de secciones:**

| Sección | Layout | Fondo |
|---|---|---|
| Hero | Full-width, grid 2 col (texto + visual) | `--color-bg-dark` |
| Features | Grid 3 col | `--color-bg-subtle` |
| Cómo funciona | Numerado, centrado | `--color-bg` |
| Testimonials | Grid 3 o slider | `--color-bg` |
| CTA | Centrado, ancho completo | `--color-accent` o `--color-bg-dark` |
| Footer | Grid 4 col | `--color-bg-dark` |

**Spacing scale:**

| Token | Valor |
|---|---|
| `--space-1` | 4px |
| `--space-2` | 8px |
| `--space-3` | 12px |
| `--space-4` | 16px |
| `--space-6` | 24px |
| `--space-8` | 32px |
| `--space-10` | 40px |
| `--space-12` | 48px |
| `--space-16` | 64px |
| `--space-20` | 80px |
| `--space-24` | 96px |

---

## 6. Depth & Elevation

| Nivel | Uso | `box-shadow` |
|---|---|---|
| 0 — Flat | Fondo, secciones | `none` |
| 1 — Subtle | Cards en reposo | `0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.04)` |
| 2 — Raised | Cards en hover, dropdowns | `0 4px 16px rgba(0,0,0,0.10), 0 2px 4px rgba(0,0,0,0.06)` |
| 3 — Floating | Modals, tooltips | `0 16px 48px rgba(0,0,0,0.14), 0 4px 8px rgba(0,0,0,0.08)` |
| 4 — Hero | Paneles destacados del hero | `0 32px 80px rgba(0,0,0,0.20)` |

**Reglas de elevación:**
- No mezclar sombras en fondos oscuros — usar `border: 1px solid rgba(255,255,255,0.1)` 
- Sombras de color (glow): solo con `--color-accent`, en estados hover especiales
- `backdrop-filter: blur(12px)` para glassmorphism — usar con moderación

---

## 7. Do's and Don'ts

### Do's ✅

- Usar `--color-accent` para el CTA principal siempre
- Usar `text-wrap: balance` en todos los headings
- Añadir kicker/eyebrow badge antes de cada H2 de sección
- Usar `clamp()` para todos los font-sizes y paddings
- Alternar `--color-bg` y `--color-bg-subtle` entre secciones
- Añadir `data-reveal` a elementos para animación al scroll
- [Reglas específicas de esta marca]

### Don'ts ❌

- ❌ Nunca usar `#6366f1`, `#3b82f6` u otros "azules de IA genérica"
- ❌ No usar más de 2 colores de acento por pantalla
- ❌ No usar gradientes de más de 2 colores
- ❌ No animar sin `prefers-reduced-motion` respetado
- ❌ No usar imágenes de stock de personas con traje posando
- ❌ No centrar texto de más de 4 líneas en móvil
- ❌ [Restricciones específicas de esta marca]

---

## 8. Responsive Behavior

| Breakpoint | Ancho | Cambios principales |
|---|---|---|
| `sm` | ≥ 640px | Layout de 2 columnas disponible |
| `md` | ≥ 768px | Nav completo, hero 2 col |
| `lg` | ≥ 1024px | Grids de 3–4 col, full design |
| `xl` | ≥ 1280px | Container en max-width |

**Reglas móvil (< 640px):**
- Nav: hamburger menu con overlay
- Hero: columna única, texto primero
- Grids → columna única (stacked)
- Botones: full-width dentro de formularios y CTA
- Font scale: `clamp()` maneja la reducción automáticamente
- Sección padding: `clamp(40px, 6vw, 64px)` en móvil

**Reglas de imagen responsive:**
```html
<img
  src="[url]"
  alt="[descripción]"
  width="[W]" height="[H]"
  loading="lazy" decoding="async"
>
```

---

## 9. Agent Prompt Guide

Usar este bloque cuando se le pide a la IA generar componentes:

**Para generar un botón primario:**
> "Botón primario con `background: var(--color-accent)`, `color: var(--color-bg)`, `padding: 14px 28px`, `border-radius: var(--radius-md)`, `font-weight: 600`, hover con `opacity: 0.88`."

**Para generar un hero section:**
> "Hero con fondo `var(--color-bg-dark)`. Grid 2 columnas: izquierda tiene kicker badge + H1 grande en `clamp(2.5rem, 5vw, 5rem)` + párrafo lead + botón CTA + botón outline. Derecha tiene imagen/visual en card elevada. Añadir `data-reveal` con stagger."

**Para generar una feature card:**
> "Card con `var(--color-surface)`, `border: 1px solid var(--color-border)`, icon top (Material Symbols o SVG), H3, párrafo breve. Hover: `border-color: var(--color-accent)` + sombra nivel 2."

**Para generar un FAQ accordion:**
> "FAQ con `<details>/<summary>`. Cada item tiene borde bottom, H3 como pregunta (con ícono chevron que rota al abrir), párrafo respuesta. Usar transición CSS para el open/close."

**Tono de voz de los copies:**
- [Describir el tono: ej "Directo y sin adornos. Primera persona plural. Sin jerga corporativa."]
- Headlines: [ej: "Orientados a resultado: 'Convierte más con menos esfuerzo'"]
- Body: [ej: "Claro, breve, con evidencia. Max 3 oraciones por párrafo."]
- CTA: [ej: "Acción clara + beneficio: 'Empezar gratis — sin tarjeta de crédito'"]
