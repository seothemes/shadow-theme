( function ( $ ) {

	// Bind to the customizer object.
	wp.customize.bind( 'ready', function() {

		// The custom controld to show/hide
		var display_setting = $( '#customize-control-shadow_frontpage_show_posts' );

		var post_settings = $( '#customize-control-shadow_frontpage_posts_per_page, #customize-control-shadow_frontpage_posts_title' );

		// If checked on load, show/hide appropriate default controls.
		if( $( '#customize-control-show_on_front input[value="page"]' ).prop( "checked" ) ) {
			display_setting.show();
		} else {
			display_setting.hide();
			post_settings.hide();
		}

		// If checked on load, show/hide appropriate default controls.
		if( $( '#customize-control-shadow_frontpage_show_posts input[value="true"]' ).prop( "checked" ) ) {

			if( $( '#customize-control-show_on_front input[value="page"]' ).prop( "checked" ) ) {
				post_settings.show();
			}
		} else {
			post_settings.hide();
		}

		// If checked on change, show/hide appropriate controls.
		$( '#customize-control-show_on_front' ).on( 'change', function() {
			if( $( '#customize-control-show_on_front input[value="page"]' ).prop( "checked" ) ) {
				display_setting.show();

				if( $( '#customize-control-shadow_frontpage_show_posts input[value="true"]' ).prop( "checked" ) ) {
					post_settings.show();
				}
			} else {
				display_setting.hide();
				post_settings.hide();
			}
		} );

		// If checked on change, show/hide appropriate controls.
		$( '#customize-control-shadow_frontpage_show_posts' ).on( 'change', function() {
			if( $( '#customize-control-shadow_frontpage_show_posts input[value="true"]' ).prop( "checked" ) ) {
				post_settings.show();
			} else {
				post_settings.hide();
			}
		} );
	} );
} ) (jQuery);