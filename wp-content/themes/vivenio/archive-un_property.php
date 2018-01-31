<?php use Roots\Sage\Extras; ?>
<section class="properties">
  <aside class="filters">
    <h2 class="filters__title"><?php esc_html_e('Filtros', 'ungrynerd'); ?></h2>
    <?php get_template_part('templates/filters') ?>
  </aside>
  <div class="prop-list">
    <h1 class="prop-list__title">Encuentra tú nueva casa de alquiler</h1>
    <div class="prop-list__text">
      <p>Creemos que una casa es mucho más que un lugar en el que vivir. <br>
      En Vivenio nuestro compromiso es ayudarte en todo lo que necesites para que crees tu hogar con nosotros. Abajo encontrarás un listado de nuestras fincas y a la izquierda puedes utilizar los filtros de búsqueda para encontrar la casa que mejor se adapte a tí.</p>
    </div>

    <?php if (have_posts()): ?>
      <?php if (!get_query_var('map')): ?>
        <?php get_template_part('templates/properties') ?>
      <?php else: ?>
        <section id="map"></section>
      <?php endif ?>
    <?php else : ?>
      <p><?php esc_html_e('No hay resultados para tus filtros', 'ungrynerd'); ?></p>
    <?php endif ?>
  </div>
</section>
