<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package First
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>
		<?php if ( has_nav_menu( 'footer' ) || get_theme_mod( 'first_footer_text' ) || ! get_theme_mod( 'first_hide_credit' ) ) : ?>
		<div class="site-bottom">
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav id="footer-navigation" class="footer-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer' , 'depth' => 1 ) ); ?>
			</nav><!-- #footer-navigation -->
			<?php endif; ?>
			<div class="site-info">
				<?php if ( get_theme_mod( 'first_footer_text' ) ) : ?>
				<div class="site-copyright">
					<?php echo get_theme_mod( 'first_footer_text' ); ?>
				</div>
				<?php endif; ?>
				<?php if ( ! get_theme_mod( 'first_hide_credit' ) ) : ?>
				<div class="site-credit">
					<?php printf( __( 'Powered by <a href="%1$s">%2$s</a>', 'first' ), esc_url( __( 'http://wordpress.org/', 'first' ) ), 'WordPress' ); ?>
				<span class="sep"> | </span>
					<?php printf( __( 'Theme by <a href="%1$s">%2$s</a>', 'first' ), esc_url( __( 'http://themehaus.net/', 'first' ) ), 'Themehaus' ); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
