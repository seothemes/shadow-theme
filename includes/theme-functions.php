<?php
/**
 * Theme Functions.
 *
 * This file contains all of the helper functions and theme specific
 * functions that are too complex to be placed in the functions.php file.
 *
 * @package      Shadow
 * @link         https://seothemes.net/shadow
 * @author       Seo Themes
 * @copyright    Copyright © 2017 Seo Themes
 * @license      GPL-2.0+
 */

/**
 * Enable features from Soil plugin if active https://roots.io/plugins/soil/.
 *
 * Soil is a plugin that heavily optimizes the default frontend
 * output of WordPress, but can sometimes cause minor issues with
 * the display of your site. If this happens simply remove the
 * plugin completely, or comment out the following 10 lines of code.
 *
 * For troubleshooting, comment out one line at a time to see what
 * is actually causing the problem, you can then safely use the rest
 * of the Soil features and benefit from the performance.
 *
 * If using Google Analytics, uncomment the following line and replace
 * `YOUR-GA-CODE` with your own unique Google Analytics tracking code:
 *
 * add_theme_support( 'soil-google-analytics', 'YOUR-GA-CODE' );
 */
add_theme_support( 'soil-clean-up' );
add_theme_support( 'soil-disable-asset-versioning' );
add_theme_support( 'soil-disable-trackbacks' );
add_theme_support( 'soil-jquery-cdn' );
add_theme_support( 'soil-js-to-footer' );
add_theme_support( 'soil-nav-walker' );
add_theme_support( 'soil-nice-search' );
add_theme_support( 'soil-relative-urls' );

/**
 * Additional opening wrap.
 *
 * Used for entry-header, entry-content and entry-footer.
 * Genesis doesn't provide structural wraps for these elements
 * so we need to hook in and add the wrap div at the start.
 * This is a utility function that can be used anywhere to open
 * a wrap anywhere in your theme.
 */
function shadow_wrap_open() {
	echo '<div class="wrap">';
}
add_action( 'genesis_entry_header', 'shadow_wrap_open', 5 );
add_action( 'genesis_entry_content', 'shadow_wrap_open', 5 );
add_action( 'genesis_entry_footer', 'shadow_wrap_open', 5 );
add_action( 'genesis_archive_title_descriptions', 'shadow_wrap_open', 5 );

/**
 * Additional closing wrap.
 *
 * The closing markup for the additional opening wrap divs,
 * simply closes the wrap divs that we created earlier. This
 * is a utility function that can be used anywhere to close
 * any kind of div, not just wraps.
 */
function shadow_wrap_close() {
	echo '</div>';
}
add_action( 'genesis_entry_header', 'shadow_wrap_close', 14 );
add_action( 'genesis_entry_content', 'shadow_wrap_close', 14 );
add_action( 'genesis_entry_footer', 'shadow_wrap_close', 14 );
add_action( 'genesis_archive_title_descriptions', 'shadow_wrap_close', 14 );

/**
 * Sanitize numbers.
 *
 * A helper function used to ensure that $number is an absolute
 * integer (whole number, zero or greater). If the input is an
 * absolute integer, return it; otherwise, return the default.
 *
 * @param  int $number The input number.
 * @param  obj $setting The setting id.
 * @return int Absolute integer.
 */
function shadow_sanitize_number( $number, $setting ) {

	$number = absint( $number );
	return ( $number ? $number : $setting->default );
}

/**
 * Minify CSS helper function.
 *
 * A handy CSS minification script by Gary Jones that we'll use to
 * minify the CSS output by the customizer. This is called near the
 * end of the /includes/theme-customize.php file. A big thanks to
 * Gary for this one, works perfectly.
 *
 * @author Gary Jones
 * @link https://github.com/GaryJones/Simple-PHP-CSS-Minification
 * @param string $css CSS to minify.
 * @return string Minified CSS.
 */
function shadow_minify_css( $css ) {

	// Normalize whitespace.
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove spaces before and after comment.
	$css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );

	// Remove comment blocks, everything between /* and */, unless preserved with /*! ... */ or /** ... */.
	$css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );

	// Remove ; before }.
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >.
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { } ( ) >.
	$css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px).
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0).
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Converts all zeros value into short-hand.
	$css = preg_replace( '/0 0 0 0/', '0', $css );

	// Shorten 6-character hex color codes to 3-character where possible.
	$css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );

	return trim( $css );
}

