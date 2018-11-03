<?php
/**
 * Shadow Theme
 *
 * This file sets up the child theme.
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

// Add support for title tags.
add_theme_support( 'title-tag' );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for footer widgets.
add_theme_support( 'genesis-footer-widgets', 1 );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for post thumbnails.
add_theme_support( 'post-thumbnails' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Enable selective refresh and Customizer edit icons.
add_theme_support( 'customize-selective-refresh-widgets' );

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

// Enable Accessibility support.
add_theme_support( 'genesis-accessibility', array(
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
) );

// Add support for post formats.
add_theme_support( 'post-formats', array(
	'aside',
	'audio',
	'chat',
	'gallery',
	'image',
	'link',
	'quote',
	'status',
	'video',
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
	'header-selector' => '.entry-header, .archive-description',
	'header_image'    => get_stylesheet_directory_uri() . '/assets/images/hero.jpg',
	'header-text'     => false,
	'width'           => 1920,
	'height'          => 1080,
	'flex-height'     => true,
	'flex-width'      => true,
	'video'           => false,
) );

// Add support for page excerpts.
add_post_type_support( 'page', 'excerpt' );

// Register default header (just in case).
register_default_headers( array(
	'child' => array(
		'url'           => '%2$s/assets/images/hero.jpg',
		'thumbnail_url' => '%2$s/assets/images/hero.jpg',
		'description'   => __( 'Hero Image', 'shadow' ),
	),
) );

// Remove sidebars.
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

// Remove site layouts.
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Display custom logo.
add_action( 'genesis_site_title', 'the_custom_logo' );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header_right', 'genesis_do_nav', 10 );

// Repositiong featured image.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_content', 'genesis_do_post_image', 13 );

// Reposition after entry widget.
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_entry_footer', 'genesis_after_entry_widget_area' );

// Force full-width-content layout setting.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove the footer credits (use widget area instead).
add_filter( 'genesis_footer_output', '__return_false' );

// Reposition footer widgets.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'genesis_footer', 'genesis_footer_widget_areas', 6 );