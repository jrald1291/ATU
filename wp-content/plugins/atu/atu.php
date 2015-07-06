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


    function atu_theme_setup() {
        add_image_size( 'venue-listing', 221, 221, true ); // (cropped)
        add_image_size( 'venue-medium', 553, 372, true ); // (cropped)
        add_image_size( 'venue-small-thumb', 110, 75, true ); // (cropped)
        add_image_size( 'venue-xs-small-thumb', 60, 60, true ); // (cropped)
        add_image_size( 'vendor-small-thumb', 110, 105, true ); // (cropped)
    }


    function enqueue_scripts() {
        wp_enqueue_style( 'atu-css', ATU_ASSETS_URL . 'css/atu.css' );
        wp_enqueue_script( 'atu-js', ATU_ASSETS_URL . 'js/atu.js', array('jquery'), false, true );
        wp_localize_script( 'atu-js', 'ATU', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
        ) );
    }

    function add_role() {

        //remove_role( 'vendor' );
        add_role(
            'vendor',
            __( 'Vendor' ),
            array(
                'moderate_comments' => 1,
                'manage_categories' => 0,
                'manage_links' => 0,
                'upload_files' => 1,
                'unfiltered_html' => 1,
                'edit_posts' => 1,
                'edit_others_posts' => 0,
                'edit_published_posts' => 1,
                'publish_posts' => 1,
                'edit_pages' => 0,
                'read' => 1,
                'edit_others_pages' => 0,
                'edit_published_pages' => 0,
                'publish_pages' => 0,
                'delete_pages' => 0,
                'delete_others_pages' => 0,
                'delete_published_pages' => 0,
                'delete_posts' => 1,
                'delete_others_posts' => 0,
                'delete_published_posts' => 1,
                'delete_private_posts' => 1,
                'edit_private_posts' => 1,
                'read_private_posts' => 1,
                'delete_private_pages' => 0,
                'edit_private_pages' => 0,
                'read_private_pages' => 0,

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

        add_action( 'after_setup_theme', array( $this, 'atu_theme_setup' ) );
        add_action( 'aut_post_thumnail', array( $this, 'atu_post_thumbnail' ), 1, 2 );
        //add_action( 'pre_get_posts', array( $this, 'alter_search_ppp_wpse_107154' ) );

    }

    function alter_search_ppp_wpse_107154($qry) {
        if ($qry->is_main_query() && $qry->is_search()) {
            // parse your fields here and alter the query with $qry->set like this :
            $qry->set('post_per_page',10);
        }
    }



    public function atu_post_thumbnail( $size = 'venue-medium', $attr = array( 'alt' => 'Venue image' ) ) {
        if ( has_post_thumbnail() ) {
            the_post_thumbnail( $size, $attr );
        } else {
            echo '<img src="'. get_template_directory_uri() .'/images/placeholders/slide-single.jpg" alt="">';
        }
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
        include_once( 'includes/class-atu-install.php' );
    }
}

$GLOBALS['ATU'] = new ATU();
