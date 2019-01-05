<?php

//namespace Elementor;
//
//use Elementor\Settings;
//use Elementor\Editor;

if ( ! defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'Elementor_Settings_Page_Module' ) ){


    class Elementor_Settings_Page_Module {

        private static $instance = null;

        public static function get_instance() {
            if ( ! self::$instance )
                self::$instance = new self;
            return self::$instance;
        }

        public function init(){
            add_action( 'admin_menu', [ $this, 'register_admin_submenu_page' ], 150 );
        }

        public function register_admin_submenu_page(){
            add_submenu_page(
                'elementor',
                _x( 'TemplateTuning Modules', 'TemplateTuning Modules', 'tt-elementor-modules' ),
                _x( 'TemplateTuning Modules', 'TemplateTuning Modules', 'tt-elementor-modules' ),
                'manage_options',
                '',
                [ $this, 'display_settings_page' ]
            );
        }

        public function display_settings_page(){
            ?>
            <div class="wrap">
                <h1><?php _e( 'TemplateTuning Modules List', 'tt-elementor-modules' ); ?></h1>
            </div>
        <?php
        }
    }
}

function get_elementor_settings_module(){
    return Elementor_Settings_Page_Module::get_instance();
}
