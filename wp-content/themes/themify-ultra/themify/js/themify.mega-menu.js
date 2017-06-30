/*
 * Themify Mega Menu Plugin
 */
;(function ($) {
	$.fn.ThemifyMegaMenu = function( custom ) {

		var options = $.extend({
				events: 'mouseenter'
			}, custom),
			cacheMenu = {};

		return this.each(function() {
			var $thisMega = $(this),
				$megaMenuPosts = $('.mega-menu-posts', $thisMega);

			$thisMega.on(options.events+' touchend', '.mega-link', function(event) {
				event.preventDefault();

				if ( themifyScript.menuInSidePanel ) {
					return;
				}

				var $self = $(this),
					termid = $self.data('termid'),
					tax = $self.data('tax');

				if( 'string' == typeof cacheMenu[termid] ) {
					$megaMenuPosts.html( cacheMenu[termid] );
				} else {
					if( $self.hasClass( 'loading' ) ) {
						return;
					}
					$self.addClass( 'loading' );
					$.post(
						themifyScript.ajax_url,
						{
							action: 'themify_theme_mega_posts',
							termid: termid,
							tax: tax
						},
						function( response ) {
							$megaMenuPosts.html( response );
							cacheMenu[termid] = response;
							$self.removeClass( 'loading' );
						}
					);
				}
			});

			// when hovering over top-level mega menu items, show the first one automatically
			$thisMega.on( 'mouseenter', '> a', function(){
				$( this ).closest( 'li' ).find( '.mega-sub-menu .mega-link:first' ).trigger( options.events );
			} )
			.on( 'dropdown_open', function(){
				$( this ).find( '.mega-sub-menu .mega-link:first' ).trigger( options.events );
			});

		});
	};

})(jQuery);