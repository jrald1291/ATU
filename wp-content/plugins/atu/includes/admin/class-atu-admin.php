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

            include_once( 'class-atu-admin-menu.php' );
            include_once( 'class-atu-admin-settings.php' );
            include_once( 'class-atu-admin-post.php' );
            include_once( 'class-atu-admin-taxonomy.php' );
        }

        private function init_hooks() {
            if ( ! is_admin() ) return;
            add_action( 'admin_enqueue_scripts', array( $this, 'styles_and_scripts' ) );
        }

        public function styles_and_scripts() {
            wp_enqueue_style( 'atu-admin', ATU_ASSETS_URL . 'css/admin.css' );
        }
    }

}

return new ATU_Admin();