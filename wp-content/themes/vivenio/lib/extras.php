<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }
  if (is_front_page()) {
    $classes[] = 'alt-header';
  }
  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


add_action('wp_ajax_get_all_properties', __NAMESPACE__ . '\\ungrynerd_get_all_properties');
add_action('wp_ajax_nopriv_get_all_properties', __NAMESPACE__ . '\\ungrynerd_get_all_properties');

function ungrynerd_get_all_properties() {
  $filter = ungrynerd_get_filters();
  $props = new \WP_Query(array(
    'post_type' => 'un_property',
    'posts_per_page' => -1,
    'meta_query' => $filter['meta_query'],
    'tax_query' => $filter['tax_query']
  ));
  while ($props->have_posts()) {
    $props->the_post();
    $geo = get_field('property_geo');
    $properties[] = array(
                  'lat' => $geo['lat'],
                  'lng' => $geo['lng'],
                  'info' => preg_replace('/\v(?:[\v\h]+)/', '', '<artcile class="map-info">
                                '. get_the_post_thumbnail(get_the_ID(), 'info-map') .'
                                <div class="map-info__wrap">
                                  <h2 class="map-info__title">' . get_the_title() . '<br>' . get_field('property_location') . '</h2>
                                  <p class="map-info__address">' . $geo['address'] . '</p>
                                  <p class="map-info__text">' . get_field('property_desc') . '</p>
                                  <a class="button map-info__link" href="' . get_permalink() . '" target="">Ver más</a>
                                </div>
                              </artcile>')
                );
  }
  echo json_encode($properties);
  wp_die();
}


/* PROMOCIONES POST TYPE */
add_action('init',  __NAMESPACE__ . '\ugnrynerd_property_post_type');
function ugnrynerd_property_post_type()  {
  $labels = array(
    'name' => __('Promociones', 'ungrynerd'),
    'singular_name' => __('Promoción', 'ungrynerd'),
    'add_new' => __('Añadir Promoción', 'ungrynerd'),
    'add_new_item' => __('Añadir Promoción', 'ungrynerd'),
    'edit_item' => __('Editar Promoción', 'ungrynerd'),
    'new_item' => __('Nuevo Promoción', 'ungrynerd'),
    'view_item' => __('Ver Promociones', 'ungrynerd'),
    'search_items' => __('Buscar Promociones', 'ungrynerd'),
    'not_found' =>  __('No se han encontrado Promociones ', 'ungrynerd'),
    'not_found_in_trash' => __('No hay Promociones en la papelera', 'ungrynerd'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'show_in_nav_menus' => false,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'menu_position' => 5,
    'rewrite' => array( 'slug' => 'promociones' ),
    'taxonomies' => array('un_area', 'un_type', 'un_room', 'un_feature'),
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail')
  );
  register_post_type('un_property',$args);
}

/* VIVIENDAS POST TYPE */
add_action('init',  __NAMESPACE__ . '\ugnrynerd_aparment_post_type');
function ugnrynerd_aparment_post_type()  {
  $labels = array(
    'name' => __('Viviendas', 'ungrynerd'),
    'singular_name' => __('Vivienda', 'ungrynerd'),
    'add_new' => __('Añadir Vivienda', 'ungrynerd'),
    'add_new_item' => __('Añadir Vivienda', 'ungrynerd'),
    'edit_item' => __('Editar Vivienda', 'ungrynerd'),
    'new_item' => __('Nuevo Vivienda', 'ungrynerd'),
    'view_item' => __('Ver Viviendas', 'ungrynerd'),
    'search_items' => __('Buscar Viviendas', 'ungrynerd'),
    'not_found' =>  __('No se han encontrado Viviendas ', 'ungrynerd'),
    'not_found_in_trash' => __('No hay Viviendas en la papelera', 'ungrynerd'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'show_in_nav_menus' => false,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'menu_position' => 5,
    'rewrite' => array( 'slug' => 'viviendas' ),
    'taxonomies' => array(),
    'has_archive' => true,
    'supports' => array('title', 'editor')
  );
  register_post_type('un_arparment',$args);
}

//TAXONOMIES
function ungrynerd_property_taxonomies() {
    register_taxonomy("un_area",
    array("un_property"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Zonas", 'ungrynerd'),
        "singular_label" => esc_html__( "Zona", 'ungrynerd'),
        "rewrite" => array( 'slug' => 'zona', 'hierarchical' => true),
        'show_in_nav_menus' => false,
        )
    );

    register_taxonomy("un_type",
    array("un_property"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Tipos", 'ungrynerd'),
        "singular_label" => esc_html__( "Tipo", 'ungrynerd'),
        "rewrite" => array( 'slug' => 'tipo', 'hierarchical' => true),
        'show_in_nav_menus' => false,
        )
    );

    register_taxonomy("un_room",
    array("un_property"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Habitaciones", 'ungrynerd'),
        "singular_label" => esc_html__( "Habitación", 'ungrynerd'),
        "rewrite" => array( 'slug' => 'habitaciones', 'hierarchical' => false),
        'show_in_nav_menus' => false,
        )
    );

    register_taxonomy("un_feature",
    array("un_property"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Características", 'ungrynerd'),
        "singular_label" => esc_html__( "Característica", 'ungrynerd'),
        "rewrite" => array( 'slug' => 'habitaciones', 'hierarchical' => false),
        'show_in_nav_menus' => false,
        )
    );
}
add_action( 'init', __NAMESPACE__ . '\ungrynerd_property_taxonomies', 0);


function ungrynerd_acf_init() {
  acf_update_setting('google_api_key', 'AIzaSyDi3Nfc8OxZr_UE_X-o4RXyruymMY3aV2o');
}
add_action('acf/init', __NAMESPACE__ . '\ungrynerd_acf_init');


add_filter('query_vars', __NAMESPACE__ . '\ungrynerd_add_query_vars');
function ungrynerd_add_query_vars($vars) {
  array_push($vars, 'rooms', 'area', 'types', 'features', 'price_min', 'price_max', 'map');
  return $vars;
}


add_action('pre_get_posts', __NAMESPACE__ . '\ungrynerd_filter_query');
function ungrynerd_filter_query($query) {
  if ($query->is_main_query() && is_post_type_archive('un_property')) {
    $filter = ungrynerd_get_filters();
    $query->set( 'tax_query', $filter['tax_query']);
    $query->set( 'meta_query', $filter['meta_query']);
  }
}

function ungrynerd_get_filters() {
  $taxs = array(
            'area' => 'un_area',
            'rooms' => 'un_room',
            'types' => 'un_type',
            'features' => 'un_feature'
          );
  $tax_query = array();
  $meta_query = array();

  foreach ($taxs as $var => $tax) {
    $terms = $_REQUEST[$var];
    if (!empty($terms)) {
      $tax_query[] = array(
        'taxonomy' => $tax,
        'field' => 'slug',
        'terms' => $terms
      );
    }
  }
  if ($_REQUEST['price_min']) {
    $meta_query[] = array(
                      'key' => 'property_price_min',
                      'value' => intval($_REQUEST['price_min']),
                      'compare' => '>=',
                      'type' => 'NUMERIC'
                    );
  }
  if ($_REQUEST['price_max']) {
    $meta_query[] = array(
                      'key' => 'property_price_max',
                      'value' => intval($_REQUEST['price_max']),
                      'compare' => '<=',
                      'type' => 'NUMERIC'
                    );
  }

  return array('tax_query' => $tax_query, 'meta_query' => $meta_query);
}

add_action('init', __NAMESPACE__ . '\ungrynerd_add_rewrite', 10, 0);
function ungrynerd_add_rewrite() {
  add_rewrite_rule( '^promociones/mapa/?', 'index.php?post_type=un_property&map=1','top' );
}
