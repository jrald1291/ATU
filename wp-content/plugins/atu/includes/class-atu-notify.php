<?php

if( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( ! class_exists( 'ATU_Notify' ) ) {
    class ATU_Notify {
        private static $errors = array();
        private static $messages = array();

        //error/message
        public static function add( $message = null, $type = 'error' ) {
            if ( $message == null ) return;

            if ( 'error' == $type ) {
                self::$errors[] = $message;
            } elseif ( 'success' == $type ) {
                self::$messages[] = $message;
            }
        }

        public static function iterate_message( $messages ) {


            foreach( $messages as $key => $message ) {

                if( is_array( $message ) ) {
                    self::iterate_message( $message );
                } else {
                    echo '<li>' . $message . '</li>';
                }
            }

        }


        public static function display() {


            if ( ! empty( self::$errors ) ) {
                echo '<ul class="atu-error">';
                self::iterate_message( self::$errors );
                echo '</ul>';
            }


            if ( ! empty( self::$messages ) ) {
                echo '<ul class="atu-message">';

                self::iterate_message( self::$messages );

                echo '</ul>';
            }
        }


        public static function has_errors() {
            return count( self::$errors ) != 0 ? true : false;
        }
    }
}