<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function mins_move_elements() {

	// Hero image
	remove_action( 'primer_header', 'primer_add_hero' );
	add_action( 'primer_after_header', 'primer_add_hero' );

	// Primary navigation
	remove_action( 'primer_after_header', 'primer_add_primary_navigation' );
	add_action( 'primer_header', 'primer_add_primary_navigation' );

	// Page titles
	remove_action( 'primer_after_header', 'primer_add_page_title' );

	if ( ! is_front_page() ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

	}

}
add_action( 'template_redirect', 'mins_move_elements' );

/**
 * Add search nav toggle.
 *
 * @since 1.0.0
 */
function mins_search_toggle() {

	wp_enqueue_script( 'mins-search-nav', get_stylesheet_directory_uri() . '/assets/js/search-nav.js', array(), PRIMER_VERSION );

}
add_action( 'wp_enqueue_scripts', 'mins_search_toggle' );

/**
 * Set hero image target element.
 *
 * @filter primer_hero_image_selector
 * @since  1.0.0
 *
 * @return string
 */
function mins_hero_image_selector() {

	return '.hero';

}
add_filter( 'primer_hero_image_selector', 'mins_hero_image_selector' );

/**
 * Set custom logo args.
 *
 * @filter primer_custom_logo_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function mins_custom_logo_args( $args ) {

	$args['width']  = 325;
	$args['height'] = 50;

	return $args;

}
add_filter( 'primer_custom_logo_args', 'mins_custom_logo_args' );

/**
 * Set images sizes.
 *
 * @filter primer_image_sizes
 * @since  1.0.0
 *
 * @param  array $sizes
 *
 * @return array
 */
function mins_image_sizes( $sizes ) {

	$sizes['primer-hero']['height'] = 2000;

	return $sizes;

}
add_filter( 'primer_image_sizes', 'mins_image_sizes' );

/**
 * Set custom header args.
 *
 * @action primer_custom_header_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function mins_custom_header_args( $args ) {

	$args['height'] = 2000;

	return $args;

}
add_filter( 'primer_custom_header_args', 'mins_custom_header_args' );

/**
 * Register sidebar areas.
 *
 * @link    http://codex.wordpress.org/Function_Reference/register_sidebar
 *
 * @package mins
 * @since   1.0.0
 *
 * @param array $sidebars
 *
 * @return array
 */
function mins_sidebars( $sidebars ) {

	unset( $sidebars['sidebar-1'] );
	unset( $sidebars['sidebar-2'] );

	return $sidebars;

}
add_filter( 'primer_sidebars', 'mins_sidebars' );

/**
 * Set fonts.
 *
 * @filter primer_fonts
 * @since  1.0.0
 *
 * @param  array $fonts
 *
 * @return array
 */
