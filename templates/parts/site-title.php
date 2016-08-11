<?php
/**
 * Displays the site title.
 *
 * @package Primer
 */
?>
<?php if ( has_custom_logo() ) : ?>

	<h1 class="site-logo">

		<?php the_custom_logo(); ?>

	</h1>


<?php else : ?>

	<div class="site-title-contain">

		<h1 class="site-title">

			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>

		</h1>

		<div class="site-description"><?php bloginfo( 'description' ); ?></div>

	</div>

<?php endif; ?>
