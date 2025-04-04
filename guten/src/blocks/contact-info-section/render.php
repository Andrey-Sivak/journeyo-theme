<?php
$title = $attributes['title'] ?? '';
$items = $attributes['items'] ?? [];

$wrapper_attributes = get_block_wrapper_attributes();
$base_class = 'wp-block-journeyo-contact-info-section';
?>

<section <?php echo $wrapper_attributes; ?>>
    <div class="<?php echo $base_class . '__wrap'; ?>">
        <?php if (!empty($title)) : ?>
            <h2 class="<?php echo $base_class . '__title jn-animate'; ?>">
                <?php echo wp_kses_post($title); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($items)) : ?>
            <div class="<?php echo $base_class . '__items'; ?>">
                <?php foreach ($items as $index => $item) : ?>
                    <div class="<?php echo $base_class . '__item jn-animate'; ?>">
                        <?php if (!empty($item['label']) && empty($item['answer'])) : ?>
                            <p class="<?php echo $base_class . '__item-label'; ?>">
                                <?php echo wp_kses_post($item['label']); ?>
                            </p>
                            <p class="<?php echo $base_class . '__item-value'; ?>">
                                <?php echo wp_kses_post($item['value']); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>