<?php
/**
 * Metrika Theme Customizer
 *
 * @package Metrika
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Metrika_customize_register( $wp_customize ) {
    $fonts = Metrika_google_fonts();
    $font_list = array();
    foreach ($fonts as $key => $value) {
        $font_list[$key] = $value['name'];
    }
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->remove_section( 'title_tagline');
    $wp_customize->remove_section( 'static_front_page');
    $wp_customize->remove_section( 'nav');
    
    $wp_customize->add_section('metrika_color', array(
        'title'    => __('Default Theme Color', 'metrika'),
        'priority' => 5,
    ));

    $wp_customize->add_section('metrika_settings', array(
        'title'    => __('Theme Style', 'metrika'),
        'priority' => 10,
    ));

    $wp_customize->add_section('metrika_email_info', array(
        'title'    => __('E-mail Details', 'metrika'),
        'priority' => 130,
    ));
    
    $wp_customize->add_section('metrika_contact_form', array(
        'title'    => __('Feedback', 'metrika'),
        'priority' => 130,
    ));

    $wp_customize->add_setting('metrika_theme_options[color]', array(
        'default'        => 'd06e39',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'color', array(
        'label'    => __('Color', 'metrika'),
        'section'  => 'metrika_color',
        'settings' => 'metrika_theme_options[color]',
    )));
    
    $wp_customize->add_setting('metrika_theme_options[menu_type]', array(
        'default'        => 'no',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
 
    $wp_customize->add_control('metrika_menu_type', array(
        'label'      => __('', 'metrika'),
        'section'    => 'metrika_settings',
        'settings'   => 'metrika_theme_options[menu_type]',
        'type'       => 'radio',
        'choices'    => array(
            'yes' => 'Metro',
            'no'  => 'Standart',
        ),
    ));    
    
}
add_action( 'customize_register', 'Metrika_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function Metrika_customize_preview_js() {
	wp_enqueue_script( 'Metrika_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'Metrika_customize_preview_js' );