# craft/anti-slop.md
> Anti-patrones de diseño genérico.  
> Reglas para que cada sitio tenga identidad real, no aspecto de "plantilla de IA".

---

## El problema del AI-slop

La IA tiende a generar diseños con:
- Colores neutros seguros (`#6366f1`, `#3b82f6`, `#10b981`)
- Gradientes de héroe con 4+ colores
- Cards con sombra en todo
- Iconos de Material Icons en cada titular
- Copys del tipo "Potenciamos tu negocio digital con soluciones innovadoras"
- Fondos con blob shapes flotando sin propósito
- Testimonials con avatars genéricos

**Estas instrucciones existen para evitar eso.**

---

## Colores — Reglas anti-genérico

### Colores prohibidos como acento de marca

```
❌ #6366f1 — "Indigo" de IA (Tailwind default)
❌ #3b82f6 — "Blue-500" de IA
❌ #10b981 — "Emerald" de IA
❌ #f59e0b — "Amber" de IA genérica
❌ #ef4444 — "Red-500" de warning
❌ #8b5cf6 — "Violet" de IA
```

### Background nunca puro

```css
/* ❌ Nunca */
background: #ffffff;
background: #000000;

/* ✅ Siempre un toque de tono */
background: #fafaf8;    /* cálido sutil */
background: #f8f9fa;    /* neutro frío */
background: #0f1117;    /* near-black con azul */
background: #111010;    /* near-black con calidez */
background: #1a2f33;    /* dark con verde */
```

### Gradientes máximo 2 colores

```css
/* ❌ Arco iris */
background: linear-gradient(135deg, #667eea 0%, #764ba2 30%, #f093fb 60%, #f5576c 100%);

/* ✅ 2 colores máximo, mismo tono + 1 paso */
background: linear-gradient(135deg, #1a2f33 0%, #243d42 100%);
background: linear-gradient(160deg, #0f1117 0%, #1a1f35 100%);
```

---

## Tipografía — Reglas anti-genérico

### Fuentes prohibidas en proyectos premium

```
❌ Roboto — demasiado Google-genérico
❌ Helvetica Neue con nada más — muerto
❌ Lato — 2014 startup
❌ Open Sans — corporativo sin carácter
```

### Tamaños en hero — pensar en impacto

```css
/* ❌ Pequeño = invisible */
h1 { font-size: 2rem; }

/* ✅ El hero merece dominar la pantalla */
.hero-title { font-size: clamp(3rem, 6vw, 6.5rem); line-height: 0.95; }
```

### Letter-spacing en headings grandes

```css
/* ❌ Default spacing en headings grandes = aire extra no deseado */
.hero-title { font-size: 6rem; /* letter-spacing: 0 (default) */ }

/* ✅ Tight en headings display */
.hero-title {
  font-size: clamp(3rem, 6vw, 6.5rem);
  letter-spacing: -0.03em;
}
```

---

## Layout — Reglas anti-genérico

### No centrar todo

```css
/* ❌ Todo centrado = landing page genérica */
.section { text-align: center; }
.hero { text-align: center; }
.features { text-align: center; }

/* ✅ Centrar solo secciones que lo requieren */
.hero { text-align: left; }         /* hero: izquierda o grid */
.social-proof { text-align: center; } /* logos: centrado OK */
.features { text-align: left; }     /* features: izquierda */
.cta { text-align: center; }        /* cta final: centrado OK */
```

### Secciones con personalidad diferenciada

```css
/* ❌ Todas las secciones igual */
.section { background: white; padding: 80px 0; }

/* ✅ Variedad controlada */
.hero          { background: var(--color-bg-dark); }
.logos         { background: var(--color-bg-subtle); padding: 32px 0; } /* más pequeño */
.features      { background: var(--color-bg); }
.how-it-works  { background: var(--color-bg-subtle); }
.testimonials  { background: var(--color-bg); }
.cta           { background: var(--color-accent); } /* contraste máximo */
```

### Proporciones no uniformes

```css
/* ❌ Todo 3 columnas iguales */
.grid { grid-template-columns: repeat(3, 1fr); }

/* ✅ Proporciones con intención */
.hero-grid    { grid-template-columns: 1.2fr 0.8fr; }
.feature-grid { grid-template-columns: 0.9fr 1.1fr; gap: 64px; }
.process      { grid-template-columns: repeat(5, 1fr); } /* horizontal */
```

---

## Componentes — Reglas anti-genérico

### Cards sin sombra universal

```css
/* ❌ Sombra en todo = sin jerarquía real */
.card { box-shadow: 0 4px 16px rgba(0,0,0,0.1); }
.feature-card { box-shadow: 0 4px 16px rgba(0,0,0,0.1); }
.testimonial { box-shadow: 0 4px 16px rgba(0,0,0,0.1); }

/* ✅ Sombra solo donde hay elevación real */
.card { border: 1px solid var(--color-border); }           /* borde sutil */
.card:hover { box-shadow: 0 8px 32px rgba(0,0,0,0.08); }   /* solo en hover */
.modal { box-shadow: 0 32px 80px rgba(0,0,0,0.3); }        /* elevación real */
```

