/**
 * File to handle fixed top menu.
 */
document.addEventListener( "DOMContentLoaded", function() {

	// Set the background gradient first.
	document.getElementBy

	var adminBar = document.getElementById( 'wpadminbar' );
	var topMenu = document.getElementById( 'site-header' );

	// Offset the page (body) by the height of the topMenu.
	if ( adminBar && document.getElementsByTagName( 'body' )[0].classList.contains( 'home' ) ) {
		document.body.style.marginTop = ( topMenu.offsetHeight + 32 ) + "px";
		topMenu.style.top = '32px';
	} else if ( adminBar ) {
		topMenu.style.top = '32px';
	} else {
		document.body.style.marginTop = topMenu.offsetHeight + "px";
	}

	// As we scroll down, hide the top menu
	var lastScrollPosition = 0;

	window.onscroll = function() {

		var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

		if ( scrollTop === 0 ) {
			topMenu.className = "header-footer-group top";
		} else {
			topMenu.className = "header-footer-group";
		}

		if ( scrollTop > lastScrollPosition && scrollTop > topMenu.offsetHeight ) { // If scrolling DOWN && past the height of the menu

			topMenu.style.top = '-200px';

		} else { // Scrolling up = SHOW menu

			if ( ! adminBar ) {
				topMenu.style.top = '0';
			} else {
				topMenu.style.top = '32px';
			}

		}

		lastScrollPosition = scrollTop <= 0 ? 0 : scrollTop;

	}

}, false );
