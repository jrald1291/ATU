<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'ATU_Helper' ) ) {
    class ATU_Helper {
        public static function str_limit( $string, $limit, $echo = true ) {
            $string = strip_tags( $string );
        }
    }
}