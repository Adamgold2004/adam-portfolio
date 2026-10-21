<?php
/**
 * Elementor Custom Widget, Customizer Settings & Shortcode for Brand Marquee
 *
 * Enables clients to upload brand logo images and enter custom text labels
 * both within Elementor and via the WordPress Customizer / Theme Settings.
 *
 * @package designs-ng
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get default marquee items
 *
 * @return array
 */
function designs_ng_get_default_marquee_items() {
    return array(
        array(
            'item_type' => 'text',
            'text'      => 'Midwest Dental',
            'image_url' => '',
            'link_url'  => '',
        ),
        array(
            'item_type' => 'text',
            'text'      => 'Peculiar Real Estate',
            'image_url' => '',
            'link_url'  => '',
        ),
        array(
            'item_type' => 'text',
            'text'      => 'Cosgrove Smart City',
            'image_url' => '',
            'link_url'  => '',
        ),
        array(
            'item_type' => 'text',
            'text'      => 'MacKenny Tutors UK',
            'image_url' => '',
            'link_url'  => '',
        ),
        array(
            'item_type' => 'text',
            'text'      => 'Zenith Pay',
            'image_url' => '',
            'link_url'  => '',
        ),
        array(
            'item_type' => 'text',
            'text'      => 'Vantage Horizon',
            'image_url' => '',
            'link_url'  => '',
        ),
    );
}

/**
 * Parse marquee items from customizer / theme options textarea
 *
 * Supports format per line:
 * Brand Name
 * OR: https://example.com/logo.png | Brand Name
 * OR: https://example.com/logo.png | Brand Name | https://link.com
 *
 * @param string $raw_text
 * @return array
 */
function designs_ng_parse_marquee_text( $raw_text ) {
    if ( empty( $raw_text ) ) {
        return array();
    }

    $lines = preg_split( '/\r\n|\r|\n/', trim( $raw_text ) );
    $items = array();

    foreach ( $lines as $line ) {
        $line = trim( $line );
        if ( empty( $line ) ) {
            continue;
        }

        $parts = array_map( 'trim', explode( '|', $line ) );
        $count = count( $parts );

        if ( $count === 1 ) {
            // Check if it's an image URL or pure text
            if ( preg_match( '/\.(png|jpe?g|svg|webp|gif)$/i', $parts[0] ) || filter_var( $parts[0], FILTER_VALIDATE_URL ) ) {
                $items[] = array(
                    'item_type' => 'image',
                    'text'      => '',
                    'image_url' => esc_url_raw( $parts[0] ),
                    'link_url'  => '',
                );
            } else {
                $items[] = array(
                    'item_type' => 'text',
                    'text'      => sanitize_text_field( $parts[0] ),
                    'image_url' => '',
                    'link_url'  => '',
                );
            }
        } elseif ( $count === 2 ) {
            // Part 0 is Image, Part 1 is Text (or vice versa)
            if ( filter_var( $parts[0], FILTER_VALIDATE_URL ) || preg_match( '/\.(png|jpe?g|svg|webp|gif)$/i', $parts[0] ) ) {
                $items[] = array(
                    'item_type' => 'combo',
                    'text'      => sanitize_text_field( $parts[1] ),
                    'image_url' => esc_url_raw( $parts[0] ),
                    'link_url'  => '',
                );
            } else {
                $items[] = array(
                    'item_type' => 'combo',
                    'text'      => sanitize_text_field( $parts[0] ),
                    'image_url' => esc_url_raw( $parts[1] ),
                    'link_url'  => '',
                );
            }
        } elseif ( $count >= 3 ) {
            // Part 0 is Image, Part 1 is Text, Part 2 is Link URL
            $items[] = array(
                'item_type' => 'combo',
                'text'      => sanitize_text_field( $parts[1] ),
                'image_url' => esc_url_raw( $parts[0] ),
                'link_url'  => esc_url_raw( $parts[2] ),
            );
        }
    }

    return $items;
}

/**
 * Render Brand Marquee HTML
 *
 * @param array $items Optional custom items array.
 * @param array $args  Optional visual configuration arguments.
 * @return string HTML output
 */
