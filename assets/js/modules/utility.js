jQuery(document).ready(function($) {

	'use strict';

	WPX.Utility = {

		$loginMiniWrapClose: $(".close-login-mini-wrap"),
		$loginMiniWrap: $('.login-mini-wrap'),
		$loginMiniForm: $('#loginform-mini'),
		$mainLoginForm: $('.login-area #loginform'),

		init: function() {
			
			this.bindEvents();

		},

		/** 
		 * bind all events
		*/
		bindEvents: function() {

			// validate forms
			WPX.Utility.$loginMiniForm.addClass('validate');
			WPX.Utility.$mainLoginForm.addClass('validate');

			$('#loginform').each(function( index ) {
				$(this).find('#user_login').addClass('required').addClass('email');
				$(this).find('#user_pass').addClass('required');
				$(this).validate();
			});

			$('#loginform-mini').each(function( index ) {
				$(this).find('#user_login_mini').addClass('required').addClass('email');
				$(this).find('#user_pass_mini').addClass('required');
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

			$( "#menu-primary-navigation .featured > a" ).hover(
			  function() {
				if (WPX.Layout.$mobileState === true) {
					// no
				} else {
					$(this).closest('li').find('.login-mini-wrap').show();
				}
			  }, function() {}
			);

			WPX.Utility.$loginMiniWrapClose.click(function(event) {
				event.preventDefault();
				if (WPX.Layout.$mobileState === true) {
					WPX.Utility.$loginMiniWrap.removeClass('opened');
				} else {
					$(this).closest('li').find('.login-mini-wrap').hide();
				}
			});

		}

	};

	WPX.Utility.init();

});