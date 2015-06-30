<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists('ATU_Admin_Menu') ) {
    class ATU_Admin_Menu {
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
            add_action( 'admin_menu', array( $this, 'settings_menu' ), 10 );
        }

        public function admin_menu() {

            add_menu_page( __( 'ATU', ATU_TEXT_DOMAIN ), __( 'ATU', ATU_TEXT_DOMAIN ), 'administrator', 'alltiedup', null, 'dashicons-id-alt', null);

        }

        public function settings_menu() {
            add_submenu_page( 'alltiedup', __( 'Settings', ATU_TEXT_DOMAIN ), __( 'Settings', ATU_TEXT_DOMAIN ), 'administrator', 'atu-settings', array( $this, 'settings_page' ) );
        }

        public function settings_page() {
            ATU_Admin_Settings::output();
        }
    }



}

return new ATU_Admin_Menu();