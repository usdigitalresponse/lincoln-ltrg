<?php
/**
 * Add Jupiter settings to the WordPress Customizer.
 *
 * @package JupiterX\Framework\Admin\Customizer
 *
 * @since   1.0.0
 */

// Blog.
JupiterX_Customizer::add_panel( 'jupiterx_blog_panel', [
	'priority' => 160,
	'title'    => __( 'Blog', 'jupiterx-core' ),
] );

// Portfolio.
JupiterX_Customizer::add_panel( 'jupiterx_portfolio_panel', [
	'priority' => 170,
	'title'    => __( 'Portfolio', 'jupiterx-core' ),
] );

// Pages.
JupiterX_Customizer::add_panel( 'jupiterx_pages', [
	'priority' => 160,
	'title'    => __( 'Pages', 'jupiterx-core' ),
] );

// Post Types.
JupiterX_Customizer::add_panel( 'jupiterx_post_types', [
	'priority' => 350,
	'type'     => 'nested',
	'title'    => __( 'Post Types', 'jupiterx-core' ),
] );

// Elements.
JupiterX_Customizer::add_panel( 'jupiterx_elements', [
	'priority' => 160,
	'type'     => 'nested',
	'title'    => __( 'Elements', 'jupiterx-core' ),
] );

/**
 * Load all the popups.
 *
 * @since 1.0.0
 */
$popups = [
	'pro',
	'logo',
	'layout',
	'typography',
	'header',
	'title-bar',
	'sidebar',
	'footer',
	'blog-single',
	'blog-archive',
	'portfolio-single',
	'portfolio-archive',
	'page-single',
	'product-list',
	'product-page',
	'checkout-cart',
	'product-archive',
	'cart-quick-view',
	'notice-messages',
	'search',
	'404',
	'maintenance',
	'post-types',
	'comment',
	'go-to-top',
	'background',
];

foreach ( $popups as $popup ) {
	require_once dirname( __FILE__ ) . '/' . $popup . '/popup.php';
}
