<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists('WEPN_Admin') ) {
    class WEPN_Admin {
        public  function __construct() {
            $this->includes();
            $this->init_hooks();
        }


        public function includes() {


            include_once('class-wepn-admin-taxonomy.php');
            include_once('class-wepn-admin-post.php');
            include_once('class-wepn-admin-users.php');
            include_once('class-wepn-admin-settings.php');
            include_once( 'class-wepn-admin-options.php' );
            include_once('class-wepn-admin-menu.php');


        }

        private function init_hooks() {
            if ( ! is_admin() ) return;
            add_action( 'admin_enqueue_scripts', array( $this, 'styles_and_scripts' ) );

            add_action( 'wp_ajax_generate-reg-link', array( $this, 'wepn_generate_registration_link' ) );
            add_action( 'wp_ajax_nopriv_generate-reg-link', array( $this, 'wepn_generate_registration_link' ) );
        }

        public function wepn_generate_registration_link() {
            global $wpdb;

            $code = wp_generate_password( 8, false );

            $wpdb->insert( $wpdb->prefix . WEPN_TBL_PREFIX . "registration_code", array(
                'code' =>  $code,
                'is_active' => 1,
                'date_created' => date('Y-m-d H:i:s')
            ), array('%s', '%d', '%s') );

            if ( $wpdb->insert_id ) {

                $link = '<a target="_blank" href="' . get_page_link( get_option( 'wepn_registration_page' ) ) . '?reg_code=' . $code .'">' . get_page_link( get_option( 'wepn_registration_page' ) ) . '?reg_code=' . $code .'</a>';

                exit( json_encode( array( 'status' => 'success', 'message' => $link ) ) );

            } else {

                exit( json_encode( array( 'status' => 'error', 'message' => 'Unable to create link.' ) ) );
            }



        }

        public function styles_and_scripts() {
            if ( ! isset( $_GET['page'] ) ) return;

            if ( $_GET['page'] == 'wepn-settings' ) {
                wp_enqueue_style( 'wepn-admin', WEPN_ASSETS_URL . 'css/wepn-admin-settings.css' );
                wp_enqueue_style( 'select2', WEPN_ASSETS_URL . 'css/select2.min.css' );

                wp_enqueue_script( 'select2', WEPN_ASSETS_URL . 'js/select2.min.js', array( 'jquery' ) );
                wp_enqueue_script( 'wepn-admin-settings', WEPN_ASSETS_URL . 'js/wepn-admin-settings.js', array( 'jquery' ) );
                wp_localize_script( 'wepn-admin-settings', 'ATU', array(
                    'ajaxUrl' => admin_url( 'admin-ajax.php' )
                ) );
            }
        }
    }

}

return new WEPN_Admin();