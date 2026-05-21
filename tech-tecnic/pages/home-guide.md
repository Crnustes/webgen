# Tech Tecnic — Home Page Guide
> Generado por WebGen · Fase 4 output
> Plataforma: WordPress + Elementor Pro
> Keyword principal: soporte técnico empresarial
> URL: /

---

## Metadatos SEO

| Campo | Valor |
|---|---|
| **SEO Title** | `Soporte Técnico Empresarial · Tech Tecnic` |
| **Meta Description** | `Tech Tecnic mantiene tu infraestructura tecnológica operando al 100%. Monitoreo proactivo, seguridad activa y respuesta en menos de 15 minutos. Más de 250 empresas confían en nosotros.` |
| **OG Title** | `Tech Tecnic — Infraestructura que no falla` |
| **OG Description** | `Soporte técnico especializado para empresas que no pueden permitirse tiempo de inactividad. Respuesta garantizada en menos de 15 minutos.` |
| **Canonical** | `https://techtecnic.com/` |
| **OG Image** | 1200×630px · imagen del hero o logo sobre fondo dark |

---

## CSS Global de la Página

> Pegar en: **Elementor → Edit Page → Custom CSS**

```css
/* ── Home Page · Tech Tecnic ── */

/* Body dark */
body {
  background-color: var(--color-bg) !important;
  color: var(--color-text) !important;
}

/* Overrides Elementor para fuentes del design system */
.elementor-widget-heading .elementor-heading-title {
  font-family: var(--font-display) !important;
  text-wrap: balance;
}
.elementor-widget-text-editor,
.elementor-widget-text-editor p {
  font-family: var(--font-body) !important;
}
```

---

## Estructura de Secciones

---

### SECCIÓN 1 — Hero

**Tipo Elementor:** Section · Full-width · Sin padding lateral  
**Fondo de sección:** Color `#080809`

#### Widgets (de arriba a abajo, columna izquierda):

| Widget | Contenido | CSS Class | Atributos |
|---|---|---|---|
| Text Editor | `<span class="wg-kicker">Soporte · Infraestructura</span>` | — | — |
| Heading (H1) | Ver copy abajo | `wg-hero-title` | `data-reveal \| up` |
| Text Editor | Párrafo lead | `wg-lead` | `data-reveal \| up` |
| Button group | Ver botones abajo | — | `data-reveal \| up` |

**H1 copy:**
```
Tu empresa no puede
permitirse <em>fallar.</em>
```
> En Elementor usar el widget Heading con HTML tag H1. La palabra "fallar." se colorea con el widget Text Editor o CSS:
```css
.hero-highlight { color: var(--color-accent); }
```

**Párrafo lead:**
```
Tech Tecnic mantiene tu infraestructura tecnológica operando al 100%.
Monitoreo proactivo, seguridad activa y respuesta garantizada
en menos de 15 minutos — los 365 días del año.
```

**Botones:**
- **Primario:** "Hablar con un técnico" → `/contacto/` · CSS class: `wg-btn-primary`
- **Ghost:** "Ver casos de éxito →" → `/casos/` · CSS class: `wg-btn-outline`

**Columna derecha (40%):**
- Widget: Image o HTML
- Imagen técnica (dashboard, isométrico, servidores)
- `alt="Panel de monitoreo de infraestructura Tech Tecnic"` · `loading="eager"` (es above the fold)
- Atributos: `data-reveal | right`

#### CSS de esta sección:
> Pegar en Section → Advanced → Custom CSS

```css
selector {
  min-height: 92vh;
  display: flex;
  align-items: center;
  padding: clamp(80px, 10vw, 140px) 0 clamp(64px, 8vw, 100px);
}
selector .elementor-container {
  width: min(1280px, 92vw);
  margin: 0 auto;
}
selector h1 {
  font-size: var(--text-hero);
  font-weight: 800;
  line-height: 0.93;
  letter-spacing: -0.04em;
  color: var(--color-text-on-dark);
  margin-bottom: 24px;
}
selector .wg-lead {
  font-size: var(--text-lead);
  color: var(--color-text-muted);
  line-height: 1.75;
  max-width: 48ch;
  margin-bottom: 36px;
}
```