function mins_update_fonts( $fonts ) {

	$fonts[] = 'Abril Fatface';
	$fonts[] = 'Raleway';
	$fonts[] = 'Roboto';

	return $fonts;

}
add_filter( 'primer_fonts', 'mins_update_fonts' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param  array $font_types
 *
 * @return array
 */
function mins_font_types( $font_types ) {

	$overrides = array(
		'header_font' => array(
			'default' => 'Roboto',
		),
		'primary_font' => array(
			'default' => 'Roboto',
		),
		'secondary_font' => array(
			'default' => 'Roboto',
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

}
add_filter( 'primer_font_types', 'mins_font_types' );

/**
 * Update colors
 *
 * @since  1.0.0
 *
 * @action primer_colors
 *
 * @return array
 */
function mins_colors() {

	return array(
		'background_color' => array(
			'default' => '#f4f4f4',
			'css'     => array(
				'.site-content',
			),
		),
		'hero_text_color' => array(
			'label'   => esc_html__( 'Hero Text Color', 'primer' ),
			'default' => '#222222',
			'css'     => array(
				'.hero-area, .hero-area a, .hero-area h1, .hero-area h2, .hero-area h3, .hero-area h4, .hero-area h5, .hero-area h6, hr, .page-title' => array(
					'color' => '%1$s',
				),
				'.hero-area .hero-widget h2.widget-title:after' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'link_color' => array(
			'label'   => esc_html__( 'Link Color', 'primer' ),
			'default' => '#62b6cb',
			'css'     => array(
				'#content a, #content a:visited, .entry-footer a, .sticky .entry-title a:before, .footer-widget-area .footer-widget .widget a, .entry-title a, .site-info-wrapper .site-info .social-menu a' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'a:hover, a:visited:hover, .entry-footer a:hover' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
			),
		),
		'w_bg' => array(
			'label'   => esc_html__( 'Widget Background', 'primer' ),
			'default' => '#fff',
			'css'     => array(
				'.site-footer' => array(
					'background-color' => '%1$s',
				),
			),
		),
	);

}
add_filter( 'primer_colors', 'mins_colors' );

/**
 * Add color schemes
 *
 * @since 1.0.0
 *
 * @action primer_color_schemes
 */
function mins_color_schemes() {

	return array(
		'seafoam' => array(
			'label'  => esc_html__( 'Seafoam', 'primer' ),
			'colors' => array(
				'background_color'        => '#c9ede3',
				'hero_text_color'         => '#000000',
				'link_color'              => '#c96050',
				'w_bg'                    => '#b5d6cd',
			),
		),
		'wheat' => array(
			'label'  => esc_html__( 'Wheat', 'primer' ),
			'colors' => array(
				'background_color'        => '#eae9dc',
				'hero_text_color'         => '#000000',
				'link_color'              => '#ff4f4f',
				'w_bg'                    => '#d3d2c7',
			),
		),
		'melancholy' => array(
			'label'  => esc_html__( 'Melancholy', 'primer' ),
			'colors' => array(
				'background_color'        => '#b1b9bf',
				'hero_text_color'         => '#000000',
				'link_color'              => '#4e5972',
				'w_bg'                    => '#a0a7ac',
			),
		),
		'foliage' => array(
			'label'  => esc_html__( 'Foliage', 'primer' ),
			'colors' => array(
				'background_color'        => '#a7caa9',
				'hero_text_color'         => '#000000',
				'link_color'              => '#fff1c6',
				'w_bg'                    => '#97b698',
			),
		),
		'ocean' => array(
			'label'  => esc_html__( 'Deep Sea', 'primer' ),
			'colors' => array(
				'background_color'        => '#051a5b',
				'hero_text_color'         => '#ffffff',
				'link_color'              => '#fff1c6',
				'w_bg'                    => '#051752',
			),
		),
		'negative' => array(
			'label'  => esc_html__( 'Negative', 'primer' ),
			'colors' => array(
				'background_color'        => '#181818',
				'hero_text_color'         => '#ffffff',
				'link_color'              => '#ccc',
				'w_bg'                    => '#212121',
			),
		),
		'immke' => array(
			'label'  => esc_html__( 'Immke', 'primer' ),
			'colors' => array(
				'background_color'        => '#010e68',
				'hero_text_color'         => '#ffffff',
				'link_color'              => '#fced4b',
				'w_bg'                    => '#43039e',
			),
		),
	);

}
add_filter( 'primer_color_schemes', 'mins_color_schemes' );

/**
 * Add default header image.
 *
 * @since  1.0.0
 *
 * @action primer_after_header
 *
 * @param array $args
 *
 * @return array
 */
function mins_update_header_image_args( $args ) {

	$args['width']         = 1300;
	$args['height']        = 1245;
	$args['flex-height']   = false;
	$args['default-image'] = get_stylesheet_directory_uri() . '/assets/images/default-header.jpg';

	return $args;
}
add_filter( 'primer_custom_header_args', 'mins_update_header_image_args', 20 );

/**
 * Add search menu icon to primary nav menu.
 *
 * @since  1.0.0
 *
 * @action wp_nav_menu_items
 *
 * @param string $items
 * @param array $args
 *
 * @return string
 */
function mins_add_search_to_nav_menu( $items, $args ) {

	if( 'primary' === $args->theme_location ) {

		$items .= '<li id="search-toggle-item" class="menu-item menu-item-search"><a href="#" id="search-toggle-button" class="search-toggle"><span class="genericon genericon-search"></span></a>' . get_search_form(false) . '</li>';

	}

	return $items;

}
add_filter( 'wp_nav_menu_items', 'mins_add_search_to_nav_menu', 10, 2 );