/**
 * Accessible read more link.
 *
 * The below code modifies the default read more link when
 * using the WordPress More Tag to break a post on your site.
 * Instead of seeing 'Read more', screen readers will instead
 * see 'Read more about (entry title)'. This is a simple fix
 * to improve the overall user experience and should be in core.
 */
function shadow_read_more() {
	$trimtitle  = get_the_title();
	$shorttitle = wp_trim_words( $trimtitle, $num_words = 10, $more = '…' );
	return sprintf( '<a class="more-link" rel="nofollow" href="%1$s">Read more<span class="screen-reader-text"> about %2$s</span></a>', esc_url( get_permalink() ), $shorttitle );
}
add_filter( 'excerpt_more', 'shadow_read_more' );
add_filter( 'the_content_more_link', 'shadow_read_more' );
add_filter( 'get_the_content_more_link', 'shadow_read_more' );

/**
 * Display featured image.
 *
 * This hooks the featured image into the entry content
 * section of a post. First checks if settings are set to
 * display featured images in the Genesis admin settings
 * page. We want to make it easy to enable/disable and
 * not force the feature image to be displayed.
 *
 * @return array Featured image size.
 */
function shadow_display_featured_image() {

	// Return early if not a post.
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	// Get Genesis theme settings.
	$genesis_settings = get_option( 'genesis-settings' );

	// Check featured image option.
	if ( 1 !== $genesis_settings['content_archive_thumbnail'] ) {
		return;
	}

	// Display featured image.
	the_post_thumbnail( 'post-image' );
}
add_action( 'genesis_entry_content', 'shadow_display_featured_image', 6 );

/**
 * Display page excerpts.
 *
 * Adds custom page excerpts beneath the entry title on single
 * posts and pages to create a subtitle. If no excerpt is set
 * then nothing will be output on the front end.
 */
function shadow_show_excerpt() {

	if ( has_excerpt() && ( is_single() || is_page() ) ) {
		the_excerpt();
	}
}
add_action( 'genesis_entry_header', 'shadow_show_excerpt', 10 );

/**
 * Wrap comments.
 *
 * We need to wrap the comments section of the theme to make it
 * work with the custom wrap divs that have been added to the
 * entry-header, entry-content and entry-footer.
 */
function shadow_wrap_comments() {
	echo '<div class="comments">';
}
add_action( 'genesis_before_comments', 'shadow_wrap_comments', 9 );
add_action( 'genesis_after_loop', 'shadow_wrap_close', 14 );

/**
 * Remove Page Templates.
 *
 * The Genesis Blog & Archive templates are not needed and can
 * create problems for users so it is safe to remove them completely.
 * If you need to use these templates, simply remove this function.
 *
 * @param  array $page_templates All page templates.
 * @return array Modified templates.
 */
function shadow_remove_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}
add_filter( 'theme_page_templates', 'shadow_remove_templates' );

/**
 * Remove blog metabox.
 * 
 * Also remove the Genesis blog settings metabox from the
 * Genesis admin settings screen as it is no longer required
 * if the Blog page template has been removed. 
 */
function shadow_remove_metaboxes( $hook ) {
	remove_meta_box( 'genesis-theme-settings-blogpage', $hook, 'main' );
}
add_action( 'genesis_admin_before_metaboxes', 'shadow_remove_metaboxes' );

/**
 * Customize the entry meta.
 *
 * This adds some additional markup to the published time and
 * categories in the entry-meta section of the entry-header.
 *
 * @param string $post_info The post meta.
 */
function shadow_post_info_filter( $post_info ) {

	// Put strings in variables for i18n.
	$published  = __( 'Published', 'shadow' );
	$categories = __( 'Categories', 'shadow' );

	// Build post info output.
	$post_info = '<span class="published"><b>' . $published . '</b>[post_date]</span><span class="categories"><b>' . $categories . '</b>[post_categories before="" sep=""]</span>';

	return $post_info;
}
add_filter( 'genesis_post_info', 'shadow_post_info_filter' );

