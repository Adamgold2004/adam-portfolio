<?php
/**
 * The Front Page Template for Adam Studio
 *
 * Implements the 10-section hierarchy specified in the Master Prompt.
 * Elegant, uncluttered luxury agency aesthetic.
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

<main id="primary" class="site-main">

    <!-- 1. HERO SECTION (CINEMATIC SLIDING SHOWCASE & EXPANSIVE BREATHING ROOM) -->
    <section class="hero-section" id="hero">
        <!-- Cinematic Multi-Slide Background Showcase -->
        <div class="hero-slider-canvas">
            <div class="hero-slide active" data-index="0" data-meta="01 — SPATIAL ARCHITECTURE" data-caption="Obsidian Minimalist Pavilion">
                <div class="hero-slide-media" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-1.jpg' ); ?>');"></div>
                <div class="hero-slide-vignette"></div>
            </div>
            <div class="hero-slide" data-index="1" data-meta="02 — BRAND IDENTITY & DYNAMICS" data-caption="Abstract Titanium & Emerald Geometry">
                <div class="hero-slide-media" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-2.jpg' ); ?>');"></div>
                <div class="hero-slide-vignette"></div>
            </div>
            <div class="hero-slide" data-index="2" data-meta="03 — DIGITAL ATELIER" data-caption="Double-Height Architectural Studio">
                <div class="hero-slide-media" style="background-image: url('<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-3.jpg' ); ?>');"></div>
                <div class="hero-slide-vignette"></div>
            </div>
        </div>

        <!-- Ambient Luxury Glow & Noise -->
        <div class="hero-ambient-glow"></div>
        <div class="hero-subtle-mesh"></div>

        <div class="container hero-container">
            <!-- Header Badges Bar -->
            <div class="hero-top-row">
                <div class="hero-pill-badge gsap-hero-badge">
                    <span><?php esc_html_e( 'Creative Agency • 2026 Edition', 'designs-ng' ); ?></span>
                </div>
                
                <div class="hero-slide-tag gsap-hero-badge" id="heroSlideTag">
                    <span class="slide-meta-label">01 — SPATIAL ARCHITECTURE</span>
                </div>
            </div>

            <!-- Main Editorial Heading -->
            <div class="hero-content">
                <h1 class="hero-title gsap-hero-title">
                    <span class="title-word">Bringing</span> 
                    <span class="title-word">Excellence</span> 
                    <span class="title-word">To</span> 
                    <span class="title-word">Your</span> 
                    <span class="title-word accent-green">Brand</span>
                </h1>

                <p class="hero-subtitle gsap-hero-sub">
                    <?php esc_html_e( 'We harness the power of creativity to design amazing brand experiences that turn your vision into a story people see, feel, and love.', 'designs-ng' ); ?>
                </p>

                <div class="hero-actions gsap-hero-actions">
                    <a href="<?php echo esc_url( home_url( '/start-project' ) ); ?>" class="btn btn-primary btn-magnetic">
                        <span><?php esc_html_e( 'Start Your Project', 'designs-ng' ); ?></span>
                        <?php echo designs_ng_get_svg( 'arrow-right' ); ?>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-secondary">
                        <span><?php esc_html_e( 'Explore Portfolio', 'designs-ng' ); ?></span>
                    </a>
                </div>

                <!-- Cinematic Slider Indicators & Controls -->
                <div class="hero-slider-nav gsap-hero-nav">
                    <div class="slider-progress-track">
                        <div class="slider-progress-bar" id="heroProgressFill"></div>
                    </div>
                    <div class="slider-dots-group">
                        <button type="button" class="slider-dot-btn active" data-slide="0" aria-label="Slide 01">
                            <span class="dot-num">01</span>
                            <span class="dot-label">Architecture</span>
                        </button>
                        <button type="button" class="slider-dot-btn" data-slide="1" aria-label="Slide 02">
                            <span class="dot-num">02</span>
                            <span class="dot-label">Identity</span>
                        </button>
                        <button type="button" class="slider-dot-btn" data-slide="2" aria-label="Slide 03">
                            <span class="dot-num">03</span>
                            <span class="dot-label">Digital Studio</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hero Bottom HUD Bar -->
            <div class="hero-bottom-hud gsap-hero-scroll">
                <div class="hud-item hud-coords">
                    <span class="hud-label"><?php esc_html_e( 'Studio Location', 'designs-ng' ); ?></span>
                    <span class="hud-value">Abuja, NG • 09°04′N 07°29′E</span>
                </div>

                <div class="hud-item hero-scroll-cue">
                    <span class="scroll-cue-line"></span>
                    <span class="scroll-cue-text"><?php esc_html_e( 'Scroll To Explore', 'designs-ng' ); ?></span>
                </div>

                <div class="hud-item hud-status">
                    <span class="hud-value"><?php esc_html_e( 'Accepting Projects Q3/Q4', 'designs-ng' ); ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- AGENCY CREDIBILITY METRICS BAND -->
    <section class="hero-metrics-band" id="metrics">
        <div class="container">
            <div class="hero-stats frame-dashed gsap-reveal-card" style="padding: 32px 36px;">
                <span class="corner-crosshair tl">+</span>
                <span class="corner-crosshair tr">+</span>
                <span class="corner-crosshair bl">+</span>
                <span class="corner-crosshair br">+</span>
                <div class="stat-item">
                    <h3>150<span>+</span></h3>
                    <p><?php esc_html_e( 'Projects Delivered', 'designs-ng' ); ?></p>
                </div>
                <div class="stat-item">
                    <h3>98<span>%</span></h3>
                    <p><?php esc_html_e( 'Client Satisfaction', 'designs-ng' ); ?></p>
                </div>
                <div class="stat-item">
                    <h3>14<span>+</span></h3>
                    <p><?php esc_html_e( 'Design Honors', 'designs-ng' ); ?></p>
                </div>
                <div class="stat-item">
                    <h3>8<span>+</span></h3>
                    <p><?php esc_html_e( 'Years of Practice', 'designs-ng' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- BRAND MARQUEE (DYNAMIC VIA WP CUSTOMIZER OR ELEMENTOR) -->
    <?php
    echo designs_ng_render_marquee();
    ?>

    <!-- 2. ABOUT / WHO WE ARE SECTION (EDITORIAL OVERLAPPING COMPOSITION) -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DISCIPLINE // 01 MANIFESTO', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">LAT. 06°31'N / LON. 03°23'E • LAGOS</span>
                </div>
            </div>

            <div class="about-grid">
                <div class="about-left-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Who We Are', 'designs-ng' ); ?></span>
                    </div>
                    <h2 class="section-title gsap-reveal">
                        Distinctive Ideas.<br>Flawless Execution.
                    </h2>
                    <p class="about-quote gsap-reveal">
                        “At Adam Studio, we work closely with you to ensure every project reflects your <strong>unique vision</strong>. With a skilled team, we turn your ideas into reality.”
                    </p>

                    <!-- Layered Editorial Image Composition with Dashed Framing & Corner Crosshairs -->
                    <div class="editorial-layer-composition gsap-reveal">
                        <div class="frame-dashed frame-accent editorial-layer-primary">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-1.jpg' ); ?>" alt="<?php esc_attr_e( 'Studio Architecture', 'designs-ng' ); ?>" class="editorial-img-main" style="width: 100%; height: 320px; object-fit: cover; border-radius: 2px; display: block;" loading="lazy">
                        </div>

                        <div class="frame-dashed editorial-layer-offset">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-2.jpg' ); ?>" alt="<?php esc_attr_e( 'Identity Craft', 'designs-ng' ); ?>" class="editorial-img-sub" style="width: 100%; height: 180px; object-fit: cover; border-radius: 2px; display: block;" loading="lazy">
                            <div class="offset-caption" style="padding-top: 8px;">
                                <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;"><?php esc_html_e( 'FIG. 01 — IDENTITY SPEC', 'designs-ng' ); ?></span>
                            </div>
                        </div>

                        <div class="editorial-layer-badge">
                            <span><?php esc_html_e( 'HIGH-CRAFT ARCHITECTURE', 'designs-ng' ); ?></span>
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
                        <h4>Strategic Brand Clarity</h4>
                        <p>We uncover the defining core of your brand and translate it into a visual identity that commands immediate authority in competitive markets.</p>
                    </div>
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">02</span>
                        <h4>Digital Craftsmanship</h4>
                        <p>Every website, mobile interface, and interactive digital touchpoint is custom-engineered with fluid motion, speed, and cross-device precision.</p>
                    </div>
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">03</span>
                        <h4>Tangible Luxury</h4>
                        <p>From architectural spaces to VIP bespoke corporate souvenirs, we ensure every physical impression matches your digital prestige.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. SERVICES SECTION -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DISCIPLINE // 02 CAPABILITIES', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">INDEX // 09 CORE DISCIPLINES • GLOBAL STANDARDS</span>
                </div>
            </div>

            <div class="section-header-centered">
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Capabilities', 'designs-ng' ); ?></span>
                </div>
                <h2 class="section-title gsap-reveal"><?php esc_html_e( 'Our Capabilities', 'designs-ng' ); ?></h2>
                <p class="section-subtitle gsap-reveal">
                    End-to-end creative solutions tailored to ambitious organizations seeking global relevance.
                </p>
            </div>

            <div class="services-grid">
                <?php
                $service_specs_map = array(
                    'Branding' => array( 'Visual Identity Systems', 'Brand Strategy Playbooks' ),
                    'Website Development' => array( 'WebGL & GSAP Interactive Motion', 'Headless & Elementor WordPress' ),
                    'UI/UX Design' => array( 'Interactive Figma Prototypes', 'Enterprise Design Systems' ),
                    'Graphics Design' => array( 'Editorial Publications & Reports', 'High-Impact Brand Collateral' ),
                    'App Development' => array( 'iOS & Android Native Engineering', 'Sub-Second Response Physics' ),
                    'Architecture & Interior Design' => array( 'Photorealistic 3D Spatial Renders', 'Bespoke Interior & Retail Concepts' ),
                    'Media Services' => array( '4K Drone Aerial Cinematography', 'Studio Commercial Photography' ),
                    'Souvenirs' => array( 'VIP Real Estate Handover Kits', 'Custom Engraved Luxury Artifacts' ),
                    'Project Management' => array( 'Agile Production Sprint Delivery', 'Cross-Discipline Quality Auditing' ),
                );

                $services_query = new WP_Query( array(
                    'post_type'      => 'service',
                    'posts_per_page' => 12,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC'
                ) );

                $service_counter = 1;
                if ( $services_query->have_posts() ) :
                    while ( $services_query->have_posts() ) : $services_query->the_post();
                        $srv_clean_title = html_entity_decode( get_the_title(), ENT_QUOTES, 'UTF-8' );
                        $icon_key = get_post_meta( get_the_ID(), '_service_icon', true );
                        $desc = get_post_meta( get_the_ID(), '_service_short_desc', true ) ?: get_the_excerpt();
                        $c_num = sprintf( '%02d', $service_counter++ );
                        $specs = isset( $service_specs_map[$srv_clean_title] ) ? $service_specs_map[$srv_clean_title] : array( 'High-Craft Execution', 'Global Quality Standard' );
                        ?>
                        <div class="service-card frame-dashed gsap-service-card">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="service-card-top">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <div class="service-icon-wrap">
                                        <?php echo designs_ng_get_svg( $icon_key ?: 'sparkles' ); ?>
                                    </div>
                                    <span class="feature-num" style="margin-bottom: 0; font-size: 13px; letter-spacing: 2px;"><?php echo esc_html( $c_num ); ?></span>
                                </div>
                                <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 6px;"><?php echo esc_html( 'SPEC. ' . $c_num . ' // CAPABILITY' ); ?></span>
                                <h3 class="service-title"><?php echo esc_html( $srv_clean_title ); ?></h3>
                                <p class="service-desc"><?php echo esc_html( $desc ); ?></p>
                                <div class="service-spec-deliverables">
                                    <?php foreach ( $specs as $spec_bullet ) : ?>
                                        <div class="service-spec-item">
                                            <span class="bullet">—</span>
                                            <span><?php echo esc_html( $spec_bullet ); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="service-card-bottom" style="padding-top: 18px; border-top: 1px dashed rgba(255, 255, 255, 0.08);">
                                <a href="#contact" class="service-link">
                                    <span><?php esc_html_e( 'Start Inquiry', 'designs-ng' ); ?></span>
                                    <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    $default_services_data = array(
                        array(
                            'title'  => 'Branding',
                            'icon'   => 'sparkles',
                            'desc'   => 'Brand identity, logos, typography architecture, style guides, and market positioning.',
                            'specs'  => array( 'Visual Identity Systems', 'Brand Strategy Playbooks' )
                        ),
                        array(
                            'title'  => 'Website Development',
                            'icon'   => 'code',
                            'desc'   => 'Modern, ultra-responsive, high-performance web engineering with fluid GSAP micro-motion.',
                            'specs'  => array( 'WebGL & GSAP Interactive Motion', 'Headless & Elementor WordPress' )
                        ),
                        array(
                            'title'  => 'UI/UX Design',
                            'icon'   => 'layout',
                            'desc'   => 'Intuitive digital product interfaces, design systems, wireframes, and human-centered UX.',
                            'specs'  => array( 'Interactive Figma Prototypes', 'Enterprise Design Systems' )
                        ),
                        array(
                            'title'  => 'Graphics Design',
                            'icon'   => 'palette',
                            'desc'   => 'Creative marketing collateral, posters, editorial publications, and visual communication.',
                            'specs'  => array( 'Editorial Publications & Reports', 'High-Impact Brand Collateral' )
                        ),
                        array(
                            'title'  => 'App Development',
                            'icon'   => 'smartphone',
                            'desc'   => 'Robust mobile application engineering with fluid gesture physics and native performance.',
                            'specs'  => array( 'iOS & Android Native Engineering', 'Sub-Second Response Physics' )
                        ),
                        array(
                            'title'  => 'Architecture & Interior Design',
                            'icon'   => 'building',
                            'desc'   => 'Physical spatial aesthetics, commercial headquarter concepts, and luxury residential environments.',
                            'specs'  => array( 'Photorealistic 3D Spatial Renders', 'Bespoke Interior & Retail Concepts' )
                        ),
                        array(
                            'title'  => 'Media Services',
                            'icon'   => 'video',
                            'desc'   => 'Cinematic videography, 4K aerial drone footage, brand photography, and documentary storytelling.',
                            'specs'  => array( '4K Drone Aerial Cinematography', 'Studio Commercial Photography' )
                        ),
                        array(
                            'title'  => 'Souvenirs',
                            'icon'   => 'gift',
                            'desc'   => 'High-end bespoke corporate souvenirs, VIP handover kits, and customized luxury merchandise.',
                            'specs'  => array( 'VIP Real Estate Handover Kits', 'Custom Engraved Luxury Artifacts' )
                        ),
                        array(
                            'title'  => 'Project Management',
                            'icon'   => 'check-circle',
                            'desc'   => 'Agile creative production, sprint oversight, vendor sourcing, and strict quality delivery.',
                            'specs'  => array( 'Agile Production Sprint Delivery', 'Cross-Discipline Quality Auditing' )
                        )
                    );
                    $f_counter = 1;
                    foreach ( $default_services_data as $srv_item ) :
                        $f_num = sprintf( '%02d', $f_counter++ );
                        ?>
                        <div class="service-card frame-dashed gsap-service-card">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="service-card-top">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                                    <div class="service-icon-wrap">
                                        <?php echo designs_ng_get_svg( $srv_item['icon'] ); ?>
                                    </div>
                                    <span class="feature-num" style="margin-bottom: 0; font-size: 13px; letter-spacing: 2px;"><?php echo esc_html( $f_num ); ?></span>
                                </div>
                                <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 6px;"><?php echo esc_html( 'SPEC. ' . $f_num . ' // CAPABILITY' ); ?></span>
                                <h3 class="service-title"><?php echo esc_html( $srv_item['title'] ); ?></h3>
                                <p class="service-desc"><?php echo esc_html( $srv_item['desc'] ); ?></p>
                                <div class="service-spec-deliverables">
                                    <?php foreach ( $srv_item['specs'] as $spec_bullet ) : ?>
                                        <div class="service-spec-item">
                                            <span class="bullet">—</span>
                                            <span><?php echo esc_html( $spec_bullet ); ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="service-card-bottom" style="padding-top: 18px; border-top: 1px dashed rgba(255, 255, 255, 0.08);">
                                <a href="#contact" class="service-link">
                                    <span><?php esc_html_e( 'Start Inquiry', 'designs-ng' ); ?></span>
                                    <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>

            <!-- Architectural Capabilities Monograph Summary Banner -->
            <div class="capabilities-monograph frame-dashed frame-accent gsap-reveal">
                <span class="corner-crosshair tl">+</span>
                <span class="corner-crosshair tr">+</span>
                <span class="corner-crosshair bl">+</span>
                <span class="corner-crosshair br">+</span>
                <div class="monograph-text-col">
                    <span class="editorial-figure-label" style="margin-bottom: 4px; font-size: 11px;"><?php esc_html_e( 'CATALOGUE // 2026 ROADMAP', 'designs-ng' ); ?></span>
                    <h4 style="font-size: 20px; font-weight: 400; color: #FFFFFF; margin: 4px 0 8px 0;"><?php esc_html_e( 'Looking For A Tailored Multi-Disciplinary Scope?', 'designs-ng' ); ?></h4>
                    <p style="font-size: 14px; color: var(--text-secondary); margin: 0; line-height: 1.7;"><?php esc_html_e( 'We orchestrate bespoke teams combining spatial architecture, digital engineering, and brand identity for global enterprises.', 'designs-ng' ); ?></p>
                </div>
                <div class="monograph-btn-col">
                    <a href="<?php echo esc_url( home_url( '/start-project/' ) ); ?>" class="btn btn-primary btn-magnetic">
                        <span><?php esc_html_e( 'Request Custom Roadmap', 'designs-ng' ); ?> &rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. FEATURED PORTFOLIO (HORIZONTAL SWIPE + 3D TILT) -->
    <section class="portfolio-swipe-section" id="portfolio">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DISCIPLINE // 03 SELECTED COMMISSIONS', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">ARCHIVE // 2025–2026 CLIENT MONOGRAPH</span>
                </div>
            </div>

            <div class="portfolio-header-wrap">
                <div>
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Selected Works', 'designs-ng' ); ?></span>
                    </div>
                    <h2 class="section-title gsap-reveal" style="margin-bottom: 0;">Featured Projects</h2>
                </div>
                <div>
                    <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="btn btn-secondary">
                        <span><?php esc_html_e( 'All Projects', 'designs-ng' ); ?></span>
                        <?php echo designs_ng_get_svg( 'arrow-right' ); ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="container" style="overflow: visible;">
            <div class="portfolio-cards-wrapper">
                <?php
                $portfolio_query = new WP_Query( array(
                    'post_type'      => 'project',
                    'posts_per_page' => 6,
                    'meta_query'     => array(
                        'relation' => 'OR',
                        array(
                            'key'     => '_project_featured',
                            'value'   => '1',
                            'compare' => '='
                        ),
                        array(
                            'key'     => '_project_featured',
                            'compare' => 'NOT EXISTS'
                        )
                    )
                ) );

                if ( $portfolio_query->have_posts() ) :
                    while ( $portfolio_query->have_posts() ) : $portfolio_query->the_post();
                        $client     = get_post_meta( get_the_ID(), '_project_client', true ) ?: 'Client Project';
                        $year       = get_post_meta( get_the_ID(), '_project_year', true ) ?: '2025';
                        $short_desc = get_post_meta( get_the_ID(), '_project_short_desc', true ) ?: get_the_excerpt();
                        $cats       = get_the_terms( get_the_ID(), 'project_category' );
                        $cat_name   = ( ! empty( $cats ) && ! is_wp_error( $cats ) ) ? $cats[0]->name : 'Branding';
                        ?>
                        <article class="portfolio-card frame-dashed">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="card-image-wrap">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'designs-project-card' ); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url( designs_ng_get_project_image_url( get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>" class="card-img-cover" loading="lazy">
                                <?php endif; ?>
                                <span class="card-category-pill"><?php echo esc_html( $cat_name ); ?></span>
                                <span class="card-year-pill"><?php echo esc_html( $year ); ?></span>
                            </div>

                            <div class="card-body">
                                <div>
                                    <p class="card-client"><?php echo esc_html( $client ); ?></p>
                                    <h3 class="card-title"><?php the_title(); ?></h3>
                                    <p class="card-excerpt"><?php echo esc_html( wp_trim_words( $short_desc, 15 ) ); ?></p>
                                </div>
                                <div class="card-footer">
                                    <a href="<?php the_permalink(); ?>" class="card-action">
                                        <span><?php esc_html_e( 'Case Study', 'designs-ng' ); ?></span>
                                        <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                                    </a>
                                </div>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- 5. TESTIMONIALS SECTION -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DISCIPLINE // 04 REPUTATION & TRUST', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">GLOBAL CLIENT MONOGRAPHS & ENDORSEMENTS</span>
                </div>
            </div>

            <div class="section-header-centered">
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Reputation', 'designs-ng' ); ?></span>
                </div>
                <h2 class="section-title gsap-reveal"><?php esc_html_e( 'Client Endorsements', 'designs-ng' ); ?></h2>
                <p class="section-subtitle gsap-reveal">
                    What founders, clinicians, and business leaders say about collaborating with Adam Studio.
                </p>
            </div>

            <div class="testimonials-grid">
                <!-- Testimonial 1: John (USA) -->
                <div class="testimonial-card frame-dashed gsap-testimonial-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;">FIG. 01</span>
                        <div class="testimonial-stars">
                            <?php for ( $i = 0; $i < 5; $i++ ) echo designs_ng_get_svg( 'star' ); ?>
                        </div>
                    </div>
                    <p class="testimonial-quote">
                        “Adam Studio completely revolutionized our corporate positioning. Their motion design, creative speed, and relentless pursuit of excellence is on par with the best international agencies.”
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar-badge">J</div>
                        <div>
                            <div class="author-name">John</div>
                            <div class="author-location">United States</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2: Peculiar (Abuja) -->
                <div class="testimonial-card frame-dashed gsap-testimonial-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;">FIG. 02</span>
                        <div class="testimonial-stars">
                            <?php for ( $i = 0; $i < 5; $i++ ) echo designs_ng_get_svg( 'star' ); ?>
                        </div>
                    </div>
                    <p class="testimonial-quote">
                        “In Abuja's competitive luxury real estate market, our brand needed to stand in a league of its own. Adam Studio delivered an editorial masterpiece that closed luxury penthouse acquisitions.”
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar-badge">P</div>
                        <div>
                            <div class="author-name">Peculiar</div>
                            <div class="author-location">Abuja, Nigeria</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3: Olayemi (UK) -->
                <div class="testimonial-card frame-dashed gsap-testimonial-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;">FIG. 03</span>
                        <div class="testimonial-stars">
                            <?php for ( $i = 0; $i < 5; $i++ ) echo designs_ng_get_svg( 'star' ); ?>
                        </div>
                    </div>
                    <p class="testimonial-quote">
                        “The attention to typography, micro-interactions, and fluid motion blew our investors away. Truly an international standard agency that understands luxury digital storytelling.”
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar-badge">O</div>
                        <div>
                            <div class="author-name">Olayemi</div>
                            <div class="author-location">United Kingdom</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4: Dr Austen (USA) -->
                <div class="testimonial-card frame-dashed gsap-testimonial-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;">FIG. 04</span>
                        <div class="testimonial-stars">
                            <?php for ( $i = 0; $i < 5; $i++ ) echo designs_ng_get_svg( 'star' ); ?>
                        </div>
                    </div>
                    <p class="testimonial-quote">
                        “They transformed our clinic’s patient portal into an effortless, comforting experience. The professionalism and execution quality was flawless throughout the engagement.”
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar-badge">A</div>
                        <div>
                            <div class="author-name">Dr Austen</div>
                            <div class="author-location">United States</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5: Emmanuel (Lagos) -->
                <div class="testimonial-card frame-dashed gsap-testimonial-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                        <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;">FIG. 05</span>
                        <div class="testimonial-stars">
                            <?php for ( $i = 0; $i < 5; $i++ ) echo designs_ng_get_svg( 'star' ); ?>
                        </div>
                    </div>
                    <p class="testimonial-quote">
                        “Working with Adam Studio was the highest ROI investment for our product launch. Fast, communicative, and ridiculously creative. You cannot go wrong with them.”
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar-badge">E</div>
                        <div>
                            <div class="author-name">Emmanuel</div>
                            <div class="author-location">Lagos, Nigeria</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. TEAM SECTION -->
    <section class="team-section" id="team">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DISCIPLINE // 05 STUDIO COLLECTIVE', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">CREATIVE DIRECTORS & SENIOR PARTNERS</span>
                </div>
            </div>

            <div class="section-header-centered">
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Our Collective', 'designs-ng' ); ?></span>
                </div>
                <h2 class="section-title gsap-reveal"><?php esc_html_e( 'The Creative Team', 'designs-ng' ); ?></h2>
                <p class="section-subtitle gsap-reveal">
                    A multi-disciplinary studio of brand strategists, art directors, and engineers.
                </p>
            </div>

            <div class="team-grid">
                <?php
                $team_query = new WP_Query( array(
                    'post_type'      => 'team',
                    'posts_per_page' => 8,
                    'orderby'        => 'date',
                    'order'          => 'ASC'
                ) );

                if ( $team_query->have_posts() ) :
                    while ( $team_query->have_posts() ) : $team_query->the_post();
                        $role   = get_post_meta( get_the_ID(), '_team_role', true ) ?: 'Creative Director';
                        $social = get_post_meta( get_the_ID(), '_team_social', true ) ?: '#';
                        ?>
                        <div class="team-member frame-dashed">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="team-photo-wrap">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'designs-team-card' ); ?>
                                <?php else : ?>
                                    <img src="<?php echo esc_url( designs_ng_get_team_image_url( get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>" class="team-img-cover" loading="lazy">
                                <?php endif; ?>
                            </div>
                            <div class="team-info">
                                <h3 class="team-name"><?php the_title(); ?></h3>
                                <p class="team-role"><?php echo esc_html( $role ); ?></p>
                                <a href="<?php echo esc_url( $social ); ?>" target="_blank" rel="noopener noreferrer" class="team-social-link">
                                    <span><?php esc_html_e( 'Connect', 'designs-ng' ); ?></span>
                                    <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- 7. BIG CTA / START YOUR PROJECT -->
    <section class="big-cta-section" id="cta">
        <div class="container">
            <div class="cta-inner frame-dashed frame-accent" style="padding: clamp(60px, 8vw, 100px) clamp(24px, 5vw, 64px);">
                <span class="corner-crosshair tl">+</span>
                <span class="corner-crosshair tr">+</span>
                <span class="corner-crosshair bl">+</span>
                <span class="corner-crosshair br">+</span>
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1); width: 100%;">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'INITIATION // 2026 ENGAGEMENT', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">STUDIO AVAILABLE FOR GLOBAL COMMISSIONS</span>
                </div>
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Initiate Engagement', 'designs-ng' ); ?></span>
                </div>
                <h2 class="cta-title gsap-reveal">
                    Ready To Bring <span class="accent-green">Excellence</span><br>To Your Brand?
                </h2>
                <p class="cta-subtitle gsap-reveal">
                    Let’s design an extraordinary brand experience that commands market prestige and compounds value over time.
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

    <!-- 8. CONTACT SECTION -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DISCIPLINE // 06 DIRECT ENGAGEMENT', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">ABUJA HQ • LAT. 06°31'N / LON. 03°23'E</span>
                </div>
            </div>

            <div class="contact-grid">
                <div class="contact-left-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Contact', 'designs-ng' ); ?></span>
                    </div>
                    <h2 class="section-title gsap-reveal"><?php esc_html_e( 'Let’s Start A Conversation', 'designs-ng' ); ?></h2>
                    <p class="gsap-reveal" style="color: var(--text-secondary); font-size: 16px; margin-bottom: 40px; line-height: 1.7;">
                        Whether you need a complete brand identity, an immersive web platform, or bespoke corporate creative direction, our team is ready to consult.
                    </p>

                    <div class="contact-info-list" style="display: flex; flex-direction: column; gap: 20px;">
                        <div class="contact-info-item frame-dashed gsap-reveal" style="padding: 24px;">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="contact-info-icon">
                                <?php echo designs_ng_get_svg( 'mail' ); ?>
                            </div>
                            <div class="contact-info-text">
                                <h4>Email Directly</h4>
                                <p><a href="mailto:contact@designs.ng">contact@designs.ng</a></p>
                            </div>
                        </div>

                        <div class="contact-info-item frame-dashed gsap-reveal" style="padding: 24px;">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="contact-info-icon">
                                <?php echo designs_ng_get_svg( 'map-pin' ); ?>
                            </div>
                            <div class="contact-info-text">
                                <h4>Location</h4>
                                <p>Abuja, Nigeria</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form-card frame-dashed gsap-reveal-card" style="position: relative;">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <form class="designs-ajax-form" data-form-source="Homepage Quick Inquiry" method="post">
                        <?php wp_nonce_field( 'designs_lead_nonce_action', 'lead_nonce' ); ?>
                        <input type="text" name="website_hp" style="display:none !important;" tabindex="-1" autocomplete="off">
                        <div class="form-feedback-area" role="status" aria-live="polite"></div>
                        <div class="form-group">
                            <label for="c_name"><?php esc_html_e( 'Name or Company', 'designs-ng' ); ?></label>
                            <input type="text" id="c_name" name="lead_name" class="form-control" placeholder="e.g. John Doe" required>
                        </div>
                        <div class="form-group">
                            <label for="c_email"><?php esc_html_e( 'Email Address', 'designs-ng' ); ?></label>
                            <input type="email" id="c_email" name="lead_email" class="form-control" placeholder="john@company.com" required>
                        </div>
                        <div class="form-group">
                            <label for="c_service"><?php esc_html_e( 'Service Required', 'designs-ng' ); ?></label>
                            <select id="c_service" name="lead_service" class="form-control">
                                <option value="Branding & Identity">Branding & Identity</option>
                                <option value="Website Development">Website Development</option>
                                <option value="UI/UX Design">UI/UX Design</option>
                                <option value="App Development">App Development</option>
                                <option value="Architecture & Interior Design">Architecture & Interior Design</option>
                                <option value="Souvenirs & Merchandise">Souvenirs & Corporate Merchandise</option>
                                <option value="Complete Creative Direction">Complete Creative Direction</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="c_message"><?php esc_html_e( 'Project Brief', 'designs-ng' ); ?></label>
                            <textarea id="c_message" name="lead_message" class="form-control" placeholder="Share your vision, timeline, and scope..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-magnetic form-submit-btn" style="width: 100%;">
                            <span class="btn-text"><?php esc_html_e( 'Submit Proposal Request', 'designs-ng' ); ?></span>
                            <?php echo designs_ng_get_svg( 'arrow-right' ); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main><!-- #primary -->

<?php
endif;

get_footer();
