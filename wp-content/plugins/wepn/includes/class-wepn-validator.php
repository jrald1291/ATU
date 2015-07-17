<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}



class WEPN_Validator {
    var $input = null;
    var $fails = false;

    public function __construct() {
        $this->wp_errors = new \WP_Error();
    }

    public function make($input, $rules) {
        $this->input = $input;
        foreach ( $rules as $key => $rule ) {
            $arr_rules = explode('|', $rule);

            foreach ($arr_rules as $r) {
                $arr = explode(':', $r);

                $args = isset( $arr[1] ) ?  trim($arr[1]) : null;

                if( method_exists($this, trim( $arr[0] ) ) ) {
                    $this->{trim($arr[0])}($key, $args);
                }
            }
        }
        return $this;
    }


    private function required( $key ) {
        $val = $this->input[$key];

        if ( !isset( $val ) || strlen( trim( $val ) ) == 0  ) WEPN_Notify::add( ucfirst(  str_replace( '_', ' ', $key ) ) . ' is required.', 'error');

    }

    private function email( $key ) {
        $val = $this->input[$key];

        if ( !filter_var( $val, FILTER_VALIDATE_EMAIL ) ) WEPN_Notify::add( ucfirst(  str_replace( '_', ' ', $key ) ) . ' is invalid.', 'error');
    }


    private function same( $key, $key2 ) {
        $val = $this->input[$key];
        $val2 = $this->input[$key2];

        if( $val != $val2 ) {
            WEPN_Notify::add( ucfirst( $key2 ) . ' must be the same.', 'error');
        }
    }

    private function url( $key ) {
        $val = $this->input[$key];

        if ( !filter_var( $val, FILTER_VALIDATE_URL ) ) WEPN_Notify::add( ucfirst(  str_replace( '_', ' ', $key ) ) . ' is invalid.', 'error');
    }

    private function exists($key, $args) {
        global $wpdb;

        if ( empty( $this->input[$key] ) ) return;

        $val = $this->input[$key];



        $arr_args = explode(',', $args);

        $sql = "SELECT count(*) FROM {$arr_args[0]} WHERE {$arr_args[1]} = '{$val}'";

        if ( count($arr_args) > 2 ) {

            for ( $i = 2; $i < count($arr_args); $i++ ) {
                $field = $arr_args[$i];
                $value = $arr_args[++$i];

                $sql .= " AND $field != $value ";
            }

        }
        


        if (  $wpdb->get_var( $sql ) == 0 )  WEPN_Notify::add( ucfirst(  str_replace( '_', ' ', $key ) ) . ' is not exists.', 'error');

    }


    private function unique($key, $args) {
        global $wpdb;

        $val = $this->input[$key];

        $arr_args = explode(',', $args);

        $sql = "SELECT count(*) FROM {$arr_args[0]} WHERE {$arr_args[1]} = '{$val}'";

        if ( count($arr_args) > 2 ) {

            for ( $i = 2; $i < count($arr_args); $i++ ) {
                $field = $arr_args[$i];
                $value = $arr_args[++$i];

                $sql .= " AND $field != $value ";
            }

        }

        if ( $wpdb->get_var( $sql ) )  WEPN_Notify::add( ucfirst(  str_replace( '_', ' ', $key ) ) . ' already exists.', 'error');

    }

    private function min( $key, $min ) {

        $val = $this->input[$key];

        if ( strlen( $val ) < $min) WEPN_Notify::add( ucfirst(  str_replace( '_', ' ', $key ) ) . ' minimum length is '. $min, 'error');
    }

    public function fails() {

        return WEPN_Notify::has_errors();
    }
    
    public function success() {
        return WEPN_Notify::has_errors() ? false : true;
    }




}