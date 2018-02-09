<?php while (have_posts()) : the_post(); ?>
  <section class="single-page">
    <div class="single-page__content">
      <h1 class="single-page__title"><?php the_title(); ?></h1>
      <div class="single-page__text">
        <?php the_content(); ?>
      </div>
    </div>
    <?php the_post_thumbnail('page', array('class' => 'single-page__image')) ?>
  </section>
<?php endwhile; ?>
