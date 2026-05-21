# WebGen — AI Website Factory

Herramienta para crear sitios web de clase mundial con IA.  
Basada en el protocolo [nexu-io/open-design](https://github.com/nexu-io/open-design/tree/main/skills).

---

## ¿Qué es esto?

WebGen es un sistema de instrucciones para GitHub Copilot (y otros agentes de IA compatibles con SKILL.md) que guía la creación de sitios web a través de fases ordenadas, con diseño de clase mundial, animaciones modernas, y optimización SEO+GEO desde el inicio.

**No es una librería de código.** Es un sistema de conocimiento que le dice a la IA exactamente cómo crear cada tipo de archivo, en qué orden, con qué estándares.

---

## El workflow (obligatorio)

```
1. Brand Intake  →  DESIGN.md          (aprobación cliente)
       ↓
2. UIKit         →  uikit.html         (aprobación cliente)  
       ↓
3. Home Page     →  home.html          (aprobación cliente)
       ↓
4. Páginas       →  about, servicios, contacto, etc.
```

Cada fase requiere aprobación antes de avanzar. No hay shortcuts.

---

## Cómo usar

### Opción A — Con GitHub Copilot en VS Code

1. Clonar el repo y abrirlo como workspace en VS Code:
   ```bash
   git clone https://github.com/[tu-usuario]/webgen.git
   code webgen
   ```
2. Copilot leerá automáticamente `.github/copilot-instructions.md`
3. Para un nuevo proyecto de cliente:
   ```
   "Nuevo proyecto: [nombre del cliente]"
   ```
4. Copilot pedirá el brief y comenzará la Fase 1

### Opción B — Para un proyecto nuevo (crear subcarpeta)

1. Crear carpeta: `proyectos/[cliente]/`
2. Copiar `.github/copilot-instructions.md` al nuevo proyecto
3. Empezar con: "Brand intake para [cliente]"

### Opción C — Con Claude Code (compatible con open-design)

Los archivos `skills/*/SKILL.md` son compatibles con el protocolo de Claude Code skills y open-design.

---

## Estructura del repo

```
webgen/
├── .github/
│   └── copilot-instructions.md     ← CEREBRO: workflow + estándares completos
│
├── DESIGN.template.md              ← Template de 9 secciones para el design system
│
├── craft/                          ← Conocimiento universal (aplica a todo proyecto)
│   ├── typography.md               ← Reglas de tipografía
│   ├── animations.md               ← GSAP + Lenis patterns
│   ├── seo-geo.md                  ← Checklist SEO/GEO completo
│   └── anti-slop.md               ← Anti-patrones de diseño genérico
│
├── skills/                         ← Skills por fase (protocolo open-design)
│   ├── brand-intake/
│   │   └── SKILL.md               ← Fase 1: Brief → DESIGN.md
│   ├── uikit-gen/
│   │   └── SKILL.md               ← Fase 2: DESIGN.md → uikit.html
│   ├── home-gen/
│   │   └── SKILL.md               ← Fase 3: Copy → home.html
│   └── page-gen/
│       └── SKILL.md               ← Fase 4+: Tipo + Copy → [page].html
│
└── README.md                       ← Este archivo
```

---

## Stack tecnológico estándar

| Categoría | Tecnología | Por qué |
|---|---|---|
| Animaciones | GSAP 3 + ScrollTrigger | Industria estándar, gratis, máxima capacidad |
| Smooth scroll | Lenis 1.1 | Mejor smooth scroll del mercado |
| CSS | Custom properties + CSS Grid/Flexbox | Sin frameworks, máximo control |
| Fonts | Google Fonts (variable fonts) | Performance + variedad |
| JS | Vanilla ES6+ | Sin dependencias, rápido |
| Schema.org | JSON-LD inline | SEO/GEO optimizado |
| HTML | Semántico con ARIA | Accesibilidad + SEO |

---

## Principios de diseño

Nos inspiramos en los mejores:

| Empresa | Qué aplicamos |
|---|---|
| **Stripe** | Precisión tipográfica, gradientes sutiles, dark sections |
| **Linear** | Minimal oscuro, micro-interacciones veloces, grid limpio |
| **Vercel** | Contraste B&W, headers impactantes, documentación clara |
| **Framer** | Motion-forward, hero screens, interactividad como UX |
| **Loom** | Warmth, human-first copy, clarity over cleverness |
| **Raycast** | Dark + acento brillante, developer precision |
| **Arc Browser** | Personalidad fuerte, color con carácter |
| **Notion** | Whitespace, tipografía como layout, alta legibilidad |

---

## SEO + GEO: primero, no al final

Cada página generada incluye desde el inicio:
- `<title>` y `<meta description>` únicos con keyword
- Schema.org JSON-LD (WebPage, Organization, Service, FAQPage)
- Bloque de definición de entidad para LLMs
- FAQ estructurado compatible con ChatGPT, Gemini, Perplexity
- Core Web Vitals (imágenes con dimensiones, scripts diferidos, font-display swap)

---

## Para cada proyecto de cliente

Al usar WebGen con un cliente real, el flujo genera estos archivos:

```
[cliente]/
├── DESIGN.md          ← Output Fase 1 (aprobado)
├── uikit.html         ← Output Fase 2 (aprobado)
├── css/
│   └── theme.css      ← Extraído del UIKit
├── scripts/
│   └── main.js        ← GSAP + Lenis setup
├── img/               ← Imágenes (con prompts de generación en comentarios)
├── home.html          ← Output Fase 3 (aprobado)
├── about.html         ← Output Fase 4
├── servicios/
│   ├── [servicio-1].html
│   └── [servicio-2].html
└── contacto.html
```

---

## Compatibilidad

| Herramienta | Compatible | Notas |
|---|---|---|
| GitHub Copilot (VS Code) | ✅ | Lee `.github/copilot-instructions.md` |
| Claude Code | ✅ | SKILL.md compatible con su protocolo |
| Cursor | ✅ | Lee `.cursorrules` + instrucciones |
| open-design (nexu-io) | ✅ | Skills siguen el protocolo OD |

---

## Créditos y referencias

- Protocolo de skills: [nexu-io/open-design](https://github.com/nexu-io/open-design/tree/main/skills)
- DESIGN.md format: [awesome-claude-design](https://github.com/VoltAgent/awesome-claude-design)
- Craft references: inspirado en [guizang-ppt-skill](https://github.com/op7418/guizang-ppt-skill)
- Smooth scroll: [Lenis by darkroom.engineering](https://lenis.darkroom.engineering/)
- Animaciones: [GSAP by Greensock](https://gsap.com/)
