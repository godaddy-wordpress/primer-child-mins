/**
 * search-nav.js
 *
 * Handles toggling the search form in the navigation for non-mobile users.
 */
jQuery(window).load(function($) {

	var search_item          = document.getElementById( 'search-toggle-item' ),
	    search_button        = document.getElementById( 'search-toggle-button' );

	if ( ! search_item || ! search_button ) {

		return;

	}

	search_button.onclick = function() {

		search_item.classList.toggle( 'open' );

	};

});