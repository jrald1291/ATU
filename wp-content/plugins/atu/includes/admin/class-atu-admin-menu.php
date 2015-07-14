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

            /*
            if ( have_rows( 'regions', 'option' ) ) {
                while ( have_rows( 'regions', 'option' ) ) {
                    the_row();
                    $name = sanitize_title(get_sub_field('region_name'));
                    $label = esc_html(get_sub_field('region_label'));

                    add_submenu_page( 'atu-settings', __( $label, 'wepn' ), __( $label, 'wepn' ), 'administrator', 'edit-tags.php?taxonomy=' . $name );
                }
            }*/


        }




        public function settings_menu() {

        }

        public function settings_page() {
            ATU_Admin_Settings::output();
        }
    }



}

return new ATU_Admin_Menu();