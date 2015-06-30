<?php

if ( !function_exists('_isset') ) {
    function _isset( $val, $default = '', $echo = true ) {
        if ( !isset($val) ) $val = $default;

        if ( !$echo ) return $val;

        echo $val;
    }
}

function atu_render_errors($errors, $key) {
    if ( isset( $errors[$key] ) ) {
        foreach ( $errors[$key] as $error ) {
            echo "<span class='atu_error'>$error</span>";
        }
    }
}