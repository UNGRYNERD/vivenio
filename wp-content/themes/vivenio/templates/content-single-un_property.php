<?php use Roots\Sage\Extras ?>

<?php while (have_posts()) : the_post(); ?>
  <?php $address = get_field('property_geo') ?>
  <article class="property" data-lat="<?= $address['lat'] ?>" data-lng="<?= $address['lng'] ?>">
    <div class="property__intro" style="background-image: url(<?php the_post_thumbnail_url('slide'); ?>)">
      <div class="property__intro__wrapper">
        <h1 class="property__title"><?php the_title() ?></h1>
        <h3 class="property__location"><?php the_field('property_location') ?></h3>
        <div class="property__text"><?php the_field('property_text'); ?></div>
        <a href="<?= get_post_type_archive_link('un_property') ?>" class="property__goback"><?= Extras\ungrynerd_svg('icon-back'); ?><?php esc_html_e('Volver al listado', 'ungrynerd'); ?></a>
        <a href="#viviendas" class="button button--active"><?php esc_html_e('Ver Viviendas', 'ungrynerd'); ?></a>
      </div>
    </div>
    <div class="property__wrapper">
      <aside class="property__info">
        <h1 class="property__info__title"><?php the_title() ?></h1>
        <h3 class="property__info__location"><?php the_field('property_location') ?></h3>
        <div class="property__info__features">
          <h3 class="property__info__features__title"><?php esc_html_e('Características', 'ungrynerd'); ?></h3>
          <?php the_field('property_features') ?>
        </div>
      </aside>
      <div class="property__data">
        <?php the_content(); ?>
        <?php $images = get_field('property_photos'); ?>
        <?php if ( $images ): ?>
          <ul class="property__gallery" >
            <?php foreach( $images as $image ): ?>
              <li class="property__gallery__item">
                <a href="<?=  wp_get_attachment_image_url($image['ID'], 'full'); ?>"><?php echo wp_get_attachment_image($image['ID'], 'gallery' ); ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <div class="apartaments">
          <h2 class="apartaments__title">
            <?php esc_html_e('Viviendas disponibles en', 'ungrynerd'); ?> <span><?php the_title(); ?></span>
          </h2>
          <h3 class="apartaments__title apartaments__title--subtitle">
            Encuentra la casa que mejor se adapte a tí.
          </h3>
          <?php $property_id = get_the_ID(); ?>
          <?php $apartments = new WP_Query(array(
              'post_type'   => 'un_apartment',
              'posts_per_page'  => -1,
              'meta_query'    => array(
                array(
                  'key' => 'property',
                  'value' => $property_id,
                  'compare' => 'IN'
                  )
                )
              )); ?>
          <?php while( $apartments->have_posts() ) : $apartments->the_post(); ?>
            <article class="apartaments__apartment">
              <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('info-map'); ?></a>
              <div class="apartaments__apartment__info">
                <?php $address = get_field('property_geo', $property_id) ?>
                <h2 class="apartaments__apartment__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
                <h3 class="apartaments__apartment__location"><?php the_field('property_location', $property_id) ?></h3>
                <h4 class="apartaments__apartment__address"><?= $address['address']; ?></h4>
                <h4 class="apartaments__apartment__desc"><?php the_field('property_desc', $property_id) ?></h4>
                <p class="apartaments__apartment__price">desde <span><?php the_field('property_price') ?></span>€/mes</p>
              </div>
            </article>
          <?php endwhile; ?>
          <?php wp_reset_query(); ?>
        </div>
      </div>
      <aside class="property__contact">
        <div class="property__contact__wrapper">
          <h3 class="property__contact__title"><?php esc_html_e('¿Te interesa esta vivienda?', 'ungrynerd'); ?> <span><?php esc_html_e('Contacta con el asesor', 'ungrynerd'); ?></span></h3>
          <?= do_shortcode('[contact-form-7 id="92" title="Contacto vivendas"]') ?>
          <h3 class="property__contact__title property__contact__title--subtitle"><?php esc_html_e('Si lo prefieres puedes también llamarnos al', 'ungrynerd'); ?> <span><?php esc_html_e('T. (+34) 91 128 72 97', 'ungrynerd'); ?></span></h3>

        </div>
      </aside>
    </div>
  </article>
  <section id="map-single"></section>

<?php endwhile; ?>
