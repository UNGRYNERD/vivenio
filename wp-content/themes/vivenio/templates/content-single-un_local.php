<?php use Roots\Sage\Extras ?>

<?php while (have_posts()) : the_post(); ?>
  <?php $address = get_field('property_geo') ?>
  <article class="property property--apartment" data-lat="<?= $address['lat'] ?>" data-lng="<?= $address['lng'] ?>">
    <div class="property__wrapper">
      <h1 class="property__title"><?php the_title() ?></h1>

      <aside class="property__info">
        <p class="property__info__price">desde <?php the_field('property_price_min') ?>€/mes</p>
        <h3 class="property__info__location">
          <strong><?php the_title(); ?></strong> <br>
          <?php the_field('property_location') ?> <br>
          <?= $address['address'] ?>
        </h3>
        <div class="property__info__apartment">
          <?php the_field('property_features') ?>
        </div>
        <a href="<?= get_post_type_archive_link('un_local') ?>" class="button"><?php esc_html_e('Volver al listado', 'vivenio'); ?></a>
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
      </div>
      <aside class="property__contact">
        <div class="property__contact__wrapper">
          <h3 class="property__contact__title"><?php esc_html_e('¿Te interesa esta vivienda?', 'vivenio'); ?> <span><?php esc_html_e('Contacta con el asesor', 'vivenio'); ?></span></h3>
          <?php if (ICL_LANGUAGE_CODE=='es'): ?>
            <?= do_shortcode('[contact-form-7 id="92" title="Contacto vivendas"]') ?>
          <?php else : ?>
            <?= do_shortcode('[contact-form-7 id="1643" title="Contacto vivendas"]') ?>
          <?php endif; ?>
          <h3 class="property__contact__title property__contact__title--subtitle"><?php esc_html_e('Si lo prefieres puedes también llamarnos al', 'vivenio'); ?> <span><?php esc_html_e('(+34) 91 128 72 97', 'vivenio'); ?></span></h3>

        </div>
      </aside>
    </div>
  </article>
  <section id="map-single"></section>

<?php endwhile; ?>
