# craft/seo-geo.md
> Checklist SEO clásico + GEO (Generative Engine Optimization)  
> Obligatorio en cada página generada.

---

## SEO Clásico — Checklist por página

### HEAD tags

```html
<!-- Obligatorios -->
<title>[Keyword principal] | [Marca]</title>
<!-- Regla: 50–60 chars. Keyword primero, marca al final. Único por página. -->

<meta name="description" content="[150-160 chars con keyword + propuesta de valor + CTA implícito]">
<!-- Única por página. Incluir keyword en las primeras 30 chars. -->

<meta name="robots" content="index, follow">
<link rel="canonical" href="https://[dominio]/[slug]/">

<!-- Open Graph (obligatorio) -->
<meta property="og:type" content="website">
<meta property="og:locale" content="[es_ES | es_MX | en_US | etc]">
<meta property="og:site_name" content="[Marca]">
<meta property="og:title" content="[Título OG — puede variar del title]">
<meta property="og:description" content="[Descripción OG]">
<meta property="og:image" content="https://[dominio]/img/og-[slug].jpg">
<!-- og:image: mínimo 1200x630px, máximo 5MB -->
<meta property="og:url" content="https://[dominio]/[slug]/">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="[Título]">
<meta name="twitter:description" content="[Descripción]">
<meta name="twitter:image" content="https://[dominio]/img/og-[slug].jpg">
```

### Schema.org — JSON-LD

**Toda página (obligatorio):**
```json
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "name": "[Título de página]",
      "description": "[Descripción]",
      "url": "https://[dominio]/[slug]/"
    },
    {
      "@type": "Organization",
      "name": "[Marca]",
      "url": "https://[dominio]/",
      "logo": "https://[dominio]/img/logo.svg",
      "sameAs": [
        "https://www.linkedin.com/company/[handle]",
        "https://twitter.com/[handle]"
      ]
    }
  ]
}
```

**Páginas de servicio (adicional):**
```json
{
  "@type": "Service",
  "name": "[Nombre del servicio]",
  "provider": { "@type": "Organization", "name": "[Marca]" },
  "description": "[2–3 oraciones sobre el servicio]",
  "areaServed": ["[País/región]"],
  "serviceType": "[Categoría del servicio]"
}
```

**FAQ obligatorio en páginas internas:**
```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "¿[Pregunta exactamente como aparece en el HTML]?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "[Respuesta completa en texto plano, 2–4 oraciones]"
      }
    }
  ]
}
```

### Estructura de contenido HTML

```
Una sola <h1> por página ← REGLA CRÍTICA
  ↓
<h2> en cada sección principal
  ↓
<h3> dentro de componentes (cards, items de lista)
  ↓
<h4> para sub-componentes
```

- `<h1>` contiene la keyword principal
- `<h2>` de sección contiene keyword secundaria relacionada
- NO saltar niveles (h1 → h3 sin h2)

### Imágenes

```html
<!-- Toda imagen debajo del fold -->
<img
  src="imagen.webp"
  alt="[Descripción específica que menciona el contexto de negocio]"
  width="[ancho exacto]"
  height="[alto exacto]"
  loading="lazy"
  decoding="async"
>

<!-- Primera imagen del hero (NO lazy) -->
<img
  src="hero.webp"
  alt="[Descripción hero]"
  width="1200" height="675"
  fetchpriority="high"
>
```

**Reglas de `alt`:**
- Descriptivo del contenido visual + contexto de negocio
- ❌ `alt="imagen1.jpg"` 
- ❌ `alt="foto"`
- ✅ `alt="Dashboard de análisis mostrando métricas de conversión de campañas de Google Ads"`

---

## GEO — Generative Engine Optimization

GEO optimiza el contenido para aparecer en respuestas de ChatGPT, Gemini, Perplexity, Claude y otros LLMs.

### Principio fundamental

Los LLMs responden preguntas con fragmentos de texto claros y directos. Tu contenido debe estar **estructurado como respuestas**, no como marketing.

### 1. Definición de entidad (arriba del fold)

Siempre en el primer párrafo visible de la página:

```html
<!-- Template para el bloque de definición de entidad -->
<p>
  [Nombre empresa] es [categoría exacta de negocio] 
  con [N] años de experiencia, especializada en [diferenciador claro],
  que ayuda a [audiencia objetivo] a [resultado concreto]
  en [mercado/país/región].
</p>

<!-- Ejemplo real -->
<p>
  Lemon Digital es una agencia de e-marketing con más de 12 años de experiencia,
  especializada en sistemas de crecimiento digital estructurado,
  que ayuda a empresas B2B y de servicios en LATAM y USA a convertir
  su presencia online en un canal de adquisición medible y escalable.
</p>
```

