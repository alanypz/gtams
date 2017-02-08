<?php

namespace App;

/**
 * Class Utility
 * Utility functions to be used in various situations
 */
class Utility
{

    public function __construct() {
    }

    /**
     * Static class function to log out to console using Chrome console.log
     * @param $data
     */
    public static function consoleLog( $data ) {
        if (is_array( $data )) $output = "<script>console.log( 'Debug Objects: " . json_encode($data) . "' );</script>";
        else $output = "<script>console.log( 'Debug Objects: " . json_encode($data) . "' );</script>";
        echo $output;
    }
}