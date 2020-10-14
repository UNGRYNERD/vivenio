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


function ungrynerd_svg($svg) {
  $output = '';
  if (empty($svg)) {
    return;
  }
  $svg_file_path = \get_template_directory() . "/dist/images/" . $svg . ".svg";
  return file_get_contents($svg_file_path);
}

add_action('wp_ajax_get_all_properties', __NAMESPACE__ . '\\ungrynerd_get_all_properties');
add_action('wp_ajax_nopriv_get_all_properties', __NAMESPACE__ . '\\ungrynerd_get_all_properties');
function ungrynerd_get_all_properties() {
  $filter = ungrynerd_get_filters();
  $cpt = isset($_REQUEST['cpt']) ? $_REQUEST['cpt'] : 'un_property';
  $props = new \WP_Query(array(
    'post_type' => $cpt,
    'posts_per_page' => -1,
    'meta_query' => $filter['meta_query'],
    'tax_query' => $filter['tax_query']
  ));
  while ($props->have_posts()) {
    $props->the_post();
    $geo = get_field('property_geo');
    if (get_post_type()=='un_local') {
      $text = 'Superficie construida: ' . get_field('local_area'). 'm2';
    } elseif (get_post_type()=='un_garage') {
      $text = get_field('property_price') . '€/mes';
    } else {
      $text = get_field('property_desc');
    }
    $properties[] = array(
                  'lat' => $geo['lat'],
                  'lng' => $geo['lng'],
                  'info' => preg_replace('/\v(?:[\v\h]+)/', '', '<artcile class="map-info">
                                '. get_the_post_thumbnail(get_the_ID(), 'info-map') .'
                                <div class="map-info__wrap">
                                  <h2 class="map-info__title">' . get_the_title() . '<br>' . get_field('property_location') . '</h2>
                                  <p class="map-info__address">' . $geo['address'] . '</p>
                                  <p class="map-info__text">' . $text . '</p>
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
    'name' => __('Promociones', 'vivenio'),
    'singular_name' => __('Promoción', 'vivenio'),
    'add_new' => __('Añadir Promoción', 'vivenio'),
    'add_new_item' => __('Añadir Promoción', 'vivenio'),
    'edit_item' => __('Editar Promoción', 'vivenio'),
    'new_item' => __('Nuevo Promoción', 'vivenio'),
    'view_item' => __('Ver Promociones', 'vivenio'),
    'search_items' => __('Buscar Promociones', 'vivenio'),
    'not_found' =>  __('No se han encontrado Promociones ', 'vivenio'),
    'not_found_in_trash' => __('No hay Promociones en la papelera', 'vivenio'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'show_in_nav_menus' => true,
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

/* PROMOCIONES POST TYPE */
add_action('init',  __NAMESPACE__ . '\ugnrynerd_local_post_type');
function ugnrynerd_local_post_type()  {
  $labels = array(
    'name' => __('Locales', 'vivenio'),
    'singular_name' => __('Local', 'vivenio'),
    'add_new' => __('Añadir Local', 'vivenio'),
    'add_new_item' => __('Añadir Local', 'vivenio'),
    'edit_item' => __('Editar Local', 'vivenio'),
    'new_item' => __('Nuevo Local', 'vivenio'),
    'view_item' => __('Ver locales', 'vivenio'),
    'search_items' => __('Buscar locales', 'vivenio'),
    'not_found' =>  __('No se han encontrado locales ', 'vivenio'),
    'not_found_in_trash' => __('No hay locales en la papelera', 'vivenio'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'show_in_nav_menus' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'menu_position' => 5,
    'rewrite' => array( 'slug' => 'locales' ),
    'taxonomies' => array('un_area'),
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail')
  );
  register_post_type('un_local',$args);
}

/* VIVIENDAS POST TYPE */
add_action('init',  __NAMESPACE__ . '\ugnrynerd_apartment_post_type');
function ugnrynerd_apartment_post_type()  {
  $labels = array(
    'name' => __('Viviendas', 'vivenio'),
    'singular_name' => __('Vivienda', 'vivenio'),
    'add_new' => __('Añadir Vivienda', 'vivenio'),
    'add_new_item' => __('Añadir Vivienda', 'vivenio'),
    'edit_item' => __('Editar Vivienda', 'vivenio'),
    'new_item' => __('Nuevo Vivienda', 'vivenio'),
    'view_item' => __('Ver Viviendas', 'vivenio'),
    'search_items' => __('Buscar Viviendas', 'vivenio'),
    'not_found' =>  __('No se han encontrado Viviendas ', 'vivenio'),
    'not_found_in_trash' => __('No hay Viviendas en la papelera', 'vivenio'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'show_in_nav_menus' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'menu_position' => 5,
    'rewrite' => array( 'slug' => 'viviendas' ),
    'taxonomies' => array(),
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail')
  );
  register_post_type('un_apartment',$args);
}

/* GARAJES POST TYPE */
add_action('init',  __NAMESPACE__ . '\ugnrynerd_garage_post_type');
function ugnrynerd_garage_post_type()  {
  $labels = array(
    'name' => __('Garajes', 'vivenio'),
    'singular_name' => __('Garaje', 'vivenio'),
    'add_new' => __('Añadir Garaje', 'vivenio'),
    'add_new_item' => __('Añadir Garaje', 'vivenio'),
    'edit_item' => __('Editar Garaje', 'vivenio'),
    'new_item' => __('Nuevo Garaje', 'vivenio'),
    'view_item' => __('Ver Garajes', 'vivenio'),
    'search_items' => __('Buscar Garajes', 'vivenio'),
    'not_found' =>  __('No se han encontrado Garajes ', 'vivenio'),
    'not_found_in_trash' => __('No hay Garajes en la papelera', 'vivenio'),
    'parent_item_colon' => ''
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'show_in_nav_menus' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'menu_position' => 5,
    'rewrite' => array( 'slug' => 'garajes' ),
    'taxonomies' => array('un_area', 'un_vehicle'),
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail')
  );
  register_post_type('un_garage',$args);
}

//TAXONOMIES
add_action( 'init', __NAMESPACE__ . '\ungrynerd_property_taxonomies', 0);
function ungrynerd_property_taxonomies() {
    register_taxonomy("un_area",
    array("un_property"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Zonas", 'vivenio'),
        "singular_label" => esc_html__( "Zona", 'vivenio'),
        "rewrite" => array( 'slug' => 'zona', 'hierarchical' => true),
        'show_in_nav_menus' => false,
        )
    );

    register_taxonomy("un_type",
    array("un_property"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Tipos", 'vivenio'),
        "singular_label" => esc_html__( "Tipo", 'vivenio'),
        "rewrite" => array( 'slug' => 'tipo', 'hierarchical' => true),
        'show_in_nav_menus' => false,
        )
    );

    register_taxonomy("un_vehicle",
    array("un_garage"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Vehículo", 'vivenio'),
        "singular_label" => esc_html__( "Vehículo", 'vivenio'),
        "rewrite" => array( 'slug' => 'vehiculo', 'hierarchical' => true),
        'show_in_nav_menus' => false,
        )
    );

    register_taxonomy("un_room",
    array("un_property"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Habitaciones", 'vivenio'),
        "singular_label" => esc_html__( "Habitación", 'vivenio'),
        "rewrite" => array( 'slug' => 'habitaciones', 'hierarchical' => false),
        'show_in_nav_menus' => false,
        )
    );

    register_taxonomy("un_feature",
    array("un_property"),
    array(
        "hierarchical" => true,
        "label" => esc_html__( "Características", 'vivenio'),
        "singular_label" => esc_html__( "Característica", 'vivenio'),
        "rewrite" => array( 'slug' => 'habitaciones', 'hierarchical' => false),
        'show_in_nav_menus' => false,
        )
    );
}

add_action('acf/init', __NAMESPACE__ . '\ungrynerd_acf_init');
function ungrynerd_acf_init() {
  acf_update_setting('google_api_key', 'AIzaSyDi3Nfc8OxZr_UE_X-o4RXyruymMY3aV2o');
}


add_filter('query_vars', __NAMESPACE__ . '\ungrynerd_add_query_vars');
function ungrynerd_add_query_vars($vars) {
  array_push($vars, 'rooms', 'area', 'types', 'features', 'price_min', 'price_max', 'area_min', 'area_max', 'vehicles', 'map');
  return $vars;
}


add_action('pre_get_posts', __NAMESPACE__ . '\ungrynerd_filter_query');
function ungrynerd_filter_query($query) {
  if ($query->is_main_query() && (is_post_type_archive('un_local') || is_post_type_archive('un_garage') || is_post_type_archive('un_property') || is_taxonomy('un_area'))) {
    $filter = ungrynerd_get_filters();
    $query->set('tax_query', $filter['tax_query']);
    $query->set('meta_query', $filter['meta_query']);
  }
  if ($query->is_main_query() && is_tax('un_area')) {
    $query->set('post_type', array('un_property'));
  }
}

function ungrynerd_get_filters() {
  $taxs = array(
            'area' => 'un_area',
            'un_area' => 'un_area',
            'rooms' => 'un_room',
            'types' => 'un_type',
            'vehicles' => 'un_vehicle',
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
        'terms' => $terms,
        'operator' => 'AND'
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
                      'key' => 'property_price_min',
                      'value' => intval($_REQUEST['price_max']),
                      'compare' => '<=',
                      'type' => 'NUMERIC'
                    );
  }
  if ($_REQUEST['area_min']) {
    $meta_query[] = array(
                      'key' => 'local_area',
                      'value' => intval($_REQUEST['area_min']),
                      'compare' => '>=',
                      'type' => 'NUMERIC'
                    );
  }
  if ($_REQUEST['area_max']) {
    $meta_query[] = array(
                      'key' => 'local_area',
                      'value' => intval($_REQUEST['area_max']),
                      'compare' => '<=',
                      'type' => 'NUMERIC'
                    );
  }

  return array('tax_query' => $tax_query, 'meta_query' => $meta_query);
}

add_action('init', __NAMESPACE__ . '\ungrynerd_add_rewrite', 10, 0);
function ungrynerd_add_rewrite() {
  add_rewrite_rule( '^promociones/mapa/?', 'index.php?post_type=un_property&map=1','top' );
  add_rewrite_rule( '^locales/mapa/?', 'index.php?post_type=un_local&map=1','top' );
  add_rewrite_rule( '^garajes/mapa/?', 'index.php?post_type=un_garage&map=1','top' );
}
