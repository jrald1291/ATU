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


        public function get_settings() {

            $settings = apply_filters( 'atu_account_settings', array(
                array( 'title' => __( 'Account Options', ATU_TEXT_DOMAIN ), 'type' => 'title', 'desc' => '', 'id' => 'account_options' ),
                array(
                    'title'     => __( 'Enable registration code confirmation', ATU_TEXT_DOMAIN ),
                    'desc'      => __( 'If enable, registration form will ask for registration code', ATU_TEXT_DOMAIN ),
                    'id'        => 'atu_confirm_registration_code',
                    'type'      => 'checkbox',
                    'default'   => 'yes',
                ),
                array(
                    'title'     => __( 'Generate registration code', ATU_TEXT_DOMAIN ),
                    'desc'      => '',
                    'id'        => 'atu_reg_code',
                    'type'      => 'generate_reg_code',
                    'default'   => '',

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