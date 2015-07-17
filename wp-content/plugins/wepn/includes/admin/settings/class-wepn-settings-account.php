<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists('WEPN_Settings_Account') ) {
    class WEPN_Settings_Account extends WEPN_Settings_Page {
        public function __construct() {
            $this->id = 'account';
            $this->label = __( 'Account', WEPN_TEXT_DOMAIN );
            add_filter( 'wepn_settings_tab_array', array( $this, 'add_settings_page' ), 20 );
            add_action( 'wepn_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'wepn_settings_save_' . $this->id, array( $this, 'save' ) );


        }




        private function get_pages() {
            $args = array(
                'sort_order' => 'asc',
                'sort_column' => 'post_title',
                'hierarchical' => 1,
                'exclude' => '',
                'include' => '',
                'meta_key' => '',
                'meta_value' => '',
                'authors' => '',
                'child_of' => 0,
                'parent' => -1,
                'exclude_tree' => '',
                'number' => '',
                'offset' => 0,
                'post_type' => 'page',
                'post_status' => 'publish'
            );

            $pages = array();

            foreach( get_pages( $args ) as $page ) {
                $pages[$page->ID] = esc_html( $page->post_title );
            }

            return $pages;
        }


        public function get_settings() {






            $settings = apply_filters( 'wepn_account_settings', array(
                array( 'title' => __( 'Account Options', WEPN_TEXT_DOMAIN ), 'type' => 'title', 'desc' => '', 'id' => 'account_options' ),
                array(
                    'title'     => __( 'Enable registration', WEPN_TEXT_DOMAIN ),
                    'desc'      => '',
                    'id'        => 'users_can_register',
                    'type'      => 'checkbox2',
                    'default'   => 1,
                ),

                array(
                    'title'     => __( 'Registration page', WEPN_TEXT_DOMAIN ),
                    'desc'      => __( 'Select page for registration.', WEPN_TEXT_DOMAIN ),
                    'id'        => 'wepn_registration_page',
                    'type'      => 'select',
                    'options'    => $this->get_pages(),
                    'default'   => '0',
                ),

                array(
                    'title'     => __( 'Validate registration code', WEPN_TEXT_DOMAIN ),
                    'desc'      => __( 'If enable, registration form will ask for registration code', WEPN_TEXT_DOMAIN ),
                    'id'        => 'wepn_validate_registration_code',
                    'type'      => 'checkbox',
                    'default'   => 'yes',
                ),
                array(
                    'title'     => __( 'Generate link', WEPN_TEXT_DOMAIN ),
                    'desc'      => 'Generate registration link with code',
                    'id'        => 'wepn_reg_link_w_code',
                    'type'      => 'wepn_reg_link_w_code',
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Successfull Registration', WEPN_TEXT_DOMAIN ),
                    'desc'      => 'Redirect to this page after successfull registration',
                    'id'        => 'wepn_registration_success_page',
                    'type'      => 'select',
                    'options'    => $this->get_pages(),
                    'default'   => '0',
                ),

                array(
                    'title'     => __( 'Default Role', WEPN_TEXT_DOMAIN ),
                    'desc'      => '',
                    'id'        => 'wepn_default_user_role',
                    'type'      => 'user_role',
                    'default'   => 'vendor',

                ),




                array(
                    'type'      => 'sectionend',
                    'id'        => 'general_options'
                )
            ) );

            return apply_filters( 'wepn_get_settings_' . $this->id, $settings );
        }

        public function save() {
            $settings = $this->get_settings();

            WEPN_Admin_Settings::save_fields( $settings );
        }

    }

    return new WEPN_Settings_Account();
}