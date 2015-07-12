<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists('ATU_Admin_Menu') ) {
    class ATU_Admin_Menu {
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'admin_menu' ), 9 );
            //add_action( 'admin_menu', array( $this, 'my_add_profession_admin_page' ), 10 );
        }

        public function admin_menu() {

            add_menu_page( __( 'WEPN', ATU_TEXT_DOMAIN ), __( 'WEPN', ATU_TEXT_DOMAIN ), 'administrator', 'atu-settings', null, 'dashicons-id-alt', null);
            add_submenu_page( 'atu-settings', __( 'Settings', ATU_TEXT_DOMAIN ), __( 'Settings', ATU_TEXT_DOMAIN ), 'administrator', 'atu-settings', array( $this, 'settings_page' ) );
            add_submenu_page( 'atu-settings', __( 'Vendors', ATU_TEXT_DOMAIN ), __( 'Vendors', ATU_TEXT_DOMAIN ), 'administrator', 'users.php?role=vendor' );

            $tax = get_taxonomy( 'profession' );
            add_submenu_page( 'atu-settings', __( 'Vendor Categories', ATU_TEXT_DOMAIN ), __( 'Vendor Categories', ATU_TEXT_DOMAIN ), 'administrator', 'edit-tags.php?taxonomy=' . $tax->name );
        }




        public function settings_menu() {

        }

        public function settings_page() {
            ATU_Admin_Settings::output();
        }
    }



}

return new ATU_Admin_Menu();