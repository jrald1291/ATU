<?php
/**
 * Plugin Name: All Tied Up
 * Description: All Tied up
 * Plugin URI: http://www.alltiedup.com
 * Author: Sergio D. Casquejo
 * Author URI: http://casquejs.freevar.com
 * Version: 1.0
 * Text Domain: atu
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
//error_reporting(0);

class ATU {
    var $atu_db_version = '1.0';

    function __construct() {
        $this->define_constant();
        $this->init_hooks();
        $this->includes();
    }



    function enqueue_scripts() {
        wp_enqueue_style( 'atu-css', ATU_ASSETS_URL . 'css/atu.css' );
        wp_enqueue_script( 'atu-js', ATU_ASSETS_URL . 'js/atu.js', array('jquery'), false, true );
        wp_localize_script( 'atu-js', 'ATU', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ) );
    }

    function add_role() {
        add_role(
            'vendor',
            __( 'Vendor' ),
            array(
                'read' => true, // true allows this capability
                'edit_posts' => true, // Allows user to edit their own posts
                'edit_pages' => false, // Allows user to edit pages
                'edit_others_posts' => false, // Allows user to edit others posts not just their own
                'create_posts' => true, // Allows user to create new posts
                'manage_categories' => true, // Allows user to manage post categories
                'publish_posts' => true, // Allows the user to publish, otherwise posts stays in draft mode
                'edit_themes' => false, // false denies this capability. User can’t edit your theme
                'install_plugins' => false, // User cant add new plugins
                'update_plugin' => false, // User can’t update any plugins
                'update_core' => false // user cant perform core updates

            )
        );
    }


    function atu_install() {
        global $wpdb;

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $charset_collate = $wpdb->get_charset_collate();

        $reg_code_tbl_name = $wpdb->prefix . ATU_TBL_PREFIX . 'registration_code';

        $sql = "CREATE TABLE $reg_code_tbl_name (
            id mediumint(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            code varchar(120) NOT NULL,
            is_active tinyint(1) DEFAULT 1 NOT NULL,
            date_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            date_used datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            UNIQUE KEY id (code)
        ) $charset_collate";



        dbDelta( $sql );

        $gallery_tbl_name = $wpdb->prefix . ATU_TBL_PREFIX . 'user_gallery';
        $sql = "CREATE TABLE $gallery_tbl_name (
            id mediumint(9) NOT NULL PRIMARY KEY AUTO_INCREMENT,
            filename varchar(120) NOT NULL,
            file varchar(255) NOT NULL,
            path varchar(255) NOT NULL,
            date_created datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            sort VARCHAR(255) DEFAULT 0 NOT NULL
        ) $charset_collate";

        dbDelta( $sql );


        add_option( 'atu_db_version', $this->atu_db_version );

    }

    function  atu_update_db_check() {

        if ( get_site_option( 'atu_db_version' ) != $this->atu_db_version ) {
            $this->atu_install();
        }
    }


    /**
     * Hook into actions and filters
     * @since  2.3
     */
    private function init_hooks() {
        // Install database tables
        register_activation_hook( __FILE__, array( $this, 'atu_install' ) );
        register_activation_hook( __FILE__, array( $this, 'add_role' ) );
        // Update database check
        add_action( 'plugins_loaded', array( $this, 'atu_update_db_check' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    /**
     * Define ATU Constants
     */

    private function define_constant() {
        $this->define( 'ATU_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
        $this->define( 'ATU_PLUGIN_URL', plugin_dir_url(__FILE__) );
        $this->define( 'ATU_INCLUDES_DIR', ATU_PLUGIN_DIR . 'includes' );
        $this->define( 'ATU_ASSSETS_DIR', ATU_PLUGIN_DIR . 'assets' );
        $this->define( 'ATU_ASSETS_URL', ATU_PLUGIN_URL . 'assets/' );
        $this->define( 'ATU_CLASSES_DIR', ATU_PLUGIN_DIR . 'classes' );
        $this->define( 'ATU_TBL_PREFIX', 'atu_' );
        $this->define( 'ATU_TEXT_DOMAIN', 'atu' );
    }


    /**
     * Define constant if not already set
     * @param  string $name
     * @param  string|bool $value
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    private function includes() {

        include_once( ATU_PLUGIN_DIR . 'helper.php' );
        include_once( ATU_INCLUDES_DIR.'/class-atu-install.php' );
    }
}

$GLOBALS['ATU'] = new ATU();
