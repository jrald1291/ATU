<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}



class ATU_Validator {
    var $wp_errors = null;
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

        if ( !isset( $val ) || strlen( trim( $val ) ) == 0  ) $this->wp_errors->add( $key, ' is required.');


    }

    private function email( $key ) {
        $val = $this->input[$key];

        if ( !filter_var( $val, FILTER_VALIDATE_EMAIL ) ) $this->wp_errors->add($key, ' is invalid.');
    }

    private function url( $key ) {
        $val = $this->input[$key];

        if ( !filter_var( $val, FILTER_VALIDATE_URL ) ) $this->wp_errors->add($key, ' is invalid.');
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

        if ( $wpdb->get_var( $sql ) ) $this->wp_errors->add( $key, ' already exists.' );

    }

    private function min( $key, $min ) {

        $val = $this->input[$key];

        if ( strlen( $val ) < $min) $this->wp_errors->add( $key, ' minimum length is '. $min);
    }

    public function fails() {

        return count($this->errors()) != 0 ? true : false;
    }
    
    public function success() {
        return count($this->errors()) != 0 ? true : false;
    }

    public function errors() {
        return $this->wp_errors->errors;
    }




}