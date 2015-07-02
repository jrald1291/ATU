<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}



class ATU_Validator {
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

                $this->{trim($arr[0])}( $key, trim($arr[1]) );
            }
        }
        return $this;
    }


    private function required( $key ) {
        $val = $this->input[$key];

        if ( !isset( $val ) || strlen( trim( $val ) ) == 0  ) ATU_Notify::add( ucfirst( $key ) . ' is required.', 'error');

    }

    private function email( $key ) {
        $val = $this->input[$key];

        if ( !filter_var( $val, FILTER_VALIDATE_EMAIL ) ) ATU_Notify::add( ucfirst( $key ) . ' is invalid.', 'error');
    }


    private function same( $key, $key2 ) {
        $val = $this->input[$key];
        $val2 = $this->input[$key2];

        if( $val != $val2 ) {
            ATU_Notify::add( ucfirst( $key2 ) . ' must be the same.', 'error');
        }
    }

    private function url( $key ) {
        $val = $this->input[$key];

        if ( !filter_var( $val, FILTER_VALIDATE_URL ) ) ATU_Notify::add( ucfirst( $key ) . ' is invalid.', 'error');
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


        if ( ! $wpdb->get_var( $sql ) )  ATU_Notify::add( ucfirst( $key ) . ' is not exists.', 'error');

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

        if ( $wpdb->get_var( $sql ) )  ATU_Notify::add( ucfirst( $key ) . ' already exists.', 'error');

    }

    private function min( $key, $min ) {

        $val = $this->input[$key];

        if ( strlen( $val ) < $min) ATU_Notify::add( ucfirst( $key ) . ' minimum length is '. $min, 'error');
    }

    public function fails() {

        return ATU_Notify::has_errors();
    }
    
    public function success() {
        return ATU_Notify::has_errors() ? false : true;
    }




}