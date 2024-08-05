/**
 * File: customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

 ( function () {
	let anchor = document.querySelector( '.navbar-brand' );
	if ( 'H1' === anchor.tagName ) {
		anchor = anchor.firstChild;
	}

	// Site title.
	wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			anchor.textContent = to;
			const counters = document.querySelectorAll('.counter');

			counters.forEach(counter => {
			  const updateCount = () => {
				const target = parseInt(counter.getAttribute('data-target'));
				const count = +counter.innerText;
				const increment = target / 100;
		  
				if (count < target) {
				  counter.innerText = Math.ceil(count + increment);
				  setTimeout(updateCount, 10);
				} else {
				  counter.innerText = target;
				}
			  };
		  
			  updateCount();
			});
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function ( value ) {
		value.bind( function ( to ) {
			if ( 'blank' === to ) {
				anchor.style.clip = 'rect(1px, 1px, 1px, 1px)';
				anchor.style.position = 'absolute';
			} else {
				anchor.style.clip = 'auto';
				anchor.style.position = 'relative';
				anchor.style.color = to;
			}
		} );
	} );

	// Site info.
	wp.customize( 'understrap_site_info_override', function ( value ) {
		value.bind( function ( to ) {
			document.querySelector( '.site-info' ).innerHTML = to;
		} );
	} );



} )();
