<form action="<?= get_post_type_archive_link('un_property') ?>" method="post">
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
          <li><a href="#" data-value="<?= $area->slug ?>"><?php esc_html_e('Todo', 'vivenio'); ?> <?= $area->name; ?></a></li>
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
          <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'vivenio'); ?>">
          <a href="#" class="button button--active"><?php esc_html_e('Ok', 'vivenio'); ?></a>
        </li>
      </ul>
    </div>
    <input type="hidden" value="<?= get_query_var('price_min') ?>" id="price_min" name="price_min">
    <div class="dropdown" data-target="#price_max">
      <span class="dropdown__value"><?= get_query_var('price_max') ? get_query_var('price_max') : esc_html__('Max.', 'vivenio'); ?></span>
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
          <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'vivenio'); ?>">
          <a href="#" class="button button--active"><?php esc_html_e('Ok', 'vivenio'); ?></a>
        </li>
      </ul>
    </div>
    <input type="hidden" value="<?= get_query_var('price_max') ?>" id="price_max" name="price_max">
  </div>

  <p class="filters__field__title"><?php esc_html_e('Tipo de vivienda', 'vivenio'); ?></p>
  <div class="filters__field filters__field--checks">
    <?php $types = get_terms('un_type', array('hide_empty' => 0, 'parent' => 0)); ?>
    <?php foreach ($types as $type): ?>
      <label for="types-<?= $type->slug?>"><?= $type->name?> <input value="<?= $type->slug?>" type="checkbox" name="types[]" id="types-<?= $type->slug?>" <?= get_query_var('types') && in_array($type->slug, get_query_var('types')) ? 'checked' : ''; ?>><span></span></label>
    <?php endforeach ?>
  </div>

  <p class="filters__field__title"><?php esc_html_e('Habitaciones', 'vivenio'); ?></p>
  <div class="filters__field filters__field--checks">
    <?php $rooms = get_terms('un_room', array('hide_empty' => 0, 'parent' => 0)); ?>
    <?php foreach ($rooms as $room): ?>
      <label for="rooms-<?= $room->slug ?>"><?= $room->name?> <input value="<?= $room->slug?>" type="checkbox" name="rooms[]" id="rooms-<?= $room->slug ?>" <?= get_query_var('rooms') && in_array($room->slug, get_query_var('rooms')) ? 'checked' : ''; ?> ><span></span></label>
    <?php endforeach ?>
  </div>

  <p class="filters__field__title"><?php esc_html_e('Características', 'vivenio'); ?></p>
  <div class="filters__field filters__field--checks">
    <?php $features = get_terms('un_feature', array('hide_empty' => 0, 'parent' => 0)); ?>
    <?php foreach ($features as $feature): ?>
      <label for="features-<?= $feature->slug?>"><?= $feature->name?> <input value="<?= $feature->slug?>" type="checkbox" name="features[]" id="features-<?= $feature->slug?>" <?= get_query_var('features') && in_array($feature->slug, get_query_var('features')) ? 'checked' : ''; ?>><span></span></label>
    <?php endforeach ?>
  </div>
  <input class="button button--active" type="submit" value="<?php esc_html_e('Aplicar filtros', 'vivenio'); ?>">
</form>
