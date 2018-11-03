<?php
/**
 * Shadow Theme
 *
 * This file contains all of the default functionality for the theme.
 *
 * @package      SeoThemes\Shadow
 * @link         https://seothemes.com/themes/shadow
 * @author       SEO Themes
 * @copyright    Copyright © 2018 SEO Themes
 * @license      GPL-3.0-or-later
 */

// Define theme constants (do not remove).
$child_theme = wp_get_theme();
define( 'CHILD_THEME_NAME', $child_theme->get( 'Name' ) );
define( 'CHILD_THEME_URL', $child_theme->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $child_theme->get( 'Version' ) );
define( 'CHILD_THEME_TEXT_DOMAIN', $child_theme->get( 'TextDomain' ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

// Load Genesis Framework.
require_once get_template_directory() . '/lib/init.php';

// Include theme helper functions.
include_once( CHILD_THEME_DIR . '/includes/setup.php' );
include_once( CHILD_THEME_DIR . '/includes/helpers.php' );
include_once( CHILD_THEME_DIR . '/includes/general.php' );
include_once( CHILD_THEME_DIR . '/includes/enqueue.php' );
include_once( CHILD_THEME_DIR . '/includes/customize.php' );
include_once( CHILD_THEME_DIR . '/includes/output.php' );
include_once( CHILD_THEME_DIR . '/includes/defaults.php' );
include_once( CHILD_THEME_DIR . '/includes/plugins.php' );
