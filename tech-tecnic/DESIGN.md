# Tech Tecnic — Design System
> Generado por WebGen · Fase 1 output
> Estado: BORRADOR — pendiente aprobación del cliente
> Fecha: 2026-05-20

---

## 1. Visual Theme & Atmosphere

**Mood general:**
Precisión de ingeniería japonesa. Cada elemento tiene propósito, nada es decorativo sin intención. El diseño comunica competencia técnica con la sobriedad de las marcas japonesas más respetadas: pocos colores, mucho espacio, una jerarquía que el usuario entiende sin pensar.

**Referencias de diseño inspiradoras:**

| Empresa | Qué tomamos de su diseño |
|---|---|
| **linear.app** | Dark mode sin sombras excesivas, tipografía tight, sensación de herramienta de precisión |
| **sony.com** | Jerarquía visual contenida, espacio en blanco como lujo, disciplina de color |
| **vercel.com** | Grid matemático, acento único, transiciones invisibles pero presentes |

**Palabras clave visuales:**
`preciso` · `contenido` · `técnico` · `nocturno` · `confiable`

**Atmósfera de sección:**
- **Hero:** Fondo near-black `#0d0d11`, título Syne 800 enorme, acento bermellón en una palabra clave
- **Features:** `#13131c` con cards de borde `1px` sutil, cero sombras agresivas
- **Stats / Prueba social:** Números grandes con `tabular-nums`, fondo plano sin decoración
- **CTA final:** Fondo `#C9382A` bermellón — el único momento donde el acento domina completamente
- **Footer:** `#080809`, casi negro total, tipografía muted

---

## 2. Color Palette & Roles

```css
:root {
  /* Fondos */
  --color-bg:         #0d0d11;   /* Fondo principal — near-black frío */
  --color-bg-subtle:  #13131c;   /* Secciones alternativas */
  --color-bg-dark:    #080809;   /* Hero oscuro, footer, CTA dark */

  /* Superficies */
  --color-surface:    #1c1c28;   /* Cards, paneles, inputs */
  --color-surface-2:  #24243a;   /* Hover, estado activo */

  /* Texto */
  --color-text:         #edeef2; /* Texto principal — 16:1 sobre --color-bg */
  --color-text-muted:   #8888a0; /* Texto secundario, labels, subtítulos */
  --color-text-on-dark: #f0f0f5; /* Texto sobre fondos oscuros */

  /* Acento de marca */
  --color-accent:     #C9382A;   /* Bermellón japonés — torii, laca, bandera */
  --color-accent-rgb: 201, 56, 42;  /* Para uso en rgba() */
  --color-accent-2:   #00B4C4;   /* Cian tecnológico — pantallas, circuitos */

  /* Bordes */
  --color-border:        rgba(255, 255, 255, 0.08);  /* Borde sutil en dark */
  --color-border-strong: rgba(255, 255, 255, 0.16);  /* Borde con énfasis */
}
```

**Swatches visuales:**

| Token | Valor | Uso principal | Frecuencia |
|---|---|---|---|
| `--color-bg` | `#0d0d11` | Fondo de página | Base |
| `--color-bg-subtle` | `#13131c` | Secciones alternadas | ~50% |
| `--color-surface` | `#1c1c28` | Cards y paneles | Componentes |
| `--color-text` | `#edeef2` | Texto corriente | Mayoría |
| `--color-text-muted` | `#8888a0` | Labels, meta info | ~30% del texto |
| `--color-accent` | `#C9382A` | **MARCA** — CTAs, highlights | Máx 2×/pantalla |
| `--color-accent-2` | `#00B4C4` | Datos técnicos, etiquetas tech | Solo cuando refuerza |
| `--color-border` | `rgba(255,255,255,0.08)` | Todos los bordes | Consistente |

**Reglas de uso del color:**
1. `--color-accent` bermellón aparece máximo **2 veces por pantalla**
2. `--color-accent-2` cian solo para etiquetas técnicas, badges de datos o iconos
3. Nunca fondos blancos ni grises claros — este es un sistema dark-first
4. El CTA final de página es el único lugar donde el acento ocupa fondo completo

---

## 3. Typography Rules

```css
:root {
  --font-display: 'Syne', sans-serif;           /* Headings, hero, números grandes */
  --font-body:    'Inter', sans-serif;           /* Texto corriente, UI, párrafos */
  --font-mono:    'JetBrains Mono', monospace;   /* Labels técnicos, datos, código */
}
```

**Fuentes seleccionadas:**

