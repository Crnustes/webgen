---
name: page-gen
description: |
  Fase 4+: Genera guías de construcción para Elementor Pro + CSS snippets por página.
  NO genera HTML standalone. Genera instrucciones sección por sección + CSS listo para pegar.
  Prerequisito estricto: WP Theme aprobado.
  Trigger: "crear página [nombre]", "guía para [about/servicio/contacto]", "armar [página]".
triggers:
  - "crear página"
  - "guía para"
  - "armar página"
  - "página de about"
  - "página de servicio"
  - "página de contacto"
  - "crear about"
  - "crear servicio"
  - "quiero la página de"
od:
  mode: guide
  outputs:
    primary: pages/[slug]-guide.md
  design_system:
    requires: true
    sections: [color, typography, components, layout, responsive]
  craft:
    requires: [typography, animations, seo-geo, anti-slop]
  inputs:
    - name: page_type
      type: enum
      values: [about, servicio, contacto, casos, landing, custom]
      required: true
    - name: slug
      type: string
      required: true
    - name: keyword
      type: string
      required: true
---

# page-gen — Fase 4: WP Theme aprobado → guías Elementor

## Objetivo

Generar una **guía de construcción para Elementor Pro** por cada página del sitio. La guía contiene:
- Sección por sección: qué widgets usar, qué clases aplicar, qué atributos añadir
- CSS snippets listos para pegar en Elementor
- Copys listos para copiar en cada widget
- Schema.org JSON-LD para pegar en widget HTML
- Metadatos SEO para completar en RankMath/Yoast

El header y footer los construye Elementor Pro. La guía **no los incluye**.

---

## Prerequisito

**Verificar que el WP Theme fue aprobado.** Si no, responder:
> "Para crear la guía Elementor necesito el WP Theme aprobado. ¿Generamos el theme ahora? (skill: wp-theme-gen)"

---

## Inputs necesarios antes de generar

```
1. Tipo de página: [about / servicio / contacto / casos / landing / custom]
2. Slug/URL: /[slug]/ (ej: /sobre-nosotros/, /servicios/seo/)
3. Keyword principal SEO: ___
4. Copys:
   → H1 de la página
   → Intro / subheadline
   → Contenido por sección (o dar libertad de propuesta)
5. CTA de la página: ¿a dónde convierte? (formulario / WhatsApp / email)
6. FAQ mínimo 5 preguntas (obligatorio para Schema FAQPage)
```

---

## Workflow

### Paso 1 — Leer DESIGN.md y UIKit

1. Extraer tokens de color, tipografía, espaciado
2. Identificar componentes aprobados del UIKit (kicker, cards, botones, FAQ)
3. Seleccionar el template de estructura según el tipo de página

### Paso 2 — Seleccionar estructura según tipo

#### Tipo: `about`
```
Sección 1: Hero (H1 + lead + stats clave)
Sección 2: Origen / Historia (texto + imagen)
Sección 3: Valores o pilares (3–5 columnas con icon box)
Sección 4: Equipo (si hay fotos)
Sección 5: Por qué elegirnos / Beneficios
Sección 6: CTA intermedio
Sección 7: FAQ (mínimo 5 preguntas)
Sección 8: CTA final
```

#### Tipo: `servicio`
```
Sección 1: Hero oscuro (H1 + lead + CTA)
Sección 2: Pain points / El problema
Sección 3: Beneficios / Qué incluye (3–4 features)
Sección 4: Cómo trabajamos / Proceso (4–5 pasos)
Sección 5: Estadísticas o datos del sector
Sección 6: Resultados o casos (con datos)
Sección 7: CTA final
Sección 8: FAQ (mínimo 5 preguntas — Schema FAQPage obligatorio)
```

#### Tipo: `contacto`
```
Sección 1: Hero pequeño (H1 + lead)
Sección 2: Formulario (Elementor Form widget)
Sección 3: Datos alternativos (email, WhatsApp)
Sección 4: FAQ breve (3–5 preguntas sobre el proceso de contacto)
```

