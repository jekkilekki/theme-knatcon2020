<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>

<main id="site-content" role="main">

	<figure class="featured-media error404-media">
		<div class="featured-media-inner section-inner thin">
			<img src="<?php echo get_stylesheet_directory_uri(); // phpcs:ignore ?>/img/not-good.png" />
		</div>
	</figure>

	<header class="section-inner error404-content">
		<h1 class="entry-title"><?php esc_html_e( 'Bad Luck! Page Not Found', 'knatcon2020' ); ?></h1>
	</header>

	<div class="section-inner thin error404-content">

		<div class="intro-text"><p><?php esc_html_e( 'Nothing was found here. Maybe try one of the links below or a search?', 'knatcon2020' ); ?></p></div>

		<?php
		get_search_form(
			array(
				'label' => __( '404 not found', 'knatcon2020' ),
			)
		);
		?>

	</div><!-- .section-inner -->

	<div class="section-inner error404-widgets">
		<?php

		// Display Recent Posts Widget.
		the_widget( 'WP_Widget_Recent_Posts' );

		// Display Categories Widget.
		if ( count( get_categories() ) > 2 ) :
			?>

			<div class="widget widget_categories">
				<h2 class="widgettitle"><?php esc_html_e( 'Most Used Categories', 'knatcon2020' ); ?></h2>
				<ul>
					<?php
						wp_list_categories(
							array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							)
						);
					?>
				</ul>
			</div>

			<?php
		endif;

		// Display Archives Widget.
		/* translators: %1$s: Smiley face emoji */
		$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'knatcon2020' ), convert_smilies( ':)' ) ) . '</p>';
		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

		// Display Tag Cloud Widget.
		the_widget( 'WP_Widget_Tag_Cloud' );

		?>
	</div><!-- .error404-widgets -->

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php
get_footer();
