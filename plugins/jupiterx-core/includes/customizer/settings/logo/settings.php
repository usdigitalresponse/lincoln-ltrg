<?php
/**
 * Add Jupiter settings for Site Identity > Logo > Settings tab to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.0.0
 */

$section = 'jupiterx_logo';

// Logo help link.
JupiterX_Customizer::add_field( [
	'type'            => 'jupiterx-alert',
	'settings'        => 'jupiterx_logo_warning',
	'section'         => $section,
	'label'           => __( 'Learn how to use the following settings properly.', 'jupiterx-core' ),
	'jupiterx_url'    => 'https://themes.artbees.net/docs/adding-multiple-versions-of-logo-to-website/',
	'jupiterx_type'   => 'default-customizer',
	'active_callback' => 'jupiterx_is_help_links',
] );

// Primary Logo.
JupiterX_Customizer::add_field( [
	'type'          => 'jupiterx-image',
	'settings'      => 'jupiterx_logo',
	'section'       => $section,
	'label'         => __( 'Primary Logo', 'jupiterx-core' ),
	'column'        => 12,
	'template_type' => 'logo',
] );

// Secondary Logo.
JupiterX_Customizer::add_field( [
	'type'          => 'jupiterx-image',
	'settings'      => 'jupiterx_logo_secondary',
	'section'       => $section,
	'label'         => __( 'Secondary Logo', 'jupiterx-core' ),
	'column'        => 12,
	'template_type' => 'logo',
] );

// Sticky Logo.
JupiterX_Customizer::add_field( [
	'type'          => 'jupiterx-image',
	'settings'      => 'jupiterx_logo_sticky',
	'section'       => $section,
	'label'         => __( 'Sticky Logo', 'jupiterx-core' ),
	'column'        => 12,
	'template_type' => 'logo',
] );

// Retina Primary Logo.
JupiterX_Customizer::add_field( [
	'type'          => 'jupiterx-image',
	'settings'      => 'jupiterx_logo_retina',
	'section'       => $section,
	'label'         => __( 'Retina Primary Logo', 'jupiterx-core' ),
	'column'        => 12,
	'template_type' => 'logo',
] );

// Retina Secondary Logo.
JupiterX_Customizer::add_field( [
	'type'          => 'jupiterx-image',
	'settings'      => 'jupiterx_logo_secondary_retina',
	'section'       => $section,
	'label'         => __( 'Retina Secondary Logo', 'jupiterx-core' ),
	'column'        => 12,
	'template_type' => 'logo',
] );

// Retina sticky logo.
JupiterX_Customizer::add_field( [
	'type'          => 'jupiterx-image',
	'settings'      => 'jupiterx_logo_sticky_retina',
	'section'       => $section,
	'label'         => __( 'Retina Sticky Logo', 'jupiterx-core' ),
	'column'        => 12,
	'template_type' => 'logo',
] );

// Mobile Logo.
JupiterX_Customizer::add_field( [
	'type'          => 'jupiterx-image',
	'settings'      => 'jupiterx_logo_mobile',
	'section'       => $section,
	'label'         => __( 'Mobile Logo', 'jupiterx-core' ),
	'column'        => 12,
	'template_type' => 'logo',
] );


// Retina Mobile Logo.
JupiterX_Customizer::add_field( [
	'type'          => 'jupiterx-image',
	'settings'      => 'jupiterx_logo_mobile_retina',
	'section'       => $section,
	'label'         => __( 'Retina Mobile Logo', 'jupiterx-core' ),
	'column'        => 12,
	'template_type' => 'logo',
] );
