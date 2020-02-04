<?php
/**
 * Template Name: Contacto
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <section class="single-page">
    <div class="single-page__content">
      <h1 class="single-page__title"><?php the_title(); ?></h1>
      <div class="single-page__text">
        <?php the_content(); ?>
        <div class="contacts">
          <?php while (have_rows('contact_form')) : the_row(); ?>
            <div class="contacts__contact">
              <h3 class="contacts__title"><?php the_sub_field('area') ?></h3>
              <div class="contacts__text"><?php the_sub_field('text') ?></div>
              <span class="contacts__phone"><?php the_sub_field('phone') ?></span>
              <span class="contacts__email"><?php the_sub_field('email') ?></span>
              <a href="#" class="contacts__button button js-btn-forms"><?php esc_html_e('Click Aquí', 'vivenio'); ?></a>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <?php $address = get_field('address') ?>
    <section id="contact-map" data-lat="<?= $address['lat'] ?>" data-lng="<?= $address['lng'] ?>"></section>
  </section>
<?php endwhile; ?>
