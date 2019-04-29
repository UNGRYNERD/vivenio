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
        <div class="dropdown" data-go="true">
          <span class="dropdown__value"><?php esc_html_e('Elige tu zona', 'vivenio'); ?></span>
          <ul class="dropdown__options">
            <?php $areas = get_terms('un_area', array('hide_empty' => 0, 'parent' => 0)); ?>
            <?php foreach ($areas as $area): ?>
              <li class="parent"><a href="<?= get_term_link($area, 'un_area') ?>"><?= $area->name; ?></a></li>
              <li><a href="<?= get_term_link($area, 'un_area') ?>"><?php esc_html_e('Todo', 'vivenio'); ?> <?= $area->name; ?></a></li>
              <?php $child_areas = get_terms('un_area', array('hide_empty' => 0, 'parent' => $area->term_id)); ?>
              <?php foreach ($child_areas as $child_area): ?>
                <li><a href="<?= get_term_link($child_area, 'un_area') ?>"><?= $child_area->name; ?></a></li>
              <?php endforeach ?>
            <?php endforeach ?>
          </ul>
        </div>
        <p class="slides__slide__footer"><?php the_field('slide_footer'); ?></p>
      </div>
    </artcile>
  <?php endwhile; ?>
  </section>
<?php endif; ?>
