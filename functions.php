<?php

/**
 * Register custom Custom Navigation Menus.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_nav_menus
 */
function mins_register_menus() {

	register_nav_menus(
		array(
			'footer'	=> esc_html__( 'Footer', 'mins' )
		)
	);

}
add_action( 'after_setup_theme', 'mins_register_menus' );

/**
 * Add image size for hero image
 *
 * @link https://codex.wordpress.org/Function_Reference/add_image_size
 */
function mins_add_image_size() {

	add_image_size( 'hero', 2400, 1320, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'mins_add_image_size' );

/**
 * Remove primer navigation and add mins navigation
 */
function mins_navigation() {
	wp_dequeue_script( 'primer-navigation' );
	wp_enqueue_script( 'mins-navigation', get_stylesheet_directory_uri() . '/assets/js/navigation.js', array( 'jquery' ), '20120206', true );
}
add_action( 'wp_print_scripts', 'mins_navigation', 100 );

/**
 * Add mobile menu to header
 *
 * @link https://codex.wordpress.org/Function_Reference/get_template_part
 */
function mins_add_mobile_menu() {
	get_template_part( 'templates/parts/mobile-menu' );
}
add_action( 'primer_header', 'mins_add_mobile_menu', 0 );

/**
 * Update custom header arguments
 *
 * @param $args
 * @return mixed
 */
function primer_update_custom_header_args( $args ) {
	$args['width'] = 2400;
	$args['height'] = 1320;

	return $args;
}
add_filter( 'primer_custom_header_args', 'primer_update_custom_header_args' );

/**
 * Register hero sidebar
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function mins_register_hero_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Hero', 'mins' ),
		'id'            => 'hero',
		'description'   => __( 'The hero appears in the hero widget area on the front page', 'mins' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mins_register_hero_sidebar' );

/**
 * Get header image with image size
 *
 * @return false|string
 */
function mins_get_header_image() {
	$image_size = (int) get_theme_mod( 'full_width' ) === 1 ? 'hero-2x' : 'hero';
	$custom_header = get_custom_header();
	
	if ( ! empty( $custom_header->attachment_id ) ) {
		$image = wp_get_attachment_image_url( $custom_header->attachment_id, $image_size );
		if ( getimagesize( $image ) ) {
			return $image;
		}
	}
	$header_image = get_header_image();

	return $header_image;
}

/**
 * Remove sidebar
 *
 */
function mins_remove_widgets() {

	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );

}

add_action( 'widgets_init', 'mins_remove_widgets', 11 );

function mins_update_fonts() {
	return array(
		'Roboto',
		'Abril Fatface',
		'Raleway'
	);
}
add_filter( 'primer_fonts', 'mins_update_fonts' );

/**
 * Update font types
 *
 * @return array
 */
function mins_update_font_types() {
    return array(
        array(
            'name'    => 'primary_font',
            'label'   => __( 'Primary Font', 'primer' ),
            'default' => 'Roboto',
            'css'     => array(
	            '.cta, .site-info-wrapper, .comment-author, .comment-metadata, #respond, .entry-title, .read-more, button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"], .featured-content .entry-title, .featured-content .read-more, .entry-meta li, .event-meta, .sermon-meta, .location-meta, .person-meta, .post-format, article.format-link .entry-title, header .social-menu a, .widget-title, label, header .main-navigation-container .menu li a, .entry-footer, .more-link, h1, h2, h3, h4' => array( 'font-family' => '"%s", sans-serif' )
	        ),
            'weight'   => array(
                100, 300, 700
            )
        ),
        array(
            'name'    => 'secondary_font',
            'label'   => __( 'Secondary Font', 'primer' ),
            'default' => 'Roboto',
            'css'     => array(
				'body, input, select, textarea, .hero-widget div.textwidget, .widget, .widget p, .widget ul, .widget ol, .entry-content p, .entry-summary p, h5, h6' => array( 'font-family' => '"%s", sans-serif' )
            )
        ),
    );
}
add_action( 'primer_font_types', 'mins_update_font_types' );

function escapade_font_weight( $weights, $font ) {

    return ( 'Roboto' === $font ) ? [ 700, 300, 100 ] : $weights;

}
add_filter( 'primer_font_weights', 'escapade_font_weight', 10, 2 );

/**
 * Add Social links to primary navigation area.
 *
 * @action primer_after_header
 */
function mins_add_social_to_header(){

	if ( has_nav_menu( 'social' ) ) :

		get_template_part( 'templates/parts/social-menu' );

	endif;

}
add_action( 'primer_after_header', 'mins_add_social_to_header', 30 );

/**
 * Remove customizer features added by the parent theme that are not applicable to this theme
 * 
 * @action after_setup_theme
 */
function mins_remove_customizer_features($wp_customize){

	$wp_customize->remove_section('layout');

}
add_action( 'customize_register', 'mins_remove_customizer_features', 30 );

/**
 * Update colors
 * 
 * @action primer_colors
 */
