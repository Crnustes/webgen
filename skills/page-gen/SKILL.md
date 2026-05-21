---
name: page-gen
description: |
  Fase 4+: Genera páginas internas individuales.
  Prerequisito estricto: Home aprobado por el cliente.
  Trigger: "crear [página]", "página de [tipo]", "quiero la página de about/servicios/contacto".
triggers:
  - "crear página"
  - "página de about"
  - "página de servicio"
  - "página de contacto"
  - "crear about"
  - "crear servicio"
  - "quiero la página de"
od:
  mode: prototype
  preview:
    type: html
    entry: "[page].html"
  design_system:
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
