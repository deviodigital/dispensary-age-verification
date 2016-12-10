<?php
/**
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
			'title'     => 'Age Verification',
			'priority'  => 55,
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
				'label'    => __( 'Upload Logo', 'dispensary-age-verification' ),
				'section'  => 'dav_display_options',
				'settings' => 'dav_logo',
			)
		)
	);
	/* title */
	$wp_customize->add_setting(
		'dav_title',
		array(
			'default'            => 'Age Verification',
			'sanitize_callback'  => 'dav_sanitize_input',
			'transport'          => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_title',
		array(
			'section'  => 'dav_display_options',
			'label'    => 'Title',
			'type'     => 'text',
		)
	);
	/* copy */
	$wp_customize->add_setting(
		'dav_copy',
		array(
			'default'            => 'This Website requires you to be [21] years or older to enter. Please enter your Date of Birth in the fields below to continue:',
			'sanitize_callback'  => 'dav_sanitize_input',
			'transport'          => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_copy',
		array(
			'section'  => 'dav_display_options',
			'label'    => 'Copy',
			'type'     => 'textarea',
		)
	);
	/* minAge */
	$wp_customize->add_setting(
		'dav_minAge',
		array(
			'default'            => '18',
			'sanitize_callback'  => 'dav_sanitize_input',
			'transport'          => 'refresh',
		)
	);
	$wp_customize->add_control(
		'dav_minAge',
		array(
			'section'  => 'dav_display_options',
			'label'    => 'Minimum Age?',
			'type'     => 'number',
		)
	);
	/* redirectTo */
	$wp_customize->add_setting(
		'dav_redirectTo',
		array(
			'default'           => '',
			'sanitize_callback' => 'dav_sanitize_input',
		)
	);
	$wp_customize->add_control(
		'dav_redirectTo',
		array(
			'label'    => __( 'Redirect to', 'dispensary-age-verification' ),
			'section'  => 'dav_display_options',
			'type'     => 'dropdown-pages',
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
