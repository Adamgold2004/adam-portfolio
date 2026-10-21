<?php
/**
 * Register Custom Post Types, Taxonomies and Meta Boxes for Adam Studio
 *
 * @package designs-ng
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Types and Taxonomies
 */
function designs_ng_register_cpt() {

    // 1. Project Post Type
    $project_labels = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'designs-ng' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'designs-ng' ),
        'menu_name'             => __( 'Projects', 'designs-ng' ),
        'name_admin_bar'        => __( 'Project', 'designs-ng' ),
        'add_new'               => __( 'Add New', 'designs-ng' ),
        'add_new_item'          => __( 'Add New Project', 'designs-ng' ),
        'new_item'              => __( 'New Project', 'designs-ng' ),
        'edit_item'             => __( 'Edit Project', 'designs-ng' ),
        'update_item'           => __( 'Update Project', 'designs-ng' ),
        'view_item'             => __( 'View Project', 'designs-ng' ),
        'view_items'            => __( 'View Projects', 'designs-ng' ),
        'search_items'          => __( 'Search Project', 'designs-ng' ),
        'not_found'             => __( 'No projects found', 'designs-ng' ),
        'not_found_in_trash'    => __( 'No projects found in Trash', 'designs-ng' ),
    );
    $project_args = array(
        'label'                 => __( 'Project', 'designs-ng' ),
        'labels'                => $project_labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'elementor' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'projects' ),
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    register_post_type( 'project', $project_args );

    // Project Category Taxonomy
    $project_cat_labels = array(
        'name'                       => _x( 'Project Categories', 'Taxonomy General Name', 'designs-ng' ),
        'singular_name'              => _x( 'Project Category', 'Taxonomy Singular Name', 'designs-ng' ),
        'menu_name'                  => __( 'Categories', 'designs-ng' ),
        'all_items'                  => __( 'All Categories', 'designs-ng' ),
        'new_item_name'              => __( 'New Category Name', 'designs-ng' ),
        'add_new_item'               => __( 'Add New Category', 'designs-ng' ),
        'edit_item'                  => __( 'Edit Category', 'designs-ng' ),
        'update_item'                => __( 'Update Category', 'designs-ng' ),
        'add_or_remove_items'        => __( 'Add or remove categories', 'designs-ng' ),
    );
    $project_cat_args = array(
        'labels'                     => $project_cat_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'show_in_rest'               => true,
        'rewrite'                    => array( 'slug' => 'project-category' ),
    );
    register_taxonomy( 'project_category', array( 'project' ), $project_cat_args );

    // 2. Team Post Type
    $team_labels = array(
        'name'                  => _x( 'Team Members', 'Post Type General Name', 'designs-ng' ),
        'singular_name'         => _x( 'Team Member', 'Post Type Singular Name', 'designs-ng' ),
        'menu_name'             => __( 'Team', 'designs-ng' ),
        'name_admin_bar'        => __( 'Team Member', 'designs-ng' ),
        'add_new'               => __( 'Add New', 'designs-ng' ),
        'add_new_item'          => __( 'Add New Team Member', 'designs-ng' ),
    );
    $team_args = array(
        'label'                 => __( 'Team Member', 'designs-ng' ),
        'labels'                => $team_labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'elementor' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-groups',
        'has_archive'           => false,
        'publicly_queryable'    => true,
        'show_in_rest'          => true,
    );
    register_post_type( 'team', $team_args );

    // 3. Service Post Type
    $service_labels = array(
        'name'                  => _x( 'Services', 'Post Type General Name', 'designs-ng' ),
        'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'designs-ng' ),
        'menu_name'             => __( 'Services', 'designs-ng' ),
        'name_admin_bar'        => __( 'Service', 'designs-ng' ),
        'add_new'               => __( 'Add New', 'designs-ng' ),
        'add_new_item'          => __( 'Add New Service', 'designs-ng' ),
    );
    $service_args = array(
        'label'                 => __( 'Service', 'designs-ng' ),
        'labels'                => $service_labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'elementor' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 7,
        'menu_icon'             => 'dashicons-hammer',
        'has_archive'           => false,
        'publicly_queryable'    => true,
        'show_in_rest'          => true,
    );
    register_post_type( 'service', $service_args );

}
add_action( 'init', 'designs_ng_register_cpt', 0 );

