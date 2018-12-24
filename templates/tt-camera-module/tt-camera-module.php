<?php
    $settings = $this->get_settings();

    $format_camera_section = '<div class="camera_container"><div id="camera_%2$s" class="camera_wrap" data-settings="%3$s" >%1$s</div></div>';

    $format_camera_slider = '<div data-src="%1$s"%3$s>
                              <div class="camera_caption fadeIn">%2$s</div>
                            </div>';

    $slider_collection = [];



    foreach ($settings['list'] as $slide) {
        array_push( $slider_collection, sprintf( $format_camera_slider, $slide['item_image']['url'], $slide['content'],
            filter_var( $settings['show_thumbnail'] , FILTER_VALIDATE_BOOLEAN )? ' data-thumb="' . wp_get_attachment_image_src( $slide['item_image']['id'], $settings['thumbnail_size'] )[0] .'"' : '' ) );
    }

    $opts_array = array(
        'loader'=> 'none',
        'minHeight'=> '725px',
        'height'=> '46.67%',
        'thumbnails'=> filter_var( $settings['show_thumbnail'] , FILTER_VALIDATE_BOOLEAN ),
        'playPause'=> false,
        'hover' => false,
        'navigationHover'=> filter_var( $settings['show_arrows_on_hover'] , FILTER_VALIDATE_BOOLEAN ),
        'autoAdvance' => filter_var( $settings['autoplay'] , FILTER_VALIDATE_BOOLEAN ),
        'time' => $settings['autoplay_timeout'],
        'transPeriod' => $settings['animation_speed'],
        'pagination'=> filter_var($settings['show_dots'] , FILTER_VALIDATE_BOOLEAN ),
        'navigation'=> filter_var($settings['show_arrows'] , FILTER_VALIDATE_BOOLEAN ),
        'fx' => $settings['show_effect'],
    );


    printf( $format_camera_section,
        join( $slider_collection ),
        uniqid(),
        htmlspecialchars( json_encode( $opts_array ) )
    );
