<?php
/**
 * Elementor Custom Widget & Shortcode for Architectural Scattered Portfolio Gallery
 *
 * Provides:
 * 1. Elementor Widget: Designs_Portfolio_Scatter_Widget
 * 2. Shortcode: [designs_scatter_gallery]
 * 3. Helper function: designs_ng_get_project_scatter_data()
 *
 * @package designs-ng
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Retrieve curated or custom scatter data for any project
 *
 * @param int $project_id
 * @return array Array of items: [ ['url' => ..., 'caption' => ..., 'fig' => ...] ]
 */
function designs_ng_get_project_scatter_data( $project_id = 0 ) {
    if ( ! $project_id ) {
        $project_id = get_the_ID();
    }

    $meta_images   = get_post_meta( $project_id, '_project_scatter_images', true );
    $meta_captions = get_post_meta( $project_id, '_project_scatter_captions', true );

    $custom_urls = array();
    if ( ! empty( $meta_images ) ) {
        $raw_lines = preg_split( '/\r\n|\r|\n|,/', $meta_images );
        foreach ( $raw_lines as $line ) {
            $line = trim( $line );
            if ( ! empty( $line ) ) {
                if ( is_numeric( $line ) ) {
                    $attachment_url = wp_get_attachment_image_url( (int) $line, 'large' );
                    if ( $attachment_url ) {
                        $custom_urls[] = $attachment_url;
                    }
                } else {
                    $custom_urls[] = esc_url_raw( $line );
                }
            }
        }
    }

    $custom_captions = array();
    if ( ! empty( $meta_captions ) ) {
        $cap_lines = preg_split( '/\r\n|\r|\n/', $meta_captions );
        foreach ( $cap_lines as $cline ) {
            $cline = trim( $cline );
            if ( ! empty( $cline ) ) {
                $custom_captions[] = $cline;
            }
        }
    }

    // Default curated architectural map if custom meta is empty
    $slug = strtolower( get_post_field( 'post_name', $project_id ) );
    $title = strtolower( get_the_title( $project_id ) );
    $base_uri = get_template_directory_uri() . '/assets/images/';

    $curated_presets = array(
        'vantage' => array(
            array(
                'url'     => $base_uri . 'hero-slide-3.jpg',
                'caption' => 'Acoustic Basalt Geometry & Spatial Light Mapping',
                'fig'     => 'FIG. S-01 // ACOUSTIC MAPPING'
            ),
            array(
                'url'     => $base_uri . 'services-hero.jpg',
                'caption' => 'Nigerian Raw Basalt & African Teak Material Studies',
                'fig'     => 'FIG. S-02 // MATERIAL STUDY'
            ),
            array(
                'url'     => $base_uri . 'hero-slide-1.jpg',
                'caption' => 'Biophilic Climate Envelope Engineering Blueprint',
                'fig'     => 'FIG. S-03 // BLUEPRINT'
            ),
            array(
                'url'     => $base_uri . 'project-cosgrove.webp',
                'caption' => 'Bespoke Finished Architectural Millwork Joinery',
                'fig'     => 'FIG. S-04 // MILLWORK DETAIL'
            ),
        ),
        'zenith' => array(
            array(
                'url'     => $base_uri . 'hero-slide-1.jpg',
                'caption' => 'Haptic Fluid Micro-Interaction Architecture',
                'fig'     => 'FIG. S-01 // UI INTERFACE'
            ),
            array(
                'url'     => $base_uri . 'project-zenith.webp',
                'caption' => 'Cross-Border Real-Time Settlement Architecture',
                'fig'     => 'FIG. S-02 // SETTLEMENT PIPELINE'
            ),
            array(
                'url'     => $base_uri . 'portfolio-hero.jpg',
                'caption' => 'ISO 27001 Multi-Ledger Encryption Topography',
                'fig'     => 'FIG. S-03 // SECURITY LEDGER'
            ),
            array(
                'url'     => $base_uri . 'services-hero.jpg',
                'caption' => 'Sub-Second Global FX Execution Benchmark',
                'fig'     => 'FIG. S-04 // SPEED BENCHMARK'
            ),
        ),
        'midwest' => array(
            array(
                'url'     => $base_uri . 'project-midwest.webp',
                'caption' => 'Clinical Identity System & Typography Matrix',
                'fig'     => 'FIG. S-01 // IDENTITY MATRIX'
            ),
            array(
                'url'     => $base_uri . 'hero-slide-2.jpg',
                'caption' => 'Patient Self-Scheduling Portal & Tablet Interface',
                'fig'     => 'FIG. S-02 // PATIENT PORTAL'
            ),
            array(
                'url'     => $base_uri . 'about-hero.jpg',
                'caption' => 'Modern Healthcare Interior & Environmental Graphics',
                'fig'     => 'FIG. S-03 // SPATIAL GRAPHICS'
            ),
            array(
                'url'     => $base_uri . 'start-hero.jpg',
                'caption' => 'Collateral Print Stationery & Embossed Crests',
                'fig'     => 'FIG. S-04 // EMBOSSED CREST'
            ),
        ),
        'peculiar' => array(
            array(
                'url'     => $base_uri . 'project-peculiar.webp',
                'caption' => 'Abuja Luxury Penthouse Interactive Viewing Dossier',
                'fig'     => 'FIG. S-01 // PENTHOUSE DOSSIER'
            ),
            array(
                'url'     => $base_uri . 'hero-slide-3.jpg',
                'caption' => 'Architectural Skyline & Golden Hour Perspective',
                'fig'     => 'FIG. S-02 // PERSPECTIVE'
            ),
            array(
                'url'     => $base_uri . 'contact-hero.jpg',
                'caption' => 'Private VIP Investor Lounge Environment Design',
                'fig'     => 'FIG. S-03 // INVESTOR LOUNGE'
            ),
            array(
                'url'     => $base_uri . 'services-hero.jpg',
                'caption' => 'Foil-Stamped Real Estate Acquisition Brochure',
                'fig'     => 'FIG. S-04 // EDITORIAL PROOF'
            ),
        ),
        'cosgrove' => array(
            array(
                'url'     => $base_uri . 'project-cosgrove.webp',
                'caption' => 'Matte-Black VIP Unboxing Presentation Suite',
                'fig'     => 'FIG. S-01 // VIP UNBOXING'
            ),
            array(
                'url'     => $base_uri . 'hero-slide-2.jpg',
                'caption' => 'Custom Anodized Keycard & Digital Smart Access Artifact',
                'fig'     => 'FIG. S-02 // DIGITAL SMART KEY'
            ),
            array(
                'url'     => $base_uri . 'portfolio-hero.jpg',
                'caption' => 'Engraved Solid Brass Architectural Crest & Monograph',
                'fig'     => 'FIG. S-03 // BRASS CREST'
            ),
            array(
                'url'     => $base_uri . 'start-hero.jpg',
                'caption' => 'Custom Scented Ambient Diffuser & Luxury Packaging',
                'fig'     => 'FIG. S-04 // LUXURY PACKAGING'
            ),
        ),
        'mackenny' => array(
            array(
                'url'     => $base_uri . 'project-mackenny.webp',
                'caption' => 'Global British Curriculum Interactive Dashboard',
                'fig'     => 'FIG. S-01 // CURRICULUM PORTAL'
            ),
            array(
                'url'     => $base_uri . 'hero-slide-1.jpg',
                'caption' => 'Low-Latency Multi-Continent Virtual Classroom',
                'fig'     => 'FIG. S-02 // WEBRTC CLASSROOM'
            ),
            array(
                'url'     => $base_uri . 'about-hero.jpg',
                'caption' => 'Parent Progress Telemetry & Real-Time Grading UI',
                'fig'     => 'FIG. S-03 // PROGRESS TELEMETRY'
            ),
            array(
                'url'     => $base_uri . 'services-hero.jpg',
                'caption' => 'Tutor Matching Algorithm & Booking Engine',
                'fig'     => 'FIG. S-04 // BOOKING ENGINE'
            ),
        ),
    );

    // Pick curated fallback based on slug or title
    $preset_key = 'vantage';
    foreach ( array_keys( $curated_presets ) as $pk ) {
        if ( strpos( $slug, $pk ) !== false || strpos( $title, $pk ) !== false ) {
            $preset_key = $pk;
            break;
        }
    }
    $fallback_items = $curated_presets[$preset_key];

    // Build final collection
    $final_items = array();
    $positions = array( 'tl', 'tr', 'bl', 'br' );
    $total_slots = 4;

    for ( $i = 0; $i < $total_slots; $i++ ) {
        $pos = $positions[$i];
        $default_item = $fallback_items[$i % count( $fallback_items )];

        $url = ! empty( $custom_urls[$i] ) ? $custom_urls[$i] : $default_item['url'];
        $fig = ! empty( $default_item['fig'] ) ? $default_item['fig'] : 'FIG. S-0' . ( $i + 1 );
        
        $caption = '';
        if ( ! empty( $custom_captions[$i] ) ) {
            $caption = $custom_captions[$i];
        } else {
            $caption = $default_item['caption'];
        }

        $final_items[] = array(
            'pos'     => $pos,
            'url'     => $url,
            'caption' => $caption,
            'fig'     => $fig,
            'index'   => $i,
        );
    }

    return $final_items;
}

