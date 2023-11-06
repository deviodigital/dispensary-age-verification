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

/**
 * Get media ID from URL
 * 
 * @param string $image_url The image URL - https:// ...
 * 
 * @return int|null
 */
function avwp_get_media_id_from_url( $image_url ) {
    global $wpdb;

    // Prepare the SQL query using $wpdb->prepare() to prevent SQL injection
    $sql = $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid = %s", $image_url );

    // Use $wpdb->get_var() to execute the prepared query and retrieve the result.
    $attachment_id = $wpdb->get_var( $sql );

    // Return the attachment ID (or null if not found).
    return $attachment_id;
}

/**
 * Get image sizes by ID
 * 
 * @param int $media_id The media ID
 * 
 * @return array|bool
 */
function avwp_get_image_sizes_by_id( $media_id ) {
    // Check if the media ID is valid.
    if ( wp_attachment_is_image( $media_id ) ) {
        // Get the image size information for the full size.
        $image_size_info = wp_get_attachment_image_src( $media_id, 'full' );

        if ( $image_size_info ) {
            // Extract the width and height from the returned array
            list( $url, $width, $height ) = $image_size_info;

            // Return the dimensions as an array
            return array(
                'width'  => $width,
                'height' => $height
            );
        }
    }

    // If the media ID is not valid or doesn't exist, return false.
    return false;
}

/**
 * Get explicit image sizes
 * 
 * @param string $image_url The image URL - https:// ...
 * 
 * @return string
 */
function avwp_get_explicit_image_sizes( $image_url ) {

    $img_explicit = '';

    if ( $image_url ) {
        $logo_media_id  = avwp_get_media_id_from_url( $image_url );
        $img_dimensions = avwp_get_image_sizes_by_id( $logo_media_id );
        
        if ( $img_dimensions ) {
            $img_explicit = ' width="' . $img_dimensions['width'] . '" height="' . $img_dimensions['height'] . '" ';
        }        
    }

    return $img_explicit;
}