| Rol | Familia | Pesos | Razón |
|---|---|---|---|
| Display | **Syne** | 700, 800 | Geométrica, arquitectónica, irregular — identidad única, muy Tokio |
| Body | **Inter** | 400, 500, 600 | Máxima legibilidad técnica, estándar de la industria tech |
| Mono | **JetBrains Mono** | 400, 500 | Refuerza la identidad de ingeniería, legible en labels y datos |

**Carga de fuentes:**
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
```

**Escala tipográfica:**

| Rol | `font-size` | `font-weight` | `line-height` | `letter-spacing` | Uso |
|---|---|---|---|---|---|
| Hero | `clamp(3.2rem, 7vw, 7rem)` | 800 | 0.93 | `-0.04em` | H1 en hero |
| H1 | `clamp(2.4rem, 5vw, 4.5rem)` | 800 | 1.0 | `-0.03em` | Heading de página |
| H2 | `clamp(1.8rem, 3.2vw, 2.75rem)` | 700 | 1.1 | `-0.02em` | Secciones |
| H3 | `clamp(1.25rem, 2vw, 1.6rem)` | 700 | 1.2 | `-0.01em` | Subsecciones |
| H4 | `1.125rem` | 600 | 1.25 | `0` | Cards, aside |
| Body L | `clamp(1rem, 1.5vw, 1.2rem)` | 400 | 1.75 | `0` | Leads, intros |
| Body | `1rem` | 400 | 1.65 | `0` | Texto corriente |
| Small | `0.875rem` | 500 | 1.5 | `0` | Meta, helpers |
| Label | `0.75rem` | 600 | 1.4 | `0.08em` | UI labels, badges |
| Kicker | `0.6875rem` | 700 | 1.4 | `0.12em` | Eyebrow, ALL CAPS |

**Reglas tipográficas:**
- `text-wrap: balance` en **todos** los `<h1>–<h4>`
- Kickers y labels en ALL CAPS: siempre `letter-spacing: 0.10em` mínimo, en `--font-mono`
- Números de stat: `font-variant-numeric: tabular-nums` + Syne 800
- Máximo `65ch` por línea en body (`max-width: 65ch`)
- `font-display: swap` siempre
- Las palabras clave en headings usan `<em>` estilizado con `--color-accent`

---

## 4. Component Stylings

### Buttons

```css
/* Primary — acción principal */
.btn-primary {
  background: var(--color-accent);
  color: #ffffff;
  padding: 14px 28px;
  border-radius: var(--radius-md);
  font-family: var(--font-body);
  font-weight: 600;
  font-size: 0.9375rem;
  border: 2px solid transparent;
  letter-spacing: 0.01em;
  transition: opacity 150ms ease, transform 150ms ease;
}
.btn-primary:hover { opacity: 0.88; transform: translateY(-1px); }

/* Secondary */
.btn-secondary {
  background: var(--color-surface);
  color: var(--color-text);
  border: 1px solid var(--color-border-strong);
  padding: 14px 28px;
  border-radius: var(--radius-md);
  font-weight: 500;
  transition: background 150ms ease, border-color 150ms ease;
}
.btn-secondary:hover {
  background: var(--color-surface-2);
  border-color: rgba(255,255,255,0.28);
}

/* Outline */
.btn-outline {
  background: transparent;
  color: var(--color-accent);
  border: 1.5px solid var(--color-accent);
  padding: 13px 27px;
  border-radius: var(--radius-md);
  font-weight: 600;
  transition: background 150ms ease;
}
.btn-outline:hover {
  background: rgba(var(--color-accent-rgb), 0.08);
}

/* Ghost */
.btn-ghost {
  background: transparent;
  color: var(--color-text-muted);
  border: none;
  padding: 14px 20px;
  transition: color 150ms ease;
}
.btn-ghost:hover { color: var(--color-text); }
```

**Tamaños:**
`sm` — `10px 20px` | `md` — `14px 28px` | `lg` — `18px 40px`

### Cards

```css
.card {
  background: var(--color-surface);
  border: 1px solid var(--color-border);
  border-radius: var(--radius-lg);
  padding: 32px;
  transition: border-color 200ms ease;
}
.card:hover {
  border-color: rgba(var(--color-accent-rgb), 0.40);
}

/* Card tech — con línea de acento superior */
.card--tech {
  border-top: 2px solid var(--color-accent);
  background: var(--color-surface);
  border-radius: 0 0 var(--radius-lg) var(--radius-lg);
}

