<?php 

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'Elementor_Integration_Element' ) ){

   class Elementor_Integration_Element {

      private static $instance = null;

      public static function get_instance() {
         if ( ! self::$instance )
            self::$instance = new self;
         return self::$instance;
      }

      public function init(){

         add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
         add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
         add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_styles' ) );

      }

      public function widgets_registered() {
         if(defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base')){
            $this->register_modules();
         }
      }

      private function register_modules(){
         foreach ( glob( tt_elements()->plugin_path( 'includes/modules/' ) . '*.php' ) as $file ) {
            $this->required_module( $file );
         }


      }

      private function required_module( $file ){
         if( file_exists( $file ) ){
            $this->register_type( $file );
         }
      }

      private function register_type( $file ){

         $name  = basename( str_replace('.php', '', $file) );
         $class_name = explode('-', $name );
         $class_name[0] = strtoupper( $class_name[0] );
         $class = ucwords( join( $class_name, '_' ), '_' );
         $class = sprintf( 'Elementor\%s', $class );

         require $file;

         if( class_exists( $class ) ){
            Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $class );
         }
      }

      public function enqueue_scripts(){

         foreach ( glob( tt_elements()->plugin_path( 'assets/js/' ) . '*.js' ) as $jsfile ) {

            $jsfile_name = basename( $jsfile );

            wp_enqueue_script(
               'tt-' . $jsfile_name,
               tt_elements()->plugin_url( 'assets/js/' . $jsfile_name ),
               array( 'jquery', 'elementor-frontend' ),
               '',
               true
            );


         }

         foreach ( glob( tt_elements()->plugin_path( 'assets/css/' ) . '*.css' ) as $cssfile ) {

            $cssfile_name = basename( $cssfile );

            wp_enqueue_style(
               'tt-' . $cssfile_name,
               tt_elements()->plugin_url( 'assets/css/' . $cssfile_name ),
               array(),
               ''
            );
         }

         wp_enqueue_script(
            'tt-elements-frontend',
            tt_elements()->plugin_url( 'assets/js/tt-elements-frontend.js' ),
            array( 'jquery', 'elementor-frontend' ),
            '0.1',
            true
         );
      }

      public function editor_styles(){
         
      }
   }
}

function get_elementor_create_element(){
   return Elementor_Integration_Element::get_instance();
}

?>