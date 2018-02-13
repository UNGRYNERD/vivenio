<?php
/**
 * Template Name: Multiples páginas
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <section class="single-page">
    <?php while (have_rows('pages')): the_row(); ?>
      <div class="single-page__content">
        <h1 class="single-page__title"><?php the_sub_field('title'); ?></h1>
        <div class="single-page__text">
          <?php the_sub_field('content'); ?>
        </div>
      </div>
    <?php endwhile; ?>

    <?php the_post_thumbnail('page', array('class' => 'single-page__image')) ?>
  </section>
<?php endwhile; ?>
