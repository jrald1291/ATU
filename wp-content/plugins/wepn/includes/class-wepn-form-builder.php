<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists('WEPN_Form_Builder') ) {
    class WEPN_Form_Builder {

        public static function create( $settings ) {

            $return_string = '';


            foreach( $settings as $field ) {

                if ( ! isset( $field['type'] ) ) return;

                if ( ! isset( $field['attributes'] ) ) {
                    $field['attributes'] = array();
                }

                if ( ! isset( $field['placeholder'] ) ) {
                    $field['placeholder'] = '';
                }

                if ( ! isset( $field['method'] ) ) {
                    $field['method'] = 'post';
                }

                if ( ! isset( $field['option'] ) ) {
                    $field['option'] = array();
                }

                if ( ! isset( $field['required'] ) ) {
                    $field['required'] = false;
                }


                switch( sanitize_title( $field['type'] ) ) {
                    case 'form':
                        $return_string .= '<form action="'. $field['action'] .'" name="'. $field['id'] .'" id="'. $field['id'] .'" method="'. $field['method'] .'"';

                        foreach( $field['attributes'] as $name => $attribute ) {
                            $return_string .= ' '. sanitize_title( $name ) . '="'. esc_html( $attribute ) . '" ';
                        }

                        $return_string .= '>';
                        break;
                    case 'url':
                    case 'password':
                    case 'email':
                    case 'text':
                        $return_string .= '<div class="form-group field-wrap">';
                        $return_string .= '<label for="'. $field['id'] .'">'. $field['title'];
                        if ( $field['required'] == true ) {
                            $return_string .= '<span class="req">*</span>';
                        }
                        $return_string .= '</label>';
                        $return_string .= '<span class="form-control-wrap"><input type="'. $field['type'] .'" ';
                        $return_string .= ' id="'. $field['id'] .'" ';
                        $return_string .= ' name="'. $field['id'] .'" ';
                        $return_string .= ' placeholder="'. $field['placeholder'] .'" ';
                        $return_string .= ' value="'. $field['value'] .'" ';
                        foreach( $field['attributes'] as $name => $attribute ) {
                            $return_string .= sanitize_title( $name ) . '="'. esc_html( $attribute ) . '" ';
                        }
                        $return_string .= '>';
                        $return_string .= '</div><!--/.form-group -->';
                        break;

                case 'hidden':
                        $return_string .= '<span class="form-control-wrap"><input type="'. $field['type'] .'" ';
                        $return_string .= ' value="'. $field['value'] .'" ';
                        $return_string .= ' id="'. $field['id'] .'" ';
                        $return_string .= ' name="'. $field['id'] .'" ';
                        foreach( $field['attributes'] as $name => $attribute ) {
                            $return_string .= sanitize_title( $name ) . '="'. esc_html( $attribute ) . '" ';
                        }
                        $return_string .= '>';

                        break;

                    case 'textarea':
                        $return_string .= '<div class="form-group field-wrap">';
                        $return_string .= '<label for="'. $field['id'] .'">'. $field['title'];
                        if ( $field['required'] == true ) {
                            $return_string .= '<span class="req">*</span>';
                        }
                        $return_string .= '</label>';
                        $return_string .= '<span class="form-control-wrap"><textarea name="'. $field['id'] .'" id="'. $field['id'] .'" placeholder="'. $field['placeholder'] .'"';
                        foreach( $field['attributes'] as $name => $attribute ) {
                            $return_string .= sanitize_title( $name ) . '="'. esc_html( $attribute ) . '" ';
                        }
                        $return_string .= '>';
                        $return_string .= $field['value'];
                        $return_string .= '</textarea>';
                        $return_string .= '</div><!--/.form-group -->';
                        break;

                    case 'select':
                        $return_string .= '<div class="form-group">';
                        $return_string .= '<label for="'. $field['id'] .'"class="label-drop">'. $field['title'];
                        if ( $field['required'] == true ) {
                            $return_string .= '<span class="req">*</span>';
                        }
                        $return_string .= '</label>';
                        $return_string .= '<span class="form-control-wrap"><select name="'. $field['id'] .'" ';
                        $return_string .= 'id="'. $field['id'] .'" ';
                        $return_string .= 'type="'. $field['type'] .'" ';
                        $return_string .= 'placeholder="'. $field['placeholder'] .'" ';
                        foreach( $field['attributes'] as $name => $attribute ) {
                            $return_string .= sanitize_title( $name ) . '="'. esc_html( $attribute ) . '" ';
                        }
                        $return_string .= '>';
                        if ( count( $field['options'] ) != 0 ) {
                            foreach ($field['options'] as $value => $label) {
                                $return_string .= '<option value="' . $value . '" ' . selected($field['value'], $value, false) . '>' . $label . '</option>';
                            }
                        }

                        $return_string .= '</select>';
                        $return_string .= '</div><!--/.form-group -->';
                        break;

                    case 'checkbox':
                        $return_string .= '<div class="checkbox">';
                        $return_string .= '<span class="form-control-wrap"><input type="'. $field['type'] .'" ';
                        $return_string .= 'name="'. $field['id'] .'" ';
                        $return_string .= 'id="'. $field['id'] .'" ';
                        $return_string .= 'value="1" ';
                        foreach( $field['attributes'] as $name => $attribute ) {
                            $return_string .= ' '. sanitize_title( $name ) . '="'. esc_html( $attribute ) . '" ';
                        }
                        $return_string .= '>';
                        $return_string .= '</div><!--/.form-group -->';
                        break;
                    case 'button':
                        $return_string .= '<button';
                        $return_string .= ' name="'. $field['id'] .'" ';
                        $return_string .= ' id="'. $field['id'] .'" ';
                        $return_string .= ' type="'. $field['button_type'] .'" ';
                        foreach( $field['attributes'] as $name => $attribute ) {
                            $return_string .= sanitize_title( $name ) . '="'. esc_html( $attribute ) . '" ';
                        }
                        $return_string .= '>';

                        $return_string .= $field['title'];
                        $return_string .= '</button>';
                        break;
                    case 'nonce_field':
                        ob_start();
                        wp_nonce_field( $field['action'], $field['id'] );
                        $return_string .= ob_get_clean();
                        break;
                    case 'form-end':
                        $return_string .= '</form><!--/#'. $field['id'] .' -->';
                        break;
                }
            }

            echo $return_string;
        }
    }
}