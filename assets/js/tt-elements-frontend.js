( function( $, elementor ) {

	"use strict";

    let TT_Modules = {

    	init: function() {
    		let widgets = {
    			'tt-swiper-module.default' : TT_Modules.widgetSwiperSlider,
                'tt-camera-module.default' : TT_Modules.widgetCameraSlider
    		};

    		$.each( widgets, function( widget, callback ) {
    			elementor.hooks.addAction( 'frontend/element_ready/' + widget, callback );
    		});
    	},

    	widgetSwiperSlider: function( $scope ){

            let $target 	= $scope.find( '.tt-swiper-module' ),
                swiper  	= null,
                options		= $target.data('swiper-options'),
                pag 		= $target.find(".swiper-pagination"),
                next 		= $target.find(".swiper-button-next"),
                prev 		= $target.find(".swiper-button-prev"),
                bar 		= $target.find(".swiper-scrollbar"),
                url,
                settings    = {};

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
	    		direction: options['direction'],
	    		effect: options['slide-effect'],
	    		autoplay: options['autoplay'] ? {
	    			delay: options['delay']
	    		} : '',
	    		loop: options['loop'],
	    		pagination: options['pagination']? {
			        el: pag,
			        type: options['pagination-type'],
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
			    navigation: options['navigation']  ? {
			      nextEl: next,
			      prevEl: prev,
			      hideOnClick: options['hide-on-click']
			    } : '',
			    breakpoints: {
			    	1023: {
			    	},
			    	767: {
			    	}
			    }
	    	};

	    	swiper = new Swiper( $target, settings );
    	},
        widgetCameraSlider: function( $scope ){

            var camera_wrap = $scope.find( '.camera_wrap' ),
                $options = camera_wrap.data('settings'),
                $defaults = {
                    autoAdvance: false,
                    height: '40.91796875%',
                    minHeight: '725px',
                    pagination: true,
                    thumbnails: false,
                    playPause: false,
                    hover: false,
                    loader: 'none',
                    navigation: true,
                    navigationHover: true,
                    mobileNavHover: false,
                    time: 4000,
                    transPeriod: 1000,
                    fx: 'bottomLeftTopRight'
                };
            console.log( $options );

            $options = $.extend({}, $defaults, $options);



            camera_wrap.camera($options);
        }
    };

    $( window ).on( 'elementor/frontend/init', TT_Modules.init );

}( jQuery, window.elementorFrontend ) );