<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Metrika
 */

get_header(); ?>

<div id="primary" class="content-area row-fluid">
    <div class="container">
        <div class="span9">
        <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', 'single' ); ?>

            <?php Metrika_content_nav( 'nav-below' ); ?>

            <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || '0' != get_comments_number() )
                    comments_template();
            ?>
        <?php endwhile; // end of the loop. ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div><!-- #primary -->
<?php get_footer(); ?>