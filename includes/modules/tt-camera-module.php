<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class TT_Camera_Module extends Widget_Base {

    public function get_name() {
      return 'tt-camera-module';
    }

    public function get_title() {
      return __( 'Camera Slider', 'tt-elementor-modules' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'tt-modules' ];
    }

    protected function _register_controls() {

      $this->start_controls_section(
         'section_items',
         [
            'label' => __( 'Camera Slider', 'tt-elementor-modules' ),
         ]
      );

      $repeater = new Repeater();

      $repeater->add_control(
        'item_image',
        array(
          'label'   => esc_html__( 'Image', 'elementor-custom-element' ),
          'type'    => Controls_Manager::MEDIA,
          'default' => array(
            'url'   => Utils::get_placeholder_image_src(),
          ),
        )
      );

      $repeater->add_control(
        'content',
        array(
          'label'   => esc_html__( 'Content', 'tt-elementor-modules' ),
          'type'    => Controls_Manager::TEXTAREA,
        )
      );

      $this->add_control(
        'list',
        [
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
        'section_settings',
        [
          'label' => esc_html__( 'Slider Camera Settings', 'elementor-custom-element' ),
          'tab'   => Controls_Manager::TAB_STYLE,
        ]
      );
      $this->add_control(
        'show_arrows',
        [
          'label'          => esc_html__( 'Show Arrows Navigation', 'elementor-custom-element' ),
          'label_on'       => esc_html__( 'Yes', 'elementor-custom-element' ),
          'label_off'      => esc_html__( 'No', 'elementor-custom-element' ),
          'type'           => Controls_Manager::SWITCHER,
          'return_value'   => 'yes',
          'default'        => 'no',
        ]
      );

      $this->add_control(
           'show_arrows_on_hover',
           [
               'label'          => esc_html__( 'Show Arrows On Hover', 'elementor-custom-element' ),
               'label_on'       => esc_html__( 'Yes', 'elementor-custom-element' ),
               'label_off'      => esc_html__( 'No', 'elementor-custom-element' ),
               'type'           => Controls_Manager::SWITCHER,
               'return_value'   => 'yes',
               'default'        => 'no',
               'condition' => array(
                   'show_arrows' => 'yes'
               )
           ]
      );

      $this->add_control(
        'show_dots',
        [
          'label'          => esc_html__( 'Show Dots Navigation', 'elementor-custom-element' ),
          'label_on'       => esc_html__( 'Yes', 'elementor-custom-element' ),
          'label_off'      => esc_html__( 'No', 'elementor-custom-element' ),
          'type'           => Controls_Manager::SWITCHER,
          'return_value'   => 'yes',
          'default'        => 'no',
        ]
      );

        $this->add_control(
            'show_thumbnail',
            [
                'label'          => esc_html__( 'Show Thumbnail Pagination', 'elementor-custom-element' ),
                'label_on'       => esc_html__( 'Yes', 'elementor-custom-element' ),
                'label_off'      => esc_html__( 'No', 'elementor-custom-element' ),
                'type'           => Controls_Manager::SWITCHER,
                'return_value'   => 'yes',
                'default'        => 'no',
            ]
        );

        $this->add_control(
            'thumbnail_size',
            [
                'label'   => esc_html__( 'Choose image size', 'elementor-custom-element' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'thumbnail',
                'options' => $this->get_images(),
                'condition' => array(
                    'show_thumbnail' => 'yes'
                )
            ]
        );

      $this->add_control(
        'autoplay',
        [
          'label'          => esc_html__( 'Autoplay', 'elementor-custom-element' ),
          'label_on'       => esc_html__( 'Yes', 'elementor-custom-element' ),
          'label_off'      => esc_html__( 'No', 'elementor-custom-element' ),
          'type'           => Controls_Manager::SWITCHER,
          'return_value'   => 'yes',
          'default'        => 'yes',
        ]
      );
      $this->add_control(
        'autoplay_timeout',
        [
          'label'     => esc_html__( 'Autoplay Timeout', 'elementor-custom-element' ),
          'type'      => Controls_Manager::NUMBER,
          'default'   => 5000,
          'condition'      => array(
            'autoplay' => 'yes',
          ),

        ]
      );
      $this->add_control(
        'animation_speed',
        [
          'label'     => esc_html__( 'Animation Speed', 'elementor-custom-element' ),
          'type'      => Controls_Manager::NUMBER,
          'default'   => 500,
          'condition'      => array(
            'autoplay' => 'yes',
          ),
        ]
      );
      $this->add_control(
        'show_effect',
        [
          'label' => __( 'Sliding Effect', 'plugin-domain' ),
          'type' => Controls_Manager::SELECT2,
          'options' => [
            'random' => _('Random'),
            'simpleFade' => _('SimpleFade'),
            'curtainTopLeft' => _('CurtainTopLeft'),
            'curtainTopRight' => _('CurtainTopRight'),
            'curtainBottomLeft' => _('CurtainBottomLeft'),
            'curtainBottomRight' => _('CurtainBottomRight'),
            'curtainSliceLeft' => _('CurtainSliceLeft'),
            'curtainSliceRight' => _('CurtainSliceRight'),
            'blindCurtainTopLeft' => _('BlindCurtainTopLeft'),
            'blindCurtainTopRight' => _('BlindCurtainTopRight'),
            'blindCurtainBottomLeft' => _('BlindCurtainBottomLeft'),
            'blindCurtainBottomRight' => _('BlindCurtainBottomRight'),
            'blindCurtainSliceBottom' => _('BlindCurtainSliceBottom'),
            'blindCurtainSliceTop' => _('BlindCurtainSliceTop'),
            'stampede' => _('Stampede'),
            'mosaic' => _('Mosaic'),
            'mosaicReverse' => _('MosaicReverse'),
            'mosaicRandom' => _('MosaicRandom'),
            'mosaicSpiral' => _('MosaicSpiral'),
            'mosaicSpiralReverse' => _('MosaicSpiralReverse'),
            'topLeftBottomRight' => _('TopLeftBottomRight'),
            'bottomRightTopLeft' => _('BottomRightTopLeft'),
            'bottomLeftTopRight' => _('BottomLeftTopRight'),
            'bottomLeftTopRight' => _('BottomLeftTopRight')
          ],
          'default' => [ 'random', 'description' ],
        ]
      );

      $this->end_controls_section();
    }

    protected function render( $instance = [] ) {
      include tt_elements()->plugin_path( 'templates/' . $this->get_name() . '/' . $this->get_name() . '.php');
    }

    protected function content_template() {}

    public function get_images() {
        global $_wp_additional_image_sizes;
        $sizes = get_intermediate_image_sizes();
        $result = array();
        foreach($sizes as $size) {
            if( in_array( $size, array('thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
                $result[ $size ] = ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) );
            } else {
                $result[ $size ] = sprintf(
                    '%1$s (%2$sx%3$s)',
                    ucwords( trim( str_replace( array( '-', '_' ), array( ' ', ' ' ), $size ) ) ),
                    $_wp_additional_image_sizes[ $size]['width'],
                    $_wp_additional_image_sizes[ $size]['height']
                );
            }
        }
        return array_merge( array( 'full' => esc_html__( 'Full', 'jet-elements' ), ), $result );
    }

    public function render_plain_content( $instance = [] ) {}
}