<?php
/**
 * Template Name: Pasos
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
    <div class="steps" style="background-image: url(<?php the_post_thumbnail_url('page') ?>)">
      <div class="container">
        <div class="steps__wrapper">
          <h2 class="steps__title"><?php esc_html_e('Alquilando con nosotros', 'ungrynerd'); ?></h2>
          <h3 class="steps__step">
            <span class="steps__step__number">01</span>
            <?php the_field('step1') ?>
          </h3>
          <h3 class="steps__step">
            <span class="steps__step__number">02</span>
            <?php the_field('step2') ?>
          </h3>
          <h3 class="steps__step">
            <span class="steps__step__number">03</span>
            <?php the_field('step3') ?>
          </h3>
          <h3 class="steps__step">
            <span class="steps__step__number">04</span>
            <?php the_field('step4') ?>
          </h3>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; ?>
