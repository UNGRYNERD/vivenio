<?php use Roots\Sage\Extras; ?>
<?php if (have_rows('featured_slide')) : ?>
  <section class="featured">
    <div class="container">
      <header class="featured__titles">
        <h2 class="featured__title"><?php the_field('featured_title'); ?></h2>
        <div class="featured__text"><?php the_field('featured_text'); ?></div>
      </header>
      <div class="featured__slides owl-carousel">
        <?php while (have_rows('featured_slide')): the_row(); ?>
          <artcile class="featured__slide">
            <?= wp_get_attachment_image(get_sub_field('featured_img'), 'slide') ?>
            <div class="featured__slide__wrap">
              <h2 class="featured__slide__title"><?php the_sub_field('featured_title'); ?></h2>
              <p class="featured__slide__address"><?php the_sub_field('featured_address'); ?></p>
              <p class="featured__slide__text"><?php the_sub_field('featured_text'); ?></p>
              <?php $link = get_sub_field('featured_link'); ?>
              <a class="button featured__slide__link" href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?php esc_html_e('Ver más', 'ungrynerd'); ?></a>
            </div>
          </artcile>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
