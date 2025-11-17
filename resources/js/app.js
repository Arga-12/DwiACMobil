import './bootstrap';

import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  const hero = document.querySelector('.hero-layanan');
  const layers = Array.from(document.querySelectorAll('.hero-bg-layer'));

  if (!hero || layers.length === 0) return;

  // Prepare for smooth GPU transforms
  gsap.set(layers, { willChange: 'transform', transformOrigin: '50% 50%', force3D: true });

  if (!prefersReducedMotion) {
    // Scroll-based parallax (subtle)
    ScrollTrigger.matchMedia({
      '(min-width: 640px)': function () {
        gsap.to(layers, {
          yPercent: 30,
          ease: 'none',
          scrollTrigger: {
            trigger: hero,
            start: 'top top',
            end: 'bottom top',
            scrub: true,
          },
        });
      },
    });

    // Mouse-based parallax inside hero (very subtle)
    const maxShift = 12; // px
    const onMouseMove = (e) => {
      const rect = hero.getBoundingClientRect();
      const relX = (e.clientX - rect.left) / rect.width - 0.5; // -0.5 .. 0.5
      const relY = (e.clientY - rect.top) / rect.height - 0.5; // -0.5 .. 0.5

      gsap.to(layers, {
        x: relX * maxShift,
        y: relY * maxShift,
        scale: 1,
        duration: 0.6,
        ease: 'power2.out',
        overwrite: 'auto',
      });
    };

    const onMouseLeave = () => {
      gsap.to(layers, { x: 0, y: 0, scale: 1, duration: 0.6, ease: 'power2.out' });
    };

    hero.addEventListener('mousemove', onMouseMove);
    hero.addEventListener('mouseleave', onMouseLeave);

    // Cleanup (for hot reload/navigation)
    window.addEventListener('pagehide', () => {
      hero.removeEventListener('mousemove', onMouseMove);
      hero.removeEventListener('mouseleave', onMouseLeave);
    });
  }
});

