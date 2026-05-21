---
name: wp-theme-gen
description: |
  Fase 3: Genera los archivos del child theme de WordPress.
  Outputs: style.css (tokens + CSS global), functions.php (enqueue), main.js (GSAP + Lenis).
  Prerequisito estricto: UIKit aprobado. Sin aprobación del UIKit NO generar.
  Trigger: "setup del tema", "generar theme", "archivos del theme", "crear el theme WP".
triggers:
  - "setup del tema"
  - "generar theme"
  - "archivos del theme"
  - "crear el theme wp"
  - "theme de wordpress"
  - "generar style.css"
od:
  mode: code
  outputs:
    primary: wp-theme/style.css
    secondary: [wp-theme/functions.php, wp-theme/main.js]
  design_system:
    requires: true
    sections: [color, typography, components, layout, depth, responsive]
  craft:
    requires: [typography, animations, anti-slop]
---

# wp-theme-gen — Fase 3: UIKit aprobado → WP Theme files

## Objetivo

Generar los tres archivos base del child theme de WordPress que implementan el design system aprobado. El header y footer los construye Elementor Pro — estos archivos proveen los tokens globales y las animaciones.

---

## Prerequisito

**Verificar que UIKit fue aprobado.** Si no, responder:
> "Para generar el theme necesito el UIKit aprobado primero. ¿Generamos el UIKit ahora? (skill: uikit-gen)"

---

## Inputs necesarios antes de generar

```
1. ¿Qué theme base usan? (Hello Elementor / Astra / GeneratePress / otro)
   → Necesario para el campo Template: en el header de style.css

2. ¿Ruta donde van los archivos?
   → /wp-content/themes/[nombre-child-theme]/

3. ¿Hay JS específico por página o todo va en main.js?
```

---

## Workflow

### Paso 1 — Leer DESIGN.md y UIKit

1. Extraer todos los tokens: colores, fuentes, radii, sombras, espaciados
2. Verificar los componentes aprobados en el UIKit
3. Identificar las fuentes de Google Fonts (para el enqueue)
4. Identificar si el tema base es Hello Elementor u otro

### Paso 2 — Generar `wp-theme/style.css`

Estructura obligatoria:

```css
/*
Theme Name:  [Cliente] Child Theme
Description: Child theme generado con WebGen para [Cliente]
Template:    hello-elementor
Version:     1.0.0
Author:      [Agencia]
*/

/* =============================================
   TOKENS — Design System de [Cliente]
   ============================================= */
:root {
  /* --- Colores --- */
  --color-bg:         [valor hex];
  --color-bg-subtle:  [valor hex]; /* Secciones alternativas */
  --color-surface:    [valor hex]; /* Cards, paneles */
  --color-text:       [valor hex]; /* Texto principal — contraste ≥7:1 sobre bg */
  --color-text-muted: [valor hex]; /* Texto secundario */
  --color-accent:     [valor hex]; /* Acento de marca */
  --color-accent-2:   [valor hex]; /* Acento secundario (si aplica) */
  --color-border:     [valor hex];

  /* --- Tipografía --- */
  --font-display: '[Fuente Display]', sans-serif;
  --font-body:    '[Fuente Body]', sans-serif;

  /* --- Escala tipográfica --- */
  --text-hero: clamp(48px, 6vw, 88px);
  --text-h1:   clamp(36px, 5vw, 64px);
  --text-h2:   clamp(28px, 4vw, 48px);
  --text-h3:   clamp(22px, 3vw, 32px);
  --text-h4:   clamp(18px, 2.5vw, 24px);
  --text-body: clamp(16px, 1.5vw, 18px);
  --text-sm:   clamp(13px, 1.2vw, 15px);

  /* --- Espaciado --- */
  --space-xs:  clamp(8px,  1vw,   12px);
  --space-sm:  clamp(16px, 2vw,   24px);
  --space-md:  clamp(24px, 3vw,   40px);
  --space-lg:  clamp(40px, 5vw,   64px);
  --space-xl:  clamp(64px, 8vw,  120px);
  --space-2xl: clamp(96px, 12vw, 160px);

  /* --- Border radius --- */
  --radius-sm: [valor];
  --radius-md: [valor];
  --radius-lg: [valor];
  --radius-full: 9999px;

  /* --- Sombras --- */
  --shadow-sm: [valor];
  --shadow-md: [valor];
  --shadow-lg: [valor];

  /* --- Transiciones --- */
  --transition-fast:   150ms ease;
  --transition-base:   250ms ease;
  --transition-slow:   400ms cubic-bezier(0.22, 1, 0.36, 1);
}

/* =============================================
   RESET MÍNIMO
   ============================================= */
*, *::before, *::after { box-sizing: border-box; }
img, video { max-width: 100%; display: block; }

/* =============================================
   TIPOGRAFÍA BASE
   ============================================= */
body {
  font-family: var(--font-body);
  font-size: var(--text-body);
  color: var(--color-text);
  background-color: var(--color-bg);
  line-height: 1.65;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

h1, h2, h3, h4, h5, h6 {
  font-family: var(--font-display);
  font-weight: [peso-headings];
  line-height: 1.15;
  text-wrap: balance;
  color: var(--color-text);
}

h1 { font-size: var(--text-h1); }
h2 { font-size: var(--text-h2); }
h3 { font-size: var(--text-h3); }
h4 { font-size: var(--text-h4); }

p { max-width: 68ch; }
a { color: var(--color-accent); text-decoration: none; transition: opacity var(--transition-fast); }
a:hover { opacity: 0.8; }

/* =============================================
   LAYOUT UTILS (aplicar como CSS class en Elementor)
   ============================================= */
.wg-container { width: min(1280px, 92vw); margin: 0 auto; }
.wg-section   { padding: var(--space-xl) 0; }
.wg-section--subtle { background-color: var(--color-bg-subtle); }
.wg-section--dark   { background-color: [color-oscuro]; color: #fff; }

/* =============================================
   COMPONENTES (clases reutilizables en Elementor → CSS Classes)
   ============================================= */

/* Kicker / Badge */
.wg-kicker {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-family: var(--font-body);
  font-size: var(--text-sm);
  font-weight: 600;
  letter-spacing: 0.06em;
  text-transform: uppercase;
  color: var(--color-accent);
  /* Agregar fondo/borde según el DESIGN.md */
}

/* Botón primario */
.wg-btn-primary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  padding: [padding del DESIGN.md];
  background-color: var(--color-accent);
  color: [color-texto-sobre-acento];
  font-family: var(--font-body);
  font-weight: 600;
  border-radius: var(--radius-md);
  border: 2px solid transparent;
  cursor: pointer;
  transition: transform var(--transition-base), box-shadow var(--transition-base);
}
.wg-btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: var(--shadow-md);
}

/* Botón secundario */
.wg-btn-secondary {
  /* completar según DESIGN.md */
}

/* Botón outline */
.wg-btn-outline {
  background: transparent;
  border: 2px solid var(--color-accent);
  color: var(--color-accent);
  /* resto igual que wg-btn-primary sin bg */
}

/* Card base */
.wg-card {
  background: var(--color-surface);
  border-radius: var(--radius-lg);
  border: 1px solid var(--color-border);
  padding: var(--space-md);
  transition: transform var(--transition-slow), box-shadow var(--transition-slow);
}
.wg-card:hover {
  transform: translateY(-4px);
  box-shadow: var(--shadow-lg);
}

/* =============================================
   ANIMACIONES — Progressive Enhancement
   ============================================= */

/* Sin .js: contenido siempre visible */
[data-reveal] { transition: opacity 0.7s ease, transform 0.7s cubic-bezier(0.22, 1, 0.36, 1); }

/* Con .js: ocultar antes de animar */
.js [data-reveal]            { opacity: 0; transform: translateY(24px); will-change: opacity, transform; }
.js [data-reveal="left"]     { transform: translateX(-32px); }
.js [data-reveal="right"]    { transform: translateX(32px); }
.js [data-reveal].is-visible { opacity: 1; transform: none; }

[data-delay="1"] { transition-delay: 100ms; }
[data-delay="2"] { transition-delay: 200ms; }
[data-delay="3"] { transition-delay: 300ms; }
[data-delay="4"] { transition-delay: 400ms; }

@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration:  0.01ms !important;
    transition-duration: 0.01ms !important;
  }
  [data-reveal] { opacity: 1 !important; transform: none !important; }
}

/* =============================================
   OVERRIDES DE ELEMENTOR (si son necesarios)
   ============================================= */
.elementor-widget-heading .elementor-heading-title {
  font-family: var(--font-display);
  text-wrap: balance;
}

.elementor-widget-text-editor p {
  font-family: var(--font-body);
  line-height: 1.65;
}
```