/* Card dark */
.card--dark {
  background: var(--color-bg-dark);
  color: var(--color-text-on-dark);
  border-color: var(--color-border);
}
```

### Kicker / Eyebrow badge

```css
.kicker {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 12px;
  border-radius: var(--radius-pill);
  background: rgba(var(--color-accent-rgb), 0.10);
  border: 1px solid rgba(var(--color-accent-rgb), 0.25);
  font-family: var(--font-mono);
  font-size: 0.6875rem;
  font-weight: 700;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: var(--color-accent);
  margin-bottom: 20px;
}
```

### Form inputs

```css
.input {
  padding: 12px 16px;
  border: 1px solid var(--color-border-strong);
  border-radius: var(--radius-md);
  background: var(--color-surface);
  color: var(--color-text);
  font-family: var(--font-body);
  font-size: 1rem;
  transition: border-color 150ms ease, box-shadow 150ms ease;
}
.input::placeholder { color: var(--color-text-muted); }
.input:focus {
  outline: none;
  border-color: var(--color-accent);
  box-shadow: 0 0 0 3px rgba(var(--color-accent-rgb), 0.15);
}
```

### Divider japonés

```css
/* Separador ultra-fino — referencia a los ma (間) del diseño japonés */
.divider {
  border: none;
  border-top: 1px solid var(--color-border);
  margin: 0;
}

.divider--accent {
  border-top: 2px solid var(--color-accent);
  width: 40px;   /* Corto, intencional */
  margin-bottom: 24px;
}
```

### Border radius

| Token | Valor | Uso |
|---|---|---|
| `--radius-sm` | `3px` | Badges, tags pequeños |
| `--radius-md` | `6px` | Inputs, botones |
| `--radius-lg` | `10px` | Cards |
| `--radius-xl` | `16px` | Paneles grandes |
| `--radius-pill` | `999px` | Chips, kickers |

> Radii intencionalmente pequeños — el diseño japonés tech prefiere esquinas limpias, casi rectangulares, sobre las cards redondeadas genéricas.

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

/* Hero layout */
.hero-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: clamp(40px, 5vw, 80px);
  align-items: center;
}
```

**Estructura de secciones:**

| Sección | Layout | Fondo |
|---|---|---|
| Hero | Grid 2 col (60/40) — texto + visual técnico | `--color-bg-dark` |
| Servicios | Grid 3 col — cards con línea de acento top | `--color-bg-subtle` |
| Cómo funciona | Steps numerados — grid asimétrico 1/2 | `--color-bg` |
| Stats | Grid 4 col — números grandes tabular | `--color-bg-dark` |
| Testimonials | Grid 2 col — sin avatars genéricos | `--color-bg-subtle` |
| CTA | Centrado, full-width | `--color-accent` |
| Footer | Grid 4 col | `--color-bg-dark` |

**Spacing scale:**

| Token | Valor |
|---|---|
| `--space-1` | `4px` |
| `--space-2` | `8px` |
| `--space-3` | `12px` |
| `--space-4` | `16px` |
| `--space-6` | `24px` |
| `--space-8` | `32px` |
| `--space-10` | `40px` |
| `--space-12` | `48px` |
| `--space-16` | `64px` |
| `--space-20` | `80px` |
| `--space-24` | `96px` |

---

## 6. Depth & Elevation

| Nivel | Uso | `box-shadow` |
|---|---|---|
| 0 — Flat | Fondo, secciones | `none` |
| 1 — Subtle | Cards en reposo | `none` — borde `1px` reemplaza la sombra |
| 2 — Raised | Hover de card, dropdowns | `0 0 0 1px rgba(var(--color-accent-rgb), 0.3)` |
| 3 — Floating | Modals, tooltips | `0 16px 48px rgba(0, 0, 0, 0.5)` |
| Glow accent | Solo en CTA o elemento hero destacado | `0 0 32px rgba(var(--color-accent-rgb), 0.25)` |

**Reglas de elevación:**
- En dark mode **nunca** usar `box-shadow` clásico — se pierde en fondos oscuros
- La elevación se comunica con **borde de mayor contraste**, no con sombra
- Glassmorphism: `backdrop-filter: blur(16px)` solo en overlays / nav scrolled
- El glow de acento: solo en el botón CTA principal del hero, no más

---

## 7. Do's and Don'ts

### Do's ✅

- Usar `--color-accent` bermellón para el CTA principal siempre
- Texto `text-align: left` en el 90% de las secciones
- Kickers en `--font-mono` ALL CAPS con `letter-spacing: 0.12em`
- Separador `.divider--accent` de 40px antes de cada H2 de sección
- Cards con `border-top: 2px solid var(--color-accent)` para destacar servicios clave
- Números y stats con Syne 800 enorme + `tabular-nums`
- `data-reveal` en todos los elementos de scroll — animaciones de precisión
- Espacios generosos — el `ma` (間) japonés: el espacio vacío tiene valor

### Don'ts ❌

