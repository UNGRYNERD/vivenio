<?php use Roots\Sage\Extras; ?>
<?php if (have_rows('slide_slides')) : ?>
  <section class="slides owl-carousel">
  <?php while (have_rows('slide_slides')): the_row(); ?>
    <?php
      $image = wp_get_attachment_image_src(get_sub_field('slide_img'), 'slide');
      $video = get_sub_field('slide_video');
    ?>
    <artcile class="slides__slide" style="background-image: url(<?php echo $image[0]; ?>)">
      <?php if ($video): ?>
        <video src="<?= wp_get_attachment_url($video) ?>"></video>
      <?php endif ?>
      <div class="slides__slide__wrap">
        <h2 class="slides__slide__title"><?php the_sub_field('slide_title'); ?></h2>
        <p class="slides__slide__text"><?php the_sub_field('slide_text'); ?></p>
        <div class="dropdown">
          <span class="dropdown__value">Elige tu zona</span>
          <ul class="dropdown__options">
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem ipsum dolor sit</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Super super Lorem ipsum dolor sit</a></li>
            <li><a href="#">Lorem ipsum</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem</a></li>
            <li><a href="#">Lorem</a></li>
          </ul>
        </div>
        <p class="slides__slide__footer"><?php the_field('slide_footer'); ?></p>
      </div>
    </artcile>
  <?php endwhile; ?>
  </section>
<?php endif; ?>
