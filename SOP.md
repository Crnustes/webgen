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
5. [Fase 3 — WP Theme Setup](#5-fase-3--wp-theme-setup)
6. [Fase 4 — Páginas en Elementor](#6-fase-4--páginas-en-elementor)
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
├── _assets/              ← Archivos del cliente (logos, fotos, brief)
│   ├── logo.svg
│   ├── fotos/
│   └── brief-cliente.pdf
├── _entregas/            ← ZIPs de cada entrega
├── DESIGN.md             ← (se genera en Fase 1)
├── uikit.html            ← (se genera en Fase 2)
├── wp-theme/             ← (se genera en Fase 3 — va al child theme WP)
│   ├── style.css         ← Tokens + CSS global
│   ├── functions.php     ← Enqueue scripts/styles
│   └── main.js           ← GSAP + Lenis + animaciones
└── pages/                ← (se genera en Fase 4 — guías Elementor)
    ├── home-guide.md
    ├── about-guide.md
    ├── [servicio]-guide.md
    └── contacto-guide.md
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

## 5. Fase 3 — WP Theme Setup

**Duración estimada:** 1 día  
**Trigger para Copilot:** `"Generá el theme de WordPress para [cliente]"`

### 5.1 Inputs previos

Antes de generar, confirmar con el cliente:

```
THEME SETUP
- Theme base instalado en WP: Hello Elementor / Astra / GeneratePress / otro
- Nombre del child theme: ___
- ¿Hay un functions.php existente? (sí / no)
- Google Fonts a usar: (confirmadas en UIKit aprobado)
```

### 5.2 Generación

Copilot genera los 3 archivos del child theme:
- `wp-theme/style.css` — tokens CSS + tipografía base + componentes + animaciones
- `wp-theme/functions.php` — enqueue de Google Fonts, GSAP, Lenis, main.js
- `wp-theme/main.js` — scroll reveal (GSAP + data-reveal), Lenis, header scroll

### 5.3 Revisión interna

- [ ] `style.css`: Cabecera WP correcta (Theme Name, Template matches el padre)
- [ ] `style.css`: Todos los tokens del DESIGN.md están definidos en `:root`
- [ ] `style.css`: Tipografía base aplica las fuentes aprobadas
- [ ] `style.css`: Progressive enhancement funciona (`.js [data-reveal]`)
- [ ] `functions.php`: Fuentes correctas en la URL de Google Fonts
- [ ] `functions.php`: `main.js` se encola después de GSAP y Lenis
- [ ] `main.js`: `classList.add('js')` es la primera línea
- [ ] `main.js`: Lenis + GSAP setup correcto

### 5.4 Instalación en WordPress

1. Crear carpeta del child theme en `/wp-content/themes/[nombre-child]/`
2. Subir `style.css` y `functions.php` a la raíz del child theme
3. Crear subcarpeta `/js/` y subir `main.js`
4. Activar el child theme: **WordPress → Apariencia → Temas**
5. Verificar en el frontend que los tokens aplican correctamente

### 5.5 Presentación al cliente

```
Aquí están los archivos del theme.

Una vez instalado:
✅ Los colores y tipografías de la marca aplican en todo el sitio
✅ GSAP + Lenis están activos en todas las páginas
✅ Las animaciones se activan agregando data-reveal en Elementor

Podemos arrancar a construir las páginas en Elementor.
¿Algún ajuste antes de avanzar?
```

**Gate: ⛔ No avanzar a Fase 4 sin que el theme esté instalado y aprobado.**

---

## 6. Fase 4 — Páginas en Elementor

**Duración estimada:** 1–2 días por página  
**Trigger para Copilot:** `"Creá la guía Elementor para la página [tipo] de [cliente]"`

> El header y footer los construye Elementor Pro (templates globales).  
> WebGen genera la **guía de construcción** + CSS + copys + Schema.org por cada página.

### 6.1 Orden de producción recomendado

1. Home (primera página en construir en Elementor)
2. About / Sobre nosotros
3. Páginas de servicio (una por una)
4. Casos (si aplica)
5. Contacto (siempre última — tiene formulario)

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
- Destino del formulario (email / CRM / Elementor Form webhook): ___
- Mensaje de confirmación tras envío: ___
- Datos alternativos (WhatsApp, email directo): ___
- Horario de atención: ___
```

### 6.3 Qué recibe Copilot → qué entrega

| Input | Output |
|---|---|
| Tipo de página + copys + keyword | Guía sección por sección para Elementor |
| — | CSS global (pegar en Edit Page → Custom CSS) |
| — | CSS por sección (pegar en Section → Advanced → Custom CSS) |
| — | Schema.org JSON-LD (widget HTML o RankMath) |
| — | Campos SEO para RankMath/Yoast |

### 6.4 Revisión por página (en Elementor, antes de publicar)

- [ ] Tokens del theme aplicados (colores, fuentes vienen de `style.css`)
- [ ] `data-reveal` agregado en las secciones que deben animarse
- [ ] Clases `.wg-btn-primary`, `.wg-kicker` etc. aplicadas en los widgets
- [ ] CSS de página pegado en Edit Page → Custom CSS
- [ ] Schema.org JSON-LD widget HTML presente
- [ ] RankMath/Yoast: SEO Title, Meta Description y Canonical configurados
- [ ] `<h1>` único con keyword de la página
- [ ] FAQ con Schema.org `FAQPage` (servicio y about)
- [ ] Visualizar en móvil dentro de Elementor antes de publicar

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

**Performance (GTmetrix o PageSpeed Insights — todas las páginas):**
- [ ] Home: Performance score ≥ 80 (WordPress tiene más overhead que HTML estático)
- [ ] LCP < 2.5s
- [ ] CLS < 0.1
- [ ] FID / INP < 200ms

**Elementor específico:**
- [ ] Elementor → Settings → Advanced: habilitar "Improved Asset Loading"
- [ ] Elementor → Settings → Advanced: habilitar "Lazy Load Background Images"
- [ ] CSS Mode: "External File" (no inline)
- [ ] Google Fonts: configurados en Elementor Site Settings (no duplicar los del theme)

**Accesibilidad:**
- [ ] Wave o axe: sin errores críticos
- [ ] Contraste suficiente en todos los textos

### 7.2 Checklist SEO en WordPress

- [ ] Plugin RankMath o Yoast activo y configurado
- [ ] No hay SEO Titles duplicados entre páginas
- [ ] No hay Meta Descriptions duplicadas
- [ ] Canonical URL correcta en cada página
- [ ] XML Sitemap activo (RankMath/Yoast lo genera automáticamente)
- [ ] `robots.txt` sin bloqueos accidentales
- [ ] Schema.org sin errores → validar en [schema.org/validator](https://validator.schema.org/)
- [ ] Open Graph correcto → validar en [opengraph.xyz](https://www.opengraph.xyz/)
- [ ] Google Search Console: propiedad verificada + sitemap enviado
- [ ] Elementor: verificar que los H1 son únicos por página (no duplicar con el título de WP)

### 7.3 Checklist de imágenes en WordPress

- [ ] Todas las imágenes optimizadas antes de subir (< 200KB fotos, < 50KB íconos)
- [ ] Plugin de optimización activo: Imagify, ShortPixel o similar
- [ ] Servir imágenes en WebP (Imagify/ShortPixel lo hacen automáticamente)
- [ ] Lazy load activo (Elementor lo incluye nativamente)
- [ ] Alt text descriptivo en cada imagen subida a la biblioteca

---

## 8. Entrega y deploy

### 8.1 Preparar archivos del child theme para entrega

```
[cliente]-child-theme-v1.0/
├── style.css         ← Tokens + CSS global
├── functions.php     ← Enqueue scripts/styles
└── js/
    └── main.js       ← GSAP + Lenis + animaciones
```

Este ZIP se instala en WordPress como child theme.

### 8.2 Checklist pre-lanzamiento en WordPress

- [ ] Child theme activo en Apariencia → Temas
- [ ] Elementor → Tools → Regenerate CSS & Data
- [ ] Todas las páginas publicadas (no borrador)
- [ ] Header y footer templates de Elementor Pro activos en todo el sitio
- [ ] Formulario de contacto configurado con destino correcto
- [ ] Elementor Form: acción post-submit configurada
- [ ] Google Analytics / Tag Manager instalado (via plugin o `functions.php`)
- [ ] RankMath/Yoast: sitemap activo y enviado a Search Console
- [ ] Wordfence o plugin de seguridad activo
- [ ] Plugin de caché activo: WP Rocket, LiteSpeed Cache o W3 Total Cache

### 8.3 Deploy / Migración (si aplica)

**Si el desarrollo fue en staging y hay que migrar a producción:**

1. Usar **Duplicator Pro** o **All-in-One WP Migration** para exportar
2. En producción: instalar WordPress limpio + importar
3. O usar **WP Migrate DB Pro** solo para sincronizar la base de datos
4. Actualizar URLs en la base de datos si el dominio cambia:
   ```sql
   UPDATE wp_options SET option_value = 'https://[dominio-nuevo]' WHERE option_name = 'siteurl';
   UPDATE wp_options SET option_value = 'https://[dominio-nuevo]' WHERE option_name = 'home';
   ```
5. Actualizar canonical URLs en RankMath/Yoast
6. Regenerar Elementor CSS: Tools → Regenerate

**Si se construyó directamente en producción:**
1. Verificar que el dominio apunta al servidor correcto
2. Activar SSL/HTTPS (Let's Encrypt vía cPanel o Cloudflare)
3. Forzar HTTPS: Settings → General → actualizar URLs a `https://`

### 8.4 Post-deploy: verificar en producción en WordPress

- [ ] El sitio carga en `https://[dominio]/`
- [ ] HTTPS activo + no hay mixed content (revisa en DevTools → Console)
- [ ] Child theme activo y CSS cargando (verifica tokens en DevTools)
- [ ] `main.js` cargando sin errores en consola del navegador
- [ ] GSAP y Lenis activos — las animaciones `data-reveal` funcionan
- [ ] Header y footer de Elementor Pro visibles en todas las páginas
- [ ] Google Analytics / Tag Manager recibiendo eventos (chequear en Realtime)
- [ ] Formulario de contacto: envío llega al destino correcto
- [ ] Search Console: propiedad verificada + sitemap enviado
- [ ] PageSpeed Insights en producción: Performance ≥ 80 en móvil

### 8.5 Entrega al cliente

Documento de entrega (email o PDF):

```
ENTREGA FINAL — [Nombre Proyecto]

Sitio en vivo: https://[dominio]/

ARCHIVOS ENTREGADOS
ZIP con el child theme instalado en tu sitio:
- style.css — tokens de color, tipografía y componentes
- functions.php — carga de scripts y estilos
- js/main.js — animaciones y scroll suave

ADEMAS SE INCLUYE (en _entregas/):
- Guías Elementor de cada página ([pagina]-guide.md)
- Schema.org JSON-LD de cada página
- Campos SEO configurados en RankMath/Yoast

ACCESOS CONFIGURADOS
- WordPress admin: [URL] — credenciales en documento separado
- Elementor Pro: licencia activa en el sitio
- Google Analytics: ID [G-XXXXXXXX]
- Search Console: propiedad verificada

PÁGINAS ENTREGADAS
✅ Home (/)
✅ About (/about/)
✅ [Servicio 1] (/servicios/[s1]/)
✅ Contacto (/contacto/)

PRÓXIMOS PASOS RECOMENDADOS
1. Revisit el sitio en tu dispositivo y red
2. Confirmá que el formulario de contacto llega a tu casilla
3. Completá o actualizá los textos placeholder (si los hay)
4. Programá revisión SEO en 30 días
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