function designs_ng_render_marquee( $items = array(), $args = array() ) {
    $defaults = array(
        'speed'          => 35,
        'direction'      => 'left', // 'left' or 'right'
        'pause_on_hover' => true,
        'bullet'         => '•',
        'extra_classes'  => '',
        'logo_height'    => '',
    );
    $args = wp_parse_args( $args, $defaults );

    // If no custom items passed, look up Customizer / Theme Option
    if ( empty( $items ) ) {
        $customizer_raw = get_theme_mod( 'designs_marquee_items', '' );
        if ( ! empty( $customizer_raw ) ) {
            $items = designs_ng_parse_marquee_text( $customizer_raw );
        }
    }

    // Fallback to defaults if still empty
    if ( empty( $items ) ) {
        $items = designs_ng_get_default_marquee_items();
    }

    // Customizer speed override if not passed in args
    if ( empty( $args['speed'] ) || $args['speed'] === 35 ) {
        $customizer_speed = (int) get_theme_mod( 'designs_marquee_speed', 35 );
        if ( $customizer_speed > 0 ) {
            $args['speed'] = $customizer_speed;
        }
    }

    // Customizer pause on hover
    if ( get_theme_mod( 'designs_marquee_pause', true ) === false ) {
        $args['pause_on_hover'] = false;
    }

    $inner_classes = array( 'marquee-inner' );
    if ( $args['pause_on_hover'] ) {
        $inner_classes[] = 'pause-on-hover';
    }
    if ( $args['direction'] === 'right' ) {
        $inner_classes[] = 'marquee-direction-right';
    }

    $style_attr = '';
    if ( ! empty( $args['speed'] ) ) {
        $style_attr .= 'animation-duration: ' . (int) $args['speed'] . 's; ';
    }
    if ( ! empty( $args['logo_height'] ) ) {
        $style_attr .= '--marquee-logo-h: ' . esc_attr( $args['logo_height'] ) . '; ';
    }

    // Duplicate list 2 times to ensure seamless infinite translation
    $duplicated_list = array_merge( $items, $items );

    ob_start();
    ?>
    <div class="brand-marquee-section <?php echo esc_attr( $args['extra_classes'] ); ?>" aria-label="<?php esc_attr_e( 'Client & Partner Marquee', 'designs-ng' ); ?>">
        <div class="<?php echo esc_attr( implode( ' ', $inner_classes ) ); ?>" style="<?php echo esc_attr( $style_attr ); ?>">
            <?php foreach ( $duplicated_list as $idx => $item ) :
                $type      = isset( $item['item_type'] ) ? $item['item_type'] : 'text';
                $text      = isset( $item['text'] ) ? $item['text'] : '';
                $image_url = isset( $item['image_url'] ) ? $item['image_url'] : '';
                $link_url  = isset( $item['link_url'] ) ? $item['link_url'] : '';

                // If elementor image object passed
                if ( is_array( $image_url ) && ! empty( $image_url['url'] ) ) {
                    $image_url = $image_url['url'];
                }
                ?>
                <div class="marquee-item <?php echo esc_attr( 'item-type-' . $type ); ?>" data-index="<?php echo esc_attr( $idx ); ?>">
                    <?php if ( ! empty( $link_url ) ) : ?>
                        <a href="<?php echo esc_url( $link_url ); ?>" class="marquee-link" target="_blank" rel="noopener noreferrer">
                    <?php endif; ?>

                    <?php if ( ( $type === 'image' || $type === 'combo' ) && ! empty( $image_url ) ) : ?>
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $text ? $text : 'Brand Partner Logo' ); ?>" class="marquee-logo-img" loading="lazy">
                    <?php endif; ?>

                    <?php if ( ( $type === 'text' || $type === 'combo' || empty( $image_url ) ) && ! empty( $text ) ) : ?>
                        <span class="marquee-text"><?php echo esc_html( $text ); ?></span>
                    <?php endif; ?>

                    <?php if ( ! empty( $link_url ) ) : ?>
                        </a>
                    <?php endif; ?>

                    <span class="bullet" aria-hidden="true"><?php echo esc_html( $args['bullet'] ); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Register WordPress Customizer Options for Marquee
 *
 * Allows non-Elementor admins to upload logos and add custom texts easily.
 *
 * @param WP_Customize_Manager $wp_customize
 */
