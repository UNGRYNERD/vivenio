<?php while(have_posts()) : the_post(); ?>
  <article class="prop-list__property">
    <div class="prop-list__wrapper">
      <a class="prop-list__property__img" href="<?php the_permalink() ?>"><?php the_post_thumbnail('listing'); ?></a>
      <div class="prop-list__property__info">
        <?php $address = get_field('property_geo') ?>
        <h2 class="prop-list__property__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <h3 class="prop-list__property__location"><?php the_field('property_location') ?></h3>
        <h4 class="prop-list__property__address"><?= $address['address']; ?></h4>
        <?php if (get_post_type() == 'un_local') : ?>
          <h4 class="prop-list__property__desc">Superficie construida: <?php the_field('local_area_min') ?> m2</h4>
        <?php elseif (get_post_type() == 'un_garage') : ?>
          <h4 class="prop-list__property__desc"><?php the_field('property_price_min') ?><?php esc_html_e('€/mes', 'ungrynerd'); ?></h4>
        <?php else : ?>
          <h4 class="prop-list__property__desc"><?php the_field('property_desc') ?></h4>
        <?php endif; ?>
      </div>
    </div>
  </article>
<?php endwhile; ?>
