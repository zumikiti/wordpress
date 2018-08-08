<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package First
 */

/**
 * Change the [...] string in the excerpt.
 */
function first_change_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'first_change_excerpt_more' );

/**
 * Remove #more anchor from permalinks.
 */
function first_remove_more_anchor( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'first_remove_more_anchor' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function first_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'first_page_menu_args' );