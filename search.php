<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Metrika
 */

get_header(); ?>

    <section id="primary" class="content-area row-fluid">
        <main id="main" class="site-main container" role="main">
            <div class="span9">
                <?php if ( have_posts() ) : ?>

                    <header>
                        <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'Metrika' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                    </header><!-- .page-header -->

                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'content', 'search' ); ?>

                    <?php endwhile; ?>

                    <?php Metrika_content_nav( 'nav-below' ); ?>

                <?php else : ?>

                    <?php get_template_part( 'no-results', 'search' ); ?>

                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>

        </main><!-- #main -->
    </section><!-- #primary -->
<?php get_footer(); ?>