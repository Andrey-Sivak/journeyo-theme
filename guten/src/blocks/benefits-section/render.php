<?php
$title = $attributes['title'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$items = $attributes['items'] ?? [];

$wrapper_attributes = get_block_wrapper_attributes();
$base_class = 'wp-block-journeyo-benefits-section';
?>

<section <?php echo $wrapper_attributes; ?>>
    <div class="<?php echo $base_class . '__wrap'; ?>">

        <?php if (!empty($title)) : ?>
            <h2 class="<?php echo $base_class . '__title jn-animate'; ?>">
                <?php echo wp_kses_post($title); ?>
            </h2>
        <?php endif; ?>
        <?php if (!empty($subtitle)) : ?>
            <p class="<?php echo $base_class . '__subtitle jn-animate'; ?>">
                <?php echo wp_kses_post($subtitle); ?>
            </p>
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

            <div class="<?php echo $items_classes; ?>">
                <?php foreach ($items as $index => $item) : ?>
                    <article class="<?php echo $base_class . '__item jn-animate'; ?>">
                        <div class="<?php echo $base_class . '__item-content'; ?>">
                            <?php if (!empty($item['title'])) : ?>
                                <h3 class="<?php echo $base_class . '__item-title'; ?>">
                                    <?php echo wp_kses_post($item['title']); ?>
                                </h3>
                            <?php endif; ?>

                            <?php if (!empty($item['subtitle'])) : ?>
                                <p class="<?php echo $base_class . '__item-subtitle'; ?>">
                                    <?php echo wp_kses_post($item['subtitle']); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($item['icon']) && is_array($item['icon']) && !empty($item['icon']['url'])) : ?>
                            <div class="<?php echo $base_class . '__item-icon-white-border'; ?>"></div>
                            <div class="<?php echo $base_class . '__item-icon-helper-top'; ?>"></div>
                            <div class="<?php echo $base_class . '__item-icon-helper-right'; ?>"></div>
                            <figure class="<?php echo $base_class . '__item-icon'; ?>">
                                <img
                                        src="<?php echo esc_url($item['icon']['url']); ?>"
                                        alt="<?php echo esc_attr($item['icon']['alt'] ?? ''); ?>"
                                        loading="eager"
                                        width="<?php echo esc_attr($item['icon']['w'] ?? 0); ?>"
                                        height="<?php echo esc_attr($item['icon']['h'] ?? 0); ?>"
                                >
                            </figure>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>