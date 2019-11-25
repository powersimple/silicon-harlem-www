<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Metrika
 */

get_header(); ?>

<?php
echo '<script>var comment_url = "' . get_template_directory_uri() .'/ajax_comment.php";</script>';
$metrika_options = get_option('metrika_theme_options');
?>

<?php if (!$metrika_options['menu_type']) $metrika_options['menu_type'] = 'yes'; ?>

<?php if ($metrika_options['menu_type'] == 'yes') : ?>
<?php $home_bg = get_option('home_bg'); ?>
    <article class="pt-page pt-page-0" originalClassList="pt-page pt-page-0" id="home">
    <?php if (!empty($home_bg)) : ?>
        <?php if (empty($home_bg['home_bg_type'])) $home_bg['home_bg_type'] = 'color' ?>
        <?php if ($home_bg['home_bg_type'] == 'color' && !empty($home_bg['home_bg_color'])) : ?>
            <div class="outer-wrapper" style="background-color: <?php echo $home_bg['home_bg_color'] ?>">
        <?php elseif (!empty($home_bg['home_bg_image'])) : ?>
            <div class="outer-wrapper" style="background-image: url(<?php echo wp_get_attachment_url($home_bg['home_bg_image']) ?>)">
        <?php else : ?>
            <div class="outer-wrapper white-bg">
        <?php endif; ?>
    <?php else : ?>
        <div class="outer-wrapper white-bg">
    <?php endif; ?>
          
            <!--Navigation-->
            <section class="container home-slide">
            <?php homeMenu() ?>
            <?php $block = get_option('bottom_block'); ?>
            <?php if (!empty($block) && $block['block_type'] != 'none') : ?>
                <?php if ($block['block_type'] == 'twit') : ?>
                    <?php if (!empty($block['twitter_user'])) echo do_shortcode("[get_latest_tweets username='" . $block['twitter_user'] . "']") ?>
                <?php else : ?>
                    <div class="clearfix">
                        <div class="tw-feed">
                            <p><?php if (!empty($block['custom_text'])) echo do_shortcode($block['custom_text']) ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            </section>
            <!--Footer-->
            <footer>
                <div class="container">
                <?php $copyright = get_option('copyright'); ?>
                <?php if (!empty($copyright['copyright'])) : ?>
                    <?php if (!empty($copyright['auto_date']) && $copyright['auto_date'] == 'true') $date = date('Y') ?>
                    <?php if (empty($copyright['home_copyright_type'])) $copyright['home_copyright_type'] = 'black' ?>
                    <?php if ($copyright['home_copyright_type'] == 'black') : ?>
                        <p class="dark"><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                    <?php elseif ($copyright['home_copyright_type'] == 'white') : ?>
                        <p><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                    <?php else : ?>
                        <?php if (empty($copyright['home_copyright_color'])) $copyright['home_copyright_color'] = '#50b28a' ?>
                        <p style="color: <?php echo $copyright['home_copyright_color'] ?>"><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                    <?php endif; ?>
                <?php endif; ?>
                </div>
            </footer>
        </div> 
    </article>
