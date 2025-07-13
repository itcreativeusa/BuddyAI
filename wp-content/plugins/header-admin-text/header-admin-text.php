<?php
/**
 * Plugin Name: Header Admin Text
 * Description: Custom admin notice for WordPress admin area
 * Version: 1.0
 * Author: Kateryna Stetsenko
 */

// Display a message in the WordPress admin area
add_action('in_admin_header', function () {
    echo '<div style="padding:10px;background:#f1f1f1;color:#222;font-weight:bold;">🌟 Welcome, Admin!</div>';
});