---

### SECCIÓN 2 — Social Proof / Logos de clientes

**Tipo Elementor:** Section · Full-width  
**Fondo:** `#0d0d11` (bg default)

#### Contenido:

```
CONFÍAN EN NOSOTROS
[Logo 1] [Logo 2] [Logo 3] [Logo 4] [Logo 5] [Logo 6]
```

| Widget | Contenido | CSS Class |
|---|---|---|
| Text Editor | `<p class="wg-kicker wg-kicker--neutral">Confían en nosotros</p>` | — |
| Image Box (×6) o HTML | Logos en gris/blanco con opacity 0.5 | `wg-logo-item` |

#### CSS de esta sección:

```css
selector {
  padding: clamp(32px, 4vw, 48px) 0;
  border-top: 1px solid rgba(255,255,255,0.06);
  border-bottom: 1px solid rgba(255,255,255,0.06);
}
.wg-logo-item img {
  filter: brightness(0) invert(1);
  opacity: 0.35;
  transition: opacity 200ms ease;
  height: 28px;
  width: auto;
}
.wg-logo-item:hover img {
  opacity: 0.65;
}
.wg-logos-row {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  gap: clamp(24px, 4vw, 48px);
  margin-top: 24px;
}
```

---

### SECCIÓN 3 — Servicios principales

**Tipo Elementor:** Section · Full-width  
**Fondo:** `#13131c`  
**Atributos de sección:** `data-reveal | up`

#### Estructura:

```
[Kicker: SERVICIOS]
[H2: Todo lo que tu infraestructura necesita]
[Lead: Un solo equipo. Todos los frentes cubiertos.]
[Grid 3 columnas — 3 cards]
```

**Copies de cada card:**

**Card 1 — Monitoreo proactivo**
- Kicker: `MONITOREO`
- H3: `Alertas antes de que fallen`
- Body: `Supervisión continua de servidores, servicios y aplicaciones. Detectamos y resolvemos anomalías antes de que impacten a tus usuarios.`
- CSS class en la card: `wg-card-tech`

**Card 2 — Seguridad activa**
- Kicker: `SEGURIDAD`
- H3: `Protección sin pausas`
- Body: `Análisis de vulnerabilidades, parcheo automatizado y respuesta a incidentes en tiempo real. Tu superficie de ataque, siempre bajo control.`
- CSS class: `wg-card-tech`

**Card 3 — Cloud & Infraestructura**
- Kicker: `CLOUD`
- H3: `Infraestructura que escala`
- Body: `Diseño, migración y gestión en AWS, Azure y GCP. Optimización de costos incluida. Cero lock-in, máxima disponibilidad.`
- CSS class: `wg-card-tech`

#### CSS de esta sección:

```css
selector {
  padding: clamp(64px, 8vw, 120px) 0;
}
selector .wg-card-tech {
  background: var(--color-surface);
  border: 1px solid rgba(255,255,255,0.06);
  border-top: 2px solid var(--color-accent);
  border-radius: 0 0 var(--radius-lg) var(--radius-lg);
  padding: 32px;
  height: 100%;
  transition: border-color 200ms ease;
}
selector .wg-card-tech:hover {
  border-color: rgba(var(--color-accent-rgb), 0.4);
}
selector .wg-card-tech h3 {
  font-size: var(--text-h4);
  color: var(--color-text);
  margin-bottom: 12px;
}
selector .wg-card-tech p {
  font-size: var(--text-small);
  color: var(--color-text-muted);
  line-height: 1.65;
  max-width: none;
}
```

> Aplicar atributo Elementor en cada card → Advanced → Attributes:
> `data-reveal | up`

---

### SECCIÓN 4 — Cómo funciona (3 pasos)

