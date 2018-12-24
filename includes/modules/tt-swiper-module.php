<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TT_Swiper_Module extends Widget_Base {

   public function get_name() {
      return 'tt-swiper-module';
   }

   public function get_title() {
      return __( 'Swiper Module', 'tt-elementor-modules' );
   }

   public function get_icon() { 
        return 'eicon-slideshow';
   }

   protected function _register_controls() {

        $this->start_controls_section(
         'section_items',
         [
            'label' => __( 'Slider Items', 'tt-elementor-modules' ),
         ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
           'slide_title', [
                'label' => __( 'Slide Title', 'tt-elementor-modules' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Slide Title', 'tt-elementor-modules' ),
                'placeholder' => __( '', 'tt-elementor-modules' ),
                'label_block' => true,
           ]
        );

        $repeater->add_control(
           'slide_image', [
                'label' => __( 'Choose Image', 'tt-elementor-modules' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
           ]
        );

        $repeater->add_control(
           'slide_description', [
                'label'   => __( 'Description', 'tt-elementor-modules' ),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => __( 'Default description', 'tt-elementor-modules' ),
           ]
        );

        $this->add_control(
         'slides',
         [
             'label' => __( 'Items', 'tt-elementor-modules' ),
             'type' => Controls_Manager::REPEATER,
             'fields' => $repeater->get_controls(),
             'default' => [
                 [
                     'slide_title' => __( 'Title #1', 'plugin-domain' ),
                     'slide_image' => Utils::get_placeholder_image_src(),
                     'slide_description' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                 ],
                 [
                     'slide_title' => __( 'Title #2', 'plugin-domain' ),
                     'slide_image' => Utils::get_placeholder_image_src(),
                     'slide_description' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
                 ],
             ]
         ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
         'section_options',
         [
            'label' => __( 'Swiper Options', 'tt-elementor-modules' ),
             'tab' => Controls_Manager::TAB_STYLE,
         ]
        );

       $this->add_control(
           'direction',
           [
               'label' => __( 'Direction', 'tt-elementor-modules' ),
               'type' => Controls_Manager::SELECT,
               'default'  => 'horizontal',
               'options' => [
                   'horizontal'     => __( 'Horizontal', 'tt-elementor-modules' ),
                   'vertical'    => __( 'Vertical', 'tt-elementor-modules' ),
               ]
           ]
       );

        $this->add_control(
            'effect',
            [
               'label' => __( 'Effect', 'tt-elementor-modules' ),
               'type' => Controls_Manager::SELECT,
               'default'  => 'slide',
               'options' => [
                'slide'     => __( 'Slide', 'tt-elementor-modules' ),
                'fade'    => __( 'Fade', 'tt-elementor-modules' ),
                'cube' => __( 'Cube', 'tt-elementor-modules' ),
                'coverflow'      => __( 'Coverflow', 'tt-elementor-modules' ),
                'flip'      => __( 'Flip', 'tt-elementor-modules' ),
               ]
            ]
        );

        $this->add_responsive_control(
            'show_pagination',
            [
                'label' => __( 'Show pagination?', 'tt-elementor-modules' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => __( 'Show', 'tt-elementor-modules' ),
                'label_off' => __( 'Hide', 'tt-elementor-modules' ),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'pagination_type',
            [
               'label' => __( 'Pagination Type', 'tt-elementor-modules' ),
               'type' => Controls_Manager::SELECT,
               'default'  => 'bullets',
               'options' => [
                'bullets'     => __( 'Bullets', 'tt-elementor-modules' ),
                'fraction'    => __( 'Fraction', 'tt-elementor-modules' ),
                'progressbar' => __( 'Progressbar', 'tt-elementor-modules' ),
                'custom'      => __( 'Custom', 'tt-elementor-modules' ),
               ],
               'condition' => array(
                  'show_pagination' => 'yes'
               )
            ]
        );

        $this->add_responsive_control(
          'show_navigation',
          [
            'label' => __( 'Show navigation?', 'tt-elementor-modules' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => '',
            'label_on' => __( 'Show', 'tt-elementor-modules' ),
            'label_off' => __( 'Hide', 'tt-elementor-modules' ),
            'return_value' => 'yes',
          ]
        );

        $this->add_control(
          'hide_on_click',
          [
            'label' => __( 'Hide On Click', 'tt-elementor-modules' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => '',
            'label_on' => __( 'Yes', 'tt-elementor-modules' ),
            'label_off' => __( 'No', 'tt-elementor-modules' ),
            'return_value' => 'yes',
            'condition' => array(
               'show_navigation' => 'yes'
            )
          ]
        );

        $this->add_control(
          'loop',
          [
            'label' => __( 'Enable loop?', 'tt-elementor-modules' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => '',
            'label_on' => __( 'Yes', 'tt-elementor-modules' ),
            'label_off' => __( 'No', 'tt-elementor-modules' ),
            'return_value' => 'yes',
          ]
        );

        $this->add_control(
          'autoplay',
          [
            'label' => __( 'Enable autoplay?', 'tt-elementor-modules' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => '',
            'label_on' => __( 'Yes', 'tt-elementor-modules' ),
            'label_off' => __( 'No', 'tt-elementor-modules' ),
            'return_value' => 'yes',
          ]
        );

        $this->add_control(
        'delay',
        [
           'label'   => __( 'Autoplay delay', 'tt-elementor-modules' ),
           'type'    => Controls_Manager::NUMBER,
           'default' => 5000,
           'min'     => 0,
           'max'     => 100000000,
           'step'    => 10,
           'condition' => array(
              'autoplay' => 'yes'
           )
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

