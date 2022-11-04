<?php
/*
Plugin Name: No Gutenberg
Plugin URI: https://github.com/squarecandy/squarecandy-no-gutenberg
GitHub Plugin URI: https://github.com/squarecandy/squarecandy-no-gutenberg
Primary Branch: main
Description: Completely disables the Gutenberg Block Editor
Version: 1.1.0
Author: squarecandy

Copyright 2022 Peter T. Wise D.B.A. Square Candy Design
See LICENSE file
*/
add_filter( 'use_block_editor_for_post', '__return_false', 10 );

// REMOVE GUTENBERG BLOCK LIBRARY CSS FROM LOADING ON FRONTEND
// see https://github.com/WordPress/gutenberg/issues/24684#issuecomment-1022370212
function squarecandy_remove_wp_block_library_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // REMOVE WOOCOMMERCE BLOCK CSS
	wp_dequeue_style( 'global-styles' ); // REMOVE THEME.JSON
	wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'squarecandy_remove_wp_block_library_css', 100 );

// remove duotone SVG markup
// see https://github.com/WordPress/gutenberg/issues/38299#issuecomment-1223860368
remove_filter( 'render_block', 'wp_render_duotone_support', 999 );
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );
