<?php use Roots\Sage\Assets; ?>
<?php get_template_part('templates/prefooter', 'home') ?>

<footer class="footer">
  <div class="container">
    <p class="copy">&copy;<?= Date('Y') ?> <?php esc_html_e('Todos los derechos reservados por Vivenio', 'vivenio'); ?></p>
    <?php
    if (has_nav_menu('footer_navigation')) :
      wp_nav_menu([
        'theme_location' => 'footer_navigation',
        'container' => 'nav',
        'container_class' => '',
        'menu_class' => 'footer__menu']);
    endif;
    ?>
  </div>
</footer>

<div class="popup">
  <div class="popup__content">
    <h3 class="popup__pretitle js-popup-pretitle">Nombre de area</h3>
    <h2 class="prefooter__title"><?php esc_html_e('Puedes llamarnos al', 'ungrynerd'); ?> <span class="js-popup-phone popup__phone">666666666</span> <br><?php esc_html_e('o escribirnos un mensaje en este formulario', 'ungrynerd'); ?></h2>
    <?= do_shortcode(get_field('form', 'option')); ?>
    <a href="#" class="popup__close"><?php esc_html_e('Cerrar', 'ungrynerd'); ?></a>
  </div>
</div>
