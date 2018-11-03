<?php
/**
 * Shadow Theme
 *
 * This file contains all of the default child theme settings.
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

/**
 * Update Theme Settings upon reset.
 *
 * @param  array $defaults Default theme settings.
 * @return array Custom theme settings.
 */
function shadow_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 6;
	$defaults['content_archive']           = 'excerpt';
	$defaults['content_archive_limit']     = 300;
	$defaults['content_archive_thumbnail'] = 1;
	$defaults['image_alignment']           = 'alignnone';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['image_size']                = 'large';
	$defaults['site_layout']               = 'full-width-content';
	$defaults['breadcrumb_home']		   = 1;
	$defaults['breadcrumb_front_page']	   = 1;
	$defaults['breadcrumb_posts_page']	   = 1;
	$defaults['breadcrumb_single']		   = 1;
	$defaults['breadcrumb_page']		   = 1;
	$defaults['breadcrumb_archive']		   = 1;
	$defaults['breadcrumb_404']		   	   = 1;
	$defaults['breadcrumb_attachment']	   = 1;

	return $defaults;

}
add_filter( 'genesis_theme_settings_defaults', 'shadow_theme_defaults' );

/**
 * Update Theme Settings upon activation.
 */
function shadow_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 6,
			'content_archive'           => 'excerpt',
			'content_archive_limit'     => 300,
			'content_archive_thumbnail' => 1,
			'image_alignment'           => 'alignnone',
			'image_size'                => 'large',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'full-width-content',
		) );
	}

	update_option( 'posts_per_page', 8 );

}
add_action( 'after_switch_theme', 'shadow_theme_setting_defaults' );

/**
 * Simple Social Icon Defaults.
 *
 * @param  array $defaults Default Simple Social Icons settings.
 * @return array Custom settings.
 */
function shadow_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'alignleft',
		'background_color'       => '#ffffff',
		'background_color_hover' => '#ffffff',
		'border_radius'          => 3,
		'border_color'           => '#ffffff',
		'border_color_hover'     => '#ffffff',
		'border_width'           => 0,
		'icon_color'             => '#7f8c8d',
		'icon_color_hover'       => '#57e5ae',
		'size'                   => 38,
		'new_window'             => 1,
		'facebook'               => '#',
		'gplus'                  => '#',
		'instagram'              => '#',
		'pinterest'              => '#',
		'twitter'                => '#',
		'youtube'                => '#',
	);
	$args = wp_parse_args( $args, $defaults );

	return $args;

}
add_filter( 'simple_social_default_styles', 'shadow_social_default_styles' );
