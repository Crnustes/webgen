---
name: page-gen
description: |
  Fase 4+: Genera el archivo HTML real de cada página usando el design system aprobado.
  Lee el copy desde _copy/[slug-pagina].md o lo pide al usuario si no existe.
  Prerequisito estricto: wp-theme/style.css debe existir en proyectos/[slug]/.
  Trigger: "crear página [nombre]", "generar [about/servicio/contacto]", "html de [página]".
triggers:
  - "crear página"
  - "generar página"
  - "html de"
  - "página de about"
  - "página de servicio"
  - "página de contacto"
  - "crear about"
  - "crear servicio"
  - "quiero la página de"
od:
  mode: code
  outputs:
    primary: "[slug-pagina].html"
  design_system:
    requires: true
    sections: [color, typography, components, layout, responsive]
  craft:
    requires: [typography, animations, seo-geo, anti-slop]
  inputs:
    - name: slug_proyecto
      type: string
      required: true
    - name: page_type
      type: enum
      values: [home, about, servicio, contacto, casos, landing, custom]
      required: true
    - name: slug_pagina
      type: string
      required: true
    - name: keyword
      type: string
      required: true
---

# page-gen — Fase 4: WP Theme aprobado → HTML real por página

## Objetivo

Generar el **archivo HTML real** de cada página del sitio. El archivo:
- Referencia `wp-theme/style.css` y usa clases `.wg-*` del design system aprobado
- Incluye el copy pre-aprobado desde `_copy/[slug-pagina].md` (o recopilado inline)
- Es una **preview navegable** del diseño final — referencia para construir en Elementor
- Incluye SEO meta tags y Schema.org JSON-LD completos

> El HTML **no reemplaza** la construcción en Elementor Pro.  
> Es el diseño aprobado que el equipo usa de referencia al construir en WordPress.

---

## Prerequisito

**Verificar que `proyectos/[slug-proyecto]/wp-theme/style.css` existe.** Si no, responder:
> "Para generar el HTML necesito el WP Theme aprobado. ¿Lo generamos ahora? (skill: wp-theme-gen)"

---

## Inputs necesarios antes de generar

```
1. Slug del proyecto: (carpeta en proyectos/, ej: "empresa-abc")
2. Tipo de página: [home / about / servicio / contacto / casos / landing]
3. Slug de la página: (ej: "about", "servicios/seo", "contacto")
4. Keyword principal SEO: ___
5. Dominio del sitio: (para canonical y Schema.org)
```

Luego verificar `proyectos/[slug-proyecto]/_copy/[slug-pagina].md`:
- **Existe →** leer ese archivo y usar su copy para el HTML
- **No existe →** preguntar los copys al usuario:

```
Para la página [tipo] necesito:
→ H1 de la página
→ Lead / subheadline (2-3 oraciones)
→ Copy por sección (cuantas apliquen al tipo)
→ FAQ mínimo 5 preguntas (obligatorio)
→ CTA final: texto del botón + página de destino
```

---

## Workflow

### Paso 1 — Leer DESIGN.md y WP Theme

1. Leer `proyectos/[slug-proyecto]/DESIGN.md` — extraer tokens de color, tipografía, spacing
2. Leer `proyectos/[slug-proyecto]/wp-theme/style.css` — confirmar clases `.wg-*` disponibles
3. Si existe `_copy/[slug-pagina].md` — leer y extraer copy por sección

### Paso 2 — Estructura por tipo de página

#### Tipo: `home`
```
Hero (H1 + lead + CTA principal)
Logos / Social proof (si hay)
Beneficios / Features (3-4 cards)
Cómo funciona / Proceso (3-5 pasos)
Testimonials o métricas
CTA final
```

#### Tipo: `about`
```
Hero (H1 + lead + stats clave)
Historia / Origen
Valores o pilares (3-5)
Equipo (si hay fotos)
Por qué elegirnos
FAQ (mínimo 5 preguntas)
CTA final
```

#### Tipo: `servicio`
```
Hero oscuro (H1 + lead + CTA)
El problema / Pain points
Beneficios / Qué incluye (3-4 features en cards)
Proceso (4-5 pasos numerados)
Estadísticas o datos del sector
CTA final
FAQ (mínimo 5 — Schema FAQPage obligatorio)
```

