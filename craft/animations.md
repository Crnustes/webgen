# craft/animations.md
> Patrones de animación y motion — stack GSAP + Lenis.  
> Aplican a todo proyecto. Principio base: **animación con propósito, no decoración.**

---

## Stack estándar

```html
<!-- GSAP 3 (gratis para proyectos comerciales) -->
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/ScrollTrigger.min.js" defer></script>

<!-- Lenis — smooth scroll (darkroom.engineering) -->
<script src="https://cdn.jsdelivr.net/npm/lenis@1.1.14/dist/lenis.min.js" defer></script>
```

---

## Setup global (main.js)

```javascript
// ── Progressive enhancement ─────────────────────────────
// Añadir .js a <html> para activar CSS de animaciones
document.documentElement.classList.add('js');

// ── GSAP setup ──────────────────────────────────────────
gsap.registerPlugin(ScrollTrigger);

// ── Lenis smooth scroll ──────────────────────────────────
const lenis = new Lenis({
  lerp: 0.08,         // 0.05 = muy suave / 0.15 = más directo
  smooth: true,
  direction: 'vertical',
});

// Conectar Lenis con GSAP ticker (crítico para ScrollTrigger)
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => {
  lenis.raf(time * 1000);
});
gsap.ticker.lagSmoothing(0);

// Pausa Lenis cuando hay modals/overlays
// lenis.stop() / lenis.start()
```

---

## CSS de animaciones (con progressive enhancement)

```css
/* ── Base: visible sin JS (progressive enhancement) ── */
[data-reveal] {
  transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1),
              transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
}

/* ── Con JS: ocultar y preparar para animar ── */
.js [data-reveal]           { opacity: 0; transform: translateY(24px); }
.js [data-reveal="left"]    { opacity: 0; transform: translateX(-32px); }
.js [data-reveal="right"]   { opacity: 0; transform: translateX(32px); }
.js [data-reveal="scale"]   { opacity: 0; transform: scale(0.94); }
.js [data-reveal="fade"]    { opacity: 0; transform: none; }

/* ── Visible (JS añade esta clase) ── */
.js [data-reveal].is-visible { opacity: 1; transform: none; }

/* ── Delays ── */
[data-delay="1"] { transition-delay: 100ms; }
[data-delay="2"] { transition-delay: 200ms; }
[data-delay="3"] { transition-delay: 300ms; }
[data-delay="4"] { transition-delay: 400ms; }
[data-delay="5"] { transition-delay: 500ms; }

/* ── Reduced motion: respeto incondicional ── */
@media (prefers-reduced-motion: reduce) {
  *, *::before, *::after {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
  }
  [data-reveal],
  .js [data-reveal] {
    opacity: 1 !important;
    transform: none !important;
    transition: none !important;
  }
}
```

---

## Patrones GSAP

### 1. Scroll Reveal — elementos individuales

```javascript
gsap.utils.toArray('[data-reveal]').forEach(el => {
  const dir = el.dataset.reveal;
  const fromVars = { opacity: 0 };
  
  if (!dir || dir === 'up')    fromVars.y = 30;
  if (dir === 'left')          fromVars.x = -40;
  if (dir === 'right')         fromVars.x = 40;
  if (dir === 'scale')         fromVars.scale = 0.94;

  gsap.fromTo(el, fromVars, {
    opacity: 1, x: 0, y: 0, scale: 1,
    duration: 0.8,
    ease: 'power3.out',
    scrollTrigger: {
      trigger: el,
      start: 'top 85%',
      once: true,
    },
  });
});
```

### 2. Stagger — grids y listas

```javascript
gsap.utils.toArray('.stagger-grid').forEach(grid => {
  const items = grid.querySelectorAll(':scope > *');
  gsap.fromTo(items,
    { opacity: 0, y: 36 },
    {
      opacity: 1, y: 0,
      stagger: 0.07,
      duration: 0.7,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: grid,
        start: 'top 82%',
        once: true,
      },
    }
  );
});
```

### 3. Hero entrance — sin ScrollTrigger

```javascript
// Timeline para entrada coordinada del hero
const heroTl = gsap.timeline({ delay: 0.1 });

heroTl
  .from('.hero-kicker', { opacity: 0, y: 16, duration: 0.5, ease: 'power3.out' })
  .from('.hero-title', { opacity: 0, y: 24, duration: 0.7, ease: 'power3.out' }, '-=0.3')
  .from('.hero-lead', { opacity: 0, y: 18, duration: 0.6, ease: 'power2.out' }, '-=0.4')
  .from('.hero-cta-row', { opacity: 0, y: 12, duration: 0.5, ease: 'power2.out' }, '-=0.35')
  .from('.hero-visual', { opacity: 0, x: 32, duration: 0.9, ease: 'power3.out' }, '-=0.6');
```

