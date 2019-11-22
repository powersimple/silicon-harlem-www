<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Metrika
 */

get_header(); ?>


	<div class="row-fluid">
            <div class="container page-404">
                <div class="number pull-left">4</div><div class="number pull-left">0</div><div class="number pull-left">4</div>
                <div class="clearfix"></div>
                <p><?php echo __('Page Not Found', 'metrika') ?></p>
                <a href="<?php echo get_home_url(); ?>"><?php echo __('Go Home Page', 'metrika') ?></a>
            </div>
	</div><!-- #primary -->

<?php get_footer(); ?>