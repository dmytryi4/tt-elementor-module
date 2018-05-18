<?php 
	$slider = $this->get_settings('slider');
	$part_format = '<div class="swiper-slide" data-slide-bg="%1$s"><div class="swiper-caption">%2$s</div></div>';
	$slides = array();

	foreach ($slider as $slide) {
	  array_push( $slides, sprintf( $part_format, $slide['image']['url'], $slide['slides_description'] ) );
	}

	$settings = $this->get_settings();

	$navigation_class = '';

	if( $settings['show_navigation'] != 'yes' ){
		$navigation_class .= ' hide_desktop';
	} else if( $settings['show_navigation_tablet'] != 'yes' ){
		$navigation_class .= ' hide_tablet';
	} else if( $settings['show_navigation_mobile'] != 'yes' ){
		$navigation_class .= ' hide_mobile';
	}
?>

<div class="tt-swiper-module swiper-container" 
	data-pagination="<?php echo $settings['show_pagination']; ?>"
	data-pagination-type="<?php echo $settings['pagination_type']; ?>"
	data-tablet-pagination="<?php echo $settings['show_pagination_tablet']; ?>"
	data-mobile-pagination="<?php echo $settings['show_pagination_mobile']; ?>"
	data-navigation="<?php echo $settings['show_navigation']; ?>" 
	data-tablet-navigation="<?php echo $settings['show_navigation_tablet']; ?>" 
	data-mobile-navigation="<?php echo $settings['show_navigation_mobile']; ?>" 
	data-hide-on-click="<?php echo $settings['hide_on_click']; ?>" 
	data-loop="<?php echo $settings['loop']; ?>" 
	data-autoplay="<?php echo $settings['autoplay']; ?>" 
	data-delay="<?php echo $settings['delay']; ?>" 
	data-simulate-touch="false" 
	data-slide-effect="<?php echo $settings['effect']; ?>"
	>

  	<div class="swiper-wrapper">
    	<?php print( join($slides) ); ?>
  	</div>
  	<!-- Swiper controls-->
  	<div class="swiper-pagination"></div>
  	
	<div class="swiper-button-prev <?php echo $navigation_class ?>"></div>
	<div class="swiper-button-next <?php echo $navigation_class ?>"></div>
</div>