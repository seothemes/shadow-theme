<?php
/**
 * Theme Plugins.
 *
 * This file contains all of the recommended plugins for the Shadow theme.
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

require_once __DIR__ . '/tgmpa.php';

add_action( 'tgmpa_register', 'shadow_register_required_plugins' );
/**
 * Register required plugins.
 *
 * @since 1.0.0
 *
 * @return void
 */
function shadow_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => 'Custom Header Extended',
			'slug'     => 'custom-header-extended',
			'required' => false,
		),
		array(
			'name'     => 'EA Share Count',
			'slug'     => 'ea-share-count',
			'source'   => 'https://github.com/jaredatch/EA-Share-Count/archive/master.zip',
			'required' => false,
		),
		array(
			'name'     => 'Genesis eNews Extended',
			'slug'     => 'genesis-enews-extended',
			'required' => false,
		),
		array(
			'name'     => 'Widget Importer & Exporter',
			'slug'     => 'widget-importer-exporter',
			'required' => false,
		),
		array(
			'name'     => 'WP Featherlight',
			'slug'     => 'wp-featherlight',
			'required' => false,
		),
		array(
			'name'     => 'WordPress Importer',
			'slug'     => 'wordpress-importer',
			'required' => false,
		),
	);

	$config = array(
		'id'           => 'store-pro',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
