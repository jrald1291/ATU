<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( ! class_exists( 'ATU_Profile' ) ) {
    class ATU_Profile
    {
        public function __construct() {
            $this->init_hooks();
        }


        private function init_hooks() {
            //add_shortcode('atu_vendor_profile', array( $this, 'vendor_profile' ) );
            add_filter( 'page_template', array( $this, 'vendor_page_template' ) );
        }

        public function vendor_page_template() {
            if ( is_page( 'vendor' ) ) {
                $page_template = dirname( __FILE__ ) . '/views/vendor-page-template.php';
            }


            return $page_template;
        }


        public function vendor_profile() {

            $username = get_query_var( 'username' );

            if( isset( $username ) && get_user_by( 'login', $username ) ) {

                echo '<h2>Yay! My friendly url seems to work, here is the $friendlyurl value: '.$username.'</h2>';

            } else {

                echo "<h2>". __( 'Vendor is not exists!', 'atu' ) . "</h2>";

            }
        }
    }
}

return new ATU_Profile();