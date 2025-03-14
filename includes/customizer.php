<?php
/**
 * Dispensary Age Verification Customizer Options.
 *
 * @package    Age_Verification
 * @subpackage Age_Verification/includes
 * @author     Devio Digital <contact@deviodigital.com>
 * @link       https://www.deviodigital.com
 * @since      1.1.0
 */

/**
 * Registers options with the Theme Customizer
 *
 * @param object $wp_customize The WordPress Theme Customizer.
 * 
 * @return void
 */
function dav_register_theme_customizer( $wp_customize ) {
    /**
     * Defining our own 'Display Options' section
     */
    $wp_customize->add_section(
        'dav_display_options',
        [
            'title'    => esc_attr__( 'Age Verification', 'dispensary-age-verification' ),
            'priority' => 55,
        ]
    );

    /* minAge */
    $wp_customize->add_setting(
        'dav_minAge',
        [
            'default'           => '18',
            'sanitize_callback' => 'dav_sanitize_input',
            'transport'         => 'refresh',
        ]
    );
    $wp_customize->add_control(
        'dav_minAge',
        [
            'section'  => 'dav_display_options',
            'label'    => esc_attr__( 'Minimum age?', 'dispensary-age-verification' ),
            'type'     => 'number',
            'priority' => 7,
        ]
    );

    /* Add setting for background image uploader. */
    $wp_customize->add_setting( 'dav_bgImage' );

    /* Add control for background image uploader (actual uploader) */
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'dav_bgImage',
            [
                'label'    => esc_attr__( 'Background image', 'dispensary-age-verification' ),
                'section'  => 'dav_display_options',
                'settings' => 'dav_bgImage',
                'priority' => 8
            ]
        )
    );

    /* Add setting for logo uploader. */
    $wp_customize->add_setting( 'dav_logo' );

    /* Add control for logo uploader (actual uploader) */
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'dav_logo',
            [
                'label'    => esc_attr__( 'Logo image', 'dispensary-age-verification' ),
                'section'  => 'dav_display_options',
                'settings' => 'dav_logo',
                'priority' => 9
            ]
        )
    );

    /* title */
    $wp_customize->add_setting(
        'dav_title',
        [
            'default'           => esc_attr__( 'Age Verification', 'dispensary-age-verification' ),
            'sanitize_callback' => 'dav_sanitize_input',
            'transport'         => 'refresh',
        ]
    );
    $wp_customize->add_control(
        'dav_title',
        [
            'section'  => 'dav_display_options',
            'label'    => esc_attr__( 'Title', 'dispensary-age-verification' ),
            'type'     => 'text',
            'priority' => 10,
        ]
    );

    /* copy */
    $wp_customize->add_setting(
        'dav_copy',
        [
            'default'           => esc_attr__( 'You must be [age] years old to enter.', 'dispensary-age-verification' ),
            'sanitize_callback' => 'dav_sanitize_input',
            'transport'         => 'refresh',
        ]
    );
    $wp_customize->add_control(
        'dav_copy',
        [
            'section'  => 'dav_display_options',
            'label'    => esc_attr__( 'Copy', 'dispensary-age-verification' ),
            'type'     => 'textarea',
            'priority' => 11,
        ]
    );

    /* Yes button */
    $wp_customize->add_setting(
        'dav_button_yes',
        [
            'default'           => esc_attr__( 'YES', 'dispensary-age-verification' ),
            'sanitize_callback' => 'dav_sanitize_input',
            'transport'         => 'refresh',
        ]
    );
    $wp_customize->add_control(
        'dav_button_yes',
        [
            'section'  => 'dav_display_options',
            'label'    => esc_attr__( 'Button #1 text', 'dispensary-age-verification' ),
            'type'     => 'text',
            'priority' => 14,
        ]
    );

    /* No button */
    $wp_customize->add_setting(
        'dav_button_no',
        [
            'default'           => esc_attr__( 'NO', 'dispensary-age-verification' ),
            'sanitize_callback' => 'dav_sanitize_input',
            'transport'         => 'refresh',
        ]
    );
    $wp_customize->add_control(
        'dav_button_no',
        [
            'section'  => 'dav_display_options',
            'label'    => esc_attr__( 'Button #2 text', 'dispensary-age-verification' ),
            'type'     => 'text',
            'priority' => 15,
        ]
    );

    /* Success/Failure message display time */
    $wp_customize->add_setting(
        'dav_message_display_time',
        [
            'default'           => 2000,
            'sanitize_callback' => 'dav_sanitize_input',
            'transport'         => 'refresh',
        ]
    );
    $wp_customize->add_control(
        'dav_message_display_time',
        [
            'section'  => 'dav_display_options',
            'label'    => esc_attr__( 'Message display time (milliseconds)', 'dispensary-age-verification' ),
            'type'     => 'number',
            'priority' => 18,
        ]
    );

    /* Show or Hide Blog Description */
    $wp_customize->add_setting(
        'dav_adminHide',
        [
            'default'           => '',
            'sanitize_callback' => 'dav_sanitize_input',
            'transport'         => 'refresh',
        ]
    );
    $wp_customize->add_control(
        'dav_adminHide',
        [
            'section'  => 'dav_display_options',
            'label'    => esc_attr__( 'Hide for admin users?', 'dispensary-age-verification' ),
            'type'     => 'checkbox',
            'priority' => 99,
        ]
    );

} // end dav_register_theme_customizer
add_action( 'customize_register', 'dav_register_theme_customizer' );

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param string $input The string to sanitize.
 * 
 * @package dav
 * 
 * @since   0.5.0
 * @version 1.0.2
 * @return  string $input The sanitized string.
 */
function dav_sanitize_input( $input ) {
    return strip_tags( stripslashes( $input ) );
}

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param string $input   The string to sanitize.
 * @param string $setting The sanitized string.
 * 
 * @package dav
 * 
 * @since   2.5.0
 * @version 1.0.0
 * @return  string $input The sanitized string.
 */
function dav_sanitize_select( $input, $setting ) {
    // Ensure input is a slug.
    $input = sanitize_key( $input );
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}