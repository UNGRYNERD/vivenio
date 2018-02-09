<?php use Roots\Sage\Assets; ?>
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

<a href="#" class="write-us"><img src="<?= Assets\asset_path('images/icon-mail.png') ?>" alt="Escríbenos"> Escríbenos</a>
<div class="popup">
  <div class="popup__content">
    <img src="<?= Assets\asset_path('images/icon-vivenio.png') ?>" alt="Vivenio">
    <h2 class="prefooter__title"><?php esc_html_e('Estaremos encantados de ayudarte.', 'ungrynerd'); ?></h2>
    <?= do_shortcode(get_field('footer_contact', get_option('page_on_front'))); ?>
    <a href="#" class="popup__close"><?php esc_html_e('Cerrar', 'ungrynerd'); ?></a>
  </div>
</div>
