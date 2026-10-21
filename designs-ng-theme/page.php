<?php
/**
 * The template for displaying all pages
 *
 * @package designs-ng
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container" style="padding-top: calc(var(--header-height) + 40px); padding-bottom: 80px;">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header" style="margin-bottom: 40px;">
                    <h1 class="entry-title" style="font-size: clamp(32px, 5vw, 56px);"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content" style="color: var(--text-secondary); line-height: 1.8;">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