#### Tipo: `landing`
```
Sección 1: Hero con CTA inmediato
Sección 2: Problema (1 sección, breve)
Sección 3: Solución / Beneficios (3 puntos)
Sección 4: Prueba social (logos o testimonial)
Sección 5: CTA repetido
Sección 6: FAQ corto (3–5 preguntas)
```

### Paso 3 — Generar la guía de cada sección

Formato de cada sección en la guía:

```markdown
## Sección [N] — [Nombre]

**Elementor:**
- Tipo: Container (Flexbox) / Section
- Fondo: [color-token o imagen]
- Padding: [valores de DESIGN.md]
- CSS Class: `wg-section [clase-adicional]`
- Attributes (Advanced): `data-reveal | up`

**Widgets:**
1. Heading (H[n])
   - Texto: "[copy]"
   - Tag: H2 (o H1 solo en el hero)
   - CSS Class: (si aplica)
2. Text Editor
   - Texto: "[copy]"
3. Button
   - Texto: "[texto del CTA]"
   - Link: [URL]
   - CSS Class: `wg-btn-primary`

**CSS custom de esta sección:**
Pegar en: Section → Edit → Advanced → Custom CSS
```css
selector {
  /* estilos específicos */
}
```
```

### Paso 4 — CSS global de la página

Generar el CSS que va en **Elementor → Edit Page → Custom CSS** (o Elementor Site Settings → Custom CSS para estilos globales):

```css
/* CSS global de la página [slug] */
/* Pegar en: Edit Page → Page Settings → Custom CSS */

/* Sobreescrituras Elementor específicas de esta página */
.page-[slug] .elementor-widget-heading h1 {
  font-size: var(--text-hero);
}
```

### Paso 5 — Schema.org JSON-LD

Generar snippet listo para pegar en un **widget HTML de Elementor** (no requiere plugin):

**Todas las páginas:**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "name": "[Título SEO]",
      "description": "[Meta description]",
      "url": "https://[dominio]/[slug]/"
    },
    {
      "@type": "Organization",
      "name": "[Marca]",
      "url": "https://[dominio]/",
      "logo": "https://[dominio]/[ruta-logo]"
    }
  ]
}
</script>
```

**Páginas de servicio — agregar al @graph:**
```json
{
  "@type": "Service",
  "name": "[Nombre del servicio]",
  "description": "[Descripción]",
  "provider": { "@type": "Organization", "name": "[Marca]" },
  "areaServed": "[País/Región]"
}
```

**FAQPage — obligatorio en servicio y about:**
```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "¿Qué es [tema]?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "[Respuesta directa, 2–4 oraciones]"
      }
    }
    /* ... mínimo 5 preguntas */
  ]
}
</script>
```

### Paso 6 — Metadatos SEO (RankMath / Yoast)

Generar tabla lista para completar en el plugin SEO:

```
SEO Title (50-60 chars):
[Keyword principal] — [Marca]

Meta Description (150-160 chars):
[Keyword en primeras 30 chars]. [Propuesta de valor]. [CTA suave].

URL / Slug:
/[slug]/

Canonical URL:
https://[dominio]/[slug]/

Focus Keyword:
[keyword principal]

