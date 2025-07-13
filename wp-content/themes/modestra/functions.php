<?php
if (!defined('MODESTRA_VERSION')) {
    // Replace the version number of the theme on each release.
    define('MODESTRA_VERSION', wp_get_theme()->get('Version'));
}
define('MODESTRA_DEBUG', defined('WP_DEBUG') && WP_DEBUG === true);
define('MODESTRA_DIR', trailingslashit(get_template_directory()));
define('MODESTRA_URL', trailingslashit(get_template_directory_uri()));

if (!function_exists('modestra_support')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @since walker_fse 1.0.0
     *
     * @return void
     */
    function modestra_support()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        // Add support for block styles.
        add_theme_support('wp-block-styles');
        add_theme_support('post-thumbnails');
        // Enqueue editor styles.
        add_editor_style('style.css');
        // Removing default patterns.
        remove_theme_support('core-block-patterns');
    }

endif;
add_action('after_setup_theme', 'modestra_support');

/*----------------------------------------------------------------------------------
Enqueue Styles
-----------------------------------------------------------------------------------*/
if (!function_exists('modestra_styles')) :
    function modestra_styles()
    {
        // registering style for theme
        wp_enqueue_style('modestra-style', get_stylesheet_uri(), array(), MODESTRA_VERSION);
        wp_enqueue_style('modestra-blocks-style', get_template_directory_uri() . '/assets/css/blocks.css');
        wp_enqueue_style('modestra-aos-style', get_template_directory_uri() . '/assets/css/aos.css');
        if (is_rtl()) {
            wp_enqueue_style('modestra-rtl-css', get_template_directory_uri() . '/assets/css/rtl.css', 'rtl_css');
        }
        wp_enqueue_script('jquery');
        wp_enqueue_script('modestra-aos-scripts', get_template_directory_uri() . '/assets/js/aos.js', array(), MODESTRA_VERSION, true);
        wp_enqueue_script('modestra-scripts', get_template_directory_uri() . '/assets/js/modestra-scripts.js', array(), MODESTRA_VERSION, true);
    }
endif;

add_action('wp_enqueue_scripts', 'modestra_styles');

/**
 * Enqueue scripts for admin area
 */
function modestra_admin_style()
{
    $hello_notice_current_screen = get_current_screen();
    if (!empty($_GET['page']) && 'about-modestra' === $_GET['page'] || $hello_notice_current_screen->id === 'themes' || $hello_notice_current_screen->id === 'dashboard') {
        wp_enqueue_style('modestra-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), MODESTRA_VERSION, 'all');
        wp_enqueue_script('modestra-admin-scripts', get_template_directory_uri() . '/assets/js/modestra-admin-scripts.js', array(), MODESTRA_VERSION, true);
        wp_localize_script('modestra-admin-scripts', 'modestra_admin_localize', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('modestra_admin_nonce')
        ));
        wp_enqueue_script('modestra-welcome-notice', get_template_directory_uri() . '/inc/admin/js/modestra-welcome-notice.js', array('jquery'), MODESTRA_VERSION, true);
        wp_localize_script('modestra-welcome-notice', 'modestra_localize', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('modestra_welcome_nonce'),
            'redirect_url' => admin_url('themes.php?page=_cozy_companions')
        ));
    }
}
add_action('admin_enqueue_scripts', 'modestra_admin_style');

/**
 * Enqueue assets scripts for both backend and frontend
 */
function modestra_block_assets()
{
    wp_enqueue_style('modestra-blocks-style', get_template_directory_uri() . '/assets/css/blocks.css');
}
add_action('enqueue_block_assets', 'modestra_block_assets');

/**
 * Load core file.
 */
require_once get_template_directory() . '/inc/core/init.php';

/**
 * Load welcome page file.
 */
require_once get_template_directory() . '/inc/admin/welcome-notice.php';

if (!function_exists('modestra_excerpt_more_postfix')) {
    function modestra_excerpt_more_postfix($more)
    {
        if (is_admin()) {
            return $more;
        }
        return '...';
    }
    add_filter('excerpt_more', 'modestra_excerpt_more_postfix');
}
function modestra_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'modestra_add_woocommerce_support');

function register_project() {
  register_post_type('project', [
    'labels' => [
      'name'               => 'Projects',
      'singular_name'      => 'Project',
      'add_new'            => 'Add Project',
      'add_new_item'       => 'Add New Project',
      'edit_item'          => 'Edit Project',
      'new_item'           => 'New Project',
      'view_item'          => 'View Project',
      'view_items'         => 'View Projects',
      'search_items'       => 'Search Projects',
      'not_found'          => 'No Projects found',
      'not_found_in_trash' => 'No Projects found in Trash',
      'all_items'          => 'All Projects',
      'archives'           => 'Project Archives',
      'attributes'         => 'Project Attributes',
      'insert_into_item'   => 'Insert into project',
      'uploaded_to_this_item' => 'Uploaded to this project',
      'featured_image'     => 'Project Featured Image',
      'set_featured_image' => 'Set featured image',
      'remove_featured_image' => 'Remove featured image',
      'use_featured_image' => 'Use as featured image',
      'menu_name'          => 'Projects',
      'filter_items_list'  => 'Filter projects list',
      'items_list_navigation' => 'Projects list navigation',
      'items_list'         => 'Projects list',
      'name_admin_bar'     => 'Project',
    ],
    'public' => true,
    'has_archive' => true,
    'rewrite' => ['slug' => 'projects'],
    'supports' => ['title', 'editor', 'thumbnail'],
    'show_in_rest' => true,
    'menu_position' => 1,
    'menu_icon' => 'dashicons-portfolio',
    'show_in_menu' => true,
  ]);
}
add_action('init', 'register_project');

function create_project_cpt() {
    register_post_type('project',
        array(
            'labels' => array(
                'name' => __('Projects'),
                'singular_name' => __('Project')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'menu_icon' => 'dashicons-portfolio',
        )
    );
}
add_action('init', 'create_project_cpt');

add_action('add_meta_boxes', 'add_project_meta_box');
function add_project_meta_box() {
    add_meta_box('project_details', 'Project Details', 'project_meta_callback', 'project');
}

function project_meta_callback($post) {
    $client = get_post_meta($post->ID, 'client_name', true);
    echo '<label>Client Name:</label><br>';
    echo '<input type="text" name="client_name" value="' . esc_attr($client) . '" />';
}

add_action('save_post', 'save_project_meta');
function save_project_meta($post_id) {
    if (array_key_exists('client_name', $_POST)) {
        update_post_meta($post_id, 'client_name', sanitize_text_field($_POST['client_name']));
    }
}
register_block_pattern(
  'modestra/custom-intro',
  [
    'title'       => __('Custom Intro'),
    'description' => __('Intro section with custom content'),
    'content'     => file_get_contents( get_template_directory() . '/patterns/custom-intro.php' ),
  ]
);