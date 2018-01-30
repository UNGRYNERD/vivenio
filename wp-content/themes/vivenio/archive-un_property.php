<?php use Roots\Sage\Extras; ?>
<section class="properties">
  <aside class="filters">
    <h2 class="filters__title"><?php esc_html_e('Filtros', 'ungrynerd'); ?></h2>
    <form action="" method="post">
      <div class="filters__field">
        <label for="zona"><?php esc_html_e('Elige tu zona', 'ungrynerd'); ?></label>
        <?php $areas = get_terms('un_area', array('hide_empty' => 0, 'parent' => 0)); ?>
        <div class="dropdown" data-target="#area">
          <?php $queried_area = get_term_by('slug', get_query_var('area') , 'un_area') ?>
          <span class="dropdown__value"><?= get_query_var('area') ? $queried_area->name : esc_html__('Elige tu zona', 'ungrynerd'); ?></span>
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
        <input type="hidden" value="<?= get_query_var('area') ?>" id="area" name="area">
      </div>

      <div class="filters__field filters__field--price">
        <label for="precio"><?php esc_html_e('Precio', 'ungrynerd'); ?></label>
        <div class="dropdown" data-target="#price_min">
          <span class="dropdown__value"><?= get_query_var('price_min') ? get_query_var('price_min') : esc_html__('Min.', 'ungrynerd'); ?></span>
          <ul class="dropdown__options">
            <li><a href="#" data-value="500">500</a></li>
            <li><a href="#" data-value="600">600</a></li>
            <li><a href="#" data-value="700">700</a></li>
            <li><a href="#" data-value="800">800</a></li>
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
            <li><a href="#" data-value="500">500</a></li>
            <li><a href="#" data-value="600">600</a></li>
            <li><a href="#" data-value="700">700</a></li>
            <li><a href="#" data-value="800">800</a></li>
            <li class="input">
              <input type="number" min="0" placeholder="<?php esc_html_e('Otro', 'ungrynerd'); ?>">
              <a href="#" class="button button--active"><?php esc_html_e('Ok', 'ungrynerd'); ?></a>
            </li>
          </ul>
        </div>
        <input type="hidden" value="<?= get_query_var('price_max') ?>" id="price_max" name="price_max">
      </div>
      <div class="filters__field filters__field--checks">
        <?php $rooms = get_terms('un_room', array('hide_empty' => 0, 'parent' => 0)); ?>
        <?php foreach ($rooms as $room): ?>
          <label for="rooms-<?= $room->slug ?>"><?= $room->name?> <input value="<?= $room->slug?>" type="checkbox" name="rooms[]" id="rooms-<?= $room->slug ?>" <?= get_query_var('rooms') && in_array($room->slug, get_query_var('rooms')) ? 'checked' : ''; ?> ><span></span></label>
        <?php endforeach ?>
      </div>

      <div class="filters__field filters__field--checks">
        <?php $types = get_terms('un_type', array('hide_empty' => 0, 'parent' => 0)); ?>
        <?php foreach ($types as $type): ?>
          <label for="types-<?= $type->slug?>"><?= $type->name?> <input value="<?= $type->slug?>" type="checkbox" name="types[]" id="types-<?= $type->slug?>" <?= get_query_var('types') && in_array($type->slug, get_query_var('types')) ? 'checked' : ''; ?>><span></span></label>
        <?php endforeach ?>
      </div>

      <div class="filters__field filters__field--checks">
        <?php $features = get_terms('un_feature', array('hide_empty' => 0, 'parent' => 0)); ?>
        <?php foreach ($features as $feature): ?>
          <label for="features-<?= $feature->slug?>"><?= $feature->name?> <input value="<?= $feature->slug?>" type="checkbox" name="features[]" id="features-<?= $feature->slug?>" <?= get_query_var('features') && in_array($feature->slug, get_query_var('features')) ? 'checked' : ''; ?>><span></span></label>
        <?php endforeach ?>
      </div>
      <input class="button button--active" type="submit" value="<?php esc_html_e('Aplicar filtros', 'ungrynerd'); ?>">
    </form>
  </aside>
  <div class="prop-list">
    <?php if (have_posts()): ?>
      <?php while(have_posts()) : the_post(); ?>
        <article class="prop-list__property">
          <?php the_post_thumbnail('info-map'); ?>
          <div class="prop-list__property__info">
            <?php $address = get_field('property_geo') ?>
            <h2 class="prop-list__property__title"><?php the_title() ?></h2>
            <h3 class="prop-list__property__location"><?php the_field('property_location') ?></h3>
            <h4 class="prop-list__property__address"><?= $address['address']; ?></h4>
            <h4 class="prop-list__property__desc"><?php the_field('property_desc') ?></h4>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <p><?php esc_html_e('No hay resultados para tus filtros', 'ungrynerd'); ?></p>
    <?php endif ?>
  </div>
</section>
