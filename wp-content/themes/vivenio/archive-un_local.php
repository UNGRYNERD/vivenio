<?php use Roots\Sage\Extras; ?>
<section class="properties">
  <aside class="filters">
    <a href="#" class="filters__toggle">Filtros</a>
    <h2 class="filters__title"><?php esc_html_e('Filtros', 'ungrynerd'); ?></h2>
    <?php get_template_part('templates/filters', 'local') ?>
  </aside>
  <div class="prop-list">
    <div class="prop-list__wrapper">
      <h1 class="prop-list__title"><?php esc_html_e('Locales', 'ungrynerd'); ?></h1>
      <div class="prop-list__text">
      </div>
      <div class="prop-list__options">
        <a href="<?= get_post_type_archive_link('un_local') ?>"><?= Extras\ungrynerd_svg('icon-listing') ?>Listado</a>
        <a href="<?= get_post_type_archive_link('un_local') ?>mapa/"><?= Extras\ungrynerd_svg('icon-marker') ?>Mapa</a>
      </div>
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