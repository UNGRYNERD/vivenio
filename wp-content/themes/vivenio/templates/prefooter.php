<section class="prefooter">
  <div class="prefooter__text">
    <?php the_field('footer_text'); ?>
    <p class="renta"><a href="http://rentacorporacion.com/es/" target="_blank"><?php esc_html_e('Con el respaldo de Renta Corporación', 'ungrynerd'); ?></a></p>
  </div>
  <div class="prefooter__contact">
    <h2 class="prefooter__title"><?php esc_html_e('Estaremos encantados de ayudarte.', 'ungrynerd'); ?></h2>
    <?= do_shortcode(get_field('footer_contact')); ?>
  </div>
</section>
