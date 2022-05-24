<?php
/**
 * The file that defines the core plugin helper functions
 *
 * @link       https://www.deviodigital.com
 * @since      2.4
 *
 * @package    Age_Verification
 * @subpackage Age_Verification/includes
 */


/**
 * Convert hexdec color string to rgb(a) string
 * 
 * @since 2.4
 * @return string
 */ 
function avwp_hex2rgba( $color, $opacity = false ) {

    // Default.
    $default = 'rgb(0,0,0)';
 
    // Return default if no color provided.
    if ( empty( $color ) ) {
        return $default; 
    }
 
    // Sanitize $color if "#" is provided.
    if ( '#' == $color[0] ) {
        $color = substr( $color, 1 );
    }

    // Check if color has 6 or 3 characters and get values.
    if ( 6 == strlen( $color ) ) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( 3 == strlen( $color ) ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    // Convert hexadec to rgb.
    $rgb = array_map( 'hexdec', $hex );

    // Check if opacity is set(rgba or rgb).
    if ( $opacity ) {
        if ( abs( $opacity ) > 1 ) {
            $opacity = 1.0;
        }
        $output  = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
    } else {
        $output = 'rgb(' . implode( ',', $rgb ) . ')';
    }

    // Return rgb(a) color string
    return $output;
}
