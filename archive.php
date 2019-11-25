<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Metrika
 */

get_header(); ?>
<div class="row-fluid archive">
    <div class="container">
        <section id="primary" class="content-area span9">
            <main id="main" class="site-main blog-list" role="main">
                <?php if ( have_posts() ) : ?>
                    <?php
                    if (get_query_var('cat') !== '') {
                        $args = array(
                            'posts_per_page' => -1,
                            'cat'            => get_category(get_query_var('cat'))->term_id
                        );
                        global $query_string;
                        query_posts($args);
                    }
                    ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                    <?php endwhile; ?>
                    <div class="container blogpost-row">
                        <a class="load-more-btn load-more span9" href="#"><span class="figcap"></span><p>Load more</p></a>
                    </div>
                <?php else : ?>
                    <?php get_template_part( 'no-results', 'archive' ); ?>
                <?php endif; ?>
            </main><!-- #main -->
        </section><!-- #primary -->
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
