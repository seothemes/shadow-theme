<?php
/**
 * Shadow Theme
 *
 * This file contains all of the child theme customizer settings.
 *
 * @package      SeoThemes\Shadow
 * @link         https://seothemes.com/themes/shadow
 * @author       SEO Themes
 * @copyright    Copyright © 2018 SEO Themes
 * @license      GPL-3.0-or-later
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

add_action( 'customize_register', 'shadow_customizer_register' );
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

	// Globals.
	global $wp_customize, $shadow_colors;

	// Custom 'Front Page Displays' control choices.
	$choices = array(
		'posts'       => __( 'Your latest posts', 'shadow' ),
		'page'        => __( 'A static page & recent posts', 'shadow' ),
	);

	// Modify the default 'Front Page Displays' controls.
	$wp_customize->get_control( 'show_on_front' )->choices  = $choices;	

	// Rename 'Static Front Page' section to 'Front Page Settings'.
	$wp_customize->get_section( 'static_front_page' )->title = __( 'Front Page Settings', 'shadow' );

	// Make sure preview refreshes on change.
	$wp_customize->get_setting( 'header_image' )->transport = 'refresh';

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

	// Add front page recent posts setting.
	$wp_customize->add_setting(
		'shadow_frontpage_show_posts',
		array(
		    'default'           => 'true',
		    'type'              => 'option',
		)
	);

	// Add front page recent posts control.
	$wp_customize->add_control(
		'shadow_frontpage_show_posts',
		array(
			'label'       => __( 'Display recent posts', 'shadow' ),
			'description' => __( 'Select whether to show the recent posts beneath the page content on the front page.', 'shadow' ),
			'section'     => 'static_front_page',
			'settings'    => 'shadow_frontpage_show_posts',
			'type'        => 'radio',
			'choices'	  => array(
				'true'  => __( 'Show recent posts', 'shadow' ),
				'false' => __( 'Hide recent posts', 'shadow' ),
			),
	    )
	);

	// Add front page recent posts title setting.
	$wp_customize->add_setting(
		'shadow_frontpage_posts_title',
		array(
		    'default'           => __( 'Recent Posts', 'shadow' ),
		    'type'              => 'option',
			'sanitize_callback' => 'esc_html',
		)
	);

	// Add front page recent posts title control.
	$wp_customize->add_control(
		'shadow_frontpage_posts_title',
		array(
			'label'       => __( 'Recent posts title', 'shadow' ),
			'description' => __( 'Enter a title to show above the recent posts. Note that this is only displayed if the Display recent posts setting is set to true. Leave blank for no title.', 'shadow' ),
			'section'     => 'static_front_page',
			'settings'    => 'shadow_frontpage_posts_title',
			'type'        => 'text',
	    )
	);

	// Add front page recent posts per page setting.
	$wp_customize->add_setting(
		'shadow_frontpage_posts_per_page',
		array(
		    'default'           => 4,
		    'type'              => 'option',
			'sanitize_callback' => 'shadow_sanitize_number',
		)
	);

	// Add front page recent posts per page control.
	$wp_customize->add_control(
		'shadow_frontpage_posts_per_page',
		array(
			'label'       => __( 'Number of posts', 'shadow' ),
			'description' => __( 'Enter the amount of posts to display on the front page. Note that this only controls the number of posts for the Static Front Page.', 'shadow' ),
			'section'     => 'static_front_page',
			'settings'    => 'shadow_frontpage_posts_per_page',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
	    )
	);
}

add_action( 'customize_controls_enqueue_scripts', 'shadow_customizer_controls' );
/**
 * Enqueue Customizer JS.
 *
 * Loads the theme's Customizer JavaScript that provides the custom
 * functionality in the Customizer. Place any additional scripts in the
 * /assets/scripts/ customize.js file instead of inline. This function
 * enqueues the minified version of the JavaScript, for debugging it is
 * recommended to load the non-minified version instead. Note that you will
 * need to run `gulp` or `gulp scripts` to minify the JavaScript, or you
 * could use another JavaScript minification tool.
 */
function shadow_customizer_controls() {
	wp_enqueue_script( 'shadow-customize-js', CHILD_THEME_URI . '/assets/scripts/customize.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}