### Paso 3 — Generar `wp-theme/functions.php`

```php
<?php
/**
 * Functions del child theme de [Cliente]
 * Generado con WebGen
 */

/**
 * Enqueue scripts y estilos
 */
function webgen_enqueue_assets() {

    // Google Fonts con preconnect (declarado en el theme header)
    wp_enqueue_style(
        'webgen-fonts',
        'https://fonts.googleapis.com/css2?family=[Fuente1]:wght@[pesos]&family=[Fuente2]:wght@[pesos]&display=swap',
        [],
        null
    );

    // Estilos del child theme (design tokens + componentes)
    wp_enqueue_style(
        'webgen-theme',
        get_stylesheet_directory_uri() . '/style.css',
        [ 'webgen-fonts' ],
        '1.0.0'
    );

    // GSAP core
    wp_enqueue_script(
        'gsap',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js',
        [],
        '3.12.7',
        true  // en el footer
    );

    // GSAP ScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js',
        [ 'gsap' ],
        '3.12.7',
        true
    );

    // Lenis smooth scroll
    wp_enqueue_script(
        'lenis',
        'https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js',
        [],
        '1.1.14',
        true
    );

    // JS principal del tema
    wp_enqueue_script(
        'webgen-main',
        get_stylesheet_directory_uri() . '/js/main.js',
        [ 'gsap', 'gsap-scrolltrigger', 'lenis' ],
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'webgen_enqueue_assets' );

/**
 * Theme supports
 */
function webgen_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'gallery',
        'caption',
        'style',
        'script',
    ]);
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'webgen_theme_setup' );

/**
 * Agregar preconnect de Google Fonts en el <head>
 */
function webgen_preconnect_fonts() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'webgen_preconnect_fonts', 1 );
```

### Paso 4 — Generar `wp-theme/main.js`

```javascript
(function () {
  'use strict';

  /* ── Progressive enhancement ── */
  document.documentElement.classList.add('js');

  /* ── Lenis smooth scroll ── */
  const lenis = new Lenis({
    lerp: 0.08,
    smoothWheel: true,
  });

  /* ── GSAP + Lenis integration ── */
  gsap.registerPlugin(ScrollTrigger);
  lenis.on('scroll', ScrollTrigger.update);
  gsap.ticker.add((time) => lenis.raf(time * 1000));
  gsap.ticker.lagSmoothing(0);

  /* ── Scroll reveal ── */
  document.querySelectorAll('[data-reveal]').forEach((el) => {
    const dir = el.dataset.reveal || 'up';
    const from = dir === 'left'  ? { x: -32, opacity: 0 }
               : dir === 'right' ? { x:  32, opacity: 0 }
               :                   { y:  24, opacity: 0 };

    gsap.from(el, {
      ...from,
      duration: 0.8,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: el,
        start: 'top 85%',
        once: true,
        onEnter: () => el.classList.add('is-visible'),
      },
    });
  });

  /* ── Stagger para grids con clase .wg-stagger ── */
  document.querySelectorAll('.wg-stagger').forEach((parent) => {
    const children = parent.children;
    gsap.from(children, {
      opacity: 0,
      y: 32,
      stagger: 0.08,
      duration: 0.7,
      ease: 'power2.out',
      scrollTrigger: { trigger: parent, start: 'top 80%', once: true },
    });
  });

  /* ── Header scroll ── */
  const header = document.querySelector('header, .site-header, #site-header');
  if (header) {
    ScrollTrigger.create({
      start: 'top -60',
      onUpdate: (self) => header.classList.toggle('scrolled', self.scroll() > 60),
    });
  }

  /* ── Compatibilidad Elementor ── */
  // Si Elementor recarga widgets dinámicamente, re-inicializar ScrollTrigger
  if (window.elementorFrontend) {
    window.addEventListener('elementor/frontend/init', () => {
      ScrollTrigger.refresh();
    });
  }

})();
```

