<?php
/*
Plugin Name: Simple Post Views Counter
Description: Automatically counts and displays views on posts and pages, compatible with block themes.
Version: 1.0
Author: Your Name
*/

// ✅ Count post/page views
function spvc_count_post_views() {
    if (is_singular(['post', 'page'])) {
        $post_id = get_the_ID();
        if ($post_id) {
            $views = get_post_meta($post_id, 'spvc_views', true);
            $views = $views ? $views : 0;
            update_post_meta($post_id, 'spvc_views', $views + 1);
        }
    }
}
add_action('wp_head', 'spvc_count_post_views');

// ✅ Inject view count at end of post content block (Gutenberg compatible)
function spvc_insert_view_count_in_post($block_content, $block) {
    if (is_singular() && isset($block['blockName']) && $block['blockName'] === 'core/post-content') {
        $views = get_post_meta(get_the_ID(), 'spvc_views', true);
        $views = $views ? $views : 0;
        $counter = '<p class="spvc-views" style="font-size:14px; margin-top:1em;">👁️ ' . $views . ' Views</p>';
        return $block_content . $counter;
    }
    return $block_content;
}
add_filter('render_block', 'spvc_insert_view_count_in_post', 10, 2);
