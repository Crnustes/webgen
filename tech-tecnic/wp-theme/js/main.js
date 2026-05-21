/**
 * Tech Tecnic — main.js
 * GSAP + Lenis + Scroll reveal + Header scroll
 * Generado con WebGen · Fase 3
 */

// Progressive enhancement: añadir .js al <html>
// Activa los estilos de [data-reveal] en style.css
document.documentElement.classList.add('js');

// ─────────────────────────────────────────────────────────
// GSAP: registrar plugins
// ─────────────────────────────────────────────────────────
gsap.registerPlugin(ScrollTrigger);

// ─────────────────────────────────────────────────────────
// Lenis — smooth scroll
// ─────────────────────────────────────────────────────────
const lenis = new Lenis({
  lerp: 0.08,
  smooth: true,
});

lenis.on('scroll', ScrollTrigger.update);

gsap.ticker.add((time) => {
  lenis.raf(time * 1000);
});

gsap.ticker.lagSmoothing(0);

// ─────────────────────────────────────────────────────────
// Hero entrance — al cargar (sin ScrollTrigger)
// ─────────────────────────────────────────────────────────
const heroContent = document.querySelector('.wg-hero-content, .hero-content');
if (heroContent) {
  gsap.fromTo(
    heroContent.children,
    { opacity: 0, y: 20 },
    {
      opacity: 1,
      y: 0,
      stagger: 0.12,
      duration: 0.9,
      ease: 'power3.out',
      delay: 0.15,
    }
  );
}

// ─────────────────────────────────────────────────────────
// Scroll reveal — elementos con [data-reveal]
// ─────────────────────────────────────────────────────────
gsap.utils.toArray('[data-reveal]').forEach((el) => {
  const dir = el.dataset.reveal;
  const fromX = dir === 'left' ? -32 : dir === 'right' ? 32 : 0;
  const fromY = dir && dir !== 'up' ? 0 : 30;

  gsap.fromTo(
    el,
    { opacity: 0, y: fromY, x: fromX },
    {
      opacity: 1,
      y: 0,
      x: 0,
      duration: 0.8,
      ease: 'power3.out',
      scrollTrigger: {
        trigger: el,
        start: 'top 85%',
        once: true,
      },
    }
  );
});

// ─────────────────────────────────────────────────────────
// Stagger — grids de cards (.stagger-parent > .stagger-child)
// ─────────────────────────────────────────────────────────
gsap.utils.toArray('.stagger-parent').forEach((parent) => {
  const items = parent.querySelectorAll('.stagger-child');
  if (!items.length) return;

  gsap.fromTo(
    items,
    { opacity: 0, y: 40 },
    {
      opacity: 1,
      y: 0,
      stagger: 0.08,
      duration: 0.7,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: parent,
        start: 'top 80%',
        once: true,
      },
    }
  );
});

// ─────────────────────────────────────────────────────────
// Header scroll — añadir .scrolled al header al hacer scroll
// ─────────────────────────────────────────────────────────
const siteHeader = document.querySelector('.site-header, #masthead, header.elementor-location-header');

if (siteHeader) {
  ScrollTrigger.create({
    start: 'top -60px',
    onEnter:      () => siteHeader.classList.add('scrolled'),
    onLeaveBack:  () => siteHeader.classList.remove('scrolled'),
  });
}

// ─────────────────────────────────────────────────────────
// Compatibilidad Elementor — re-inicializar en widgets dinámicos
// ─────────────────────────────────────────────────────────
if (typeof elementorFrontend !== 'undefined') {
  elementorFrontend.hooks.addAction('frontend/element_ready/global', () => {
    ScrollTrigger.refresh();
  });
}
