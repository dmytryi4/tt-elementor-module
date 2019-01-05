<?php 

$settings = $this->get_settings();

$shortcode = $settings['select_form'];
$data      = explode( '::', $shortcode );

$form_format = '<div class="tt-contact-form-7">%1$s</div>';

if ( ! empty( $data ) && 2 === count( $data ) ) {
    $form = do_shortcode( sprintf( '[contact-form-7 id="%1$d" title="%2$s"]', $data[0], $data[1] ) );
} else {
    $form = '';
}

printf( $form_format, $form );