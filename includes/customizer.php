<?php
/**
 * Dispensary Age Verification Customizer Options.
 *
 * @package    Dispensary_Age_Verification
 * @since      1.1.0
 */

/**
 * Registers options with the Theme Customizer
 *
 * @param      object $wp_customize The WordPress Theme Customizer.
 */
function dav_register_theme_customizer( $wp_customize ) {
	/**
	 * Defining our own 'Display Options' section
	 */
	$wp_customize->add_section(
		'dav_display_options',
		array(
			'title'    => __( 'Age Verification', 'dispensary-age-verification' ),
			'priority' => 55,
		)
	);

	/* minAge */
	$wp_customize->add_setting(
		'dav_minAge',
		array(
			'default'           => '18',
			'sanitize_callback' => 'dav_sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_minAge',
		array(
			'section'  => 'dav_display_options',
			'label'    => __( 'Minimum age?', 'dispensary-age-verification' ),
			'type'     => 'number',
			'priority' => 7,
		)
	);

	/* Add setting for background image uploader. */
	$wp_customize->add_setting( 'dav_bgImage' );

	/* Add control for background image uploader (actual uploader) */
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'dav_bgImage',
			array(
				'label'    => __( 'Background image', 'dispensary-age-verification' ),
				'section'  => 'dav_display_options',
				'settings' => 'dav_bgImage',
				'priority' => 8
			)
		)
	);

	/* Add setting for logo uploader. */
	$wp_customize->add_setting( 'dav_logo' );

	/* Add control for logo uploader (actual uploader) */
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'dav_logo',
			array(
				'label'    => __( 'Logo image', 'dispensary-age-verification' ),
				'section'  => 'dav_display_options',
				'settings' => 'dav_logo',
				'priority' => 9
			)
		)
	);

	/* title */
	$wp_customize->add_setting(
		'dav_title',
		array(
			'default'           => __( 'Age Verification', 'dispensary-age-verification' ),
			'sanitize_callback' => 'dav_sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_title',
		array(
			'section'  => 'dav_display_options',
			'label'    => __( 'Title', 'dispensary-age-verification' ),
			'type'     => 'text',
			'priority' => 10,
		)
	);

	/* copy */
	$wp_customize->add_setting(
		'dav_copy',
		array(
			'default'           => __( 'You must be [age] years old to enter.', 'dispensary-age-verification' ),
			'sanitize_callback' => 'dav_sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_copy',
		array(
			'section'  => 'dav_display_options',
			'label'    => __( 'Copy', 'dispensary-age-verification' ),
			'type'     => 'textarea',
			'priority' => 11,
		)
	);

	/* No button */
	$wp_customize->add_setting(
		'dav_button_no',
		array(
			'default'           => __( 'NO', 'dispensary-age-verification' ),
			'sanitize_callback' => 'dav_sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_button_no',
		array(
			'section'  => 'dav_display_options',
			'label'    => __( 'Button #1 text', 'dispensary-age-verification' ),
			'type'     => 'text',
			'priority' => 13,
		)
	);

	/* Yes button */
	$wp_customize->add_setting(
		'dav_button_yes',
		array(
			'default'           => __( 'YES', 'dispensary-age-verification' ),
			'sanitize_callback' => 'dav_sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_button_yes',
		array(
			'section'  => 'dav_display_options',
			'label'    => __( 'Button #2 text', 'dispensary-age-verification' ),
			'type'     => 'text',
			'priority' => 14,
		)
	);
	/* Show or Hide Blog Description */
	$wp_customize->add_setting(
		'dav_adminHide',
		array(
			'default'           => '',
			'sanitize_callback' => 'dav_sanitize_input',
			'transport'         => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_adminHide',
		array(
			'section'  => 'dav_display_options',
			'label'    => __( 'Hide for admin users?', 'dispensary-age-verification' ),
			'type'     => 'checkbox',
			'priority' => 99,
		)
	);

} // end dav_register_theme_customizer
add_action( 'customize_register', 'dav_register_theme_customizer' );

/**
 * Sanitizes the incoming input and returns it prior to serialization.
 *
 * @param      string $input    The string to sanitize.
 * @return     string              The sanitized string
 * @package    dav
 * @since      0.5.0
 * @version    1.0.2
 */
function dav_sanitize_input( $input ) {
	return strip_tags( stripslashes( $input ) );
}
