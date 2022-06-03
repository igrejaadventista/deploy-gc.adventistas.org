<?php

// WP REST Headless
add_filter('wp_headless_rest__enable_rest_cleanup', '__return_true');
add_filter('wp_headless_rest__disable_front_end', '__return_false');
