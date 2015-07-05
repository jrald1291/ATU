<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'ATU_Helper' ) ) {
    class ATU_Helper {
        public static function str_limit( $string, $limit, $echo = true ) {
            $string = strip_tags( $string );
        }


        public static function dropwdown_vendor_category( $args = array() ) {

            $options = wp_parse_args( array(
                'echo' => true,
            ), $args );

            extract( $options );

            $terms = get_terms( 'profession', array( 'hide_empty' => false ) );

            $return_string = '';
            if ( ! empty( $terms ) ) {

                $return_string .= '<select name="vendor_category" class="form-control">';
                $return_string .= '<option value="">' . __( 'None', 'atu' ) . '</option>';
                foreach ( $terms as $term ) {
                    $return_string .= '<option value="'. $term->slug .'">' . $term->name . '</option>';
                }
                $return_string .= '</select>';
            }

            if ( ! $echo )
                return $return_string;

            echo $return_string;
        }
    }
}