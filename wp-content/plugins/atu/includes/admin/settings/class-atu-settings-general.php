<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists( 'ATU_Settings_General' ) ) {
    class ATU_Settings_General extends ATU_Settings_Page {
        public function __construct() {
            $this->id = 'general';
            $this->label = __( 'General', ATU_TEXT_DOMAIN );
            add_filter( 'atu_settings_tab_array', array( $this, 'add_settings_page' ), 20 );
            add_action( 'atu_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'atu_settings_save_' . $this->id, array( $this, 'save' ) );
        }


        public function get_settings() {

            $settings = apply_filters( 'atu_general_settings', array(
                array( 'title' => __( 'General Options', ATU_TEXT_DOMAIN ), 'type' => 'title', 'desc' => '', 'id' => 'general_options' ),
                array(
                    'title'     => __( 'Email recipient', ATU_TEXT_DOMAIN ),
                    'desc'      => __( '', ATU_TEXT_DOMAIN ),
                    'id'        => 'atu_email_recipient',
                    'type'      => 'email',
                    'attributes' => array(
                        'class' => 'regular-text'
                    ),
                    'default'   => '',
                ),

                array(
                    'title'     => __( 'Vendors Page page', ATU_TEXT_DOMAIN ),
                    'desc'      => __( '', ATU_TEXT_DOMAIN ),
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

            return apply_filters( 'atu_get_settings_' . $this->id, $settings );
        }

        public function save() {
            $settings = $this->get_settings();

            ATU_Admin_Settings::save_fields( $settings );
        }

    }

    return new ATU_Settings_General();
}