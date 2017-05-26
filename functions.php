<?php
/**
 * Shadow - Mobile first blogging Genesis child theme.
 *
 * This file contains all of the default functionality for the theme.
 * Place any custom code snippets in this file. Complex functions have
 * been placed in a separate file named /includes/theme-functions.php.
 *
 * @package      Shadow
 * @link         https://seothemes.net/shadow
 * @author       Seo Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Include theme helper functions.
include_once( get_stylesheet_directory() . '/includes/theme-functions.php' );

// Include theme default settings.
include_once( get_stylesheet_directory() . '/includes/theme-defaults.php' );

// Include theme customizer settings.
include_once( get_stylesheet_directory() . '/includes/theme-customize.php' );

// Include theme recommended plugins.
include_once( get_stylesheet_directory() . '/includes/theme-plugins.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Shadow' );
define( 'CHILD_THEME_URL', 'https://seothemes.net/shadow/' );
define( 'CHILD_THEME_VERSION', '0.1.0' );

// Remove sidebars.
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Add support for page excerpts.
add_post_type_support( 'page', 'excerpt' );

// Add support for title tags.
add_theme_support( 'title-tag' );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for post thumbnails.
add_theme_support( 'post-thumbnails' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Remove secondary navigation menu.
add_theme_support( 'genesis-menus', array( 
	'primary' => __( 'Header Menu', 'genesis' ),
) );

// Add HTML5 markup structure.
add_theme_support( 'html5', array(
	'search-form',
	'comment-form',
	'comment-list',
	'gallery',
	'caption',
) );

// Add Genesis structural wraps.
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'entry-header',
	'entry-content',
	'footer-widget',
	'footer',
) );

// Enable Logo option in Customizer > Site Identity.
add_theme_support( 'custom-logo', array(
	'height'      => 60,
	'width'       => 200,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => array( '.site-title', '.site-description' ),
) );

// Enable theme support for custom header background image.
add_theme_support( 'custom-header', array(
	'header-selector' 	=> '.entry-header',
	'header_image'    	=> get_stylesheet_directory_uri() . '/assets/images/hero.jpg',
	'header-text'     	=> false,
	'width'           	=> 1920,
	'height'          	=> 1080,
	'flex-height'     	=> true,
	'flex-width'		=> true,
	'video'				=> true,
) );

// Register default header (just in case).
register_default_headers( array(
	'child' => array(
		'url'           => '%2$s/assets/images/hero.jpg',
		'thumbnail_url' => '%2$s/assets/images/hero.jpg',
		'description'   => __( 'Hero Image', 'shadow' ),
	),
) );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header_right', 'genesis_do_nav', 10 );

// Repositiong featured image.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_content', 'genesis_do_post_image', 13 );

// Reposition after entry widget.
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_entry_footer', 'genesis_after_entry_widget_area' );

// Remove the entry meta in the entry footer.
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// Force full-width-content layout setting.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove the footer credits (use widget area instead).
add_filter( 'genesis_footer_output', '__return_false' );

// Register footer widget area.
genesis_register_sidebar( array(
	'id'          => 'footer-widget',
	'name'        => __( 'Footer Widget', 'shadow' ),
	'description' => __( 'This is the footer widget area.', 'shadow' ),
) );

/**
 * Display footer widget area.
 */
function shadow_footer_widget() {

	genesis_widget_area( 'footer-widget', array(
		'before' => '',
		'after'  => '',
	) );
}
add_action( 'genesis_footer', 'shadow_footer_widget' );

/**
 * Enqueue scripts and styles.
 */
function shadow_scripts_styles() {

	// Load Google Fonts.
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:300,400', array(), CHILD_THEME_VERSION );

	// Load custom scripts
	wp_enqueue_script( 'custom-scripts', get_bloginfo( 'stylesheet_directory' ) . '/assets/scripts/scripts.min.js', array( 'jquery' ), CHILD_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'shadow_scripts_styles' );
