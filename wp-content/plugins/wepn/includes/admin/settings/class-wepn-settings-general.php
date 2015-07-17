<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists('WEPN_Settings_General') ) {
    class WEPN_Settings_General extends WEPN_Settings_Page {
        public function __construct() {
            $this->id = 'general';
            $this->label = __( 'General', WEPN_TEXT_DOMAIN );
            add_filter( 'wepn_settings_tab_array', array( $this, 'add_settings_page' ), 20 );
            add_action( 'wepn_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'wepn_settings_save_' . $this->id, array( $this, 'save' ) );
        }


        public function get_settings() {

            $settings = apply_filters( 'wepn_general_settings', array(
                array( 'title' => __( 'General Options', WEPN_TEXT_DOMAIN ), 'type' => 'title', 'desc' => '', 'id' => 'general_options' ),
                array(
                    'title'     => __( 'Email recipient', WEPN_TEXT_DOMAIN ),
                    'desc'      => __( '', WEPN_TEXT_DOMAIN ),
                    'id'        => 'wepn_email_recipient',
                    'type'      => 'email',
                    'attributes' => array(
                        'class' => 'regular-text'
                    ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Vendors Page page', WEPN_TEXT_DOMAIN ),
                    'desc'      => __( '', WEPN_TEXT_DOMAIN ),
                    'id'        => 'show_vendors_per_page',
                    'type'      => 'number',
                    'attributes' => array(
                        'class' => 'small-text',
                        'step' => 1
                    ),
                    'default'   => 12,
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

    return new WEPN_Settings_General();
}