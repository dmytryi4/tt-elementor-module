<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TT_Contact_Form_7 extends Widget_Base {

   public function get_name() {
      return 'tt-contact-form-7';
   }

   public function get_title() {
      return __( 'Contact Form 7', 'tt-elementor-modules' );
   }

   public function get_icon() { 
        return 'eicon-form-horizontal';
   }

    public function get_categories() {
        return [ 'tt-modules' ];
    }

   protected function _register_controls() {

      $this->start_controls_section(
         'section_wpcf7',
         [ 'label' => __( 'Contact Form 7', 'tt-elementor-modules' ) ]
      );

      $this->add_control(
           'select_form',
           [
               'label' => __( 'Select Form', 'plugin-domain' ),
               'type' => Controls_Manager::SELECT2,
               'options' => $this->get_availbale_forms(),
               'default' => '',
           ]
      );

      $this->end_controls_section();
   }

    /**
     * Retrieve available forms list.
     * @return [type] [description]
     */
    public function get_availbale_forms() {

        if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
            return array();
        }

        $forms = \WPCF7_ContactForm::find( array(
            'orderby' => 'title',
            'order'   => 'ASC',
        ) );

        if ( empty( $forms ) ) {
            return array();
        }

        $result = array();

        foreach ( $forms as $item ) {
            $key        = sprintf( '%1$s::%2$s', $item->id(), $item->title() );
            $result[ $key ] = $item->title();
        }

        return $result;
    }


    protected function render( $instance = [] ) {
      include tt_elements()->plugin_path( 'templates/' . $this->get_name() . '/' . $this->get_name() . '.php');
   }

   protected function content_template() {}
   public function render_plain_content( $instance = [] ) {}
}
?>