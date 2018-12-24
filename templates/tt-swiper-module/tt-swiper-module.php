<?php
	$settings = $this->get_settings_for_display();

	$swiper_settings = array(
	    'direction' => $settings['direction'],
        'pagination' => filter_var( $settings['show_pagination'], FILTER_VALIDATE_BOOLEAN ),
        'pagination-type' => $settings['pagination_type'],
        'navigation' => filter_var( $settings['show_navigation'], FILTER_VALIDATE_BOOLEAN ),
        'hide-on-click' => filter_var( $settings['hide_on_click'], FILTER_VALIDATE_BOOLEAN ),
        'loop' => filter_var( $settings['loop'], FILTER_VALIDATE_BOOLEAN ),
        'autoplay' => filter_var( $settings['autoplay'], FILTER_VALIDATE_BOOLEAN ),
        'delay' => $settings['delay'],
        'simulate-touch' => "false",
        'slide-effect' => $settings['effect'],
    );

    $navigation_class = '';
    $pagination_class = '';
    if( $settings['show_navigation'] != 'yes' ){
        $navigation_class .= ' hide_desktop';
    }

    if( $settings['show_navigation_tablet'] != 'yes' ){
        $navigation_class .= ' hide_tablet';
    }

    if( $settings['show_navigation_mobile'] != 'yes' ){
        $navigation_class .= ' hide_mobile';
    }

    if( $settings['show_pagination'] != 'yes' ){
        $pagination_class .= ' hide_desktop';
    }

    if( $settings['show_pagination_tablet'] != 'yes' ){
        $pagination_class .= ' hide_tablet';
    }

    if( $settings['show_pagination_mobile'] != 'yes' ){
        $pagination_class .= ' hide_mobile';
    }

    $part_format = '<div class="swiper-slide" data-slide-bg="%1$s"><div class="swiper-caption">%2$s</div></div>';
    $slides = array();

    foreach ($settings['slides'] as $slide) {
        array_push( $slides, sprintf( $part_format, $slide['slide_image']['url'], $slide['slide_description'] ) );
    }

    $slider_format = '<div class="tt-swiper-module swiper-container" data-swiper-options=\'%1$s\'>
                    <div class="swiper-wrapper">%2$s</div>
                    <div class="swiper-pagination%4$s"></div>
                    <div class="swiper-button-prev%3$s"></div>
                    <div class="swiper-button-next%3$s"></div></div>';

	printf( $slider_format, json_encode( $swiper_settings ), join($slides), $navigation_class, $pagination_class );