**Tipo Elementor:** Section · Full-width  
**Fondo:** `#0d0d11`

#### Estructura:

```
[Kicker: METODOLOGÍA]
[H2: Empezar es simple. Quedarse es la decisión correcta.]
[3 columnas — steps numerados]
```

**Step 1:**
- Número: `01`
- H3: `Auditoría técnica sin costo`
- Body: `Analizamos tu infraestructura actual, identificamos riesgos y te entregamos un informe detallado. Sin compromiso, sin letra chica.`

**Step 2:**
- Número: `02`
- H3: `Plan a tu medida`
- Body: `Diseñamos el esquema de soporte y monitoreo según tu stack, tamaño de equipo y criticidad de servicios.`

**Step 3:**
- Número: `03`
- H3: `Operación inmediata`
- Body: `En menos de 48 horas tu infraestructura está cubierta. Nuestro equipo toma el control — tú retomas el foco en tu negocio.`

#### CSS de esta sección:

```css
selector {
  padding: clamp(64px, 8vw, 120px) 0;
}
.wg-step-number {
  font-family: var(--font-mono);
  font-size: 0.75rem;
  font-weight: 700;
  color: var(--color-accent);
  letter-spacing: 0.08em;
  margin-bottom: 16px;
  display: block;
}
.wg-step-divider {
  width: 40px;
  height: 2px;
  background: var(--color-accent);
  margin-bottom: 20px;
}
selector h3 {
  color: var(--color-text);
  margin-bottom: 12px;
}
selector p {
  color: var(--color-text-muted);
  font-size: var(--text-small);
  line-height: 1.65;
  max-width: none;
}
```

---

### SECCIÓN 5 — Stats

**Tipo Elementor:** Section · Full-width  
**Fondo:** `#080809`

#### Contenido (Grid 4 col):

| Número | Label |
|---|---|
| `99.9%` | Uptime promedio |
| `+250` | Clientes activos |
| `<15min` | Tiempo de respuesta |
| `12 años` | En operación |

> Los números en rojo/acento, el `%` y símbolos en blanco.

#### CSS de esta sección:

```css
selector {
  padding: clamp(48px, 6vw, 80px) 0;
  border-top: 1px solid rgba(255,255,255,0.06);
  border-bottom: 1px solid rgba(255,255,255,0.06);
}
.wg-stat-number {
  font-family: var(--font-display);
  font-size: clamp(2.5rem, 5vw, 4rem);
  font-weight: 800;
  color: var(--color-text);
  font-variant-numeric: tabular-nums;
  line-height: 1;
  letter-spacing: -0.03em;
}
.wg-stat-number em {
  color: var(--color-accent);
  font-style: normal;
}
.wg-stat-label {
  font-family: var(--font-mono);
  font-size: 0.6875rem;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--color-text-muted);
  margin-top: 8px;
  display: block;
}
```

---

### SECCIÓN 6 — Por qué Tech Tecnic (beneficios diferenciadores)

**Tipo Elementor:** Section · Full-width  
**Fondo:** `#13131c`

#### Estructura:

```
[Kicker: POR QUÉ NOSOTROS]
[H2: No somos un proveedor. Somos tu equipo técnico.]
[Lead: La diferencia entre el soporte reactivo y el soporte que previene.]
[Grid 2 columnas — 4 items]
```

**Item 1:**
- H4: `Respuesta en menos de 15 minutos`
- Body: `SLA garantizado por contrato. Si no respondemos en tiempo, hay penalización. Sin excusas.`

**Item 2:**
- H4: `Equipo senior asignado`
- Body: `No hay juniors en guardia. Cada cliente tiene ingenieros certificados que conocen su stack.`

**Item 3:**
- H4: `Monitoreo antes que el usuario note el problema`
- Body: `El 94% de las incidencias las resolvemos antes de que generen un ticket de soporte.`

**Item 4:**
- H4: `Transparencia total`
- Body: `Dashboard en tiempo real, reportes mensuales y acceso a logs. Sin cajas negras.`

