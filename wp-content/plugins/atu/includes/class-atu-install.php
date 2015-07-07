<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( !class_exists('ATU_Install') ) {
    class ATU_Install {
        public function __construct() {
            $this->includes();
            $this->init_hooks();
        }


        private function includes() {
            // ATU/Admin
            include_once( 'admin/class-atu-admin.php' );

            include_once( 'class-atu-helper.php' );
            include_once( 'class-atu-form-builder.php' );
            include_once( 'class-atu-notify.php' );
            include_once( 'class-atu-validator.php' );
            include_once( 'class-atu-registration.php' );
            include_once( 'class-atu-profile.php' );


        }

        private function init_hooks() {
            add_action( 'wp_loaded', array( $this, 'atu_flush_rules' ) );
            add_filter( 'rewrite_rules_array', array( $this, 'my_insert_rewrite_rules' ) );
            add_filter( 'query_vars', array( $this, 'my_insert_query_vars' ) );


        }


        public function atu_flush_rules() {
            $rules = get_option( 'rewrite_rules' );

            global $wp_rewrite;


            // || ! isset( $rules['(vendors)/(.+)$'] )
            if ( ! isset( $rules['(vendor)/(.+)$'] ) ) {

                $wp_rewrite->flush_rules();
            }


        }


        public function my_insert_rewrite_rules( $rules ) {
            $newrules = array();
            $newrules['(vendor)/(.+)$'] = 'index.php?pagename=$matches[1]&username=$matches[2]';
            //$newrules['(vendors)/(.+)$'] = 'index.php?pagename=$matches[1]&p=$matches[2]';

            return $newrules + $rules;
        }


        public function my_insert_query_vars( $vars ) {

            array_push($vars, 'username');
            //array_push($vars, 'p');

            return $vars;
        }




    }

    return new ATU_Install();
}