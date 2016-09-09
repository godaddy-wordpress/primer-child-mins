<?php
/**
 * Template part for displaying the post excerpt inside The Loop.
 *
 * @package Primer
 */
?>

<div class="entry-summary">

	<?php the_excerpt(); ?>

	<p><a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Continue Reading', 'primer' ); ?></a></p>

</div><!-- .entry-summary -->