#### CSS de esta sección:

```css
selector {
  padding: clamp(64px, 8vw, 120px) 0;
}
.wg-benefit-item {
  padding: 28px 0;
  border-bottom: 1px solid rgba(255,255,255,0.06);
}
.wg-benefit-item:last-child { border-bottom: none; }
.wg-benefit-item h4 {
  color: var(--color-text);
  margin-bottom: 8px;
  font-size: var(--text-h4);
}
.wg-benefit-item p {
  color: var(--color-text-muted);
  font-size: var(--text-small);
  line-height: 1.65;
  max-width: none;
}
```

---

### SECCIÓN 7 — Testimonials

**Tipo Elementor:** Section · Full-width  
**Fondo:** `#0d0d11`

#### Copies de testimonios:

**Testimonio 1:**
- Quote: `"Antes perdíamos horas cada semana en incidencias. Desde que trabajamos con Tech Tecnic, nuestra infraestructura simplemente funciona. El equipo responde antes de que nos demos cuenta del problema."`
- Nombre: `Miguel Ríos`
- Cargo: `CTO · Fintech MX`
- Iniciales avatar: `MR`

**Testimonio 2:**
- Quote: `"Migramos 40 servidores a la nube en 72 horas sin un solo minuto de downtime. No pensé que fuera posible hasta que lo vimos."`
- Nombre: `Andrea Castillo`
- Cargo: `Directora de Operaciones · E-commerce Colombia`
- Iniciales avatar: `AC`

**Testimonio 3 (opcional, fila 2):**
- Quote: `"El equipo de Tech Tecnic detectó una vulnerabilidad crítica en nuestros sistemas antes de que pudiera ser explotada. Ese solo evento pagó 3 años de contrato."`
- Nombre: `Roberto Vega`
- Cargo: `CEO · SaaS B2B LATAM`
- Iniciales avatar: `RV`

#### CSS de esta sección:

```css
selector {
  padding: clamp(64px, 8vw, 120px) 0;
}
.wg-testimonial-card {
  background: var(--color-surface);
  border: 1px solid rgba(255,255,255,0.06);
  border-radius: var(--radius-lg);
  padding: 32px;
}
.wg-testimonial-quote {
  font-size: var(--text-lead);
  color: var(--color-text);
  line-height: 1.7;
  margin-bottom: 24px;
}
.wg-testimonial-quote::before {
  content: '\201C';
  color: var(--color-accent);
  font-family: var(--font-display);
  font-size: 2.5rem;
  line-height: 0;
  vertical-align: -0.5em;
  margin-right: 4px;
}
.wg-avatar {
  width: 40px; height: 40px;
  border-radius: 50%;
  background: var(--color-surface-2);
  border: 1px solid rgba(255,255,255,0.12);
  display: inline-flex; align-items: center; justify-content: center;
  font-family: var(--font-display);
  font-weight: 800;
  font-size: 0.8rem;
  color: var(--color-accent);
  margin-right: 12px;
  vertical-align: middle;
}
.wg-author-name  { font-weight: 600; font-size: var(--text-small); color: var(--color-text); }
.wg-author-role  { font-family: var(--font-mono); font-size: 0.6875rem; color: var(--color-text-muted); }
```

---

### SECCIÓN 8 — FAQ

**Tipo Elementor:** Section · Full-width  
**Fondo:** `#13131c`

> **Obligatorio para Schema FAQPage** — añadir JSON-LD al final de la sección.

#### Copies del FAQ:

**P1:** ¿Cuánto tiempo tarda en responder el equipo ante una incidencia?
**R:** Garantizamos respuesta inicial en menos de 15 minutos por contrato. El tiempo de resolución depende de la complejidad de la incidencia, pero el 78% se resuelve en la primera hora. Nuestro SLA incluye penalizaciones si no cumplimos los tiempos pactados.

