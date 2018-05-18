<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TT_Contact_Information extends Widget_Base {

   public function get_name() {
      return 'contact-information';
   }

   public function get_title() {
      return __( 'Contact Information', 'tt-elementor-modules' );
   }

   public function get_icon() { 
        return 'eicon-tabs';
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'section_',
         [
            'label' => __( 'Contact Information', 'tt-elementor-modules' ),
         ]
      );

      $this->add_control(
        'title_block',
        [
          'label' => __( 'Title Block', 'tt-elementor-modules' ),
          'type' => Controls_Manager::TEXT,
          'default' => __( '', 'tt-elementor-modules' ),
          'placeholder' => __( 'Title Block', 'tt-elementor-modules' ),
          'label_block' => true,
        ]
      );

      $this->add_control(
         'work_info',
         [
            'label' => __( 'Items', 'tt-elementor-modules' ),
            'type' => Controls_Manager::REPEATER,
            'fields' => [
               [
                  'name' => 'items_title',
                  'label' => __( 'Title & Content', 'tt-elementor-modules' ),
                  'type' => Controls_Manager::TEXT,
                  'default' => __( 'Items Title', 'tt-elementor-modules' ),
                  'placeholder' => __( 'Items Title', 'tt-elementor-modules' ),
                  'label_block' => true,
               ],
               [
                  'name'    => 'work_hours',
                  'label'   => esc_html__( 'Working Hours', 'tt-elementor-modules' ),
                  'type'    => Controls_Manager::TEXT,
                  'default' => '',
               ],               
            ],
            'title_field' => '{{{ items_title }}}'
         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
      include tt_elements()->plugin_path( 'templates/' . $this->get_name() . '/' . $this->get_name() . '.php');
   }

   protected function content_template() {}
   public function render_plain_content( $instance = [] ) {}
}
?>