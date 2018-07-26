<?php

/**
 * Child theme version.
 *
 * @since 1.0.0
 *
 * @var string
 */
define( 'PRIMER_CHILD_VERSION', '1.1.4' );

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function mins_move_elements() {

	remove_action( 'primer_header',                'primer_add_hero',               7 );
	remove_action( 'primer_after_header',          'primer_add_primary_navigation', 11 );
	remove_action( 'primer_after_header',          'primer_add_page_title',         12 );
	remove_action( 'primer_before_header_wrapper', 'primer_video_header',           5 );

	add_action( 'primer_after_header', 'primer_add_hero',               7 );
	add_action( 'primer_header',       'primer_add_primary_navigation', 11 );
	add_action( 'primer_hero',         'primer_video_header',           3 );

	if ( ! is_front_page() || ! is_active_sidebar( 'hero' ) ) {

		add_action( 'primer_hero', 'primer_add_page_title', 12 );

	}

}
add_action( 'template_redirect', 'mins_move_elements' );

/**
 * Add search nav toggle.
 *
 * @action wp_enqueue_scripts
 * @since  1.0.0
 */
function mins_search_toggle() {

	wp_enqueue_script( 'mins-search-nav', get_stylesheet_directory_uri() . '/assets/js/search-nav.js', array( 'jquery' ), PRIMER_VERSION );

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
 * Set sidebars.
 *
 * @filter primer_sidebars
 * @since  1.0.0
 *
 * @param  array $sidebars
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
function mins_fonts( $fonts ) {

	$fonts[] = 'Roboto';

	return $fonts;

}
add_filter( 'primer_fonts', 'mins_fonts' );

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
		'site_title_font' => array(
			'default' => 'Roboto',
		),
		'navigation_font' => array(
			'default' => 'Roboto',
		),
		'heading_font' => array(
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
 * Set colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function mins_colors( $colors ) {

	unset(
		$colors['content_background_color'],
		$colors['footer_widget_content_background_color']
	);

	$overrides = array(
		/**
		 * Text colors
		 */
		'header_textcolor' => array(
			'default' => '#252525',
		),
		'tagline_text_color' => array(
			'default' => '#686868',
		),
		'hero_text_color' => array(
			'default' => '#252525',
		),
		'menu_text_color' => array(
			'default' => '#252525',
		),
		'heading_text_color' => array(
			'default' => '#353535',
			'css'     => array(
				'.hentry .page-title:after,
				.hentry .entry-title:after' => array(
					'background' => '%1$s',
				),
			),
		),
		'primary_text_color' => array(
			'default' => '#252525',
		),
		'secondary_text_color' => array(
			'default' => '#686868',
		),
		'footer_widget_heading_text_color' => array(
			'default' => '#353535',
			'css'     => array(
				'.footer-widget-area .footer-widget .widget-title:after' => array(
					'background' => '%1$s',
				),
			),
		),
		'footer_widget_text_color' => array(
			'default' => '#252525',
		),
		'footer_menu_text_color' => array(
			'default' => '#686868',
		),
		'footer_text_color' => array(
			'default' => '#686868',
		),
		/**
		 * Link / Button colors
		 */
		'link_color' => array(
			'default' => '#62b6cb',
		),
		'button_color' => array(
			'default' => '#62b6cb',
			'css'     => array(
				'.hero a.button:focus,
				button,
				a.button, a.button:visited,
				.content-area .fl-builder-content a.fl-button,
				.content-area .fl-builder-content a.fl-button:visited,
				input[type="button"], input[type="reset"], input[type="submit"]' => array(
					'background-color' => 'transparent',
				),
				'button:hover, button:active, button:focus,
				a.button:hover, a.button:active, a.button:focus, a.button:visited:hover, a.button:visited:active, a.button:visited:focus,
				.content-area .fl-builder-content a.fl-button:hover, .content-area .fl-builder-content a.fl-button:active, .content-area .fl-builder-content a.fl-button:focus, .content-area .fl-builder-content a.fl-button:visited:hover, .content-area .fl-builder-content a.fl-button:visited:active, .content-area .fl-builder-content a.fl-button:visited:focus,
				input[type="button"]:hover, input[type="button"]:active, input[type="button"]:focus,
				input[type="reset"]:hover, input[type="reset"]:active, input[type="reset"]:focus,
				input[type="submit"]:hover, input[type="submit"]:active, input[type="submit"]:focus' => array(
					'color' => '%1$s',
				),
			),
		),
		'button_text_color' => array(
			'default'  => '#252525',
		),
		/**
		 * Background colors
		 */
		'background_color' => array(
			'default' => '#ffffff',
		),
		'hero_background_color' => array(
			'default' => '#f5f5f5',
		),
		'menu_background_color' => array(
			'default' => '#ffffff',
			'css'     => array(
				'.site-header' => array(
					'background-color' => '%1$s',
				),
			),
		),
		'footer_widget_background_color' => array(
			'default' => '#f5f5f5',
		),
		'footer_background_color' => array(
			'default' => '#ffffff',
		),
	);

	return primer_array_replace_recursive( $colors, $overrides );

}
add_filter( 'primer_colors', 'mins_colors' );

