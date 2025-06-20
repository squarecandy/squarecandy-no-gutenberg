<?php
/*
Plugin Name: No Gutenberg
Plugin URI: https://github.com/squarecandy/squarecandy-no-gutenberg
GitHub Plugin URI: https://github.com/squarecandy/squarecandy-no-gutenberg
Primary Branch: main
Description: Completely disables the Gutenberg Block Editor
Version: 1.2.1
Author: squarecandy

Copyright 2022 Peter T. Wise D.B.A. Square Candy Design
See LICENSE file
*/

// Don't use Block Editor anywhere
// See https://developer.wordpress.org/reference/hooks/use_block_editor_for_post/
add_filter( 'use_block_editor_for_post', '__return_false', 10 );

// REMOVE GUTENBERG BLOCK LIBRARY CSS FROM LOADING ON FRONTEND
// see https://github.com/WordPress/gutenberg/issues/24684#issuecomment-1022370212
// and updated for WooCommerce 8.x https://wordpress.stackexchange.com/a/418033/41488
function squarecandy_remove_wp_block_library_css() {

	if ( is_admin() ) {
		return;
	}

	$remove_styles = array(
		// WP Core styles
		'wp-block-library',
		'wp-block-library-theme',
		'classic-theme-styles',
		'classic-theme-styles-inline',
		// Remove theme.json
		'global-styles',
		// Remove WooCommerce block styles
		'wc-block-style',
		'wc-blocks-style',
		'wc-blocks-style-active-filters',
		'wc-blocks-style-add-to-cart-form',
		'wc-blocks-packages-style',
		'wc-blocks-style-all-products',
		'wc-blocks-style-all-reviews',
		'wc-blocks-style-attribute-filter',
		'wc-blocks-style-breadcrumbs',
		'wc-blocks-style-catalog-sorting',
		'wc-blocks-style-customer-account',
		'wc-blocks-style-featured-category',
		'wc-blocks-style-featured-product',
		'wc-blocks-style-mini-cart',
		'wc-blocks-style-price-filter',
		'wc-blocks-style-product-add-to-cart',
		'wc-blocks-style-product-button',
		'wc-blocks-style-product-categories',
		'wc-blocks-style-product-image',
		'wc-blocks-style-product-image-gallery',
		'wc-blocks-style-product-query',
		'wc-blocks-style-product-results-count',
		'wc-blocks-style-product-reviews',
		'wc-blocks-style-product-sale-badge',
		'wc-blocks-style-product-search',
		'wc-blocks-style-product-sku',
		'wc-blocks-style-product-stock-indicator',
		'wc-blocks-style-product-summary',
		'wc-blocks-style-product-title',
		'wc-blocks-style-rating-filter',
		'wc-blocks-style-reviews-by-category',
		'wc-blocks-style-reviews-by-product',
		'wc-blocks-style-product-details',
		'wc-blocks-style-single-product',
		'wc-blocks-style-stock-filter',
		'wc-blocks-style-cart',
		'wc-blocks-style-checkout',
		'wc-blocks-style-mini-cart-contents',
	);

	foreach ( $remove_styles as $remove_style ) {
		wp_deregister_style( $remove_style );
	}

	$remove_scripts = array(
		'wc-blocks-middleware',
		'wc-blocks-data-store',
	);

	foreach ( $remove_scripts as $remove_script ) {
		wp_deregister_script( $remove_script );
	}

}
add_action( 'wp_enqueue_scripts', 'squarecandy_remove_wp_block_library_css', 999 );

// remove duotone SVG markup
// see https://github.com/WordPress/gutenberg/issues/38299#issuecomment-1223860368
remove_filter( 'render_block', 'wp_render_duotone_support', 999 );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