### Paso 5 — Presentación al cliente

Entregar los 3 archivos con instrucciones de instalación:

```
Aquí están los archivos del theme para WordPress.

INSTALACIÓN:
1. Subir /wp-theme/style.css   → raíz del child theme
2. Subir /wp-theme/functions.php → raíz del child theme (merge con el existente)
3. Crear carpeta /js/ en el child theme y subir main.js
4. Activar el child theme en WordPress → Apariencia → Temas

CON ESTO LISTO:
✅ Los tokens de color y tipografía aplican en todo el sitio
✅ GSAP + Lenis cargados en todas las páginas
✅ Animaciones funcionan agregando data-reveal en Elementor
✅ Podemos arrancar a construir las páginas en Elementor

¿Algún ajuste antes de avanzar?
```

**⛔ NO generar guías de Elementor hasta recibir aprobación del WP Theme.**
  outputs:
    primary: home.html
    secondary: [css/theme.css, scripts/main.js]
  craft:
    requires: [typography, animations, seo-geo, anti-slop]
---

# home-gen — Fase 3: UIKit aprobado → home.html

## Objetivo

Generar `home.html` — la página de inicio completa, con diseño basado en el UIKit aprobado, SEO+GEO optimizado, animaciones GSAP+Lenis, y copys del brief.

---

## Prerequisito

**Verificar que UIKit fue aprobado.** Si no, responder:
> "Para crear el home necesito primero el UIKit aprobado. ¿Generamos el UIKit ahora? (skill: uikit-gen)"

---

## Inputs necesarios antes de generar

Preguntar al cliente (en una sola respuesta):

```
Para generar el home necesito:

1. **Copys principales**
   → Headline del hero (o dare libertad de propuesta)
   → Subheadline / lead del hero
   → Propuesta de valor en 1 oración

2. **Secciones que incluir**
   → ¿Hay sección de precios?
   → ¿Testimonials reales o placeholders?
   → ¿Logos de clientes para social proof?

3. **CTAs**
   → ¿Cuál es el CTA principal? (Ej: "Agendar consultoría")
   → ¿A dónde enlaza? (formulario, WhatsApp, email, página)

4. **Keyword principal SEO**
   → ¿Cómo buscaría Google a esta empresa? (Ej: "agencia de marketing digital Chile")

5. **Dominio definitivo** (para canonical y Schema.org)
```

---

## Workflow

### Paso 1 — Leer contexto

1. Leer `DESIGN.md` completo
2. Revisar `uikit.html` para extraer CSS base
3. Verificar todos los tokens y componentes aprobados

### Paso 2 — Extraer CSS a theme.css

Extraer del UIKit los estilos a `css/theme.css`:
- Tokens `:root`
- Reset mínimo
- Tipografía base
- Componentes reutilizables (nav, footer, botones, cards, kicker)
- Animaciones (progressive enhancement)
- Utilities y responsive

### Paso 3 — Generar estructura del home

**Estructura obligatoria:**

```html
<header id="site-header"> <!-- Nav sticky --> </header>
<main id="main-content">
  <section id="hero">       <!-- 1. Hero -->
  <section id="logos">      <!-- 2. Social proof / logos -->
  <section id="features">   <!-- 3. Beneficios / Features -->
  <section id="how">        <!-- 4. Cómo funciona -->
  <section id="proof">      <!-- 5. Testimonials o métricas -->
  [<section id="pricing">]  <!-- 6. Precios (si aplica) -->
  <section id="cta">        <!-- 7. CTA final -->
</main>
<footer id="site-footer"> <!-- Footer --> </footer>
```

### Paso 4 — Implementar cada sección

#### 1. Header / Nav

