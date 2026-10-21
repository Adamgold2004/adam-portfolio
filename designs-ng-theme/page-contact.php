<?php
/**
 * Template Name: Contact Us
 *
 * Dedicated contact page for Adam Studio featuring direct communication channels,
 * WhatsApp integration, studio location, and proposal form.
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

<main id="primary" class="site-main page-contact-view">

    <!-- HERO SECTION (SPLIT 6x2 EDITORIAL HERO WITH PARALLAX & CLIP-PATH) -->
    <section class="page-hero page-hero-split">
        <div class="container">
            <div class="page-hero-split-grid">
                <!-- Left 6-Col: Editorial Typography & Context -->
                <div class="page-hero-text-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Connect With Us', 'designs-ng' ); ?></span>
                    </div>
                    <h1 class="page-hero-split-title gsap-reveal">
                        Let’s Build Something <span class="accent-green">Exceptional</span>.
                    </h1>
                    <p class="page-hero-split-desc gsap-reveal">
                        Have an ambitious brand challenge or new venture? Reach out directly to our team in Abuja, Nigeria or schedule a global video briefing.
                    </p>
                    <div class="page-hero-meta-chips gsap-reveal">
                        <span class="editorial-coord-tag">ABUJA HQ • LAT. 06°31'N / LON. 03°23'E</span>
                        <span class="meta-chip-divider">•</span>
                        <span class="meta-chip-text"><?php esc_html_e( 'GLOBAL BRIEFINGS OPEN', 'designs-ng' ); ?></span>
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
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/contact-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Adam Studio Executive Reception Atelier', 'designs-ng' ); ?>" class="hero-half-img gsap-hero-half-img" width="1200" height="800">
                            <div class="hero-half-vignette"></div>
                            
                            <div class="hero-half-badge-float">
                                <span class="badge-dot"></span>
                                <span class="badge-text"><?php esc_html_e( 'DIRECT LIAISON ATELIER', 'designs-ng' ); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT GRID -->
    <section class="contact-section">
        <div class="container">
            <div class="about-editorial-header">
                <div class="editorial-meta-row" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; padding-bottom: 16px; border-bottom: 1px dashed rgba(255, 255, 255, 0.1);">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'DISCIPLINE // 06 DIRECT ENGAGEMENT', 'designs-ng' ); ?></span>
                    <span class="editorial-coord-tag">ABUJA HQ • LAT. 06°31'N / LON. 03°23'E • GLOBAL REACH</span>
                </div>
            </div>

            <div class="contact-grid">
                <div class="contact-left-col">
                    <div class="section-tag gsap-reveal">
                        <span><?php esc_html_e( 'Direct Channels', 'designs-ng' ); ?></span>
                    </div>
                    <h2 class="section-title gsap-reveal" style="font-size: 38px; line-height: 1.2;">
                        Always Open For Visionary Partnerships.
                    </h2>
                    <p class="gsap-reveal" style="color: var(--text-secondary); font-size: 16px; margin-bottom: 40px; line-height: 1.8;">
                        We limit the number of active clients we take on concurrently to guarantee uncompromising creative excellence and senior partner attention on every deliverable.
                    </p>

                    <div class="contact-info-list" style="display: flex; flex-direction: column; gap: 20px;">
                        <!-- Email -->
                        <div class="contact-info-item frame-dashed gsap-reveal" style="padding: 24px;">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="contact-info-icon">
                                <?php echo designs_ng_get_svg( 'mail' ); ?>
                            </div>
                            <div class="contact-info-text">
                                <h4>General & New Business</h4>
                                <p><a href="mailto:contact@designs.ng" style="color: var(--text-primary); font-weight: 500;">contact@designs.ng</a></p>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="contact-info-item frame-dashed gsap-reveal" style="padding: 24px;">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="contact-info-icon">
                                <?php echo designs_ng_get_svg( 'map-pin' ); ?>
                            </div>
                            <div class="contact-info-text">
                                <h4>Studio Headquarters</h4>
                                <p>Abuja, Federal Capital Territory, Nigeria</p>
                            </div>
                        </div>

                        <!-- WhatsApp / Fast Chat -->
                        <div class="contact-info-item frame-dashed gsap-reveal" style="padding: 24px;">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <div class="contact-info-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                                </svg>
                            </div>
                            <div class="contact-info-text">
                                <h4>WhatsApp & Direct Line</h4>
                                <p><a href="https://wa.me/2348000000000" target="_blank" rel="noopener noreferrer" style="color: var(--accent-green); font-weight: 600;">Chat on WhatsApp &rarr;</a></p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Channels -->
                    <div style="margin-top: 40px;" class="gsap-reveal">
                        <span class="editorial-figure-label" style="display: block; font-size: 11px; margin-bottom: 16px;">STUDIO SOCIAL CHANNELS</span>
                        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
                            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="frame-dashed" style="padding: 10px 22px; font-size: 13px; color: var(--text-secondary); text-decoration: none;">LinkedIn</a>
                            <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="frame-dashed" style="padding: 10px 22px; font-size: 13px; color: var(--text-secondary); text-decoration: none;">Twitter / X</a>
                            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="frame-dashed" style="padding: 10px 22px; font-size: 13px; color: var(--text-secondary); text-decoration: none;">Instagram</a>
                            <a href="https://behance.net" target="_blank" rel="noopener noreferrer" class="frame-dashed" style="padding: 10px 22px; font-size: 13px; color: var(--text-secondary); text-decoration: none;">Behance</a>
                        </div>
                    </div>

                    <!-- Layered Editorial Atelier Visual Placement -->
                    <div class="editorial-layer-composition gsap-reveal" style="margin-top: 36px;">
                        <div class="frame-dashed frame-accent editorial-layer-primary">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/contact-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Adam Studio Executive Atelier', 'designs-ng' ); ?>" class="editorial-img-main" loading="lazy">
                        </div>

                        <div class="frame-dashed editorial-layer-offset">
                            <span class="corner-crosshair tl">+</span>
                            <span class="corner-crosshair tr">+</span>
                            <span class="corner-crosshair bl">+</span>
                            <span class="corner-crosshair br">+</span>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/about-hero.jpg' ); ?>" alt="<?php esc_attr_e( 'Abuja Architecture Studio', 'designs-ng' ); ?>" class="editorial-img-sub" loading="lazy">
                            <div class="offset-caption" style="padding-top: 8px;">
                                <span class="editorial-figure-label" style="font-size: 10px; margin-bottom: 0;"><?php esc_html_e( 'FIG. 05 — ABUJA ATELIER', 'designs-ng' ); ?></span>
                            </div>
                        </div>

                        <div class="editorial-layer-badge">
                            <span><?php esc_html_e( 'STUDIO DOORS OPEN • BY APPOINTMENT', 'designs-ng' ); ?></span>
                        </div>
                    </div>
                </div>

                <div class="contact-form-card frame-dashed gsap-reveal-card">
                    <span class="corner-crosshair tl">+</span>
                    <span class="corner-crosshair tr">+</span>
                    <span class="corner-crosshair bl">+</span>
                    <span class="corner-crosshair br">+</span>
                    <h3 style="font-size: 26px; color: #FFFFFF; margin-bottom: 10px;">Send A Message</h3>
                    <p style="color: var(--text-secondary); font-size: 14px; margin-bottom: 30px;">Direct communication goes straight to our lead partner inbox.</p>

                    <form class="designs-ajax-form" data-form-source="Contact Page Message" method="post">
                        <?php wp_nonce_field( 'designs_lead_nonce_action', 'lead_nonce' ); ?>
                        <input type="text" name="website_hp" style="display:none !important;" tabindex="-1" autocomplete="off">
                        <div class="form-feedback-area" role="status" aria-live="polite"></div>
                        <div class="form-group">
                            <label for="cm_name"><?php esc_html_e( 'Your Name', 'designs-ng' ); ?></label>
                            <input type="text" id="cm_name" name="lead_name" class="form-control" placeholder="e.g. Sarah Connor" required>
                        </div>
                        <div class="form-group">
                            <label for="cm_email"><?php esc_html_e( 'Email Address', 'designs-ng' ); ?></label>
                            <input type="email" id="cm_email" name="lead_email" class="form-control" placeholder="sarah@company.com" required>
                        </div>
                        <div class="form-group">
                            <label for="cm_subject"><?php esc_html_e( 'Subject / Project Type', 'designs-ng' ); ?></label>
                            <input type="text" id="cm_subject" name="lead_subject" class="form-control" placeholder="e.g. Brand Refresh & Website" required>
                        </div>
                        <div class="form-group">
                            <label for="cm_message"><?php esc_html_e( 'How can we help you?', 'designs-ng' ); ?></label>
                            <textarea id="cm_message" name="lead_message" class="form-control" placeholder="Write your message here..." style="min-height: 140px;" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-magnetic form-submit-btn" style="width: 100%;">
                            <span class="btn-text"><?php esc_html_e( 'Send Message', 'designs-ng' ); ?></span>
                            <?php echo designs_ng_get_svg( 'arrow-right' ); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
endif;

get_footer();
