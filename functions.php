<?php
/**
 * Metrika functions and definitions
 *
 * @package Metrika
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
    $content_width = 640; /* pixels */

if ( ! function_exists( 'Metrika_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function Metrika_setup() {

    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     * If you're building a theme based on Metrika, use a find and replace
     * to change 'Metrika' to the name of your theme in all the template files
     */
    load_theme_textdomain( 'Metrika', get_template_directory() . '/languages' );

    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support( 'automatic-feed-links' );

    /**
     * Enable support for Post Thumbnails on posts and pages
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );
    add_image_size('team', '278', '210', true);
    add_image_size('works-small', '298', '220', true);
    add_image_size('works-large', '439', '446', true);

    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'Metrika' ),
    ) );

}
endif; // Metrika_setup
add_action( 'after_setup_theme', 'Metrika_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function Metrika_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'Metrika' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'Metrika_widgets_init' );

/**
 * Enqueue scripts and styles
 */
    /**
     *  Add IE conditional html5 shim to header
     */
function wps_add_ie_style() {
    global $is_IE;
    if ( $is_IE ) {
        echo '<!--[if lt IE 8]>';
        echo '<link href="' . get_template_directory_uri() . '/css/ie8.css" rel="stylesheet" media="screen">';
        echo '<![endif]-->';
    }
}
add_action( 'wp_head', 'wps_add_ie_style' );

function font_head() {
    $other = get_option('other_options');
    $fonts = Metrika_google_fonts();
    $body_key = 'open_sans';

    if ($other['font'])
        $body_key = $other['font'];

    if ( isset( $fonts[ $body_key ] ) ) {
        $body_font = $fonts[ $body_key ];

        echo '<style>';
        echo $body_font['font'];
        echo 'body, .container, .quotation, footer, h1, 
                h2, h3, h4, h5, h6, a, a:active, a:visited, 
                #site-navigation .menu > li a,
                 #site-navigation .menu > ul li a, 
                 #secondary aside h1, #secondary aside a, 
                 #primary .recentcomments, #primary article, 
                 #primary article .entry-content, 
                h2.comments-title, #primary .comment-form p, 
                #primary *,
                .gridster li .title{ ' . $body_font['css'] . ' }; ';
        echo '</style>';
    }
}
add_action( 'wp_head', 'font_head' );

function Metrika_scripts() {
    
    wp_register_style( 'Metrika-icon-font', get_template_directory_uri() . '/css/font-awesome.min.css', array(), false );
    wp_register_style( 'Metrika-custom', get_template_directory_uri() . '/css/custom.css', array(), false );
//BOOTSTRAP 4 messes up metrika
//    wp_register_style( 'Metrika-bootstrap', get_template_directory_uri() . '/css/bootstrap.4.3.1.css', array(), false );
    wp_register_style( 'Metrika-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), false );
   
    
    wp_register_style( 'Metrika-animations', get_template_directory_uri() . '/css/animations.css', array(), false );
    wp_register_style( 'Metrika-wp-style', get_template_directory_uri() . '/css/wp-style.css', array(), false );
    wp_register_style( 'Metrika-bootstrap-js-css', get_template_directory_uri() . '/css/bootstrap-js-css.css', array(), false );
    wp_enqueue_style( 'Metrika-style', get_stylesheet_uri(), array('Metrika-bootstrap', 'Metrika-custom', 'Metrika-animations', 'Metrika-icon-font', 'Metrika-wp-style', 'Metrika-bootstrap-js-css'), false );

    wp_register_script('Metrika-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array(), false, false);
    wp_register_script('Metrika-pagetransitions', get_template_directory_uri() . '/js/pagetransitions.js', array(), false, true);
    wp_register_script('Metrika-validation', get_template_directory_uri() . '/js/validation.js', array(), false, true);
    wp_register_script('Metrika-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false, true);
    wp_register_script('Metrika-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), false, true);
    wp_register_script('Metrika-carousel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array(), false, true);
    wp_register_script('Metrika-hashchange', get_template_directory_uri() . '/js/jquery.ba-hashchange.min.js', array(), false, true);
    wp_register_script('gridster', get_template_directory_uri() . '/js/jquery.gridster.min.js', array(), false, true);
    wp_register_script('mixitup', get_template_directory_uri() . '/js/jquery.mixitup.min.js', array(), false, true);
    wp_register_script('scroll', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array(), false, true);
    wp_register_script('heartcode',  get_template_directory_uri() .'/js/heartcode-canvasloader.js', array(), false, true);

    

    if( !is_admin()){
        wp_register_script('jquery-migrate', ("http://code.jquery.com/jquery-migrate-1.2.1.min.js"), false, false, true);
        wp_enqueue_script('jquery');
    }

    wp_enqueue_script( 'Metrika_Ajax', get_template_directory_uri() . '/js/ajax-posts.js', array(), false, true );
    $work_full = '<div class="full_container">';
    $work_full .= '<div class="full_bg"></div>';
    $work_full .= '
        <div id="work-loader" class="wrapper"></div>
        <script src="http://heartcode-canvasloader.googlecode.com/files/heartcode-canvasloader-min-0.9.1.js"></script>
        <script type="text/javascript">
            setTimeout(function() {
                var cl = new CanvasLoader("work-loader");
                cl.setColor("#0fa2cb");
                cl.setShape("spiral");
                cl.setDiameter(150);
                cl.setDensity(15);
                cl.setRange(1.4);
                cl.setSpeed(1);
                cl.setFPS(18);
                cl.show();
                var loaderObj = document.getElementById("canvasLoader");
                loaderObj.style.position = "absolute";
                loaderObj.style["top"] = cl.getDiameter() * -0.5 + "px";
                loaderObj.style["left"] = cl.getDiameter() * -0.5 + "px";
            }, 10);
        </script>';
    $work_full .= '</div>';
    wp_localize_script( 'Metrika_Ajax', 'Metrika_Ajax', array(
        'ajax_posts_url' => admin_url( 'admin-ajax.php' ),
        'work_full'      => $work_full,
        'site_url'       => site_url(),
        'sending'        => __('Sending', 'metrika'),
        ));

    wp_enqueue_script('Metrika-script', 
        get_template_directory_uri() . '/js/scripts.js', 
        array('Metrika-modernizr', 
            'jquery-migrate', 
            'Metrika-pagetransitions', 
            'Metrika-validation', 
            'jquery-masonry', 
            'jquery-ui-accordion', 
            'jquery-ui-tabs', 
            'Metrika-easing', 
            'Metrika-carousel', 
            'Metrika-hashchange', 
            'gridster', 
            'mixitup', 
            'scroll',
            'heartcode'), 
        false, 
        true );

    wp_enqueue_script( 'Metrika-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
    wp_enqueue_script( 'Metrika-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    wp_register_script('main',get_stylesheet_directory_uri() . '/main.min.js', array('jquery'),rand(100000,999999), true); 
    wp_enqueue_script('main',true);
    

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
            wp_enqueue_script( 'Metrika-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array(), '20120202' );
    }

}
add_action( 'wp_enqueue_scripts', 'Metrika_scripts' );

function mytheme_fonts() {
    $protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'metrika-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans" );
}
add_action( 'wp_enqueue_scripts', 'mytheme_fonts' );

/**
 * Enqueue scripts and styles to login page
 */
function my_login_stylesheet() {
    wp_enqueue_style( 'metrika_login_css', get_template_directory_uri() . '/css/wp-style.css', false, false );
}
add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

/**
 * Enqueue scripts and styles to admin page
 */
function load_metrika_admin_style() {
    wp_enqueue_style('gridster', get_template_directory_uri() . '/css/jquery.gridster.min.css');
    wp_enqueue_style( 'metrika_admin_bootstrap', get_template_directory_uri() . '/css/bootstrap.css', false, false );
    wp_enqueue_style( 'metrika_admin_css', get_template_directory_uri() . '/css/admin-style.css', false, false );
    wp_enqueue_style( 'metrika_admin_ib-icon', get_template_directory_uri() . '/css/font-awesome.min.css', false, false );
    wp_enqueue_style( 'wp-color-picker' ); 
    wp_enqueue_media();
    wp_register_script('gridster', get_template_directory_uri() . '/js/jquery.gridster.min.js');
    wp_enqueue_script( 'metrika_admin_js', get_template_directory_uri() . '/js/admin-script.js', array('jquery-ui-sortable', 'jquery-ui-tabs', 'wp-color-picker', 'jquery-ui-resizable', 'jquery-masonry', 'gridster'), false );
    $l10n = array(
        'site_url'         => site_url(),
        'loader'           => '<img src="' . get_template_directory_uri() . '/img/loader.GIF' . '">',
        'success_save'     => '<span class="success-msg">' . __('Save') . '</span>',
        'error_save'       => '<span class="error-msg">' . __('Error') . '</span>',
        'select_icon_text' => __('Select Icon', 'metrika'),
        'loading'          => __('Loading...', 'metrika'),
    );
    wp_localize_script('metrika_admin_js', 'metrikaParams', $l10n);
}
add_action('admin_enqueue_scripts', 'load_metrika_admin_style');

/**
 * Enqueue scripts and styles to login page
 */
function metrika_login_js() {
    wp_enqueue_script( 'metrika-login', get_template_directory_uri() . '/js/login.js', array('jquery'), false );
    echo "<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>";
}

add_action('login_head', 'metrika_login_js');

function change_fornt_page($manager) {
    $setting = $manager->get_setting('metrika_theme_options[menu_type]');
    if ($setting->value() == 'yes') {
        update_option('show_on_front', 'posts'); // show on front latest posts 
    }
    else {
        update_option('show_on_front', 'page'); // show on front latest posts 
    }
}
add_action('customize_save_after', 'change_fornt_page');

function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Theme Functions.
 */
require get_template_directory() . '/inc/theme-function.php';

/**
 * Theme Shortcode.
 */
require get_template_directory() . '/inc/theme-shortcode.php';

/**
 * Theme Ajax Function.
 */
require get_template_directory() . '/inc/theme-ajax.php';

/**
 * Theme Post Types.
 */
require get_template_directory() . '/inc/theme-post-types.php';

/**
 * Theme Twitter.
 */
require get_template_directory() . '/inc/theme-twitter.php';

/**
 * Theme Setting Page.
 */
require get_template_directory() . '/inc/theme-setting-page.php';

/**
 * Itembridge Icon Set.
 */
require get_template_directory() . '/inc/itembridge-icons.php';

/**
 * Itembridge Fonts.
 */
require get_template_directory() . '/inc/metrika-fonts.php';

/**
 * Itembridge Page Animation.
 */
require get_template_directory() . '/inc/animation-helper.php';

/**
 * Itembridge Menu.
 */
require get_template_directory() . '/inc/menu-helper.php';

/**
*Powersimple functions
*/
require get_template_directory() . '/functions/metaboxes.php';
require get_template_directory() . '/functions/media.php';
require get_template_directory() . '/functions/press.php';