```html
<header id="site-header" class="site-header" role="banner">
  <div class="container">
    <nav class="nav" aria-label="Navegación principal">
      <a href="/" class="nav-logo" aria-label="[Marca] — Inicio">
        <img src="/img/logo.svg" alt="[Marca]" width="120" height="40">
      </a>
      <ul class="nav-links" role="list">
        <li><a href="#features">Servicios</a></li>
        <li><a href="#how">Proceso</a></li>
        <!-- ... según el brief -->
      </ul>
      <a href="#cta" class="btn-primary nav-cta">[CTA principal]</a>
      <button class="nav-toggle" aria-expanded="false" aria-label="Abrir menú">
        <span></span><span></span><span></span>
      </button>
    </nav>
  </div>
</header>
```

#### 2. Hero

Reglas del hero:
- `min-height: 85vh` o full screen si el brief lo pide
- H1 con keyword principal + palabra de acento en span de color
- Lead paragraph con propuesta de valor clara
- CTA principal (primary) + CTA secundario (outline)
- Visual: imagen/video/ilustración a la derecha en desktop
- `data-reveal` con stagger para la entrada

#### 3. Logos / Social proof

- Escala reducida (padding ~48px vertical)
- Logos en fila, opacity 0.5, grayscale → color en hover
- "Confiado por [N] empresas" o "Como lo usan:"

#### 4. Features / Beneficios

- Kicker badge + H2 centrado + párrafo intro
- Grid de 3 feature cards (o 4 en 2x2)
- Cada card: [icono/número] + H3 + párrafo + link opcional

#### 5. Cómo funciona / Proceso

- Steps numerados (3–5 pasos)
- Desktop: horizontal flow / Mobile: vertical stack
- Descripción breve de cada paso

#### 6. Testimonials / Prueba social

- 3 testimonials (o placeholder con estructura)
- Cada uno: quote + nombre + rol + empresa
- Rating de estrellas opcional

#### 7. CTA Final

- Fondo de acento o dark
- H2 con propuesta de valor resumida
- Párrafo de refuerzo
- CTA primary + CTA outline (opcional)
- Sin distracción — solo el CTA

#### 8. Footer

- Logo + descripción corta (entidad GEO)
- 3–4 columnas: navegación, servicios, contacto
- Copyright + legal links
- Social links (si existen)

### Paso 5 — SEO + GEO

Ver `/craft/seo-geo.md` para checklist completo.

**HEAD obligatorio:**
```html
<title>[Keyword principal] | [Marca]</title>
<meta name="description" content="[150-160 chars]">
<link rel="canonical" href="https://[dominio]/">
<!-- Open Graph -->
<!-- Twitter Card -->
<!-- Schema.org: WebPage + Organization -->
```

**Bloque de entidad GEO** (primer párrafo visible del hero o intro):
```html
<p class="hero-lead">
  [Marca] es [categoría de negocio] que ayuda a [audiencia]
  a [resultado] en [mercado].
</p>
```

### Paso 6 — Animaciones GSAP

Generar `scripts/main.js` con:
1. Setup de Lenis (smooth scroll)
2. Hero entrance timeline
3. Scroll reveal para secciones
4. Stagger para grids de cards
5. Header scroll behavior
6. Mobile nav toggle

Ver `/craft/animations.md` para los patrones exactos.

### Paso 7 — Responsive

- Mobile-first en todo el CSS
- Nav: hamburger en < 768px
- Hero: columna única en < 640px
- Grids → 1 columna en móvil, 2 en tablet

### Paso 8 — Presentación al cliente

Entregar:
- `home.html` — página completa
- `css/theme.css` — extraído del UIKit
- `scripts/main.js` — animaciones

Presentar con:
> "Aquí está el home completo. Antes de avanzar a páginas internas, confirmame que:"
> 1. ✅ El diseño se ve correctamente en desktop y móvil
> 2. ✅ El headline del hero comunica bien la propuesta de valor
> 3. ✅ Los CTAs están claros y en los lugares correctos
> 4. ✅ Las animaciones se sienten apropiadas
> 5. ✅ El SEO metadata es correcto (title, description)

**⛔ NO generar páginas internas hasta recibir aprobación explícita del home**

---

## Calidad del output

- Lighthouse score objetivo: Performance 90+, SEO 100, Accessibility 90+
- Sin errores de consola
- Funcional offline (sin dependencias de API externas críticas)
- Imágenes con placeholder + comentario de prompt para generarlas
- Mobile: menú, formularios y CTAs 100% usables con el dedo
