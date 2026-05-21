# SOP — Proceso Completo de Producción de Sitio Web

> **Alcance:** Este documento cubre el proceso completo desde la llegada de un cliente nuevo hasta la entrega final y post-entrega.  
> **Herramienta:** WebGen + GitHub Copilot (o Claude Code / Cursor).  
> **Tiempo estimado:** 2–4 semanas dependiendo de la velocidad de feedback del cliente.

---

## Índice

1. [Pre-proyecto — Calificación y propuesta](#1-pre-proyecto)
2. [Setup del proyecto](#2-setup-del-proyecto)
3. [Fase 1 — Brand Intake y DESIGN.md](#3-fase-1--brand-intake-y-designmd)
4. [Fase 2 — UIKit](#4-fase-2--uikit)
5. [Fase 3 — Home Page](#5-fase-3--home-page)
6. [Fase 4 — Páginas internas](#6-fase-4--páginas-internas)
7. [QA antes de entrega](#7-qa-antes-de-entrega)
8. [Entrega y deploy](#8-entrega-y-deploy)
9. [Post-entrega](#9-post-entrega)
10. [Templates de comunicación](#10-templates-de-comunicación)
11. [Checklist rápido de cierre](#11-checklist-rápido-de-cierre)

---

## 1. Pre-proyecto

### 1.1 Calificación del cliente

Antes de cotizar, confirmar:

| Pregunta | Por qué importa |
|---|---|
| ¿Tiene logo en vectores (SVG/AI)? | Impacta el tiempo de diseño |
| ¿Tiene dominio registrado? | Necesario para canonical URLs |
| ¿Tiene hosting o necesita uno? | Define el tipo de entrega |
| ¿Tiene fotos reales del equipo/producto? | Afecta calidad final vs. stock |
| ¿Tiene copy escrito o lo producimos? | Determina alcance |
| ¿Cuántas páginas necesita? | Define el precio |
| ¿Tiene un sitio actual o es desde cero? | Migración vs. creación |

### 1.2 Definición de alcance

Paquetes estándar:

| Paquete | Páginas incluidas | Tiempo estimado |
|---|---|---|
| **Starter** | Home + Contacto | 1 semana |
| **Estándar** | Home + About + 2 servicios + Contacto | 2–3 semanas |
| **Completo** | Home + About + 4 servicios + Casos + Contacto | 3–4 semanas |
| **Custom** | Definir página por página | Cotizar |

### 1.3 Contrato y depósito

- [ ] Propuesta enviada y aprobada
- [ ] Contrato firmado (incluir número de rondas de revisión: recomendado **2 rondas por fase**)
- [ ] 50% de anticipo recibido antes de empezar
- [ ] Fecha de inicio y fecha de entrega acordadas

### 1.4 Accesos necesarios antes de empezar

Solicitar al cliente antes de comenzar (no esperar al final):

```
Necesito estos accesos antes de empezar:

1. Logo en SVG o AI (o PNG fondo transparente mínimo 500px de ancho)
2. Acceso al hosting / cPanel (si ya tienen)
3. Acceso al registrador de dominio (si necesitamos configurar DNS)
4. Google Analytics / Search Console (si ya existe)
5. Fotos del equipo y/o producto en alta resolución
6. Colores exactos de la marca (hex o pantone)
7. Cualquier guía de marca existente (PDF, Figma, etc.)
```

---

## 2. Setup del proyecto

### 2.1 Crear carpeta del proyecto

```bash
# En webgen/proyectos/ (ignorado por .gitignore)
mkdir proyectos/[nombre-cliente]
cd proyectos/[nombre-cliente]
```

### 2.2 Estructura inicial

```
proyectos/[cliente]/
├── _assets/          ← Archivos del cliente (logos, fotos, brief)
│   ├── logo.svg
│   ├── fotos/
│   └── brief-cliente.pdf
├── _entregas/        ← ZIPs de cada entrega
├── DESIGN.md         ← (se genera en Fase 1)
├── uikit.html        ← (se genera en Fase 2)
├── css/
│   └── theme.css     ← (se genera en Fase 3)
├── scripts/
│   └── main.js       ← (se genera en Fase 3)
├── img/              ← Imágenes optimizadas del sitio
└── home.html         ← (se genera en Fase 3)
```

### 2.3 Abrir el workspace

```bash
# Abrir VS Code en la carpeta webgen (no en la carpeta del cliente)
# Copilot lee .github/copilot-instructions.md automáticamente
code "c:\Users\david\Desktop\proyectos\webgen"
```

---

## 3. Fase 1 — Brand Intake y DESIGN.md

**Duración estimada:** 1–2 días  
**Trigger para Copilot:** `"Nuevo proyecto: [nombre cliente]"`

### 3.1 Brief de descubrimiento

Enviar al cliente el cuestionario o hacer una llamada de 30 min:

```
CUESTIONARIO DE BRIEF — [nombre cliente]

NEGOCIO
1. ¿Qué hace exactamente tu empresa? (2-3 oraciones)
2. ¿Cuál es tu principal diferenciador vs. la competencia?
3. ¿En qué países/ciudades operás?
4. ¿Cuánto tiempo lleva la empresa activa?

AUDIENCIA
5. ¿A quién le vendés? (B2B / B2C / ambos)
6. Describí a tu cliente ideal en 3 características

OBJETIVOS DEL SITIO
7. ¿Cuál es la acción más importante que debe hacer un visitante?
   → Ej: agendar, comprar, llamar, suscribirse, cotizar
8. ¿Tenés redes sociales o canales de contacto actuales?
   (WhatsApp, Instagram, LinkedIn, etc. con links)

DISEÑO
9. 3 sitios web que te gusten visualmente (de cualquier industria)
   → ¿Qué te gusta de cada uno?
10. 3 sitios de competidores que quieras superar
11. ¿Cómo describís el tono de tu marca?
    (formal / cercano / técnico / aspiracional / otro)

CONTENIDO
12. ¿Tenés copy escrito para el sitio o lo producimos?
13. ¿Tenés fotos propias o usamos banco de imágenes?
14. ¿Cuántas páginas necesitás aproximadamente?
```

### 3.2 Generación del DESIGN.md

1. Abrir Copilot en VS Code
2. Pasar el brief completado
3. Prompt: `"Con este brief, generá el DESIGN.md del proyecto [cliente]"`
4. Copilot genera las 9 secciones:
   - Visual Theme & Atmosphere
   - Color Palette & Roles
   - Typography Rules
   - Component Stylings
   - Layout Principles
   - Depth & Elevation
   - Do's and Don'ts
   - Responsive Behavior
   - Agent Prompt Guide

### 3.3 Revisión interna del DESIGN.md

Antes de mostrar al cliente, verificar:

- [ ] Ningún color prohibido (ver `craft/anti-slop.md`)
- [ ] Fondo no es `#ffffff` ni `#000000` puro
- [ ] Fuentes con carácter real (no Roboto, Lato, Open Sans)
- [ ] Contraste texto/fondo ≥ 7:1
- [ ] Contraste sobre fondo sutil ≥ 4.5:1
- [ ] Escala tipográfica usa `clamp()` en todos los sizes
- [ ] Los Do's/Don'ts son específicos de la marca, no genéricos

### 3.4 Presentación al cliente

Enviar o mostrar el DESIGN.md con:
- Swatches de colores renderizados
- Ejemplo de los pares tipográficos
- Descripción de las decisiones clave (por qué esas fuentes, por qué esa paleta)

**Mensaje al cliente:**
```
Aquí está el sistema de diseño de [nombre proyecto].

Antes de avanzar al diseño visual necesito tu OK en:
✅ Colores — ¿representan bien la marca?
✅ Tipografía — ¿el estilo es el correcto?
✅ Tono visual — ¿la descripción de atmósfera es la que buscás?

Cualquier ajuste en esta fase es el momento ideal. Una vez aprobado 
arrancamos a construir el UIKit (la biblioteca visual completa).
```

### 3.5 Iteración

- Máximo 2 rondas de revisión del DESIGN.md incluidas en el precio
- Cambios menores (colores, peso de fuente): ajustar y re-entregar en el día
- Cambios mayores (dirección visual completa): 48h turnaround

**Gate: ⛔ No avanzar a Fase 2 sin aprobación escrita del DESIGN.md.**

---

## 4. Fase 2 — UIKit

**Duración estimada:** 1–2 días  
**Trigger para Copilot:** `"Creá el uikit para [cliente] con el DESIGN.md aprobado"`

### 4.1 Generación

Copilot genera `uikit.html` con todos los componentes visualmente renderizados:

| Sección | Componentes |
|---|---|
| Colores | Swatches de cada token |
| Tipografía | Escala completa con texto real |
| Botones | Variantes + estados |
| Cards | Todas las variantes |
| Formularios | Todos los inputs con estados |
| Nav | Desktop + mobile funcional |
| Secciones | Hero, Features, Stats, Testimonials, CTA, Footer |
| Animaciones | Ejemplos de scroll reveal y hover |

### 4.2 Revisión interna

- [ ] Todos los tokens del DESIGN.md están aplicados (no valores hardcoded)
- [ ] Mobile responsive (probar en 375px y 768px)
- [ ] Animaciones funcionan y se sienten apropiadas
- [ ] Contraste verificado visualmente
- [ ] Ningún estilo inline fuera de variables únicas
- [ ] Sin errores de consola en el browser

### 4.3 Presentación al cliente

Enviar el `uikit.html` como archivo o subir a una URL de preview:

```
Aquí está el UIKit — la biblioteca visual completa de [nombre proyecto].

Este archivo muestra cómo se verá CADA elemento del sitio antes de 
construir las páginas. Revisá con atención:

✅ Colores — ¿se ven bien en pantalla? ¿el primario tiene presencia?
✅ Tipografía — ¿los tamaños y pesos se sienten correctos?
✅ Botones — ¿el CTA principal llama la atención?
✅ Cards — ¿el estilo de tarjetas es el que buscabas?
✅ Formularios — ¿el formulario de contacto se ve profesional?
✅ Animaciones — ¿la velocidad y suavidad están bien?

Con tu OK en esto, arrancamos el home en [fecha estimada].
```

**Gate: ⛔ No avanzar a Fase 3 sin aprobación escrita del UIKit.**

---

## 5. Fase 3 — Home Page

**Duración estimada:** 2–3 días  
**Trigger para Copilot:** `"Generá el home para [cliente]"`

### 5.1 Recolección de copys

Antes de generar, tener definidos:

```
COPYS PARA EL HOME

HERO
- Headline principal (H1): ___
- Subheadline / lead: ___
- CTA principal (texto del botón): ___
- CTA secundario (si aplica): ___

SECCIÓN DE BENEFICIOS / FEATURES
- Título de la sección: ___
- Feature 1: [título] + [descripción 1-2 líneas]
- Feature 2: [título] + [descripción 1-2 líneas]
- Feature 3: [título] + [descripción 1-2 líneas]

CÓMO FUNCIONA / PROCESO
- Paso 1: ___
- Paso 2: ___
- Paso 3: ___
- Paso 4 (opcional): ___

SOCIAL PROOF
- Testimonial 1: [texto] — [nombre, rol, empresa]
- Testimonial 2: [texto] — [nombre, rol, empresa]
- Logos de clientes: [si aplica]

CTA FINAL
- Texto del CTA: ___
- Refuerzo (1 oración): ___

SEO
- Keyword principal: ___ (ej: "agencia de marketing digital Bogotá")
- Meta description (150-160 chars): ___
- Dominio definitivo: ___
```

### 5.2 Generación

Copilot genera:
- `home.html` — página completa
- `css/theme.css` — sistema de estilos extraído del UIKit
- `scripts/main.js` — GSAP + Lenis + animaciones

### 5.3 Revisión interna

**Visual:**
- [ ] Diseño consistente con el UIKit aprobado
- [ ] Responsive: testar en 375px, 768px, 1280px, 1440px
- [ ] Imágenes: todas tienen `alt`, `width`, `height`, `loading="lazy"`
- [ ] Primera imagen del hero sin `loading="lazy"`

**SEO/GEO:**
- [ ] `<title>` único con keyword principal
- [ ] `<meta description>` 150–160 caracteres
- [ ] `<link rel="canonical">` correcto
- [ ] Open Graph completo (og:title, og:description, og:image, og:url)
- [ ] Schema.org `Organization` + `WebPage` en JSON-LD
- [ ] `<h1>` único con keyword principal
- [ ] Un `<h2>` por sección
- [ ] Bloque de entidad GEO en el hero lead

**Performance:**
- [ ] Sin imágenes sin dimensiones
- [ ] Google Fonts con `display=swap`
- [ ] GSAP y Lenis cargados desde CDN con `defer`
- [ ] Sin CSS/JS bloqueante en el `<head>`

**Accesibilidad:**
- [ ] Todos los links con texto descriptivo
- [ ] `aria-label` en íconos sin texto
- [ ] `<nav>` con `aria-label`
- [ ] `<main id="main-content">` presente
- [ ] Focus visible en todos los elementos interactivos
- [ ] `prefers-reduced-motion` respetado

### 5.4 Lighthouse check

```
Objetivo mínimo antes de presentar al cliente:
Performance:   ≥ 90
Accesibilidad: ≥ 90
Best Practices: ≥ 90
SEO:           100
```

Si Performance < 90:
- Revisar imágenes sin dimensiones (causa Cumulative Layout Shift)
- Revisar fuentes no preconnected
- Revisar scripts bloqueantes

### 5.5 Presentación al cliente

```
Aquí está el home de [nombre proyecto].

Antes de arrancar con las páginas internas, confirmame:

✅ El diseño en desktop y móvil se ve como esperabas
✅ El headline del hero comunica bien la propuesta de valor
✅ Los CTAs están en los lugares correctos
✅ Las animaciones se sienten apropiadas (no distraen)
✅ La estructura general de secciones tiene sentido

También revisá el SEO:
✅ El <title> es correcto: "[título actual]"
✅ La meta description está bien: "[descripción actual]"
✅ La keyword principal está en el H1
```

**Gate: ⛔ No avanzar a Fase 4 sin aprobación escrita del home.**

---

## 6. Fase 4 — Páginas internas

**Duración estimada:** 1 día por página  
**Trigger para Copilot:** `"Creá la página [tipo] para [cliente]"`

### 6.1 Orden de producción recomendado

1. `about.html` / `sobre-nosotros.html`
2. Páginas de servicio (una por una)
3. `casos.html` (si aplica)
4. `contacto.html` (siempre última — contiene formulario)

### 6.2 Inputs por tipo de página

**Para cada página de servicio:**
```
- Nombre del servicio: ___
- Keyword principal: ___
- Problema que resuelve (2-3 oraciones): ___
- Cómo funciona / proceso (3-5 pasos): ___
- Beneficios clave (3-4 bullets): ___
- Dato o estadística del sector: ___
- FAQ del servicio (mínimo 5 preguntas): ___
- CTA de la página: ___
```

**Para about:**
```
- Historia/origen de la empresa (2-3 párrafos): ___
- Valores o principios (3-5): ___
- Equipo (nombres, roles, fotos): ___
- Estadísticas clave (años, clientes, países): ___
- FAQ sobre la empresa (5+ preguntas): ___
```

**Para contacto:**
```
- Campos del formulario: ___
- Destino del formulario (email / CRM): ___
- Mensaje de confirmación tras envío: ___
- Datos alternativos (WhatsApp, email directo): ___
- Horario de atención: ___
```

### 6.3 Reglas de consistencia obligatorias

| Elemento | Regla |
|---|---|
| `<header>` / nav | Idéntico al home — copiar HTML exacto |
| `<footer>` | Idéntico al home — copiar HTML exacto |
| Tokens CSS | Siempre los mismos de `theme.css` |
| Kickers | Mismo estilo y clases |
| Botones | Mismas clases del UIKit |
| Schema FAQPage | **Obligatorio en TODAS las páginas internas** |

### 6.4 Revisión por página

Para cada página, verificar antes de presentar:

- [ ] Nav y footer idénticos al home
- [ ] `<title>` único (no repetir el del home)
- [ ] `<meta description>` único de 150–160 chars
- [ ] `<link rel="canonical">` correcto para esta URL
- [ ] `<h1>` único con keyword de la página
- [ ] FAQ con Schema.org `FAQPage` en JSON-LD
- [ ] `Schema.org Service` (en páginas de servicio)
- [ ] Mobile responsive

---

## 7. QA antes de entrega

### 7.1 Checklist de QA técnico

Hacer con el sitio completo antes del deploy:

**Cross-browser:**
- [ ] Chrome (Windows y Mac)
- [ ] Firefox
- [ ] Safari (Mac o BrowserStack)
- [ ] Chrome mobile (Android)
- [ ] Safari mobile (iOS)

**Responsive:**
- [ ] 375px — iPhone SE
- [ ] 390px — iPhone 14
- [ ] 768px — iPad
- [ ] 1024px — iPad Pro landscape
- [ ] 1280px — Laptop
- [ ] 1440px — Desktop estándar
- [ ] 1920px — Full HD

**Funcional:**
- [ ] Todos los links internos funcionan (no 404)
- [ ] Links externos abren en nueva pestaña
- [ ] Formularios envían correctamente y muestran confirmación
- [ ] Scroll suave funciona en todas las páginas
- [ ] Animaciones no aparecen con `prefers-reduced-motion: reduce`
- [ ] Header se vuelve sticky al hacer scroll
- [ ] Menú mobile abre y cierra correctamente
- [ ] El CTA principal del nav funciona en todas las páginas

**Performance (Lighthouse — todas las páginas):**
- [ ] Home: Performance ≥ 90, SEO 100
- [ ] Cada página interna: Performance ≥ 85, SEO 100

**Accesibilidad:**
- [ ] Wave o axe: sin errores críticos
- [ ] Navegación completa por teclado (Tab, Enter, Escape)
- [ ] Contraste suficiente en todos los textos

### 7.2 Checklist SEO final

- [ ] No hay títulos duplicados entre páginas
- [ ] No hay meta descriptions duplicadas
- [ ] Canonical URL correcta en cada página
- [ ] `robots.txt` permite indexación
- [ ] `sitemap.xml` creado (manual o con herramienta)
- [ ] Schema.org sin errores (validar en [schema.org/validator](https://validator.schema.org/))
- [ ] Open Graph correcto (validar en [opengraph.xyz](https://www.opengraph.xyz/))
- [ ] Google Search Console: propiedad creada y sitemap enviado

### 7.3 Checklist de imágenes

- [ ] Todas las imágenes optimizadas (< 200KB para fotos, < 50KB para íconos)
- [ ] Formato WebP con fallback JPG/PNG donde corresponda
- [ ] Todas tienen `alt` descriptivo
- [ ] Todas tienen `width` y `height` definidos
- [ ] Imágenes below-the-fold tienen `loading="lazy"`

---

## 8. Entrega y deploy

### 8.1 Preparar archivos para entrega

```
[cliente]-v1.0/
├── index.html            ← Renombrar home.html
├── about/
│   └── index.html        ← Estructura de carpetas para URLs limpias
├── servicios/
│   ├── [servicio-1]/
│   │   └── index.html
│   └── [servicio-2]/
│       └── index.html
├── contacto/
│   └── index.html
├── css/
│   └── theme.css
├── scripts/
│   └── main.js
├── img/
│   └── [todas las imágenes optimizadas]
├── robots.txt
└── sitemap.xml
```

### 8.2 robots.txt mínimo

```
User-agent: *
Allow: /

Sitemap: https://[dominio]/sitemap.xml
```

### 8.3 sitemap.xml básico

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url><loc>https://[dominio]/</loc><priority>1.0</priority></url>
  <url><loc>https://[dominio]/about/</loc><priority>0.8</priority></url>
  <url><loc>https://[dominio]/servicios/[s1]/</loc><priority>0.8</priority></url>
  <url><loc>https://[dominio]/contacto/</loc><priority>0.7</priority></url>
</urlset>
```

### 8.4 Deploy

**Opción A — Hosting compartido (cPanel):**
1. Conectar por FTP (Filezilla o similar)
2. Subir todo el contenido a `public_html/`
3. Verificar permisos: carpetas 755, archivos 644

**Opción B — Vercel (recomendado para sitios estáticos):**
```bash
npm install -g vercel
cd [carpeta-cliente]
vercel --prod
# Conectar dominio custom en el dashboard de Vercel
```

**Opción C — Netlify:**
```bash
# Arrastrar la carpeta al dashboard de Netlify
# O conectar repo de GitHub
```

### 8.5 Post-deploy: verificar en producción

- [ ] El sitio carga en `https://[dominio]/`
- [ ] HTTPS activo (certificado SSL)
- [ ] No hay recursos cargando por HTTP (mixed content)
- [ ] Google Analytics/Tag Manager instalado y recibiendo datos
- [ ] Search Console: propiedad verificada + sitemap enviado
- [ ] Formulario de contacto funciona en producción

### 8.6 Entrega al cliente

Documento de entrega (email o PDF):

```
ENTREGA FINAL — [Nombre Proyecto]

Sitio en vivo: https://[dominio]/

ARCHIVOS ENTREGADOS
Se adjunta ZIP con todos los archivos fuente:
- HTML de todas las páginas
- CSS (theme.css)
- JavaScript (main.js)
- Imágenes optimizadas

ACCESOS CONFIGURADOS
- Hosting: [proveedor] — credenciales en documento separado
- Dominio: [registrador] — credenciales en documento separado
- Google Analytics: ID [G-XXXXXXXX]
- Search Console: propiedad verificada

PÁGINAS ENTREGADAS
✅ Home (/)
✅ About (/about/)
✅ [Servicio 1] (/servicios/[s1]/)
✅ Contacto (/contacto/)

PRÓXIMOS PASOS RECOMENDADOS
1. Revisar el sitio en tu dispositivo y red
2. Confirmar que el formulario de contacto llega a tu casilla
3. Completar o actualizar los textos placeholder (si los hay)
4. Programar revisión SEO en 30 días
```

---

## 9. Post-entrega

### 9.1 Ventana de soporte post-entrega

- **7 días:** Corrección de bugs o errores (sin costo)
- **30 días:** Soporte vía email para dudas funcionales
- **> 30 días:** Requiere contrato de mantenimiento

### 9.2 Qué entra en el soporte de 7 días (sin costo extra)

✅ Links rotos  
✅ Errores visuales en navegadores acordados  
✅ Formulario que no envía  
✅ Error en responsive acordado  

❌ Cambios de copy, colores o secciones  
❌ Páginas nuevas  
❌ Integraciones con terceros no acordadas  

### 9.3 Revisión SEO a 30 días

Agendar check en 30 días para:
- [ ] Search Console: primeras impresiones y clics
- [ ] Indexación: todas las páginas indexadas (`site:[dominio]`)
- [ ] Core Web Vitals en Search Console (campo real)
- [ ] Revisar si Google encontró errores de Schema.org

---

## 10. Templates de comunicación

### Kickoff al cliente

```
Hola [nombre],

Arrancamos con [nombre proyecto]. 

Para comenzar necesito:
1. Brief completado (te adjunto el formulario)
2. Logo en SVG o AI
3. Fotos del equipo y/o producto (si tenés)
4. Acceso al hosting (si ya tenés uno)

Una vez que tenga esto arrancamos con el Brand Intake y el sistema 
de diseño. El proceso tiene 4 fases, cada una con tu aprobación 
antes de avanzar.

Calendario estimado:
- DESIGN.md: [fecha]
- UIKit: [fecha + 2 días]
- Home: [fecha + 5 días]
- Páginas internas: [fecha + 8-12 días]
- Entrega final: [fecha]

Cualquier duda estoy disponible.
```

### Entrega de cada fase (template genérico)

```
Hola [nombre],

Adjunto [nombre del entregable] de [nombre proyecto].

[Descripción de 1-2 líneas de lo que se entrega]

Para avanzar a la siguiente fase necesito tu OK en:
✅ [punto clave 1]
✅ [punto clave 2]  
✅ [punto clave 3]

Si tenés ajustes, por favor detallarlos en una sola lista para 
incorporarlos juntos. Plazo para feedback: [fecha].

Con tu aprobación arrancamos [siguiente fase] el [fecha].
```

---

## 11. Checklist rápido de cierre

Al finalizar cada proyecto, verificar que se entregó:

**Archivos:**
- [ ] ZIP con todos los fuentes (HTML, CSS, JS, imágenes)
- [ ] `robots.txt`
- [ ] `sitemap.xml`
- [ ] DESIGN.md del proyecto (para futuras referencias)

**Accesos:**
- [ ] Credenciales de hosting entregadas en documento separado
- [ ] Credenciales de dominio documentadas
- [ ] Google Analytics configurado y entregado
- [ ] Search Console verificado

**Documentación:**
- [ ] Documento de entrega enviado
- [ ] Instrucciones básicas para editar textos (si es HTML estático)
- [ ] Recomendaciones de mantenimiento

**Administrativo:**
- [ ] Saldo final cobrado (50% restante)
- [ ] Factura emitida
- [ ] Proyecto archivado en carpeta de clientes

---

*Versión 1.0 — WebGen SOP*
