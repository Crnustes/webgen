---
name: brand-intake
description: |
  Fase 1: Convierte un brief de marca en un DESIGN.md completo con 9 secciones.
  Trigger: "nuevo proyecto", "brand intake", "empezar sitio", "dame el DESIGN.md".
  Prerequisito: ninguno. Esta es siempre la primera fase.
triggers:
  - "nuevo proyecto"
  - "brand intake"
  - "empezar sitio"
  - "nuevo cliente"
  - "crear design system"
  - "generar DESIGN.md"
od:
  mode: design-system
  outputs:
    primary: DESIGN.md
  inputs:
    - name: brand_name
      type: string
      required: true
    - name: description
      type: string
      required: true
    - name: colors
      type: string
      required: false
    - name: fonts
      type: string
      required: false
    - name: tone
      type: enum
      values: [formal, cercano, tecnico, aspiracional, playful]
      default: cercano
    - name: market
      type: string
      required: false
  craft:
    requires: [typography, anti-slop]
---

# brand-intake — Fase 1: Brief → DESIGN.md

## Objetivo

Convertir el brief del cliente en un `DESIGN.md` completo usando el formato de 9 secciones de awesome-claude-design. Este archivo es la fuente de verdad para todas las fases siguientes.

---

## Workflow

### Paso 1 — Recolección de información

Si el cliente no proveyó inputs completos, hacer estas preguntas en UNA sola respuesta (no una a la vez):

```
Para crear el sistema de diseño necesito estos datos:

1. **Nombre y descripción del negocio**
   → ¿Qué hace la empresa en 2 oraciones?

2. **Colores de marca**
   → ¿Tienen colores definidos? (hex, Pantone, o descripción)
   → Si no tienen, ¿qué sensación quieren transmitir? (frío/cálido, claro/oscuro, vibrante/neutro)

3. **Tipografía**
   → ¿Tienen fuentes definidas?
   → Si no, ¿hay sitios web que les gusten tipográficamente?

4. **Tono de comunicación**
   → ¿Cómo habla la marca? (formal/técnico/cercano/aspiracional)
   → ¿A quién le habla? (empresas B2B / consumidores / profesionales / etc.)

5. **Referencias de diseño**
   → 3 sitios web que les gusten visualmente (no necesariamente del sector)
   → ¿Qué les gusta de cada uno?

6. **Mercado y contexto**
   → ¿En qué países opera?
   → ¿Hay competidores directos de los que diferenciarse?

7. **Logo**
   → ¿Tienen logo? (URL o archivo)
   → ¿Es claro/oscuro/multicolor?
```

### Paso 2 — Análisis de referencias

Antes de generar el DESIGN.md, analizar las referencias dadas:

1. Identificar el **estilo visual dominante** de cada referencia
2. Extraer los principios aplicables: tipografía, paleta, espaciado, componentes
3. **No copiar** — identificar qué aspectos traducir al brief del cliente
4. Verificar contra `/craft/anti-slop.md` que los colores/tipografías elegidas no sean genéricos

### Paso 3 — Generación del DESIGN.md

Usar `DESIGN.template.md` como base. Completar las 9 secciones:

1. **Visual Theme & Atmosphere** — mood, referencias, palabras clave
2. **Color Palette & Roles** — tokens con valores reales (verificar contraste)
3. **Typography Rules** — familias, escala completa, reglas
4. **Component Stylings** — CSS de botones, cards, kicker, inputs
5. **Layout Principles** — container, grids, secciones
6. **Depth & Elevation** — sistema de sombras
7. **Do's and Don'ts** — específicos de esta marca
8. **Responsive Behavior** — breakpoints y reglas móvil
9. **Agent Prompt Guide** — instrucciones para generar componentes

### Paso 4 — Verificación antes de presentar

Antes de entregar el DESIGN.md al cliente, verificar:

- [ ] Ningún color de la lista prohibida en `/craft/anti-slop.md`
- [ ] Background no es `#ffffff` ni `#000000` puro
- [ ] Fuentes con carácter (no Roboto, Lato, Open Sans genéricas)
- [ ] Contraste `--color-text` sobre `--color-bg` ≥ 7:1
- [ ] Contraste `--color-text` sobre `--color-bg-subtle` ≥ 4.5:1
- [ ] Acento tiene personalidad real de marca
- [ ] Scale tipográfica usa `clamp()` en todos los sizes
- [ ] Do's y Don'ts son específicos, no genéricos

### Paso 5 — Presentación al cliente

Presentar el DESIGN.md con:
1. Breve explicación de las decisiones clave (por qué esas fuentes, por qué esos colores)
2. Mostrar los swatches de color con sus tokens
3. Mostrar los pares tipográficos con ejemplos de texto
4. Preguntar: "¿Algún ajuste antes de avanzar al UIKit?"

**⛔ NO generar ningún HTML hasta recibir aprobación explícita del DESIGN.md**

---

## Output esperado

Archivo `DESIGN.md` en la raíz del proyecto con:
- Las 9 secciones completas
- Tokens CSS reales (valores hex verificados)
- Escala tipográfica con `clamp()` 
- Componentes con CSS completo
- Layout rules con valores numéricos
- Do's/Don'ts específicos de la marca

---

## Nota sobre el DESIGN.md

El DESIGN.md NO es el theme.css final. Es el **plan de diseño** en Markdown que:
- Documenta las decisiones para el cliente
- Sirve como contexto para las fases siguientes (UIKit, Home, páginas)
- Es legible por humanos y por IA

El CSS real se genera en la Fase 2 (UIKit) dentro de `uikit.html` y luego se extrae a `css/theme.css`.