<?php $metrika_menu = get_option('metrika_menu'); ?>
<?php if (!empty($metrika_menu)) : ?>
    <?php $page_namber = 0 ?>
    <?php
    $pages = array();
    foreach($metrika_menu as $key => $item) {
        if (!empty($item['page_id']) && (empty($item['tile_type']) or $item['tile_type'] == 'page') && !empty($item['page_id']))
            $pages[$key] = $item;
    }
    ?>
    <?php $blog_page = get_option('blog_page'); ?>
    <?php if (empty($blog_page)) $blog_page = 0 ?>
    <?php foreach($metrika_menu as $key => $item) : ?>
        <?php if (empty($item['color'])) $item['color'] = '#50b28a' ?>
        <?php if (!empty($item['page_id']) && (empty($item['tile_type']) or $item['tile_type'] == 'page') && !empty($item['page_id'])) : ?>
            <?php if ($blog_page == $item['page_id']) : ?>
                <?php $blog = 'blog-page-list'; ?>
                <?php $blog_container = 'blogpost-row'; ?>
            <?php else : ?>
                <?php $blog = ''; ?>
                <?php $blog_container = ''; ?>
            <?php endif; ?>
        <?php $post = get_post($item['page_id']); ?>
        <?php $bg_id = get_post_thumbnail_id($item['page_id']) ?>
        <?php $bg = wp_get_attachment_url($bg_id) ?>
        <?php !empty($bg) ? $style = 'style="background: url(' . $bg . ') no-repeat 50% 50%;"' : $style = ''?>
        <article class="<?php echo $blog ?> pt-page pt-page-<?php echo ++$page_namber ?>" 
                 id="<?php echo $post->post_name ?>"
                 originalClassList="pt-page pt-page-<?php echo $page_namber ?> <?php echo $blog ?>"
                 <?php echo $style ?>>
                 <style>
                .pt-page-<?php echo $page_namber ?> .team-mate:hover > a h2,
                .pt-page-<?php echo $page_namber ?> .team-mate.expanded > a h2,
                .pt-page-<?php echo $page_namber ?> .team-mate.expanded > a h3,
                .pt-page-<?php echo $page_namber ?> .team-mate:hover > a h3,
                .pt-page-<?php echo $page_namber ?> .portfolio-toolbar li.active,
                .pt-page-<?php echo $page_namber ?> .portfolio-toolbar li:hover,
                .pt-page-<?php echo $page_namber ?> .og-grid > li a:hover > h2,
                .pt-page-<?php echo $page_namber ?> .og-grid > li a:hover > h3,
                .pt-page-<?php echo $page_namber ?> .og-grid > li.og-expanded a > h2,
                .pt-page-<?php echo $page_namber ?> .og-grid > li.og-expanded a > h3,
                .pt-page-<?php echo $page_namber ?> .og-details a.work_link,
                .pt-page-<?php echo $page_namber ?> .og-details a.program_link,
                .pt-page-<?php echo $page_namber ?> .og-details a.event_link,
                
                .pt-page-<?php echo $page_namber ?> a.blogpost:hover > h2,
                .pt-page-<?php echo $page_namber ?> a.blogpost:hover > .post-meta,
                .pt-page-<?php echo $page_namber ?> a.blogpost:hover > p,
                .pt-page-<?php echo $page_namber ?> a.load-more-btn:hover > p,
                .pt-page-<?php echo $page_namber ?> input[type=submit],
                .pt-page-<?php echo $page_namber ?> textarea,
                .pt-page-<?php echo $page_namber ?> input[type="text"],
                .pt-page-<?php echo $page_namber ?> input[type="email"] {
                    color: <?php echo $item['color'] ?>;
                }
                .pt-page-<?php echo $page_namber ?> input::-webkit-input-placeholder {color: <?php echo $item['color'] ?>;}
                .pt-page-<?php echo $page_namber ?> input:-moz-placeholder {color: <?php echo $item['color'] ?>;}
                .pt-page-<?php echo $page_namber ?> input::-moz-placeholder {color: <?php echo $item['color'] ?>;}
                .pt-page-<?php echo $page_namber ?> input:-ms-input-placeholder {color: <?php echo $item['color'] ?>;}
                .pt-page-<?php echo $page_namber ?> textarea::-webkit-input-placeholder {color: <?php echo $item['color'] ?>;}
                .pt-page-<?php echo $page_namber ?> textarea:-moz-placeholder {color: <?php echo $item['color'] ?>;}
                .pt-page-<?php echo $page_namber ?> textarea::-moz-placeholder {color: <?php echo $item['color'] ?>;}
                .pt-page-<?php echo $page_namber ?> textarea:-ms-input-placeholder {color: <?php echo $item['color'] ?>;}
                .pt-page-<?php echo $page_namber ?> .og-details a.work_link:hover,
                .pt-page-<?php echo $page_namber ?> .og-details a.work_link:active,
                .pt-page-<?php echo $page_namber ?> .og-details a.program_link:hover,
                .pt-page-<?php echo $page_namber ?> .og-details a.program_link:active,
                .pt-page-<?php echo $page_namber ?> .og-details a.event_link:hover,
                .pt-page-<?php echo $page_namber ?> .og-details a.event_link:active  {
                    background-color: <?php echo $item['color'] ?>;
                }
                </style>
                 <?php if (!empty($bg)) : ?>
                    <?php $rgb = hex2rgb($item['color']) ?>
                    <div class="outer-wrapper" style="background-color: rgba(<?php echo $rgb[0] ?>, <?php echo $rgb[1] ?>, <?php echo $rgb[2] ?>, .8);">
                 <?php else : ?>
                    <div class="outer-wrapper" style="background-color: <?php echo $item['color'] ?>;">
                 <?php endif; ?>
                <!--Header-->
                <?php
                $prevPage = $page_namber;
                if ($prevPage == 1)
                    $prevPage = count($pages);
                else
                    $prevPage = $page_namber - 1;
                $nextPage = $page_namber + 1;
                if ($nextPage > count($pages))
                    $nextPage = 1;
                
                ?>
                <header class="nav-header row-fluid">
                    <div class="container">
                        <div class="span8 relative">
                        <?php $header_options = get_option('page_header_options') ?>
                            <div class="page-navi">
                            <?php if (empty($header_options['home_button'])) $header_options['home_button'] = 'true' ?>
                            <?php if (empty($header_options['prev_button'])) $header_options['prev_button'] = 'true' ?>
                            <?php if ($header_options['home_button'] == 'true') : ?>
                                <?php if (!empty($header_options['home_animation']) && $header_options['home_animation'] != '0') : ?>
                                    <a class="home-page page-transition" href="#home" onclick="gotoPage(0, <?php echo $header_options['home_animation'] ?>)" title="<?php _e('Go Home', 'metrika') ?>"></a>
                                <?php else : ?>
                                    <a class="home-page page-transition" href="#home" onclick="gotoPage(0, 6)" title="<?php _e('Go Home', 'metrika') ?>"></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ($header_options['prev_button'] == 'true') : ?>
                                <?php if (!empty($header_options['prev_animation']) && $header_options['prev_animation'] != '0') : ?>
                                    <a page="<?php echo $prevPage ?>" class="prev-page page-transition" href="#" onclick="gotoPage(<?php echo $prevPage ?>, <?php echo $header_options['prev_animation'] ?>)" title="<?php _e('Go To Previous Page', 'metrika') ?>"></a>
                                <?php else : ?>
                                    <a page="<?php echo $prevPage ?>" class="prev-page page-transition" href="#" onclick="gotoPage(<?php echo $prevPage ?>, 2)" title="<?php _e('Go To Previous Page', 'metrika') ?>"></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if (!empty($header_options) && $header_options['next_button'] == 'true') : ?>
                                <?php if (!empty($header_options['next_animation']) && $header_options['next_animation'] != '0') : ?>
                                    <a page="<?php echo $nextPage ?>" class="next-page page-transition" href="#" onclick="gotoPage(<?php echo $nextPage ?>, <?php echo $header_options['next_animation'] ?>)" title="<?php _e('Go To Next Page', 'metrika') ?>"></a>
                                <?php else : ?>
                                    <a page="<?php echo $nextPage ?>" class="next-page page-transition" href="#" onclick="gotoPage(<?php echo $nextPage ?>, 1)" title="<?php _e('Go To Next Page', 'metrika') ?>"></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            </div>
                            <h1><?php echo $post->post_title ?></h1>
                            <?php subMenu($item['page_id']) ?>
                        </div>
                        <div class="span4">
                            <!--
                        <?php $buttons = get_option('header_social_buttons') ?>
                        <?php if (!empty($buttons)) : ?>
                            <?php $style_a = '' ?>
                            <?php $style_i = '' ?>
                            <?php if (empty($buttons['page_icon_color_type'])) $buttons['page_icon_color_type'] = 'black' ?>
                            <?php if ($buttons['page_icon_color_type'] == 'black') : ?>
                                <ul class="social-bar-black">
                            <?php elseif ($buttons['page_icon_color_type'] == 'white') : ?>
                                <ul class="social-bar-white">
                            <?php elseif ($buttons['page_icon_color_type'] == 'custom') : ?>
                                <ul class="social-bar-black">
                                <?php if (empty($buttons['page_icon_color'])) $buttons['page_icon_color'] = '#50b28a' ?>
                                <?php $style_a = "style='border-color: " . $buttons['page_icon_color'] . "'" ?>
                                <?php $style_i = "style='color: " . $buttons['page_icon_color'] . "'" ?>
                            <?php else : ?>
                                <ul class="social-bar-black">
                            <?php endif; ?>
                            <?php if (!empty($buttons['icons'])) : ?>
                                <?php foreach ($buttons['icons'] as $item) {
                                    echo '<li><a ' . $style_a . ' href="' . $item['url'] . '" target="_blank"><i ' . $style_i . ' class="fa fa-' . $item['type'] . '"></i></a></li>';
                                } ?>
                            <?php endif; ?>
                            </ul>
                        <?php endif; ?>
                            -->
                        </div>
                    </div>
                </header>
                <!--Content-->
                <section class="row-fluid interior">
                    <div class="container <?php echo $blog_container ?>">
                         <?php echo apply_filters('the_content', $post->post_content); ?>
                    </div>
                </section>
                <!--Footer-->
                <footer>
                    <div class="container">
                    <?php $copyright = get_option('copyright'); ?>
                    <?php if (!empty($copyright['copyright'])) : ?>
                        <?php if (!empty($copyright['auto_date']) && $copyright['auto_date'] == 'true') $date = date('Y') ?>
                        <?php if (empty($copyright['page_copyright_type'])) $copyright['page_copyright_type'] = 'black' ?>
                        <?php if ($copyright['page_copyright_type'] == 'black') : ?>
                            <p class="dark"><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                        <?php elseif ($copyright['page_copyright_type'] == 'white') : ?>
                            <p><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                        <?php else : ?>
                            <?php if (empty($copyright['page_copyright_color'])) $copyright['page_copyright_color'] = '#50b28a' ?>
                            <p style="color: <?php echo $copyright['page_copyright_color'] ?>"><?php echo $copyright['copyright'] ?> <?php echo $date ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                    </div>
                </footer>
            </div>
        </article>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php else : ?>
<div id="primary" class="content-area row-fluid">
    <main id="main" class="site-main container" role="main">
        <div class="span9 blog-list">
            <script>var post_count = <?php echo get_option('posts_per_page'); ?>;</script>
            <?php if ( have_posts() ) : ?>
                <?php
                global $query_string;
                query_posts ('posts_per_page=-1');
                ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'content', get_post_format() ); ?>
                <?php endwhile; ?>
                <div class="container blogpost-row">
                    <a class="load-more-btn load-more span9" href="#"><span class="figcap"></span><p>Load more</p></a>
                </div>
            <?php else : ?>
                <?php get_template_part( 'no-results', 'index' ); ?>
            <?php endif; ?>
        </div>
        <?php get_sidebar(); ?>
    </main><!-- #main -->
</div><!-- #primary -->
<?php endif; ?>
<?php get_footer(); ?>