<?php
/**
 * The header for our theme
 *
 * Fully integrates with Elementor Theme Builder with custom fallback.
 * Links to full dedicated pages: Home, Who We Are, Services, Portfolio, Contact, Start Your Project.
 *
 * @package designs-ng
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <?php
    // Elementor Theme Builder Header Hook
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) :
    ?>
    <!-- Adam Studio Editorial Top Masthead & Floating Bottom Menu Dock -->
    <?php
    $is_home = is_front_page() || is_home();
    $is_about = is_page( 'who-we-are' );
    $is_services = is_page( 'services' );
    $is_portfolio = is_page( 'portfolio' ) || is_singular( 'project' ) || is_post_type_archive( 'project' );
    $is_contact = is_page( 'contact' );
    $is_start = is_page( 'start-project' );
    ?>


    <!-- Signature Floating Bottom Menu Dock (MENU + | LOGO | CONTACT) -->
    <aside class="floating-bottom-dock" aria-label="<?php esc_attr_e( 'Floating Navigation Dock', 'designs-ng' ); ?>" style="position: fixed; bottom: 44px; left: 50%; transform: translateX(-50%); z-index: 9999;">
        <div class="dock-island" style="transform: none;">
            <!-- Left: MENU + button -->
            <button class="dock-btn-menu nav-menu-trigger" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'designs-ng' ); ?>" aria-expanded="false" aria-controls="fullscreen-menu-overlay">
                <span class="dock-menu-text"><?php esc_html_e( 'MENU', 'designs-ng' ); ?></span>
                <span class="dock-plus-icon trigger-icon-plus" aria-hidden="true">+</span>
            </button>

            <span class="dock-hairline-divider" aria-hidden="true"></span>

            <!-- Center: Clean Brand Logo in-between Menu and Contact -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="dock-logo" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="dock-logo-img" width="118" height="18">
            </a>

            <span class="dock-hairline-divider" aria-hidden="true"></span>

            <!-- Right: CONTACT button in softened green -->
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="dock-btn-contact btn-nav-contact <?php echo $is_contact ? 'active' : ''; ?>">
                <span><?php esc_html_e( 'CONTACT', 'designs-ng' ); ?></span>
            </a>
        </div>
    </aside>

    <!-- Full-Screen Soft Overlay Menu (Multi-Column Editorial Directory) -->
    <div id="fullscreen-menu-overlay" class="fullscreen-menu-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Main Navigation Overlay', 'designs-ng' ); ?>">
        <div class="overlay-backdrop"></div>
        
        <div class="overlay-container">
            <!-- Top bar indicator inside overlay -->
            <div class="overlay-top-bar">
                <div class="overlay-top-meta">
                    <span class="editorial-figure-label" style="margin-bottom: 0;"><?php esc_html_e( 'INDEX // 2026 EDITION', 'designs-ng' ); ?></span>
                    <span class="overlay-top-tagline"><?php esc_html_e( 'CREATIVE ARCHITECTURE & DIGITAL STUDIO', 'designs-ng' ); ?></span>
                </div>
                <button class="overlay-top-close-btn nav-menu-close" aria-label="<?php esc_attr_e( 'Close Menu', 'designs-ng' ); ?>">
                    <span class="close-txt"><?php esc_html_e( 'CLOSE', 'designs-ng' ); ?></span>
                    <span class="close-x" aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Multi-Column Editorial Navigation Grid -->
            <div class="fullscreen-menu-grid">
                <!-- Column 1: Primary Navigation Pages -->
                <div class="overlay-col overlay-col-primary">
                    <div class="overlay-col-header">
                        <span class="editorial-figure-label"><?php esc_html_e( 'DIRECTORY // 01 MAIN PAGES', 'designs-ng' ); ?></span>
                    </div>
                    <nav class="fullscreen-nav-primary" aria-label="<?php esc_attr_e( 'Primary Pages', 'designs-ng' ); ?>">
                        <ul class="fullscreen-menu-list">
                            <li class="menu-item-wrap">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="overlay-menu-link <?php echo $is_home ? 'active' : ''; ?>">
                                    <span class="link-index">01</span>
                                    <span class="link-text"><?php esc_html_e( 'Home', 'designs-ng' ); ?></span>
                                </a>
                            </li>
                            <li class="menu-item-wrap">
                                <a href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>" class="overlay-menu-link <?php echo $is_about ? 'active' : ''; ?>">
                                    <span class="link-index">02</span>
                                    <span class="link-text"><?php esc_html_e( 'Who We Are', 'designs-ng' ); ?></span>
                                </a>
                            </li>
                            <li class="menu-item-wrap">
                                <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="overlay-menu-link <?php echo $is_services ? 'active' : ''; ?>">
                                    <span class="link-index">03</span>
                                    <span class="link-text"><?php esc_html_e( 'Our Services', 'designs-ng' ); ?></span>
                                </a>
                            </li>
                            <li class="menu-item-wrap">
                                <a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>" class="overlay-menu-link <?php echo $is_portfolio ? 'active' : ''; ?>">
                                    <span class="link-index">04</span>
                                    <span class="link-text"><?php esc_html_e( 'Portfolio', 'designs-ng' ); ?></span>
                                </a>
                            </li>
                            <li class="menu-item-wrap">
                                <a href="<?php echo esc_url( home_url( '/start-project/' ) ); ?>" class="overlay-menu-link <?php echo $is_start ? 'active' : ''; ?>">
                                    <span class="link-index">05</span>
                                    <span class="link-text"><?php esc_html_e( 'Start Your Project', 'designs-ng' ); ?></span>
                                </a>
                            </li>
                            <li class="menu-item-wrap">
                                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="overlay-menu-link <?php echo $is_contact ? 'active' : ''; ?>">
                                    <span class="link-index">06</span>
                                    <span class="link-text"><?php esc_html_e( 'Contact', 'designs-ng' ); ?></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Column 2: Capabilities & Practice Areas List -->
                <div class="overlay-col overlay-col-capabilities">
                    <div class="overlay-col-header">
                        <span class="editorial-figure-label"><?php esc_html_e( 'PRACTICE // 02 CAPABILITIES', 'designs-ng' ); ?></span>
                    </div>
                    <ul class="overlay-sub-list">
                        <li>
                            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="overlay-sub-link">
                                <span class="sub-link-bullet">—</span>
                                <span class="sub-link-name"><?php esc_html_e( 'Branding & Visual Identity', 'designs-ng' ); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="overlay-sub-link">
                                <span class="sub-link-bullet">—</span>
                                <span class="sub-link-name"><?php esc_html_e( 'Website Development & WebGL', 'designs-ng' ); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="overlay-sub-link">
                                <span class="sub-link-bullet">—</span>
                                <span class="sub-link-name"><?php esc_html_e( 'UI/UX Digital Product Design', 'designs-ng' ); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="overlay-sub-link">
                                <span class="sub-link-bullet">—</span>
                                <span class="sub-link-name"><?php esc_html_e( 'Mobile App Engineering', 'designs-ng' ); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="overlay-sub-link">
                                <span class="sub-link-bullet">—</span>
                                <span class="sub-link-name"><?php esc_html_e( 'Architecture & Spatial Design', 'designs-ng' ); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="overlay-sub-link">
                                <span class="sub-link-bullet">—</span>
                                <span class="sub-link-name"><?php esc_html_e( 'Bespoke Luxury Souvenirs', 'designs-ng' ); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="overlay-sub-link">
                                <span class="sub-link-bullet">—</span>
                                <span class="sub-link-name"><?php esc_html_e( 'Cinematic Media & Production', 'designs-ng' ); ?></span>
                            </a>
                        </li>
                    </ul>

                    <div class="overlay-commission-box frame-dashed" style="margin-top: 32px; padding: 20px;">
                        <span class="corner-crosshair tl">+</span>
                        <span class="corner-crosshair tr">+</span>
                        <span class="corner-crosshair bl">+</span>
                        <span class="corner-crosshair br">+</span>
                        <span class="editorial-figure-label" style="font-size: 10px;"><?php esc_html_e( 'PROJECT INITIATION', 'designs-ng' ); ?></span>
                        <p style="color: var(--text-secondary); font-size: 13px; line-height: 1.6; margin: 8px 0 14px 0;">
                            <?php esc_html_e( 'Have a specific scope or RFP? Request our tailored strategic roadmap.', 'designs-ng' ); ?>
                        </p>
                        <a href="<?php echo esc_url( home_url( '/start-project/' ) ); ?>" class="overlay-mini-cta">
                            <span><?php esc_html_e( 'Start Your Project Brief', 'designs-ng' ); ?> &rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Column 3: Studio Dossier & Inquiries -->
                <div class="overlay-col overlay-col-dossier">
                    <div class="overlay-col-header">
                        <span class="editorial-figure-label"><?php esc_html_e( 'DOSSIER // 03 STUDIO INQUIRIES', 'designs-ng' ); ?></span>
                    </div>
                    <div class="overlay-dossier-content">
                        <div class="dossier-block">
                            <span class="dossier-label"><?php esc_html_e( 'Studio Headquarters', 'designs-ng' ); ?></span>
                            <p class="dossier-value">Abuja, Nigeria</p>
                            <span class="editorial-coord-tag" style="display: block; margin-top: 4px;">[ 06°31'N / 03°23'E ]</span>
                        </div>

                        <div class="dossier-block">
                            <span class="dossier-label"><?php esc_html_e( 'Direct Inquiries', 'designs-ng' ); ?></span>
                            <p class="dossier-value"><a href="mailto:contact@designs.ng">contact@designs.ng</a></p>
                        </div>

                        <div class="dossier-block">
                            <span class="dossier-label"><?php esc_html_e( 'Studio Status', 'designs-ng' ); ?></span>
                            <p class="dossier-value" style="color: var(--accent-green);">
                                <?php esc_html_e( 'Available For Q3/Q4 2026 Commissions', 'designs-ng' ); ?>
                            </p>
                        </div>

                        <div class="dossier-block">
                            <span class="dossier-label"><?php esc_html_e( 'Social & Channels', 'designs-ng' ); ?></span>
                            <div class="overlay-social-row">
                                <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="overlay-social-link">Instagram</a>
                                <span class="social-dot">•</span>
                                <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="overlay-social-link">LinkedIn</a>
                                <span class="social-dot">•</span>
                                <a href="https://behance.net" target="_blank" rel="noopener noreferrer" class="overlay-social-link">Behance</a>
                                <span class="social-dot">•</span>
                                <a href="https://x.com" target="_blank" rel="noopener noreferrer" class="overlay-social-link">X / Twitter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom bar: CLOSE + × | Logo/icon | CONTACT button -->
            <div class="overlay-bottom-bar">
                <div class="overlay-bottom-left">
                    <button class="nav-menu-close nav-menu-close-bottom" aria-label="<?php esc_attr_e( 'Close Navigation Menu', 'designs-ng' ); ?>">
                        <span class="close-label"><?php esc_html_e( 'CLOSE', 'designs-ng' ); ?></span>
                        <span class="close-icon-cross" aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="overlay-bottom-center">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="overlay-bottom-logo" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo-img" width="160" height="24">
                    </a>
                </div>

                <div class="overlay-bottom-right">
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-nav-contact">
                        <span><?php esc_html_e( 'CONTACT', 'designs-ng' ); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div id="content" class="site-content">