function designs_ng_customize_marquee_register( $wp_customize ) {
    $wp_customize->add_section(
        'designs_marquee_section',
        array(
            'title'       => __( 'Brand Marquee (Homepage)', 'designs-ng' ),
            'priority'    => 35,
            'description' => __( 'Configure the infinite ticker marquee displayed on the homepage. You can input custom brand texts, logo image URLs, or both.', 'designs-ng' ),
        )
    );

    // Marquee Items
    $wp_customize->add_setting(
        'designs_marquee_items',
        array(
            'default'           => "Midwest Dental\nPeculiar Real Estate\nCosgrove Smart City\nMacKenny Tutors UK\nZenith Pay\nVantage Horizon",
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'designs_marquee_items',
        array(
            'label'       => __( 'Marquee Items (One per line)', 'designs-ng' ),
            'section'     => 'designs_marquee_section',
            'type'        => 'textarea',
            'description' => __( 'Formats per line:<br>1. <code>Brand Name</code> (Text only)<br>2. <code>https://image-url.png | Brand Name</code> (Image + Text)<br>3. <code>https://image-url.png | Brand Name | https://link.com</code> (Image + Text + Clickable Link)', 'designs-ng' ),
        )
    );

    // Speed setting
    $wp_customize->add_setting(
        'designs_marquee_speed',
        array(
            'default'           => 35,
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        'designs_marquee_speed',
        array(
            'label'       => __( 'Scroll Speed (Seconds)', 'designs-ng' ),
            'section'     => 'designs_marquee_section',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 10,
                'max'  => 120,
                'step' => 5,
            ),
        )
    );

    // Pause on Hover
    $wp_customize->add_setting(
        'designs_marquee_pause',
        array(
            'default'           => true,
            'sanitize_callback' => 'wp_validate_boolean',
        )
    );

    $wp_customize->add_control(
        'designs_marquee_pause',
        array(
            'label'   => __( 'Pause Scrolling on Mouse Hover', 'designs-ng' ),
            'section' => 'designs_marquee_section',
            'type'    => 'checkbox',
        )
    );
}
add_action( 'customize_register', 'designs_ng_customize_marquee_register' );

/**
 * Register Shortcode [designs_brand_marquee]
 *
 * @param array $atts
 * @return string
 */
function designs_ng_brand_marquee_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'speed'     => 35,
            'direction' => 'left',
            'pause'     => 'yes',
        ),
        $atts,
        'designs_brand_marquee'
    );

    $args = array(
        'speed'          => (int) $atts['speed'],
        'direction'      => $atts['direction'] === 'right' ? 'right' : 'left',
        'pause_on_hover' => $atts['pause'] === 'yes',
    );

    return designs_ng_render_marquee( array(), $args );
}
add_shortcode( 'designs_brand_marquee', 'designs_ng_brand_marquee_shortcode' );

/**
 * Register Elementor Widget: Designs_Marquee_Widget
 *
 * Hooked to 'elementor/widgets/register'
 */
