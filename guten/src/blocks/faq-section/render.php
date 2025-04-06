<?php
$title = $attributes['title'] ?? '';
$items = $attributes['items'] ?? [];

$wrapper_attributes = get_block_wrapper_attributes([
    'id' => 'faq-section',
]);
$base_class = 'wp-block-journeyo-faq-section';
?>

<section <?php echo $wrapper_attributes; ?>
        role="region"
        aria-labelledby="faq-section-title"
        itemscope
        itemtype="https://schema.org/FAQPage"
>
    <div class="<?php echo $base_class . '__wrap'; ?>">
        <?php if (!empty($title)) : ?>
            <h2 class="<?php echo $base_class . '__title jn-animate'; ?>" id="faq-section-title">
                <?php echo wp_kses_post($title); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($items)) : ?>
            <dl class="<?php echo $base_class . '__items'; ?>" role="list">
                <?php foreach ($items as $index => $item) : ?>
                    <dt class="<?php echo $base_class . '__item jn-animate'; ?>" itemscope
                        itemtype="https://schema.org/Question" itemprop="mainEntity"
                    >
                        <?php if (!empty($item['question'])) : ?>
                            <h3 class="<?php echo $base_class . '__item-question'; ?>">
                                <button
                                        class="<?php echo $base_class . '__item-toggle'; ?>"
                                        aria-expanded="false"
                                        aria-controls="faq-answer-<?php echo esc_attr($index); ?>"
                                        aria-label="<?php echo esc_attr(sprintf(__('Expand %s', 'jn'), $item['question'])); ?>"
                                >
                                    <span><?php echo wp_kses_post($item['question']); ?></span>
                                    <span class="<?php echo $base_class . '__item-icon'; ?>">
                                        <svg width="80" height="80" viewBox="0 0 80 80" fill="none" aria-hidden="true">
                                            <path d="M23.3334 31.6665L40 48.3332L45.3457 42.9875M56.6667 31.6665L52.4162 35.9171"
                                                  stroke="#141416" stroke-width="5" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </button>
                            </h3>
                        <?php endif; ?>

                        <?php if (!empty($item['answer'])) : ?>
                            <dd
                                    class="<?php echo $base_class . '__item-answer'; ?>"
                                    id="faq-answer-<?php echo esc_attr($index); ?>"
                                    itemscope
                                    itemtype="https://schema.org/Answer"
                                    itemprop="acceptedAnswer"
                            >
                                <p class="<?php echo $base_class . '__item-answer-inner'; ?>" itemprop="text">
                                    <?php echo wp_kses_post($item['answer']); ?>
                                </p>
                            </dd>
                        <?php endif; ?>
                    </dt>
                <?php endforeach; ?>
            </dl>
        <?php endif; ?>
    </div>
</section>