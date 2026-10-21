<?php
/**
 * The template for displaying single project case studies
 *
 * Fully integrated with Elementor Theme Builder single location.
 *
 * @package designs-ng
 */

get_header();

// Check if Elementor Theme Builder is handling the single template
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) :

    while ( have_posts() ) :
        the_post();

        $client     = get_post_meta( get_the_ID(), '_project_client', true ) ?: 'Adam Studio Partner';
        $year       = get_post_meta( get_the_ID(), '_project_year', true ) ?: '2025';
        $short_desc = get_post_meta( get_the_ID(), '_project_short_desc', true ) ?: get_the_excerpt();
        $url        = get_post_meta( get_the_ID(), '_project_url', true );
        $cats       = get_the_terms( get_the_ID(), 'project_category' );
        $cat_names  = array();
        if ( ! empty( $cats ) && ! is_wp_error( $cats ) ) {
            foreach ( $cats as $c ) {
                $cat_names[] = $c->name;
            }
        }
        $cat_str = ! empty( $cat_names ) ? implode( ', ', $cat_names ) : 'Creative Case Study';
        ?>

        <main id="primary" class="site-main">
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-project-article' ); ?>>

                <!-- Project Hero Header -->
                <header class="single-project-hero">
                    <div class="container">
                        <div style="margin-bottom: 24px;">
                            <a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" style="display: inline-flex; align-items: center; gap: 8px; color: var(--text-muted); font-size: 14px; font-weight: 400; letter-spacing: 0.02em;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                                <span><?php esc_html_e( 'Back to All Projects', 'designs-ng' ); ?></span>
                            </a>
                        </div>

                        <div class="section-tag">
                            <span><?php echo esc_html( $cat_str ); ?></span>
                        </div>

                        <h1 class="section-title" style="font-size: clamp(24px, 5.5vw, 68px); font-weight: 400; letter-spacing: 0.02em; line-height: 1.2; max-width: 900px; margin-bottom: 24px; overflow-wrap: break-word;">
                            <?php the_title(); ?>
                        </h1>

                        <?php if ( ! empty( $short_desc ) ) : ?>
                            <p style="font-size: clamp(14.5px, 1.8vw, 21px); font-weight: 400; color: var(--text-secondary); max-width: 800px; line-height: 1.75; letter-spacing: 0.015em; margin-bottom: 36px;">
                                <?php echo esc_html( $short_desc ); ?>
                            </p>
                        <?php endif; ?>

                        <!-- Metadata Grid -->
                        <div class="project-meta-grid">
                            <div class="meta-block">
                                <span><?php esc_html_e( 'Client', 'designs-ng' ); ?></span>
                                <strong style="font-weight: 400; letter-spacing: 0.02em;"><?php echo esc_html( $client ); ?></strong>
                            </div>
                            <div class="meta-block">
                                <span><?php esc_html_e( 'Timeline / Year', 'designs-ng' ); ?></span>
                                <strong style="font-weight: 400; letter-spacing: 0.02em;"><?php echo esc_html( $year ); ?></strong>
                            </div>
                            <div class="meta-block">
                                <span><?php esc_html_e( 'Discipline', 'designs-ng' ); ?></span>
                                <strong style="font-weight: 400; letter-spacing: 0.02em;"><?php echo esc_html( $cat_str ); ?></strong>
                            </div>
                            <div class="meta-block">
                                <span><?php esc_html_e( 'Live Experience', 'designs-ng' ); ?></span>
                                <?php if ( ! empty( $url ) ) : ?>
                                    <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" style="color: var(--accent-green); font-weight: 400; letter-spacing: 0.02em; display: inline-flex; align-items: center; gap: 4px;">
                                        <span><?php esc_html_e( 'Launch Site', 'designs-ng' ); ?></span>
                                        <?php echo designs_ng_get_svg( 'arrow-up-right' ); ?>
                                    </a>
                                <?php else : ?>
                                    <strong style="color: var(--text-muted); font-weight: 400;"><?php esc_html_e( 'Private Showcase', 'designs-ng' ); ?></strong>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Featured Media Banner -->
                        <div class="project-featured-banner">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'designs-project-hero' ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( designs_ng_get_project_image_url( get_the_ID() ) ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                    </div>
                </header>

                <!-- Project Body Content -->
                <div class="container">
                    <div class="project-body-content">
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Next / Previous Navigation -->
                <div class="container">
                    <div class="project-navigation-bar">
                        <div class="project-nav-item project-nav-prev">
                            <?php
                            $prev_post = get_previous_post();
                            if ( ! empty( $prev_post ) ) :
                                ?>
                                <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="project-nav-link">
                                    <span class="project-nav-sub">&larr; <?php esc_html_e( 'Previous Case Study', 'designs-ng' ); ?></span>
                                    <strong class="project-nav-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></strong>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="project-nav-item project-nav-next">
                            <?php
                            $next_post = get_next_post();
                            if ( ! empty( $next_post ) ) :
                                ?>
                                <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="project-nav-link">
                                    <span class="project-nav-sub"><?php esc_html_e( 'Next Case Study', 'designs-ng' ); ?> &rarr;</span>
                                    <strong class="project-nav-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></strong>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </article>
        </main>

        <?php
    endwhile;

endif;

get_footer();