function designs_ng_register_elementor_marquee_widget_handler( $widgets_manager ) {
    if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
        return;
    }

    class Designs_Marquee_Widget extends \Elementor\Widget_Base {

        public function get_name() {
            return 'designs_marquee_widget';
        }

        public function get_title() {
            return esc_html__( 'Designs Brand Marquee', 'designs-ng' );
        }

        public function get_icon() {
            return 'eicon-slider-push';
        }

        public function get_categories() {
            return array( 'designs-ng-elements', 'general' );
        }

        public function get_keywords() {
            return array( 'marquee', 'ticker', 'brands', 'clients', 'logos', 'carousel', 'scroll' );
        }

        protected function register_controls() {
            // CONTENT SECTION: MARQUEE ITEMS REPEATER
            $this->start_controls_section(
                'content_section',
                array(
                    'label' => esc_html__( 'Marquee Items & Logos', 'designs-ng' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                )
            );

            $repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'item_type',
                array(
                    'label'   => esc_html__( 'Item Type', 'designs-ng' ),
                    'type'    => \Elementor\Controls_Manager::SELECT,
                    'default' => 'combo',
                    'options' => array(
                        'combo' => esc_html__( 'Logo Image + Text', 'designs-ng' ),
                        'image' => esc_html__( 'Logo Image Only', 'designs-ng' ),
                        'text'  => esc_html__( 'Text Label Only', 'designs-ng' ),
                    ),
                )
            );

            $repeater->add_control(
                'text',
                array(
                    'label'       => esc_html__( 'Brand / Client Name', 'designs-ng' ),
                    'type'        => \Elementor\Controls_Manager::TEXT,
                    'default'     => esc_html__( 'Brand Partner', 'designs-ng' ),
                    'label_block' => true,
                )
            );

            $repeater->add_control(
                'image',
                array(
                    'label'   => esc_html__( 'Logo Image', 'designs-ng' ),
                    'type'    => \Elementor\Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => '',
                    ),
                    'condition' => array(
                        'item_type' => array( 'combo', 'image' ),
                    ),
                )
            );

            $repeater->add_control(
                'link',
                array(
                    'label'       => esc_html__( 'Optional URL / Link', 'designs-ng' ),
                    'type'        => \Elementor\Controls_Manager::URL,
                    'placeholder' => esc_html__( 'https://client-domain.com', 'designs-ng' ),
                    'show_external' => true,
                    'default'     => array(
                        'url'         => '',
                        'is_external' => true,
                    ),
                )
            );

            $this->add_control(
                'marquee_items',
                array(
                    'label'       => esc_html__( 'Client / Brand Entries', 'designs-ng' ),
                    'type'        => \Elementor\Controls_Manager::REPEATER,
                    'fields'      => $repeater->get_controls(),
                    'default'     => array(
                        array(
                            'item_type' => 'text',
                            'text'      => 'Midwest Dental',
                        ),
                        array(
                            'item_type' => 'text',
                            'text'      => 'Peculiar Real Estate',
                        ),
                        array(
                            'item_type' => 'text',
                            'text'      => 'Cosgrove Smart City',
                        ),
                        array(
                            'item_type' => 'text',
                            'text'      => 'MacKenny Tutors UK',
                        ),
                        array(
                            'item_type' => 'text',
                            'text'      => 'Zenith Pay',
                        ),
                        array(
                            'item_type' => 'text',
                            'text'      => 'Vantage Horizon',
                        ),
                    ),
                    'title_field' => '{{{ text }}}',
                )
            );

            $this->add_control(
                'speed',
                array(
                    'label'   => esc_html__( 'Scroll Duration (Seconds)', 'designs-ng' ),
                    'type'    => \Elementor\Controls_Manager::NUMBER,
                    'min'     => 10,
                    'max'     => 120,
                    'step'    => 1,
                    'default' => 35,
                )
            );

            $this->add_control(
                'direction',
                array(
                    'label'   => esc_html__( 'Scroll Direction', 'designs-ng' ),
                    'type'    => \Elementor\Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => array(
                        'left'  => esc_html__( 'Right to Left (Standard)', 'designs-ng' ),
                        'right' => esc_html__( 'Left to Right (Reverse)', 'designs-ng' ),
                    ),
                )
            );

            $this->add_control(
                'pause_on_hover',
                array(
                    'label'        => esc_html__( 'Pause on Mouse Hover', 'designs-ng' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Yes', 'designs-ng' ),
                    'label_off'    => esc_html__( 'No', 'designs-ng' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                )
            );

            $this->add_control(
                'separator_symbol',
                array(
                    'label'   => esc_html__( 'Separator Symbol', 'designs-ng' ),
                    'type'    => \Elementor\Controls_Manager::TEXT,
                    'default' => '•',
                )
            );

            $this->end_controls_section();

            // STYLE SECTION
            $this->start_controls_section(
                'style_section',
                array(
                    'label' => esc_html__( 'Styling & Appearance', 'designs-ng' ),
                    'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                )
            );

            $this->add_control(
                'logo_height',
                array(
                    'label'      => esc_html__( 'Logo Max Height (px)', 'designs-ng' ),
                    'type'       => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => array( 'px' ),
                    'range'      => array(
                        'px' => array(
                            'min'  => 16,
                            'max'  => 80,
                            'step' => 2,
                        ),
                    ),
                    'default'    => array(
                        'unit' => 'px',
                        'size' => 32,
                    ),
                    'selectors'  => array(
                        '{{WRAPPER}} .marquee-logo-img' => 'height: {{SIZE}}{{UNIT}}; max-height: {{SIZE}}{{UNIT}};',
                    ),
                )
            );

            $this->add_control(
                'item_gap',
                array(
                    'label'      => esc_html__( 'Gap Between Items', 'designs-ng' ),
                    'type'       => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => array( 'px' ),
                    'range'      => array(
                        'px' => array(
                            'min'  => 20,
                            'max'  => 140,
                            'step' => 5,
                        ),
                    ),
                    'default'    => array(
                        'unit' => 'px',
                        'size' => 70,
                    ),
                    'selectors'  => array(
                        '{{WRAPPER}} .marquee-inner' => 'gap: {{SIZE}}{{UNIT}};',
                    ),
                )
            );

            $this->add_control(
                'text_color',
                array(
                    'label'     => esc_html__( 'Text Color', 'designs-ng' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => 'rgba(255, 255, 255, 0.35)',
                    'selectors' => array(
                        '{{WRAPPER}} .marquee-item' => 'color: {{VALUE}};',
                    ),
                )
            );

            $this->add_control(
                'bullet_color',
                array(
                    'label'     => esc_html__( 'Bullet / Separator Color', 'designs-ng' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => 'rgba(255, 255, 255, 0.18)',
                    'selectors' => array(
                        '{{WRAPPER}} .marquee-item span.bullet' => 'color: {{VALUE}};',
                    ),
                )
            );

            $this->add_control(
                'accent_hover_color',
                array(
                    'label'     => esc_html__( 'Hover Accent Color', 'designs-ng' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'default'   => '#00B84A',
                    'selectors' => array(
                        '{{WRAPPER}} .marquee-item:hover, {{WRAPPER}} .marquee-link:hover' => 'color: {{VALUE}} !important;',
                    ),
                )
            );

            $this->end_controls_section();
        }

        protected function render() {
            $settings = $this->get_settings_for_display();

            $items = array();
            if ( ! empty( $settings['marquee_items'] ) && is_array( $settings['marquee_items'] ) ) {
                foreach ( $settings['marquee_items'] as $raw_item ) {
                    $item_type = ! empty( $raw_item['item_type'] ) ? $raw_item['item_type'] : 'combo';
                    $text      = ! empty( $raw_item['text'] ) ? $raw_item['text'] : '';
                    $image_url = ! empty( $raw_item['image']['url'] ) ? $raw_item['image']['url'] : '';
                    $link_url  = ! empty( $raw_item['link']['url'] ) ? $raw_item['link']['url'] : '';

                    $items[] = array(
                        'item_type' => $item_type,
                        'text'      => $text,
                        'image_url' => $image_url,
                        'link_url'  => $link_url,
                    );
                }
            }

            $args = array(
                'speed'          => ! empty( $settings['speed'] ) ? (int) $settings['speed'] : 35,
                'direction'      => ! empty( $settings['direction'] ) ? $settings['direction'] : 'left',
                'pause_on_hover' => ( $settings['pause_on_hover'] === 'yes' ),
                'bullet'         => ! empty( $settings['separator_symbol'] ) ? $settings['separator_symbol'] : '•',
                'extra_classes'  => 'elementor-marquee-render',
            );

            echo designs_ng_render_marquee( $items, $args );
        }
    }

    $widgets_manager->register( new \Designs_Marquee_Widget() );
}
add_action( 'elementor/widgets/register', 'designs_ng_register_elementor_marquee_widget_handler' );
