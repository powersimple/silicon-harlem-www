<?php 
/**
 * The template for displaying tags.

 * @package Metrika
 */

get_header(); ?>

<div id="primary" class="inner-page content-area row-fluid pt-page pt-page-current outer-wrapper">
    <div class="container">
        <main id="main" class="site-main span8" role="main">
        <?php $page_object = get_queried_object(); ?>
<h1>Category: <?php echo $page_object->cat_name; ?></h1>
           
            

            <?= getPostsByCategory($page_object->slug); ?>
           


        </main><!-- #main -->
        <?php get_sidebar(); ?>
    </div>
</div><!-- #primary -->
<?php get_footer(); ?>

