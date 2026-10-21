<?php
/**
 * Template Name: Our Services
 *
 * Dedicated services page for Adam Studio featuring comprehensive capability cards,
 * scope breakdowns, and links to relevant portfolio projects.
 *
 * @package designs-ng
 */

get_header();

// Check if page was edited with Elementor
$is_elementor_page = false;
if ( class_exists( '\Elementor\Plugin' ) ) {
    $document = \Elementor\Plugin::$instance->documents->get( get_the_ID() );
    if ( $document && $document->is_built_with_elementor() ) {
        $is_elementor_page = true;
    }
}

if ( $is_elementor_page ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
else :
?>

<main id="primary" class="site-main page-services">

    <!-- HERO SECTION (SPLIT 6x2 EDITORIAL HERO WITH PARALLAX & CLIP-PATH) -->
    <section class="page-hero page-hero-split">
        <div class="container">
            <div class="page-hero-split-grid">
                <!-- Left 6-Col: Editorial Typography & Context -->
                <div class="page-hero-text-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Our Capabilities', 'designs-ng' ); ?></span>
                    </div>
                    <h1 class="page-hero-split-title gsap-reveal">
                        Comprehensive Design, Code & <span class="accent-green">Production</span>.
                    </h1>
                    <p class="page-hero-split-desc gsap-reveal">
                        We partner with high-growth startups and established corporations to deliver bespoke digital platforms, brand ecosystems, and luxury physical collateral.
                    </p>
                    <div class="page-hero-meta-chips gsap-reveal">
                        <span class="editorial-coord-tag">09 CORE DISCIPLINES</span>
                        <span class="meta-chip-divider">•</span>
                        <span class="meta-chip-text"><?php esc_html_e( 'FULL-STACK DELIVERY', 'designs-ng' ); ?></span>
                    </div>
                </div>

                <!-- Right 6-Col: Half Image (6x2) Frame with GSAP Curtain Reveal & Parallax Scrub -->
                <div class="page-hero-media-col">
                    <div class="hero-half-media-frame frame-dashed gsap-hero-half-frame">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        
                        <div class="hero-half-media-inner">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/services-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Adam Studio Technology & Design Lab', 'designs-ng' ); ?>" class="hero-half-img gsap-hero-half-img" width="1200" height="800">
                            <div class="hero-half-vignette"></div>
                            
                            <div class="hero-half-badge-float">
                                <span class="badge-dot"></span>
                                <span class="badge-text"><?php esc_html_e( 'TECHNOLOGY & SPATIAL LAB • 2026', 'designs-ng' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. CAPABILITIES EDITORIAL PHILOSOPHY (LAYERED COMPOSITION) -->
    <section class="about-section" style="padding-bottom: 40px;">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DISCIPLINE // 01 CAPABILITY FRAMEWORK', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">END-TO-END MULTI-DISCIPLINARY ATELIER</span>
                </div>
            </div>

            <div class="about-grid">
                <div class="about-left-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Engineering Rigor', 'designs-ng' ); ?></span>
                    </div>
                    <h2 class="section-title gsap-reveal">
                        Uncompromising Standards.<br>Across Every Medium.
                    </h2>
                    <p class="about-quote gsap-reveal">
                        “From identity blueprints and high-frequency digital platforms to physical corporate handover boxes, our disciplines operate as a single, coherent design system.”
                    </p>

                    <!-- Layered Editorial Image Composition with Dashed Framing & Corner Crosshairs -->
                    <div class="editorial-layer-composition gsap-reveal">
                        <div class="frame-dashed frame-accent editorial-layer-primary">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/services-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Interactive Systems Lab', 'designs-ng' ); ?>" class="editorial-img-main" loading="lazy">
                        </div>

                        <div class="frame-dashed editorial-layer-offset">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-1.jpg' ); ?>" alt="<?php esc_attr_e( 'Digital Engineering & Motion', 'designs-ng' ); ?>" class="editorial-img-sub" loading="lazy">
                            <div class="offset-caption" style="padding-top: 8px;">
                                <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;"><?php esc_html_e( 'FIG. 01 — SYSTEMS SPEC', 'designs-ng' ); ?></span>
                            </div>
                        </div>

                        <div class="editorial-layer-badge">
                            <span><?php esc_html_e( 'CROSS-DISCIPLINE ATELIER', 'designs-ng' ); ?></span>
                        </div>
                    </div>
                </div>

                <div class="about-features">
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">01</span>
                        <h4>Architectural Precision</h4>
                        <p>Mathematical grid systems, typographic hierarchies, and airtight design documentation that scale across multi-tier enterprise platforms.</p>
                    </div>
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">02</span>
                        <h4>Digital Fluidity</h4>
                        <p>Custom WordPress, Elementor integration, WebGL, and 60fps GSAP physics engineered for lightning speed and buttery micro-interactions.</p>
                    </div>
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">03</span>
                        <h4>Tangible Permanence</h4>
                        <p>Bespoke executive gift suites, engraved brass seals, and luxury architectural materials that create an undeniable aura of permanence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DETAILED SERVICES GRID -->
    <section class="services-section">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'INDEX // 09 CORE DISCIPLINES', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag" style="font-family: var(--font-main); font-size: 11px; letter-spacing: 0.12em; color: var(--text-muted);">LAT. 06°31'N / LON. 03°23'E • LAGOS</span>
                </div>
            </div>

            <div class="services-grid-detailed">
                <?php
                $detailed_services = array(
                    array(
                        'title'    => 'Branding & Identity',
                        'icon'     => 'sparkles',
                        'cat_slug' => 'branding',
                        'desc'     => 'We craft distinctive visual identities, typography guidelines, brand strategy playbooks, and messaging frameworks that differentiate your business globally.',
                        'deliverables' => array( 'Logo Systems & Marks', 'Brand Guidelines & Tone of Voice', 'Typography & Palette Architecture', 'Investor Deck Design' )
                    ),
                    array(
                        'title'    => 'Website Development',
                        'icon'     => 'code',
                        'cat_slug' => 'website-development',
                        'desc'     => 'High-conversion, ultra-responsive web applications custom-engineered on modern tech stacks, fully editable in Elementor with zero bloat and blazing speed.',
                        'deliverables' => array( 'Custom WordPress & Elementor Themes', 'Interactive WebGL / GSAP Motion', 'Responsive Mobile Architecture', 'Headless & Next.js Builds' )
                    ),
                    array(
                        'title'    => 'UI/UX Product Design',
                        'icon'     => 'layout',
                        'cat_slug' => 'ui-ux-design',
                        'desc'     => 'Human-centered digital product interfaces designed through rigorous wireframing, interactive prototyping, usability testing, and design systems.',
                        'deliverables' => array( 'Figma UI/UX Prototypes', 'Enterprise Design Systems', 'User Research & Journey Mapping', 'SaaS Dashboards' )
                    ),
                    array(
                        'title'    => 'Graphics Design',
                        'icon'     => 'palette',
                        'cat_slug' => 'graphics-design',
                        'desc'     => 'Striking marketing collateral, annual reports, large-format billboard campaigns, packaging, and digital campaign creative that demands attention.',
                        'deliverables' => array( 'Editorial & Annual Reports', 'Print Collateral & Billboards', 'Packaging & Label Architecture', 'Social Media Assets' )
                    ),
                    array(
                        'title'    => 'App Development',
                        'icon'     => 'smartphone',
                        'cat_slug' => 'app-development',
                        'desc'     => 'Robust native and cross-platform mobile experiences for iOS and Android, built with fluid gesture physics, haptics, and sub-second performance.',
                        'deliverables' => array( 'iOS & Android Native Apps', 'Flutter & React Native Engineering', 'Fintech & Payment Integrations', 'Offline-First Capabilities' )
                    ),
                    array(
                        'title'    => 'Architecture & Interior Design',
                        'icon'     => 'building',
                        'cat_slug' => 'architecture-interior-design',
                        'desc'     => 'Transforming physical spaces into architectural expressions of brand prestige. From boutique retail interiors to commercial headquarter concepts.',
                        'deliverables' => array( '3D Photorealistic Spatial Renderings', 'Commercial Interior Direction', 'Lighting & Material Specification', 'Bespoke Retail Environments' )
                    ),
                    array(
                        'title'    => 'Media Services',
                        'icon'     => 'video',
                        'cat_slug' => 'media-services',
                        'desc'     => 'Cinematic brand films, drone cinematography, product photography, and high-impact motion graphics that convey emotion and narrative depth.',
                        'deliverables' => array( 'Brand Commercials & Documentaries', '4K Drone Aerial Videography', 'Studio Product Photography', '2D & 3D Motion Graphics' )
                    ),
                    array(
                        'title'    => 'Bespoke Souvenirs',
                        'icon'     => 'gift',
                        'cat_slug' => 'souvenirs',
                        'desc'     => 'Ultra-exclusive corporate gifting, VIP handover boxes, engraved metal artifacts, and customized luxury merchandise that leaves a lasting impression.',
                        'deliverables' => array( 'VIP Real Estate Handover Kits', 'Custom Packaging & Unboxing', 'Engraved Metal & Leather Artifacts', 'Corporate Executive Merchandise' )
                    ),
                    array(
                        'title'    => 'Project Management',
                        'icon'     => 'check-circle',
                        'cat_slug' => 'project-management',
                        'desc'     => 'End-to-end creative production management, sprint oversight, vendor orchestration, and quality assurance to ensure flawless on-time delivery.',
                        'deliverables' => array( 'Agile Creative Production Sprints', 'Quality Assurance & Auditing', 'Vendor & Manufacturer Sourcing', 'Cross-Discipline Delivery' )
                    )
                );

                foreach ( $detailed_services as $srv ) :
                    ?>
                    <div class="service-card service-card-detailed frame-dashed gsap-service-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <div>
                            <div class="service-icon-wrap">
                                <?php echo designs_ng_get_svg( $srv['icon'] ); ?>
                            </div>
                            <h3 class="service-title" style="font-size: 24px; margin-bottom: 16px;"><?php echo esc_html( $srv['title'] ); ?></h3>
                            <p class="service-desc" style="font-size: 15px; margin-bottom: 24px; line-height: 1.7;"><?php echo esc_html( $srv['desc'] ); ?></p>

                            <div style="margin-bottom: 28px; padding-top: 18px; border-top: 1px solid var(--border-card);">
                                <span style="display: block; font-size: 11px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 12px; font-weight: 400;">Key Deliverables</span>
                                <ul style="list-style: none; display: flex; flex-direction: column; gap: 8px;">
                                    <?php foreach ( $srv['deliverables'] as $deliv ) : ?>
                                        <li style="font-size: 13px; color: var(--text-secondary); display: flex; align-items: center; gap: 8px;">
                                            <span style="color: rgba(255, 255, 255, 0.25); font-size: 11px;">—</span>
                                            <?php echo esc_html( $deliv ); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 20px; border-top: 1px solid var(--border-card);">
                            <a href="<?php echo esc_url( home_url( '/portfolio/?cat=' . $srv['cat_slug'] ) ); ?>" class="service-link" style="font-size: 13px;">
                                <span><?php esc_html_e( 'View Case Studies', 'designs-ng' ); ?></span>
                                <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/start-project/' ) ); ?>" style="font-size: 13px; color: var(--text-muted); text-decoration: none;">
                                <?php esc_html_e( 'Inquire', 'designs-ng' ); ?> &rarr;
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- BIG CTA -->
    <section class="big-cta-section" id="cta">
        <div class="container">
            <div class="cta-inner frame-dashed frame-accent" style="padding: clamp(60px, 8vw, 100px) clamp(24px, 5vw, 64px);">
                <span class="corner-crosshair tl">+</span>
                <span class="corner-crosshair tr">+</span>
                <span class="corner-crosshair bl">+</span>
                <span class="corner-crosshair br">+</span>
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1); width: 100%;">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'ENGAGEMENT // 2026 ROADMAP', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">STUDIO AVAILABLE</span>
                </div>
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Commission Us', 'designs-ng' ); ?></span>
                </div>
                <h2 class="cta-title gsap-reveal">
                    Need A Custom Solution For Your <span class="accent-green">Brand</span>?
                </h2>
                <p class="cta-subtitle gsap-reveal">
                    We tailor our multi-disciplinary creative engineering team around your specific business milestones and timeline.
                </p>
                <div class="gsap-reveal" style="margin-top: 16px;">
                    <a href="<?php echo esc_url( home_url( '/start-project/' ) ); ?>" class="btn btn-primary btn-magnetic btn-cta-large">
                        <span><?php esc_html_e( 'Start Your Project Brief', 'designs-ng' ); ?></span>
                        <?php echo designs_ng_get_svg( 'arrow-right' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
endif;

get_footer();