/**
 * Render the complete scattered field markup
 *
 * @param array  $items Array from designs_ng_get_project_scatter_data()
 * @param string $project_title
 * @param string $extra_class
 * @return string HTML
 */
function designs_ng_render_scatter_field_html( $items, $project_title = 'Adam Studio Project', $extra_class = '' ) {
    if ( empty( $items ) ) {
        return '';
    }

    ob_start();
    ?>
    <div class="theatre-scatter-field <?php echo esc_attr( $extra_class ); ?>" aria-label="<?php echo esc_attr( $project_title . ' Architectural Moodboard' ); ?>">
        <?php foreach ( $items as $idx => $item ) : ?>
            <div class="theatre-scatter-item scatter-pos-<?php echo esc_attr( $item['pos'] ); ?> frame-dashed"
                 data-lightbox-src="<?php echo esc_url( $item['url'] ); ?>"
                 data-lightbox-caption="<?php echo esc_attr( $item['caption'] ); ?>"
                 data-lightbox-fig="<?php echo esc_attr( $item['fig'] ); ?>"
                 data-project-title="<?php echo esc_attr( $project_title ); ?>"
                 data-scatter-index="<?php echo esc_attr( $idx ); ?>"
                 tabindex="0"
                 role="button"
                 aria-label="<?php echo esc_attr( $item['fig'] . ': ' . $item['caption'] . ' (Click to inspect fullscreen)' ); ?>">
                
                <!-- Corner Crosshairs -->
                <span class="corner-crosshair tl">+</span>
                <span class="corner-crosshair tr">+</span>
                <span class="corner-crosshair bl">+</span>
                <span class="corner-crosshair br">+</span>

                <!-- Image container with lazy loading -->
                <div class="scatter-img-wrap">
                    <img src="<?php echo esc_url( $item['url'] ); ?>" alt="<?php echo esc_attr( $item['caption'] ); ?>" loading="lazy">
                </div>

                <!-- Figure Tag Pill -->
                <div class="scatter-fig-badge">
                    <span class="scatter-badge-dot"></span>
                    <span><?php echo esc_html( $item['fig'] ); ?></span>
                </div>

                <!-- Hover Inspection Preview Card -->
                <div class="scatter-hover-card">
                    <div class="scatter-hover-top">
                        <span class="scatter-hover-fig"><?php echo esc_html( $item['fig'] ); ?></span>
                        <span class="scatter-hover-zoom-icon">⤢</span>
                    </div>
                    <p class="scatter-hover-caption"><?php echo esc_html( $item['caption'] ); ?></p>
                    <div class="scatter-hover-prompt">
                        <span><?php esc_html_e( 'Click to Inspect Fullscreen', 'designs-ng' ); ?></span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Shortcode: [designs_scatter_gallery]
 *
 * Usage:
 * [designs_scatter_gallery project_id="123"]
 * [designs_scatter_gallery images="url1,url2,url3,url4" captions="cap1|cap2|cap3|cap4"]
 */
function designs_ng_scatter_gallery_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'project_id' => 0,
        'images'     => '',
        'captions'   => '',
        'title'      => '',
        'class'      => '',
    ), $atts, 'designs_scatter_gallery' );

    $project_id = (int) $atts['project_id'];
    $title = ! empty( $atts['title'] ) ? $atts['title'] : ( $project_id ? get_the_title( $project_id ) : 'Architectural Portfolio Works' );

    if ( ! empty( $atts['images'] ) ) {
        // Custom shortcode passed images
        $urls = array_map( 'trim', explode( ',', $atts['images'] ) );
        $caps = ! empty( $atts['captions'] ) ? array_map( 'trim', explode( '|', $atts['captions'] ) ) : array();
        $positions = array( 'tl', 'tr', 'bl', 'br' );
        $items = array();

        foreach ( $urls as $i => $u ) {
            if ( $i >= 4 ) break;
            $items[] = array(
                'pos'     => $positions[$i % 4],
                'url'     => esc_url_raw( $u ),
                'caption' => ! empty( $caps[$i] ) ? $caps[$i] : 'Architectural Detail ' . ( $i + 1 ),
                'fig'     => 'FIG. S-0' . ( $i + 1 ) . ' // DETAIL',
                'index'   => $i
            );
        }
    } else {
        $items = designs_ng_get_project_scatter_data( $project_id );
    }

    return designs_ng_render_scatter_field_html( $items, $title, $atts['class'] );
}
add_shortcode( 'designs_scatter_gallery', 'designs_ng_scatter_gallery_shortcode' );

