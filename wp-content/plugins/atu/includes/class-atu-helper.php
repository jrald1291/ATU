<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'ATU_Helper' ) ) {
    class ATU_Helper {
        public static function str_limit( $string, $limit, $echo = true ) {
            $string = strip_tags( $string );
        }

        public static function background_image( $attachment_id, $default_image = null, $echo = true ) {

            $default_image = $default_image == null ? ATU_ASSSETS_DIR . 'images/banner.jpg' : $default_image;

            $page_background = wp_get_attachment_image_src( $attachment_id, 'full' );

            $page_background = isset( $page_background[0] ) ?  $page_background[0] : '';


            $option_bg = of_get_option('banner', '');


            if ( empty( $page_background ) && empty( $option_bg ) ) {

                $page_background = $default_image;

            } elseif ( empty( $page_background ) && ! empty( $option_bg ) ) {

                $page_background = $option_bg;
            }

            if ( ! $echo )return $page_background;

            echo $page_background;
        }


        public static function dropwdown_vendor_category( $args = array() ) {

            $options = wp_parse_args( $args, array(
                'echo' => true,
                'selected' => ''
            ) );

            extract( $options );



            $terms = get_terms( 'profession', array( 'hide_empty' => false ) );

            $return_string = '';
            if ( ! empty( $terms ) ) {

                $return_string .= '<select name="profession" class="form-control">';
                $return_string .= '<option value="">' . __( 'None', 'atu' ) . '</option>';
                foreach ( $terms as $term ) {

                    $return_string .= '<option value="'. $term->slug .'" '. selected( $selected, $term->slug, false ) .'>' . $term->name . '</option>';
                }
                $return_string .= '</select>';
            }

            if ( ! $echo )
                return $return_string;

            echo $return_string;
        }

        public static function list_vendor_category( $args = array() ) {
            $options = wp_parse_args( $args, array(
                'echo' => true,
            ) );

            extract( $options );

            $terms = get_terms( 'profession', array( 'hide_empty' => false ) );

            $return_string = '';
            if ( ! empty( $terms ) ) {


                $return_string .= '<ul class="list">';
                foreach ( $terms as $term ) {

                    $return_string .= '<li><a href="'. get_term_link( $term->slug, 'profession' ) .'">' . $term->name . '</a></li>';

                    //$return_string .= '<option value="'. $term->slug .'">' . $term->name . '</option>';
                }

                $return_string .= '</ul>';
            }

            if ( ! $echo )
                return $return_string;

            echo $return_string;
        }
    }
}