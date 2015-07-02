<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists( 'ATU_Settings_Account' ) ) {
    class ATU_Settings_Account extends ATU_Settings_Page {
        public function __construct() {
            $this->id = 'account';
            $this->label = __( 'Account', ATU_TEXT_DOMAIN );
            add_filter( 'atu_settings_tab_array', array( $this, 'add_settings_page' ), 20 );
            add_action( 'atu_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'atu_settings_save_' . $this->id, array( $this, 'save' ) );


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






            $settings = apply_filters( 'atu_account_settings', array(
                array( 'title' => __( 'Account Options', ATU_TEXT_DOMAIN ), 'type' => 'title', 'desc' => '', 'id' => 'account_options' ),
                array(
                    'title'     => __( 'Enable registration', ATU_TEXT_DOMAIN ),
                    'desc'      => '',
                    'id'        => 'users_can_register',
                    'type'      => 'checkbox2',
                    'default'   => 1,
                ),

                array(
                    'title'     => __( 'Registration page', ATU_TEXT_DOMAIN ),
                    'desc'      => __( 'Select page for registration.', ATU_TEXT_DOMAIN ),
                    'id'        => 'atu_registration_page',
                    'type'      => 'select',
                    'options'    => $this->get_pages(),
                    'default'   => '0',
                ),

                array(
                    'title'     => __( 'Validate registration code', ATU_TEXT_DOMAIN ),
                    'desc'      => __( 'If enable, registration form will ask for registration code', ATU_TEXT_DOMAIN ),
                    'id'        => 'atu_validate_registration_code',
                    'type'      => 'checkbox',
                    'default'   => 'yes',
                ),
                array(
                    'title'     => __( 'Generate link', ATU_TEXT_DOMAIN ),
                    'desc'      => 'Generate registration link with code',
                    'id'        => 'atu_reg_link_w_code',
                    'type'      => 'atu_reg_link_w_code',
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Successfull Registration', ATU_TEXT_DOMAIN ),
                    'desc'      => 'Redirect to this page after successfull registration',
                    'id'        => 'atu_registration_success_page',
                    'type'      => 'select',
                    'options'    => $this->get_pages(),
                    'default'   => '0',
                ),

                array(
                    'title'     => __( 'Default Role', ATU_TEXT_DOMAIN ),
                    'desc'      => '',
                    'id'        => 'atu_default_user_role',
                    'type'      => 'user_role',
                    'default'   => 'vendor',

                ),




                array(
                    'type'      => 'sectionend',
                    'id'        => 'general_options'
                )
            ) );

            return apply_filters( 'atu_get_settings_' . $this->id, $settings );
        }

        public function save() {
            $settings = $this->get_settings();

            ATU_Admin_Settings::save_fields( $settings );
        }

    }

    return new ATU_Settings_Account();
}