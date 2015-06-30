<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( !class_exists('ATU_Install') ) {
    class ATU_Install {
        public function __construct() {
            $this->includes();
        }


        private function includes() {
            include_once( 'class-atu-validator.php' );
            include_once( 'class-atu-registration.php' );
            // ATU/Admin
            include_once( 'admin/class-atu-admin.php' );

        }
    }

    return new ATU_Install();
}