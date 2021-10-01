(function( $ ) {
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

	if ( jQuery().simplyCountdown ) {
		if( cro_booster_object.hpbwc_date !== undefined && cro_booster_object.hpbwc_time !== undefined){
				var data = cro_booster_object.hpbwc_date +" "+ cro_booster_object.hpbwc_time;
				var d = new Date(data);
				var dc = new Date();
				simplyCountdown('.cro-countdown', {
		            enableUtc: true,
		            year: d.getFullYear(),
		            month: d.getMonth() + 1,
		            day: d.getDate(),
		            hours: d.getHours(),
		            minutes: d.getMinutes(),
		            seconds: d.getSeconds(),
		            zeroPad: true,
		            words: { //words displayed into the countdown
		                days: { singular: 'Day', plural: 'Days' },
		                hours: { singular: 'Hr', plural: 'Hr' },
		                minutes: { singular: 'Min', plural: 'Min' },
		                seconds: { singular: 'Sec', plural: 'Sec' }
		            },
		        });
        }
    }

})( jQuery );
