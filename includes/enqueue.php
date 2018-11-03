<?php
/**
 * Shadow Theme
 *
 * This file loads the child theme scripts and styles.
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

add_action( 'wp_enqueue_scripts', 'shadow_scripts_styles' );
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function shadow_scripts_styles() {

	// Load Google Fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400', array(), CHILD_THEME_VERSION );

	// Load custom scripts.
	wp_enqueue_script( 'custom-scripts', get_bloginfo( 'stylesheet_directory' ) . '/assets/scripts/scripts.js', array( 'jquery' ), CHILD_THEME_VERSION );
}
