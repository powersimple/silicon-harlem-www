<?php
function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    return $rgb;
}
class HomeMenu extends Walker_Nav_Menu{
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . ' page-transition"' : 'page-transition';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $color = array('#50b2a2', '#50b28a', '#c85141', '#0fa2cb', '#d8457a', '#d8733b', '#d9912a');
        $color_key = array_rand($color);
        
        $output .= $indent . '<li' . $id . $value . $class_names .' style=" background-color:' . $color[$color_key] . '">';

        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

        $attributes = '';
        foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                        $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                        $attributes .= ' ' . $attr . '="' . $value . '" ' . $class_names ;
                }
        }
                
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

//add_filter( 'wp_page_menu', 'Metrika_wp_page_menu', 10 );
function Metrika_wp_page_menu( $args = array() ) {
    $defaults = array('sort_column' => 'post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'wp_page_menu_args', $args );

    $menu = '';

    $list_args = $args;

    // Show Home in the menu
    if ( ! empty($args['show_home']) ) {
        if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
            $text = __('Home', 'metrika');
        else
            $text = $args['show_home'];
        $class = '';
        if ( is_front_page() && !is_paged() )
            $class = 'class="current_page_item"';
        $color = array('#50b2a2', '#50b28a', '#c85141', '#0fa2cb', '#d8457a', '#d8733b', '#d9912a');
        $color_key = array_rand($color);
        //$menu .= '<li ' . $class . '><a href="' . home_url( '/' ) . '" title="' . esc_attr($text) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
        // If the front page is a page, add it to the exclude list
        if (get_option('show_on_front') == 'page') {
            if ( !empty( $list_args['exclude'] ) ) {
                $list_args['exclude'] .= ',';
            } else {
                $list_args['exclude'] = '';
            }
            $list_args['exclude'] .= get_option('page_on_front');
        }
    }

    $list_args['echo'] = false;
    $list_args['title_li'] = '';
    $menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

    if ( $menu )
        $menu = '<ul>' . $menu . '</ul>';

    $menu = '<div class="' . esc_attr($args['menu_class']) . '">' . $menu . "</div>\n";
    $menu = apply_filters( 'wp_page_menu', $menu, $args );
    if ( $args['echo'] )
        echo $menu;
    else
        return $menu;
}

function Metrika_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'Metrika_excerpt_more');

function Metrika_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'Metrika_excerpt_length', 999 );

function get_excerpt_by_id($post_id){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 15; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);
    if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    endif;
    $the_excerpt = '<p>' . $the_excerpt . '</p>';
    return $the_excerpt;
}

function metrika_post_limits( $limit ) {
    return 'LIMIT 0, 100';
}
add_filter( 'post_limits', 'metrika_post_limits' );

function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
     $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
     $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function the_slug($id, $echo=false){
    $slug = basename(get_permalink($id));
    do_action('before_slug', $slug);
    $slug = apply_filters('slug_filter', $slug);
    if( $echo ) echo $slug;
    do_action('after_slug', $slug);
    return $slug;
}