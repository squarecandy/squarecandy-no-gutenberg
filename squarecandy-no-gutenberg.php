<?php
/*
Plugin Name: No Gutenberg
Plugin URI: https://github.com/squarecandy/squarecandy-no-gutenberg
GitHub Plugin URI: https://github.com/squarecandy/squarecandy-no-gutenberg
Primary Branch: main
Description: Completely disables the Gutenberg Block Editor
Version: 1.0.0
Author: squarecandy

Copyright 2022 Peter T. Wise D.B.A. Square Candy Design
See LICENSE file
*/
add_filter('use_block_editor_for_post', '__return_false', 10);
