<?php 
/**
 * The template for tags

 */

get_header(); ?>

<div id="primary" class="inner-page content-area row-fluid pt-page pt-page-current outer-wrapper">
    <div class="container">
        <main id="main" class="site-main span8" role="main">
        <?php $page_object = get_queried_object(); ?>
<h2>Tag: <?php echo $page_object->name; ?></h2>

            <?php
               
            getPostsByTag($page_object->slug); 
            ?>
           


        </main><!-- #main -->
        <?php get_sidebar(); ?>
    </div>
</div><!-- #primary -->
<?php get_footer(); ?>

