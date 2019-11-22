<?php
    add_action( 'widgets_init', 'theme_slug_widgets_init' );
    function theme_slug_widgets_init() {

        register_sidebar( array(
            'name' => __( 'Header Logo', 'boilerplate' ),
            'id' => 'header-logo',
            'description' => __( 'Header Logo', 'boilerplate' ),
            'before_widget' => '',
            'before_title'  => '',
        ) );
         register_sidebar( array(
            'name' => __( 'Header Menu', 'boilerplate' ),
            'id' => 'header-menu',
            'description' => __( '', 'boilerplate' ),
            'before_widget' => '',
            'before_title'  => '',
        ) );


        register_sidebar( array(
            'name' => __( 'Footer Column 1', 'boilerplate' ),
            'id' => 'footer-1',
            'description' => __( 'footer 1', 'boilerplate' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title font-alt">',
            'after_title'   => '</h5>',
        ) );
   
   
        register_sidebar( array(
            'name' => __( 'Footer Column 2', 'boilerplate' ),
            'id' => 'footer-2',
            'description' => __( 'footer 2', 'boilerplate' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title font-alt">',
        'after_title'   => '</h5>',
        ) );
    
        register_sidebar( array(
            'name' => __( 'Footer Column 3', 'boilerplate' ),
            'id' => 'footer-3',
            'description' => __( 'footer 3', 'boilerplate' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title font-alt">',
        'after_title'   => '</h5>',
        ) );
   
        register_sidebar( array(
            'name' => __( 'Footer Column 4', 'boilerplate' ),
            'id' => 'footer-4',
            'description' => __( 'footer 4', 'boilerplate' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h5 class="widget-title font-alt">',
        'after_title'   => '</h5>',
        ) );
          register_sidebar( array(
            'name' => __( 'Footer Social', 'boilerplate' ),
            'id' => 'footer-social',
            'description' => __( 'footer social', 'boilerplate' ),
            'before_widget' => '<div id="%1$s" class="footer-social-links">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widget-title font-alt">',
            'after_title'   => '</h5>',
        ) );
    }
?>