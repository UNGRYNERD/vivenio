<?php while(have_posts()) : the_post(); ?>
  <article class="prop-list__property">
    <div class="prop-list__wrapper">
      <a class="prop-list__property__img" href="<?php the_permalink() ?>"><?php the_post_thumbnail('listing'); ?></a>
      <div class="prop-list__property__info">
        <?php $address = get_field('property_geo') ?>
        <h2 class="prop-list__property__title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
        <h3 class="prop-list__property__location"><?php the_field('property_location') ?></h3>
        <h4 class="prop-list__property__address"><?= $address['address']; ?></h4>
        <h4 class="prop-list__property__desc"><?php the_field('property_desc') ?></h4>
      </div>
    </div>
  </article>
<?php endwhile; ?>