OG Image:
[Descripción de la imagen recomendada, 1200x630px]
```

### Paso 7 — Bloque de entidad GEO

Primer texto visible de la página (pegar en primer widget Text Editor):

```
[Marca] es [categoría de negocio] especializada en [diferenciador]
que ayuda a [audiencia] a [resultado concreto] en [mercado/región].
```

---

## Cómo aplicar `data-reveal` en Elementor

Para cada sección o widget que deba animarse:
1. Editar elemento → **Advanced**
2. Expandir **Attributes**
3. Agregar: `data-reveal` | `up` (o `left`, `right`)
4. Opcional: `data-delay` | `1` (para stagger manual: 1, 2, 3, 4)

El `main.js` del theme detecta estos atributos y anima automáticamente con GSAP.

---

## Reglas de consistencia obligatorias

| Elemento | Regla |
|---|---|
| Tokens CSS | Siempre los mismos de `style.css` del theme |
| Kickers | Clase `.wg-kicker` en CSS Class del widget |
| Botones | Clase `.wg-btn-primary` o `.wg-btn-secondary` |
| Tipografía | Configurar en Elementor Site Settings para heredar del theme |
| Schema FAQPage | Obligatorio en todas las páginas de servicio y about |
| Bloque GEO | Obligatorio como primer texto visible de cada página |
    requires: true
    sections: [color, typography, components, layout, responsive]
  outputs:
    primary: "[slug].html"
  craft:
    requires: [typography, animations, seo-geo, anti-slop]
  inputs:
    - name: page_type
      type: enum
      values: [about, servicio, contacto, casos, blog-post, landing, custom]
      required: true
    - name: slug
      type: string
      required: true
    - name: keyword
      type: string
      required: true
---

# page-gen — Fase 4: Home aprobado → páginas internas

## Objetivo

Generar páginas internas individuales, consistentes con el home aprobado, con SEO+GEO completo y animaciones.

---

## Prerequisito

**Verificar que home.html fue aprobado.** Si no, responder:
> "Para crear páginas internas necesito el home aprobado primero. ¿Aprobás el home y avanzamos?"

---

## Inputs necesarios (preguntar antes de generar)

```
Para crear la página [tipo] necesito:

1. **Slug/URL** → /[slug]/ (ej: /sobre-nosotros/, /servicios/seo/)

2. **Keyword principal SEO**
   → ¿Cómo buscaría Google esta página?

3. **Copy principal**
   → Headline de la página (H1)
   → Subheadline / intro
   → Secciones y contenido (puede ser borrador)

4. **CTA de la página**
   → ¿A dónde convierte esta página?

5. **FAQ**
   → ¿Hay preguntas frecuentes específicas de este tema?
   → (Mínimo 5 para Schema FAQPage)
```

---

## Workflow

### Paso 1 — Leer contexto

1. Leer `DESIGN.md` para tokens y estilo
2. Revisar `home.html` para extraer:
   - HTML del `<header>` (nav) — copiar exacto
   - HTML del `<footer>` — copiar exacto
   - CSS variables en uso
   - Estilo de kicker, sección heads, cards
3. Nunca reinventar nav o footer — copiarlos idénticos

### Paso 2 — Seleccionar template por tipo

#### Tipo: `about`

Estructura:
```
Hero (h1 + lead + stats clave)
Origen / Historia
Cómo pensamos / Valores (3–5 pillars)
Equipo (si hay fotos)
Por qué elegirnos / Beneficios
CTA intermedio
FAQ (mínimo 5 preguntas sobre la empresa)
CTA final
```

#### Tipo: `servicio`

Estructura:
```
Hero oscuro (h1 + lead + CTA)
Pain points / El problema (qué pasa sin este servicio)
Beneficios / Qué incluye (3–4 features)
Cómo trabajamos / Proceso (4–5 pasos)
Estadísticas / Datos del sector
Casos o resultados (con datos)
Partner / Tecnología (si aplica)
CTA final
FAQ (mínimo 5 preguntas, obligatorio Schema FAQPage)
```

#### Tipo: `contacto`

Estructura:
```
Hero pequeño (h1 + lead)
Formulario de contacto (nombre, email, mensaje, CTA)
Datos alternativos (email directo, WhatsApp)
Preguntas frecuentes sobre el proceso de contacto
```

#### Tipo: `casos`

Estructura:
```
Hero (h1 sobre resultados)
Grid de casos (cards con cliente, reto, resultado)
Página de caso individual (si se genera una)
CTA
```

#### Tipo: `landing`

Estructura concentrada en conversión:
```
Hero con CTA inmediato
Problema (1 sección, breve)
Solución / Beneficios (3 puntos)
Prueba social (logos o testimonial)
CTA repetido
FAQ corto (3–5 preguntas)
CTA final
```

### Paso 3 — SEO + GEO completo

Ver `/craft/seo-geo.md` para checklist.

**HEAD obligatorio:**
```html
<title>[Keyword específica de esta página] | [Marca]</title>
<meta name="description" content="[150-160 chars, keyword en primeras 30 chars]">
<link rel="canonical" href="https://[dominio]/[slug]/">
<!-- Open Graph + Twitter Card -->
<!-- Schema.org WebPage + Organization -->
<!-- Schema.org Service (en páginas de servicio) -->
<!-- Schema.org FAQPage (OBLIGATORIO en páginas internas) -->
```

**Bloque de entidad GEO** — primer párrafo de la página:
```html
<!-- En about -->
<p>[Marca] es [descripción completa de la empresa con mercado, años, especialidad].</p>

