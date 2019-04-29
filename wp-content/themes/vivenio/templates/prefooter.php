<section class="prefooter">
  <div class="prefooter__text">
    <?php the_field('footer_text', get_option('page_on_front')); ?>
    <p class="renta"><a href="http://rentacorporacion.com/es/" target="_blank"><?php esc_html_e('Gestionado por Renta Corporación', 'vivenio'); ?></a></p>
  </div>
  <div class="prefooter__contact">
    <h2 class="prefooter__title"><?php esc_html_e('Estaremos encantados de ayudarte.', 'vivenio'); ?></h2>
    <?= do_shortcode(get_field('footer_contact', get_option('page_on_front'))); ?>
  </div>
</section>