### Botones con carácter

```css
/* ❌ Botón sin personalidad */
.btn { background: #6366f1; color: white; border-radius: 4px; padding: 10px 20px; }

/* ✅ Botón con identidad */
.btn-primary {
  background: var(--color-accent);
  color: var(--color-bg);          /* texto oscuro sobre claro, o viceversa */
  border-radius: var(--radius-md); /* consistente con el design system */
  padding: 14px 32px;
  font-weight: 600;
  letter-spacing: -0.01em;
  transition: transform 150ms ease, opacity 150ms ease;
}
.btn-primary:hover {
  opacity: 0.88;
  transform: translateY(-1px);     /* micro-elevación en hover */
}
.btn-primary:active {
  transform: translateY(0);        /* reacción al click */
}
```

### Iconos — evitar Material Icons como decoración principal

```
❌ Icono de Material Icons + título en cada feature card
✅ Número de paso + título en feature card
✅ SVG custom o Phosphor Icons para variedad
✅ Bullet point de marca con color de acento
✅ Sin icono (solo el heading) cuando el copy es suficientemente claro
```

---

## Copies — Reglas anti-genérico

### Frases prohibidas

```
❌ "Potenciamos tu negocio digital"
❌ "Soluciones innovadoras"
❌ "A medida de tus necesidades"
❌ "Expertos en el sector"
❌ "Tu socio estratégico de confianza"
❌ "Llevamos tu empresa al siguiente nivel"
❌ "Transformación digital"
❌ "Ecosistema de soluciones"
❌ "Sinergia"
❌ "Holístico"
```

### Alternativas con especificidad

```
✅ "Duplicamos la adquisición de leads de GB Advisors en 18 meses"
✅ "Sistema de ventas activo en 2–4 semanas"
✅ "WhatsApp tiene 98% de tasa de apertura — y lo usamos como canal de ventas"
✅ "+60 empresas en LATAM y USA con procesos digitales más claros"
✅ "Sin tarjeta de crédito. Sin setup fees. Cancelá cuando quieras."
```

### Regla de especificidad

Cada claim debe pasar el test: **¿puede esta oración aparecer en un competitor genérico?**
- Si la respuesta es SÍ → reescribir con datos o contexto específico
- Si la respuesta es NO → está bien

---

## Imágenes — Reglas anti-genérico

### Prohibido

```
❌ Stock photos de personas en traje mirando a cámara
❌ Stock photos de handshake de negocios
❌ Laptop con código verde (estilo "hacker")
❌ Globo terráqueo 3D con conexiones
❌ Engranajes metálicos como metáfora de proceso
❌ Personas de diversidad artificial posada
```

### Alternativas

```
✅ Screenshots de producto real o mockup bien hecho
✅ Ilustraciones custom con paleta de la marca
✅ Fotos del equipo real (si existen)
✅ Capturas de dashboards con datos reales (anonimizados)
✅ Render 3D de producto si aplica (con herramientas de IA)
✅ Fotografía editorial con estética definida (color grading consistente)
✅ Imágenes tipo "artefacto" que muestran el proceso de trabajo
```

**Cuando no hay imágenes disponibles:**  
Indicar en un comentario HTML el prompt exacto para generarla con IA:
```html
<!--
  IMAGEN: hero-dashboard.jpg | Aspecto: 16:9
  PROMPT:
  Photorealistic editorial photo. A laptop screen showing a clean CRM dashboard
  with pipeline stages and WhatsApp chat integrations. Dark UI with teal and amber accents.
  Shallow depth of field, office environment. No readable text. 16:9 ratio.
-->
<img src="../img/hero-dashboard.jpg" alt="Dashboard CRM con integración WhatsApp" width="1200" height="675">
```

---

## Animaciones — Reglas anti-genérico

```
❌ Bounce en hover (infantil)
❌ Rotate 360° en hover de iconos
❌ Parallax agresivo (>25% de movimiento)
❌ Fade-in de toda la página con overlay negro
❌ Loading spinner que tarda 3 segundos en sitio estático
❌ Cursor customizado sin justificación de marca
❌ Scroll snapping forzado en contenido informativo
```

```
✅ Reveal suave al scroll (translateY 24px → 0, opacity 0 → 1)
✅ Hover con translateY(-2px) + sombra en cards
✅ Header blur al hacer scroll
✅ Transiciones de estado en formularios (border, shadow)
✅ Counter animado para números de stats
✅ Lenis smooth scroll como base de la experiencia
```

---

## Checklist anti-slop

- [ ] Ningún color de la lista de prohibidos como acento
- [ ] Background con toque de tono (no blanco/negro puro)
- [ ] Gradientes de máximo 2 colores
- [ ] Fuentes con carácter real (no Roboto/Lato)
- [ ] Hero con font-size ≥ `clamp(2.5rem, 5vw, 5rem)`
- [ ] No todo centrado — left-align en secciones de contenido
- [ ] Cards con borde sutil, sombra solo en hover
- [ ] 0 frases de la lista prohibida en los copies
- [ ] Imágenes de producto/proceso, no stock genérico
- [ ] Animaciones de reveal, no bounce ni rotate