**P2:** ¿Trabajan con todo tipo de infraestructura o solo con ciertos stacks?
**R:** Trabajamos con la mayoría de stacks empresariales: Linux/Windows Server, AWS, Azure, GCP, VMware, Docker, Kubernetes, bases de datos relacionales y NoSQL. En la auditoría inicial evaluamos tu entorno específico.

**P3:** ¿Necesito cancelar mi equipo interno de TI para contratar Tech Tecnic?
**R:** No necesariamente. Muchos clientes nos contratan como extensión de su equipo interno, cubriendo guardia nocturna, soporte especializado o proyectos específicos. Diseñamos el esquema según tu estructura.

**P4:** ¿Cómo funciona la auditoría inicial gratuita?
**R:** Es una revisión técnica de 2–3 horas donde analizamos tu arquitectura, configuraciones de seguridad, procesos de backup y tiempos de respuesta actuales. Te entregamos un informe detallado con hallazgos y recomendaciones, sin compromiso de contratación.

**P5:** ¿Operan en toda LATAM o solo en ciertos países?
**R:** Operamos de forma remota en toda LATAM y tenemos presencia física en México, Colombia y Argentina. El 95% de las incidencias se resuelven de forma remota; para casos que requieren presencia on-site coordinamos con socios locales certificados.

#### CSS de esta sección:

```css
selector {
  padding: clamp(64px, 8vw, 120px) 0;
}
.wg-faq-item {
  border-bottom: 1px solid rgba(255,255,255,0.06);
}
.wg-faq-item summary {
  padding: 24px 0;
  font-family: var(--font-body);
  font-weight: 600;
  font-size: var(--text-h4);
  color: var(--color-text);
  cursor: pointer;
  list-style: none;
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 16px;
}
.wg-faq-item summary::-webkit-details-marker { display: none; }
.wg-faq-item summary::after {
  content: '+';
  color: var(--color-accent);
  font-family: var(--font-display);
  font-size: 1.5rem;
  flex-shrink: 0;
  transition: transform 250ms ease;
}
.wg-faq-item[open] summary::after {
  transform: rotate(45deg);
}
.wg-faq-item p {
  padding: 0 0 24px;
  color: var(--color-text-muted);
  font-size: var(--text-body);
  line-height: 1.65;
  max-width: 72ch;
}
```

**Widget HTML para el FAQ (usar `<details>/<summary>`):**
```html
<details class="wg-faq-item">
  <summary>¿Cuánto tiempo tarda en responder el equipo ante una incidencia?</summary>
  <p>Garantizamos respuesta inicial en menos de 15 minutos por contrato...</p>
</details>
```

---

### SECCIÓN 9 — CTA Final

**Tipo Elementor:** Section · Full-width  
**Fondo:** `#C9382A` (bermellón — color acento)

```
[H2: ¿Tu infraestructura está lista para lo que viene?]
[Párrafo]
[Botón blanco]
```

**H2:** `¿Tu infraestructura está lista para lo que viene?`

**Párrafo:**
```
Habla con un ingeniero hoy. Sin compromiso, sin presentaciones de ventas
— solo una conversación técnica honesta sobre tu situación actual.
```

**Botón:** `Agendar revisión gratuita` → `/contacto/`
- CSS class: `wg-btn-cta-white`

#### CSS de esta sección:

```css
selector {
  padding: clamp(64px, 8vw, 100px) 0;
  text-align: center;
}
selector h2 {
  color: #ffffff;
  font-size: var(--text-h2);
  margin-bottom: 16px;
  max-width: 20ch;
  margin-left: auto;
  margin-right: auto;
}
selector p {
  color: rgba(255,255,255,0.80);
  max-width: 46ch;
  margin: 0 auto 36px;
  font-size: var(--text-lead);
  line-height: 1.65;
}
.wg-btn-cta-white {
  background: #ffffff;
  color: var(--color-accent);
  font-family: var(--font-body);
  font-weight: 700;
  padding: 16px 40px;
  border-radius: var(--radius-md);
  font-size: 1rem;
  border: none;
  cursor: pointer;
  transition: opacity 150ms ease;
  display: inline-block;
  text-decoration: none;
}
.wg-btn-cta-white:hover { opacity: 0.92; }
```