<!-- En servicio -->
<p>[Nombre del servicio] es [definición clara] que [beneficio para audiencia]. 
[Marca] implementa este servicio en [mercado] con [diferenciador].</p>
```

**FAQ Schema** — en TODAS las páginas internas:
```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "¿Qué es [tema principal de la página]?",
      "acceptedAnswer": { "@type": "Answer", "text": "[Respuesta directa, 2–4 oraciones]" }
    },
    {
      "@type": "Question",
      "name": "¿Cómo funciona [servicio/proceso]?",
      "acceptedAnswer": { "@type": "Answer", "text": "[Respuesta con pasos o descripción]" }
    },
    {
      "@type": "Question",
      "name": "¿Por qué elegir [marca] para [tema]?",
      "acceptedAnswer": { "@type": "Answer", "text": "[Respuesta con diferenciadores]" }
    }
    // ... mínimo 5 preguntas
  ]
}
```

### Paso 4 — Consistencia visual

- Nav: idéntico al home (copiar HTML exacto, mismo CSS)
- Footer: idéntico al home (copiar HTML exacto, mismo CSS)
- Kickers: mismo estilo
- Botones: mismas clases
- Secciones: misma alternancia de fondos
- Tipografía: misma escala del DESIGN.md

**NO reinventar estilos** — esta página debe ser visualmente indistinguible en estilo del home.

### Paso 5 — Animaciones

Usar el mismo `scripts/main.js` del home cuando sea posible.  
Si la página necesita interacciones específicas (formulario, tabs, slider), crear `scripts/[slug].js`.

### Paso 6 — Output

Archivos generados:
- `[slug].html` (o `[categoria]/[slug].html`)
- `scripts/[slug].js` solo si tiene JS adicional

### Paso 7 — Presentación

Entregar con breve resumen:
1. Keyword target de la página
2. Schema.org incluido (qué tipos)
3. FAQ (cuántas preguntas)
4. Si hay imágenes con placeholder, indicar los prompts

---

## Reglas de coherencia entre páginas

| Elemento | Regla |
|---|---|
| Nav | 100% idéntico en todas las páginas |
| Footer | 100% idéntico en todas las páginas |
| Botones primary | Misma clase, mismo color |
| Kicker badges | Mismo estilo |
| Sección head (kicker + h2 + párrafo) | Mismo patrón |
| Alternancia de fondos | bg / bg-subtle / bg-dark consistente |
| Font sizes | Misma escala del DESIGN.md |
| Animaciones | Misma velocidad y ease |

---

## Páginas estándar a generar para un sitio completo

| Página | Slug | Schema extra |
|---|---|---|
| Home | `/` | Organization, WebSite |
| About / Nosotros | `/sobre-nosotros/` | AboutPage, FAQPage |
| Servicio 1 | `/servicios/[nombre]/` | Service, FAQPage |
| Servicio 2 | `/servicios/[nombre]/` | Service, FAQPage |
| Casos | `/casos/` | CollectionPage |
| Contacto | `/contacto/` | ContactPage |
