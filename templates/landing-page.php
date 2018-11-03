<?php
/**
 * Template Name: Landing Page
 *
 * This file adds the landing page template to the Shadow theme.
 * The landing page removes most of the default theme structure
 * and only outputs the content. This is useful for creating custom
 * landing pages or to limit the amount of distractions for the user.
 *
 * @package      SeoThemes\Shadow
 * @link         https://seothemes.com/themes/shadow
 * @author       Seo Themes
 * @copyright    Copyright © 2018 SEO Themes
 * @license      GPL-3.0-or-later
 */

/**
 * Add `landing` body class.
 *
 * @param  array $classes Array of attributes.
 * @return string $classes.
 */
function shadow_add_body_class( $classes ) {
	$classes[] = 'landing-page';
	return $classes;
}
add_filter( 'body_class', 'shadow_add_body_class' );

// Remove site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Remove navigation.
remove_action( 'genesis_header', 'genesis_do_nav', 12 );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

// Remove breadcrumbs.
remove_action( 'genesis_entry_header', 'genesis_do_breadcrumbs', 99 );

// Remove site footer widgets.
remove_action( 'genesis_footer', 'shadow_footer_widget' );

// Remove site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Run the Genesis loop.
genesis();
