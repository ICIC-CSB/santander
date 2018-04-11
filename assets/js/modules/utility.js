jQuery(document).ready(function($) {

	'use strict';

	WPX.Utility = {

		$loginMiniWrapClose: $(".close-login-mini-wrap"),
		$loginMiniWrap: $('.login-mini-wrap'),
		$loginMiniForm: $('#loginform-mini'),

		init: function() {
			
			this.bindEvents();

		},

		/** 
		 * bind all events
		*/
		bindEvents: function() {

			// validate forms
			WPX.Utility.$loginMiniForm.addClass('validate');
			$('form.validate').each(function( index ) {
				$(this).find('input[type="text"]').addClass('required').addClass('email');
				$(this).find('input[type="password"]').addClass('required');
				$(this).validate();
			});

			$( "#menu-primary-navigation .featured > a" ).click(function(event) {
				if (WPX.Layout.$mobileState === true) {
					event.preventDefault();
					WPX.Utility.$loginMiniWrap.addClass('opened');
				}
			});

			$( "#expose-profile-email" ).click(function(event) {
				event.preventDefault();
				$(this).closest('.profile-data-block').addClass('active');
				$(this).closest('.tml-profile').addClass('active');
			});

			$( "#expose-profile-password" ).click(function(event) {
				event.preventDefault();
				$(this).closest('.profile-data-block').addClass('active');
				$(this).closest('.tml-profile').addClass('active');
			});

			WPX.Utility.$loginMiniWrapClose.click(function(event) {
				event.preventDefault();
				WPX.Utility.$loginMiniWrap.removeClass('opened');
			});

		}

	};

	WPX.Utility.init();

});