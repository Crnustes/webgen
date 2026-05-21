---
name: home-gen
description: |
  Fase 3: Genera home.html completo con SEO+GEO optimizado.
  Prerequisito estricto: UIKit aprobado. Sin aprobación del UIKit NO generar.
  Trigger: "crear home", "página de inicio", "home page", "generar el home".
triggers:
  - "crear home"
  - "página de inicio"
  - "home page"
  - "generar el home"
  - "quiero el home"
od:
  mode: prototype
  preview:
    type: html
    entry: home.html
  design_system:
    requires: true
    sections: [color, typography, components, layout, depth, responsive]
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
