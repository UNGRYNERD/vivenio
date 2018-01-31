<?php while(have_posts()) : the_post(); ?>
  <article class="prop-list__property">
    <?php the_post_thumbnail('listing'); ?>
    <div class="prop-list__property__info">
      <?php $address = get_field('property_geo') ?>
      <h2 class="prop-list__property__title"><?php the_title() ?></h2>
      <h3 class="prop-list__property__location"><?php the_field('property_location') ?></h3>
      <h4 class="prop-list__property__address"><?= $address['address']; ?></h4>
      <h4 class="prop-list__property__desc"><?php the_field('property_desc') ?></h4>
    </div>
  </article>
<?php endwhile; ?>
