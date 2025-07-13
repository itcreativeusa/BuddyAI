<?php
/**
 * Plugin Name: Custom Footer Wp Admin
 * Description: Custom footer text for WordPress admin area
 * Version: 1.0
 * Author: Kateryna Stetsenko
 */

// Display a message in the WordPress admin footer
add_filter('admin_footer_text', function () {
    return 'Built with ❤️ by Kateryna';
});
