/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
        wp.customize( 'color', function( value ) {
		value.bind( function( to ) {
			$( 'head style' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
            value.bind( function( to ) {
                if ( 'blank' === to ) {
                    $( '.site-title, .site-description' ).css( {
                        'clip': 'rect(1px, 1px, 1px, 1px)',
                        'position': 'absolute'
                    } );
                } else {
                    $( '.site-title, .site-description' ).css( {
                        'clip': 'auto',
                        'color': to,
                        'position': 'relative'
                    } );
                }
            } );
	} );
        // Menu Type.
        wp.customize( 'metrika_theme_options[menu_type]', function( value ) {
		value.bind( function( newval  ) {
			$( '.navi .container > .span12' ).text( newval  );
		} );
	} );
        
        wp.customize( 'metrika_theme_options[font]', function( value ) {
		value.bind( function( newval  ) {
			$( 'body' ).text( newval  );
		} );
	} );
        
        // Logo.
        wp.customize( 'metrika_theme_options[logo]', function( value ) {
		value.bind( function( newval  ) {
			$( '.logo' ).text( newval  );
		} );
	} );
        
        wp.customize( 'metrika_theme_options[logo_text]', function( value ) {
		value.bind( function( newval  ) {
			$( '.logo' ).text( newval  );
		} );
	} );
        
        wp.customize( 'metrika_theme_options[home_bg]', function( value ) {
		value.bind( function( newval  ) {
			$( '.pt-page.pt-page-1' ).text( newval  );
		} );
	} );
        
} )( jQuery );
