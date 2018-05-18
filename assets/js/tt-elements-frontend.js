( function( $, elementor ) {

	"use strict";

    var TT_Modules = {

    	init: function() {
    		var widgets = {
    			'tt-swiper-module.default' : TT_Modules.widgetSwiperSlider,
    		};

    		$.each( widgets, function( widget, callback ) {
    			elementor.hooks.addAction( 'frontend/element_ready/' + widget, callback );
    		});
    	},

    	widgetSwiperSlider: function( $scope ){

    		var $target 	= $scope.find( '.tt-swiper-module' ),
    			swiper  	= null,
    			pag 		= $target.find(".swiper-pagination"),
		        next 		= $target.find(".swiper-button-next"),
		        prev 		= $target.find(".swiper-button-prev"),
		        bar 		= $target.find(".swiper-scrollbar"),
    			settings    = {},
    			url;

    		if ( ! $target.length ) {
    			return;
    		}

			$('.swiper-slide', $target ).each(function(index, value){
	    		if (url = $(value).attr("data-slide-bg")) {
	    		  $(value).css({
	    		    "background-image": "url(" + url + ")",
	    		    "background-size": "cover",
	    		    "background-position": "center center"
	    		  });
	    		}
	    	});

	    	settings = {
	    		effect: $target.data('slide-effect'),
	    		autoplay: ( $target.data('autoplay') === 'yes') ? {
	    			delay: $target.data('delay')
	    		} : '',
	    		loop: ( $target.data('loop') === 'yes') ? true : false,
	    		pagination: ( $target.data('pagination') === 'yes') ? {
			        el: pag,
			        type: $target.data('pagination-type'),
			        clickable: true,
			        renderCustom: function (swiper, current, total) {
			            return current + ' of ' + total;
			        },
			        renderProgressbar: function (progressbarFillClass) {
			            return '<span class="' + progressbarFillClass + '"></span>';
			        },
			        renderFraction: function (currentClass, totalClass) {
			            return '<span class="' + currentClass + '"></span>' +
			                   ' of ' +
			                   '<span class="' + totalClass + '"></span>';
			        },
			        renderBullet: function (index, className) {
			          return '<span class="' + className + '">' + (index + 1) + '</span>';
			        }
			    } : '',
			    navigation: ( $target.data('navigation') === 'yes') ? {
			      nextEl: next,
			      prevEl: prev,
			      hideOnClick: ( $target.data('hide-on-click') === 'yes') ? true : false
			    } : '',
			    breakpoints: {
			    	1023: {
			    	},
			    	767: {
			    	}
			    }
	    	}

	    	swiper = new Swiper( $target, settings );
    	}
    };

    $( window ).on( 'elementor/frontend/init', TT_Modules.init );

}( jQuery, window.elementorFrontend ) );