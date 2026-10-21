<?php
/**
 * Adam Studio Theme functions and definitions
 *
 * @package designs-ng
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( '_S_VERSION' ) ) {
    define( '_S_VERSION', '3.0.2' );
}

// Remove WordPress Admin Bar from frontend to ensure 100% clean custom layout
add_filter( 'show_admin_bar', '__return_false' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function designs_ng_setup() {
    load_theme_textdomain( 'designs-ng', get_template_directory() . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    add_image_size( 'designs-project-card', 840, 620, true );
    add_image_size( 'designs-project-hero', 1920, 1080, true );
    add_image_size( 'designs-team-card', 600, 750, true );

    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary Menu', 'designs-ng' ),
            'footer'  => esc_html__( 'Footer Menu', 'designs-ng' ),
        )
    );

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Register Elementor & Theme Builder Support
    add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'designs_ng_setup' );

/**
 * Elementor Theme Builder Locations Registration
 */
function designs_ng_register_elementor_locations( $elementor_theme_manager ) {
    $elementor_theme_manager->register_location( 'header' );
    $elementor_theme_manager->register_location( 'footer' );
    $elementor_theme_manager->register_location( 'single' );
    $elementor_theme_manager->register_location( 'archive' );
}
add_action( 'elementor/theme/register_locations', 'designs_ng_register_elementor_locations' );

/**
 * Set content width
 */
function designs_ng_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'designs_ng_content_width', 1360 );
}
add_action( 'after_setup_theme', 'designs_ng_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function designs_ng_scripts() {
    // Google Fonts: Poppins (300, 400, 500, 600, 700)
    wp_enqueue_style( 'designs-ng-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap', array(), null );

    // Main stylesheet
    wp_enqueue_style( 'designs-ng-style', get_stylesheet_uri(), array( 'designs-ng-fonts' ), _S_VERSION );

    // GSAP Core, ScrollTrigger, and Observer from Cloudflare CDN
    wp_enqueue_script( 'gsap-core', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true );
    wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array( 'gsap-core' ), '3.12.5', true );
    wp_enqueue_script( 'gsap-observer', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/Observer.min.js', array( 'gsap-core' ), '3.12.5', true );

    // Custom GSAP Animations & Interactions
    wp_enqueue_script( 'designs-ng-animations', get_template_directory_uri() . '/assets/js/animations.js', array( 'gsap-core', 'gsap-scrolltrigger', 'gsap-observer' ), _S_VERSION, true );

    // Soft scroll (Lenis) + mouse motion layer
    wp_enqueue_script( 'lenis', 'https://cdn.jsdelivr.net/npm/lenis@1.1.13/dist/lenis.min.js', array(), '1.1.13', true );
    wp_enqueue_script( 'designs-ng-motion', get_template_directory_uri() . '/assets/js/motion.js', array( 'gsap-core', 'gsap-scrolltrigger', 'lenis', 'designs-ng-animations' ), _S_VERSION, true );

    wp_localize_script( 'designs-ng-animations', 'designsNgData', array(
        'ajax_url'   => admin_url( 'admin-ajax.php' ),
        'site_url'   => home_url( '/' ),
        'lead_nonce' => wp_create_nonce( 'designs_lead_nonce_action' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'designs_ng_scripts' );

/**
 * Helper: Render SVG Icons with softened premium accent
 */
function designs_ng_get_svg( $name ) {
    $icons = array(
        'arrow-right' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
        'arrow-up-right' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>',
        'sparkles' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/></svg>',
        'code' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"></polyline><polyline points="8 6 2 12 8 18"></polyline></svg>',
        'layout' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>',
        'palette' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"></circle><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"></circle><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"></circle><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"></circle><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.563-2.512 5.563-5.563C22 6.5 17.5 2 12 2Z"></path></svg>',
        'smartphone' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>',
        'building' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect><path d="M9 22v-4h6v4"></path><path d="M8 6h.01"></path><path d="M16 6h.01"></path><path d="M8 10h.01"></path><path d="M16 10h.01"></path><path d="M8 14h.01"></path><path d="M16 14h.01"></path></svg>',
        'video' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>',
        'gift' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>',
        'check-circle' => '<svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#00B84A" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>',
        'star' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="#00B84A" stroke="#00B84A" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>',
        'mail' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>',
        'map-pin' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>'
    );
    return isset( $icons[ $name ] ) ? $icons[ $name ] : $icons['sparkles'];
}

/**
 * Helper: Retrieve professional architectural / creative image for projects
 */
function designs_ng_get_project_image_url( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    if ( has_post_thumbnail( $post_id ) ) {
        return get_the_post_thumbnail_url( $post_id, 'large' );
    }
    $slug = get_post_field( 'post_name', $post_id );
    $map = array(
        'midwest'  => 'project-midwest.webp',
        'peculiar' => 'project-peculiar.webp',
        'cosgrove' => 'project-cosgrove.webp',
        'mackenny' => 'project-mackenny.webp',
        'zenith'   => 'project-zenith.webp',
        'vantage'  => 'project-vantage.webp',
    );
    foreach ( $map as $prefix => $filename ) {
        if ( strpos( $slug, $prefix ) !== false ) {
            return get_template_directory_uri() . '/assets/images/' . $filename;
        }
    }
    return get_template_directory_uri() . '/assets/images/hero-slide-1.jpg';
}

/**
 * Helper: Retrieve professional portrait for team members
 */
function designs_ng_get_team_image_url( $post_id = null ) {
    if ( ! $post_id ) {
        $post_id = get_the_ID();
    }
    if ( has_post_thumbnail( $post_id ) ) {
        return get_the_post_thumbnail_url( $post_id, 'designs-team-card' );
    }
    $slug = get_post_field( 'post_name', $post_id );
    $map = array(
        'femi'     => 'team-1.webp',
        'chiamaka' => 'team-2.webp',
        'tariq'    => 'team-3.webp',
        'korede'   => 'team-4.webp',
    );
    foreach ( $map as $prefix => $filename ) {
        if ( strpos( $slug, $prefix ) !== false ) {
            return get_template_directory_uri() . '/assets/images/' . $filename;
        }
    }
    return get_template_directory_uri() . '/assets/images/team-1.webp';
}

require get_template_directory() . '/inc/cpt.php';
require get_template_directory() . '/inc/elementor-scatter-widget.php';
require get_template_directory() . '/inc/elementor-marquee-widget.php';
require get_template_directory() . '/inc/form-handler.php';
require get_template_directory() . '/inc/seed-data.php';
