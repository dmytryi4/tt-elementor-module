<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TT_Mailchimp_Form extends Widget_Base {

   public function get_name() {
      return 'tt-mailchimp-form';
   }

   public function get_title() {
      return __( 'Mailchimp for WP', 'tt-elementor-modules' );
   }

   public function get_icon() { 
        return 'eicon-mailchimp';
   }

    public function get_categories() {
        return [ 'tt-modules' ];
    }

   protected function _register_controls() {

      $this->start_controls_section(
         'section_mailchimp',
         [ 'label' => __( 'Mailchimp Form for WP', 'tt-elementor-modules' ) ]
      );

       $this->add_control(
           'important_note',
           [
               'label' => '',
               'type' => Controls_Manager::RAW_HTML,
               'raw' => sprintf( __( 'To get started with MailChimp for WordPress, please <a href="%1$s">create form</a> and <a href="%2$s">enter your MailChimp API key on the settings page of the plugin</a>.', 'mailchimp-for-wp' ),
                   admin_url( 'admin.php?page=mailchimp-for-wp-forms' ),
                   admin_url( 'admin.php?page=mailchimp-for-wp' ) ),
           ]
       );



      $this->add_control(
           'select_form',
           [
               'label' => __( 'Select Form', 'plugin-domain' ),
               'type' => Controls_Manager::SELECT,
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

        if ( ! class_exists( 'MC4WP_Form' ) ) {
            return array();
        }

        $form = mc4wp_get_form();

        if ( empty( $form ) ) {
            return array();
        }

        return array(
            $form->ID => $form->name
        );
    }


    protected function render( $instance = [] ) {
      $settings = $this->get_settings();

      echo !empty( $settings['select_form'] ) ? do_shortcode( sprintf( '[mc4wp_form id="%1$s"]', $settings['select_form'] ) ) : '';
   }

   protected function content_template() {}
   public function render_plain_content( $instance = [] ) {}
}
?>