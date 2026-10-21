<?php
/**
 * Template Name: Who We Are (About Page)
 *
 * Dedicated about page for Adam Studio featuring company story, values, team, and CTA.
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

<main id="primary" class="site-main page-who-we-are">

    <!-- HERO SECTION (SPLIT 6x2 EDITORIAL HERO WITH PARALLAX & CLIP-PATH) -->
    <section class="page-hero page-hero-split">
        <div class="container">
            <div class="page-hero-split-grid">
                <!-- Left 6-Col: Editorial Typography & Context -->
                <div class="page-hero-text-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Who We Are', 'designs-ng' ); ?></span>
                    </div>
                    <h1 class="page-hero-split-title gsap-reveal">
                        We Transform Ambitious Ideas Into <span class="accent-green">Market Leaders</span>.
                    </h1>
                    <p class="page-hero-split-desc gsap-reveal">
                        A collective of designers, technologists, and brand strategists dedicated to artistic excellence and international execution standards.
                    </p>
                    <div class="page-hero-meta-chips gsap-reveal">
                        <span class="editorial-coord-tag">[ 06°31'N / 03°23'E ]</span>
                        <span class="meta-chip-divider">•</span>
                        <span class="meta-chip-text"><?php esc_html_e( 'STUDIO DOSSIER 2026', 'designs-ng' ); ?></span>
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
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Adam Studio Studio Atelier', 'designs-ng' ); ?>" class="hero-half-img gsap-hero-half-img" width="1200" height="800">
                            <div class="hero-half-vignette"></div>
                            
                            <div class="hero-half-badge-float">
                                <span class="badge-dot"></span>
                                <span class="badge-text"><?php esc_html_e( 'ATELIER HEADQUARTERS • ABUJA', 'designs-ng' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STORY & PHILOSOPHY -->
    <section class="about-section">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DOSSIER // 01 STUDIO CULTURE', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag" style="font-family: var(--font-main); font-size: 11px; letter-spacing: 0.12em; color: var(--text-muted);">LAT. 06°31'N / LON. 03°23'E • LAGOS</span>
                </div>
            </div>

            <div class="about-grid">
                <div class="about-left-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Our Purpose', 'designs-ng' ); ?></span>
                    </div>
                    <h2 class="section-title gsap-reveal">
                        Crafted In Nigeria.<br>Engineered For The World.
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
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-3.jpg' ); ?>" alt="<?php esc_attr_e( 'Adam Studio Studio Atelier', 'designs-ng' ); ?>" class="editorial-img-main" loading="lazy">
                        </div>

                        <div class="frame-dashed editorial-layer-offset">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-4.jpg' ); ?>" alt="<?php esc_attr_e( 'Material Fabrication & Craft', 'designs-ng' ); ?>" class="editorial-img-sub" loading="lazy">
                            <div class="offset-caption" style="padding-top: 8px;">
                                <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;"><?php esc_html_e( 'FIG. 02 — FABRICATION CADENCE', 'designs-ng' ); ?></span>
                            </div>
                        </div>

                        <div class="editorial-layer-badge">
                            <span><?php esc_html_e( 'PAN-AFRICAN ROOTS • GLOBAL IMPACT', 'designs-ng' ); ?></span>
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
                        <h4>Our Mission</h4>
                        <p>To eliminate mediocrity in African branding and software experiences by producing work that stands toe-to-toe with the finest creative agencies in London, New York, and Tokyo.</p>
                    </div>
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">02</span>
                        <h4>Our Vision</h4>
                        <p>To be the premier international gateway for discerning brands seeking high-prestige identities, fluid interactive platforms, and tangible luxury artifacts.</p>
                    </div>
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">03</span>
                        <h4>Our Ethos</h4>
                        <p>Zero clutter, maximum intentionality. We believe that true luxury lies in simplicity, mathematical proportions, and micro-interactions that spark delight.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- VALUES & PROCESS -->
    <section class="services-section" style="background: var(--bg-surface);">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'METHODOLOGY // 02 PROCESS CADENCE', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">4-STAGE ENGINEERING FRAMEWORK</span>
                </div>
            </div>

            <div class="section-header-centered">
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Our Methodology', 'designs-ng' ); ?></span>
                </div>
                <h2 class="section-title gsap-reveal"><?php esc_html_e( 'How We Deliver Excellence', 'designs-ng' ); ?></h2>
                <p class="section-subtitle gsap-reveal">
                    A rigorous 4-step creative engineering process designed for certainty, velocity, and world-class polish.
                </p>
            </div>

            <div class="process-step-grid">
                <div class="service-card frame-dashed gsap-service-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div class="service-card-top">
                        <div class="service-icon-wrap">
                            <span style="font-weight: 400; color: var(--accent-green); font-size: 16px; letter-spacing: 1.5px;">01</span>
                        </div>
                        <h3 class="service-title">Immersion</h3>
                        <p class="service-desc">We interrogate your business fundamentals, competitive positioning, and consumer psychology to discover your unique differentiation.</p>
                    </div>
                </div>

                <div class="service-card frame-dashed gsap-service-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div class="service-card-top">
                        <div class="service-icon-wrap">
                            <span style="font-weight: 400; color: var(--accent-green); font-size: 16px; letter-spacing: 1.5px;">02</span>
                        </div>
                        <h3 class="service-title">Direction</h3>
                        <p class="service-desc">We establish a bespoke visual language, typography pairing, motion curves, and layout principles before creating a single production asset.</p>
                    </div>
                </div>

                <div class="service-card frame-dashed gsap-service-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div class="service-card-top">
                        <div class="service-icon-wrap">
                            <span style="font-weight: 400; color: var(--accent-green); font-size: 16px; letter-spacing: 1.5px;">03</span>
                        </div>
                        <h3 class="service-title">Craft</h3>
                        <p class="service-desc">High-velocity execution across code, 3D spatial design, and brand identity, tested thoroughly for cross-device fluidity and sub-second speed.</p>
                    </div>
                </div>

                <div class="service-card frame-dashed gsap-service-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <div class="service-card-top">
                        <div class="service-icon-wrap">
                            <span style="font-weight: 400; color: var(--accent-green); font-size: 16px; letter-spacing: 1.5px;">04</span>
                        </div>
                        <h3 class="service-title">Scale</h3>
                        <p class="service-desc">Seamless deployment, full client training, comprehensive design systems, and ongoing strategic evolution as your brand grows.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM SECTION -->
    <section class="team-section" id="team">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'COLLECTIVE // 03 STUDIO LEADERSHIP', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">SENIOR PARTNERS & DIRECTORS</span>
                </div>
            </div>

            <div class="section-header-centered">
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Leadership', 'designs-ng' ); ?></span>
                </div>
                <h2 class="section-title gsap-reveal"><?php esc_html_e( 'The Minds Behind The Work', 'designs-ng' ); ?></h2>
                <p class="section-subtitle gsap-reveal">
                    Meet the creative directors, motion engineers, and architectural specialists driving Adam Studio.
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

    <!-- BIG CTA -->
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
                    <span><?php esc_html_e( 'Collaborate', 'designs-ng' ); ?></span>
                </div>
                <h2 class="cta-title gsap-reveal">
                    Ready To Elevate Your <span class="accent-green">Brand</span>?
                </h2>
                <p class="cta-subtitle gsap-reveal">
                    Join forward-thinking market leaders who partnered with Adam Studio to command prestige and authority.
                </p>
                <div class="gsap-reveal" style="margin-top: 16px;">
                    <a href="<?php echo esc_url( home_url( '/start-project/' ) ); ?>" class="btn btn-primary btn-magnetic btn-cta-large">
                        <span><?php esc_html_e( 'Start Your Project', 'designs-ng' ); ?></span>
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