/**
 * List entry tags.
 *
 * Display the entry tags before the entry content and featured
 * image on single posts and display the tags after the entry
 * content on archives.
 */
function shadow_reposition_meta() {

	// Check if on single post.
	if ( is_single() ) {
		add_action( 'genesis_entry_header', 'genesis_post_meta', 100 );
	} else {
		add_action( 'genesis_entry_content', 'genesis_post_meta', 10 );
	}

}
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
add_action( 'genesis_header', 'shadow_reposition_meta' );

/**
 * Modify entry meta.
 *
 * Filters the post meta to remove categories because they are already
 * displayed in the entry header by another function. Also some minor
 * formatting to work correctly with the repositioning.
 *
 * @param string $post_meta Default post meta.
 * @return string $post_meta Modified meta.
 */
function post_meta_filter( $post_meta ) {

	// Show post meta only if post has tags.
	$post_meta = the_tags( '<p class="entry-tags"><small>Tagged with: ', ', ', '</small></p>' );
	return $post_meta;
}
add_filter( 'genesis_post_meta', 'post_meta_filter' );

/**
 * By author in entry title.
 *
 * If you would like to also display the author's avatar, simply
 * add `%3$s` (ignore backticks) to the string below between the
 * closing </a> tag and closing </p> tag. This will output the
 * author's avatar next to their name with 30px dimensions. Your
 * modified code should look like this </a>%3$s</p>.
 *
 * @return void
 */
function shadow_entry_author() {

	// Don't show on pages etc.
	if ( is_singular( 'page' ) ) {
		return;
	}

	// Get the ID of the post author.
	$author_id = get_the_author();

	// Displat post author name.
	printf( '<p class="author-name">By <a href="%1$s">%2$s</a></p>', get_author_posts_url( $author_id ), $author_id, get_avatar( get_the_author_meta( 'email' ), 30 ) );
}
add_action( 'genesis_entry_header', 'shadow_entry_author' );

/**
 * Reposition breadcrumbs.
 *
 * This function moves the breadcrumbs beneath the entry-header
 * section on all posts and pages, except for blog and archive
 * pages which have the breadcrumbs just after the header.
 */
function shadow_do_breadcrumbs() {

	// Remove breadcrumbs.
	remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

	// Do breadcrumbs after header on blog and archives.
	if ( is_home() || is_archive() ) {
		add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs', 99 );
	} else {
		// Do breadcrumbs in entry header.
		add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs', 99 );
	}
}
add_action( 'genesis_header', 'shadow_do_breadcrumbs' );

/**
 * Wrap breadcrumbs.
 *
 * Modify the breadcrumb arguments to add a wrap div inside the
 * breadcrumb div. This is required to make the breadcrumbs align
 * with the rest of the site's content areas.
 *
 * @param  array $args Original breadcrumb args.
 * @return array Cleaned breadcrumbs.
 */
function shadow_breadcrumb_args( $args ) {
	$args['prefix'] = '<div class="breadcrumb" itemscope="" itemtype="https://schema.org/BreadcrumbList"><div class="wrap">';
	$args['suffix'] = '</div></div>';
	$args['labels']['prefix'] = '';
	$args['labels']['author'] = '';
	$args['labels']['category'] = '';
	$args['labels']['tag'] = '';
	$args['labels']['date'] = '';
	$args['labels']['tax'] = '';
	$args['labels']['post_type'] = '';
	return $args;
}
add_filter( 'genesis_breadcrumb_args', 'shadow_breadcrumb_args' );

/**
 * Add no-js class to body.
 *
 * Used for checking whether or not JavaScript is active so we can
 * style the navigation menus to suit the user. Also add an empty
 * `ontouchstart` attribute which emulates hover effects on mobile.
 *
 * @param  string $attr On touch start attribute.
 * @return string
 */
function shadow_add_ontouchstart( $attr ) {
	$attr['class'] 		  .= ' no-js';
	$attr['ontouchstart']  = ' ';
	return $attr;
}
add_filter( 'genesis_attr_body', 'shadow_add_ontouchstart' );
