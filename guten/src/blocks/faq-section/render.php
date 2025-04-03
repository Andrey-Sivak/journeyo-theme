<?php
$title = $attributes['title'] ?? '';
$items = $attributes['items'] ?? [];

$wrapper_attributes = get_block_wrapper_attributes();
$base_class = 'wp-block-journeyo-faq-section';
?>

<div <?php echo $wrapper_attributes; ?>>
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
                        <?php if (!empty($item['question'])) : ?>
                            <h3 class="<?php echo $base_class . '__item-question'; ?>">
                                <button
                                        class="<?php echo $base_class . '__item-toggle'; ?>"
                                        aria-expanded="false"
                                        aria-controls="faq-answer-<?php echo esc_attr($index); ?>"
                                >
                                    <span class=""><?php echo wp_kses_post($item['question']); ?></span>
                                    <span class="<?php echo $base_class . '__item-icon'; ?>">
                                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
<path d="M23.3334 31.6665L40 48.3332L45.3457 42.9875M56.6667 31.6665L52.4162 35.9171" stroke="#141416" stroke-width="5"
      stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                    </span>
                                </button>
                            </h3>
                        <?php endif; ?>

                        <?php if (!empty($item['answer'])) : ?>
                            <div
                                    class="<?php echo $base_class . '__item-answer'; ?>"
                                    id="faq-answer-<?php echo esc_attr($index); ?>"
                            >
                                <p class="<?php echo $base_class . '__item-answer-inner'; ?>">
                                    <?php echo wp_kses_post($item['answer']); ?>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>