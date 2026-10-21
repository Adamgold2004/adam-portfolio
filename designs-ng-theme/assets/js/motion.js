/**
 * Adam Studio - Smooth scroll & mouse motion layer
 *
 * 1. Lenis soft scroll, synced to GSAP ScrollTrigger
 * 2. Custom cursor (dot + trailing ring) that grows over interactive elements
 * 3. Mouse parallax on the hero (background, glow, content)
 * 4. Subtle scroll-linked parallax on section images
 */
(function () {
  "use strict";

  if (typeof gsap === "undefined") return;

  const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const finePointer = window.matchMedia("(hover: hover) and (pointer: fine)").matches;
  if (reduced) return;

  document.addEventListener("DOMContentLoaded", () => {
    // ---------------------------------------------------------
    // 1. Soft scroll (Lenis) + ScrollTrigger sync
    // ---------------------------------------------------------
    let lenis = null;
    if (typeof Lenis !== "undefined") {
      lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smoothWheel: true,
      });

      if (typeof ScrollTrigger !== "undefined") {
        lenis.on("scroll", ScrollTrigger.update);
      }
      gsap.ticker.add((time) => lenis.raf(time * 1000));
      gsap.ticker.lagSmoothing(0);

      // Pause smooth scroll while the menu / lightbox lock the page
      const syncLock = () => {
        if (document.body.style.overflow === "hidden") lenis.stop();
        else lenis.start();
      };
      new MutationObserver(syncLock).observe(document.body, {
        attributes: true,
        attributeFilter: ["style"],
      });

      // Let the full-screen menu and dialogs scroll natively
      document
        .querySelectorAll("#fullscreen-menu-overlay, dialog")
        .forEach((el) => el.setAttribute("data-lenis-prevent", ""));

      // Smooth in-page anchors
      document.querySelectorAll('a[href^="#"]').forEach((a) => {
        const id = a.getAttribute("href");
        if (id.length < 2) return;
        a.addEventListener("click", (e) => {
          const target = document.querySelector(id);
          if (!target) return;
          e.preventDefault();
          lenis.scrollTo(target, { offset: -20 });
        });
      });

      window.adamLenis = lenis;
    }

    if (!finePointer) return;

    // ---------------------------------------------------------
    // 2. Custom cursor
    // ---------------------------------------------------------
    const dot = document.createElement("div");
    const ring = document.createElement("div");
    dot.className = "adam-cursor-dot";
    ring.className = "adam-cursor-ring";
    document.body.append(ring, dot);
    document.documentElement.classList.add("has-adam-cursor");

    gsap.set([dot, ring], { xPercent: -50, yPercent: -50, opacity: 0 });
    const dotX = gsap.quickTo(dot, "x", { duration: 0.1, ease: "power3.out" });
    const dotY = gsap.quickTo(dot, "y", { duration: 0.1, ease: "power3.out" });
    const ringX = gsap.quickTo(ring, "x", { duration: 0.45, ease: "power3.out" });
    const ringY = gsap.quickTo(ring, "y", { duration: 0.45, ease: "power3.out" });

    let shown = false;
    window.addEventListener("mousemove", (e) => {
      if (!shown) {
        shown = true;
        gsap.set([dot, ring], { x: e.clientX, y: e.clientY });
        gsap.to([dot, ring], { opacity: 1, duration: 0.3 });
      }
      dotX(e.clientX);
      dotY(e.clientY);
      ringX(e.clientX);
      ringY(e.clientY);
    });
    document.addEventListener("mouseleave", () => gsap.to([dot, ring], { opacity: 0, duration: 0.2 }));
    document.addEventListener("mouseenter", () => shown && gsap.to([dot, ring], { opacity: 1, duration: 0.2 }));

    const hoverSel = "a, button, .btn-magnetic, input, textarea, select, label, [role='button'], .filter-btn";
    document.addEventListener("mouseover", (e) => {
      if (e.target.closest(hoverSel)) ring.classList.add("is-hover");
    });
    document.addEventListener("mouseout", (e) => {
      if (e.target.closest(hoverSel)) ring.classList.remove("is-hover");
    });
    window.addEventListener("mousedown", () => ring.classList.add("is-down"));
    window.addEventListener("mouseup", () => ring.classList.remove("is-down"));

    // ---------------------------------------------------------
    // 3. Hero mouse parallax
    // ---------------------------------------------------------
    const hero = document.querySelector(".hero-section");
    if (hero) {
      const layers = [
        { el: hero.querySelector(".hero-slider-canvas"), depth: 14 },
        { el: hero.querySelector(".hero-ambient-glow"), depth: 50 },
        { el: hero.querySelector(".hero-content"), depth: -10 },
      ].filter((l) => l.el);

      const movers = layers.map((l) => ({
        x: gsap.quickTo(l.el, "x", { duration: 1.1, ease: "power3.out" }),
        y: gsap.quickTo(l.el, "y", { duration: 1.1, ease: "power3.out" }),
        depth: l.depth,
      }));

      hero.addEventListener("mousemove", (e) => {
        const r = hero.getBoundingClientRect();
        const nx = (e.clientX - r.left) / r.width - 0.5;
        const ny = (e.clientY - r.top) / r.height - 0.5;
        movers.forEach((m) => {
          m.x(nx * m.depth);
          m.y(ny * m.depth);
        });
      });
      hero.addEventListener("mouseleave", () =>
        movers.forEach((m) => {
          m.x(0);
          m.y(0);
        })
      );
    }
  });
})();
