<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Metrika
 */

get_header(); ?>

<div id="primary" class="inner-page content-area row-fluid">
    <div class="container">
        <main id="main" class="site-main span8" role="main">
            <h1>PRESS</h1>

            <?= getPress(); ?>
            


        </main><!-- #main -->
        <?php get_sidebar(); ?>
    </div>
</div><!-- #primary -->
<?php get_footer(); ?>

