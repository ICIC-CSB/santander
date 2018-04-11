/*!
 * imagesLoaded PACKAGED v4.1.1
 * JavaScript is all like "You images are done yet or what?"
 * MIT License
 */

!function(t,e){"function"==typeof define&&define.amd?define("ev-emitter/ev-emitter",e):"object"==typeof module&&module.exports?module.exports=e():t.EvEmitter=e()}("undefined"!=typeof window?window:this,function(){function t(){}var e=t.prototype;return e.on=function(t,e){if(t&&e){var i=this._events=this._events||{},n=i[t]=i[t]||[];return-1==n.indexOf(e)&&n.push(e),this}},e.once=function(t,e){if(t&&e){this.on(t,e);var i=this._onceEvents=this._onceEvents||{},n=i[t]=i[t]||{};return n[e]=!0,this}},e.off=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=i.indexOf(e);return-1!=n&&i.splice(n,1),this}},e.emitEvent=function(t,e){var i=this._events&&this._events[t];if(i&&i.length){var n=0,o=i[n];e=e||[];for(var r=this._onceEvents&&this._onceEvents[t];o;){var s=r&&r[o];s&&(this.off(t,o),delete r[o]),o.apply(this,e),n+=s?0:1,o=i[n]}return this}},t}),function(t,e){"use strict";"function"==typeof define&&define.amd?define(["ev-emitter/ev-emitter"],function(i){return e(t,i)}):"object"==typeof module&&module.exports?module.exports=e(t,require("ev-emitter")):t.imagesLoaded=e(t,t.EvEmitter)}(window,function(t,e){function i(t,e){for(var i in e)t[i]=e[i];return t}function n(t){var e=[];if(Array.isArray(t))e=t;else if("number"==typeof t.length)for(var i=0;i<t.length;i++)e.push(t[i]);else e.push(t);return e}function o(t,e,r){return this instanceof o?("string"==typeof t&&(t=document.querySelectorAll(t)),this.elements=n(t),this.options=i({},this.options),"function"==typeof e?r=e:i(this.options,e),r&&this.on("always",r),this.getImages(),h&&(this.jqDeferred=new h.Deferred),void setTimeout(function(){this.check()}.bind(this))):new o(t,e,r)}function r(t){this.img=t}function s(t,e){this.url=t,this.element=e,this.img=new Image}var h=t.jQuery,a=t.console;o.prototype=Object.create(e.prototype),o.prototype.options={},o.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},o.prototype.addElementImages=function(t){"IMG"==t.nodeName&&this.addImage(t),this.options.background===!0&&this.addElementBackgroundImages(t);var e=t.nodeType;if(e&&d[e]){for(var i=t.querySelectorAll("img"),n=0;n<i.length;n++){var o=i[n];this.addImage(o)}if("string"==typeof this.options.background){var r=t.querySelectorAll(this.options.background);for(n=0;n<r.length;n++){var s=r[n];this.addElementBackgroundImages(s)}}}};var d={1:!0,9:!0,11:!0};return o.prototype.addElementBackgroundImages=function(t){var e=getComputedStyle(t);if(e)for(var i=/url\((['"])?(.*?)\1\)/gi,n=i.exec(e.backgroundImage);null!==n;){var o=n&&n[2];o&&this.addBackground(o,t),n=i.exec(e.backgroundImage)}},o.prototype.addImage=function(t){var e=new r(t);this.images.push(e)},o.prototype.addBackground=function(t,e){var i=new s(t,e);this.images.push(i)},o.prototype.check=function(){function t(t,i,n){setTimeout(function(){e.progress(t,i,n)})}var e=this;return this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?void this.images.forEach(function(e){e.once("progress",t),e.check()}):void this.complete()},o.prototype.progress=function(t,e,i){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded,this.emitEvent("progress",[this,t,e]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,t),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&a&&a.log("progress: "+i,t,e)},o.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(t,[this]),this.emitEvent("always",[this]),this.jqDeferred){var e=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[e](this)}},r.prototype=Object.create(e.prototype),r.prototype.check=function(){var t=this.getIsImageComplete();return t?void this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),void(this.proxyImage.src=this.img.src))},r.prototype.getIsImageComplete=function(){return this.img.complete&&void 0!==this.img.naturalWidth},r.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.img,e])},r.prototype.handleEvent=function(t){var e="on"+t.type;this[e]&&this[e](t)},r.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},r.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},r.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(r.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url;var t=this.getIsImageComplete();t&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(t,e){this.isLoaded=t,this.emitEvent("progress",[this,this.element,e])},o.makeJQueryPlugin=function(e){e=e||t.jQuery,e&&(h=e,h.fn.imagesLoaded=function(t,e){var i=new o(this,t,e);return i.jqDeferred.promise(h(this))})},o.makeJQueryPlugin(),o});


var DEBUG = false;


/* SP general modal content opener
 * params: title, content, width, height - expected as object
 * title, content: html string expected
 * width, height: integer
 * all optional except content
*/
Modal = function() {
	var params = {
		'title': false,
		'content': false,
		'width': 'inherit',
		'height': 'inherit',
		'close': true,
		'callback': function() {}
	};
	
	var myself = this;
	var $ = jQuery;
	
	this.closeit = function() {
		$(".overlay").fadeOut('fast');
		$(".modal").fadeOut('fast', function() {
			$(this).remove();
			$(window).trigger('modalClosed');
		});
	};
	
	
	this.openit = function() {
		var h = $('body').outerHeight(true);
		if ( $(window).height() > h ) {
			h = $(window).height();
		}
		$(".overlay").height( h ).fadeIn('fast');
		$(".modal").fadeIn('fast', function() {
			myself.place();
			params.callback();
		});
	}
	
	
	this.place = function() {
		var t = $('.modal').css('top');
		
		if ( $('body').width() > 750 ) {
			t = Math.round( ( $(window).height() - $('.modal').outerHeight(true) ) / 2 );
			if ( t < 20 ) { t = 20; }
		}
		if ( $('body').hasClass('iOS') && $('body').width() <= 750 ) {
			t = $(window).scrollTop();
		}
		
		L = Math.round( ( $(window).width() - $('.modal').outerWidth() ) / 2 );
		
		$('.modal').css( { 'top': t, 'left': L + 'px' } );
	};
	
	
	
	if ( typeof( arguments[0] ) == 'object' ) {
		for ( prop in arguments[0] ) {
			if ( typeof( params[prop] ) != 'undefined' ) {
				params[ prop ] = arguments[0][prop];
			}
		}
		
		if ( typeof( params.width ) == 'number' ) {
			params.width = Math.round( params.width ) + 'px';
		}
		
		if ( typeof( params.height ) == 'number' ) {
			params.height = Math.round( params.height ) + 'px';
		}
	}
	
	if ( params.content != false ) {
		// close existing dialog, if open
		$(".overlay").click();
		
		if ( $('.overlay').length < 1 ) {
			html = '<div class="overlay"></div>';
		} else {
			html = '';
		}
		
		// modal content
		html += '<div class="modal" style="';
		if ( params.width != 'inherit' ) {
			html += 'width: ' + params.width;
		}
		if ( params.height != 'inherit' ) {
			html += '; height: ' + params.height;
		}
		html += '">';
		
		if ( params.close ) {
			html += '<a href="#close" class="close">X</a>';
		}
		
		html += '<div>';

		if ( params.title ) {
			html += '<h3>' + params.title + '</h3>';
		}
		
		html += params.content;
		
		html += '</div></div>';
		$('body').prepend( html );
		
		// provisionally place modal
		myself.place();
		myself.openit();	
		
		$(".overlay, .modal a.close").click( function() {
			myself.closeit();
			return false;
		});		
		
		// escape key also closes
		$(document).keydown( function(e) {
			if ( e.which == 27 ) {
				myself.closeit();
			}
		});
	}
	
	// responsive
	$(window).on('resizeEnd', function() {
		myself.place();
	});	
};


// add your responsive stuff here if you want
Responsive = function() {
	var $ = jQuery;
	this.width = false;
	this.height = false;
	this.column_collapse = 1020;	// actually this only applies to the menu...
	
	var myself = this;

	
	this.init = function() {
		myself.width = $(window).width();
		myself.height = $(window).height();
		
		// tab groups
		if ( $('.tab-group').length > 0 ) {
			
			// size tab content
			$('.tab-group').each( function() {
				$(this).find('.tab-content li').removeAttr('style');
				
				var h = 0;
				$(this).find('.tab-content li').each( function() {
					if ( $(this).height() > h ) {
						h = $(this).height();
					}
				});
				
				$(this).find('.tab-content li').height( h );
				
				//$(this).css( 'padding-bottom', h );
			});
		}
		
	};
	
	// standard scaling to container size
	// arguments img, container width, container height
	// img can be html image element or jQuery object
	// returns w and h for img
	this.scale_image = function( img, w, h ) {
		img = $(img)[0];
		var css = {};
		
		if ( typeof img.naturalWidth != 'undefined' ) {
			if ( w / img.naturalWidth * img.naturalHeight < h ) {
				// height governs
				css['height'] = h;
				css['width'] = 'auto';
			} else {
				css['height'] = 'auto';
				css['width'] = w;
			}
		}
		
		return css;
	};
	
	this.size_blocks = function() {

	};
};


jQuery(document).ready( function($) {
	var responsive = new Responsive();
	
	
	// resizing / responsive / layout hacks
	$(window).resize( function() {
		// IE8 triggers resize when any page element gets resized - whut?!?
		// stop recursion in its tracks
		if ( ! this.currentWidth ) {
			this.currentWidth = $(this).width();
			this.currentHeight = $(this).height();
		} else {
			if ( window.currentWidth == $(window).width() && window.currentHeight == $(window).height() ) {
				return false;
			}
		}
		
		// we are actually resizing	
	
		if ( this.resizeTO ) {
			clearTimeout( this.resizeTO );
		}
        this.resizeTO = setTimeout( function() {
			// check again, has window actually changed size??
            if ( window.currentWidth != $(window).width() || window.currentHeight != $(window).height() ) {
	            $(this).trigger('resizeEnd');
			}
        }, 200 );
	});
	
	$(window).load( function() {
		window.loaded = true;
		$(this).trigger('resizeEnd');
	});
	
	$(window).on( 'orientationchange', function() {
		$(window).trigger('resize');
	});
	
	
	$(window).on('resizeEnd', function() {
		responsive.init();
		// add other responsive stuff here
	});
	
	
	// mobile menu
	$('a[href="#mobile-menu"], header nav a[href="#close"]').click( function() {
		if ( $('nav').hasClass('open') ) {
			$('nav').removeClass('open');
		} else {
			$('nav').addClass('open');
		}
		return false;
	});
	
	
	// to top
	$('a[href="#to-top"]').click( function() {
		$('html, body').animate({
			'scrollTop' : 0
		}, 300 );
		
		return false;
	});
	
	// general modal handler
	// assumes the content will be hidden
	$('a[rel="modal"], a[rel="overlay"]').on( 'click', function() {
		if ( $(this).attr('href').length > 0 ) {
			var content = false;
			var href = $(this).attr('href');			
			var width = parseInt( $(this).attr('data-width') );
			var height = parseInt( $(this).attr('data-height') );
			var size = '';
			var is_video = false;
			
			if ( ! isNaN( width ) && width > 0 ) {
				size += ' width="' + width + '"';
			}
			if ( ! isNaN( height ) && height > 0 ) {
				size += ' height="' + height + '"';
			}
			
			// anchor to id'd (presumably hidden) content
			if ( href.substr(0,1) == '#' && $( href ).length > 0 ) {
				content = '<div>' + $( href ).html() + '</div>';
			}
			
			// web based, should be image, video or (TBD) audio
			// can specify desired size with data-width and data-height
			// can specify poster with data-poster
			if ( href.match(/^https?:\/\//) || href.substr(0,1) == '/' ) {
				if ( href.match(/\.jpg|\.jpeg|\.gif|\.png$/i) ) {
					// image
					content = '<div><img src="' + href + '"' + size + '></div>';
				} else {
					var ext = href.match(/\.mp4|\.m4v|\.ogg|\.ogv$/i);
					if ( ext ) {
						// video
						ext = ext[0].substr(1);
						var poster = href.replace(/\.mp4|\.m4v|\.ogg|\.ogv$/i, '.jpg');
						
						if ( $(this).attr('data-poster') != undefined ) {
							poster = $(this).attr('data-poster');
						}					
					
						content = '<div><video id="modal-video" ' + size + ' preload="metadata" src="' + href + '" poster="' + poster + '"><source type="video/' + ext + '" src="' + href + '"><a href="' + href + '">Download Video</a></video></div>';
						
						// need scripts & css?
						if ( $('script[src*="/mediaelement/"]').length < 1 ) {
							$('body').append('<link rel="stylesheet" id="mediaelement-css" href="/wp-includes/js/mediaelement/mediaelementplayer.min.css?ver=2.13.0" type="text/css" media="all"><link rel="stylesheet" id="wp-mediaelement-css" href="/wp-includes/js/mediaelement/wp-mediaelement.css?ver=3.6.1" type="text/css" media="all"><script type="text/javascript" src="/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=2.13.0"></script><script type="text/javascript" src="/wp-includes/js/mediaelement/wp-mediaelement.js?ver=3.6.1"></script>');
						}
						
						is_video = true;
					}
				}
			}	
			
			if ( content && content.length > 0 ) {
				if ( is_video ) {
					Modal({
						'content': content,
						'callback': function() {
							jQuery('#modal-video').mediaelementplayer();
						}
					});
				} else {
					Modal({
						'content': content
					});
				}
			}
		}
		return false;
	});
	
	
	// togglers
	$('body').on( 'click', '.opener', function() {
		// get target
		var el = $(this);
		var target = el.next();
		
		// next or previous?
		if ( $(this).attr('rel') == 'previous' ) {
			target = $(this).prev();
		}
		
		while( ! target.hasClass('hidden') && ! el.is('body') ) {
			el = el.parent();
			target = el.next();
		
			if ( $(this).attr('rel') == 'previous' ) {
				target = el.prev();
			}
		}
		
		if ( target.length > 0 ) {
			if ( target.hasClass('open') ) {
				// get height for scrolling adjustment
				var h = target.height();
				target.children().each( function() {
					if ( $(this).outerHeight(true) > h ) {
						h = $(this).outerHeight(true);
					}
				});
				var st = $(window).scrollTop() - h;
				
				target.finish().slideUp('fast');
				target.removeClass('open');
				if ( $(this).is(':checkbox') ) {
					target.find('input, textarea').attr('disabled', 'disabled');
				}
				$(this).removeClass('open');
				
				// change text?
				if ( typeof $(this).attr('data-closed-text') != 'undefined' ) {
					$(this).text( $(this).attr('data-closed-text') );
				}
				
				// scroll back up to where you were
				/*
				$('html, body').animate({
					'scrollTop' : st
				}, 300 );*/
			} else {
				target.finish().slideDown('fast');
				target.addClass('open');
				if ( $(this).is(':checkbox') ) {
					target.find('input, textarea').removeAttr('disabled');
				}
				$(this).addClass('open');
				
				// change text?
				if ( typeof $(this).attr('data-open-text') != 'undefined' ) {
					$(this).text( $(this).attr('data-open-text') );
				}
			}
			
			// checkboxes should return true
			if ( $(this).is('a') ) {
				return false;
			}
		}
		// otherwise will ignore and return
	});
	
	
	// form interaction / default values
	$('input, select, textarea').on('focus', function() {
		$(this).removeClass('error');
	});
	$('input, select, textarea').on('blur', function() {
		if ( $(this).attr('placeholder') ) {
			if ( $(this).val() != $(this).attr('placeholder') && $(this).val().length > 1 ) {
				$(this).addClass('valid');
			} else {
				$(this).removeClass('valid');
			}
		} else {
			// no placeholder, so it should always be considered valid
			if ( $(this).val().length > 1 ) {
				$(this).addClass('valid');
			}
		}
	});
	
	
	// tab groups
	$('.tab-group .tabs li > a').click( function() {
		var idx = $(this).parent().index();
		$(this).parent().siblings('.active').removeClass('active');
		
		$(this).parent().addClass('active');
		
		$(this).parents('.tabs').siblings('.tab-content').children().removeClass('active');
		$(this).parents('.tabs').siblings('.tab-content').children().eq( idx ).addClass('active');
	});
	
	
	// participants
	$('.participants a').click( function() {
		Modal({
			'content': $(this).parents('article').html(),
			'callback': function() {
				// remove links
				$('.modal h4').html( $('.modal h4 a').html() );
				$('.modal figure').html( $('.modal figure a').html() );
			}
		});
		
		return false;
	});
	
	
	// scrolling / parallax
	$(window).on( 'scroll', function() {
		var st = $(window).scrollTop();
		
		if ( responsive.width > responsive.column_collapse ) {
			// header
			var mt = st;
			var t = parseInt( $('header').css('top') );
			
			if ( mt > t+1 ) {
				mt = t+1;
			}
			
			$('header').css('margin-top', mt * -1 );
		} else {
			$('header').removeAttr('style');
		}
		
		// check transition elements
		$('.transition').each( function() {
			if ( st + responsive.height > $(this).offset().top ) {
				$(this).addClass('complete');
			}
		});
	});
	
	// force all the above on load
	$(window).load( function() {
		$('html, body').scrollTop( $(window).scrollTop() + 1 );
	});
	
	
		
	// hashes
	if ( location.hash ) {
		$(window).load( function() {
			$('a[href="' + location.hash + '"]').click();
		});
	}
	$(window).on('hashchange', function() {
		return false;
	});
		
		
});
