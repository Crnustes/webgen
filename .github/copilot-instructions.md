# WebGen — AI Website Factory
> Herramienta para crear sitios web de clase mundial con IA.  
> Basada en el protocolo [nexu-io/open-design](https://github.com/nexu-io/open-design/tree/main/skills).

---

## WORKFLOW OBLIGATORIO (en orden estricto)

```
FASE 1: Brand Intake  →  DESIGN.md
FASE 2: UIKit         →  uikit.html        (requiere DESIGN.md aprobado)
FASE 3: Home Page     →  home.html         (requiere UIKit aprobado)
FASE 4+: Páginas      →  [slug].html       (requiere Home aprobado)
```

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

## FASE 3 — Home Page → home.html

**Trigger:** "crear home", "página de inicio", después de UIKit aprobado

**Prerequisito:** UIKit aprobado. Sin aprobación → no generar.

**Estructura obligatoria del home:**
1. `<header>` — Nav sticky, logo + links + CTA principal
2. `<section id="hero">` — Impacto máximo: headline + subhead + CTA + visual
3. `<section id="logos">` — Social proof: logos de clientes o medios
4. `<section id="features">` — 3–6 beneficios o características clave
5. `<section id="how">` — Cómo funciona / proceso en 3–5 pasos
6. `<section id="proof">` — Testimonials, casos de éxito o métricas
7. `<section id="pricing">` — Precios (si aplica)
8. `<section id="cta">` — CTA final con urgencia o propuesta de valor
9. `<footer>` — Links, redes, legal

**Output:** `home.html` — completo, SEO+GEO optimizado, animaciones con GSAP+Lenis

---

## FASE 4+ — Páginas adicionales → [slug].html

**Trigger:** "[nombre de página]", "página de [servicio]", "crear [about/contacto/servicio]"

**Prerequisito:** Home aprobado. Cada página es independiente.

**Por cada página:**
- Lee `DESIGN.md` para tokens y estilo
- Comparte nav y footer idénticos al home
- Tiene SEO completo (title, description, OG, Schema.org)
- FAQ obligatoria con `FAQPage` Schema en páginas de servicio/about
- `<link rel="canonical">` propio

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
├── .github/
│   └── copilot-instructions.md   ← copia de estas instrucciones adaptadas al cliente
├── css/
│   └── theme.css                 ← design tokens + componentes base
├── scripts/
│   └── main.js                   ← animaciones GSAP + interactividad
├── img/                          ← imágenes optimizadas (WebP preferido)
├── DESIGN.md                     ← sistema de diseño (Fase 1 output)
├── uikit.html                    ← referencia visual (Fase 2 output)
├── home.html                     ← página de inicio (Fase 3 output)
├── about.html                    ← about (Fase 4)
├── servicios/
│   └── [servicio].html           ← páginas de servicio (Fase 4)
└── contacto.html                 ← contacto (Fase 4)
```

---

## TEMPLATE BASE — toda página nueva

```html
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>[Keyword principal] | [Marca]</title>
  <meta name="description" content="[150-160 chars con keyword y propuesta de valor]">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://[dominio]/[slug]/">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:locale" content="es_ES">
  <meta property="og:site_name" content="[Marca]">
  <meta property="og:title" content="[Keyword] | [Marca]">
  <meta property="og:description" content="[Descripción OG]">
  <meta property="og:image" content="https://[dominio]/img/og-[slug].jpg">
  <meta property="og:url" content="https://[dominio]/[slug]/">
  <meta name="twitter:card" content="summary_large_image">

  <!-- Schema.org -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@graph": [
      {
        "@type": "WebPage",
        "name": "[Título]",
        "description": "[Descripción]",
        "url": "https://[dominio]/[slug]/"
      },
      {
        "@type": "Organization",
        "name": "[Marca]",
        "url": "https://[dominio]/",
        "logo": "https://[dominio]/img/logo.svg"
      }
    ]
  }
  </script>

  <!-- Fonts (siempre preconnect) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="[URL Google Fonts]" rel="stylesheet">

  <!-- CSS -->
  <link rel="stylesheet" href="/css/theme.css">
</head>
<body>

  <header id="site-header" role="banner">
    <!-- Nav -->
  </header>

  <main id="main-content">
    <!-- Secciones -->
  </main>

  <footer id="site-footer" role="contentinfo">
    <!-- Footer -->
  </footer>

  <!-- GSAP -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js" defer></script>
  <!-- Lenis -->
  <script src="https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js" defer></script>
  <!-- App -->
  <script src="/scripts/main.js" defer></script>
</body>
</html>
```

---

## PROHIBICIONES ABSOLUTAS

| ❌ Prohibido | ✅ Alternativa |
|---|---|
| Generar HTML antes de DESIGN.md aprobado | Completar Fase 1 primero |
| Generar páginas antes de UIKit aprobado | Completar Fase 2 primero |
| `color: #6366f1` como acento (default de IA) | Color del brief del cliente |
| Bootstrap, Tailwind, jQuery | CSS nativo + vanilla JS |
| animate.css, AOS | GSAP ScrollTrigger |
| Gradientes de arco iris (3+ colores) | Máximo 2 colores en gradiente |
| Stock photos de personas con traje mirando a cámara | Indicar prompt para imagen original |
| Imágenes sin `alt` | `alt` descriptivo con contexto de negocio |
| `<div>` donde hay semántica disponible | `<section>`, `<article>`, `<nav>`, `<aside>` |
| CSS/JS inline para funcionalidades en theme.css/main.js | Usar los archivos compartidos |
| Saltarse Schema.org en cualquier página | Siempre incluir JSON-LD |

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
- `/skills/home-gen/SKILL.md` — Fase 3: Copy → home.html
- `/skills/page-gen/SKILL.md` — Fase 4: Tipo + Copy → [page].html