### 4. Counter — números animados

```javascript
gsap.utils.toArray('.stat-number').forEach(el => {
  const target = parseFloat(el.dataset.value || el.textContent);
  const prefix = el.dataset.prefix || '';
  const suffix = el.dataset.suffix || '';
  
  gsap.fromTo({ val: 0 },
    { val: 0 },
    {
      val: target,
      duration: 1.8,
      ease: 'power2.out',
      onUpdate: function() {
        el.textContent = prefix + Math.round(this.targets()[0].val) + suffix;
      },
      scrollTrigger: {
        trigger: el,
        start: 'top 85%',
        once: true,
      },
    }
  );
});
```

### 5. Parallax — hero background / decorative elements

```javascript
// Parallax suave en elemento decorativo del hero
gsap.to('.hero-bg-decoration', {
  yPercent: -25,
  ease: 'none',
  scrollTrigger: {
    trigger: '.hero',
    start: 'top top',
    end: 'bottom top',
    scrub: 1.2,
  },
});
```

### 6. Header — sticky con cambio al hacer scroll

```javascript
ScrollTrigger.create({
  start: 'top -80',
  onEnter: () => document.getElementById('site-header').classList.add('is-scrolled'),
  onLeaveBack: () => document.getElementById('site-header').classList.remove('is-scrolled'),
});
```

```css
#site-header {
  position: fixed; top: 0; left: 0; right: 0; z-index: 100;
  transition: background 250ms ease, box-shadow 250ms ease;
  background: transparent;
}
#site-header.is-scrolled {
  background: rgba(var(--color-bg-rgb), 0.9);
  backdrop-filter: blur(12px);
  box-shadow: 0 1px 0 var(--color-border);
}
```

### 7. Nav mobile — hamburger

```javascript
const navToggle = document.querySelector('.nav-toggle');
const navMenu = document.querySelector('.nav-menu');

navToggle?.addEventListener('click', () => {
  const isOpen = navMenu.classList.toggle('is-open');
  navToggle.setAttribute('aria-expanded', isOpen);
  // Pausar Lenis cuando nav está abierto
  isOpen ? lenis.stop() : lenis.start();
});
```

### 8. FAQ Accordion — con animación de altura

```javascript
// Alternativa CSS pura (recomendada para accesibilidad)
// <details> y <summary> nativos
// Animar con CSS grid trick:

// CSS:
// .faq-answer { display: grid; grid-template-rows: 0fr; transition: grid-template-rows 300ms ease; }
// .faq-answer > div { overflow: hidden; }
// details[open] .faq-answer { grid-template-rows: 1fr; }
```

---

## Timing Reference

| Tipo de animación | Duración | Ease recomendado |
|---|---|---|
| Micro (hover, focus, active) | 150–200ms | `ease` o `power1.out` |
| UI feedback (click, toggle) | 200–300ms | `power2.out` |
| Reveal estándar | 600–800ms | `power3.out` |
| Hero entrance | 800–1000ms | `power3.out` |
| Transición de página | 400ms | `power2.inOut` |
| Parallax continuo | — (scrub) | `none` |
| Counter numérico | 1.5–2s | `power2.out` |

---

## Principios de motion

1. **Dirección lógica** — elementos entran desde donde "vienen" (texto desde izquierda, imágenes desde derecha)
2. **Stagger pequeño** — 60–80ms entre elementos del mismo grupo (más produce sensación de lentitud)
3. **Una cosa a la vez** — no animar más de 4 elementos simultáneamente
4. **Ease físico** — preferir `power3.out` (deceleración natural) sobre `linear`
5. **Nunca animar sin intención** — cada animación debe guiar la atención o recompensar el scroll
6. **will-change con moderación** — solo en elementos que sí se animan activamente

---

## Checklist antes de entregar

- [ ] `prefers-reduced-motion` implementado
- [ ] Progressive enhancement: contenido visible sin JS
- [ ] Hero entrance sin `scrollTrigger` (ya está en viewport)
- [ ] `once: true` en todos los scrollTrigger (no re-animar)
- [ ] Stagger ≤ 80ms entre items de grids
- [ ] `lenis.stop()` en overlays/modals
- [ ] `will-change` solo en elementos realmente animados
- [ ] Sin animaciones de más de 1.2s en elementos de contenido
