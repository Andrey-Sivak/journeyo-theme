<?php
$title = $attributes['title'] ?? '';
$items = $attributes['items'] ?? [];

$wrapper_attributes = get_block_wrapper_attributes([
    'id' => 'contact-info-section',
]);
$base_class = 'wp-block-journeyo-contact-info-section';
?>

<section <?php echo $wrapper_attributes; ?>
        role="region"
        aria-labelledby="contact-info-section-title"
        itemscope
        itemtype="https://schema.org/Organization"
>
    <div class="<?php echo $base_class . '__wrap'; ?>">
        <?php if (!empty($title)) : ?>
            <h2 class="<?php echo $base_class . '__title jn-animate'; ?>" id="contact-info-section-title">
                <?php echo wp_kses_post($title); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($items)) : ?>
            <dl class="<?php echo $base_class . '__items'; ?>">
                <?php foreach ($items as $index => $item) : ?>
                    <div class="<?php echo $base_class . '__item jn-animate'; ?>">
                        <?php if (!empty($item['label']) && !empty($item['value'])) : ?>
                            <dt>
                                <p class="<?php echo $base_class . '__item-label'; ?>">
                                    <?php echo wp_kses_post($item['label']); ?>
                                </p>
                            </dt>
                            <dd
                                <?php
                                if (stripos($item['label'], 'Company name') !== false) {
                                    echo ' itemprop="name"';
                                } elseif (stripos($item['label'], 'ID') !== false && stripos($item['label'], 'VAT') === false) {
                                    echo ' itemprop="taxID"';
                                } elseif (stripos($item['label'], 'VAT') !== false) {
                                    echo ' itemprop="vatID"';
                                } elseif (stripos($item['label'], 'Email') !== false) {
                                    echo ' itemprop="email"';
                                }
                                ?>
                            >
                                <p class="<?php echo $base_class . '__item-value'; ?>">
                                    <?php echo wp_kses_post($item['value']); ?>
                                </p>
                            </dd>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </dl>
        <?php endif; ?>
    </div>
</section>