/**
 * Register Elementor Custom Widget: Designs_Portfolio_Scatter_Widget
 */
function designs_ng_register_elementor_scatter_widget_handler( $widgets_manager ) {
    if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
        return;
    }

    class Designs_Portfolio_Scatter_Widget extends \Elementor\Widget_Base {

        public function get_name() {
            return 'designs_portfolio_scatter';
        }

        public function get_title() {
            return esc_html__( 'Adam Studio Scattered Portfolio Gallery', 'designs-ng' );
        }

        public function get_icon() {
            return 'eicon-gallery-grid';
        }

        public function get_categories() {
            return array( 'general' );
        }

        public function get_keywords() {
            return array( 'portfolio', 'scatter', 'gallery', 'lightbox', 'modal', 'architectural', 'interactive', 'designs-ng' );
        }

        protected function register_controls() {
            // Content Section
            $this->start_controls_section(
                'content_section',
                array(
                    'label' => esc_html__( 'Scattered Gallery Source', 'designs-ng' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                )
            );

            // Fetch list of published projects for dropdown
            $projects = get_posts( array(
                'post_type'      => 'project',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            ) );
            $project_options = array( '0' => esc_html__( '— Current Project / Default —', 'designs-ng' ) );
            if ( ! empty( $projects ) ) {
                foreach ( $projects as $p ) {
                    $project_options[ $p->ID ] = $p->post_title;
                }
            }

            $this->add_control(
                'project_id',
                array(
                    'label'       => esc_html__( 'Select Project', 'designs-ng' ),
                    'type'        => \Elementor\Controls_Manager::SELECT,
                    'options'     => $project_options,
                    'default'     => '0',
                    'description' => esc_html__( 'Pull satellite scattered images and captions directly from this Project post.', 'designs-ng' ),
                )
            );

            $this->add_control(
                'custom_override',
                array(
                    'label'        => esc_html__( 'Custom Image Gallery Override', 'designs-ng' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'designs-ng' ),
                    'label_off'    => esc_html__( 'No', 'designs-ng' ),
                    'return_value' => 'yes',
                    'default'      => 'no',
                )
            );

            $this->add_control(
                'custom_gallery',
                array(
                    'label'       => esc_html__( 'Upload Gallery Images (Up to 4)', 'designs-ng' ),
                    'type'        => \Elementor\Controls_Manager::GALLERY,
                    'condition'   => array(
                        'custom_override' => 'yes',
                    ),
                    'description' => esc_html__( 'Select up to 4 images to form the architectural scattered constellation.', 'designs-ng' ),
                )
            );

            $this->add_control(
                'custom_title',
                array(
                    'label'       => esc_html__( 'Gallery / Project Title', 'designs-ng' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( 'Architectural Visual Studies', 'designs-ng' ),
                    'placeholder' => esc_html__( 'e.g. Midwest Dental Clinic', 'designs-ng' ),
                )
            );

            $this->end_controls_section();

            // Style Section
            $this->start_controls_section(
                'style_section',
                array(
                    'label' => esc_html__( 'Architectural Aesthetic', 'designs-ng' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                )
            );

            $this->add_control(
                'accent_color',
                array(
                    'label'     => esc_html__( 'Corner Crosshair & Glow Color', 'designs-ng' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => '#00B84A',
                    'selectors' => array(
                        '{{WRAPPER}} .theatre-scatter-item .corner-crosshair' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .theatre-scatter-item:hover' => 'box-shadow: 0 16px 36px {{VALUE}}33; border-color: {{VALUE}};',
                        '{{WRAPPER}} .scatter-badge-dot' => 'background-color: {{VALUE}};',
                    ),
                )
            );

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();
            $project_id = (int) $settings['project_id'];
            $title = ! empty( $settings['custom_title'] ) ? $settings['custom_title'] : 'Architectural Portfolio Works';

            if ( $settings['custom_override'] === 'yes' && ! empty( $settings['custom_gallery'] ) ) {
                $positions = array( 'tl', 'tr', 'bl', 'br' );
                $items = array();
                $idx = 0;
                foreach ( $settings['custom_gallery'] as $img_obj ) {
                    if ( $idx >= 4 ) break;
                    $url = ! empty( $img_obj['url'] ) ? $img_obj['url'] : '';
                    if ( $url ) {
                        $items[] = array(
                            'pos'     => $positions[$idx % 4],
                            'url'     => $url,
                            'caption' => esc_html__( 'Custom Visual Artifact', 'designs-ng' ) . ' ' . ( $idx + 1 ),
                            'fig'     => 'FIG. S-0' . ( $idx + 1 ) . ' // ELEMENTOR',
                            'index'   => $idx
                        );
                        $idx++;
                    }
                }
            } else {
                $items = designs_ng_get_project_scatter_data( $project_id );
                if ( $project_id ) {
                    $title = get_the_title( $project_id );
                }
            }

            echo designs_ng_render_scatter_field_html( $items, $title, 'elementor-scatter-widget-wrap' );
        }
    }

    $widgets_manager->register( new \Designs_Portfolio_Scatter_Widget() );
}
add_action( 'elementor/widgets/register', 'designs_ng_register_elementor_scatter_widget_handler' );
