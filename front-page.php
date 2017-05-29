<?php
/**
 * Front Page.
 *
 * This file adds the front page template to the Shadow theme.
 * The front page template can be used to create a custom home
 * page layout using widget areas, page content or latest posts.
 * The front-page template is delibirately left blank but still
 * included in the theme for the convenience of users.
 *
 * @package      Shadow
 * @link         https://seothemes.net/shadow
 * @author       Seo Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */

/**
 * Check for content.
 *
 * Check if the content is really empty. If so remove the
 * entry-content markup so that the padding is not output.
 */
if ( trim( str_replace( '&nbsp;', '', strip_tags( $post->post_content ) ) ) === '' ) {
	add_filter( 'genesis_attr_entry-content', '__return_empty_array' );
}

/**
 * Custom front page.
 *
 * This function allows us to create a custom front page
 * layout based on the users settings in the Customizer.
 * First we check if the user would like to display the
 * recent posts section after the page content. If true
 * then configure the posts loop depending on the other
 * settings specified by the user. The 'See more posts'
 * link text can be changed by adding the following code
 * snippet to your theme's functions.php file:
 *
 * add_filter( 'shadow_posts_link', 'custom_link_text' );
 * function custom_link_text() {
 *     return 'My custom link text';
 * }
 */
function shadow_frontpage() {

	// Re-add the entry-content markup.
	remove_filter( 'genesis_attr_entry-content', '__return_empty_array' );

	// Define variables.
	$show_posts 	= get_option( 'shadow_frontpage_show_posts', 'posts_page' );
	$posts_title 	= get_option( 'shadow_frontpage_posts_title', __( 'Latest Posts', 'shadow' ) );
	$posts_per_page = get_option( 'shadow_frontpage_posts_per_page', 4 );
	$posts_page 	= get_permalink( get_option( 'page_for_posts' ) );
	$link_text 		= apply_filters( 'shadow_posts_link', __( 'See all posts', 'shadow' ) );

	if ( 'true' === $show_posts ) {

		echo '<div class="front-page-posts">';
		shadow_wrap_open();

		$posts_title ? printf( '<h2>%s</h2>', $posts_title ) : '';

		genesis_custom_loop( array(
			'orderby'        => 'post_date',
			'order'          => 'DESC',
			'paged'			 => false,
			'posts_per_page' => $posts_per_page,
			'ignore_sticky_posts' => true,
		) );

		printf( '<a class="button" href="%1$s">%2$s</a>', esc_url( $posts_page ), esc_html( $link_text ) );
		shadow_wrap_close();
		echo '</div>';
	}
}
add_action( 'genesis_after_loop', 'shadow_frontpage' );

/**
 * Remove pagination (optional).
 *
 * Only remove the pagination if displaying a static front
 * page. If you would prefer to keep pagination then just
 * remove this block of code. 
 */
if ( 'page' === get_option( 'show_on_front' ) ) {
	remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
}

// Run Genesis.
genesis();

