(function ($) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 


})(jQuery);

jQuery(document).ready(function ($) {
	setInterval(function() {
		var data = {
			'action': 'get_cart_details',
		};
		$.ajax({
			url: ajax_object.ajax_url,
			type: 'post',
			data: data,
			success: function (response) {
				 
				// Access the properties in the response object
				var subtotal = response.subtotal;
				var cartDetails = response.cart_details;
				var menuOption = response.menu_items_option;
				var dData = '';
				if ( menuOption == 'items-only') {
					dData += "<a href = 'http://wordpress.local/checkout-2/'>" + cartDetails + " Items </a>";
				}
				if ( menuOption == 'price-only') {
					dData +=  "<a href = 'http://wordpress.local/checkout-2/'> $" + subtotal + "</a>";
				}
				if ( menuOption == 'both-items-price') {
					dData += "<a href = 'http://wordpress.local/checkout-2/'>" + cartDetails + " Items $" + subtotal + "</a>";
				}
		
				$('#cart-details').html( "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdCE3tFeFd1rj-DUfzwtY-b5w2k5rFa4wJLw&usqp=CAU' width='30' height='30'> "+ dData );
			},
			error: function (error) {
				console.error('error:', error);
			}
		});
	}, 1000); // Check every 1 second (adjust as needed)
});