function mins_colors() {
  return array(
				array(
					'name'    => 'header_textcolor',
					'default' => '#fff',
					'css'     => array(
						'.side-masthead .site-description, .hero-widget, header .main-navigation-container .menu li a, .main-navigation-container .menu li.current-menu-item > a, .main-navigation-container .menu li.current-menu-item > a:hover, .side-masthead .site-title a, .side-masthead .site-title a:hover, .hero-widget h2.widget-title' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'background_color',
					'default' => '#fff',
				),
				array(
					'name'    => 'header_backgroundcolor',
					'label'   => __( 'Header Background Color', 'primer' ),
					'default' => '#222',
					'css'     => array(
						'.side-masthead, header .main-navigation-container .menu li.menu-item-has-children:hover > ul' => array(
							'background-color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'link_color',
					'label'   => __( 'Link Color', 'primer' ),
					'default' => '#8bd1e5',
					'css'     => array(
						'a, a:visited, .entry-footer a, .sticky .entry-title a:before' => array(
							'color' => '%1$s',
						)
					),
					'rgba_css' => array(
						'a:hover, a:visited:hover, .entry-footer a:hover' => array(
							'color' => 'rgba(%1$s, 0.75)',
						),
						'button:hover, a.button:hover, a.button:visited:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .site-info-wrapper:hover .site-info:hover .social-menu a:hover' => array(
							'background-color' => 'rgba(%1$s, 0.75)',
						),
					),
				),
				array(
					'name'    => 'main_text_color',
					'label'   => __( 'Main Text Color', 'primer' ),
					'default' => '#212121',
					'css'     => array(
						'.site-content, .site-content h1, .site-content h2, .site-content h3, .site-content h4, .site-content h5, .site-content h6, .site-content p, .site-content blockquote, legend' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'secondary_text_color',
					'label'   => __( 'Secondary Text Color', 'primer' ),
					'default' => '#999999',
					'css'     => array(
						'.side-masthead .social-menu a, .entry-meta li, .side-masthead .social-menu a:hover' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'button_color',
					'label'   => __( 'Button Color', 'primer' ),
					'default' => '#55b74e',
					'css'     => array(
						'.cta, button, a.button, a.button:visited, input[type="button"], input[type="reset"], input[type="submit"]' => array(
							'background-color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'w_text_color',
					'label'   => __( 'Widget Text Color', 'primer' ),
					'default' => '#fff',
					'css'     => array(
						'.footer-widget-area, .footer-widget .widget-title, .site-footer, .footer-widget-area .footer-widget .widget, .footer-widget-area .footer-widget .widget-title' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'w_background_color',
					'label'   => __( 'Widget Background Color', 'primer' ),
					'default' => '#414242',
					'css'     => array(
						'.site-footer' => array(
							'background-color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'footer_textcolor',
					'label'   => __( 'Footer Text Color', 'primer' ),
					'default' => '#fff',
					'css'     => array(
						'.site-info-wrapper a, .site-info .social-menu a' => array(
							'color' => '%1$s',
						),
					),
				),
				array(
					'name'    => 'footer_backgroundcolor',
					'label'   => __( 'Footer Background Color', 'primer' ),
					'default' => '#191919',
					'css'     => array(
						'.site-info-wrapper' => array(
							'background-color' => '%1$s',
						),
					),
				),
			);
}
add_action( 'primer_colors', 'mins_colors', 30 );

function mins_color_schemes() {
	return array(
				'sepia' => array(
					'label'  => __( 'Sepia', 'primer' ),
					'colors' => array(
						'header_textcolor'         => '#efece4',
						'header_backgroundcolor'   => '#201b14',
						'background_color'         => '#efece4',
						'link_color'               => '#e54447',
						'main_text_color'          => '#2d271e',
						'secondary_text_color'     => '#b2aa96',
						'button_color'			   => '#eda246',
						'w_text_color'			   => '#b2aa96',
						'w_background_color'	   => '#363027',
						'footer_textcolor'		   => '#b2aa96',
						'footer_backgroundcolor'   => '#2d271e',
					),
				)
	);
}
add_action( 'primer_color_schemes', 'mins_color_schemes' );

function mins_add_default_header_image($array) {
	$array['default-image'] = get_stylesheet_directory_uri() . '/assets/images/default-header.jpg';
	
	return $array;
}
add_filter( 'primer_custom_header_args', 'mins_add_default_header_image', 20 );


/**
 * Move navigation
 * 
 * @action primer_after_header
 */
function mins_move_nav_markup() {

	remove_action( 'primer_after_header', 'primer_add_primary_navigation', 20);

	add_action( 'primer_header', 'primer_add_primary_navigation', 21);
	 
}
add_action( 'init', 'mins_move_nav_markup', 30 );

/**
 * Display hero in the header
 *
 * @action primer_after_header
 */
function mins_add_hero(){
	if( is_front_page() ) {
		get_template_part( 'templates/parts/hero' );
	}
}
add_action( 'primer_after_header', 'mins_add_hero', 30 );

function mins_add_search_menu ( $items, $args ) {

	if( 'primary' === $args -> theme_location ) {
		$items .= '<li class="menu-item menu-item-search">';
		$items .= '<a href="#" class="search-toggle"><span class="genericon genericon-search"></span></a>';
		$items .= get_search_form(false);
		$items .= '</li>';
	}
return $items;
}
add_filter('wp_nav_menu_items','mins_add_search_menu',10,2);