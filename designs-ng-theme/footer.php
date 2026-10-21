<?php
/**
 * The template for displaying the footer
 *
 * Fully integrates with Elementor Theme Builder with custom fallback.
 * Links to full dedicated pages.
 *
 * @package designs-ng
 */
?>
    </div><!-- #content -->

    <?php
    // Elementor Theme Builder Footer Hook
    if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) :
    ?>
    <footer id="colophon" class="site-footer gsap-footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-col footer-brand">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo footer-logo" rel="home">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="site-logo-img footer-logo-img" width="204" height="31">
                    </a>
                    <p>
                        <?php esc_html_e( 'We harness the power of creativity to design amazing brand experiences that turn your vision into a story people see, feel, and love.', 'designs-ng' ); ?>
                    </p>
                </div>

                <div class="footer-col">
                    <h4><?php esc_html_e( 'Navigation', 'designs-ng' ); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/who-we-are/' ) ); ?>"><?php esc_html_e( 'Who We Are', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Our Services', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/portfolio/' ) ); ?>"><?php esc_html_e( 'Portfolio', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/start-project/' ) ); ?>"><?php esc_html_e( 'Start Your Project', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'designs-ng' ); ?></a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4><?php esc_html_e( 'Capabilities', 'designs-ng' ); ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Branding & Identity', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Website Development', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'UI/UX Product Design', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'App Engineering', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Architecture & Interior', 'designs-ng' ); ?></a></li>
                        <li><a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"><?php esc_html_e( 'Bespoke Souvenirs', 'designs-ng' ); ?></a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h4><?php esc_html_e( 'Studio Headquarters', 'designs-ng' ); ?></h4>
                    <ul class="footer-links">
                        <li style="color: var(--text-secondary); line-height: 1.6;">
                            Abuja, Nigeria
                        </li>
                        <li style="margin-top: 14px;">
                            <a href="mailto:contact@designs.ng" style="color: var(--accent-green); font-weight: 400; letter-spacing: 0.02em;">
                                contact@designs.ng
                            </a>
                        </li>
                        <li style="margin-top: 8px;">
                            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color: var(--text-muted);">
                                View Studio Location &rarr;
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date( 'Y' ); ?> Adam Studio. <?php esc_html_e( 'All rights reserved.', 'designs-ng' ); ?></p>
                <p style="color: var(--text-muted); font-size: 13px;">
                    <?php esc_html_e( 'Abuja, Nigeria • Global Creative Agency', 'designs-ng' ); ?>
                </p>
            </div>
        </div>
    </footer>
    <?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
