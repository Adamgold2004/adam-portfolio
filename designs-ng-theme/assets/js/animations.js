/**
 * Adam Studio - GSAP Animations & Motion System (2026 Award Standard)
 *
 * Implements:
 * 1. Header reveal & sticky transition
 * 2. Hero cinematic sliding showcase (slide + crossfade + Ken Burns + split word reveal)
 * 3. About section coordinated entrance (left narrative + right feature cards)
 * 4. Services capabilities cards stagger with subtle scale & hover lift
 * 5. Featured portfolio horizontal ribbon swipe + 3D tilt
 * 6. Testimonials depth & focus transitions
 * 7. Creative team staggered entrance & portrait zoom
 * 8. Big CTA scale entrance & magnetic button physics
 * 9. Contact section & form reveal
 * 10. Dedicated pages animations & portfolio category filtering
 * 11. Resilient ScrollTrigger refresh on resource load
 */

document.addEventListener("DOMContentLoaded", () => {
  // -------------------------------------------------------------
  // Full-Screen Navigation Overlay (Open/Close + Floating Dock Sync)
  // -------------------------------------------------------------
  const menuTriggers = document.querySelectorAll(".nav-menu-trigger, .dock-btn-menu");
  const menuOverlay = document.getElementById("fullscreen-menu-overlay");
  const menuCloseButtons = document.querySelectorAll(".nav-menu-close");
  const overlayLinks = document.querySelectorAll(".overlay-menu-link, .overlay-sub-link, .overlay-mini-cta");
  const overlayItems = document.querySelectorAll(".fullscreen-menu-list .menu-item-wrap");
  const overlaySubLinks = document.querySelectorAll(".overlay-sub-list li");
  const overlayDossierBlocks = document.querySelectorAll(".dossier-block, .overlay-commission-box");
  const overlayBottom = document.querySelector(".overlay-bottom-bar");
  const overlayTop = document.querySelector(".overlay-top-bar");
  const overlayColHeaders = document.querySelectorAll(".overlay-col-header");
  const dockIsland = document.querySelector(".dock-island");

  let isMenuOpen = false;
  let menuTimeline = null;

  const openMenu = () => {
    if (isMenuOpen || !menuOverlay) return;
    isMenuOpen = true;
    menuOverlay.scrollTop = 0;
    menuOverlay.classList.add("active");
    menuOverlay.setAttribute("aria-hidden", "false");
    menuTriggers.forEach(t => t.setAttribute("aria-expanded", "true"));
    document.body.style.overflow = "hidden";

    if (typeof gsap !== "undefined") {
      if (dockIsland) {
        gsap.to(dockIsland, { opacity: 0, duration: 0.25, ease: "power2.in" });
      }

      if (menuTimeline) menuTimeline.kill();
      // Reset any leftover animated styles
      gsap.set([overlayItems, overlaySubLinks, overlayDossierBlocks, overlayColHeaders], { clearProps: "opacity,transform" });

      menuTimeline = gsap.timeline();

      // Backdrop & container fade
      menuTimeline.fromTo(menuOverlay, 
        { opacity: 0 }, 
        { opacity: 1, duration: 0.35, ease: "power2.out" }
      );

      // Top bar & Bottom bar entrance
      if (overlayTop && overlayBottom) {
        menuTimeline.fromTo([overlayTop, overlayBottom],
          { opacity: 0, y: 12 },
          { opacity: 1, y: 0, duration: 0.35, ease: "power2.out" },
          "-=0.25"
        );
      }

      // Column headers entrance
      if (overlayColHeaders.length > 0) {
        menuTimeline.fromTo(overlayColHeaders,
          { opacity: 0, y: 12 },
          { opacity: 1, y: 0, duration: 0.3, stagger: 0.05, ease: "power2.out" },
          "-=0.25"
        );
      }

      // Column 1: Primary navigation items
      if (overlayItems.length > 0) {
        menuTimeline.fromTo(overlayItems,
          { opacity: 0, y: 25 },
          { opacity: 1, y: 0, duration: 0.35, stagger: 0.035, ease: "power2.out" },
          "-=0.25"
        );
      }

      // Column 2: Capabilities list items
      if (overlaySubLinks.length > 0) {
        menuTimeline.fromTo(overlaySubLinks,
          { opacity: 0, y: 15 },
          { opacity: 1, y: 0, duration: 0.35, stagger: 0.025, ease: "power2.out" },
          "-=0.3"
        );
      }

      // Column 3: Dossier blocks & commission box
      if (overlayDossierBlocks.length > 0) {
        menuTimeline.fromTo(overlayDossierBlocks,
          { opacity: 0, y: 15 },
          { opacity: 1, y: 0, duration: 0.35, stagger: 0.03, ease: "power2.out" },
          "-=0.3"
        );
      }
    }
  };

  const closeMenu = () => {
    if (!isMenuOpen || !menuOverlay) return;
    isMenuOpen = false;
    menuOverlay.setAttribute("aria-hidden", "true");
    menuTriggers.forEach(t => t.setAttribute("aria-expanded", "false"));

    if (typeof gsap !== "undefined") {
      if (menuTimeline) menuTimeline.kill();
      menuTimeline = gsap.timeline({
        onComplete: () => {
          menuOverlay.classList.remove("active");
          document.body.style.overflow = "";
          // Clear all animated props so next open is 100% clean and never missing elements
          gsap.set([overlayItems, overlaySubLinks, overlayDossierBlocks, overlayColHeaders], { clearProps: "all" });
          if (dockIsland) {
            gsap.to(dockIsland, { opacity: 1, duration: 0.3, ease: "power2.out", clearProps: "transform" });
          }
        }
      });

      // Quick fade out
      menuTimeline.to(menuOverlay, {
        opacity: 0,
        duration: 0.25,
        ease: "power2.out"
      });
    } else {
      menuOverlay.classList.remove("active");
      document.body.style.overflow = "";
      if (dockIsland) {
        dockIsland.style.opacity = "1";
        dockIsland.style.transform = "none";
      }
    }
  };

  menuTriggers.forEach(trigger => {
    trigger.addEventListener("click", openMenu);
  });

  menuCloseButtons.forEach(btn => {
    btn.addEventListener("click", closeMenu);
  });

  // Close when clicking an overlay navigation link
  overlayLinks.forEach(link => {
    link.addEventListener("click", () => {
      closeMenu();
    });
  });

  // Close with Escape key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && isMenuOpen) {
      closeMenu();
    }
  });

  // Respect prefers-reduced-motion
  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (prefersReducedMotion) {
    return;
  }

  // Check GSAP & ScrollTrigger
  if (typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
    console.warn("[Adam Studio] GSAP or ScrollTrigger not detected.");
    return;
  }

  gsap.registerPlugin(ScrollTrigger);

  // -------------------------------------------------------------
  // 1. Header Reveal & Sticky Transition
  // -------------------------------------------------------------
  const siteHeader = document.querySelector(".site-header");
  if (siteHeader) {
    gsap.from(siteHeader, {
      y: -50,
      opacity: 0,
      duration: 1.1,
      ease: "power3.out"
    });

    // Technique 7: Toggle Class with ScrollTrigger.create
    ScrollTrigger.create({
      trigger: "body",
      start: "40px top",
      onEnter: () => siteHeader.classList.add("scrolled"),
      onLeaveBack: () => siteHeader.classList.remove("scrolled")
    });
  }

  if (dockIsland) {
    gsap.fromTo(dockIsland, 
      { opacity: 0 },
      { opacity: 1, duration: 0.8, ease: "power2.out", delay: 0.2, clearProps: "transform" }
    );
  }

  // -------------------------------------------------------------
  // 2. Hero Section: Cinematic Slider, Split Word Reveal & Parallax
  // -------------------------------------------------------------
  const heroWords = gsap.utils.toArray(".gsap-hero-title .title-word");
  if (heroWords.length > 0) {
    gsap.from(heroWords, {
      y: 65,
      opacity: 0,
      rotateX: 20,
      duration: 1.3,
      stagger: 0.08,
      ease: "power4.out",
      delay: 0.15
    });
  }

  const heroBadges = gsap.utils.toArray(".gsap-hero-badge");
  const heroSub = document.querySelector(".gsap-hero-sub");
  const heroActions = document.querySelector(".gsap-hero-actions");
  const heroNav = document.querySelector(".gsap-hero-nav");
  const heroStats = document.querySelector(".gsap-hero-stats");
  const heroScrollCue = document.querySelector(".hero-scroll-cue");

  const heroElements = [
    ...heroBadges,
    heroSub,
    heroActions,
    heroNav,
    heroStats,
    heroScrollCue
  ].filter(Boolean);

  if (heroElements.length > 0) {
    gsap.from(heroElements, {
      y: 35,
      opacity: 0,
      duration: 1.1,
      stagger: 0.12,
      ease: "power3.out",
      delay: 0.4
    });
  }

  // Cinematic Multi-Slide Background Showcase Controller
  const heroSlides = gsap.utils.toArray(".hero-slider-canvas .hero-slide");
  const heroDots = gsap.utils.toArray(".slider-dots-group .slider-dot-btn");
  const heroProgressFill = document.getElementById("heroProgressFill");
  const heroSlideTag = document.getElementById("heroSlideTag");
  
  if (heroSlides.length > 1) {
    let currentSlide = 0;
    const totalSlides = heroSlides.length;
    const slideDuration = 7.0; // seconds
    let slideTween = null;
    let autoAdvanceTimer = null;
    let isTransitioning = false;

    const goToSlide = (nextIndex) => {
      if (nextIndex === currentSlide || isTransitioning) return;
      isTransitioning = true;
      
      const prevSlideEl = heroSlides[currentSlide];
      const nextSlideEl = heroSlides[nextIndex];
      const prevMedia = prevSlideEl.querySelector(".hero-slide-media");
      const nextMedia = nextSlideEl.querySelector(".hero-slide-media");

      // Animate out previous slide with subtle horizontal drift and fade
      if (prevMedia) {
        gsap.to(prevMedia, {
          xPercent: -3,
          duration: 1.4,
          ease: "power2.inOut"
        });
      }
      gsap.to(prevSlideEl, {
        opacity: 0,
        duration: 1.3,
        ease: "power2.inOut",
        onComplete: () => {
          prevSlideEl.classList.remove("active");
          if (prevMedia) gsap.set(prevMedia, { xPercent: 0 });
          isTransitioning = false;
        }
      });

      // Animate in next slide with silky horizontal slide & Ken Burns zoom
      nextSlideEl.classList.add("active");
      if (nextMedia) {
        gsap.fromTo(nextMedia,
          { xPercent: 4, scale: 1.08 },
          { xPercent: 0, scale: 1.0, duration: 1.6, ease: "power2.out" }
        );
      }
      gsap.fromTo(nextSlideEl, 
        { opacity: 0 }, 
        { opacity: 1, duration: 1.4, ease: "power2.inOut" }
      );

      // Update slide metadata tag with elegant fade
      if (heroSlideTag) {
        const metaText = nextSlideEl.getAttribute("data-meta") || "";
        gsap.to(heroSlideTag, {
          y: -8,
          opacity: 0,
          duration: 0.25,
          onComplete: () => {
            const label = heroSlideTag.querySelector(".slide-meta-label");
            if (label) label.textContent = metaText;
            gsap.to(heroSlideTag, { y: 0, opacity: 1, duration: 0.35 });
          }
        });
      }

      // Update dot buttons
      heroDots.forEach((dot, idx) => {
        dot.classList.toggle("active", idx === nextIndex);
      });

      currentSlide = nextIndex;
      startProgressTimer();
    };

    const startProgressTimer = () => {
      if (slideTween) slideTween.kill();
      if (autoAdvanceTimer) clearTimeout(autoAdvanceTimer);

      if (heroProgressFill) {
        gsap.set(heroProgressFill, { width: "0%" });
        slideTween = gsap.to(heroProgressFill, {
          width: "100%",
          duration: slideDuration,
          ease: "none"
        });
      }

      autoAdvanceTimer = setTimeout(() => {
        const nextIndex = (currentSlide + 1) % totalSlides;
        goToSlide(nextIndex);
      }, slideDuration * 1000);
    };

    // Dot click interaction
    heroDots.forEach((dot, idx) => {
      dot.addEventListener("click", () => {
        goToSlide(idx);
      });
    });

    // Start initial slider cycle
    startProgressTimer();
  }

  // Ambient parallax on scroll for Hero
  const heroCanvas = document.querySelector(".hero-slider-canvas");
  const heroContent = document.querySelector(".hero-content");
  if (heroCanvas) {
    gsap.to(heroCanvas, {
      yPercent: 15,
      ease: "none",
      scrollTrigger: {
        trigger: ".hero-section",
        start: "top top",
        end: "bottom top",
        scrub: true
      }
    });
  }

  if (heroContent) {
    gsap.to(heroContent, {
      y: -40,
      opacity: 0.5,
      ease: "none",
      scrollTrigger: {
        trigger: ".hero-section",
        start: "top top",
        end: "bottom top",
        scrub: true
      }
    });
  }

  // -------------------------------------------------------------
  // 3. Editorial Section Headings (Technique 1: Basic Trigger with toggleActions)
  // -------------------------------------------------------------
  const sectionHeadings = gsap.utils.toArray(".about-section .gsap-reveal, .services-section .gsap-reveal, .testimonials-section .gsap-reveal, .team-section .gsap-reveal, .contact-section .gsap-reveal");
  if (sectionHeadings.length > 0) {
    sectionHeadings.forEach((heading) => {
      gsap.fromTo(heading,
        { y: 35, opacity: 0 },
        {
          y: 0,
          opacity: 1,
          duration: 0.9,
          ease: "power3.out",
          scrollTrigger: {
            trigger: heading,
            start: "top 88%",
            toggleActions: "play none none reverse"
          }
        }
      );
    });
  }

  // -------------------------------------------------------------
  // 4. Batch & Staggered Reveals (Technique 5: ScrollTrigger.batch)
  // -------------------------------------------------------------
  ScrollTrigger.batch(".service-card, .gsap-service-card, .feature-box, .gsap-reveal-card, .testimonial-card, .gsap-testimonial-card, .team-member, .project-step-card, .contact-info-item", {
    start: "top 90%",
    once: true,
    onEnter: (batch) => {
      gsap.fromTo(batch,
        { y: 48, opacity: 0 },
        {
          y: 0,
          opacity: 1,
          duration: 0.85,
          stagger: 0.1,
          ease: "power3.out",
          overwrite: "auto"
        }
      );
    }
  });

  // Testimonials depth focus on hover: siblings dim softly
  const testimonialCards = document.querySelectorAll(".testimonial-card, .gsap-testimonial-card");
  if (testimonialCards.length > 0) {
    testimonialCards.forEach(card => {
      card.addEventListener("mouseenter", () => {
        testimonialCards.forEach(other => {
          if (other !== card) {
            gsap.to(other, { opacity: 0.55, duration: 0.35, ease: "power2.out" });
          }
        });
      });
      card.addEventListener("mouseleave", () => {
        testimonialCards.forEach(other => {
          gsap.to(other, { opacity: 1, duration: 0.35, ease: "power2.out" });
        });
      });
    });
  }

  // Team hover photo zoom & card lift
  const teamMembers = document.querySelectorAll(".team-member");
  if (teamMembers.length > 0) {
    teamMembers.forEach(member => {
      const img = member.querySelector("img, .team-img-cover, .team-photo-placeholder");
      const info = member.querySelector(".team-info");

      member.addEventListener("mouseenter", () => {
        if (img) gsap.to(img, { scale: 1.06, duration: 0.45, ease: "power2.out" });
        if (info) gsap.to(info, { y: -6, duration: 0.35, ease: "power2.out" });
      });

      member.addEventListener("mouseleave", () => {
        if (img) gsap.to(img, { scale: 1, duration: 0.55, ease: "power3.out" });
        if (info) gsap.to(info, { y: 0, duration: 0.45, ease: "power3.out" });
      });
    });
  }

  // -------------------------------------------------------------
  // 5. Featured Portfolio: Smooth Horizontal Ribbon Swipe & 3D Tilt (Technique 4: Pin + Scrub)
  // -------------------------------------------------------------
  const swipeSection = document.querySelector(".portfolio-swipe-section");
  const cardsWrapper = document.querySelector(".portfolio-cards-wrapper");
  const portfolioCards = gsap.utils.toArray(".portfolio-card");

  if (swipeSection && cardsWrapper && portfolioCards.length > 0) {
    if (window.innerWidth > 992) {
      const getScrollAmount = () => -(cardsWrapper.scrollWidth - window.innerWidth + 140);

      gsap.to(cardsWrapper, {
        x: getScrollAmount,
        ease: "none",
        scrollTrigger: {
          trigger: swipeSection,
          pin: true,
          scrub: 1.0,
          invalidateOnRefresh: true,
          anticipatePin: 1,
          start: "top top",
          end: () => "+=" + Math.max(1200, Math.abs(getScrollAmount())),
          once: false
        }
      });
    }

    // Refined 3D Tilt for cards
    portfolioCards.forEach(card => {
      card.addEventListener("mousemove", (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        const centerX = rect.width / 2;
        const centerY = rect.height / 2;
        const rotateX = ((y - centerY) / centerY) * -6;
        const rotateY = ((x - centerX) / centerX) * 6;

        gsap.to(card, {
          rotateX,
          rotateY,
          duration: 0.4,
          ease: "power2.out",
          transformPerspective: 1000
        });
      });

      card.addEventListener("mouseleave", () => {
        gsap.to(card, {
          rotateX: 0,
          rotateY: 0,
          duration: 0.6,
          ease: "power3.out"
        });
      });
    });
  }

  // -------------------------------------------------------------
  // 8. Big CTA Section & Magnetic Button Physics
  // -------------------------------------------------------------
  const bigCtaSection = document.querySelector(".big-cta-section");
  if (bigCtaSection) {
    const ctaReveals = bigCtaSection.querySelectorAll(".gsap-reveal");
    if (ctaReveals.length > 0) {
      gsap.from(ctaReveals, {
        y: 40,
        opacity: 0,
        scale: 0.97,
        duration: 1.0,
        stagger: 0.12,
        ease: "power3.out",
        scrollTrigger: {
          trigger: bigCtaSection,
          start: "top 80%",
          once: true
        }
      });
    }
  }

  // Magnetic Button Physics
  const magneticButtons = document.querySelectorAll(".btn-magnetic");
  magneticButtons.forEach(btn => {
    btn.addEventListener("mousemove", (e) => {
      const rect = btn.getBoundingClientRect();
      const x = (e.clientX - rect.left - rect.width / 2) * 0.32;
      const y = (e.clientY - rect.top - rect.height / 2) * 0.32;

      gsap.to(btn, {
        x,
        y,
        duration: 0.25,
        ease: "power2.out"
      });
    });

    btn.addEventListener("mouseleave", () => {
      gsap.to(btn, {
        x: 0,
        y: 0,
        duration: 0.55,
        ease: "elastic.out(1, 0.4)"
      });
    });
  });

  // -------------------------------------------------------------
  // 9. Contact Section: Coordinated Left Column & Form Card
  // -------------------------------------------------------------
  const contactSection = document.querySelector(".contact-section");
  if (contactSection) {
    const leftReveals = contactSection.querySelectorAll(".contact-left-col .gsap-reveal");
    const formCard = contactSection.querySelector(".contact-form-card");

    if (leftReveals.length > 0) {
      gsap.fromTo(leftReveals,
        { y: 35, opacity: 0 },
        {
          y: 0,
          opacity: 1,
          duration: 0.85,
          stagger: 0.12,
          ease: "power3.out",
          scrollTrigger: {
            trigger: contactSection,
            start: "top 92%",
            once: true
          }
        }
      );
    }

    if (formCard) {
      gsap.fromTo(formCard,
        { y: 45, opacity: 0 },
        {
          y: 0,
          opacity: 1,
          duration: 0.9,
          ease: "power3.out",
          scrollTrigger: {
            trigger: formCard,
            start: "top 92%",
            once: true
          }
        }
      );
    }
  }

  // -------------------------------------------------------------
  // 10. Dedicated Pages & General Element Reveals
  // -------------------------------------------------------------
  const pageHeaders = gsap.utils.toArray(".page-header-spacious .gsap-reveal, .page-hero .gsap-reveal");
  if (pageHeaders.length > 0) {
    gsap.fromTo(pageHeaders,
      { y: 35, opacity: 0 },
      {
        y: 0,
        opacity: 1,
        duration: 0.95,
        stagger: 0.1,
        ease: "power3.out",
        delay: 0.1
      }
    );
  }

  const projectStepCards = gsap.utils.toArray(".project-step-card, .process-step-grid .service-card, .process-step-grid .feature-box");
  if (projectStepCards.length > 0) {
    gsap.fromTo(projectStepCards,
      { y: 40, opacity: 0 },
      {
        y: 0,
        opacity: 1,
        duration: 0.85,
        stagger: 0.1,
        ease: "power3.out",
        scrollTrigger: {
          trigger: ".project-steps-grid, .process-step-grid",
          start: "top 92%",
          once: true
        }
      }
    );
  }

  // -------------------------------------------------------------
  // 11. Portfolio Theatre: Per-Row Dual-Sided Zoom & Rich Stage ScrollTrigger
  // -------------------------------------------------------------
  const theatreRows = gsap.utils.toArray(".gsap-theatre-row");

  if (theatreRows.length > 0) {
    ScrollTrigger.matchMedia({
      "(min-width: 1025px)": function() {
        theatreRows.forEach((row) => {
          const leftPanel = row.querySelector(".zoom-panel-left");
          const rightPanel = row.querySelector(".zoom-panel-right");
          const card = row.querySelector(".theatre-project-card");
          const mediaImg = row.querySelector(".theatre-card-media img");
          const title = row.querySelector(".theatre-card-title");
          const desc = row.querySelector(".theatre-card-desc");
          const badges = row.querySelectorAll(".theatre-media-badges span, .theatre-client-tag, .theatre-proj-num, .theatre-discipline-chip");
          const actions = row.querySelector(".theatre-card-actions");

          // Scrubbed 3D dramatic zoom on flanking left and right panels
          if (leftPanel) {
            gsap.fromTo(leftPanel,
              { scale: 0.65, rotateY: -26, rotateX: 6, opacity: 0.45, yPercent: -18 },
              {
                scale: 1.35,
                rotateY: 0,
                rotateX: 0,
                opacity: 1,
                yPercent: 18,
                ease: "none",
                scrollTrigger: {
                  trigger: row,
                  start: "top 95%",
                  end: "bottom 15%",
                  scrub: 1.2
                }
              }
            );
          }

          if (rightPanel) {
            gsap.fromTo(rightPanel,
              { scale: 0.65, rotateY: 26, rotateX: -6, opacity: 0.45, yPercent: 18 },
              {
                scale: 1.35,
                rotateY: 0,
                rotateX: 0,
                opacity: 1,
                yPercent: -18,
                ease: "none",
                scrollTrigger: {
                  trigger: row,
                  start: "top 95%",
                  end: "bottom 15%",
                  scrub: 1.2
                }
              }
            );
          }

          // Editorial central card entrance with resilient fromTo
          if (card) {
            const cardTl = gsap.timeline({
              scrollTrigger: {
                trigger: row,
                start: "top 90%",
                once: true
              }
            });

            cardTl.fromTo(card,
              { y: 50, opacity: 0 },
              { y: 0, opacity: 1, duration: 1.0, ease: "power3.out" }
            );

            if (mediaImg) {
              cardTl.fromTo(mediaImg,
                { scale: 1.16 },
                { scale: 1.0, duration: 1.4, ease: "power2.out" },
                0
              );
            }

            if (badges.length > 0) {
              cardTl.fromTo(badges,
                { opacity: 0, y: -10 },
                { opacity: 1, y: 0, duration: 0.55, stagger: 0.05, ease: "power2.out" },
                0.2
              );
            }

            if (title) {
              cardTl.fromTo(title,
                { y: 28, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.85, ease: "power3.out" },
                0.25
              );
            }

            if (desc) {
              cardTl.fromTo(desc,
                { y: 20, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.75, ease: "power3.out" },
                0.35
              );
            }

            if (actions) {
              cardTl.fromTo(actions,
                { y: 18, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.65, ease: "power3.out" },
                0.45
              );
            }
          }
        });
      },
      "(max-width: 1024px)": function() {
        // Mobile clean reveals without heavy 3D transforms
        theatreRows.forEach((row) => {
          const card = row.querySelector(".theatre-project-card");
          if (card) {
            gsap.fromTo(card,
              { y: 35, opacity: 0 },
              {
                y: 0,
                opacity: 1,
                duration: 0.85,
                ease: "power3.out",
                scrollTrigger: {
                  trigger: row,
                  start: "top 90%",
                  once: true
                }
              }
            );
          }
        });
      }
    });
  }

  // Footer reveal
  const footerElement = document.querySelector(".gsap-footer");
  if (footerElement) {
    gsap.from(footerElement, {
      y: 35,
      opacity: 0,
      duration: 0.9,
      ease: "power3.out",
      scrollTrigger: {
        trigger: footerElement,
        start: "top 92%",
        once: true
      }
    });
  }

  // -------------------------------------------------------------
  // 12. Portfolio Category Filtering (Portfolio Page)
  // -------------------------------------------------------------
  const filterButtons = document.querySelectorAll(".filter-btn");
  const projectCards = document.querySelectorAll(".portfolio-item-filterable");

  if (filterButtons.length > 0 && projectCards.length > 0) {
    filterButtons.forEach(button => {
      button.addEventListener("click", () => {
        filterButtons.forEach(btn => btn.classList.remove("active"));
        button.classList.add("active");

        const targetCat = button.getAttribute("data-category");

        projectCards.forEach(card => {
          const cardCats = card.getAttribute("data-categories") || "";
          if (targetCat === "all" || cardCats.includes(targetCat)) {
            gsap.to(card, {
              opacity: 1,
              scale: 1,
              duration: 0.35,
              display: "flex",
              ease: "power2.out"
            });
          } else {
            gsap.to(card, {
              opacity: 0,
              scale: 0.95,
              duration: 0.25,
              display: "none",
              ease: "power2.in"
            });
          }
        });

        // Recalculate ScrollTrigger triggers after layout change
        setTimeout(() => {
          ScrollTrigger.refresh();
        }, 360);
      });
    });
  }

  // -------------------------------------------------------------
  // 13. Clip-Path / Curtain Image Reveals (Technique 6)
  // -------------------------------------------------------------
  const clipRevealImages = gsap.utils.toArray(".theatre-card-media img, .card-image-wrap img, .team-photo-wrap img, .single-project-hero-media img, .zoom-panel-inner img");
  clipRevealImages.forEach((img) => {
    const container = img.closest(".theatre-card-media, .card-image-wrap, .team-photo-wrap, .single-project-hero-media, .zoom-panel-inner") || img;
    gsap.fromTo(img,
      { clipPath: "inset(100% 0% 0% 0%)", scale: 1.15 },
      {
        clipPath: "inset(0% 0% 0% 0%)",
        scale: 1,
        duration: 1.35,
        ease: "power4.inOut",
        scrollTrigger: {
          trigger: container,
          start: "top 85%",
          once: true
        }
      }
    );
  });

  // -------------------------------------------------------------
  // 14. Architectural Atmospheric Depth Scrub (Technique 2: Scrub)
  // -------------------------------------------------------------
  const atmosphericCrosshairs = gsap.utils.toArray(".corner-crosshair, .editorial-coord-tag");
  atmosphericCrosshairs.forEach((item, idx) => {
    const driftY = (idx % 2 === 0 ? 14 : -14);
    gsap.to(item, {
      y: driftY,
      ease: "none",
      scrollTrigger: {
        trigger: item,
        start: "top bottom",
        end: "bottom top",
        scrub: 1.5
      }
    });
  });

  // -------------------------------------------------------------
  // 15. Split Hero Half-Image Cinematic GSAP Suite (6x2 Half Layout)
  // -------------------------------------------------------------
  const splitHeroSections = gsap.utils.toArray(".page-hero-split");
  splitHeroSections.forEach((hero) => {
    const frame = hero.querySelector(".gsap-hero-half-frame");
    const img = hero.querySelector(".gsap-hero-half-img");
    const badge = hero.querySelector(".hero-half-badge-float");
    const crosshairs = hero.querySelectorAll(".corner-crosshair");

    if (!frame || !img) return;

    // 15a. Curtain Clip-Path Reveal on Entrance
    gsap.fromTo(img,
      { clipPath: "inset(100% 0% 0% 0%)", scale: 1.15 },
      {
        clipPath: "inset(0% 0% 0% 0%)",
        scale: 1,
        duration: 1.4,
        ease: "power4.inOut",
        delay: 0.15
      }
    );

    // Floating Badge Entrance
    if (badge) {
      gsap.fromTo(badge,
        { opacity: 0, y: 18, scale: 0.95 },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 0.7,
          delay: 0.65,
          ease: "power3.out"
        }
      );
    }

    // Corner crosshairs pop
    if (crosshairs.length > 0) {
      gsap.fromTo(crosshairs,
        { opacity: 0, scale: 0.4, rotation: -45 },
        {
          opacity: 0.7,
          scale: 1,
          rotation: 0,
          duration: 0.8,
          delay: 0.4,
          ease: "back.out(1.7)"
        }
      );
    }

    // 15b. Scroll Parallax Scrub (Technique 2)
    // Frame gently moves upward as page scrolls down
    gsap.to(frame, {
      y: -32,
      ease: "none",
      scrollTrigger: {
        trigger: hero,
        start: "top top",
        end: "bottom top",
        scrub: 1.2
      }
    });

    // Inner image drifts slightly within frame creating dimensional depth parallax
    gsap.to(img, {
      yPercent: 10,
      ease: "none",
      scrollTrigger: {
        trigger: hero,
        start: "top top",
        end: "bottom top",
        scrub: 1.2
      }
    });

    // 15c. Interactive 3D Perspective Tilt on Hover / Mouse movement
    if (window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
      const xTo = gsap.quickTo(frame, "rotateY", { duration: 0.5, ease: "power2.out" });
      const yTo = gsap.quickTo(frame, "rotateX", { duration: 0.5, ease: "power2.out" });
      const badgeX = badge ? gsap.quickTo(badge, "x", { duration: 0.5, ease: "power2.out" }) : null;
      const badgeY = badge ? gsap.quickTo(badge, "y", { duration: 0.5, ease: "power2.out" }) : null;

      frame.addEventListener("mousemove", (e) => {
        const rect = frame.getBoundingClientRect();
        const normX = ((e.clientX - rect.left) / rect.width - 0.5) * 2; // -1 to 1
        const normY = ((e.clientY - rect.top) / rect.height - 0.5) * 2; // -1 to 1

        xTo(normX * 7);
        yTo(-normY * 7);

        if (badgeX && badgeY) {
          badgeX(normX * 8);
          badgeY(normY * 8);
        }
      });

      frame.addEventListener("mouseenter", () => {
        gsap.to(img, { scale: 1.04, duration: 0.5, ease: "power2.out" });
      });

      frame.addEventListener("mouseleave", () => {
        gsap.to(frame, { rotateX: 0, rotateY: 0, duration: 0.8, ease: "power3.out" });
        gsap.to(img, { scale: 1, duration: 0.8, ease: "power3.out" });
        if (badge) {
          gsap.to(badge, { x: 0, y: 0, duration: 0.8, ease: "power3.out" });
        }
      });
    }
  });

  // -------------------------------------------------------------
  // 16. Layered Editorial Image Composition Motion Suite (Distinctive Ideas & Cross-Page)
  // -------------------------------------------------------------
  const editorialCompositions = gsap.utils.toArray(".editorial-layer-composition");
  editorialCompositions.forEach((comp) => {
    const primaryFrame = comp.querySelector(".editorial-layer-primary");
    const offsetFrame = comp.querySelector(".editorial-layer-offset");
    const primaryImg = comp.querySelector(".editorial-img-main");
    const offsetImg = comp.querySelector(".editorial-img-sub");
    const badge = comp.querySelector(".editorial-layer-badge");

    // 16a. Curtain Clip-Path Reveal when scrolling into view
    if (primaryImg) {
      gsap.fromTo(primaryImg,
        { clipPath: "inset(100% 0% 0% 0%)", scale: 1.15 },
        {
          clipPath: "inset(0% 0% 0% 0%)",
          scale: 1,
          duration: 1.35,
          ease: "power4.inOut",
          scrollTrigger: {
            trigger: comp,
            start: "top 85%",
            once: true
          }
        }
      );
    }

    if (offsetImg) {
      gsap.fromTo(offsetImg,
        { clipPath: "inset(100% 0% 0% 0%)", scale: 1.15 },
        {
          clipPath: "inset(0% 0% 0% 0%)",
          scale: 1,
          duration: 1.35,
          delay: 0.18,
          ease: "power4.inOut",
          scrollTrigger: {
            trigger: comp,
            start: "top 85%",
            once: true
          }
        }
      );
    }

    // Badge entrance
    if (badge) {
      gsap.fromTo(badge,
        { opacity: 0, y: 15, scale: 0.9 },
        {
          opacity: 1,
          y: 0,
          scale: 1,
          duration: 0.7,
          delay: 0.55,
          ease: "power3.out",
          scrollTrigger: {
            trigger: comp,
            start: "top 85%",
            once: true
          }
        }
      );
    }

    // 16b. ScrollTrigger Parallax Depth Scrub (Opposing Motion Layers)
    if (primaryFrame && offsetFrame) {
      // Primary layer gently drifts upward as you scroll
      gsap.to(primaryFrame, {
        y: -20,
        ease: "none",
        scrollTrigger: {
          trigger: comp,
          start: "top bottom",
          end: "bottom top",
          scrub: 1.2
        }
      });

      // Offset layer translates with opposing parallax depth
      gsap.to(offsetFrame, {
        y: 26,
        ease: "none",
        scrollTrigger: {
          trigger: comp,
          start: "top bottom",
          end: "bottom top",
          scrub: 1.4
        }
      });
    }

    if (badge) {
      gsap.to(badge, {
        y: -14,
        ease: "none",
        scrollTrigger: {
          trigger: comp,
          start: "top bottom",
          end: "bottom top",
          scrub: 1.6
        }
      });
    }

    // 16c. Interactive 3D Perspective Tilt on Hover
    if (window.matchMedia("(hover: hover) and (pointer: fine)").matches) {
      const xTo = gsap.quickTo(comp, "rotateY", { duration: 0.5, ease: "power2.out" });
      const yTo = gsap.quickTo(comp, "rotateX", { duration: 0.5, ease: "power2.out" });

      comp.addEventListener("mousemove", (e) => {
        const rect = comp.getBoundingClientRect();
        const normX = ((e.clientX - rect.left) / rect.width - 0.5) * 2;
        const normY = ((e.clientY - rect.top) / rect.height - 0.5) * 2;
        xTo(normX * 5);
        yTo(-normY * 5);
      });

      comp.addEventListener("mouseleave", () => {
        gsap.to(comp, { rotateX: 0, rotateY: 0, duration: 0.7, ease: "power3.out" });
      });
    }
  });

  // -------------------------------------------------------------
  // 17. Interactive Multi-Slide Portfolio Monograph System
  // (Slide & Next Information Engine with Professional GSAP Animations)
  // -------------------------------------------------------------
  const portfolioMonographCards = document.querySelectorAll(".theatre-project-card");
  
  portfolioMonographCards.forEach((card) => {
    const tabs = card.querySelectorAll(".theatre-tab-btn");
    const prevBtn = card.querySelector(".theatre-btn-prev");
    const nextBtn = card.querySelector(".theatre-btn-next");
    const inlineNextBtns = card.querySelectorAll(".theatre-inline-next-btn");
    const inlinePrevBtns = card.querySelectorAll(".theatre-inline-prev-btn");
    const slides = card.querySelectorAll(".theatre-slide-item");
    const progressBar = card.querySelector(".theatre-card-progress-bar");
    const counterCurr = card.querySelector(".theatre-nav-counter .counter-curr");
    const slidesDeck = card.querySelector(".theatre-slides-deck");

    if (slides.length <= 1) return;

    let currentIndex = 0;
    let isAnimating = false;
    const totalSlides = slides.length;

    const goToSlide = (targetIndex, direction = null) => {
      if (isAnimating || targetIndex === currentIndex) return;

      // Handle wraparound
      if (targetIndex < 0) targetIndex = totalSlides - 1;
      if (targetIndex >= totalSlides) targetIndex = 0;

      if (direction === null) {
        direction = targetIndex > currentIndex ? 1 : -1;
      }

      isAnimating = true;

      const currentSlide = slides[currentIndex];
      const nextSlide = slides[targetIndex];

      // 1. Update Navigation Tabs State
      tabs.forEach((tab, idx) => {
        const isActive = idx === targetIndex;
        tab.classList.toggle("active", isActive);
        tab.setAttribute("aria-selected", isActive ? "true" : "false");
      });

      // 2. Animate Counter Text with GSAP Roll
      if (counterCurr) {
        gsap.to(counterCurr, {
          y: -10,
          opacity: 0,
          duration: 0.2,
          ease: "power2.in",
          onComplete: () => {
            counterCurr.textContent = String(targetIndex + 1).padStart(2, "0");
            gsap.fromTo(counterCurr,
              { y: 10, opacity: 0 },
              { y: 0, opacity: 1, duration: 0.3, ease: "power2.out" }
            );
          }
        });
      }

      // 3. Animate Progress Track Bar
      if (progressBar) {
        const progressPct = ((targetIndex + 1) / totalSlides) * 100;
        gsap.to(progressBar, {
          width: `${progressPct}%`,
          duration: 0.5,
          ease: "power2.out"
        });
      }

      // 4. GSAP Slide Animation Timeline
      const tl = gsap.timeline({
        onComplete: () => {
          currentSlide.classList.remove("active");
          gsap.set(currentSlide, { clearProps: "position,top,left,width,zIndex,transform,opacity" });
          gsap.set(nextSlide, { clearProps: "position,zIndex" });
          currentIndex = targetIndex;
          card.setAttribute("data-current-slide", currentIndex);
          isAnimating = false;

          // Subtle ScrollTrigger refresh after layout transition
          ScrollTrigger.refresh();
        }
      });

      // Position slides for cinematic layering
      nextSlide.classList.add("active");
      gsap.set(nextSlide, { position: "relative", zIndex: 2 });
      gsap.set(currentSlide, { position: "absolute", top: 0, left: 0, width: "100%", zIndex: 1 });

      // Outgoing slide slides away
      tl.to(currentSlide, {
        x: -direction * 45,
        opacity: 0,
        duration: 0.45,
        ease: "power2.inOut"
      }, 0);

      // Incoming slide enters with momentum
      tl.fromTo(nextSlide,
        { x: direction * 45, opacity: 0 },
        { x: 0, opacity: 1, duration: 0.6, ease: "power3.out" },
        0.08
      );

      // Media zoom & reveal
      const nextImg = nextSlide.querySelector(".theatre-card-media img");
      if (nextImg) {
        tl.fromTo(nextImg,
          { scale: 1.08 },
          { scale: 1.0, duration: 0.85, ease: "power2.out" },
          0.08
        );
      }

      // Stagger incoming information content elements
      const contentElements = nextSlide.querySelectorAll(
        ".theatre-card-header, .theatre-card-title, .theatre-slide-headline, .theatre-card-desc, .theatre-card-meta-row, .theatre-deliverables-checklist, .theatre-metrics-row, .theatre-slide-quote, .theatre-card-actions"
      );
      if (contentElements.length > 0) {
        tl.fromTo(contentElements,
          { y: 20, opacity: 0 },
          { y: 0, opacity: 1, duration: 0.5, stagger: 0.04, ease: "power3.out" },
          0.14
        );
      }
    };

    // Event: Tab Clicks
    tabs.forEach((tab) => {
      tab.addEventListener("click", () => {
        const slideIdx = parseInt(tab.getAttribute("data-slide"), 10);
        goToSlide(slideIdx);
      });
    });

    // Event: Header Arrow Buttons
    if (prevBtn) {
      prevBtn.addEventListener("click", (e) => {
        e.preventDefault();
        goToSlide(currentIndex - 1, -1);
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", (e) => {
        e.preventDefault();
        goToSlide(currentIndex + 1, 1);
      });
    }

    // Event: In-Card Action Buttons (e.g. "Next: Strategy & Scope →")
    inlineNextBtns.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const target = parseInt(btn.getAttribute("data-target-slide"), 10);
        goToSlide(target, 1);
      });
    });

    inlinePrevBtns.forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const target = parseInt(btn.getAttribute("data-target-slide"), 10);
        goToSlide(target, -1);
      });
    });

    // Touch Swipe Support for Mobile & Tablets
    if (slidesDeck) {
      let touchStartX = 0;
      let touchStartY = 0;

      slidesDeck.addEventListener("touchstart", (e) => {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
      }, { passive: true });

      slidesDeck.addEventListener("touchend", (e) => {
        const diffX = e.changedTouches[0].screenX - touchStartX;
        const diffY = e.changedTouches[0].screenY - touchStartY;

        // Ensure swipe is predominantly horizontal
        if (Math.abs(diffX) > 45 && Math.abs(diffX) > Math.abs(diffY)) {
          if (diffX < 0) {
            goToSlide(currentIndex + 1, 1); // Swipe left -> Next slide
          } else {
            goToSlide(currentIndex - 1, -1); // Swipe right -> Prev slide
          }
        }
      }, { passive: true });
    }
  });

  // -------------------------------------------------------------
  // 18. Architectural Scattered Image Satellite & Cinematic Lightbox
  // -------------------------------------------------------------
  const scatterItems = document.querySelectorAll(".theatre-scatter-item");
  const lightboxModal = document.getElementById("theatreLightboxModal");

  if (scatterItems.length > 0 && typeof gsap !== "undefined") {
    // 1. Subtle GSAP Scroll Parallax on Desktop (screen width >= 992px)
    if (window.innerWidth >= 992) {
      scatterItems.forEach((item) => {
        const isTop = item.classList.contains("scatter-pos-tl") || item.classList.contains("scatter-pos-tr");
        const isLeft = item.classList.contains("scatter-pos-tl") || item.classList.contains("scatter-pos-bl");
        const yOffset = isTop ? -35 : 40;
        const xOffset = isLeft ? -15 : 15;

        const parentRow = item.closest(".theatre-project-row") || item.parentElement;
        if (parentRow && typeof ScrollTrigger !== "undefined") {
          gsap.to(item, {
            y: yOffset,
            x: xOffset,
            ease: "none",
            scrollTrigger: {
              trigger: parentRow,
              start: "top bottom",
              end: "bottom top",
              scrub: 1.2
            }
          });
        }
      });
    }

    // 2. Cinematic Lightbox Engine
    if (lightboxModal) {
      const mainImg = document.getElementById("lightboxMainImage");
      const projectTitleEl = document.getElementById("lightboxProjectTitle");
      const figureTagEl = document.getElementById("lightboxFigureTag");
      const captionTextEl = document.getElementById("lightboxCaptionText");
      const counterEl = document.getElementById("lightboxCounter");
      const closeBtn = document.getElementById("lightboxCloseBtn");
      const prevBtn = document.getElementById("lightboxPrevBtn");
      const nextBtn = document.getElementById("lightboxNextBtn");

      let currentGalleryItems = [];
      let currentGalleryIndex = 0;

      const updateLightboxView = (index, direction = 1) => {
        if (!currentGalleryItems || currentGalleryItems.length === 0) return;
        if (index < 0) index = currentGalleryItems.length - 1;
        if (index >= currentGalleryItems.length) index = 0;
        currentGalleryIndex = index;

        const item = currentGalleryItems[currentGalleryIndex];

        if (counterEl) {
          const num = String(currentGalleryIndex + 1).padStart(2, "0");
          const total = String(currentGalleryItems.length).padStart(2, "0");
          counterEl.textContent = `${num} / ${total}`;
        }

        if (projectTitleEl) {
          projectTitleEl.textContent = item.projectTitle || "PROJECT ARCHIVE";
        }
        if (figureTagEl) {
          figureTagEl.textContent = item.fig || `FIG. S-0${currentGalleryIndex + 1}`;
        }
        if (captionTextEl) {
          captionTextEl.textContent = item.caption || "Architectural Visual Study & Spatial Specimen";
        }

        if (mainImg) {
          gsap.to(mainImg, {
            opacity: 0,
            scale: 0.96,
            duration: 0.2,
            ease: "power2.in",
            onComplete: () => {
              mainImg.src = item.src;
              mainImg.alt = item.caption || "";
              gsap.fromTo(mainImg,
                { opacity: 0, scale: 1.04 },
                { opacity: 1, scale: 1, duration: 0.35, ease: "power2.out" }
              );
            }
          });
        }
      };

      const openLightbox = (itemsList, startIndex = 0) => {
        currentGalleryItems = itemsList;
        currentGalleryIndex = startIndex;
        updateLightboxView(currentGalleryIndex, 0);

        if (typeof lightboxModal.showModal === "function") {
          lightboxModal.showModal();
        } else {
          lightboxModal.setAttribute("open", "");
        }
        document.body.style.overflow = "hidden";

        const wrapper = lightboxModal.querySelector(".cinematic-lightbox-wrapper");
        if (wrapper) {
          gsap.fromTo(wrapper,
            { opacity: 0, scale: 0.92, y: 20 },
            { opacity: 1, scale: 1, y: 0, duration: 0.4, ease: "power3.out" }
          );
        }
      };

      const closeLightbox = () => {
        const wrapper = lightboxModal.querySelector(".cinematic-lightbox-wrapper");
        if (wrapper) {
          gsap.to(wrapper, {
            opacity: 0,
            scale: 0.94,
            y: 15,
            duration: 0.25,
            ease: "power2.in",
            onComplete: () => {
              if (typeof lightboxModal.close === "function") {
                lightboxModal.close();
              } else {
                lightboxModal.removeAttribute("open");
              }
              document.body.style.overflow = "";
            }
          });
        } else {
          if (typeof lightboxModal.close === "function") {
            lightboxModal.close();
          } else {
            lightboxModal.removeAttribute("open");
          }
          document.body.style.overflow = "";
        }
      };

      // Item click: opens the gallery for that specific project
      scatterItems.forEach((item) => {
        item.addEventListener("click", (e) => {
          e.preventDefault();
          const parentField = item.closest(".theatre-scatter-field") || item.parentElement;
          const siblings = parentField.querySelectorAll(".theatre-scatter-item");
          const itemsList = [];
          let clickedIndex = 0;

          siblings.forEach((sib, sIdx) => {
            const src = sib.getAttribute("data-lightbox-src");
            const caption = sib.getAttribute("data-lightbox-caption");
            const fig = sib.getAttribute("data-lightbox-fig");
            const projectTitle = sib.getAttribute("data-project-title");
            if (src) {
              itemsList.push({ src, caption, fig, projectTitle });
              if (sib === item) {
                clickedIndex = sIdx;
              }
            }
          });

          if (itemsList.length === 0) {
            const singleSrc = item.getAttribute("data-lightbox-src");
            if (singleSrc) {
              itemsList.push({
                src: singleSrc,
                caption: item.getAttribute("data-lightbox-caption"),
                fig: item.getAttribute("data-lightbox-fig"),
                projectTitle: item.getAttribute("data-project-title")
              });
            }
          }

          openLightbox(itemsList, clickedIndex);
        });

        // Keydown support (Enter or Space)
        item.addEventListener("keydown", (e) => {
          if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            item.click();
          }
        });
      });

      // Close button
      if (closeBtn) {
        closeBtn.addEventListener("click", (e) => {
          e.preventDefault();
          closeLightbox();
        });
      }

      // Prev & Next buttons
      if (prevBtn) {
        prevBtn.addEventListener("click", (e) => {
          e.preventDefault();
          updateLightboxView(currentGalleryIndex - 1, -1);
        });
      }

      if (nextBtn) {
        nextBtn.addEventListener("click", (e) => {
          e.preventDefault();
          updateLightboxView(currentGalleryIndex + 1, 1);
        });
      }

      // Keyboard navigation (Escape, Left Arrow, Right Arrow)
      window.addEventListener("keydown", (e) => {
        if (!lightboxModal.hasAttribute("open")) return;
        if (e.key === "Escape") {
          closeLightbox();
        } else if (e.key === "ArrowLeft") {
          updateLightboxView(currentGalleryIndex - 1, -1);
        } else if (e.key === "ArrowRight") {
          updateLightboxView(currentGalleryIndex + 1, 1);
        }
      });

      // Light-dismiss backdrop click fallback (from modern-web-guidance)
      if (!('closedBy' in HTMLDialogElement.prototype)) {
        lightboxModal.addEventListener("click", (event) => {
          if (event.target !== lightboxModal) return;
          const wrapper = lightboxModal.querySelector(".cinematic-lightbox-wrapper");
          if (wrapper) {
            const wRect = wrapper.getBoundingClientRect();
            const isInsideWrapper = (
              wRect.top <= event.clientY &&
              event.clientY <= wRect.top + wRect.height &&
              wRect.left <= event.clientX &&
              event.clientX <= wRect.left + wRect.width
            );
            if (isInsideWrapper) return;
          }
          closeLightbox();
        });
      }
    }
  }

  // 17. AJAX FORM SUBMISSION & LEADS MANAGEMENT
  function initDesignsAjaxForms() {
    const forms = document.querySelectorAll(".designs-ajax-form");
    if (!forms.length) return;

    forms.forEach((form) => {
      form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const submitBtn = form.querySelector('button[type="submit"], .form-submit-btn');
        const feedbackArea = form.querySelector(".form-feedback-area");
        if (!feedbackArea) return;

        // Clear existing feedback
        feedbackArea.innerHTML = "";

        // Client-side quick validation
        const nameInput = form.querySelector('input[name="lead_name"]');
        const emailInput = form.querySelector('input[name="lead_email"]');
        const messageInput = form.querySelector('textarea[name="lead_message"]');

        if (nameInput && !nameInput.value.trim()) {
          showError(feedbackArea, "Please enter your name or company.");
          nameInput.focus();
          return;
        }

        if (emailInput && (!emailInput.value.trim() || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim()))) {
          showError(feedbackArea, "Please enter a valid email address.");
          emailInput.focus();
          return;
        }

        if (messageInput && !messageInput.value.trim()) {
          showError(feedbackArea, "Please enter your project details or message.");
          messageInput.focus();
          return;
        }

        // Enter Loading State
        let originalBtnHtml = "";
        if (submitBtn) {
          originalBtnHtml = submitBtn.innerHTML;
          submitBtn.disabled = true;
          submitBtn.classList.add("is-loading");
          submitBtn.innerHTML = '<span class="form-btn-spinner"></span> <span>Dispatching...</span>';
        }

        // Prepare FormData
        const formData = new FormData(form);
        formData.append("action", "designs_submit_lead");

        if (!formData.has("lead_nonce") && window.designsNgData && window.designsNgData.lead_nonce) {
          formData.append("lead_nonce", window.designsNgData.lead_nonce);
        }

        const ajaxUrl = (window.designsNgData && window.designsNgData.ajax_url) || "/wp-admin/admin-ajax.php";

        try {
          const response = await fetch(ajaxUrl, {
            method: "POST",
            body: formData,
          });

          const result = await response.json();

          if (result.success) {
            form.reset();

            const message = result.data?.message || "Thank you! Your project brief has been securely received.";
            const leadRef = result.data?.lead_id ? `#LEAD-${result.data.lead_id}` : "CONFIRMED";

            feedbackArea.innerHTML = `
              <div class="designs-form-success-card">
                <div class="success-icon-badge">✓</div>
                <h4 class="success-title">Inquiry Received</h4>
                <p class="success-desc">${message}</p>
                <div class="success-meta">Ref: ${leadRef} • Assigned to Senior Partner • 24h Review SLA</div>
              </div>
            `;

            if (typeof gsap !== "undefined") {
              gsap.fromTo(
                feedbackArea.querySelector(".designs-form-success-card"),
                { opacity: 0, y: 15, scale: 0.98 },
                { opacity: 1, y: 0, scale: 1, duration: 0.45, ease: "power3.out" }
              );
            }

            feedbackArea.scrollIntoView({ behavior: "smooth", block: "nearest" });

            if (submitBtn) {
              submitBtn.innerHTML = '<span>Inquiry Sent ✓</span>';
              setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.classList.remove("is-loading");
                submitBtn.innerHTML = originalBtnHtml;
              }, 4000);
            }
          } else {
            const errorMsg = result.data?.message || "An error occurred while submitting. Please try again.";
            showError(feedbackArea, errorMsg);
            if (submitBtn) {
              submitBtn.disabled = false;
              submitBtn.classList.remove("is-loading");
              submitBtn.innerHTML = originalBtnHtml;
            }
          }
        } catch (err) {
          console.error("Designs Form Submission Error:", err);
          showError(feedbackArea, "Network connection error. Please verify your connection or email us directly.");
          if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.classList.remove("is-loading");
            submitBtn.innerHTML = originalBtnHtml;
          }
        }
      });
    });

    function showError(container, text) {
      container.innerHTML = `
        <div class="designs-form-error-card">
          <span class="error-icon">!</span>
          <span>${text}</span>
        </div>
      `;
      if (typeof gsap !== "undefined") {
        gsap.fromTo(
          container.querySelector(".designs-form-error-card"),
          { opacity: 0, y: 8 },
          { opacity: 1, y: 0, duration: 0.3, ease: "power2.out" }
        );
      }
    }
  }
  initDesignsAjaxForms();

  // Refresh ScrollTrigger when images and fonts finish loading
  window.addEventListener("load", () => {
    ScrollTrigger.refresh();
  });
  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(() => {
      ScrollTrigger.refresh();
    });
  }
});
