<?php
/*
Plugin Name: TT Elementor Modules
Plugin URI: 
Description: Add package modules to Wordpress Elementor plugin
Version: 0.1
Author: Dmytro Podolianskyi
Author URI: https://github.com/dmytryi4
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}


if( ! class_exists( 'TT_Elements' ) ){
	/**
	 * 
	 */
	class TT_Elements {

	    const PLUGIN_NAME = 'TT Elementor Modules';

		/**
		 * A reference to an instance of this class.
		 *
		 * @since  0.1
		 * @access private
		 * @var    object
		 */
		private static $instance = null;

		/**
		 * Holder for base plugin URL
		 *
		 * @since  0.1
		 * @access private
		 * @var    string
		 */
		private $plugin_url = null;

		/**
		 * Plugin version
		 *
		 * @var string
		 */

		private $version = '0.1';

		/**
		 * Holder for base plugin path
		 *
		 * @since  0.1
		 * @access private
		 * @var    string
		 */
		private $plugin_path = null;

		public function __construct(){

			// Load modules.
			add_action( 'init', array( $this, 'init' ), -999 );

            add_action( 'plugins_loaded', array ( $this, 'plugins_loaded' ) );
		}

		/**
		 * Load modules
		 * @since  0.1
		 * @access public
		 */
		public function init(){
			require $this->plugin_path('includes/classes/class-elementor-integration-element.php');
			get_elementor_create_element()->init();
		}

		public function plugins_loaded(){
            // Check if Elementor installed and activated
            if ( ! did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
                return;
            }
        }
		/**
		 * Returns path to file or dir inside plugin folder
		 *
		 * @param  string $path Path inside plugin dir.
		 * @return string
		 */
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = trailingslashit( plugin_dir_path( __FILE__ ) );
			}

			return $this->plugin_path . $path;
		}

		public function plugin_url( $path = null ) {

			if ( ! $this->plugin_url ) {
				$this->plugin_url = trailingslashit( plugin_dir_url( __FILE__ ) );
			}

			return $this->plugin_url . $path;
		}

		/**
		 * Get the template path.
		 *
		 * @return string
		 */
		public function template_path() {
			return apply_filters( 'tt-elements/template-path', 'tt-elements/' );
		}

		/**
		 * Returns path to template file.
		 *
		 * @return string|bool
		 */
		public function get_template( $name = null ) {

			$template = locate_template( $this->template_path() . $name );

			if ( ! $template ) {
				$template = $this->plugin_path( 'templates/' . $name );
			}

			if ( file_exists( $template ) ) {
				return $template;
			} else {
				return false;
			}
		}


        public function admin_notice_missing_main_plugin() {

            if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

            $message = sprintf(
                esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
                '<strong>' . esc_html__( self::PLUGIN_NAME ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
            );

            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

        }

		/**
		 * Returns the instance.
		 *
		 * @since  0.1
		 * @access public
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

if ( ! function_exists( 'tt_elements' ) ) {

	/**
	 * Returns instanse of the plugin class.
	 *
	 * @since  0.1
	 * @return object
	 */
	function tt_elements() {
		return TT_Elements::get_instance();
	}
}

tt_elements();