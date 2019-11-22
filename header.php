<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Metrika
 */
?><!DOCTYPE html>

<?php
$other = get_option('other_options');
$metrika_options = get_option('metrika_theme_options');
if (empty($metrika_options) && !$metrika_options['menu_type']) $metrika_options['menu_type'] = 'yes';
if (empty($metrika_options) || ($metrika_options['menu_type'] == 'no'))
    $metrika_type = false;
else
    $metrika_type = true;
?>

<?php if (!$metrika_type) : ?>
    <html <?php language_attributes(); ?>>
<?php else : ?>
    <html <?php language_attributes(); ?> style="margin-top: 0!important;">
<?php endif; ?>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php if ($other['favicon']) : ?>
    <link rel="shortcut icon" href="<?php echo wp_get_attachment_url($other['favicon']) ?>" type="image/x-icon" />
<?php endif; ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<?php
$color = '#d06e39';
$preloader = '#0fa2cb';
if (!$metrika_type){
    if (isset($metrika_options['color'])) {
        $color = $metrika_options['color'];
    } else {
        $color = '#d06e39';
    }
    $overflow = 'style="overflow: auto;"';
} else {
    $overflow = 'style="overflow: hidden;"';
    if (!empty($other['preloader_color'])) {
        $preloader = $other['preloader_color'];
    } else {
        $preloader = '#0fa2cb';
    }
}
if ($other['link_color'] != '#ffffff') {
    echo "<style>
        a, a:active, a:visited {color: " . $other['link_color'] . "}
        </style>";
}
?>
<style>
    <?php if ($color !== '#d06e39') : ?>
        .comments-icon{
            display: none;
        }
    <?php endif; ?>
    input::-webkit-input-placeholder {color: <?php echo $color; ?>;}
    input:-moz-placeholder {color: <?php echo $color; ?>;}
    input::-moz-placeholder {color: <?php echo $color; ?>;}
    input:-ms-input-placeholder {color: <?php echo $color; ?>;}
    textarea::-webkit-input-placeholder {color: <?php echo $color; ?>;}
    textarea:-moz-placeholder {color: <?php echo $color; ?>;}
    textarea::-moz-placeholder {color: <?php echo $color; ?>;}
    textarea:-ms-input-placeholder {color: <?php echo $color; ?>;}
    #primary .blog-list article:hover *,
    #primary .team-mate:hover > a h2,
    #primary .team-mate.expanded > a h2,
    #primary .team-mate.expanded > a h3,
    #primary .team-mate:hover > a h3,
    .resume a,
    #primary .blogpost-row .span6:hover p,
    a.load-more-btn:hover > p{
        color: <?php echo $color; ?>;
    }
    #primary .works_item .link:hover,
    #site-navigation li.current-menu-item > a{
        border-color: <?php echo $color; ?>;
    }
    select,
    textarea,
    input[type="email"],
    input[type="text"],
    input[type="password"],
    input[type="datetime"],
    input[type="datetime-local"],
    input[type="date"],
    input[type="month"],
    input[type="time"],
    input[type="week"],
    input[type="number"],
    input[type="email"],
    input[type="url"],
    input[type="search"],
    input[type="tel"],
    input[type="color"],
    .uneditable-input,
    input[type=submit],
    #site-navigation .menu > li a,
    #site-navigation .menu > ul li a,
    a.blogpost:hover > h2,
    a.blogpost:hover > .post-meta,
    a.blogpost:hover > p{
        color: <?php echo $color; ?>;
    }
    #primary .works_item .link,
    .default-footer,
    .archive,
    #primary,
    .sub-header,
    .menu-icon > div,
    body{
        background-color: <?php echo $color; ?>;
    }
