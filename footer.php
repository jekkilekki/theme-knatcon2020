<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>
			<footer id="site-footer" role="contentinfo" class="header-footer-group">

				<div class="section-inner">

					<div class="footer-credits">

						<p class="footer-copyright">&copy;
							<?php
							echo esc_html(
								date_i18n(
									/* translators: Copyright date format, see https://secure.php.net/date */
									_x( 'Y', 'copyright date format', 'edxchildtheme' )
								)
							);
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo bloginfo( 'name' ); ?></a>
						</p><!-- .footer-copyright -->

						<p class="powered-by-wordpress">
							<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'edxchildtheme' ) ); ?>">
								<?php esc_html_e( 'Powered by WordPress', 'edxchildtheme' ); ?>
							</a>
						</p><!-- .powered-by-wordpress -->

					</div><!-- .footer-credits -->

					<a class="to-the-top" href="#site-header">
						<span class="to-the-top-long">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( esc_html__( 'To the top %s', 'edxchildtheme' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-long -->
						<span class="to-the-top-short">
							<?php
							/* translators: %s: HTML character for up arrow */
							printf( esc_html__( 'Up %s', 'edxchildtheme' ), '<span class="arrow" aria-hidden="true">&uarr;</span>' );
							?>
						</span><!-- .to-the-top-short -->
					</a><!-- .to-the-top -->

				</div><!-- .section-inner -->

			</footer>

			<footer id="colophon">

				<div class="section-inner footer-colophon-menu">

					<nav aria-label="<?php esc_attr_e( 'Colophon Menu', 'edxchildtheme' ); ?>" role="navigation" class="footer-menu-wrapper">

						<ul class="footer-menu colophon-menu">
							<?php
							wp_nav_menu(
								array(
									'container'      => '',
									'depth'          => 1,
									'items_wrap'     => '%3$s',
									'theme_location' => 'colophon',
								)
							);
							?>
						</ul>

					</nav><!-- .site-nav -->

				</div>

			</footer><!-- #site-footer -->

		<?php wp_footer(); ?>

	</body>
</html>
