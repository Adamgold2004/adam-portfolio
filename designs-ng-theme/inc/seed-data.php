<?php
/**
 * Initial Content Seeding & Dedicated Pages Setup for Adam Studio
 *
 * Populates initial projects, services, team members, categories, and dedicated pages:
 * 1. Home (front-page.php)
 * 2. Who We Are (page-about.php)
 * 3. Our Services (page-services.php)
 * 4. Portfolio (page-portfolio.php)
 * 5. Start Your Project (page-start-project.php)
 * 6. Contact (page-contact.php)
 *
 * @package designs-ng
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function designs_ng_seed_initial_content() {
    if ( get_option( 'designs_ng_initial_seeded_v3' ) ) {
        return;
    }

    // 1. Seed Categories
    $categories = array(
        'Branding'                      => 'Brand identity, logos, style guides, and positioning.',
        'Website Development'           => 'Modern, responsive, high-performance web engineering.',
        'UI/UX Design'                  => 'Intuitive digital product interfaces and user experiences.',
        'Graphics Design'               => 'Creative marketing collateral, posters, and visual communication.',
        'App Development'               => 'Robust mobile and web application engineering.',
        'Architecture & Interior Design'=> 'Physical spatial aesthetics, commercial and residential design.',
        'Media Services'                => 'Cinematic videography, brand photography, and storytelling.',
        'Souvenirs'                     => 'High-end bespoke corporate souvenirs and branded merchandise.',
        'Project Management'            => 'Agile execution and creative production delivery.'
    );

    $cat_ids = array();
    foreach ( $categories as $name => $desc ) {
        $term = term_exists( $name, 'project_category' );
        if ( ! $term ) {
            $created = wp_insert_term( $name, 'project_category', array( 'description' => $desc ) );
            if ( ! is_wp_error( $created ) ) {
                $cat_ids[ $name ] = $created['term_id'];
            }
        } else {
            $cat_ids[ $name ] = is_array( $term ) ? $term['term_id'] : $term;
        }
    }

    // 2. Seed Initial Projects
    $projects = array(
        array(
            'title'       => 'Midwest – Dental Clinic',
            'client'      => 'Midwest Healthcare Group',
            'year'        => '2025',
            'category'    => 'Branding',
            'categories'  => array( 'Branding', 'Website Development' ),
            'short_desc'  => 'Comprehensive brand identity transformation & immersive digital patient portal.',
            'featured'    => '1',
            'content'     => 'Midwest Dental Clinic required an international-grade digital presence and refreshed brand identity that communicated clinical excellence, empathy, and serene confidence. We developed a unified visual identity system paired with a lightning-fast responsive website featuring patient self-scheduling, interactive dental wellness guides, and custom 3D tooth anatomy visuals.'
        ),
        array(
            'title'       => 'Peculiar – Luxury Realtor',
            'client'      => 'Peculiar Properties Ltd',
            'year'        => '2025',
            'category'    => 'Website Development',
            'categories'  => array( 'Branding', 'Website Development', 'UI/UX Design' ),
            'short_desc'  => 'High-end luxury real estate branding and interactive property showcase platform in Abuja.',
            'featured'    => '1',
            'content'     => 'Peculiar is Abuja\'s premier luxury real estate brokerage. Our team crafted a dark, sophisticated editorial aesthetic with bespoke serif-sans typography pairings, virtual property tours, and a private investor portal that elevated their deal flow and closed luxury penthouse acquisitions.'
        ),
        array(
            'title'       => 'Cosgrove – Real Estate Souvenirs',
            'client'      => 'Cosgrove Smart Cities',
            'year'        => '2024',
            'category'    => 'Souvenirs',
            'categories'  => array( 'Souvenirs', 'Branding' ),
            'short_desc'  => 'Ultra-premium VIP welcome kits, smart tech gifts & custom luxury packaging.',
            'featured'    => '1',
            'content'     => 'For Cosgrove\'s VIP homeowner handovers, standard corporate gifts were out of the question. We conceptualized, designed, and manufactured bespoke welcome boxes featuring Italian matte-black leather portfolios, anodized aluminium digital access keys, engraved brass desk artifacts, and custom-scented ambient home fragrances.'
        ),
        array(
            'title'       => 'MacKenny Tutors – Education',
            'client'      => 'MacKenny Learning UK',
            'year'        => '2025',
            'category'    => 'Website Development',
            'categories'  => array( 'Website Development', 'UI/UX Design' ),
            'short_desc'  => 'Interactive online tutoring portal, student dashboards & automated booking ecosystem.',
            'featured'    => '1',
            'content'     => 'MacKenny Tutors connects elite British educators with ambitious students globally. We engineered a sleek, responsive educational portal combining seamless session booking, tutor video profiles, parent progress reports, and interactive curriculum pathways.'
        ),
        array(
            'title'       => 'Zenith Pay – Digital Banking',
            'client'      => 'Zenith Financial Tech',
            'year'        => '2026',
            'category'    => 'App Development',
            'categories'  => array( 'App Development', 'UI/UX Design' ),
            'short_desc'  => 'Next-generation cross-border payment experience with real-time currency conversion.',
            'featured'    => '1',
            'content'     => 'An award-worthy fintech interface engineered for high-velocity cross-border African remittances. Features biometrics, dark-mode-first aesthetic, haptic micro-interactions, and sub-second transaction states.'
        ),
        array(
            'title'       => 'Vantage Horizon – Interior Spaces',
            'client'      => 'Vantage Atelier',
            'year'        => '2025',
            'category'    => 'Architecture & Interior Design',
            'categories'  => array( 'Architecture & Interior Design', 'Media Services' ),
            'short_desc'  => 'Minimalist biophilic interior design and architectural 3D spatial experiences.',
            'featured'    => '1',
            'content'     => 'Blending organic materials with brutalist concrete geometry. We handled the complete creative direction, 3D photorealistic renderings, spatial lighting design, and digital showroom portfolio.'
        )
    );

    foreach ( $projects as $proj ) {
        $existing = get_page_by_title( $proj['title'], OBJECT, 'project' );
        if ( ! $existing ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $proj['title'],
                'post_content' => $proj['content'],
                'post_excerpt' => $proj['short_desc'],
                'post_status'  => 'publish',
                'post_type'    => 'project',
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_project_client', $proj['client'] );
                update_post_meta( $post_id, '_project_year', $proj['year'] );
                update_post_meta( $post_id, '_project_short_desc', $proj['short_desc'] );
                update_post_meta( $post_id, '_project_featured', $proj['featured'] );
                update_post_meta( $post_id, '_project_url', 'https://designs.ng' );

                $term_ids = array();
                foreach ( $proj['categories'] as $c_name ) {
                    if ( isset( $cat_ids[ $c_name ] ) ) {
                        $term_ids[] = (int) $cat_ids[ $c_name ];
                    }
                }
                if ( ! empty( $term_ids ) ) {
                    wp_set_object_terms( $post_id, $term_ids, 'project_category' );
                }
            }
        }
    }

    // 3. Seed Services
    $services_data = array(
        array( 'title' => 'Branding', 'icon' => 'sparkles', 'desc' => 'Distinctive brand identities, typography systems, tone of voice, and memorable visual languages that command authority.' ),
        array( 'title' => 'Website Development', 'icon' => 'code', 'desc' => 'High-conversion, blazing-fast, custom-engineered digital experiences crafted on WordPress, Next.js, and modern tech stacks.' ),
        array( 'title' => 'UI/UX Design', 'icon' => 'layout', 'desc' => 'User-first product designs, wireframes, interaction prototypes, and design systems that delight users and drive metrics.' ),
        array( 'title' => 'Graphics Design', 'icon' => 'palette', 'desc' => 'Award-winning visual collateral, billboard campaigns, editorial layouts, pitch decks, and digital campaign assets.' ),
        array( 'title' => 'App Development', 'icon' => 'smartphone', 'desc' => 'Scalable iOS, Android, and cross-platform native applications built for fluid performance and intuitive touch gestures.' ),
        array( 'title' => 'Architecture & Interior Design', 'icon' => 'building', 'desc' => 'Bespoke residential and commercial interior spaces, photorealistic 3D visualization, and structural aesthetics.' ),
        array( 'title' => 'Media Services', 'icon' => 'video', 'desc' => 'Commercial video production, drone cinematography, brand photography, motion graphics, and post-production storytelling.' ),
        array( 'title' => 'Souvenirs', 'icon' => 'gift', 'desc' => 'Luxury corporate merchandise, bespoke VIP event gift boxes, custom packaging, and branded tangible touchpoints.' ),
        array( 'title' => 'Project Management', 'icon' => 'check-circle', 'desc' => 'End-to-end creative oversight, sprint-based delivery, quality assurance, and seamless stakeholder communication.' )
    );

    foreach ( $services_data as $srv ) {
        $existing = get_page_by_title( $srv['title'], OBJECT, 'service' );
        if ( ! $existing ) {
            $s_id = wp_insert_post( array(
                'post_title'   => $srv['title'],
                'post_content' => $srv['desc'],
                'post_excerpt' => $srv['desc'],
                'post_status'  => 'publish',
                'post_type'    => 'service',
            ) );
            if ( $s_id && ! is_wp_error( $s_id ) ) {
                update_post_meta( $s_id, '_service_icon', $srv['icon'] );
                update_post_meta( $s_id, '_service_short_desc', $srv['desc'] );
            }
        }
    }

    // 4. Seed Team Members
    $team_data = array(
        array( 'name' => 'Femi Adeyemi', 'role' => 'Principal & Creative Director', 'social' => 'https://linkedin.com' ),
        array( 'name' => 'Chiamaka Okafor', 'role' => 'Head of Brand Strategy', 'social' => 'https://linkedin.com' ),
        array( 'name' => 'Tariq Ibrahim', 'role' => 'Lead Frontend & Motion Engineer', 'social' => 'https://github.com' ),
        array( 'name' => 'Korede Benson', 'role' => 'Lead 3D & Architectural Designer', 'social' => 'https://behance.net' )
    );

    foreach ( $team_data as $tm ) {
        $existing = get_page_by_title( $tm['name'], OBJECT, 'team' );
        if ( ! $existing ) {
            $t_id = wp_insert_post( array(
                'post_title'   => $tm['name'],
                'post_content' => 'Passionate creative professional delivering world-class craftsmanship at Adam Studio.',
                'post_status'  => 'publish',
                'post_type'    => 'team',
            ) );
            if ( $t_id && ! is_wp_error( $t_id ) ) {
                update_post_meta( $t_id, '_team_role', $tm['role'] );
                update_post_meta( $t_id, '_team_social', $tm['social'] );
            }
        }
    }

    // 5. Dedicated Pages Setup
    $dedicated_pages = array(
        array(
            'title'    => 'Home',
            'slug'     => 'home',
            'template' => 'front-page.php',
            'is_front' => true,
        ),
        array(
            'title'    => 'Who We Are',
            'slug'     => 'who-we-are',
            'template' => 'page-about.php',
        ),
        array(
            'title'    => 'Our Services',
            'slug'     => 'services',
            'template' => 'page-services.php',
        ),
        array(
            'title'    => 'Portfolio',
            'slug'     => 'portfolio',
            'template' => 'page-portfolio.php',
        ),
        array(
            'title'    => 'Start Your Project',
            'slug'     => 'start-project',
            'template' => 'page-start-project.php',
        ),
        array(
            'title'    => 'Contact',
            'slug'     => 'contact',
            'template' => 'page-contact.php',
        ),
    );

    foreach ( $dedicated_pages as $p ) {
        $existing = get_page_by_path( $p['slug'] );
        if ( ! $existing ) {
            $existing = get_page_by_title( $p['title'] );
        }

        if ( ! $existing ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $p['title'],
                'post_name'    => $p['slug'],
                'post_content' => '',
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ) );
        } else {
            $page_id = $existing->ID;
            // Update slug if needed
            if ( $existing->post_name !== $p['slug'] ) {
                wp_update_post( array(
                    'ID'        => $page_id,
                    'post_name' => $p['slug'],
                ) );
            }
        }

        if ( $page_id && ! is_wp_error( $page_id ) ) {
            if ( ! empty( $p['template'] ) ) {
                update_post_meta( $page_id, '_wp_page_template', $p['template'] );
            }
            if ( ! empty( $p['is_front'] ) ) {
                update_option( 'show_on_front', 'page' );
                update_option( 'page_on_front', $page_id );
            }
        }
    }

    update_option( 'designs_ng_initial_seeded_v3', 1 );
}
add_action( 'init', 'designs_ng_seed_initial_content', 30 );
