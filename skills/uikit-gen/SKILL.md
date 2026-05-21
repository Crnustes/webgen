---
name: uikit-gen
description: |
  Fase 2: Genera uikit.html con todos los componentes del design system.
  Prerequisito estricto: DESIGN.md aprobado por el cliente.
  Trigger: "crear uikit", "generar uikit", "generar sistema visual", "quiero ver los componentes".
triggers:
  - "crear uikit"
  - "generar uikit"
  - "sistema visual"
  - "quiero ver los componentes"
  - "uikit listo"
od:
  mode: prototype
  preview:
    type: html
    entry: uikit.html
  design_system:
    requires: true
    sections: [color, typography, components, layout, depth]
  outputs:
    primary: uikit.html
  craft:
    requires: [typography, animations, anti-slop]
---

# uikit-gen — Fase 2: DESIGN.md → uikit.html

## Objetivo

Generar un `uikit.html` que muestre TODOS los componentes del sistema de diseño visualmente. Es la biblia visual del proyecto — el cliente lo aprueba antes de tocar las páginas reales.

---

## Prerequisito

**Verificar que existe `DESIGN.md` aprobado.** Si no existe, responder:
> "Para generar el UIKit primero necesito el DESIGN.md aprobado. ¿Empezamos con el Brand Intake? (skill: brand-intake)"

---

## Workflow

### Paso 1 — Leer DESIGN.md

1. Extraer todos los tokens de color con sus valores
2. Extraer familias tipográficas y la escala
3. Extraer border-radius, spacing, shadow tokens
4. Notar el tono visual (dark/light, formal/playful)
5. Verificar que todos los colores cumplen contraste

### Paso 2 — Generar uikit.html

El UIKit es un **single HTML file** auto-contenido. Estructura:

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Meta, fonts del DESIGN.md -->
  <style>
    /* ── Tokens del DESIGN.md ── */
    :root { /* todos los --variables */ }
    
    /* ── Reset mínimo ── */
    /* ── Typography base ── */
    /* ── Layout utilities ── */
    /* ── Todos los componentes ── */
    /* ── Animaciones (progressive enhancement) ── */
  </style>
</head>
<body>
  <!-- Sección por sección, con nav interna -->
</body>
</html>
```

### Paso 3 — Secciones del UIKit (en orden)

Generar TODAS estas secciones, sin excepción:

#### 01 · Paleta de colores
- Swatches de cada token con nombre, valor hex, y descripción de uso
- Mostrar texto sobre cada color para verificar contraste visualmente

#### 02 · Tipografía
- Display/Hero font — todos los pesos disponibles
- Escala completa: hero, h1, h2, h3, h4, body-l, body, small, label, caption
- Ejemplos de heading con acento de color
- Ejemplo de párrafo completo con links y strong

#### 03 · Botones
- primary, secondary, outline, ghost, destructive
- Todos los tamaños: sm, md, lg
- Estados: default, hover, focus, disabled, loading
- Botón solo con icono (icon-only)

#### 04 · Formularios
- Input de texto con todos sus estados
- Textarea
- Select
- Checkbox
- Radio group
- Toggle switch
- Formulario completo de ejemplo

#### 05 · Badges, Tags, Chips
- Kicker badge (eyebrow text)
- Status badges (success, warning, error, neutral)
- Tag/chip con X para cerrar
- Pills numeradas

#### 06 · Cards
- Card default (borde sutil)
- Card elevated (sombra en hover)
- Card dark/inverted
- Card con imagen
- Card horizontal
- Feature card (icono o número + title + text)
- Stat card (número grande + label)

#### 07 · Navegación
- Desktop nav: logo + links + CTA
- Mobile nav: hamburger + overlay menu (funcional con JS mínimo)
- Breadcrumb

#### 08 · Hero — 2 variantes
- Hero variante A: texto izquierda + imagen derecha
- Hero variante B: centrado full-width con visual de fondo

#### 09 · Sección de Features
- Grid 3 columnas con cards de feature
- Lista vertical con icon + title + text

#### 10 · Stats / Métricas
- Grid de números grandes con labels

#### 11 · Testimonials / Social proof
- Testimonial card con avatar + nombre + rol + texto
- Logo strip (logos de clientes)

#### 12 · Proceso / Steps
- Steps horizontales numerados
- Steps verticales

#### 13 · CTA sections
- CTA inline (dentro de sección)
- CTA full-width con fondo de acento
- CTA dark

#### 14 · FAQ Accordion
- Accordion con `<details>/<summary>`
- Animación CSS de apertura (grid-template-rows trick)

#### 15 · Footer
- Footer completo: logo + descripción + nav links + CTA
- Footer bottom: copyright + legal links

#### 16 · Animaciones
- Showcase de scroll reveal (con botón "trigger" para ver sin scroll)
- Hover states en cards y botones
- Nav header scroll behavior

### Paso 4 — Nav interna del UIKit

```html
<nav class="uikit-nav">
  <!-- Links a cada sección con smooth scroll -->
  <a href="#colors">Colores</a>
  <a href="#typography">Tipografía</a>
  <a href="#buttons">Botones</a>
  <!-- ... -->
</nav>
```

### Paso 5 — Incluir GSAP + Lenis

```html
<!-- Animaciones de ejemplo funcionales en el UIKit -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js"></script>
```

### Paso 6 — Presentación al cliente

Presentar `uikit.html` con:
1. "Aquí está el sistema visual completo. Antes de avanzar al home, revisá:"
2. ✅ Colores — ¿se ven bien en pantalla?
3. ✅ Tipografía — ¿los tamaños y pesos se sienten correctos?
4. ✅ Botones — ¿el primario tiene suficiente presencia?
5. ✅ Cards — ¿el estilo es el que buscaban?
6. ✅ Animaciones — ¿la velocidad y suavidad se sienten bien?

**⛔ NO generar home.html hasta recibir aprobación del UIKit**

---

## Calidad del output

El `uikit.html` debe:
- Ser visualmente hermoso (no un dump técnico)
- Tener secciones bien separadas y legibles
- Incluir labels descriptivos sobre cada componente
- Funcionar en móvil (responsive)
- Tener interacciones reales (hover, focus, accordion)
- Cargar en < 3 segundos (sin imágenes externas grandes)
- NO tener inline CSS fuera de los tokens de `:root` — todo en `<style>`
