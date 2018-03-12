<form action="<?= get_post_type_archive_link('un_local') ?>" method="post">
  <input type="hidden" name="cpt" value="<?= $wp_query->query['post_type']; ?>">
  <div class="filters__field">
    <p class="filters__field__title"><?php esc_html_e('Elige tu zona', 'ungrynerd'); ?></p>
    <?php $areas = get_terms('un_area', array('hide_empty' => 0, 'parent' => 0)); ?>
    <div class="dropdown" data-target="#area">
      <?php if (get_query_var('area')) : ?>
        <?php $queried_area = get_term_by('slug', get_query_var('area'), 'un_area') ?>
      <?php else: ?>
        <?php $queried_area = get_term_by('slug', get_query_var('un_area') , 'un_area') ?>
      <?php endif; ?>
      <span class="dropdown__value"><?= $queried_area ? $queried_area->name : esc_html__('Elige tu zona', 'ungrynerd'); ?></span>
      <ul class="dropdown__options">
        <?php foreach ($areas as $area): ?>
          <li class="parent"><a href="#" data-value="<?= $area->slug ?>"><?= $area->name; ?></a></li>
          <li><a href="#" data-value="<?= $area->slug ?>">Todo <?= $area->name; ?></a></li>
          <?php $child_areas = get_terms('un_area', array('hide_empty' => 0, 'parent' => $area->term_id)); ?>
          <?php foreach ($child_areas as $child_area): ?>
            <li><a href="#" data-value="<?= $child_area->slug ?>"><?= $child_area->name; ?></a></li>
          <?php endforeach ?>
        <?php endforeach ?>
      </ul>
    </div>
    <input type="hidden" value="<?= $queried_area ? $queried_area->slug : ''; ?>" id="area" name="area">
  </div>
  <div class="filters__field filters__field--price">
    <p class="filters__field__title"><?php esc_html_e('Precio', 'ungrynerd'); ?></p>
    <div class="dropdown" data-target="#price_min">
      <span class="dropdown__value"><?= get_query_var('price_min') ? get_query_var('price_min') : esc_html__('Min.', 'ungrynerd'); ?></span>
      <ul class="dropdown__options">
        <li><a href="#" data-value="400">400</a></li>
        <li><a href="#" data-value="600">600</a></li>
        <li><a href="#" data-value="800">800</a></li>
        <li><a href="#" data-value="1000">1000</a></li>
        <li><a href="#" data-value="1200">1200</a></li>
        <li><a href="#" data-value="1400">1400</a></li>
        <li><a href="#" data-value="1800">1800</a></li>
        <li><a href="#" data-value="2200">2200</a></li>
        <li><a href="#" data-value="3000">3000</a></li>
        <li class="input">
          <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'ungrynerd'); ?>">
          <a href="#" class="button button--active"><?php esc_html_e('Ok', 'ungrynerd'); ?></a>
        </li>
      </ul>
    </div>
    <input type="hidden" value="<?= get_query_var('price_min') ?>" id="price_min" name="price_min">
    <div class="dropdown" data-target="#price_max">
      <span class="dropdown__value"><?= get_query_var('price_max') ? get_query_var('price_max') : esc_html__('Max.', 'ungrynerd'); ?></span>
      <ul class="dropdown__options">
        <li><a href="#" data-value="400">400</a></li>
        <li><a href="#" data-value="600">600</a></li>
        <li><a href="#" data-value="800">800</a></li>
        <li><a href="#" data-value="1000">1000</a></li>
        <li><a href="#" data-value="1200">1200</a></li>
        <li><a href="#" data-value="1400">1400</a></li>
        <li><a href="#" data-value="1800">1800</a></li>
        <li><a href="#" data-value="2200">2200</a></li>
        <li><a href="#" data-value="3000">3000</a></li>
        <li class="input">
          <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'ungrynerd'); ?>">
          <a href="#" class="button button--active"><?php esc_html_e('Ok', 'ungrynerd'); ?></a>
        </li>
      </ul>
    </div>
    <input type="hidden" value="<?= get_query_var('price_max') ?>" id="price_max" name="price_max">
  </div>
  <div class="filters__field filters__field--price">
    <p class="filters__field__title"><?php esc_html_e('M2', 'ungrynerd'); ?></p>
    <div class="dropdown" data-target="#area_min">
      <span class="dropdown__value"><?= get_query_var('area_min') ? get_query_var('area_min') : esc_html__('Min.', 'ungrynerd'); ?></span>
      <ul class="dropdown__options">
        <li><a href="#" data-value="30">30</a></li>
        <li><a href="#" data-value="60">60</a></li>
        <li><a href="#" data-value="90">90</a></li>
        <li><a href="#" data-value="120">120</a></li>
        <li><a href="#" data-value="150">150</a></li>
        <li><a href="#" data-value="200">200</a></li>
        <li><a href="#" data-value="250">250</a></li>
        <li><a href="#" data-value="500">500</a></li>
        <li class="input">
          <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'ungrynerd'); ?>">
          <a href="#" class="button button--active"><?php esc_html_e('Ok', 'ungrynerd'); ?></a>
        </li>
      </ul>
    </div>
    <input type="hidden" value="<?= get_query_var('area_min') ?>" id="area_min" name="area_min">
    <div class="dropdown" data-target="#area_max">
      <span class="dropdown__value"><?= get_query_var('area_max') ? get_query_var('area_max') : esc_html__('Max.', 'ungrynerd'); ?></span>
      <ul class="dropdown__options">
        <li><a href="#" data-value="30">30</a></li>
        <li><a href="#" data-value="60">60</a></li>
        <li><a href="#" data-value="90">90</a></li>
        <li><a href="#" data-value="120">120</a></li>
        <li><a href="#" data-value="150">150</a></li>
        <li><a href="#" data-value="200">200</a></li>
        <li><a href="#" data-value="250">250</a></li>
        <li><a href="#" data-value="500">500</a></li>
        <li class="input">
          <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'ungrynerd'); ?>">
          <a href="#" class="button button--active"><?php esc_html_e('Ok', 'ungrynerd'); ?></a>
        </li>
      </ul>
    </div>
    <input type="hidden" value="<?= get_query_var('area_max') ?>" id="area_max" name="area_max">
  </div>
  <input class="button button--active" type="submit" value="<?php esc_html_e('Aplicar filtros', 'ungrynerd'); ?>">
</form>