#### Tipo: `contacto`
```
Hero pequeño (H1 + lead)
Formulario HTML (action="#" — en WP usa Elementor Form)
Datos alternativos (email, WhatsApp, horario)
FAQ breve (3-5 preguntas sobre el proceso)
```

#### Tipo: `landing`
```
Hero con CTA inmediato (above the fold)
El problema (breve)
Solución / Beneficios (3 puntos)
Prueba social (logos o testimonial)
CTA repetido
FAQ corto (3-5 preguntas)
```

### Paso 3 — Generar el HTML completo

**CREAR el archivo `proyectos/[slug-proyecto]/[slug-pagina].html`** con este HTML:

```html
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>[Título SEO — 50-60 chars] | [Marca]</title>
  <meta name="description" content="[Meta description 150-160 chars con keyword]">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://[dominio]/[slug-pagina]/">
  <meta property="og:type" content="website">
  <meta property="og:title" content="[Título] | [Marca]">
  <meta property="og:description" content="[Descripción]">
  <meta property="og:url" content="https://[dominio]/[slug-pagina]/">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=[fuentes-del-DESIGN.md]&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="wp-theme/style.css">
  <script type="application/ld+json">{ "@context": "https://schema.org", "@graph": [ /* ver Paso 4 */ ] }</script>
</head>
<body>

<!-- PREVIEW HEADER (en WP lo construye Elementor Pro) -->
<header style="position:sticky;top:0;z-index:100;background:var(--color-bg);border-bottom:1px solid var(--color-border);padding:16px 0;">
  <div class="wg-container" style="display:flex;align-items:center;justify-content:space-between;">
    <strong style="font-family:var(--font-display);font-size:1.2rem;">[Marca]</strong>
    <nav style="display:flex;gap:var(--space-sm);">
      <a href="index.html">Inicio</a>
      <a href="about.html">Nosotros</a>
      <a href="#contacto">Contacto</a>
    </nav>
    <a href="#contacto" class="wg-btn-primary" style="padding:10px 20px;">[CTA nav]</a>
  </div>
</header>

<main id="main-content">

  <!-- HERO -->
  <section class="wg-section" id="hero" data-reveal="up">
    <div class="wg-container">
      <span class="wg-kicker">[Kicker texto]</span>
      <h1>[H1 con keyword principal — entidad GEO: "[Marca] es [categoría] que ayuda a [audiencia] en [mercado]"]</h1>
      <p>[Lead — 2-3 oraciones que refuerzan el H1]</p>
      <div style="display:flex;gap:var(--space-sm);flex-wrap:wrap;margin-top:var(--space-md);">
        <a href="#contacto" class="wg-btn-primary">[CTA principal]</a>
        <a href="#features" class="wg-btn-outline">[CTA secundario]</a>
      </div>
    </div>
  </section>

  <!-- SECCIONES según tipo de página y copy recibido -->
  <!-- Alternar: .wg-section y .wg-section.wg-section--subtle -->

  <!-- EJEMPLO: sección con cards (features, beneficios, proceso) -->
  <section class="wg-section wg-section--subtle" id="features" data-reveal="up">
    <div class="wg-container">
      <span class="wg-kicker">[Kicker]</span>
      <h2>[Título de sección]</h2>
      <p>[Párrafo intro opcional]</p>
      <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:var(--space-md);margin-top:var(--space-lg);" class="wg-stagger">
        <article class="wg-card" data-delay="1">
          <h3>[Título]</h3>
          <p>[Descripción]</p>
        </article>
        <article class="wg-card" data-delay="2">
          <h3>[Título]</h3>
          <p>[Descripción]</p>
        </article>
        <article class="wg-card" data-delay="3">
          <h3>[Título]</h3>
          <p>[Descripción]</p>
        </article>
      </div>
    </div>
  </section>

  <!-- FAQ (obligatorio en about y servicio) -->
  <section class="wg-section" id="faq" data-reveal="up">
    <div class="wg-container">
      <h2>Preguntas frecuentes</h2>
      <div style="max-width:720px;margin-top:var(--space-lg);" class="wg-stagger">
        <details style="border-bottom:1px solid var(--color-border);padding:var(--space-sm) 0;" open>
          <summary style="cursor:pointer;font-weight:600;">[Pregunta 1]</summary>
          <p style="margin-top:var(--space-xs);color:var(--color-text-muted);">[Respuesta directa]</p>
        </details>
        <!-- mínimo 5 preguntas -->
      </div>
    </div>
  </section>

  <!-- CTA FINAL -->
  <section class="wg-section wg-section--dark" id="contacto" data-reveal="up">
    <div class="wg-container" style="text-align:center;">
      <h2>[Título del CTA]</h2>
      <p>[Refuerzo — por qué actuar ahora]</p>
      <a href="#" class="wg-btn-primary" style="margin-top:var(--space-md);display:inline-block;">[Texto del CTA]</a>
    </div>
  </section>

</main>

<!-- PREVIEW FOOTER (en WP lo construye Elementor Pro) -->
<footer style="background:var(--color-bg-subtle);padding:var(--space-lg) 0;border-top:1px solid var(--color-border);">
  <div class="wg-container">
    <p style="font-family:var(--font-display);font-weight:700;">[Marca]</p>
    <p style="color:var(--color-text-muted);margin-top:var(--space-xs);">[Descripción breve]</p>
    <p style="margin-top:var(--space-md);color:var(--color-text-muted);font-size:var(--text-sm);">© [Año] [Marca]. Todos los derechos reservados.</p>
  </div>
</footer>

<!-- GSAP + Lenis via CDN (en WP los carga functions.php) -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js"></script>
<script defer src="wp-theme/main.js"></script>
</body>
</html>
```

