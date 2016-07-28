<?php if ( get_header_image() ) : ?>

	<div class="hero-area">

			<img src="<?php header_image() ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ) ?>" class="left-img">

			<?php if ( is_active_sidebar( 'hero' ) && is_front_page() ) : ?>
	
			<div class="hero-widget">
	
				<?php dynamic_sidebar( 'hero' ) ?>
	
			</div>
	
			<?php endif; ?>
	</div>

<?php endif; ?>