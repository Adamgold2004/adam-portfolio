<?php
/**
 * Template Name: Elementor Full Width (Adam Studio)
 * Template Post Type: page, post, project, service
 *
 * A clean canvas with header and footer for full Elementor drag-and-drop design.
 *
 * @package designs-ng
 */

get_header();
?>

<main id="primary" class="site-main elementor-custom-page">
    <?php
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
    ?>
</main>

<?php
get_footer();
