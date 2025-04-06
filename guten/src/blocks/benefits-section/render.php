<?php
$title = $attributes['title'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$items = $attributes['items'] ?? [];
$block_id = $attributes['blockId'] ?? '';

$wrapper_attributes = get_block_wrapper_attributes([
    'id' => !empty($block_id) ? esc_attr($block_id) : null,
]);
$base_class = 'wp-block-journeyo-benefits-section';
?>

<section <?php echo $wrapper_attributes; ?> role="region"
                                            aria-labelledby="<?php echo esc_attr($block_id . '-title'); ?>"
                                            itemprop="description"
>
    <div class="<?php echo $base_class . '__wrap'; ?>">

        <?php if (!empty($title)) : ?>
            <h2 class="<?php echo $base_class . '__title jn-animate'; ?>"
                id="<?php echo esc_attr($block_id . '-title'); ?>">
                <?php echo wp_kses_post($title); ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($subtitle)) : ?>
            <h3 class="<?php echo $base_class . '__subtitle jn-animate'; ?>">
                <?php echo wp_kses_post($subtitle); ?>
            </h3>
        <?php endif; ?>

        <?php if (!empty($items)) : ?>

            <?php
            $item_count = count($items);

            $cols_class = '';
            $remainder = $item_count % 3;
            if ($remainder === 0) {
                $cols_class = 'jn-cols-3';
            } elseif ($remainder === 1) {
                $cols_class = 'jn-cols-4';
            } elseif ($remainder === 2) {
                $cols_class = 'jn-cols-5';
            }

            $items_classes = $base_class . '__items ' . $cols_class;
            ?>

            <ul class="<?php echo $items_classes; ?>" role="list">
                <?php foreach ($items as $index => $item) : ?>
                    <li class="<?php echo $base_class . '__item jn-animate'; ?>" itemscope
                             itemtype="https://schema.org/Feature">
                        <div class="<?php echo $base_class . '__item-content'; ?>">
                            <?php if (!empty($item['title'])) : ?>
                                <h4 class="<?php echo $base_class . '__item-title'; ?>" itemprop="name">
                                    <?php echo wp_kses_post($item['title']); ?>
                                </h4>
                            <?php endif; ?>

                            <?php if (!empty($item['subtitle'])) : ?>
                                <p class="<?php echo $base_class . '__item-subtitle'; ?>" itemprop="description">
                                    <?php echo wp_kses_post($item['subtitle']); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($item['icon']) && is_array($item['icon']) && !empty($item['icon']['id'])) : ?>
                            <div class="<?php echo $base_class . '__item-icon-white-border'; ?>"></div>
                            <div class="<?php echo $base_class . '__item-icon-helper-top'; ?>"></div>
                            <div class="<?php echo $base_class . '__item-icon-helper-right'; ?>"></div>
                            <figure class="<?php echo $base_class . '__item-icon'; ?>" itemscope
                                    itemtype="https://schema.org/ImageObject"
                            >
                                <?php
                                get_template_part('/template-parts/advanced-image', null, array(
                                    'img_id' => $item['icon']['id'],
                                    'class' => '',
                                    'is_schema' => true,
                                    'decorative' => false,
                                ));
                                ?>
                            </figure>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>