</style>
<body <?php body_class(); echo $overflow;?>>
    <?php if (!empty($other['preloader']) && $other['preloader'] == 'true') :  ?>
    <div id="preloader">
        <div id="canvasloader-container" class="wrapper"></div>
        <script type="text/javascript">
            var cl = new CanvasLoader('canvasloader-container');
            cl.setColor('<?php echo $preloader; ?>'); // default is '#000000'
            cl.setShape('spiral'); // default is 'oval'
            cl.setDiameter(150); // default is 40
            cl.setDensity(15); // default is 40
            cl.setRange(1.4); // default is 1.3
            cl.setSpeed(1); // default is 2
            cl.setFPS(18); // default is 24
            cl.show(); // Hidden by default

            // This bit is only for positioning - not necessary
              var loaderObj = document.getElementById("canvasLoader");
            loaderObj.style.position = "absolute";
            loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
            loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
        </script>
    </div>
    <?php endif; ?>
    <?php do_action( 'before' ); ?>
    <?php $logo = get_option('logo'); ?>
    <div id="logo" class="container">
        <a href="#" onclick="gotoPage(0, 56);">
    <?php if ($logo['logo_type'] == 'text') : ?>
        <h1 class="dark"><?php echo $logo['logo_text'] ?></h1>
    <?php else : ?>
        <?php echo wp_get_attachment_image($logo['logo_img'], 'full'); ?>
    <?php endif; ?>
    </a>
    <?php $buttons = get_option('header_social_buttons') ?>
                    <?php if (!empty($buttons)) : ?>
                        <?php $style_a = '' ?>
                        <?php $style_i = '' ?>
                        <?php if (empty($buttons['home_icon_color_type'])) $buttons['home_icon_color_type'] = 'black' ?>
                        <?php if ($buttons['home_icon_color_type'] == 'black') : ?>
                            <ul class="social-bar-black">
                        <?php elseif ($buttons['home_icon_color_type'] == 'white') : ?>
                            <ul class="social-bar-white">
                        <?php elseif ($buttons['home_icon_color_type'] == 'custom') : ?>
                            <ul class="social-bar-black">
                            <?php if (empty($buttons['home_icon_color'])) $buttons['home_icon_color'] = '#50b28a' ?>
                            <?php $style_a = "style='border-color: " . $buttons['home_icon_color'] . "'" ?>
                            <?php $style_i = "style='color: " . $buttons['home_icon_color'] . "'" ?>
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
                    </div>
    </div>
    <?php if (!$metrika_type) : ?>
        <div>
            <header id="masthead" class="site-header row-fluid" role="banner">
                <div class="container">
                    <div class="span3 logo">
                    <a class="home-page page-transition" href="#home" onclick="gotoPage(0, <?php echo $header_options['home_animation'] ?>)" title="<?php _e('Go Home', 'metrika') ?>">
                        
                        <?php if (!empty($metrika_options) && array_key_exists('logo', $metrika_options) && !empty($metrika_options['logo'])) : ?>
                            <img src="<?php echo $metrika_options['logo']; ?>">
                        <?php else : ?>
                        <?php
                        if (!empty($metrika_options) && array_key_exists('logo_text', $metrika_options) && !empty($metrika_options['logo_text'])) {
                            echo '<h1 class="dark">' . $metrika_options['logo_text'] . '</h1>';
                        }
                        ?>
                        <?php endif; ?>
                        </a>
                    </div>
                    <div class="span9">
                        <div class="menu-icon">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                        </nav>
                    </div>
                </div>
            </header>
            <?php
            $page_title = '';
            if (@get_the_ID() !== NULL) {
                $current_post = get_post(get_the_ID());
                $page_title = $current_post->post_title;
            } else
                $page_title = '';
            if (is_front_page())
                $page_title = __('Home', 'metrika');
            elseif (is_archive()) {
                if (get_query_var('cat') !== '')
                    $page_title = get_category(get_query_var('cat'))->name;
            }
            ?>
            <div class="sub-header row-fluid">
                <div class="container">
                    <div class="span9">
                        <h1><?php echo $page_title; ?></h1>
                    </div>
                    <div class="span3">
                        <ul class="social-bar-white">
                            <?php $metrika_page_options = get_option('theme_metrika_options'); ?>
                            <?php
                            if (!empty($metrika_page_options) && array_key_exists('header_social', $metrika_page_options) && !empty($metrika_page_options['header_social'])) {
                                echo do_shortcode($metrika_page_options['header_social']);
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
    <?php else : ?>
        <div id="pt-main" class="pt-perspective">
            <style>
                body{
                    background-color:#333;
                }
            </style>
    <?php endif; ?>
    