<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists('ATU_Admin') ) {
    class ATU_Admin {
        public  function __construct() {
            $this->includes();
            $this->init_hooks();
        }


        public function includes() {

            if ( ! is_admin() ) return;
            include_once( 'class-atu-admin-taxonomy.php' );
            include_once( 'class-atu-admin-settings.php' );
            include_once( 'class-atu-admin-post.php' );
            include_once( 'class-atu-admin-users.php' );
            include_once( 'class-atu-admin-menu.php' );


        }

        private function init_hooks() {
            if ( ! is_admin() ) return;
            add_action( 'admin_enqueue_scripts', array( $this, 'styles_and_scripts' ) );

            add_action( 'wp_ajax_generate-reg-link', array( $this, 'atu_generate_registration_link' ) );
            add_action( 'wp_ajax_nopriv_generate-reg-link', array( $this, 'atu_generate_registration_link' ) );
        }

        public function atu_generate_registration_link() {
            global $wpdb;

            $code = wp_generate_password( 8, false );

            $wpdb->insert( $wpdb->prefix . ATU_TBL_PREFIX . "registration_code", array(
                'code' =>  $code,
                'is_active' => 1,
                'date_created' => date('Y-m-d H:i:s')
            ), array('%s', '%d', '%s') );

            if ( $wpdb->insert_id ) {

                $link = get_page_link( get_option( 'atu_registration_page' ) ) . '?reg_code=' . $code;

                exit( json_encode( array( 'status' => 'success', 'message' => $link ) ) );

            } else {

                exit( json_encode( array( 'status' => 'error', 'message' => 'Unable to create link.' ) ) );
            }



        }

        public function styles_and_scripts() {


            if ( $_GET['page'] == 'atu-settings' ) {
                wp_enqueue_style( 'atu-admin', ATU_ASSETS_URL . 'css/atu-admin-settings.css' );
                wp_enqueue_style( 'select2', ATU_ASSETS_URL . 'css/select2.min.css' );

                wp_enqueue_script( 'select2', ATU_ASSETS_URL . 'js/select2.min.js', array( 'jquery' ) );
                wp_enqueue_script( 'atu-admin-settings', ATU_ASSETS_URL . 'js/atu-admin-settings.js', array( 'jquery' ) );
                wp_localize_script( 'atu-admin-settings', 'ATU', array(
                    'ajaxUrl' => admin_url( 'admin-ajax.php' )
                ) );
            }
        }
    }

}

return new ATU_Admin();