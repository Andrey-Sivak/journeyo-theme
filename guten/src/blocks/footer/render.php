<?php
$logo = $attributes['logo'] ?? null;
$menu_items = $attributes['menuItems'] ?? [];
$socials = $attributes['socials'] ?? [];
$privacyPolicyText = $attributes['privacyPolicyText'] ?? '';
$termsOfUsePolicyText = $attributes['termsOfUsePolicyText'] ?? '';
$copyrightText = $attributes['copyrightText'] ?? '';

$wrapper_attributes = get_block_wrapper_attributes();
$base_class = 'wp-block-journeyo-footer';
?>

</main>
<footer <?php echo $wrapper_attributes; ?>>
    <div class="<?php echo $base_class . '__wrap'; ?>">

        <div class="<?php echo $base_class . '__top'; ?>">
            <?php if ($logo['url']) : ?>
                <div
                        class="<?php echo $base_class . '__logo'; ?>"
                        itemscope
                        itemtype="https://schema.org/Organization"
                >
                    <meta itemprop="name" content="<?php echo esc_html(get_bloginfo('name')); ?>">
                    <meta itemprop="url" content="<?php echo get_home_url(); ?>">
                    <figure>
                        <a href="<?php echo get_home_url(); ?>"
                           aria-label="<?php echo esc_attr__('Go to homepage', 'jn') ?>" itemprop="url">
                            <img
                                    src="<?php echo esc_url($logo['url']); ?>"
                                    alt="<?php echo esc_attr__('Journeyo Logo', 'jn') ?>"
                                    width="200"
                                    height="50"
                                    loading="eager"
                                    itemprop="logo"
                            />
                        </a>
                        <figcaption itemprop="description" style="display:none;">
                            <?php echo esc_html(get_bloginfo('description')); ?>
                        </figcaption>
                    </figure>
                </div>
            <?php endif; ?>

            <div class="<?php echo $base_class . '__top-right'; ?>">

                <div class="<?php echo $base_class . '__top-right-top'; ?>">
                    <?php if (!empty($menu_items)) : ?>
                        <div class="<?php echo $base_class . '__menu-items'; ?>">
                            <?php foreach ($menu_items as $index => $item) : ?>
                                <a href="<?php echo esc_url($item['url']); ?>"
                                   target="<?php echo esc_attr($item['target']); ?>"
                                   class="<?php echo $base_class . '__menu-item'; ?>">
                                    <?php echo esc_html($item['text']); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($socials)) : ?>
                        <div class="<?php echo $base_class . '__social-items'; ?>">
                            <?php foreach ($socials as $social_item) : ?>
                                <a href="<?php echo esc_url($social_item['url']); ?>"
                                   target="<?php echo esc_attr($social_item['target']); ?>"
                                   class="<?php echo $base_class . '__social-item'; ?>">
                                    <img
                                            src="<?php echo esc_url($social_item['icon']['url']); ?>"
                                            alt="<?php echo esc_attr($social_item['icon']['alt']) ?>"
                                            width="50"
                                            height="50"
                                            loading="eager"
                                    />
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="<?php echo $base_class . '__top-right-bottom'; ?>">
                    <?php if (!empty($privacyPolicyText)) : ?>
                        <a href="#">
                            <?php echo wp_kses_post($privacyPolicyText); ?>
                        </a>
                    <?php endif; ?>
                    <?php if (!empty($termsOfUsePolicyText)) : ?>
                        <a href="#">
                            <?php echo wp_kses_post($termsOfUsePolicyText); ?>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>

        <?php if (!empty($copyrightText)) :
            $year = date('Y');
            ?>
            <p class="<?php echo $base_class . '__copyright'; ?>">
                &copy;&nbsp;<?php echo esc_html($year); ?>&nbsp;<?php echo wp_kses_post($copyrightText); ?>
            </p>
        <?php endif; ?>
    </div>
</footer>