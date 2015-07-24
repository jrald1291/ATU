<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists('WEPN_Admin_Menu') ) {
    class WEPN_Admin_Menu {
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
        }

        public function admin_menu() {

            add_menu_page( __( 'WEPN', WEPN_TEXT_DOMAIN ), __( 'WEPN', WEPN_TEXT_DOMAIN ), 'administrator', 'wepn-settings', null, 'dashicons-id-alt', null);
            add_submenu_page( 'wepn-settings', __( 'Account', WEPN_TEXT_DOMAIN ), __( 'Account', WEPN_TEXT_DOMAIN ), 'administrator', 'wepn-settings', array( $this, 'settings_page' ) );
            add_submenu_page( 'wepn-settings', __( 'Vendors', WEPN_TEXT_DOMAIN ), __( 'Vendors', WEPN_TEXT_DOMAIN ), 'administrator', 'users.php?role=vendor' );



        }




        public function settings_menu() {

        }

        public function settings_page() {
            WEPN_Admin_Settings::output();
        }
    }



}

return new WEPN_Admin_Menu();