---

## Schema.org JSON-LD

> Pegar en un widget HTML de Elementor al final de la página (antes del footer),  
> o añadir via RankMath → Schema → Custom Schema.

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebPage",
      "@id": "https://techtecnic.com/#webpage",
      "name": "Soporte Técnico Empresarial · Tech Tecnic",
      "url": "https://techtecnic.com/",
      "description": "Tech Tecnic mantiene tu infraestructura tecnológica operando al 100%. Monitoreo proactivo, seguridad activa y respuesta en menos de 15 minutos.",
      "inLanguage": "es",
      "isPartOf": { "@id": "https://techtecnic.com/#website" }
    },
    {
      "@type": "Organization",
      "@id": "https://techtecnic.com/#organization",
      "name": "Tech Tecnic",
      "url": "https://techtecnic.com/",
      "description": "Tech Tecnic es una empresa de soporte técnico e infraestructura tecnológica especializada en alta disponibilidad, que ayuda a empresas de LATAM a operar sin interrupciones.",
      "areaServed": ["MX", "CO", "AR", "PE", "CL"],
      "knowsAbout": ["Infraestructura cloud", "Monitoreo de servidores", "Ciberseguridad", "AWS", "Azure", "GCP", "Kubernetes"]
    },
    {
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "¿Cuánto tiempo tarda en responder el equipo ante una incidencia?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Garantizamos respuesta inicial en menos de 15 minutos por contrato. El 78% de las incidencias se resuelven en la primera hora. Nuestro SLA incluye penalizaciones si no cumplimos los tiempos pactados."
          }
        },
        {
          "@type": "Question",
          "name": "¿Trabajan con todo tipo de infraestructura o solo con ciertos stacks?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Trabajamos con la mayoría de stacks empresariales: Linux/Windows Server, AWS, Azure, GCP, VMware, Docker, Kubernetes, bases de datos relacionales y NoSQL. En la auditoría inicial evaluamos tu entorno específico."
          }
        },
        {
          "@type": "Question",
          "name": "¿Necesito cancelar mi equipo interno de TI para contratar Tech Tecnic?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "No necesariamente. Muchos clientes nos contratan como extensión de su equipo interno, cubriendo guardia nocturna, soporte especializado o proyectos específicos."
          }
        },
        {
          "@type": "Question",
          "name": "¿Cómo funciona la auditoría inicial gratuita?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Es una revisión técnica de 2–3 horas donde analizamos tu arquitectura, configuraciones de seguridad, procesos de backup y tiempos de respuesta actuales. Te entregamos un informe detallado sin compromiso."
          }
        },
        {
          "@type": "Question",
          "name": "¿Operan en toda LATAM o solo en ciertos países?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Operamos de forma remota en toda LATAM y tenemos presencia física en México, Colombia y Argentina. El 95% de las incidencias se resuelven de forma remota."
          }
        }
      ]
    }
  ]
}
</script>
```

---

## Checklist antes de publicar

- [ ] H1 único en la página con keyword "soporte técnico empresarial"
- [ ] SEO Title y Meta Description completados en RankMath/Yoast
- [ ] Open Graph image subida (1200×630px)
- [ ] Canonical configurado
- [ ] Imágenes con `alt` descriptivo + `width` + `height`
- [ ] Imagen del hero con `loading="eager"` (above the fold)
- [ ] Resto de imágenes con `loading="lazy"`
- [ ] JSON-LD publicado (widget HTML o RankMath)
- [ ] `data-reveal` en todos los elementos de scroll
- [ ] Responsive revisado en 375px, 768px y 1280px
- [ ] Probar con JavaScript desactivado (contenido debe ser visible)
- [ ] PageSpeed Insights > 90 mobile
