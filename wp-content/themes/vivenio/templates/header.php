<header class="header">
  <div class="header__wrapper">
    <?php if (has_custom_logo()): ?>
      <?php $altlogo = get_theme_mod('alt_logo'); ?>
      <?php if (!empty($altlogo)) : ?>
        <a href="<?= esc_url(home_url('/')); ?>" class="custom-logo-link custom-logo-link--alt"><img src="<?= esc_url($altlogo) ?>"></a>
      <?php endif; ?>
      <?php the_custom_logo(); ?>
    <?php else: ?>
      <a class="header__site-name" href="<?= esc_url(home_url('/')); ?>">
        <?php bloginfo('name'); ?>
      </a>
    <?php endif ?>
    <?php
    if (has_nav_menu('primary_navigation')) :
      wp_nav_menu([
        'theme_location' => 'primary_navigation',
        'container' => 'nav',
        'container_class' => '',
        'menu_class' => 'header__menu']);
    endif;
    ?>
  </div>
</header>
