<?php
/**
 * Age Verification Settings Page
 *
 * @package    Age_Verification
 * @subpackage Age_Verification/includes
 * @author     Devio Digital <contact@deviodigital.com>
 * @since      1.1.0
 */

// Hook into admin menu.
add_action( 'admin_menu', 'dav_register_settings_page' );
add_action( 'admin_init', 'dav_register_settings' );

/**
 * Register the settings page under "Settings" in the WP Admin.
 * 
 * @since  3.0.0
 * @return void
 */
function dav_register_settings_page() {
    add_options_page(
        __( 'Age Verification', 'dispensary-age-verification' ),
        __( 'Age Verification', 'dispensary-age-verification' ),
        'manage_options',
        'age-verification-settings',
        'dav_render_settings_page'
    );
}

/**
 * Register settings and fields.
 * 
 * @since  3.0.0
 * @return void
 */
function dav_register_settings() {
    // Register settings section.
    add_settings_section(
        'dav_settings_section',
        __( 'Age Verification Settings', 'dispensary-age-verification' ),
        '__return_false',
        'age-verification-settings'
    );

    // Fields array to loop through.
    $fields = [
        'dav_minAge' => [
            'label'   => __( 'Minimum age?', 'dispensary-age-verification' ),
            'type'    => 'number',
            'default' => '18',
        ],
        'dav_bgImage' => [
            'label' => __( 'Background image', 'dispensary-age-verification' ),
            'type'  => 'image',
        ],
        'dav_logo' => [
            'label' => __( 'Logo image', 'dispensary-age-verification' ),
            'type'  => 'image',
        ],
        'dav_title' => [
            'label'   => __( 'Title', 'dispensary-age-verification' ),
            'type'    => 'text',
            'default' => __( 'Age Verification', 'dispensary-age-verification' ),
        ],
        'dav_copy' => [
            'label'   => __( 'Copy', 'dispensary-age-verification' ),
            'type'    => 'textarea',
            'default' => __( 'You must be [age] years old to enter.', 'dispensary-age-verification' ),
        ],
        'dav_button_yes' => [
            'label'   => __( 'Button #1 text', 'dispensary-age-verification' ),
            'type'    => 'text',
            'default' => __( 'YES', 'dispensary-age-verification' ),
        ],
        'dav_button_no' => [
            'label'   => __( 'Button #2 text', 'dispensary-age-verification' ),
            'type'    => 'text',
            'default' => __( 'NO', 'dispensary-age-verification' ),
        ],
        'dav_message_display_time' => [
            'label'   => __( 'Message display time (milliseconds)', 'dispensary-age-verification' ),
            'type'    => 'number',
            'default' => 2000,
        ],
        'dav_adminHide' => [
            'label'   => __( 'Hide for admin users?', 'dispensary-age-verification' ),
            'type'    => 'checkbox',
            'default' => '',
        ],
    ];

    // Loop through fields and register them.
    foreach ( $fields as $id => $field ) {
        register_setting( 'dav_settings_group', $id, [
            'sanitize_callback' => 'dav_sanitize_field_input'
        ] );

        add_settings_field(
            $id,
            $field['label'],
            'dav_render_field',
            'age-verification-settings',
            'dav_settings_section',
            [
                'id'      => $id,
                'type'    => $field['type'],
                'default' => $field['default'] ?? '',
            ]
        );
    }
}

/**
 * Render the settings page.
 * 
 * @since  3.0.0
 * @return void
 */
function dav_render_settings_page() {
    ?>
    <div class="wrap">
        <h1>
            <?php esc_html_e( 'Age Verification Settings', 'dispensary-age-verification' ); ?>
            <a id="avwp-support-btn" href="https://robertdevore.com/contact/" target="_blank" class="button button-alt" style="margin-left: 10px;">
                <span class="dashicons dashicons-format-chat" style="vertical-align: middle;"></span> <?php esc_html_e( 'Support', 'dispensary-age-verification' ); ?>
            </a>
            <a id="avwp-docs-btn" href="https://robertdevore.com/articles/age-verification-for-wordpress/" target="_blank" class="button button-alt" style="margin-left: 5px;">
                <span class="dashicons dashicons-media-document" style="vertical-align: middle;"></span> <?php esc_html_e( 'Documentation', 'dispensary-age-verification' ); ?>
            </a>
        </h1>
        <hr />
        <form method="post" action="options.php">
            <?php
            settings_fields( 'dav_settings_group' );
            do_settings_sections( 'age-verification-settings' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

/**
 * Render fields dynamically.
 *
 * @param array $args Field arguments.
 * 
 * @since  3.0.0
 * @return void
 */
function dav_render_field( $args ) {
    $id    = esc_attr( $args['id'] );
    $value = get_option( $id, $args['default'] );

    echo '<div class="form-field">';

    switch ( $args['type'] ) {
        case 'text':
        case 'number':
            printf(
                '<input type="%s" name="%s" id="%s" value="%s">',
                esc_attr( $args['type'] ),
                esc_attr( $id ),
                esc_attr( $id ),
                esc_attr( $value )
            );
            break;

        case 'textarea':
            printf(
                '<textarea name="%s" id="%s" rows="4">%s</textarea>',
                esc_attr( $id ),
                esc_attr( $id ),
                esc_textarea( $value )
            );
            break;

        case 'checkbox': // Convert checkbox to a toggle switch
            printf(
                '<label class="toggle-switch">
                    <input type="checkbox" name="%s" id="%s" value="1" %s>
                    <span class="toggle-slider"></span>
                </label>',
                esc_attr( $id ),
                esc_attr( $id ),
                checked( $value, 1, false )
            );
            break;

        case 'image': // Image Upload Field
            printf(
                '<input type="text" name="%s" id="%s" value="%s" class="regular-text dav-image-field">
                 <button type="button" class="button dav-upload-image">%s</button>',
                esc_attr( $id ),
                esc_attr( $id ),
                esc_url( $value ),
                esc_html__( 'Upload Image', 'dispensary-age-verification' )
            );
            break;
    }

    echo '</div>';
}

/**
 * Sanitize input values.
 *
 * @param mixed $input The input value.
 * 
 * @since  3.0.0
 * @return mixed Sanitized input.
 */
function dav_sanitize_field_input( $input ) {
    return is_array( $input ) ? array_map( 'sanitize_text_field', $input ) : sanitize_text_field( $input );
}
