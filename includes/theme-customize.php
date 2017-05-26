<?php
/**
 * Theme Customize.
 *
 * This file contains all of the theme customizer settings
 * and output functionality. This theme includes 9 custom color
 * settings that can be modified in the variable array.
 *
 * @package      Shadow
 * @link         https://seothemes.net/shadow
 * @author       Seo Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Global array of theme colors.
$shadow_colors = array(
	'dark'	  => '#1b1f23',
	'heading' => '#464c4c',
	'body' 	  => '#7f8c8d',
	'links'   => '#97a5a7',
	'accent'  => '#57e5ae',
	'border'  => '#dddddd',
	'light'	  => '#f3f3f4',
	'input'   => '#f7f7f8',
	'select'  => '#fffcd3',
	'white'   => '#ffffff',
);

/**
 * Register customizer settings and controls.
 *
 * This loops through the global variable array of colors and
 * registers a customizer setting and control for each. To add
 * additional color settings, do not modify this function, instead
 * add your color name and hex value to the `$shadow_colors` array
 * at the beginning of this file.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function shadow_customizer_register( $wp_customize ) {

	// Make sure preview refreshes on change.
	$wp_customize->get_setting( 'header_image' )->transport = 'refresh';

	// Globals.
	global $wp_customize, $shadow_colors;

	// Loop through array and display colors.
	foreach ( $shadow_colors as $id => $hex ) {

		$setting = "shadow_{$id}_color";
		$label	 = ucwords( str_replace( '_', ' ', $id ) ) . __( ' Color', 'shadow' );

		// Add color setting.
		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => $hex,
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		// Add color control.
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting,
				array(
					'section'     => 'colors',
					'label'       => $label,
					'settings'    => $setting,
				)
			)
		);
	}
}
add_action( 'customize_register', 'shadow_customizer_register' );

/**
 * Output customizer styles.
 *
 * Checks the settings for the colors defined in the settings.
 * If any of these value are set the appropriate CSS is output.
 *
 * @var   array $shadow_colors Global theme colors.
 */
function shadow_customizer_output() {

	// Set in customizer-settings.php.
	global $shadow_colors;

	// Shorten the name for legibility.
	$color = $shadow_colors;

	/**
	 * Loop though each color in the global array of theme colors
	 * and create a new variable for each. This is just a shorthand
	 * way of creating multiple variables that we can reuse. The
	 * benefit of using a foreach loop over creating each variable
	 * manually is that we can just declare the colors once e.g the
	 * `$shadow_colors` array, and they can be used in multiple ways.
	 */
	foreach ( $color as $id => $hex ) {
		${"$id"} = get_theme_mod( "shadow_{$id}_color",  $hex );
	}

	// Ensure $css var is empty.
	$css = '';

	/**
	 * Build the CSS.
	 *
	 * We need to concatenate each one of our colors to the $css
	 * variable, but first check if the color has been changed by
	 * the user from the theme customizer. If the theme mod is not
	 * equal to the default color then the string is appended to $css.
	 */
	// Dark color.
	$css .= ( $color['dark'] !== $dark ) ? sprintf( '

		.site-header,
		.sub-menu {
			background-color: %1$s;
		}

		', $dark ) : '';

	// Heading color.
	$css .= ( $color['heading'] !== $heading ) ? sprintf( '

		body,
		.entry-title a,
		.entry-header .entry-meta b {
			color: %1$s;			
		}

		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.button,
		.entry-content pre code,
		.archive-pagination li a {
			background-color: %1$s;
		}

		::-moz-selection {
			color: %1$s;
		}

		::selection {
			color: %1$s;
		}

		', $heading ) : '';

	// Body color.
	$css .= ( $color['body'] !== $body ) ? sprintf( '

		a,
		p,
		ol,
		ul {
			color: %1$s;
		}

		', $body ) : '';

	// Links color.
	$css .= ( $color['links'] !== $links ) ? sprintf( '

		.site-title a,
		.site-description,
		.header-widget-area,
		.genesis-nav-menu a,
		.entry-header p,
		.entry-content pre code {
			color: %1$s;
		}

		', $links ) : '';

	// Accent color.
	$css .= ( $color['accent'] !== $accent ) ? sprintf( '

		a:hover,
		.entry-title a:hover {
			color: %1$s;
		}

		button:hover,
		input:hover[type="button"],
		input:hover[type="reset"],
		input:hover[type="submit"],
		.button:hover,
		.archive-pagination li a:hover,
		.archive-pagination .active a {
			background-color: %1$s;
		}

		', $accent ) : '';

	// Border color.
	$css .= ( $color['border'] !== $border ) ? sprintf( '

		a {
			border-bottom 1px dotted %1$s;
		}

		hr {
			border: 1px solid %1$s;
		}

		blockquote {
			border-left: 1px dotted %1$s;
		}

		input:focus,
		textarea:focus {
			background-color: %1$s;
		}

		', $border ) : '';

	// Light color.
	$css .= ( $color['light'] !== $light ) ? sprintf( '

		.breadcrumb {
			background-color: %1$s;
		}

		.site-title a:hover {
			color: %1$s;
		}

		.site-footer {
			border-top: 1px solid %1$s;
		}

		', $light ) : '';

	// Input color.
	$css .= ( $color['input'] !== $input ) ? sprintf( '

		input,
		select,
		textarea,
		.comments {
			background-color: %1$s;
		}

		.archive-description,
		.author-box,
		.featured-content .entry,
		.entry-comments .comment {
			border-bottom: 1px solid %1$s;
		}

		.single .author-box {
			border-top: %1$s;
		}

		', $input ) : '';

	// Select color
	$css .= ( $color['select'] !== $select ) ? sprintf( '

		::-moz-selection {
			background-color: %1$s;
		}

		::selection {
			background-color: %1$s;
		}

		', $select ) : '';

	// Whites color.
	$css .= ( $color['white'] !== $white ) ? sprintf( '

		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.button,
		button:hover,
		input[type="button"]:hover,
		input[type="reset"]:hover,
		input[type="submit"]:hover,
		.button:hover,
		.entry-content .button:hover,	
		.entry-title,
		.genesis-nav-menu a:hover,
		.genesis-nav-menu .current-menu-item > a,
		.genesis-nav-menu .sub-menu .current-menu-item > a:hover,
		.menu-button,
		.menu-button:hover:before,
		.single .entry-header .entry-meta b,
		.page .entry-header .entry-meta b,
		.archive-pagination li a {
			color: %1$s;
		}

		.comments input:not([type="submit"]), 
		.comments select, 
		.comments textarea {
			background-color: %1$s;
		}

		', $white ) : '';

	// Style handle is the name of the theme.
	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	// Output CSS if not empty.
	if ( ! empty( $css ) ) {

		// Add the inline styles, also minify CSS a bit first.
		wp_add_inline_style( $handle, shadow_minify_css( $css ) );
	}
}
add_action( 'wp_enqueue_scripts', 'shadow_customizer_output', 100 );
