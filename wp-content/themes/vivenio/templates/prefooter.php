<section class="prefooter">
  <div class="prefooter__text"><?php the_field('footer_text'); ?></div>
  <div class="prefooter__contact"><?= do_shortcode(get_field('footer_contact')); ?></div>
</section>
