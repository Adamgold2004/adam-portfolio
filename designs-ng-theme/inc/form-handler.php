<?php
/**
 * Forms Processing, Email Notification Dispatch & WordPress Leads Management
 *
 * Provides:
 * 1. Custom Post Type: designs_lead ("Inquiries" in WP Admin)
 * 2. Dedicated Admin Columns & Detail View Metabox with Status Management
 * 3. AJAX Submission Handler for All Theme Forms with Nonce & Spam Prevention
 * 4. Executive HTML Email Dispatch via wp_mail() with Client Reply-To
 *
 * @package designs-ng
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Type: designs_lead
 */
function designs_ng_register_lead_cpt() {
    $labels = array(
        'name'               => _x( 'Inquiries', 'post type general name', 'designs-ng' ),
        'singular_name'      => _x( 'Inquiry', 'post type singular name', 'designs-ng' ),
        'menu_name'          => _x( 'Inquiries', 'admin menu', 'designs-ng' ),
        'name_admin_bar'     => _x( 'Inquiry', 'add new on admin bar', 'designs-ng' ),
        'add_new'            => _x( 'Add New Lead', 'inquiry', 'designs-ng' ),
        'add_new_item'       => __( 'Add New Inquiry', 'designs-ng' ),
        'new_item'           => __( 'New Inquiry', 'designs-ng' ),
        'edit_item'          => __( 'Review Inquiry', 'designs-ng' ),
        'view_item'          => __( 'View Inquiry', 'designs-ng' ),
        'all_items'          => __( 'All Inquiries', 'designs-ng' ),
        'search_items'       => __( 'Search Inquiries', 'designs-ng' ),
        'parent_item_colon'  => __( 'Parent Inquiries:', 'designs-ng' ),
        'not_found'          => __( 'No inquiries received yet.', 'designs-ng' ),
        'not_found_in_trash' => __( 'No inquiries in trash.', 'designs-ng' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Client project briefs and contact inquiries received through Adam Studio website forms.', 'designs-ng' ),
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'capabilities'       => array(
            'create_posts' => 'do_not_allow', // Leads should come via form submissions
        ),
        'map_meta_cap'       => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-email-alt',
        'supports'           => array( 'title' ),
    );

    register_post_type( 'designs_lead', $args );
}
add_action( 'init', 'designs_ng_register_lead_cpt' );

/**
 * Configure Custom Admin Columns for designs_lead
 */
function designs_ng_lead_columns( $columns ) {
    $new_columns = array(
        'cb'           => '<input type="checkbox" />',
        'title'        => __( 'Client / Company', 'designs-ng' ),
        'lead_status'  => __( 'Status', 'designs-ng' ),
        'lead_email'   => __( 'Email Address', 'designs-ng' ),
        'lead_phone'   => __( 'Phone / WhatsApp', 'designs-ng' ),
        'lead_service' => __( 'Requested Service', 'designs-ng' ),
        'lead_budget'  => __( 'Budget', 'designs-ng' ),
        'lead_source'  => __( 'Source Form', 'designs-ng' ),
        'date'         => __( 'Received Date', 'designs-ng' ),
    );
    return $new_columns;
}
add_filter( 'manage_designs_lead_posts_columns', 'designs_ng_lead_columns' );

/**
 * Render Custom Admin Column Content for designs_lead
 */
function designs_ng_lead_column_content( $column, $post_id ) {
    switch ( $column ) {
        case 'lead_status':
            $status = get_post_meta( $post_id, '_lead_status', true );
            if ( empty( $status ) ) {
                $status = 'new';
            }
            $status_styles = array(
                'new'       => 'background: #00B84A22; color: #00B84A; border: 1px solid #00B84A55;',
                'contacted' => 'background: #3B82F622; color: #60A5FA; border: 1px solid #3B82F655;',
                'review'    => 'background: #F59E0B22; color: #FBBF24; border: 1px solid #F59E0B55;',
                'completed' => 'background: #10B98122; color: #34D399; border: 1px solid #10B98155;',
                'archived'  => 'background: #6B728022; color: #9CA3AF; border: 1px solid #6B728055;',
            );
            $style = isset( $status_styles[ $status ] ) ? $status_styles[ $status ] : $status_styles['new'];
            $label = ucfirst( str_replace( '_', ' ', $status ) );
            echo '<span style="display:inline-block; padding: 3px 10px; border-radius: 99px; font-size: 11px; font-weight: 600; text-transform: uppercase; ' . esc_attr( $style ) . '">' . esc_html( $label ) . '</span>';
            break;

        case 'lead_email':
            $email = get_post_meta( $post_id, '_lead_email', true );
            if ( ! empty( $email ) ) {
                echo '<a href="mailto:' . esc_attr( $email ) . '" style="font-weight: 500; color: #008a36;">' . esc_html( $email ) . '</a>';
            } else {
                echo '<span style="color:#999;">—</span>';
            }
            break;

        case 'lead_phone':
            $phone = get_post_meta( $post_id, '_lead_phone', true );
            if ( ! empty( $phone ) ) {
                $clean_phone = preg_replace( '/[^0-9+]/', '', $phone );
                echo '<a href="tel:' . esc_attr( $clean_phone ) . '">' . esc_html( $phone ) . '</a>';
            } else {
                echo '<span style="color:#999;">—</span>';
            }
            break;

        case 'lead_service':
            $service = get_post_meta( $post_id, '_lead_service', true );
            if ( empty( $service ) ) {
                $services = get_post_meta( $post_id, '_lead_services', true );
                if ( is_array( $services ) && ! empty( $services ) ) {
                    $service = implode( ', ', $services );
                }
            }
            echo ! empty( $service ) ? esc_html( $service ) : '<span style="color:#999;">—</span>';
            break;

        case 'lead_budget':
            $budget = get_post_meta( $post_id, '_lead_budget', true );
            echo ! empty( $budget ) ? esc_html( $budget ) : '<span style="color:#999;">—</span>';
            break;

        case 'lead_source':
            $source = get_post_meta( $post_id, '_lead_form_source', true );
            echo ! empty( $source ) ? '<code style="background:#f0f0f1; padding:2px 6px; border-radius:3px;">' . esc_html( $source ) . '</code>' : 'Standard Form';
            break;
    }
}
add_action( 'manage_designs_lead_posts_custom_column', 'designs_ng_lead_column_content', 10, 2 );

/**
 * Make Lead Columns Sortable
 */
function designs_ng_lead_sortable_columns( $columns ) {
    $columns['lead_status'] = 'lead_status';
    $columns['lead_source'] = 'lead_source';
    return $columns;
}
add_filter( 'manage_edit-designs_lead_sortable_columns', 'designs_ng_lead_sortable_columns' );

/**
 * Register Metabox for Lead Details in WP Admin
 */
function designs_ng_add_lead_metaboxes() {
    add_meta_box(
        'designs_lead_dossier',
        __( 'Inquiry Dossier & Client Brief', 'designs-ng' ),
        'designs_ng_render_lead_metabox',
        'designs_lead',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'designs_ng_add_lead_metaboxes' );

/**
 * Render Lead Dossier Metabox
 */
function designs_ng_render_lead_metabox( $post ) {
    wp_nonce_field( 'designs_lead_save_nonce', 'designs_lead_nonce' );

    $name         = get_post_meta( $post->ID, '_lead_name', true );
    $email        = get_post_meta( $post->ID, '_lead_email', true );
    $phone        = get_post_meta( $post->ID, '_lead_phone', true );
    $company      = get_post_meta( $post->ID, '_lead_company', true );
    $service      = get_post_meta( $post->ID, '_lead_service', true );
    $services     = get_post_meta( $post->ID, '_lead_services', true );
    $timeline     = get_post_meta( $post->ID, '_lead_timeline', true );
    $budget       = get_post_meta( $post->ID, '_lead_budget', true );
    $message      = get_post_meta( $post->ID, '_lead_message', true );
    $source       = get_post_meta( $post->ID, '_lead_form_source', true );
    $status       = get_post_meta( $post->ID, '_lead_status', true );
    $client_ip    = get_post_meta( $post->ID, '_lead_client_ip', true );
    $submitted_at = get_post_meta( $post->ID, '_lead_submitted_at', true );

    if ( empty( $status ) ) {
        $status = 'new';
    }
    ?>
    <div style="padding: 12px 0;">
        <div style="display: flex; gap: 24px; align-items: flex-start; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #e5e7eb;">
            <div style="flex: 1;">
                <label style="font-weight: 600; font-size: 13px; display: block; margin-bottom: 6px;">Lead Status:</label>
                <select name="lead_status" style="width: 220px; padding: 6px 10px; font-weight: 600;">
                    <option value="new" <?php selected( $status, 'new' ); ?>>🟢 New Lead</option>
                    <option value="contacted" <?php selected( $status, 'contacted' ); ?>>🔵 Contacted</option>
                    <option value="review" <?php selected( $status, 'review' ); ?>>🟡 In Strategic Review</option>
                    <option value="completed" <?php selected( $status, 'completed' ); ?>>✅ Commissioned / Closed</option>
                    <option value="archived" <?php selected( $status, 'archived' ); ?>>⚪ Archived</option>
                </select>
            </div>
            <div>
                <?php if ( ! empty( $email ) ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>?subject=Re:%20Adam Studio%20Commission%20Proposal" class="button button-primary button-large" style="margin-right: 8px;">
                        ✉️ Reply to Client via Email
                    </a>
                <?php endif; ?>
                <?php if ( ! empty( $phone ) ) : 
                    $clean_phone = preg_replace( '/[^0-9]/', '', $phone );
                    ?>
                    <a href="https://wa.me/<?php echo esc_attr( $clean_phone ); ?>" target="_blank" class="button button-secondary button-large" style="color: #059669; border-color: #059669;">
                        💬 Open WhatsApp Chat
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <table class="form-table" style="margin-top: 0;">
            <tr>
                <th style="width: 180px;"><?php esc_html_e( 'Client / Prospect Name', 'designs-ng' ); ?></th>
                <td><strong style="font-size: 15px;"><?php echo esc_html( $name ? $name : $post->post_title ); ?></strong></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Company / Brand', 'designs-ng' ); ?></th>
                <td><?php echo esc_html( $company ? $company : '—' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Email Address', 'designs-ng' ); ?></th>
                <td>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>"><strong><?php echo esc_html( $email ); ?></strong></a>
                </td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Phone / WhatsApp', 'designs-ng' ); ?></th>
                <td><?php echo esc_html( $phone ? $phone : '—' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Primary Service / Subject', 'designs-ng' ); ?></th>
                <td><span style="background: #eef2ff; color: #4338ca; padding: 4px 10px; border-radius: 4px; font-weight: 600;"><?php echo esc_html( $service ? $service : 'General Inquiry' ); ?></span></td>
            </tr>
            <?php if ( is_array( $services ) && ! empty( $services ) ) : ?>
                <tr>
                    <th><?php esc_html_e( 'All Selected Services', 'designs-ng' ); ?></th>
                    <td>
                        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                            <?php foreach ( $services as $s ) : ?>
                                <span style="background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; padding: 3px 8px; border-radius: 4px; font-size: 12px;"><?php echo esc_html( $s ); ?></span>
                            <?php endforeach; ?>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <th><?php esc_html_e( 'Expected Timeline', 'designs-ng' ); ?></th>
                <td><?php echo esc_html( $timeline ? ucfirst( $timeline ) : '—' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Estimated Budget', 'designs-ng' ); ?></th>
                <td><strong style="color: #047857;"><?php echo esc_html( $budget ? $budget : '—' ); ?></strong></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Form Origin / Source', 'designs-ng' ); ?></th>
                <td><code><?php echo esc_html( $source ? $source : 'Adam Studio Form' ); ?></code></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Submission Timestamp', 'designs-ng' ); ?></th>
                <td><?php echo esc_html( $submitted_at ? $submitted_at : get_the_date( 'F j, Y g:i A', $post->ID ) ); ?> (Client IP: <?php echo esc_html( $client_ip ? $client_ip : 'Unknown' ); ?>)</td>
            </tr>
        </table>

        <div style="margin-top: 24px;">
            <label style="font-weight: 600; font-size: 14px; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Client Message / Project Brief:', 'designs-ng' ); ?></label>
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 18px 22px; font-size: 14.5px; line-height: 1.7; color: #1e293b; white-space: pre-wrap; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
                <?php echo esc_html( $message ? $message : $post->post_content ); ?>
            </div>
        </div>
    </div>
    <?php
}

/**
 * Save Metabox status update
 */
function designs_ng_save_lead_metabox( $post_id ) {
    if ( ! isset( $_POST['designs_lead_nonce'] ) || ! wp_verify_nonce( $_POST['designs_lead_nonce'], 'designs_lead_save_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['lead_status'] ) ) {
        update_post_meta( $post_id, '_lead_status', sanitize_text_field( $_POST['lead_status'] ) );
    }
}
add_action( 'save_post_designs_lead', 'designs_ng_save_lead_metabox' );

/**
 * Handle AJAX Form Submission
 *
 * Listens on:
 * - wp_ajax_designs_submit_lead
 * - wp_ajax_nopriv_designs_submit_lead
 */
function designs_ng_handle_lead_submission() {
    // 1. Nonce check
    if ( ! check_ajax_referer( 'designs_lead_nonce_action', 'lead_nonce', false ) ) {
        wp_send_json_error( array(
            'message' => __( 'Security verification failed. Please refresh the page and try again.', 'designs-ng' ),
        ), 403 );
    }

    // 2. Honeypot check for spam bots
    if ( ! empty( $_POST['website_hp'] ) ) {
        // Silently discard spam bot entries
        wp_send_json_success( array(
            'message' => __( 'Thank you! Your inquiry has been received.', 'designs-ng' ),
        ) );
    }

    // 3. Extract & Sanitize fields
    $name     = isset( $_POST['lead_name'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_name'] ) ) : '';
    $email    = isset( $_POST['lead_email'] ) ? sanitize_email( wp_unslash( $_POST['lead_email'] ) ) : '';
    $phone    = isset( $_POST['lead_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_phone'] ) ) : '';
    $company  = isset( $_POST['lead_company'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_company'] ) ) : '';
    $service  = isset( $_POST['lead_service'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_service'] ) ) : '';
    if ( empty( $service ) && isset( $_POST['lead_subject'] ) ) {
        $service = sanitize_text_field( wp_unslash( $_POST['lead_subject'] ) );
    }
    $timeline = isset( $_POST['lead_timeline'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_timeline'] ) ) : '';
    $budget   = isset( $_POST['lead_budget'] ) ? sanitize_text_field( wp_unslash( $_POST['lead_budget'] ) ) : '';
    $message  = isset( $_POST['lead_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['lead_message'] ) ) : '';
    $source   = isset( $_POST['form_source'] ) ? sanitize_text_field( wp_unslash( $_POST['form_source'] ) ) : 'Website Inquiry';

    // Handle checkboxes for services
    $services = array();
    if ( isset( $_POST['services'] ) && is_array( $_POST['services'] ) ) {
        foreach ( $_POST['services'] as $s ) {
            $services[] = sanitize_text_field( wp_unslash( $s ) );
        }
    }

    // 4. Validate mandatory fields
    if ( empty( $name ) ) {
        wp_send_json_error( array(
            'field'   => 'lead_name',
            'message' => __( 'Please enter your full name or company name.', 'designs-ng' ),
        ), 400 );
    }

    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array(
            'field'   => 'lead_email',
            'message' => __( 'Please enter a valid email address.', 'designs-ng' ),
        ), 400 );
    }

    if ( empty( $message ) ) {
        wp_send_json_error( array(
            'field'   => 'lead_message',
            'message' => __( 'Please provide details about your project or inquiry.', 'designs-ng' ),
        ), 400 );
    }

    // Client IP & Timestamp
    $client_ip = ! empty( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '127.0.0.1';
    $timestamp = current_time( 'mysql' );

    // 5. Create Lead Post in Database
    $post_title = $name;
    if ( ! empty( $company ) ) {
        $post_title .= ' (' . $company . ')';
    }

    $lead_id = wp_insert_post( array(
        'post_title'   => $post_title,
        'post_content' => $message,
        'post_status'  => 'publish',
        'post_type'    => 'designs_lead',
    ) );

    if ( is_wp_error( $lead_id ) || ! $lead_id ) {
        wp_send_json_error( array(
            'message' => __( 'Database error while saving inquiry. Please try again later.', 'designs-ng' ),
        ), 500 );
    }

    // Save Meta Data
    update_post_meta( $lead_id, '_lead_name', $name );
    update_post_meta( $lead_id, '_lead_email', $email );
    update_post_meta( $lead_id, '_lead_phone', $phone );
    update_post_meta( $lead_id, '_lead_company', $company );
    update_post_meta( $lead_id, '_lead_service', $service );
    update_post_meta( $lead_id, '_lead_services', $services );
    update_post_meta( $lead_id, '_lead_timeline', $timeline );
    update_post_meta( $lead_id, '_lead_budget', $budget );
    update_post_meta( $lead_id, '_lead_message', $message );
    update_post_meta( $lead_id, '_lead_form_source', $source );
    update_post_meta( $lead_id, '_lead_status', 'new' );
    update_post_meta( $lead_id, '_lead_client_ip', $client_ip );
    update_post_meta( $lead_id, '_lead_submitted_at', $timestamp );

    // 6. Send High-End HTML Notification Email via wp_mail()
    $admin_email = apply_filters( 'designs_ng_lead_email_recipient', get_option( 'admin_email' ) );
    $subject_service = ! empty( $service ) ? $service : ( ! empty( $services ) ? implode( ', ', $services ) : 'Project Inquiry' );
    $email_subject   = sprintf( '[Adam Studio Inquiry] New Lead: %s - %s', $name, $subject_service );

    $admin_edit_url = admin_url( 'post.php?post=' . $lead_id . '&action=edit' );

    // Build Executive HTML Email
    ob_start();
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <style>
            body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #070a08; margin: 0; padding: 24px; color: #e2e8f0; }
            .email-card { max-width: 600px; margin: 0 auto; background-color: #0f1411; border: 1px solid rgba(0, 184, 74, 0.25); border-radius: 8px; overflow: hidden; }
            .email-header { background: #070a08; padding: 24px 30px; border-bottom: 2px solid #00B84A; }
            .email-brand { font-size: 18px; font-weight: 700; letter-spacing: 2px; color: #FFFFFF; text-transform: uppercase; }
            .email-brand span { color: #00B84A; }
            .email-tagline { font-size: 12px; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px; }
            .email-body { padding: 30px; }
            .lead-heading { font-size: 22px; color: #ffffff; margin-top: 0; margin-bottom: 20px; font-weight: 600; }
            .data-table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
            .data-table td { padding: 10px 12px; border-bottom: 1px solid rgba(255, 255, 255, 0.08); font-size: 14px; }
            .data-table td.label { width: 35%; color: #94a3b8; font-weight: 500; }
            .data-table td.value { color: #f8fafc; font-weight: 600; }
            .message-box { background: #151c18; border-left: 3px solid #00B84A; border-radius: 4px; padding: 16px 20px; font-size: 14px; line-height: 1.6; color: #e2e8f0; white-space: pre-wrap; margin-bottom: 28px; }
            .btn-action { display: inline-block; background-color: #00B84A; color: #000000 !important; text-decoration: none; padding: 12px 24px; border-radius: 99px; font-weight: 700; font-size: 14px; letter-spacing: 0.5px; text-transform: uppercase; }
            .email-footer { padding: 16px 30px; background: #070a08; border-top: 1px solid rgba(255, 255, 255, 0.08); font-size: 11px; color: #64748b; text-align: center; }
        </style>
    </head>
    <body>
        <div class="email-card">
            <div class="email-header">
                <div class="email-brand">Designs<span>.NG</span></div>
                <div class="email-tagline"><?php echo esc_html( $source ); ?> • Executive Lead Alert</div>
            </div>
            <div class="email-body">
                <h1 class="lead-heading">New Client Inquiry Received</h1>
                <table class="data-table">
                    <tr>
                        <td class="label">Client Name:</td>
                        <td class="value"><?php echo esc_html( $name ); ?></td>
                    </tr>
                    <?php if ( ! empty( $company ) ) : ?>
                    <tr>
                        <td class="label">Company:</td>
                        <td class="value"><?php echo esc_html( $company ); ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="label">Email Address:</td>
                        <td class="value"><a href="mailto:<?php echo esc_attr( $email ); ?>" style="color: #00B84A;"><?php echo esc_html( $email ); ?></a></td>
                    </tr>
                    <?php if ( ! empty( $phone ) ) : ?>
                    <tr>
                        <td class="label">Phone / WhatsApp:</td>
                        <td class="value"><?php echo esc_html( $phone ); ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="label">Service / Scope:</td>
                        <td class="value"><?php echo esc_html( $subject_service ); ?></td>
                    </tr>
                    <?php if ( ! empty( $timeline ) ) : ?>
                    <tr>
                        <td class="label">Timeline:</td>
                        <td class="value"><?php echo esc_html( ucfirst( $timeline ) ); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ( ! empty( $budget ) ) : ?>
                    <tr>
                        <td class="label">Budget Estimate:</td>
                        <td class="value"><?php echo esc_html( $budget ); ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td class="label">Received:</td>
                        <td class="value"><?php echo esc_html( $timestamp ); ?></td>
                    </tr>
                </table>

                <div style="font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: #94a3b8; margin-bottom: 8px;">Client Brief / Message:</div>
                <div class="message-box"><?php echo esc_html( $message ); ?></div>

                <div style="text-align: center; margin-top: 24px;">
                    <a href="<?php echo esc_url( $admin_edit_url ); ?>" class="btn-action">View in WordPress Admin &rarr;</a>
                </div>
            </div>
            <div class="email-footer">
                This inquiry was submitted through Adam Studio. You can directly reply to this email to contact <?php echo esc_html( $name ); ?>.
            </div>
        </div>
    </body>
    </html>
    <?php
    $email_html = ob_get_clean();

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Adam Studio Leads <' . get_option( 'admin_email' ) . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );

    // Trigger wp_mail
    wp_mail( $admin_email, $email_subject, $email_html, $headers );

    // 7. Return Success Response
    wp_send_json_success( array(
        'message' => __( 'Thank you! Your project brief has been securely received. Our partners will review your vision and respond within 24 hours.', 'designs-ng' ),
        'lead_id' => $lead_id,
        'client'  => $name,
    ) );
}
add_action( 'wp_ajax_designs_submit_lead', 'designs_ng_handle_lead_submission' );
add_action( 'wp_ajax_nopriv_designs_submit_lead', 'designs_ng_handle_lead_submission' );
