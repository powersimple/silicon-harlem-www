<?php 
/**
 * The template for displaying press.
 
 */

get_header(); ?>

<div id="primary" class="inner-page content-area row-fluid pt-page pt-page-current">
    <div class="container">
        <main id="main" class="site-main span8" role="main">
            <h1>PRESS</h1>

            <?= getPostsByType("press"); ?>
           


        </main><!-- #main -->
        <?php get_sidebar(); ?>
    </div>
</div><!-- #primary -->
<?php get_footer(); ?>

