<?php
/**
 * Add Jupiter settings for Element > Go to Top > Styles > Container popup to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since  1.20.0
 */

$section = 'jupiterx_go_to_top_styles';

// Background color
JupiterX_Customizer::add_field( [
	'type'      => 'jupiterx-color',
	'settings'  => 'jupiterx_go_to_top_background_color',
	'section'   => $section,
	'css_var'   => 'go-to-top-background-color',
	'column'    => '3',
	'icon'      => 'background-color',
	'transport' => 'postMessage',
	'default'   => '#e9ecef',
	'output'    => [
		[
			'element'  => '.jupiterx-scroll-top',
			'property' => 'background-color',
		],
	],
] );

// Icon color
JupiterX_Customizer::add_field( [
	'type'      => 'jupiterx-color',
	'settings'  => 'jupiterx_go_to_top_icon_color',
	'section'   => $section,
	'css_var'   => 'go-to-top-icon-color',
	'column'    => '3',
	'icon'      => 'font-color',
	'transport' => 'postMessage',
	'default'   => '#adb5bd',
	'output'    => [
		[
			'element'  => '.jupiterx-scroll-top',
			'property' => 'color',
		],
	],
] );

// Border
JupiterX_Customizer::add_field( [
	'type'      => 'jupiterx-border',
	'settings'  => 'jupiterx_go_to_top_border',
	'section'   => $section,
	'css_var'   => 'go-to-top-border',
	'transport' => 'postMessage',
	'exclude'   => [ 'style', 'size' ],
	'default'   => [
		'color'  => '#e9ecef',
		'width' => [
			'size' => 1,
			'unit' => 'px',
		],
		'radius' => [
			'size' => 0.25,
			'unit' => 'rem',
		],
	],
	'output'    => [
		[
			'element' => '.jupiterx-scroll-top',
		],
	],
] );

// Hover label.
JupiterX_Customizer::add_field( [
	'type'       => 'jupiterx-label',
	'label'      => __( 'Hover', 'jupiterx-core' ),
	'label_type' => 'fancy',
	'color'      => 'orange',
	'settings' => 'jupiterx_go_to_top_label',
	'section'  => $section,
] );

// Background color on hover
JupiterX_Customizer::add_field( [
	'type'      => 'jupiterx-color',
	'settings'  => 'jupiterx_go_to_top_background_color_hover',
	'section'   => $section,
	'css_var'   => 'go-to-top-background-color-hover',
	'column'    => '3',
	'icon'      => 'background-color',
	'transport' => 'postMessage',
	'output'    => [
		[
			'element'  => '.jupiterx-scroll-top:hover, .jupiterx-scroll-top:focus',
			'property' => 'background-color',
		],
	],
] );

// Icon color on hover
JupiterX_Customizer::add_field( [
	'type'      => 'jupiterx-color',
	'settings'  => 'jupiterx_go_to_top_icon_color_hover',
	'section'   => $section,
	'css_var'   => 'go-to-top-icon-color-hover',
	'column'    => '3',
	'icon'      => 'font-color',
	'transport' => 'postMessage',
	'default'   => '#6c757d',
	'output'    => [
		[
			'element'  => '.jupiterx-scroll-top:hover, .jupiterx-scroll-top:focus',
			'property' => 'color',
		],
	],
] );

// Border color on hover
JupiterX_Customizer::add_field( [
	'type'      => 'jupiterx-color',
	'settings'  => 'jupiterx_go_to_top_border_color_hover',
	'section'   => $section,
	'css_var'   => 'go-to-top-border-color-hover',
	'column'    => '3',
	'icon'      => 'border-color',
	'transport' => 'postMessage',
	'output'    => [
		[
			'element'  => '.jupiterx-scroll-top:hover',
			'property' => 'border-color',
		],
	],
] );

// Divider.
JupiterX_Customizer::add_field( [
	'type'     => 'jupiterx-divider',
	'settings' => 'jupiterx_go_to_top_divider_2',
	'section'  => $section,
] );

// Spacing.
JupiterX_Customizer::add_responsive_field( [
	'type'      => 'jupiterx-box-model',
	'settings'  => 'jupiterx_go_to_top_spacing',
	'section'   => $section,
	'css_var'   => 'go-to-top',
	'transport' => 'postMessage',
	'default'   => [
		'desktop' => [
			'padding_top'    => 1,
			'padding_right'  => 1.2,
			'padding_bottom' => 1,
			'padding_left'   => 1.2,
			'margin_top'    => 1,
			'margin_right'  => 1,
			'margin_bottom' => 1,
			'margin_left'   => 1,
		],
	],
	'output'    => [
		[
			'element' => '.jupiterx-scroll-top',
		],
	],
] );
