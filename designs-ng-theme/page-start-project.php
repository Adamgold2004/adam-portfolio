<?php
/**
 * Template Name: Start Your Project
 *
 * Dedicated project initiation and proposal request page for Adam Studio.
 * Features process steps, interactive project planner form, and trust indicators.
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

<main id="primary" class="site-main page-start-project">

    <!-- HERO SECTION (SPLIT 6x2 EDITORIAL HERO WITH PARALLAX & CLIP-PATH) -->
    <section class="page-hero page-hero-split">
        <div class="container">
            <div class="page-hero-split-grid">
                <!-- Left 6-Col: Editorial Typography & Context -->
                <div class="page-hero-text-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Commission Adam Studio', 'designs-ng' ); ?></span>
                    </div>
                    <h1 class="page-hero-split-title gsap-reveal">
                        Start Your <span class="accent-green">Project</span>.
                    </h1>
                    <p class="page-hero-split-desc gsap-reveal">
                        Tell us about your brand vision and business milestones. Our creative partners will review your requirements and provide a tailored strategic roadmap within 24 hours.
                    </p>
                    <div class="page-hero-meta-chips gsap-reveal">
                        <span class="editorial-coord-tag">[ INTAKE // 2026.Q4 ]</span>
                        <span class="meta-chip-divider">•</span>
                        <span class="meta-chip-text"><?php esc_html_e( 'ESTIMATED RESPONSE: 24 HRS', 'designs-ng' ); ?></span>
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
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/start-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Adam Studio Project Commission Atelier', 'designs-ng' ); ?>" class="hero-half-img gsap-hero-half-img" width="1200" height="800">
                            <div class="hero-half-vignette"></div>
                            
                            <div class="hero-half-badge-float">
                                <span class="badge-dot"></span>
                                <span class="badge-text"><?php esc_html_e( 'PROJECT INTAKE ATELIER • READY TO SCALE', 'designs-ng' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROCESS STEPS & SPRINT MODEL (LAYERED EDITORIAL COMPOSITION) -->
    <section class="about-section">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'COMMISSION // 01 PROCESS ROADMAP', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">4-PHASE AGILE SPRINT FRAMEWORK</span>
                </div>
            </div>

            <div class="about-grid">
                <!-- Left Column: Editorial Manifesto & Layered Image Placement -->
                <div class="about-left-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Direct Partnership', 'designs-ng' ); ?></span>
                    </div>
                    <h2 class="section-title gsap-reveal">
                        Direct Partnership.<br>Zero Intermediaries.
                    </h2>
                    <p class="about-quote gsap-reveal">
                        “When you commission Adam Studio, you collaborate directly with senior design directors and systems architects. No account managers, no diluted creative translation.”
                    </p>

                    <!-- Layered Editorial Image Composition with Dashed Framing & Corner Crosshairs -->
                    <div class="editorial-layer-composition gsap-reveal">
                        <div class="frame-dashed frame-accent editorial-layer-primary">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/start-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Commission Atelier Planning', 'designs-ng' ); ?>" class="editorial-img-main" loading="lazy">
                        </div>

                        <div class="frame-dashed editorial-layer-offset">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-slide-2.jpg' ); ?>" alt="<?php esc_attr_e( 'Brand Standards & Blueprints', 'designs-ng' ); ?>" class="editorial-img-sub" loading="lazy">
                            <div class="offset-caption" style="padding-top: 8px;">
                                <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;"><?php esc_html_e( 'FIG. 04 — COMMISSION SPEC', 'designs-ng' ); ?></span>
                            </div>
                        </div>

                        <div class="editorial-layer-badge">
                            <span><?php esc_html_e( '24-HOUR STRATEGIC ROADMAP', 'designs-ng' ); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: 4 Agile Execution Steps -->
                <div class="about-features">
                    <div class="feature-box frame-dashed gsap-reveal-card" style="padding: 28px 24px;">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">Step 01</span>
                        <h4 style="font-size: 18px;">Proposal Review</h4>
                        <p style="font-size: 14px;">We analyze your goals, scope, and competitive context within 24 business hours.</p>
                    </div>

                    <div class="feature-box frame-dashed gsap-reveal-card" style="padding: 28px 24px;">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">Step 02</span>
                        <h4 style="font-size: 18px;">Strategic Discovery</h4>
                        <p style="font-size: 14px;">A focused 45-minute consultation to define deliverables, architecture, and milestones.</p>
                    </div>

                    <div class="feature-box frame-dashed gsap-reveal-card" style="padding: 28px 24px;">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">Step 03</span>
                        <h4 style="font-size: 18px;">Sprint Execution</h4>
                        <p style="font-size: 14px;">Our creative team begins iterative design and engineering sprints with bi-weekly updates.</p>
                    </div>

                    <div class="feature-box frame-dashed gsap-reveal-card" style="padding: 28px 24px;">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="feature-num">Step 04</span>
                        <h4 style="font-size: 18px;">Global Handover</h4>
                        <p style="font-size: 14px;">Flawless launch, documentation, and training so your team can manage content effortlessly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INTERACTIVE PROJECT PLANNER FORM -->
    <section class="contact-section">
        <div class="container" style="max-width: 980px;">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'SPECIFICATION // 02 PROJECT BRIEF', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">DIRECT PARTNER REVIEW • 24H RESPONSE</span>
                </div>
            </div>

            <div class="contact-form-card frame-dashed gsap-reveal-card">
                <span class="corner-crosshair tl">+</span>
                <span class="corner-crosshair tr">+</span>
                <span class="corner-crosshair bl">+</span>
                <span class="corner-crosshair br">+</span>
                <div style="margin-bottom: 36px; text-align: center;">
                    <h2 style="font-size: 32px; margin-bottom: 12px; color: #FFFFFF;">Project Inquiry Brief</h2>
                    <p style="color: var(--text-secondary); font-size: 15px;">Complete the details below to receive a personalized proposal and timeline.</p>
                </div>

                <form class="designs-ajax-form" data-form-source="Start Project Brief Builder" method="post">
                    <?php wp_nonce_field( 'designs_lead_nonce_action', 'lead_nonce' ); ?>
                    <input type="text" name="website_hp" style="display:none !important;" tabindex="-1" autocomplete="off">
                    <div class="form-feedback-area" role="status" aria-live="polite"></div>

                    <div class="form-row-dual">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="p_name"><?php esc_html_e( 'Full Name', 'designs-ng' ); ?></label>
                            <input type="text" id="p_name" name="lead_name" class="form-control" placeholder="e.g. John Doe" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="p_email"><?php esc_html_e( 'Email Address', 'designs-ng' ); ?></label>
                            <input type="email" id="p_email" name="lead_email" class="form-control" placeholder="john@company.com" required>
                        </div>
                    </div>

                    <div class="form-row-dual">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="p_company"><?php esc_html_e( 'Company / Brand Name', 'designs-ng' ); ?></label>
                            <input type="text" id="p_company" name="lead_company" class="form-control" placeholder="e.g. Acme Global Ltd" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="p_phone"><?php esc_html_e( 'Phone or WhatsApp (Optional)', 'designs-ng' ); ?></label>
                            <input type="tel" id="p_phone" name="lead_phone" class="form-control" placeholder="+234 ... or +1 ...">
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?php esc_html_e( 'Services Required (Select all that apply)', 'designs-ng' ); ?></label>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 8px;">
                            <?php
                            $services_list = array( 'Branding & Identity', 'Website Development', 'UI/UX Design', 'App Development', 'Architecture & Interior', 'Bespoke Souvenirs', 'Media & Motion', 'Project Management' );
                            foreach ( $services_list as $srv ) :
                                ?>
                                <label style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 18px; background: #141414; border: 1px solid var(--border-subtle); border-radius: var(--radius-pill); font-size: 13px; color: var(--text-secondary); cursor: pointer;">
                                    <input type="checkbox" name="services[]" value="<?php echo esc_attr( $srv ); ?>">
                                    <?php echo esc_html( $srv ); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-row-dual">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="p_timeline"><?php esc_html_e( 'Expected Timeline', 'designs-ng' ); ?></label>
                            <select id="p_timeline" name="lead_timeline" class="form-control">
                                <option value="urgent">Urgent (2 - 4 Weeks)</option>
                                <option value="standard" selected>Standard (1 - 2 Months)</option>
                                <option value="quarter">Strategic (Quarterly Initiative)</option>
                                <option value="flexible">Flexible</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label for="p_budget"><?php esc_html_e( 'Estimated Budget', 'designs-ng' ); ?></label>
                            <select id="p_budget" name="lead_budget" class="form-control">
                                <option value="$3,000 - $10,000 / ₦5M - ₦15M">$3,000 - $10,000 / ₦5M - ₦15M</option>
                                <option value="$10,000 - $25,000 / ₦15M - ₦35M">$10,000 - $25,000 / ₦15M - ₦35M</option>
                                <option value="$25,000+ / ₦35M+">$25,000+ / ₦35M+</option>
                                <option value="To be determined">To be determined</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="p_details"><?php esc_html_e( 'Project Overview & Objectives', 'designs-ng' ); ?></label>
                        <textarea id="p_details" name="lead_message" class="form-control" placeholder="Describe what you want to build, challenges you are facing, or reference links..." style="min-height: 160px;" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-magnetic form-submit-btn">
                        <span class="btn-text"><?php esc_html_e( 'Submit Project Inquiry', 'designs-ng' ); ?></span>
                        <?php echo designs_ng_get_svg( 'arrow-right' ); ?>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- TRUST ELEMENTS / TESTIMONIALS SNIPPET -->
    <section class="testimonials-section" style="padding-top: 100px; padding-bottom: 140px;">
        <div class="container">
            <div class="section-header-centered" style="margin-bottom: 60px;">
                <div class="section-tag gsap-reveal">
                    <span><?php esc_html_e( 'Client Trust', 'designs-ng' ); ?></span>
                </div>
                <h2 class="section-title gsap-reveal"><?php esc_html_e( 'Why Founders Choose Adam Studio', 'designs-ng' ); ?></h2>
            </div>

            <div class="testimonials-grid" style="grid-template-columns: repeat(2, 1fr); max-width: 960px; margin: 0 auto;">
                <div class="testimonial-card gsap-testimonial-card">
                    <div class="testimonial-stars">
                        <?php for ( $i = 0; $i < 5; $i++ ) echo designs_ng_get_svg( 'star' ); ?>
                    </div>
                    <p class="testimonial-quote">
                        “Adam Studio delivered an editorial masterpiece that closed luxury penthouse acquisitions. They operate with relentless precision.”
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar-badge">P</div>
                        <div>
                            <div class="author-name">Peculiar Properties</div>
                            <div class="author-location">Abuja, Nigeria</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card gsap-testimonial-card">
                    <div class="testimonial-stars">
                        <?php for ( $i = 0; $i < 5; $i++ ) echo designs_ng_get_svg( 'star' ); ?>
                    </div>
                    <p class="testimonial-quote">
                        “The attention to typography, micro-interactions, and motion blew our investors away. Truly an international standard agency.”
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar-badge">O</div>
                        <div>
                            <div class="author-name">Olayemi</div>
                            <div class="author-location">United Kingdom</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
endif;

get_footer();
