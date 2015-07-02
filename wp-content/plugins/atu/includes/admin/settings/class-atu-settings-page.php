<?php
/**
 * ATU Settings Page/Tab
 *
 * @author      Sergio Casquejo
 * @category    Admin
 * @package     ATU/Admin
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'ATU_Settings_Page' ) ) {

    abstract class ATU_Settings_Page {
        protected  $id = '';
        protected  $label = '';

        public function __construct() {
            add_filter( 'atu_settings_tab_array', array( $this, 'add_settings_page' ), 20 );
            add_action( 'atu_settings_' . $this->id, array( $this, 'output' ) );
        }


        public function add_settings_page( $pages ) {
            $pages[$this->id] = $this->label;

            return $pages;
        }

        public function get_settings() {
            return apply_filters( 'atu_get_settings_' . $this->id, array() );
        }

        public function output() {
            $settings = $this->get_settings();
            ATU_Admin_Settings::output_fields( $settings );
        }
    }
}