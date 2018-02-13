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
      </div>
    </div>
    <?php $address = get_field('address') ?>
    <section id="contact-map" data-lat="<?= $address['lat'] ?>" data-lng="<?= $address['lng'] ?>"></section>
  </section>
<?php endwhile; ?>
