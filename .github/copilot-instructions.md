# WebGen — AI Website Factory
> Herramienta para crear sitios web de clase mundial con IA.  
> Basada en el protocolo [nexu-io/open-design](https://github.com/nexu-io/open-design/tree/main/skills).

---

## WORKFLOW OBLIGATORIO (en orden estricto)

```
FASE 1: Brand Intake  →  DESIGN.md
FASE 2: UIKit         →  uikit.html                           (requiere DESIGN.md aprobado)
FASE 3: WP Theme      →  style.css + functions.php + main.js  (requiere UIKit aprobado)
FASE 4+: Páginas      →  guía Elementor + CSS snippets        (requiere WP Theme aprobado)
```

> **Plataforma:** WordPress + Elementor Pro.  
> El header y footer los construye **Elementor Pro** — WebGen no los genera.  
> WebGen provee el CSS del theme (tokens, tipografía, animaciones) y guías de construcción por página.

⛔ **No saltar fases.** Cada fase requiere aprobación explícita del cliente antes de avanzar.

---

## FASE 1 — Brand Intake → DESIGN.md

**Trigger:** "nuevo proyecto", "empezar sitio", "brand intake", "dame el DESIGN.md"

**Proceso:**
1. Hacer preguntas de brief (ver `/skills/brand-intake/SKILL.md`)
2. Generar `DESIGN.md` con las 9 secciones del formato awesome-claude-design
3. Presentar al cliente para revisión
4. Iterar hasta aprobación — nunca avanzar sin el DESIGN.md aprobado

**Inputs que pedir al cliente:**
- Nombre del negocio y descripción en 2 líneas
- Colores de marca (hex o referencias)
- Tipografías (o referencias de sitios que le gusten)
- Tono de voz (formal / cercano / técnico / aspiracional)
- Público objetivo y mercado (país/idioma)
- 3 competidores o referencias de diseño que admire
- Logo disponible (URL o archivo)

---

## FASE 2 — UIKit → uikit.html

**Trigger:** "crear uikit", "generar sistema visual", después de DESIGN.md aprobado

**Objetivo:** Un HTML que muestre TODOS los componentes del sistema de diseño.

**Componentes obligatorios:**
- Paleta de colores (swatches con nombre del token)
- Escala tipográfica completa (hero, h1–h6, body, small, label, caption)
- Botones: primary, secondary, outline, ghost, icon-only, disabled
- Cards: default, elevated, dark/inverted, con imagen
- Formularios: input, select, textarea, checkbox, radio, toggle switch
- Badges, tags, chips, pills
- Navegación desktop + mobile (hamburger)
- Hero — mínimo 2 variantes (texto solo, texto + imagen)
- Sección de features / beneficios
- Testimonial / Social proof
- CTA sections (inline y full-width)
- Footer completo
- Animaciones: ejemplos de scroll reveal, hover states, transiciones

**Reglas:**
- Auto-contenido en un solo archivo HTML
- Los CSS tokens se definen en `<style>` con `:root { --variables }`
- GSAP + Lenis via CDN
- Cada componente tiene su sección con header descriptivo

---

## FASE 3 — WP Theme Setup → style.css + functions.php + main.js

**Trigger:** "setup del tema", "generar theme", "archivos del theme", después de UIKit aprobado

**Prerequisito:** UIKit aprobado. Sin aprobación → no generar.

**Outputs obligatorios:**

### `wp-theme/style.css`
- Cabecera WordPress (`Theme Name`, `Template`, `Version`)
- Tokens CSS en `:root` (colores, tipografía, espaciado, radii, sombras)
- Reset mínimo
- Tipografía base (`body`, `h1`–`h6`)
- Clases de layout reutilizables (`.wg-container`, `.wg-section`)
- Clases de componentes para Elementor (`.wg-btn-primary`, `.wg-kicker`, `.wg-card`)
- Progressive enhancement para animaciones (`.js [data-reveal]`)
- `@media (prefers-reduced-motion: reduce)`

### `wp-theme/functions.php`
- `wp_enqueue_scripts`: encolar `style.css`, Google Fonts, GSAP, Lenis, `main.js`
- `add_theme_support`: `title-tag`, `post-thumbnails`, `html5`

### `wp-theme/main.js`
- `document.documentElement.classList.add('js')` — progressive enhancement
- Inicialización de Lenis
- Setup GSAP + ScrollTrigger
- Scroll reveal en elementos con `[data-reveal]`
- Header scroll: añadir `.scrolled` al `<header>` al hacer scroll
- Compatibilidad Elementor: listener en `elementor/frontend/init` si hay widgets dinámicos

**Nota:** Header y footer los construye Elementor Pro. Los tokens del theme aplican automáticamente.

---

## FASE 4+ — Páginas en Elementor → guía de construcción + CSS snippets

**Trigger:** "crear página [nombre]", "guía para [about/servicio/contacto]"

**Prerequisito:** WP Theme aprobado. Cada página es independiente.

**Por cada página, generar:**

1. **Guía de construcción sección por sección**
   - Tipo de contenedor Elementor (Section / Container / Inner Section)
   - Widgets a usar (Heading, Text Editor, Button, Image, Icon Box, etc.)
   - Clases CSS custom a aplicar en el widget (campo CSS Classes en Advanced)
   - Atributo `data-reveal` a añadir en Elementor → Advanced → Attributes

2. **CSS global de la página** → pegar en Elementor → Edit Page → Custom CSS

3. **CSS por sección** → pegar en Section → Edit → Advanced → Custom CSS

4. **Schema.org JSON-LD** → widget HTML o via RankMath/Yoast
   - `WebPage` + `Organization` en todas
   - `Service` en páginas de servicio
   - `FAQPage` obligatorio en servicio y about

5. **Metadatos SEO** → campos a completar en RankMath o Yoast:
   - SEO Title, Meta Description, OG image, Canonical

6. **Copys por sección** → listos para copiar y pegar en cada widget

---

## ESTÁNDARES DE DISEÑO

### Filosofía: Los mejores sitios del mundo como referencia

Estudiamos y aplicamos los principios de: **Stripe**, **Linear**, **Vercel**, **Framer**, **Loom**, **Arc Browser**, **Notion**, **Raycast**, **Figma**.

Lo que tienen en común:
1. **Claridad radical** — cada elemento cumple una función, nada es decorativo sin intención
2. **Tipografía como sistema** — escala precisa, jerarquía obvia, espacio generoso
3. **Paleta contenida** — 1 acento, usada con disciplina; backgrounds con personalidad sutil
4. **Espacio en blanco activo** — el espacio comunica premium
5. **Motion con propósito** — las animaciones guían la atención, no la distraen
6. **Dark / light bien ejecutado** — nunca grises indefinidos; siempre contraste claro

### Tokens de color — Reglas universales

```css
:root {
  --color-bg:         /* Background principal — no puro #000 ni #fff */
  --color-bg-subtle:  /* Secciones alternativas */
  --color-surface:    /* Cards, paneles */
  --color-surface-2:  /* Hover de surface */
  --color-text:       /* Texto principal (contraste 7:1 mínimo) */
  --color-text-muted: /* Texto secundario, labels */
  --color-accent:     /* El acento de marca — 1 solo acento principal */
  --color-accent-2:   /* Acento secundario (max 1 por screen) */
  --color-border:     /* Bordes y separadores */
}
```

- El acento aparece máximo **2 veces por pantalla**
- El fondo nunca es `#ffffff` puro ni `#000000` puro (siempre toque de tono)
- `--color-text` cumple WCAG AAA (7:1) sobre `--color-bg`

### Tipografía — Reglas universales

- Máximo 2 familias: **display/heading** + **body**
- Variable fonts cuando sea posible (Google Fonts tiene muchas)
- `text-wrap: balance` en **todos** los headings
- `clamp()` para font-size fluid — siempre
- ALL CAPS: siempre `letter-spacing: 0.08em` mínimo
- Números grandes (stats): `font-variant-numeric: tabular-nums`

### Layout — Reglas universales

```css
.container { width: min(1280px, 92vw); margin: 0 auto; }
.section    { padding: clamp(64px, 8vw, 120px) 0; }
```

- Grid gaps: múltiplos de 8px
- Mobile-first en todo el CSS
- CSS Grid y Flexbox nativos — sin frameworks (excepto brief lo requiera)
- `aspect-ratio` en todos los contenedores de imagen

---

## LIBRERÍA DE ANIMACIONES

### Stack estándar — CDN (sin build step)

```html
<!-- GSAP + ScrollTrigger (gratis, CDN) -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js"></script>

<!-- Lenis — smooth scroll (Studio Freight / darkroom.engineering) -->
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js"></script>
```

### Progressive enhancement — SIEMPRE

```css
/* Sin JS: contenido visible */
[data-reveal] { /* visible por defecto */ }

/* Con JS: ocultar y animar */
.js [data-reveal] {
  opacity: 0;
  transform: translateY(24px);
  will-change: opacity, transform;
}
.js [data-reveal].is-visible {
  opacity: 1;
  transform: none;
  transition: opacity 0.7s ease, transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
}
```

```javascript
// Añadir .js al arrancar — hace visible o anima
document.documentElement.classList.add('js');
```

### Patrones GSAP estándar

```javascript
// Setup global
gsap.registerPlugin(ScrollTrigger);

// Lenis smooth scroll
const lenis = new Lenis({ lerp: 0.08, smooth: true });
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => lenis.raf(time * 1000));
gsap.ticker.lagSmoothing(0);

// Reveal individual
gsap.utils.toArray('[data-reveal]').forEach(el => {
  gsap.fromTo(el,
    { opacity: 0, y: 30 },
    {
      opacity: 1, y: 0,
      duration: 0.8, ease: 'power3.out',
      scrollTrigger: { trigger: el, start: 'top 85%', once: true }
    }
  );
});

// Stagger para grids
gsap.utils.toArray('.stagger-parent').forEach(parent => {
  const items = parent.querySelectorAll('.stagger-child');
  gsap.fromTo(items,
    { opacity: 0, y: 40 },
    {
      opacity: 1, y: 0,
      stagger: 0.08, duration: 0.7, ease: 'power2.out',
      scrollTrigger: { trigger: parent, start: 'top 80%', once: true }
    }
  );
});

// Hero entrance (sin scrollTrigger — al cargar)
gsap.fromTo('.hero-content > *',
  { opacity: 0, y: 20 },
  { opacity: 1, y: 0, stagger: 0.12, duration: 0.9, ease: 'power3.out', delay: 0.2 }
);

// Texto que se revela línea a línea
// Usar SplitType si el brief requiere efecto premium
```

### Reglas de motion

| Tipo | Duración | Ease |
|---|---|---|
| Micro (hover, focus) | 150–200ms | `ease` |
| Estándar (reveal, transición) | 400–700ms | `power3.out` |
| Hero entrance | 800–1000ms | `power3.out` |
| Parallax continuo | — | `power1.inOut` |

```css
/* Reduced motion — siempre */
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
  [data-reveal] { opacity: 1 !important; transform: none !important; }
}
```

---

## SEO Y GEO — OBLIGATORIO

Ver `/craft/seo-geo.md` para el checklist completo.

### Checklist rápido por página

- [ ] Un solo `<h1>` con keyword principal
- [ ] `<title>` 50–60 chars: "Keyword | Marca"
- [ ] `<meta description>` 150–160 chars, con keyword + propuesta de valor
- [ ] `<link rel="canonical">`
- [ ] Open Graph + Twitter Card completos
- [ ] Schema.org: `WebPage` + `Organization` en todas las páginas
- [ ] Schema.org: `Service` en páginas de servicio
- [ ] Schema.org: `FAQPage` en páginas con FAQ (obligatorio en internas)
- [ ] Imágenes: `alt` descriptivo + `width` + `height` + `loading="lazy"`
- [ ] Font `display: swap`
- [ ] Scripts con `defer`

### GEO — Aparece en ChatGPT, Gemini, Perplexity

```html
<!-- Bloque de definición de entidad — siempre en el primer párrafo visible -->
<p>
  [Empresa] es [categoría de negocio] especializada en [diferenciador],
  que ayuda a [audiencia] a [resultado concreto] en [mercado/región].
</p>
```

- FAQ en **cada página interna** — responde preguntas del tipo "¿Qué es X?", "¿Cómo funciona Y?"
- Datos con contexto: "12 años de experiencia en LATAM" > "amplia experiencia"
- Autoridad temática: responder mínimo 3 preguntas long-tail por página

---

## ESTRUCTURA DE ARCHIVOS DEL PROYECTO

```
[proyecto]/
├── DESIGN.md                        ← Sistema de diseño (Fase 1 output)
├── uikit.html                       ← Referencia visual aprobada (Fase 2 output)
│
├── wp-theme/                        ← Archivos para el child theme de WordPress
│   ├── style.css                    ← Tokens + estilos globales (Fase 3 output)
│   ├── functions.php                ← Enqueue scripts/styles (Fase 3 output)
│   └── main.js                      ← GSAP + Lenis + scroll reveal (Fase 3 output)
│
└── pages/                           ← Guías Elementor por página (Fase 4 outputs)
    ├── home-guide.md                ← Estructura + CSS + copy del home
    ├── about-guide.md
    ├── [servicio]-guide.md
    └── contacto-guide.md
```

### Dónde van los archivos en WordPress

| Archivo WebGen | Destino en WordPress |
|---|---|
| `wp-theme/style.css` | Raíz del child theme |
| `wp-theme/functions.php` | Raíz del child theme (merge con el existente) |
| `wp-theme/main.js` | `/wp-content/themes/[child-theme]/js/main.js` |
| CSS global de página (`pages/`) | Elementor → Edit Page → Custom CSS |
| CSS de sección | Section → Advanced → Custom CSS |
| Schema.org JSON-LD | Widget HTML o RankMath → Schema tab |
| Metadatos SEO | RankMath o Yoast SEO (por página) |

---

## TEMPLATES WORDPRESS

### wp-theme/style.css — cabecera + tokens

```css
/*
Theme Name:  [Cliente] Child Theme
Description: Child theme generado con WebGen
Template:    hello-elementor
Version:     1.0.0
*/

/* ── Tokens ── */
:root {
  /* Colores */
  --color-bg:         [valor];
  --color-bg-subtle:  [valor];
  --color-surface:    [valor];
  --color-text:       [valor];
  --color-text-muted: [valor];
  --color-accent:     [valor];
  --color-border:     [valor];

  /* Tipografía */
  --font-display: '[Fuente Display]', sans-serif;
  --font-body:    '[Fuente Body]', sans-serif;

  /* Espaciado */
  --space-xs:  clamp(8px,  1vw, 12px);
  --space-sm:  clamp(16px, 2vw, 24px);
  --space-md:  clamp(24px, 3vw, 40px);
  --space-lg:  clamp(40px, 5vw, 64px);
  --space-xl:  clamp(64px, 8vw, 120px);

  /* Radii */
  --radius-sm: [valor]; --radius-md: [valor]; --radius-lg: [valor];

  /* Sombras */
  --shadow-sm: [valor]; --shadow-md: [valor]; --shadow-lg: [valor];
}

/* ── Reset mínimo ── */
*, *::before, *::after { box-sizing: border-box; }

/* ── Tipografía base ── */
body   { font-family: var(--font-body); color: var(--color-text); background: var(--color-bg); line-height: 1.65; -webkit-font-smoothing: antialiased; }
h1,h2,h3,h4,h5,h6 { font-family: var(--font-display); text-wrap: balance; line-height: 1.15; }

/* ── Layout ── */
.wg-container { width: min(1280px, 92vw); margin: 0 auto; }
.wg-section   { padding: var(--space-xl) 0; }

/* ── Animaciones — progressive enhancement ── */
[data-reveal] { /* visible sin JS */ }
.js [data-reveal]            { opacity: 0; transform: translateY(24px); will-change: opacity, transform; }
.js [data-reveal="left"]     { transform: translateX(-32px); }
.js [data-reveal="right"]    { transform: translateX(32px); }
.js [data-reveal].is-visible { opacity: 1; transform: none; transition: opacity 0.7s ease, transform 0.7s cubic-bezier(0.22,1,0.36,1); }

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
  [data-reveal] { opacity: 1 !important; transform: none !important; }
}
```

### wp-theme/functions.php — enqueue estándar

```php
<?php
function webgen_enqueue_assets() {
    wp_enqueue_style( 'webgen-fonts',
        'https://fonts.googleapis.com/css2?family=[Fuente1]:wght@[pesos]&family=[Fuente2]:wght@[pesos]&display=swap',
        [], null );
    wp_enqueue_style( 'webgen-theme',
        get_stylesheet_directory_uri() . '/style.css',
        ['webgen-fonts'], '1.0.0' );
    wp_enqueue_script( 'gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js',
        [], '3.12.7', true );
    wp_enqueue_script( 'gsap-st',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js',
        ['gsap'], '3.12.7', true );
    wp_enqueue_script( 'lenis',
        'https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js',
        [], '1.1.14', true );
    wp_enqueue_script( 'webgen-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        ['gsap', 'gsap-st', 'lenis'], '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'webgen_enqueue_assets' );

function webgen_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', ['search-form','comment-form','gallery','caption'] );
}
add_action( 'after_setup_theme', 'webgen_theme_setup' );
```

### Cómo aplicar `data-reveal` en Elementor

1. Editar la sección o widget → **Advanced**
2. En **Attributes** agregar: `data-reveal | up` (o `left`, `right`)
3. El `main.js` del theme lo detecta y anima automáticamente

### Schema.org en WordPress — 3 opciones

**Opción A (recomendada):** RankMath → Schema tab por página  
**Opción B:** Widget HTML de Elementor con el snippet JSON-LD:  
```html
<script type="application/ld+json">
{ "@context": "https://schema.org", "@graph": [
  { "@type": "WebPage", "name": "[Título]", "url": "[URL]" },
  { "@type": "Organization", "name": "[Marca]", "url": "[Dominio]" }
]}
</script>
```
**Opción C:** Via `wp_head` hook en `functions.php` (para schemas globales)

---

## PROHIBICIONES ABSOLUTAS

| ❌ Prohibido | ✅ Alternativa |
|---|---|
| Generar HTML antes de DESIGN.md aprobado | Completar Fase 1 primero |
| Generar páginas antes de UIKit aprobado | Completar Fase 2 primero |
| `color: #6366f1` como acento (default de IA) | Color del brief del cliente |
| Bootstrap, Tailwind en archivos nuevos | CSS nativo con tokens |
| animate.css, AOS | GSAP ScrollTrigger |
| Gradientes de arco iris (3+ colores) | Máximo 2 colores en gradiente |
| Generar HTML standalone para páginas WP | Generar guía Elementor + CSS snippets |
| CSS inline en Elementor para estilos globales | Usar `style.css` del theme |
| Stock photos de personas con traje mirando a cámara | Indicar prompt para imagen original |
| Saltarse Schema.org en cualquier página | Siempre incluir JSON-LD (RankMath o widget HTML) |

---

## REFERENCIAS DE CRAFT

Leer estos archivos antes de generar:

- `/craft/typography.md` — Reglas universales de tipografía
- `/craft/animations.md` — Patrones GSAP y principios de motion
- `/craft/seo-geo.md` — Checklist SEO/GEO completo
- `/craft/anti-slop.md` — Anti-patrones de diseño genérico

## SKILLS DISPONIBLES

- `/skills/brand-intake/SKILL.md` — Fase 1: Brief → DESIGN.md
- `/skills/uikit-gen/SKILL.md` — Fase 2: DESIGN.md → uikit.html
- `/skills/home-gen/SKILL.md` — Fase 3: UIKit aprobado → style.css + functions.php + main.js
- `/skills/page-gen/SKILL.md` — Fase 4: Tipo + Copy → guía Elementor + CSS snippets