**Reglas de implementación:**
- Usar copy de `_copy/[slug-pagina].md` o el proporcionado inline para todas las secciones
- Adaptar secciones al tipo de página — no generar secciones sin copy real
- `data-reveal="up"` en todas las secciones, `data-delay="1/2/3"` en grids para stagger
- La entidad GEO (definición de la empresa) va en el primer párrafo del hero

### Paso 4 — Schema.org JSON-LD

**Todas las páginas** — incluir en `<head>`:
```json
{
  "@context": "https://schema.org",
  "@graph": [
    { "@type": "WebPage", "name": "[Título SEO]", "description": "[Meta description]", "url": "https://[dominio]/[slug-pagina]/" },
    { "@type": "Organization", "name": "[Marca]", "url": "https://[dominio]/", "logo": "https://[dominio]/[ruta-logo]" }
  ]
}
```

**Páginas de servicio — agregar al @graph:**
```json
{ "@type": "Service", "name": "[Nombre del servicio]", "description": "[Descripción]", "provider": { "@type": "Organization", "name": "[Marca]" }, "areaServed": "[País/Región]" }
```

**About y servicio — FAQPage obligatorio (JSON-LD separado en `<head>`):**
```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    { "@type": "Question", "name": "[Pregunta 1]", "acceptedAnswer": { "@type": "Answer", "text": "[Respuesta directa, 2-4 oraciones]" } }
  ]
}
```

### Paso 5 — Confirmar creación del archivo

Confirmar con:
```
✅ Creado: proyectos/[slug-proyecto]/[slug-pagina].html
Para previsualizar: abrir en el navegador.
Este HTML es la referencia de diseño para construir en Elementor.
```

---

## Reglas de consistencia

| Elemento | Regla |
|---|---|
| Tokens CSS | `wp-theme/style.css` — nunca valores inline excepto layout |
| Kickers | Clase `.wg-kicker` |
| Botones | `.wg-btn-primary` o `.wg-btn-secondary` |
| Secciones | `.wg-section` + `.wg-section--subtle` alternando |
| Containers | `.wg-container` siempre dentro de `<section>` |
| Animaciones | `data-reveal="up"` en secciones, `data-delay="1/2/3"` en grids |
| FAQ | Obligatorio (Schema FAQPage) en about y servicio |
| Entidad GEO | Primer párrafo = definición de la empresa |
| H1 | Único por página, contiene la keyword principal |