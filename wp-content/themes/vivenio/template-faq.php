<?php
/**
 * Template Name: FAQ
 */
?>
<?php while (have_posts()) : the_post(); ?>
  <section class="single-page">
    <div class="single-page__content">
      <h1 class="single-page__title"><?php the_title(); ?></h1>
      <div class="single-page__text">
        <?php the_content(); ?>
        <ol class="questions">
          <?php while (have_rows('questions')): the_row(); ?>
            <li class="questions__question"><a href="#<?= sanitize_title(get_sub_field('question')) ?>"><?php the_sub_field('question') ?></a></li>
          <?php endwhile; ?>
        </ol>
        <?php $i=0; ?>
        <?php while (have_rows('questions')): the_row(); ?>
          <article class="question">
            <?php $i++; ?>
            <h2 id="<?= sanitize_title(get_sub_field('question')) ?>" class="question__title"><?= $i ?>. <?php the_sub_field('question') ?></h2>
            <?php the_sub_field('answer'); ?>
          </article>
        <?php endwhile; ?>
      </div>
    </div>
    <?php the_post_thumbnail('page', array('class' => 'single-page__image')) ?>
  </section>
<?php endwhile; ?>