- ❌ Nunca fondos blancos ni grises claros — sistema dark-first
- ❌ No usar `#6366f1`, `#3b82f6` ni ningún "azul de IA"
- ❌ No usar `box-shadow` pesado en cards — reemplazar por borde
- ❌ No centrar texto de secciones de features (solo hero y CTA)
- ❌ No usar gradientes arco iris — máximo 2 colores y mismo tono
- ❌ No más de 2 elementos con `--color-accent` por pantalla
- ❌ No usar `border-radius` mayor a `10px` en cards — evitar aspecto genérico
- ❌ No usar blob shapes, decoraciones flotantes ni fondos con textura
- ❌ No usar avatars de stock en testimonials — iniciales o foto real
- ❌ No usar copys tipo "Soluciones innovadoras" — siempre concreto y medible

---

## 8. Responsive Behavior

| Breakpoint | Ancho | Cambios principales |
|---|---|---|
| `xs` | < 640px | Columna única, todo stacked |
| `sm` | ≥ 640px | Grid 2 col disponible |
| `md` | ≥ 768px | Nav completo, hero 2 col |
| `lg` | ≥ 1024px | Grids 3–4 col, full design |
| `xl` | ≥ 1280px | Container en max-width |

**Reglas móvil (< 640px):**
- Nav: hamburger con overlay `#0d0d11` a `opacity: 0.97` + `backdrop-filter: blur(12px)`
- Hero: columna única, texto primero, visual segundo (debajo del fold)
- Grids → columna única stacked
- Botones en CTA: `width: 100%`
- Cards: padding reducido a `20px`
- `clamp()` en font-size gestiona la escala automáticamente
- Sección padding: `clamp(48px, 6vw, 80px)`

**Imágenes responsive:**
```html
<img
  src="[url]"
  alt="[descripción clara y funcional]"
  width="[W]" height="[H]"
  loading="lazy"
  decoding="async"
>
```

---

## 9. Agent Prompt Guide

**Contexto para la IA al generar componentes:**

> Tech Tecnic es una empresa de tecnología con estética japonesa-tech. Dark mode. Bermellón (`#C9382A`) como único acento. Syne para headings, Inter para body, JetBrains Mono para kickers y labels técnicos. Radii pequeños (6px botones, 10px cards). Bordes en lugar de sombras. Espacio generoso.

**Para generar un botón primario:**
> "Botón con `background: #C9382A`, `color: #fff`, `padding: 14px 28px`, `border-radius: 6px`, `font-family: Inter`, `font-weight: 600`, hover `opacity: 0.88`."

**Para generar el hero:**
> "Hero con `background: #080809`. Grid 2 col (60/40). Izquierda: kicker mono ALL CAPS bermellón + H1 Syne 800 enorme con palabra clave en `#C9382A` + párrafo lead Inter 400 muted + botón primary + botón outline. Derecha: panel visual `#1c1c28` con borde `1px rgba(255,255,255,0.08)`. `data-reveal` con stagger en todos los elementos."

**Para generar una feature card:**
> "Card `background: #1c1c28`, `border: 1px solid rgba(255,255,255,0.08)`, `border-top: 2px solid #C9382A`, `border-radius: 10px`, `padding: 32px`. Icono SVG arriba, H3 Syne, párrafo Inter muted. Hover: `border-top-color: #C9382A` + outline sutil."

**Para generar un stat block:**
> "Grid 4 col. Cada stat: número en Syne 800 `clamp(2.5rem, 4vw, 4rem)` con `font-variant-numeric: tabular-nums` + label en JetBrains Mono ALL CAPS 0.75rem muted. Sin cards, sin bordes — solo tipografía y espacio."

**Para generar un FAQ accordion:**
> "FAQ con `<details>/<summary>`. `border-bottom: 1px solid rgba(255,255,255,0.08)`. Pregunta en Inter 600, respuesta en Inter 400 muted. Chevron SVG que rota 180° con `transition: transform 250ms ease` al `[open]`. Sin padding lateral excesivo."

**Tono de voz:**
- Headlines: Directo, técnico, orientado a resultado concreto. Ej: "Infraestructura que no falla." / "Tu equipo técnico, disponible 24/7."
- Body: Claro y preciso. Sin jerga de marketing. Máximo 3 oraciones por párrafo.
- Kickers: Categorías técnicas en mono. Ej: `SERVICIOS` / `METODOLOGÍA` / `CASOS DE USO`
- CTA: Acción clara + beneficio inmediato. Ej: "Hablar con un técnico" / "Ver casos de éxito"
- Lo que nunca decimos: "Potenciamos", "innovador", "soluciones de clase mundial", "¡Contáctanos hoy!"
