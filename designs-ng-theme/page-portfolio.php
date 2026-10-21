<?php
/**
 * Template Name: Portfolio / Our Work
 *
 * Immersive Portfolio Theatre Layout with Dual-Sided Zoom Wings on Every Project Row
 * and Rich Central Showcase Stage. Fully dynamic for WordPress post_type 'project'.
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
    // Query all published projects
    $portfolio_query = new WP_Query( array(
        'post_type'      => 'project',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order date',
        'order'          => 'DESC'
    ) );

    $all_projects = array();
    if ( $portfolio_query->have_posts() ) {
        while ( $portfolio_query->have_posts() ) {
            $portfolio_query->the_post();
            $p_id       = get_the_ID();
            $client     = get_post_meta( $p_id, '_project_client', true ) ?: 'Adam Studio Partner';
            $year       = get_post_meta( $p_id, '_project_year', true ) ?: '2025';
            $short_desc = get_post_meta( $p_id, '_project_short_desc', true ) ?: get_the_excerpt();
            $url        = get_post_meta( $p_id, '_project_url', true );
            $img_url    = designs_ng_get_project_image_url( $p_id );
            
            $cats       = get_the_terms( $p_id, 'project_category' );
            $cat_slugs  = array();
            $cat_names  = array();
            if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) {
                foreach ( $cats as $c ) {
                    $cat_slugs[] = $c->slug;
                    $cat_names[] = $c->name;
                }
            }
            $cat_slug_str = implode( ' ', $cat_slugs );
            $cat_name_str = ! empty( $cat_names ) ? $cat_names[0] : 'Case Study';

            $all_projects[] = array(
                'id'          => $p_id,
                'title'       => get_the_title(),
                'permalink'   => get_permalink(),
                'client'      => $client,
                'year'        => $year,
                'short_desc'  => $short_desc,
                'url'         => $url,
                'img_url'     => $img_url,
                'cat_slugs'   => $cat_slug_str,
                'cat_name'    => $cat_name_str,
                'all_cats'    => $cat_names
            );
        }
        wp_reset_postdata();
    }
    $total_projects = count( $all_projects );

    // Project specifications and impact map for multi-slide monograph
    $project_details_map = array(
        'vantage' => array(
            'challenge_title' => 'Transforming 12,000 sq ft into an Acoustic & Biophilic Sanctuary',
            'challenge_desc'  => 'Vantage Atelier needed an ultra-luxurious commercial interior where acoustic serenity meets monumental Nigerian basalt stone. The space had to embody quiet luxury without aesthetic clutter.',
            'spec_img'        => get_template_directory_uri() . '/assets/images/hero-slide-3.jpg',
            'impact_img'      => get_template_directory_uri() . '/assets/images/services-hero.jpg',
            'deliverables'    => array(
                '3D Photorealistic Spatial Walkthroughs',
                'Mathematical Acoustic & Lighting Engineering',
                'Bespoke Raw Basalt & Teak Millwork Specs',
                'Sustainable Biophilic Climate Control Integration'
            ),
            'metrics'         => array(
                array( 'val' => '+310%', 'lbl' => 'VIP Private Inquiries' ),
                array( 'val' => '12,000', 'lbl' => 'Sq Ft Engineered' ),
                array( 'val' => '100%', 'lbl' => 'Bespoke Millwork Fit' )
            ),
            'quote'           => 'Adam Studio delivered an architectural masterwork that immediately established our space as a national benchmark for quiet luxury.',
            'quote_author'    => 'Director of Spatial Design, Vantage Atelier'
        ),
        'zenith' => array(
            'challenge_title' => 'Zero-Latency Cross-Border Payment Architecture',
            'challenge_desc'  => 'Zenith required an ultra-responsive fintech mobile platform that eliminated payment friction across 18 currencies while preserving banking-grade ISO 27001 encryption standards.',
            'spec_img'        => get_template_directory_uri() . '/assets/images/hero-slide-1.jpg',
            'impact_img'      => get_template_directory_uri() . '/assets/images/project-zenith.webp',
            'deliverables'    => array(
                'High-Frequency Cross-Border Flutter Architecture',
                'Micro-Interaction & Haptic Physics Engine',
                'Biometric Authentication & Multi-Ledger Vault',
                'Sub-Second Real-Time FX Conversion Pipeline'
            ),
            'metrics'         => array(
                array( 'val' => '< 420ms', 'lbl' => 'Transaction Speed' ),
                array( 'val' => '$48M+', 'lbl' => 'Monthly Volume Handled' ),
                array( 'val' => '4.9 ★', 'lbl' => 'Average App Rating' )
            ),
            'quote'           => 'The motion physics, speed, and fluidity crafted by Adam Studio set a completely new gold standard in digital banking across Africa.',
            'quote_author'    => 'Head of Product, Zenith Financial'
        ),
        'mackenny' => array(
            'challenge_title' => 'Synchronizing Global British Curriculum Across 4 Continents',
            'challenge_desc'  => 'MacKenny needed to consolidate a disparate network of elite private tutors and students across London, Dubai, and Lagos into a unified, high-speed educational platform.',
            'spec_img'        => get_template_directory_uri() . '/assets/images/hero-slide-2.jpg',
            'impact_img'      => get_template_directory_uri() . '/assets/images/project-mackenny.webp',
            'deliverables'    => array(
                'Custom WordPress & Elementor Parent/Student Portal',
                'WebRTC Low-Latency Interactive Classroom',
                'Automated Multi-Timezone Calendar & Billing Engine',
                'Real-Time Student Progress & Assessment Dashboards'
            ),
            'metrics'         => array(
                array( 'val' => '+240%', 'lbl' => 'Student Course Retention' ),
                array( 'val' => '4 Continents', 'lbl' => 'Active Learner Reach' ),
                array( 'val' => '99.98%', 'lbl' => 'Platform Uptime' )
            ),
            'quote'           => 'The bespoke web portal revolutionized our booking cadence and delighted both tutors and parents internationally.',
            'quote_author'    => 'Executive Partner, MacKenny Learning UK'
        ),
        'cosgrove' => array(
            'challenge_title' => 'Physical VIP Handover Artifacts for Smart City Estates',
            'challenge_desc'  => 'For high-net-worth homeowners acquiring multimillion-dollar smart villas, standard welcome packages were insufficient. Cosgrove commissioned bespoke luxury unboxing suites.',
            'spec_img'        => get_template_directory_uri() . '/assets/images/hero-slide-4.jpg',
            'impact_img'      => get_template_directory_uri() . '/assets/images/project-cosgrove.webp',
            'deliverables'    => array(
                'Matte Obsidian Precision-Milled Gift Cases',
                'Laser-Engraved Titanium NFC Smart Home Keys',
                'Custom Italian Leather Document Folders',
                'VIP Architectural Monograph & Unboxing Experience'
            ),
            'metrics'         => array(
                array( 'val' => '1,200+', 'lbl' => 'Handcrafted VIP Suites' ),
                array( 'val' => '100%', 'lbl' => 'Luxury Unboxing Delight' ),
                array( 'val' => 'Zero', 'lbl' => 'Fabrication Tolerance' )
            ),
            'quote'           => 'The weight, tactile luxury, and titanium precision of the welcome kits left an indelible mark on every villa buyer.',
            'quote_author'    => 'VP of Client Experience, Cosgrove Smart Cities'
        ),
        'peculiar' => array(
            'challenge_title' => 'Reinventing Luxury Real Estate Positioning in Maitama & Guzape',
            'challenge_desc'  => 'In Abuja’s prime real estate sector, generic property websites were failing to engage diaspora investors. Peculiar needed an editorial visual brand and 3D penthouse tour platform.',
            'spec_img'        => get_template_directory_uri() . '/assets/images/portfolio-hero.jpg',
            'impact_img'      => get_template_directory_uri() . '/assets/images/project-peculiar.webp',
            'deliverables'    => array(
                'Monogram Brand Identity & Gold Foil Guilding Specs',
                'WebGL 3D Interactive Virtual Penthouse Tours',
                'Editorial Hardcover Property Acquisition Monographs',
                'Global Ultra-Responsive Web Experience'
            ),
            'metrics'         => array(
                array( 'val' => '₦14B+', 'lbl' => 'Pipeline Transactions' ),
                array( 'val' => '+180%', 'lbl' => 'Diaspora Buyer Reach' ),
                array( 'val' => '14 Days', 'lbl' => 'Average Sales Velocity' )
            ),
            'quote'           => 'Adam Studio gave us a visual presence that placed our developments alongside the most prestigious addresses in Knightsbridge or Manhattan.',
            'quote_author'    => 'Managing Director, Peculiar Properties'
        ),
        'midwest' => array(
            'challenge_title' => 'Humanizing Elite Cosmetic Dentistry into a Serene Retreat',
            'challenge_desc'  => 'Midwest sought to eliminate the cold, sterile clinical perception of dental care, turning their clinic into a warm, high-craft wellness retreat with frictionless booking.',
            'spec_img'        => get_template_directory_uri() . '/assets/images/about-hero.jpg',
            'impact_img'      => get_template_directory_uri() . '/assets/images/project-midwest.webp',
            'deliverables'    => array(
                'Complete Brand Transformation & Earth-Tone Architecture',
                'Frictionless Digital Patient Onboarding & Scheduling',
                'Tactile Print Collateral & Architectural Wayfinding',
                'HIPAA-Compliant Patient Portal & Records Vault'
            ),
            'metrics'         => array(
                array( 'val' => '+380%', 'lbl' => 'Online Patient Bookings' ),
                array( 'val' => '4.95 ★', 'lbl' => 'Patient Experience Rating' ),
                array( 'val' => '-65%', 'lbl' => 'Intake Desk Wait Time' )
            ),
            'quote'           => 'Our patients frequently comment on how peaceful and premium our branding feels from their very first visit.',
            'quote_author'    => 'Lead Cosmetic Surgeon, Midwest Healthcare'
        ),
    );
?>

<main id="primary" class="site-main page-portfolio-theatre">

    <!-- PAGE HERO (SPLIT 6x2 EDITORIAL HERO WITH PARALLAX & CLIP-PATH) -->
    <section class="page-hero page-hero-split">
        <div class="container">
            <div class="page-hero-split-grid" style="margin-bottom: 48px;">
                <!-- Left 6-Col: Editorial Typography & Context -->
                <div class="page-hero-text-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Selected Portfolio • 2026 Edition', 'designs-ng' ); ?></span>
                    </div>
                    
                    <h1 class="page-hero-split-title gsap-reveal">
                        Distinctive Ideas.<br><span class="accent-green">Compounded Value.</span>
                    </h1>

                    <p class="page-hero-split-desc gsap-reveal">
                        Explore how we architect global brand identities, immersive digital touchpoints, and luxury physical artifacts for market-defining enterprises.
                    </p>

                    <div class="page-hero-meta-chips gsap-reveal">
                        <span class="editorial-coord-tag"><?php echo esc_html( $total_projects ); ?> COMMISSIONS ARCHIVED</span>
                        <span class="meta-chip-divider">•</span>
                        <span class="meta-chip-text"><?php esc_html_e( 'AWARD RECOGNIZED', 'designs-ng' ); ?></span>
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
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/portfolio-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Adam Studio Selected Architecture & Digital Works', 'designs-ng' ); ?>" class="hero-half-img gsap-hero-half-img" width="1200" height="800">
                            <div class="hero-half-vignette"></div>
                            
                            <div class="hero-half-badge-float">
                                <span class="badge-dot"></span>
                                <span class="badge-text"><?php esc_html_e( 'GLOBAL ARCHIVE • VOL. 26', 'designs-ng' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Filter Bar -->
            <div class="portfolio-filter-bar gsap-reveal">
                <button class="filter-btn active" data-category="all"><?php esc_html_e( 'All Works', 'designs-ng' ); ?></button>
                <?php
                $terms = get_terms( array(
                    'taxonomy'   => 'project_category',
                    'hide_empty' => false,
                ) );
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
                    foreach ( $terms as $term ) :
                        ?>
                        <button class="filter-btn" data-category="<?php echo esc_attr( $term->slug ); ?>">
                            <?php echo esc_html( $term->name ); ?>
                        </button>
                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- IMMERSIVE DUAL-SIDED ZOOM THEATRE -->
    <section class="portfolio-theatre-section">
        <div class="container" style="margin-bottom: 32px;">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'ARCHIVE // 01 CLIENT MONOGRAPHS', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">IMMERSIVE CASE STUDIES • 2026 EDITION</span>
                </div>
            </div>
        </div>

        <div class="portfolio-theatre-layout">

            <?php
            if ( $total_projects > 0 ) :
                $index = 0;
                foreach ( $all_projects as $proj ) :
                    $display_num = str_pad( (string) ($index + 1), 2, '0', STR_PAD_LEFT ) . ' // ' . str_pad( (string) $total_projects, 2, '0', STR_PAD_LEFT );
                    
                    // Left and right flank images: contextual visual accents from adjacent projects
                    $left_idx  = ( $index - 1 + $total_projects ) % $total_projects;
                    $right_idx = ( $index + 1 ) % $total_projects;
                    $left_proj  = $all_projects[$left_idx];
                    $right_proj = $all_projects[$right_idx];
                    ?>
                    <div class="theatre-project-row portfolio-item-filterable gsap-theatre-row" data-categories="<?php echo esc_attr( $proj['cat_slugs'] ); ?>">

                        <!-- LEFT FLANKING DYNAMIC ZOOM WING -->
                        <aside class="theatre-side-wing theatre-wing-left" aria-hidden="true">
                            <div class="zoom-side-panel zoom-panel-left frame-dashed">
                                <span class="corner-crosshair tl">+</span>
                                <span class="corner-crosshair tr">+</span>
                                <span class="corner-crosshair bl">+</span>
                                <span class="corner-crosshair br">+</span>
                                <img src="<?php echo esc_url( $left_proj['img_url'] ); ?>" alt="" loading="lazy">
                                <span class="panel-tag"><?php echo esc_html( $left_proj['cat_name'] ); ?> // FIG. L</span>
                            </div>
                        </aside>

                        <!-- CENTER RICH EDITORIAL SHOWCASE STAGE -->
                        <div class="theatre-center-stage">
                            <?php
                            $slug_key = strtolower( get_post_field( 'post_name', $proj['id'] ) );
                            $matched_key = 'vantage';
                            foreach ( array_keys( $project_details_map ) as $k ) {
                                if ( stripos( $slug_key, $k ) !== false || stripos( $proj['title'], $k ) !== false ) {
                                    $matched_key = $k;
                                    break;
                                }
                            }
                            $details = $project_details_map[$matched_key];
                            ?>
                            <article class="theatre-project-card frame-dashed gsap-stage-card" data-current-slide="0" data-project-id="<?php echo esc_attr( $proj['id'] ); ?>">
                                <span class="corner-crosshair tl">+</span>
                                <span class="corner-crosshair tr">+</span>
                                <span class="corner-crosshair bl">+</span>
                                <span class="corner-crosshair br">+</span>
                                
                                <!-- SLIDE NAVIGATION BAR -->
                                <div class="theatre-card-nav-bar">
                                    <div class="theatre-nav-tabs" role="tablist">
                                        <button type="button" class="theatre-tab-btn active" data-slide="0" role="tab" aria-selected="true">
                                            <span class="tab-step">01</span>
                                            <span class="tab-label"><?php esc_html_e( 'Overview', 'designs-ng' ); ?></span>
                                        </button>
                                        <button type="button" class="theatre-tab-btn" data-slide="1" role="tab" aria-selected="false">
                                            <span class="tab-step">02</span>
                                            <span class="tab-label"><?php esc_html_e( 'Strategy & Scope', 'designs-ng' ); ?></span>
                                        </button>
                                        <button type="button" class="theatre-tab-btn" data-slide="2" role="tab" aria-selected="false">
                                            <span class="tab-step">03</span>
                                            <span class="tab-label"><?php esc_html_e( 'Impact & Results', 'designs-ng' ); ?></span>
                                        </button>
                                    </div>

                                    <div class="theatre-nav-actions">
                                        <span class="theatre-nav-counter">
                                            <span class="counter-curr">01</span> / <span class="counter-total">03</span>
                                        </span>
                                        <div class="theatre-nav-arrows">
                                            <button type="button" class="theatre-arrow-btn theatre-btn-prev btn-magnetic" aria-label="<?php esc_attr_e( 'Previous Slide', 'designs-ng' ); ?>">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                            </button>
                                            <button type="button" class="theatre-arrow-btn theatre-btn-next btn-magnetic" aria-label="<?php esc_attr_e( 'Next Slide', 'designs-ng' ); ?>">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- INTERACTIVE PROGRESS TRACK -->
                                <div class="theatre-card-progress-track">
                                    <div class="theatre-card-progress-bar" style="width: 33.333%;"></div>
                                </div>

                                <!-- SLIDES DECK CONTAINER -->
                                <div class="theatre-slides-deck">

                                    <!-- SLIDE 01: OVERVIEW & ART DIRECTION -->
                                    <div class="theatre-slide-item active" data-slide-index="0">
                                        <div class="theatre-card-media">
                                            <a href="<?php echo esc_url( $proj['permalink'] ); ?>" tabindex="-1">
                                                <img src="<?php echo esc_url( $proj['img_url'] ); ?>" alt="<?php echo esc_attr( $proj['title'] ); ?>" class="card-img-cover" loading="lazy">
                                            </a>
                                            <div class="theatre-media-badges">
                                                <span class="card-category-pill"><?php echo esc_html( $proj['cat_name'] ); ?></span>
                                                <span class="card-year-pill"><?php echo esc_html( $proj['year'] ); ?></span>
                                            </div>
                                            <div class="theatre-slide-badge">
                                                <span class="badge-dot"></span>
                                                <span><?php esc_html_e( 'FIG. 01 — OVERVIEW & ART DIRECTION', 'designs-ng' ); ?></span>
                                            </div>
                                        </div>

                                        <div class="theatre-card-content">
                                            <div class="theatre-card-header">
                                                <span class="editorial-figure-label" style="margin-bottom: 0;"><?php echo esc_html( $proj['client'] ); ?></span>
                                                <span class="theatre-proj-num"><?php echo esc_html( $display_num ); ?></span>
                                            </div>

                                            <h2 class="theatre-card-title">
                                                <a href="<?php echo esc_url( $proj['permalink'] ); ?>" style="color: inherit; text-decoration: none;">
                                                    <?php echo esc_html( $proj['title'] ); ?>
                                                </a>
                                            </h2>

                                            <p class="theatre-card-desc">
                                                <?php echo esc_html( $proj['short_desc'] ); ?>
                                            </p>

                                            <div class="theatre-card-meta-row">
                                                <?php if ( ! empty( $proj['all_cats'] ) ) : ?>
                                                    <?php foreach ( $proj['all_cats'] as $ac ) : ?>
                                                        <span class="theatre-discipline-chip"><?php echo esc_html( $ac ); ?></span>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <span class="theatre-discipline-chip"><?php esc_html_e( 'Brand Architecture', 'designs-ng' ); ?></span>
                                                    <span class="theatre-discipline-chip"><?php esc_html_e( 'Digital Platform', 'designs-ng' ); ?></span>
                                                    <span class="theatre-discipline-chip"><?php esc_html_e( 'Art Direction', 'designs-ng' ); ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="theatre-card-actions">
                                                <a href="<?php echo esc_url( $proj['permalink'] ); ?>" class="btn-view-project btn-magnetic">
                                                    <span><?php esc_html_e( 'Explore Case Study', 'designs-ng' ); ?></span>
                                                    <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                                                </a>

                                                <button type="button" class="theatre-inline-next-btn btn-magnetic" data-target-slide="1">
                                                    <span><?php esc_html_e( 'Next: Strategy & Scope', 'designs-ng' ); ?> &rarr;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SLIDE 02: STRATEGIC CHALLENGE & SCOPE -->
                                    <div class="theatre-slide-item" data-slide-index="1">
                                        <div class="theatre-card-media">
                                            <img src="<?php echo esc_url( $details['spec_img'] ); ?>" alt="<?php echo esc_attr( $proj['title'] ); ?> Scope" class="card-img-cover" loading="lazy">
                                            <div class="theatre-media-badges">
                                                <span class="card-category-pill"><?php esc_html_e( 'Strategic Architecture', 'designs-ng' ); ?></span>
                                                <span class="card-year-pill"><?php esc_html_e( 'Methodology', 'designs-ng' ); ?></span>
                                            </div>
                                            <div class="theatre-slide-badge">
                                                <span class="badge-dot"></span>
                                                <span><?php esc_html_e( 'FIG. 02 — STRATEGIC MANDATE & SCOPE', 'designs-ng' ); ?></span>
                                            </div>
                                        </div>

                                        <div class="theatre-card-content">
                                            <div class="theatre-card-header">
                                                <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'STRATEGIC CHALLENGE // SPECIFICATION', 'designs-ng' ); ?></span>
                                                <span class="theatre-proj-num">PHASE // 02</span>
                                            </div>

                                            <h3 class="theatre-slide-headline">
                                                <?php echo esc_html( $details['challenge_title'] ); ?>
                                            </h3>

                                            <p class="theatre-card-desc">
                                                <?php echo esc_html( $details['challenge_desc'] ); ?>
                                            </p>

                                            <!-- Deliverables Checklist -->
                                            <div class="theatre-deliverables-checklist">
                                                <?php foreach ( $details['deliverables'] as $deliv ) : ?>
                                                    <div class="theatre-deliverable-item">
                                                        <span class="check-icon">✓</span>
                                                        <span><?php echo esc_html( $deliv ); ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <div class="theatre-card-actions">
                                                <button type="button" class="theatre-inline-prev-btn btn-magnetic" data-target-slide="0">
                                                    <span>&larr; <?php esc_html_e( 'Overview', 'designs-ng' ); ?></span>
                                                </button>

                                                <button type="button" class="theatre-inline-next-btn btn-magnetic" data-target-slide="2">
                                                    <span><?php esc_html_e( 'Next: Impact & Results', 'designs-ng' ); ?> &rarr;</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- SLIDE 03: VERIFIED IMPACT & TESTIMONIAL -->
                                    <div class="theatre-slide-item" data-slide-index="2">
                                        <div class="theatre-card-media">
                                            <img src="<?php echo esc_url( $details['impact_img'] ); ?>" alt="<?php echo esc_attr( $proj['title'] ); ?> Impact" class="card-img-cover" loading="lazy">
                                            <div class="theatre-media-badges">
                                                <span class="card-category-pill"><?php esc_html_e( 'Verified Impact', 'designs-ng' ); ?></span>
                                                <span class="card-year-pill"><?php esc_html_e( 'Endorsement', 'designs-ng' ); ?></span>
                                            </div>
                                            <div class="theatre-slide-badge">
                                                <span class="badge-dot"></span>
                                                <span><?php esc_html_e( 'FIG. 03 — COMMERCIAL & CULTURAL IMPACT', 'designs-ng' ); ?></span>
                                            </div>
                                        </div>

                                        <div class="theatre-card-content">
                                            <div class="theatre-card-header">
                                                <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'VERIFIED OUTCOME // FOUNDER MONOGRAPH', 'designs-ng' ); ?></span>
                                                <span class="theatre-proj-num">PHASE // 03</span>
                                            </div>

                                            <!-- Key Metrics Row -->
                                            <div class="theatre-metrics-row">
                                                <?php foreach ( $details['metrics'] as $m ) : ?>
                                                    <div class="theatre-metric-box frame-dashed">
                                                        <span class="metric-val"><?php echo esc_html( $m['val'] ); ?></span>
                                                        <span class="metric-lbl"><?php echo esc_html( $m['lbl'] ); ?></span>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <!-- Executive Quote -->
                                            <blockquote class="theatre-slide-quote">
                                                “<?php echo esc_html( $details['quote'] ); ?>”
                                                <cite>— <?php echo esc_html( $details['quote_author'] ); ?></cite>
                                            </blockquote>

                                            <div class="theatre-card-actions">
                                                <a href="<?php echo esc_url( $proj['permalink'] ); ?>" class="btn-view-project btn-magnetic">
                                                    <span><?php esc_html_e( 'Full Case Study', 'designs-ng' ); ?></span>
                                                    <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                                                </a>

                                                <?php if ( ! empty( $proj['url'] ) ) : ?>
                                                    <a href="<?php echo esc_url( $proj['url'] ); ?>" target="_blank" rel="noopener noreferrer" class="theatre-external-link">
                                                        <span><?php esc_html_e( 'Live Experience', 'designs-ng' ); ?></span>
                                                        <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                                                    </a>
                                                <?php endif; ?>

                                                <button type="button" class="theatre-inline-prev-btn btn-magnetic" data-target-slide="0" style="margin-left: auto;">
                                                    <span>&larr; <?php esc_html_e( 'Back to Overview', 'designs-ng' ); ?></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </article>
                        </div>

                        <!-- RIGHT FLANKING DYNAMIC ZOOM WING -->
                        <aside class="theatre-side-wing theatre-wing-right" aria-hidden="true">
                            <div class="zoom-side-panel zoom-panel-right frame-dashed">
                                <span class="corner-crosshair tl">+</span>
                                <span class="corner-crosshair tr">+</span>
                                <span class="corner-crosshair bl">+</span>
                                <span class="corner-crosshair br">+</span>
                                <img src="<?php echo esc_url( $right_proj['img_url'] ); ?>" alt="" loading="lazy">
                                <span class="panel-tag"><?php echo esc_html( $right_proj['cat_name'] ); ?> // FIG. R</span>
                            </div>
                        </aside>

                        <!-- SATELLITE ARCHITECTURAL SCATTERED CONSTELLATION -->
                        <?php
                        $scatter_items = designs_ng_get_project_scatter_data( $proj['id'] );
                        echo designs_ng_render_scatter_field_html( $scatter_items, $proj['title'] );
                        ?>

                    </div>
                    <?php
                    $index++;
                endforeach;
            else :
                ?>
                <p style="text-align: center; color: var(--text-muted); padding: 80px 0;">
                    <?php esc_html_e( 'No portfolio projects found. Add projects from WordPress admin.', 'designs-ng' ); ?>
                </p>
                <?php
            endif;
            ?>

        </div>
    </section>

    <!-- 2. PORTFOLIO CURATION PHILOSOPHY (LAYERED COMPOSITION) -->
    <section class="about-section" style="padding-top: 60px; padding-bottom: 60px;">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'ARCHIVE // 02 CURATION CRITERIA', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">MONOGRAPH VOL. 2026 • SELECTED WORKS</span>
                </div>
            </div>

            <div class="about-grid">
                <div class="about-left-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Archive Curation', 'designs-ng' ); ?></span>
                    </div>
                    <h2 class="section-title gsap-reveal">
                        Every Commission.<br>A Market Benchmark.
                    </h2>
                    <p class="about-quote gsap-reveal">
                        “We don’t build ephemeral marketing collateral. Every identity system, digital platform, and spatial environment in this archive is designed to withstand temporal trends and generate compounded authority.”
                    </p>

                    <!-- Layered Editorial Image Composition with Dashed Framing & Corner Crosshairs -->
                    <div class="editorial-layer-composition gsap-reveal">
                        <div class="frame-dashed frame-accent editorial-layer-primary">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/portfolio-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Obsidian Museum & Architectural Works', 'designs-ng' ); ?>" class="editorial-img-main" loading="lazy">
                        </div>

                        <div class="frame-dashed editorial-layer-offset">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/project-cosgrove.webp' ); ?>" alt="<?php esc_attr_e( 'Cosgrove Smart City Architecture', 'designs-ng' ); ?>" class="editorial-img-sub" loading="lazy">
                            <div class="offset-caption" style="padding-top: 8px;">
                                <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;"><?php esc_html_e( 'FIG. 03 — CULTURAL ARCHIVE', 'designs-ng' ); ?></span>
                            </div>
                        </div>

                        <div class="editorial-layer-badge">
                            <span><?php esc_html_e( 'PERMANENT MONOGRAPH • 2026', 'designs-ng' ); ?></span>
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
                        <h4>Rigorous Selectivity</h4>
                        <p>We purposefully cap concurrent client engagements so that senior partners remain personally immersed in your project's design and code.</p>
                    </div>
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">02</span>
                        <h4>Category Differentiation</h4>
                        <p>We dissect legacy incumbents in your vertical to establish uncontested visual and digital territory that commands premium brand valuation.</p>
                    </div>
                    <div class="feature-box frame-dashed gsap-reveal-card">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">03</span>
                        <h4>Compounded Return</h4>
                        <p>High-craft execution pays recurring dividends: lower customer acquisition costs, higher investor confidence, and lasting cultural prestige.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INITIATE PROJECT BANNER -->
    <section class="big-cta-section" style="padding: 140px 0;">
        <div class="container">
            <div class="cta-inner frame-dashed frame-accent" style="padding: clamp(60px, 8vw, 100px) clamp(24px, 5vw, 64px);">
                <span class="corner-crosshair tl">+</span>
                <span class="corner-crosshair tr">+</span>
                <span class="corner-crosshair bl">+</span>
                <span class="corner-crosshair br">+</span>
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1); width: 100%;">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'ENGAGEMENT // 2026 INITIATION', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">CUSTOM COMMISSIONS • GLOBAL REACH</span>
                </div>
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Custom Commission', 'designs-ng' ); ?></span>
                </div>
                <h2 class="cta-title gsap-reveal">
                    Have A Brand That Deserves <span class="accent-green">Excellence</span>?
                </h2>
                <p class="cta-subtitle gsap-reveal">
                    We partner with select visionary founders and executives each quarter to create category-defining brand experiences.
                </p>
                <div class="gsap-reveal" style="margin-top: 24px;">
                    <a href="<?php echo esc_url( home_url( '/start-project/' ) ); ?>" class="btn btn-primary btn-magnetic btn-cta-large">
                        <span><?php esc_html_e( 'Start Your Project Brief', 'designs-ng' ); ?></span>
                        <?php echo designs_ng_get_svg( 'arrow-right' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CINEMATIC ARCHITECTURAL INSPECTION LIGHTBOX MODAL -->
    <dialog id="theatreLightboxModal" class="theatre-cinematic-lightbox" closedby="any" aria-label="<?php esc_attr_e( 'Architectural Visual Inspection Lightbox', 'designs-ng' ); ?>">
        <div class="cinematic-lightbox-wrapper">
            <!-- Top Control Bar -->
            <div class="cinematic-lightbox-header">
                <div class="cinematic-header-meta">
                    <span class="cinematic-project-tag" id="lightboxProjectTitle">PROJECT ARCHIVE</span>
                    <span class="cinematic-divider">//</span>
                    <span class="cinematic-figure-pill" id="lightboxFigureTag">FIG. S-01 // MATERIAL STUDY</span>
                </div>
                <div class="cinematic-header-actions">
                    <span class="cinematic-counter" id="lightboxCounter">01 / 04</span>
                    <button type="button" class="cinematic-close-btn" id="lightboxCloseBtn" aria-label="<?php esc_attr_e( 'Close Lightbox (Esc)', 'designs-ng' ); ?>">
                        <span class="close-label">CLOSE</span>
                        <span class="close-icon">&times;</span>
                    </button>
                </div>
            </div>

            <!-- Center Image Viewport -->
            <div class="cinematic-lightbox-viewport frame-dashed frame-accent">
                <span class="corner-crosshair tl">+</span>
                <span class="corner-crosshair tr">+</span>
                <span class="corner-crosshair bl">+</span>
                <span class="corner-crosshair br">+</span>
                <div class="cinematic-image-container">
                    <img id="lightboxMainImage" src="" alt="" class="cinematic-main-img">
                </div>
                
                <!-- Navigation Arrows -->
                <button type="button" class="cinematic-arrow-btn cinematic-btn-prev btn-magnetic" id="lightboxPrevBtn" aria-label="<?php esc_attr_e( 'Previous Image', 'designs-ng' ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <button type="button" class="cinematic-arrow-btn cinematic-btn-next btn-magnetic" id="lightboxNextBtn" aria-label="<?php esc_attr_e( 'Next Image', 'designs-ng' ); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>

            <!-- Bottom Caption Footer -->
            <div class="cinematic-lightbox-footer">
                <div class="cinematic-caption-wrap">
                    <span class="editorial-figure-label" style="margin-bottom: 4px;"><?php esc_html_e( 'TECHNICAL NOTE & OBSERVATION', 'designs-ng' ); ?></span>
                    <p id="lightboxCaptionText" class="cinematic-caption-text"></p>
                </div>
                <div class="cinematic-shortcut-hints">
                    <span class="shortcut-pill"><kbd>&larr;</kbd> <kbd>&rarr;</kbd> Navigate</span>
                    <span class="shortcut-pill"><kbd>ESC</kbd> Dismiss</span>
                </div>
            </div>
        </div>
    </dialog>

</main>

<?php
endif;

get_footer();
