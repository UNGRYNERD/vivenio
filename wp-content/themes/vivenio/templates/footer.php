<?php get_template_part('templates/prefooter', 'home') ?>

<footer class="footer">
  <div class="container">
    <p class="copy">&copy;<?= Date('Y') ?> <?php esc_html_e('Todos los derechos reservados por Vivenio', 'ungrynerd'); ?></p>
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
