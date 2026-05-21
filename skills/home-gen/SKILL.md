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
1. Slug del proyecto: (la carpeta en proyectos/, ej: "empresa-abc")
   → Los archivos se crearán en: proyectos/[slug]/wp-theme/

2. ¿Qué theme base usan? (Hello Elementor / Astra / GeneratePress / otro)
   → Necesario para el campo Template: en el header de style.css

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

### Paso 5 — Crear y entregar los archivos del theme

**CREAR** los archivos con el código generado en los pasos anteriores:

1. **`proyectos/[slug]/wp-theme/style.css`** → código del Paso 2
2. **`proyectos/[slug]/wp-theme/functions.php`** → código del Paso 3
3. **`proyectos/[slug]/wp-theme/main.js`** → código del Paso 4

Luego confirmar con las instrucciones de instalación:

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

**⛔ NO generar páginas HTML hasta recibir aprobación del WP Theme.**