/**
 * Set color schemes.
 *
 * @filter primer_color_schemes
 * @since  1.0.0
 *
 * @param  array $color_schemes
 *
 * @return array
 */
function mins_color_schemes( $color_schemes ) {

	$overrides = array(
		'blush' => array(
			'colors' => array(
				'link_color'   => $color_schemes['blush']['base'],
				'button_color' => $color_schemes['blush']['base'],
			),
		),
		'bronze' => array(
			'colors' => array(
				'link_color'   => $color_schemes['bronze']['base'],
				'button_color' => $color_schemes['bronze']['base'],
			),
		),
		'canary' => array(
			'colors' => array(
				'link_color'   => $color_schemes['canary']['base'],
				'button_color' => $color_schemes['canary']['base'],
			),
		),
		'cool' => array(
			'colors' => array(
				'link_color'   => $color_schemes['cool']['base'],
				'button_color' => $color_schemes['cool']['base'],
			),
		),
		'dark' => array(
			'colors' => array(
				// Text
				'header_textcolor'                 => '#ffffff',
				'tagline_text_color'               => '#999999',
				'hero_text_color'                  => '#ffffff',
				'menu_text_color'                  => '#ffffff',
				'heading_text_color'               => '#ffffff',
				'primary_text_color'               => '#e5e5e5',
				'secondary_text_color'             => '#c1c1c1',
				'footer_widget_heading_text_color' => '#ffffff',
				'footer_widget_text_color'         => '#ffffff',
				// Links & Buttons
				'button_text_color' => '#ffffff',
				// Backgrounds
				'background_color'               => '#222222',
				'hero_background_color'          => '#282828',
				'menu_background_color'          => '#333333',
				'footer_widget_background_color' => '#282828',
				'footer_background_color'        => '#222222',
			),
		),
		'iguana' => array(
			'colors' => array(
				'link_color'   => $color_schemes['iguana']['base'],
				'button_color' => $color_schemes['iguana']['base'],
			),
		),
		'muted' => array(
			'colors' => array(
				// Text
				'header_textcolor'                 => '#4f5875',
				'tagline_text_color'               => '#888c99',
				'hero_text_color'                  => '#ffffff',
				'menu_text_color'                  => '#4f5875',
				'heading_text_color'               => '#4f5875',
				'primary_text_color'               => '#4f5875',
				'secondary_text_color'             => '#888c99',
				'footer_widget_heading_text_color' => '#ffffff',
				'footer_widget_text_color'         => '#ffffff',
				'footer_menu_text_color'           => $color_schemes['muted']['base'],
				'footer_text_color'                => '#888c99',
				// Links & Buttons
				'link_color'        => $color_schemes['muted']['base'],
				'button_color'      => $color_schemes['muted']['base'],
				'button_text_color' => '#ffffff',
				// Backgrounds
				'background_color'               => '#ffffff',
				'hero_background_color'          => '#b7bac8',
				'menu_background_color'          => '#ffffff',
				'footer_widget_background_color' => '#d5d6e0',
				'footer_background_color'        => '#ffffff',
			),
		),
		'plum' => array(
			'colors' => array(
				'link_color'   => $color_schemes['plum']['base'],
				'button_color' => $color_schemes['plum']['base'],
			),
		),
		'rose' => array(
			'colors' => array(
				'link_color'   => $color_schemes['rose']['base'],
				'button_color' => $color_schemes['rose']['base'],
			),
		),
		'tangerine' => array(
			'colors' => array(
				'link_color'   => $color_schemes['tangerine']['base'],
				'button_color' => $color_schemes['tangerine']['base'],
			),
		),
		'turquoise' => array(
			'colors' => array(
				'link_color'   => $color_schemes['turquoise']['base'],
				'button_color' => $color_schemes['turquoise']['base'],
			),
		),
	);

	return primer_array_replace_recursive( $color_schemes, $overrides );

}
add_filter( 'primer_color_schemes', 'mins_color_schemes' );
