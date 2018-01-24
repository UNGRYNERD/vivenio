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
  $properties[] = array(
                  'lat' => 40.4577984,
                  'lng' => -3.4459560000000238,
                  'info' => preg_replace('/\v(?:[\v\h]+)/', '', '<artcile class="map-info">
                                <img width="1920" height="1080" src="//localhost:3000/wp-content/uploads/2018/01/breather-187923-300x260.jpg" class="attachment-slide size-slide" alt="">
                                <div class="map-info__wrap">
                                  <h2 class="map-info__title">Cerro de Valdecahonde<br>
                              Aravaca<br>
                              Madrid Capital</h2>
                                  <p class="map-info__address">Av. del Talgo, 155<br>
                              28023 Madrid</p>
                                  <p class="map-info__text">Viviendas de 1 y 2 dormitorios
                              Zonas comunes, garaje y piscina</p>
                                  <a class="button map-info__link" href="#" target="">Ver más</a>
                                </div>
                              </artcile>')
                );
  $properties[] = array(
                  'lat' => 40.49874,
                  'lng' => -3.8824899999999616,
                  'info' => preg_replace('/\v(?:[\v\h]+)/', '', '<artcile class="map-info">
                                <img width="1920" height="1080" src="//localhost:3000/wp-content/uploads/2018/01/breather-187923-300x260.jpg" class="attachment-slide size-slide" alt="">
                                <div class="map-info__wrap">
                                  <h2 class="map-info__title">Cerro de Valdecahonde<br>
                              Aravaca<br>
                              Madrid Capital</h2>
                                  <p class="map-info__address">Av. del Talgo, 155<br>
                              28023 Madrid</p>
                                  <p class="map-info__text">Viviendas de 1 y 2 dormitorios
                              Zonas comunes, garaje y piscina</p>
                                  <a class="button map-info__link" href="#" target="">Ver más</a>
                                </div>
                              </artcile>')
                );
  echo json_encode($properties);
  wp_die();
}
