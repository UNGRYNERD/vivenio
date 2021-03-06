<form action="<?= get_post_type_archive_link('un_garage') ?>" method="post">
  <input type="hidden" name="cpt" value="<?= $wp_query->query['post_type']; ?>">
  <div class="filters__field">
    <p class="filters__field__title"><?php esc_html_e('Elige tu zona', 'vivenio'); ?></p>
    <?php $areas = get_terms('un_area', array('hide_empty' => 0, 'parent' => 0)); ?>
    <div class="dropdown" data-target="#area">
      <?php if (get_query_var('area')) : ?>
        <?php $queried_area = get_term_by('slug', get_query_var('area'), 'un_area') ?>
      <?php else: ?>
        <?php $queried_area = get_term_by('slug', get_query_var('un_area') , 'un_area') ?>
      <?php endif; ?>
      <span class="dropdown__value"><?= $queried_area ? $queried_area->name : esc_html__('Elige tu zona', 'vivenio'); ?></span>
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
    <p class="filters__field__title"><?php esc_html_e('Precio', 'vivenio'); ?></p>
    <div class="dropdown" data-target="#price_min">
      <span class="dropdown__value"><?= get_query_var('price_min') ? get_query_var('price_min') : esc_html__('Min.', 'vivenio'); ?></span>
      <ul class="dropdown__options">
        <li><a href="#" data-value="40">40</a></li>
        <li><a href="#" data-value="60">60</a></li>
        <li><a href="#" data-value="90">90</a></li>
        <li><a href="#" data-value="120">120</a></li>
        <li><a href="#" data-value="150">150</a></li>
        <li><a href="#" data-value="200">200</a></li>
        <li><a href="#" data-value="250">250</a></li>
        <li><a href="#" data-value="300">300</a></li>
        <li class="input">
          <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'vivenio'); ?>">
          <a href="#" class="button button--active"><?php esc_html_e('Ok', 'vivenio'); ?></a>
        </li>
      </ul>
    </div>
    <input type="hidden" value="<?= get_query_var('price_min') ?>" id="price_min" name="price_min">
    <div class="dropdown" data-target="#price_max">
      <span class="dropdown__value"><?= get_query_var('price_max') ? get_query_var('price_max') : esc_html__('Max.', 'vivenio'); ?></span>
      <ul class="dropdown__options">
        <li><a href="#" data-value="40">40</a></li>
        <li><a href="#" data-value="60">60</a></li>
        <li><a href="#" data-value="90">90</a></li>
        <li><a href="#" data-value="120">120</a></li>
        <li><a href="#" data-value="150">150</a></li>
        <li><a href="#" data-value="200">200</a></li>
        <li><a href="#" data-value="250">250</a></li>
        <li><a href="#" data-value="300">300</a></li>
        <li class="input">
          <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'vivenio'); ?>">
          <a href="#" class="button button--active"><?php esc_html_e('Ok', 'vivenio'); ?></a>
        </li>
      </ul>
    </div>
    <input type="hidden" value="<?= get_query_var('price_max') ?>" id="price_max" name="price_max">
  </div>
  <p class="filters__field__title"><?php esc_html_e('Vehículo', 'vivenio'); ?></p>
  <div class="filters__field filters__field--checks">
    <?php $vehicles = get_terms('un_vehicle', array('hide_empty' => 0, 'parent' => 0)); ?>
    <?php foreach ($vehicles as $vehicle): ?>
      <label for="vehicles-<?= $vehicle->slug?>"><?= $vehicle->name?> <input value="<?= $vehicle->slug?>" type="checkbox" name="vehicles[]" id="vehicles-<?= $vehicle->slug?>" <?= get_query_var('vehicles') && in_array($vehicle->slug, get_query_var('vehicles')) ? 'checked' : ''; ?>><span></span></label>
    <?php endforeach ?>
  </div>
  <input class="button button--active" type="submit" value="<?php esc_html_e('Aplicar filtros', 'vivenio'); ?>">
</form>
