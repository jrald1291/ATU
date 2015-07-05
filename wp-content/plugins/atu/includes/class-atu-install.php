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
            // ATU/Admin
            include_once( 'admin/class-atu-admin.php' );

            include_once( 'class-atu-helper.php' );
            include_once( 'class-atu-form-builder.php' );
            include_once( 'class-atu-notify.php' );
            include_once( 'class-atu-validator.php' );
            include_once( 'class-atu-registration.php' );


        }
    }

    return new ATU_Install();
}