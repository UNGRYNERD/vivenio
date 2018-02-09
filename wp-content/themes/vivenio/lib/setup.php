<?php

namespace Roots\Sage\Setup;

use Roots\Sage\Assets;

/**
 * Theme setup
 */
function setup() {
  // Enable features from Soil when plugin is activated
  // https://roots.io/plugins/soil/
  add_theme_support('soil-clean-up');
  add_theme_support('soil-nav-walker');
  add_theme_support('soil-nice-search');
  add_theme_support('soil-jquery-cdn');
  add_theme_support('soil-relative-urls');

  // Make theme available for translation
  // Community translations can be found at https://github.com/roots/sage-translations
  load_theme_textdomain('sage', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');
  add_theme_support('custom-logo');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation' => __('Menu principal', 'sage'),
    'footer_navigation' => __('Menu footer', 'sage')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  add_image_size('slide', 1920, 1080, true);
  add_image_size('info-map', 300, 260, true);
  add_image_size('listing', 430, 270, true);
  add_image_size('gallery', 600, 9999, false);
  add_image_size('page', 1920, 9999, false);




  // Enable post formats
  // http://codex.wordpress.org/Post_Formats

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');


/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template('template-custom.php'),
  ]);

  return apply_filters('sage/display_sidebar', $display);
}

/**
 * Theme assets
 */
function assets() {

  wp_enqueue_style('vivenio/fonts', '//fonts.googleapis.com/css?family=Poppins:400,500,600,700', false, null );

  wp_enqueue_style('vivenio/css', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
  wp_enqueue_script('google-maps', '//maps.google.com/maps/api/js?key=AIzaSyDi3Nfc8OxZr_UE_X-o4RXyruymMY3aV2o&#038;libraries=places&#038;language=es', ['jquery'], null, true);
  wp_enqueue_script('owl.carousel', Assets\asset_path('scripts/owl.carousel.js'), ['jquery'], null, true);
  wp_enqueue_script('featherlight', Assets\asset_path('scripts/featherlight.js'), ['jquery'], null, true);
  wp_register_script('vivenio/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
  $ungrynerd = array(
                      'ajaxurl' => admin_url('admin-ajax.php'),
                      'path' => get_stylesheet_directory_uri()
                    );
  wp_localize_script('vivenio/js', 'ungrynerd', $ungrynerd);
  wp_enqueue_script('vivenio/js');

}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
