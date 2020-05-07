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

/* Add excerpts to Pages */
add_post_type_support( 'page', 'excerpt' );

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
// add_action( 'widgets_init', 'knatcon2020_sidebar_registration' );.

/**
 * Setup Theme.
 */
function knatcon2020_setup_theme() {
	/**
	 * Register Colophon menu.
	 */
	register_nav_menu( 'colophon', __( 'Colophon Menu', 'knatcon2020' ) );

	/**
	 * Add support for block color palettes.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/extensibility/theme-support/
	 */
	$knatcon2020_colors = array(
		array(
			'name'  => __( 'Gradient green dark', 'gaya' ),
			'slug'  => 'gradient-green-dark',
			'color' => 'rgb(0, 120, 100)',
		),
		array(
			'name'  => __( 'Gradient green light', 'gaya' ),
			'slug'  => 'gradient-green-light',
			'color' => 'rgb(61, 184, 129)',
		),
		array(
			'name'  => __( 'Gradient yellow', 'gaya' ),
			'slug'  => 'gradient-yellow',
			'color' => 'rgb(251, 209, 161)',
		),
		array(
			'name'  => __( 'Gradient red', 'gaya' ),
			'slug'  => 'gradient-red',
			'color' => 'rgb(239, 120, 138)',
		),
		array(
			'name'  => __( 'Gradient purple', 'gaya' ),
			'slug'  => 'gradient-purple',
			'color' => 'rgb(102, 78, 160)',
		),
		array(
			'name'  => __( 'Grey', 'gaya' ),
			'slug'  => 'grey',
			'color' => 'rgb(176, 190, 197)',
		),
		array(
			'name'  => __( 'Highlight green', 'gaya' ),
			'slug'  => 'highlight-green',
			'color' => 'rgb(0, 120, 50)',
		),
		array(
			'name'  => __( 'Highlight purple', 'gaya' ),
			'slug'  => 'highlight-purple',
			'color' => 'rgb(75, 12, 120)',
		),
		array(
			'name'  => __( 'Almost black', 'gaya' ),
			'slug'  => 'almost-black',
			'color' => '#101025',
		),
	);

	add_theme_support(
		'editor-color-palette',
		$knatcon2020_colors
	);
}
add_action( 'after_setup_theme', 'knatcon2020_setup_theme', 20 );

/**
 * Redirect Login page (we hope).
 */
function knatcon2020_custom_login_page() {

	$new_login_page_url = home_url( '/login/' ); // new login page.

	global $pagenow;

	if ( 'wp-login.php' === $pagenow && isset( $_SERVER['REQUEST_METHOD'] ) && 'GET' === $_SERVER['REQUEST_METHOD'] ) {
		wp_safe_redirect( $new_login_page_url );
		exit;
	}
}

/*
Redirect all non-logged in users to the login page (now unnecessary).
if ( ! is_user_logged_in() ) {
	// add_action( 'init', 'knatcon2020_custom_login_page' );
}
*/

/**
 * Private Posts visible to Subscribers
 * Run once
 */
function knatcon2020_subscribers_read_private_posts() {
	$sub_role = get_role( 'subscriber' );
	$sub_role->add_cap( 'read_private_posts' );
	$sub_role->add_cap( 'read_private_pages' );
}
add_action( 'init', 'knatcon2020_subscribers_read_private_posts' );

/**
 * Change Jetpack Portfolio slug.
 *
 * @param array  $args Arguments for the register_post_type.
 * @param string $post_type String of the $post_type.
 *
 * @link https://docs.themeisle.com/article/888-change-the-slug-of-portfolio-post-type
 */
function update_portfolios_slug( $args, $post_type ) {
	if ( 'jetpack-portfolio' === $post_type ) {
		$args['rewrite']['slug'] = 'sessions';
	}
	return $args;
}
add_filter( 'register_post_type_args', 'update_portfolios_slug', 10, 2 );
// add_filter( 'jetpack_development_mode', '__return_true' );.

/**
 * Filter the Post Title to remove "Protected" and "Private"
 *
 * @param String $title The post title to be filtered.
 *
 * @link https://css-tricks.com/snippets/wordpress/remove-privateprotected-from-post-titles/
 */
function knatcon2020_title_trim( $title ) {

	$title = esc_attr( $title );

	$findthese = array(
		'#Protected:#',
		'#Private:#',
	);

	$replacewith = array(
		'', // What to replace "Protected:" with.
		'', // What to replace "Private:" with.
	);

	$title = preg_replace( $findthese, $replacewith, $title );
	return $title;
}
add_filter( 'the_title', 'knatcon2020_title_trim' );
