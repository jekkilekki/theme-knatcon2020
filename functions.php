<?php
/**
 * KNatcon2020 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage KNatcon2020
 * @since 1.0.0
 */

add_action( 'wp_enqueue_scripts', 'knatcon2020_enqueue_styles' );

/**
 * Enqueue Parent and Child stylesheets.
 */
function knatcon2020_enqueue_styles() {

	$parent_style = 'twentytwenty-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array(), '20200404' );

	wp_enqueue_style(
		'knatcon2020-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get( 'Version' )
	);

	// Barlow font.
	wp_enqueue_style(
		'knatcon2020-barlow',
		get_stylesheet_directory_uri() . '/fonts/barlow/barlow.css',
		array(),
		'20200404'
	);

	// Recursive font.
	wp_enqueue_style(
		'knatcon2020-recursive',
		get_stylesheet_directory_uri() . '/fonts/recursive/recursive.css',
		array(),
		'20200404'
	);

	// FontAwesome.
	wp_enqueue_style(
		'knatcon2020-fontawesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css',
		array(),
		'20200404'
	);

	// Add Custom JS for top menu.
	wp_enqueue_script(
		'knatcon2020-top-menu',
		get_stylesheet_directory_uri() . '/js/top-menu.js',
		array(),
		'20200404',
		false
	);

}

/**
 * WordPress filter for Read More link.
 *
 * @param string $more The read more string.
 */
function knatcon2020_filter_excerpt_more( $more ) {
	return '&hellip; <a href="' . get_the_permalink() . '">[read more]</a>';
}
add_filter( 'excerpt_more', 'knatcon2020_filter_excerpt_more', 10, 1 );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function knatcon2020_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Sidebar Widgets.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Sidebar', 'knatcon2020' ),
				'id'          => 'sidebar-knatcon2020',
				'description' => __( 'Widgets in this area will be displayed under the Expanded / Mobile menu.', 'knatcon2020' ),
			)
		)
	);

}
// add_action( 'widgets_init', 'knatcon2020_sidebar_registration' );

/**
 * Register a new Colophon menu.
 */
function knatcon2020_register_colophon_menu() {
	register_nav_menu( 'colophon', __( 'Colophon Menu', 'knatcon2020' ) );
}
add_action( 'after_setup_theme', 'knatcon2020_register_colophon_menu' );