### 2. FAQ estructurado — OBLIGATORIO en páginas internas

Cada FAQ responde preguntas reales que la gente le haría a una IA:

```
¿Qué es [servicio/concepto]?
¿Para qué sirve [servicio]?
¿Cómo funciona [proceso]?
¿Cuánto cuesta [servicio]?
¿Cuándo necesito [servicio]?
¿Cuál es la diferencia entre [A] y [B]?
¿Quién puede ayudarme a [objetivo]?
```

**Reglas de respuesta en FAQ:**
- Responder directamente en la primera oración (sin preámbulo)
- 2–4 oraciones por respuesta
- Incluir la marca en al menos 1 respuesta natural
- Datos concretos cuando sea posible

### 3. Datos con contexto

| ❌ Genérico | ✅ Con contexto |
|---|---|
| "Amplia experiencia" | "Más de 12 años de experiencia en LATAM" |
| "Muchos clientes" | "Más de 60 empresas en Chile, Colombia, México y USA" |
| "Rápida implementación" | "Sistema funcional en 2 a 4 semanas" |
| "Buenos resultados" | "Aumento promedio de 27% en ingresos con CRM conversacional" |

### 4. Autoridad temática por página

Cada página responde al menos 3 preguntas long-tail:
- "¿Qué es [tema] y para qué sirve?"
- "¿Cómo funciona [proceso] paso a paso?"
- "¿Cuándo necesita mi empresa [solución]?"

### 5. Estructura de contenido óptima para LLMs

```
Título con keyword principal
│
├── Párrafo de definición de entidad (qué + quién + dónde)
│
├── Sección de beneficios (responde: ¿por qué?)
│   └── Lista con bullets o cards con title+descripción
│
├── Sección de proceso (responde: ¿cómo?)
│   └── Pasos numerados (h3 + párrafo)
│
├── Sección de casos/datos (responde: ¿funciona?)
│   └── Estadísticas con contexto o testimonials
│
└── FAQ (responde: preguntas directas del usuario)
    └── Schema FAQPage JSON-LD
```

---

## Core Web Vitals

### LCP (Largest Contentful Paint) — objetivo: < 2.5s

```html
<!-- Precargar la imagen hero (LCP candidate) -->
<link rel="preload" as="image" href="/img/hero.webp" fetchpriority="high">

<!-- La imagen hero NO tiene loading=lazy -->
<img src="/img/hero.webp" fetchpriority="high" alt="...">
```

### CLS (Cumulative Layout Shift) — objetivo: 0

```html
<!-- SIEMPRE definir width y height en imágenes -->
<img src="..." width="600" height="400" alt="...">

<!-- Reservar espacio para embeds -->
<div style="aspect-ratio: 16/9; width: 100%;">
  <iframe src="..." loading="lazy"></iframe>
</div>
```

### FID/INP (Interaction to Next Paint) — objetivo: < 200ms

```javascript
// Scripts con defer (ya incluido en el template)
// No bloquear el main thread con JS pesado al cargar
// Usar requestIdleCallback para tareas no críticas
```

---

## URLs y estructura

- Español o idioma del sitio: `/servicios/seo-posicionamiento/` ✅
- Sin stopwords innecesarias: `/servicios/seo/` > `/servicios/el-mejor-seo/`  
- Guiones, no underscores: `/paid-media/` > `/paid_media/`
- Máximo 3 niveles: `/servicios/[categoria]/[servicio]/`
- Trailing slash consistente (elegir uno y mantenerlo)

---

## Checklist final por página

- [ ] `<title>` único, 50–60 chars, keyword primero
- [ ] `<meta description>` único, 150–160 chars
- [ ] `<link rel="canonical">`
- [ ] Un solo `<h1>`
- [ ] H2 en cada sección con keyword relacionada
- [ ] Open Graph completo (5 tags)
- [ ] Twitter Card
- [ ] Schema.org WebPage + Organization
- [ ] Schema.org Service (en páginas de servicio)
- [ ] Schema.org FAQPage (en páginas internas)
- [ ] Bloque de definición de entidad (primer párrafo)
- [ ] FAQ con ≥ 5 preguntas reales
- [ ] Imágenes con alt descriptivo + width + height
- [ ] Hero image sin `loading="lazy"` + `fetchpriority="high"`
- [ ] Scripts con `defer`
- [ ] `font-display: swap`