/**
 * Enable Elementor support for CPTs
 */
function designs_ng_add_elementor_support() {
    $cpts = array( 'project', 'team', 'service', 'page', 'post' );
    $elementor_cpts = get_option( 'elementor_cpt_support', array() );
    if ( ! is_array( $elementor_cpts ) ) {
        $elementor_cpts = array();
    }
    $updated = false;
    foreach ( $cpts as $cpt ) {
        if ( ! in_array( $cpt, $elementor_cpts, true ) ) {
            $elementor_cpts[] = $cpt;
            $updated = true;
        }
    }
    if ( $updated ) {
        update_option( 'elementor_cpt_support', $elementor_cpts );
    }
}
add_action( 'init', 'designs_ng_add_elementor_support', 20 );

/**
 * Custom Meta Boxes for Projects (Client, Year, URL, Featured)
 */
function designs_ng_add_project_metaboxes() {
    add_meta_box(
        'designs_project_details',
        __( 'Project Details (Adam Studio)', 'designs-ng' ),
        'designs_ng_project_metabox_render',
        'project',
        'normal',
        'high'
    );

    add_meta_box(
        'designs_team_details',
        __( 'Team Member Details', 'designs-ng' ),
        'designs_ng_team_metabox_render',
        'team',
        'normal',
        'high'
    );

    add_meta_box(
        'designs_service_details',
        __( 'Service Details', 'designs-ng' ),
        'designs_ng_service_metabox_render',
        'service',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'designs_ng_add_project_metaboxes' );

/**
 * Render Project Metabox
 */
function designs_ng_project_metabox_render( $post ) {
    wp_nonce_field( 'designs_ng_project_meta', 'designs_ng_project_nonce' );

    $client          = get_post_meta( $post->ID, '_project_client', true );
    $year            = get_post_meta( $post->ID, '_project_year', true );
    $url             = get_post_meta( $post->ID, '_project_url', true );
    $short_desc      = get_post_meta( $post->ID, '_project_short_desc', true );
    $featured        = get_post_meta( $post->ID, '_project_featured', true );
    $scatter_images  = get_post_meta( $post->ID, '_project_scatter_images', true );
    $scatter_captions= get_post_meta( $post->ID, '_project_scatter_captions', true );
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; padding: 10px 0;">
        <p>
            <label for="project_client"><strong><?php _e( 'Client Name:', 'designs-ng' ); ?></strong></label><br>
            <input type="text" id="project_client" name="project_client" value="<?php echo esc_attr( $client ); ?>" style="width:100%;" placeholder="e.g. Midwest Dental Clinic">
        </p>
        <p>
            <label for="project_year"><strong><?php _e( 'Year:', 'designs-ng' ); ?></strong></label><br>
            <input type="text" id="project_year" name="project_year" value="<?php echo esc_attr( $year ); ?>" style="width:100%;" placeholder="e.g. 2025 or 2026">
        </p>
        <p style="grid-column: span 2;">
            <label for="project_short_desc"><strong><?php _e( 'Short Summary / Scope:', 'designs-ng' ); ?></strong></label><br>
            <input type="text" id="project_short_desc" name="project_short_desc" value="<?php echo esc_attr( $short_desc ); ?>" style="width:100%;" placeholder="e.g. Complete Branding & Web Experience">
        </p>
        <p>
            <label for="project_url"><strong><?php _e( 'Project Live URL (Optional):', 'designs-ng' ); ?></strong></label><br>
            <input type="url" id="project_url" name="project_url" value="<?php echo esc_attr( $url ); ?>" style="width:100%;" placeholder="https://example.com">
        </p>
        <p style="align-self: center;">
            <label for="project_featured">
                <input type="checkbox" id="project_featured" name="project_featured" value="1" <?php checked( $featured, '1' ); ?>>
                <strong><?php _e( 'Featured Project (Display on Homepage Swipe Carousel)', 'designs-ng' ); ?></strong>
            </label>
        </p>

        <!-- SATELLITE SCATTERED IMAGES & LIGHTBOX (ELEMENTOR & PORTFOLIO INTEGRATION) -->
        <div style="grid-column: span 2; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 6px; padding: 16px; margin-top: 10px;">
            <h4 style="margin: 0 0 8px 0; color: #0f172a; font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 8px;">
                <span style="display:inline-block; width:8px; height:8px; background:#00B84A; border-radius:50%;"></span>
                <?php _e( 'Satellite Scattered Gallery & Lightbox (Portfolio Theatre & Elementor)', 'designs-ng' ); ?>
            </h4>
            <p style="margin: 0 0 12px 0; font-size: 12px; color: #64748b; line-height: 1.5;">
                <?php _e( 'Enter up to 4 custom image URLs or media IDs to orbit around this project in an architectural scattered layout on the Portfolio page and inside the Elementor Scatter widget. If left blank, high-quality curated architectural assets will be used automatically.', 'designs-ng' ); ?>
            </p>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <p style="margin: 0;">
                    <label for="project_scatter_images"><strong><?php _e( 'Scattered Image URLs (One URL per line):', 'designs-ng' ); ?></strong></label><br>
                    <textarea id="project_scatter_images" name="project_scatter_images" rows="4" style="width:100%; font-family:monospace; font-size:12px;" placeholder="https://example.com/wp-content/uploads/sample-1.jpg&#10;https://example.com/wp-content/uploads/sample-2.jpg&#10;https://example.com/wp-content/uploads/sample-3.jpg&#10;https://example.com/wp-content/uploads/sample-4.jpg"><?php echo esc_textarea( $scatter_images ); ?></textarea>
                </p>
                <p style="margin: 0;">
                    <label for="project_scatter_captions"><strong><?php _e( 'Figure Captions / Technical Notes (One per line):', 'designs-ng' ); ?></strong></label><br>
                    <textarea id="project_scatter_captions" name="project_scatter_captions" rows="4" style="width:100%; font-family:monospace; font-size:12px;" placeholder="FIG. S-01 // MATERIAL STUDY — Basalt & teak texture&#10;FIG. S-02 // TECHNICAL BLUEPRINT — Spatial acoustic grid&#10;FIG. S-03 // ARTIFACT DETAIL — VIP unboxing kit&#10;FIG. S-04 // AMBIENT STILL — Architectural lighting"><?php echo esc_textarea( $scatter_captions ); ?></textarea>
                </p>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Render Team Metabox
 */
function designs_ng_team_metabox_render( $post ) {
    wp_nonce_field( 'designs_ng_team_meta', 'designs_ng_team_nonce' );

    $role   = get_post_meta( $post->ID, '_team_role', true );
    $social = get_post_meta( $post->ID, '_team_social', true );
    ?>
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; padding: 10px 0;">
        <p>
            <label for="team_role"><strong><?php _e( 'Role / Title:', 'designs-ng' ); ?></strong></label><br>
            <input type="text" id="team_role" name="team_role" value="<?php echo esc_attr( $role ); ?>" style="width:100%;" placeholder="e.g. Creative Director, Senior UI/UX Designer">
        </p>
        <p>
            <label for="team_social"><strong><?php _e( 'Social Link / Portfolio URL:', 'designs-ng' ); ?></strong></label><br>
            <input type="url" id="team_social" name="team_social" value="<?php echo esc_attr( $social ); ?>" style="width:100%;" placeholder="https://linkedin.com/in/...">
        </p>
    </div>
    <?php
}

/**
 * Render Service Metabox
 */
function designs_ng_service_metabox_render( $post ) {
    wp_nonce_field( 'designs_ng_service_meta', 'designs_ng_service_nonce' );

    $icon       = get_post_meta( $post->ID, '_service_icon', true );
    $short_desc = get_post_meta( $post->ID, '_service_short_desc', true );
    ?>
    <div style="padding: 10px 0;">
        <p>
            <label for="service_icon"><strong><?php _e( 'Icon Name or SVG Keyword:', 'designs-ng' ); ?></strong></label><br>
            <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr( $icon ); ?>" style="width:100%;" placeholder="e.g. palette, globe, layout, smartphone, cubes">
        </p>
        <p>
            <label for="service_short_desc"><strong><?php _e( 'Short Description:', 'designs-ng' ); ?></strong></label><br>
            <textarea id="service_short_desc" name="service_short_desc" rows="3" style="width:100%;"><?php echo esc_textarea( $short_desc ); ?></textarea>
        </p>
    </div>
    <?php
}

/**
 * Save Meta Boxes
 */
function designs_ng_save_custom_meta( $post_id ) {
    // Project save
    if ( isset( $_POST['designs_ng_project_nonce'] ) && wp_verify_nonce( $_POST['designs_ng_project_nonce'], 'designs_ng_project_meta' ) ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;

        update_post_meta( $post_id, '_project_client', sanitize_text_field( $_POST['project_client'] ?? '' ) );
        update_post_meta( $post_id, '_project_year', sanitize_text_field( $_POST['project_year'] ?? '' ) );
        update_post_meta( $post_id, '_project_short_desc', sanitize_text_field( $_POST['project_short_desc'] ?? '' ) );
        update_post_meta( $post_id, '_project_url', esc_url_raw( $_POST['project_url'] ?? '' ) );
        update_post_meta( $post_id, '_project_featured', isset( $_POST['project_featured'] ) ? '1' : '0' );
        update_post_meta( $post_id, '_project_scatter_images', sanitize_textarea_field( $_POST['project_scatter_images'] ?? '' ) );
        update_post_meta( $post_id, '_project_scatter_captions', sanitize_textarea_field( $_POST['project_scatter_captions'] ?? '' ) );
    }

    // Team save
    if ( isset( $_POST['designs_ng_team_nonce'] ) && wp_verify_nonce( $_POST['designs_ng_team_nonce'], 'designs_ng_team_meta' ) ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;

        update_post_meta( $post_id, '_team_role', sanitize_text_field( $_POST['team_role'] ?? '' ) );
        update_post_meta( $post_id, '_team_social', esc_url_raw( $_POST['team_social'] ?? '' ) );
    }

    // Service save
    if ( isset( $_POST['designs_ng_service_nonce'] ) && wp_verify_nonce( $_POST['designs_ng_service_nonce'], 'designs_ng_service_meta' ) ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( ! current_user_can( 'edit_post', $post_id ) ) return;

        update_post_meta( $post_id, '_service_icon', sanitize_text_field( $_POST['service_icon'] ?? '' ) );
        update_post_meta( $post_id, '_service_short_desc', sanitize_textarea_field( $_POST['service_short_desc'] ?? '' ) );
    }
}
add_action( 'save_post', 'designs_ng_save_custom_meta' );

/**
 * Filter for Elementor Custom Queries
 * Enables Elementor Loop Grid / Posts widgets to filter by query_id="designs_featured_projects"
 */
function designs_ng_filter_featured_projects_query( $query ) {
    $query->set( 'post_type', 'project' );
    $query->set( 'meta_key', '_project_featured' );
    $query->set( 'meta_value', '1' );
}
add_action( 'elementor/query/designs_featured_projects', 'designs_ng_filter_featured_projects_query' );
