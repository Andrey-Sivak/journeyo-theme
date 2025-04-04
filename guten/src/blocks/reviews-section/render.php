<?php
$title = $attributes['title'] ?? '';
$items = $attributes['items'] ?? [];

$wrapper_attributes = get_block_wrapper_attributes();
$base_class = 'wp-block-journeyo-reviews-section';
?>

<section <?php echo $wrapper_attributes; ?>>
    <div class="<?php echo $base_class . '__wrap'; ?>">

        <?php if (!empty($title)) : ?>
            <h2 class="<?php echo $base_class . '__title jn-animate'; ?>">
                <?php echo wp_kses_post($title); ?>
            </h2>
        <?php endif; ?>

        <?php if (!empty($items)) : ?>
            <div class="<?php echo $base_class . '__items' . (count($items) > 3 ? '' : ' jn-items-' . count($items)); ?>">
                <?php if (count($items) > 3) : ?>
                <div class="swiper-wrapper">
                    <?php endif; ?>

                    <?php foreach ($items as $index => $item) : ?>
                        <?php

                        $quote_bg = '';
                        if ($index % 3 === 0) {
                            $quote_bg = '--jn-yellow';
                        } elseif ($index % 3 === 1) {
                            $quote_bg = '--jn-ochre';
                        } else {
                            $quote_bg = '--jn-orange';
                        }

                        $articleClass = $base_class . '__item';

                        if (count($items) > 3) {
                            $articleClass .= ' swiper-slide';
                        }
                        ?>
                        <article class="<?php echo $articleClass; ?>">
                            <div class="<?php echo $base_class . '__item-wrap'; ?>">
                                <?php if (!empty($item['photo']) && is_array($item['photo']) && !empty($item['photo']['url'])) : ?>
                                    <div class="<?php echo $base_class . '__item-photo-helper'; ?>"></div>
                                    <figure class="<?php echo $base_class . '__item-photo'; ?>">
                                        <img
                                                src="<?php echo esc_url($item['photo']['url']); ?>"
                                                alt="<?php echo esc_attr($item['photo']['alt'] ?? ''); ?>"
                                                loading="lazy"
                                                width="111"
                                                height="111"
                                        >
                                    </figure>
                                <?php endif; ?>
                                <div class="<?php echo $base_class . '__item-quote-helper'; ?>"></div>
                                <div class="<?php echo $base_class . '__item-quote'; ?>"
                                     style="background-color: var(<?php echo $quote_bg; ?>);">
                                    <svg width="42" height="36" viewBox="0 0 42 36" fill="none">
                                        <path d="M26.5688 0H39.3036C40.7929 0 42 1.21777 42 2.71958V18.1743C42 27.9625 37.0385 33.8862 27.1133 35.9434C25.441 36.29 23.8721 35 23.8721 33.2779V29.8005C23.8721 28.5043 24.7779 27.3753 26.0409 27.136C29.3675 26.5047 31.4821 24.6664 32.3841 21.6207C32.8943 19.898 31.5672 18.1743 29.7847 18.1743H26.5688C25.0795 18.1743 23.8724 16.9569 23.8724 15.4547V2.71958C23.8724 1.21744 25.0798 0 26.5688 0Z"
                                              fill="white"/>
                                        <path d="M2.6967 0H15.4315C16.9209 0 18.1279 1.21777 18.1279 2.71958V18.1743C18.1279 27.9625 13.1665 33.8862 3.24131 35.9434C1.56898 36.29 0 35 0 33.2779V29.8005C0 28.5043 0.905858 27.3753 2.16878 27.136C5.49515 26.5047 7.60966 24.6664 8.51198 21.621C9.02222 19.8983 7.69509 18.1743 5.91261 18.1743H2.6967C1.20739 18.1743 0.000352781 16.9569 0.000352781 15.4547V2.71958C0.000352781 1.21744 1.20771 0 2.6967 0Z"
                                              fill="white"/>
                                    </svg>
                                </div>

                                <div class="<?php echo $base_class . '__item-content'; ?>">
                                    <?php if (!empty($item['name'])) : ?>
                                        <h3 class="<?php echo $base_class . '__item-name'; ?>">
                                            <?php echo wp_kses_post($item['name']); ?>
                                        </h3>
                                    <?php endif; ?>
                                    <?php if (!empty($item['location'])) : ?>
                                        <p class="<?php echo $base_class . '__item-location'; ?>">
                                            <?php echo wp_kses_post($item['location']); ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($item['text'])) : ?>
                                        <p class="<?php echo $base_class . '__item-text'; ?>">
                                            “<?php echo wp_kses_post($item['text']); ?>”
                                        </p>
                                    <?php endif; ?>

                                    <?php if (isset($item['rating']) && $item['rating'] > 0 && $item['rating'] <= 5) : ?>
                                        <div class="<?php echo $base_class . '__item-rating'; ?>">
                                            <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                <svg viewBox="0 0 26 25"
                                                     fill="<?php echo $i <= $item['rating'] ? '#FFCE08' : 'none'; ?>"
                                                     stroke="#FFCE08" stroke-width="1">
                                                    <path d="M9.66685 6.22834C10.8724 2.9294 11.4752 1.27993 12.4612 1.00289C12.815 0.903464 13.1894 0.903464 13.5432 1.00289C14.5292 1.27993 15.132 2.9294 16.3375 6.22834L16.3998 6.39868C16.6978 7.21427 16.8469 7.62207 17.1174 7.91573C17.3134 8.12846 17.5532 8.29614 17.8203 8.40722C18.189 8.56054 18.6232 8.56054 19.4915 8.56054H20.0232C22.9565 8.56054 24.4231 8.56054 24.9879 9.05256C25.5601 9.55113 25.8009 10.3307 25.6094 11.0651C25.4205 11.7899 24.2092 12.6169 21.7868 14.2709C21.0964 14.7423 20.7512 14.978 20.5386 15.2894C20.3203 15.6092 20.1995 15.9855 20.1909 16.3725C20.1825 16.7495 20.328 17.1478 20.6191 17.9444C21.6718 20.825 22.1982 22.2653 21.8609 23.0097C21.5965 23.5932 21.0686 24.0148 20.441 24.1435C19.6404 24.3076 18.3726 23.4887 15.8369 21.8507L14.9536 21.2801C14.1152 20.7385 13.696 20.4677 13.2331 20.4139C13.0797 20.3961 12.9247 20.3961 12.7712 20.4139C12.3084 20.4677 11.8892 20.7385 11.0507 21.2801L10.1909 21.8355C7.63579 23.4861 6.35823 24.3113 5.55198 24.1411C4.93321 24.0104 4.4127 23.5948 4.14833 23.0203C3.80386 22.2717 4.33424 20.8204 5.395 17.9177C5.68423 17.1263 5.82885 16.7306 5.82101 16.3551C5.81308 15.9753 5.69713 15.6055 5.48673 15.2892C5.27874 14.9765 4.93896 14.7377 4.2594 14.2601C1.89329 12.5971 0.710235 11.7656 0.531469 11.0373C0.353139 10.3108 0.595181 9.54547 1.15884 9.05361C1.72389 8.56054 3.16991 8.56054 6.06197 8.56054H6.52105C7.38146 8.56054 7.81166 8.56054 8.17745 8.40995C8.4494 8.298 8.6933 8.12745 8.8918 7.91046C9.15879 7.61858 9.30646 7.21451 9.60179 6.40638L9.66685 6.22834Z"/>
                                                </svg>
                                            <?php endfor; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>

                    <?php if (count($items) >= 3) : ?>
                </div>
                <div class="<?php echo $base_class . '__pagination swiper-pagination'; ?>"></div>
                <!--                <div class="--><?php //echo $base_class . '__button-prev swiper-button-prev'; ?><!--"></div>-->
                <!--                <div class="--><?php //echo $base_class . '__button-next swiper-button-next'; ?><!--"></div>-->
            <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>