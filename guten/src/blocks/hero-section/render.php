<?php
$title = $attributes['title'] ?? '';
$description = $attributes['text'] ?? '';
$appstore_link = $attributes['appStoreLink'] ?? '';
$google_play_link = $attributes['googlePlayLink'] ?? '';
$logo = $attributes['logo'] ?? null;
$logo2 = $attributes['logo2'] ?? null;
$image = $attributes['image'] ?? null;
$button_text = $attributes['buttonText'] ?? '';

$wrapper_attributes = get_block_wrapper_attributes();
$base_class = 'wp-block-journeyo-hero-section';
?>

<header class="<?php echo $base_class . '__header'; ?>" role="banner" itemscope itemtype="https://schema.org/WPHeader">
    <div class="<?php echo $base_class . '__header-wrap'; ?>">
        <?php if ($logo['id']) : ?>
            <div class="<?php echo $base_class . '__header-logo'; ?>">
                <a href="<?php echo get_home_url(); ?>"
                   title="<?php echo esc_html(get_bloginfo('name')); ?>"
                   aria-label="<?php echo esc_attr__('Go to homepage', 'jn') ?>" itemprop="url">
                    <figure itemscope itemtype="https://schema.org/ImageObject">
                        <?php
                        get_template_part('/template-parts/advanced-image', null, array(
                            'img_id' => $logo['id'],
                            'class' => 'jn-base-header-logo',
                            'is_schema' => true,
                            'decorative' => false,
                        ));
                        ?>
                        <?php
                        get_template_part('/template-parts/advanced-image', null, array(
                            'img_id' => $logo2['id'],
                            'class' => 'jn-color-header-logo',
                            'is_schema' => true,
                            'decorative' => false,
                        ));
                        ?>
                        <figcaption itemprop="description" class="jn-visually-hidden">
                            <?php echo esc_html(get_bloginfo('description')); ?>
                        </figcaption>
                    </figure>
                </a>
            </div>
        <?php endif; ?>

        <button class="mob-burger-btn"
                type="button"
                aria-expanded="false"
                aria-controls="mobile-menu"
                title="<?php echo esc_attr__('Toggle mobile navigation', 'jn'); ?>">
            <span class="jn-visually-hidden"><?php echo esc_html__('Menu', 'jn'); ?></span>
            <span class="mob-burger-btn-top"></span>
            <span class="mob-burger-btn-center"></span>
            <span class="mob-burger-btn-bottom"></span>
        </button>

        <div class="<?php echo $base_class . '__header-right'; ?>">
            <?php if ($button_text) : ?>
                <a href="#jn-contact-form"
                   class="<?php echo $base_class . '__header-button'; ?>"
                   aria-label="<?php echo esc_attr(sprintf(__('Go to %s form', 'jn'), $button_text)); ?>"
                   title="<?php echo esc_attr($button_text); ?>"
                   itemprop="contactPoint"
                   itemscope
                   itemtype="https://schema.org/ContactPoint"
                >
                    <span><?php echo esc_html($button_text); ?></span>
                    <meta itemprop="contactType" content="customer support">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                        <path
                                d="M3.431 2.56899L12.569 2.56899L12.569 11.707M11.9344 3.20357L2.6695 12.4685"
                                stroke="white"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                    </svg>
                </a>
            <?php endif; ?>

            <?php
            $languages = apply_filters('wpml_active_languages', null, array('skip_missing' => 0));

            if (!empty($languages)) :
                ?>
                <div class="<?php echo $base_class . '__header-langs'; ?>"
                     aria-label="<?php echo esc_attr__('Language switcher', 'jn'); ?>"
                >
                    <div class="<?php echo $base_class . '__header-langs-active'; ?>">
                        <?php foreach ($languages as $lang) : ?>
                            <?php if ($lang['active']) {
                                if (!empty($lang['country_flag_url'])) {
                                    echo '<span class="wpml-lang-code" lang="' . esc_attr($lang['language_code']) . '">' . esc_html(strtoupper($lang['language_code'])) . '</span>';
                                    echo '<img src="' . esc_url($lang['country_flag_url']) . '" width="18" height="12" loading="lazy" alt="' . esc_attr($lang['translated_name']) . '" class="wpml-flag">';
                                }
                            }
                        endforeach;
                        ?>
                    </div>
                    <div class="<?php echo $base_class . '__header-langs-list-wrap'; ?>">
                        <ul class="<?php echo $base_class . '__header-langs-list'; ?>">
                            <?php
                            foreach ($languages as $lang) :
                                if (!$lang['active']) :
                                    if (!empty($lang['country_flag_url'])) : ?>
                                        <li>
                                            <a href="<?php echo esc_url($lang['url']); ?>"
                                               title="<?php echo esc_attr($lang['translated_name']); ?>"
                                               lang="<?php echo esc_attr($lang['language_code']); ?>"
                                            >
                                                <span><?php echo esc_html(strtoupper($lang['language_code'])); ?></span>
                                                <img src="<?php echo esc_url($lang['country_flag_url']); ?>"
                                                     alt="<?php echo esc_attr($lang['translated_name']); ?>"
                                                     loading="lazy"
                                                     width="18"
                                                     height="12"
                                                     class="wpml-flag">
                                            </a>
                                        </li>
                                    <?php
                                    endif;
                                endif;
                            endforeach;
                            ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</header>

<main role="main" itemscope itemtype="https://schema.org/WebPage" itemprop="mainEntity"
      aria-label="<?php echo esc_attr__('Primary content', 'jn'); ?>" tabindex="-1">
    <meta itemprop="name" content="<?php echo esc_html(get_the_title()); ?>">
    <meta itemprop="url" content="<?php echo esc_url(get_permalink()); ?>">
    <section <?php echo $wrapper_attributes; ?> role="region" aria-labelledby="hero-title" itemprop="mainContentOfPage">
        <div class="<?php echo $base_class . '__wrap-out'; ?>">
            <div class="<?php echo $base_class . '__bg'; ?>">
                <svg viewBox="0 0 1620 800" fill="none" aria-hidden="true">
                    <path d="M1620 60C1620 26.8629 1593.14 0 1560 0H60C26.8629 0 0 26.8629 0 60V740C0 773.137 26.863 800 60.0001 800H670.555C690.502 800 709.146 790.086 720.299 773.548L770.946 698.451C782.099 681.914 800.743 672 820.69 672H1560C1593.14 672 1620 645.137 1620 612V60Z"/>
                </svg>
            </div>
            <div class="<?php echo $base_class . '__wrap'; ?>">
                <div class="<?php echo $base_class . '__content'; ?>">
                    <div class="<?php echo $base_class . '__content-text'; ?>">
                        <?php if (!empty($title)) : ?>
                            <h1 class="<?php echo $base_class . '__title'; ?>" id="hero-title">
                                <?php echo wp_kses_post($title); ?>
                            </h1>
                        <?php endif; ?>
                        <?php if (!empty($description)) : ?>
                            <p class="<?php echo $base_class . '__text'; ?>">
                                <?php echo wp_kses_post($description); ?>
                            </p>
                        <?php endif; ?>

                        <div class="<?php echo $base_class . '__buttons'; ?>" itemscope
                             itemtype="https://schema.org/SoftwareApplication">
                            <meta itemprop="name" content="<?php echo esc_html(get_bloginfo('name')); ?>">
                            <meta itemprop="operatingSystem" content="iOS">
                            <a href="<?php echo esc_url($appstore_link); ?>" target="_blank" rel="noopener noreferrer"
                               aria-label="<?php echo esc_attr__('Download on the App Store', 'jn'); ?>"
                               itemprop="downloadUrl"
                            >
                                <svg aria-hidden="true" width="219" height="58" viewBox="0 0 219 58" fill="none">
                                    <rect width="219" height="58" rx="29" fill="#141416"/>
                                    <path
                                            d="M73.3863 30.0811C73.4033 28.7779 73.7537 27.5001 74.4049 26.3667C75.0561 25.2332 75.9869 24.2809 77.1107 23.5983C76.3968 22.591 75.4549 21.762 74.3599 21.1772C73.265 20.5924 72.047 20.2678 70.8029 20.2294C68.149 19.9542 65.5761 21.7983 64.2237 21.7983C62.8451 21.7983 60.7629 20.2567 58.5206 20.3023C57.0703 20.3486 55.6568 20.7652 54.418 21.5116C53.1791 22.2581 52.157 23.3088 51.4514 24.5615C48.3949 29.7895 50.6748 37.473 53.6027 41.699C55.0676 43.7683 56.7797 46.0798 59.0199 45.9979C61.2121 45.9081 62.0308 44.6169 64.6769 44.6169C67.2985 44.6169 68.0667 45.9979 70.3523 45.9458C72.7046 45.9081 74.1867 43.8672 75.6002 41.7783C76.6528 40.3038 77.4627 38.6742 78 36.9498C76.6334 36.3788 75.4671 35.4229 74.6467 34.2015C73.8262 32.98 73.3879 31.547 73.3863 30.0811Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M69.0691 17.4501C70.3517 15.929 70.9836 13.9739 70.8306 12C68.8711 12.2033 67.0611 13.1285 65.7612 14.5912C65.1256 15.3058 64.6389 16.1371 64.3287 17.0377C64.0185 17.9382 63.8911 18.8903 63.9536 19.8396C64.9337 19.8495 65.9033 19.6397 66.7894 19.2258C67.6755 18.8119 68.455 18.2047 69.0691 17.4501Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M88 12.8959H90.3434C92.3684 12.8959 93.3536 14.2265 93.3536 16.6402C93.3536 19.054 92.3585 20.401 90.3434 20.401H88V12.8959ZM89.1294 13.946V19.3509H90.219C91.5624 19.3509 92.1943 18.4546 92.1943 16.6567C92.1943 14.8478 91.5574 13.946 90.219 13.946H89.1294Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M96.9259 14.4904C98.2992 14.4904 99.2594 15.4746 99.2594 17.1076V17.8608C99.2594 19.5488 98.2992 20.5 96.9259 20.5C95.5328 20.5 94.5825 19.5598 94.5825 17.8663V17.1131C94.5825 15.5241 95.5477 14.4904 96.9259 14.4904ZM96.9309 15.4746C96.1448 15.4746 95.697 16.2003 95.697 17.1735V17.8223C95.697 18.7955 96.1149 19.5158 96.9309 19.5158C97.7369 19.5158 98.1499 18.801 98.1499 17.8223V17.1735C98.1499 16.2003 97.717 15.4746 96.9309 15.4746Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M107.369 14.5893L105.986 20.401H104.862L103.762 16.1124H103.732L102.653 20.401H101.523L100.08 14.5893H101.27L102.115 19.021H102.165L103.225 14.5893H104.265L105.354 19.021H105.404L106.265 14.5893H107.369Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M108.464 20.401V14.5893H109.549V15.634H109.603C109.738 15.1777 110.121 14.5014 111.186 14.5014C112.245 14.5014 112.957 15.1502 112.957 16.4753V20.401H111.852V16.8326C111.852 15.9474 111.434 15.5405 110.812 15.5405C109.996 15.5405 109.569 16.2333 109.569 17.1735V20.401H108.464Z"
                                            fill="white"
                                    />
                                    <path d="M114.629 20.401V12.5H115.733V20.401H114.629Z" fill="white"/>
                                    <path
                                            d="M119.524 14.4904C120.898 14.4904 121.858 15.4746 121.858 17.1076V17.8608C121.858 19.5488 120.898 20.5 119.524 20.5C118.131 20.5 117.181 19.5598 117.181 17.8663V17.1131C117.181 15.5241 118.146 14.4904 119.524 14.4904ZM119.529 15.4746C118.743 15.4746 118.295 16.2003 118.295 17.1735V17.8223C118.295 18.7955 118.713 19.5158 119.529 19.5158C120.335 19.5158 120.748 18.801 120.748 17.8223V17.1735C120.748 16.2003 120.315 15.4746 119.529 15.4746Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M124.719 20.489C123.699 20.489 122.997 19.7962 122.997 18.7131C122.997 17.6849 123.644 16.9921 124.858 16.9921H126.187V16.4478C126.187 15.7825 125.803 15.4691 125.196 15.4691C124.599 15.4691 124.331 15.744 124.246 16.1289H123.196C123.261 15.1557 123.923 14.5014 125.231 14.5014C126.356 14.5014 127.286 15.0182 127.286 16.4643V20.401H126.236V19.6478H126.187C125.953 20.0931 125.495 20.489 124.719 20.489ZM125.062 19.5433C125.689 19.5433 126.187 19.0704 126.187 18.4381V17.8113H125.032C124.39 17.8113 124.107 18.1687 124.107 18.6526C124.107 19.2574 124.565 19.5433 125.062 19.5433Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M130.689 14.5124C131.431 14.5124 131.998 14.8753 132.202 15.4636H132.257V12.5H133.361V20.401H132.286V19.4718H132.232C132.072 20.0601 131.441 20.478 130.674 20.478C129.465 20.478 128.679 19.5268 128.679 17.9928V16.9976C128.679 15.4636 129.48 14.5124 130.689 14.5124ZM130.998 15.5131C130.261 15.5131 129.804 16.1179 129.804 17.1735V17.8113C129.804 18.8725 130.266 19.4773 131.023 19.4773C131.769 19.4773 132.257 18.878 132.257 17.8883V17.0086C132.257 16.1124 131.724 15.5131 130.998 15.5131Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M139.426 14.4904C140.799 14.4904 141.76 15.4746 141.76 17.1076V17.8608C141.76 19.5488 140.799 20.5 139.426 20.5C138.033 20.5 137.083 19.5598 137.083 17.8663V17.1131C137.083 15.5241 138.048 14.4904 139.426 14.4904ZM139.431 15.4746C138.645 15.4746 138.197 16.2003 138.197 17.1735V17.8223C138.197 18.7955 138.615 19.5158 139.431 19.5158C140.237 19.5158 140.65 18.801 140.65 17.8223V17.1735C140.65 16.2003 140.217 15.4746 139.431 15.4746Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M143.183 20.401V14.5893H144.267V15.634H144.322C144.456 15.1777 144.839 14.5014 145.904 14.5014C146.964 14.5014 147.675 15.1502 147.675 16.4753V20.401H146.571V16.8326C146.571 15.9474 146.153 15.5405 145.531 15.5405C144.715 15.5405 144.287 16.2333 144.287 17.1735V20.401H143.183Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M151.949 14.6278V13.1763H153.029V14.6278H154.208V15.5845H153.029V18.6691C153.029 19.3014 153.243 19.4773 153.835 19.4773C153.984 19.4773 154.183 19.4663 154.268 19.4553V20.39C154.178 20.4065 153.81 20.4395 153.561 20.4395C152.283 20.4395 151.934 19.9337 151.934 18.768V15.5845H151.133V14.6278H151.949Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M155.601 20.401V12.5H156.701V15.634H156.756C156.87 15.2216 157.298 14.5014 158.353 14.5014C159.378 14.5014 160.109 15.1557 160.109 16.4808V20.401H159.01V16.8381C159.01 15.9529 158.567 15.5405 157.94 15.5405C157.149 15.5405 156.701 16.2278 156.701 17.1735V20.401H155.601Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M163.816 20.5C162.383 20.5 161.492 19.5268 161.492 17.8883V17.1021C161.492 15.4526 162.467 14.4904 163.751 14.4904C165.07 14.4904 166 15.5021 166 17.1021V17.7838H162.587V18.0698C162.587 18.9055 163.035 19.5213 163.811 19.5213C164.388 19.5213 164.786 19.2189 164.861 18.856H165.94C165.876 19.5268 165.234 20.5 163.816 20.5ZM162.587 16.9866H164.92V16.9096C164.92 16.0354 164.458 15.4526 163.756 15.4526C163.055 15.4526 162.587 16.0354 162.587 16.9096V16.9866Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M90.2386 41.0825H88L92.5548 27.7921H95.0163L99.5615 41.0825H97.2356L96.063 37.4021H91.421L90.2386 41.0825ZM93.7953 30.0899H93.7081L91.9152 35.7079H95.5687L93.7953 30.0899Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M105.74 41.2285C104.412 41.2285 103.404 40.5956 102.862 39.6512H102.784V44.5H100.633V30.791H102.726V32.3001H102.803C103.365 31.3167 104.412 30.6546 105.788 30.6546C108.085 30.6546 109.723 32.3975 109.723 35.4742V36.3895C109.723 39.4467 108.104 41.2285 105.74 41.2285ZM105.246 39.4467C106.612 39.4467 107.542 38.3465 107.542 36.2726V35.5521C107.542 33.5561 106.67 32.417 105.207 32.417C103.705 32.417 102.765 33.6438 102.765 35.5424V36.2726C102.765 38.2199 103.714 39.4467 105.246 39.4467Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M116.676 41.2285C115.349 41.2285 114.341 40.5956 113.798 39.6512H113.721V44.5H111.569V30.791H113.662V32.3001H113.74C114.302 31.3167 115.349 30.6546 116.725 30.6546C119.022 30.6546 120.659 32.3975 120.659 35.4742V36.3895C120.659 39.4467 119.041 41.2285 116.676 41.2285ZM116.182 39.4467C117.549 39.4467 118.479 38.3465 118.479 36.2726V35.5521C118.479 33.5561 117.607 32.417 116.143 32.417C114.641 32.417 113.701 33.6438 113.701 35.5424V36.2726C113.701 38.2199 114.651 39.4467 116.182 39.4467Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M125.118 37.3923H127.269C127.366 38.5412 128.374 39.5246 130.244 39.5246C131.96 39.5246 132.977 38.7165 132.977 37.4605C132.977 36.4479 132.299 35.9026 130.884 35.5619L128.713 35.0166C127.008 34.6174 125.476 33.5951 125.476 31.4336C125.476 28.8923 127.686 27.5 130.254 27.5C132.822 27.5 134.964 28.8923 135.012 31.3751H132.9C132.803 30.2457 131.94 29.311 130.225 29.311C128.713 29.311 127.686 30.0315 127.686 31.268C127.686 32.1346 128.287 32.7577 129.518 33.0401L131.679 33.5756C133.665 34.0624 135.177 35.0069 135.177 37.2657C135.177 39.8751 133.074 41.3454 130.08 41.3454C126.397 41.3454 125.166 39.1838 125.118 37.3923Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M137.799 30.791V28.2887H139.911V30.791H141.908V32.5241H139.911V38.0155C139.911 39.1352 140.328 39.4467 141.481 39.4467C141.666 39.4467 141.84 39.4467 141.966 39.4273V41.0825C141.792 41.1117 141.385 41.1506 140.948 41.1506C138.458 41.1506 137.77 40.2549 137.77 38.1907V32.5241H136.355V30.791H137.799Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M147.718 30.6157C150.664 30.6157 152.263 32.6993 152.263 35.5034V36.331C152.263 39.2325 150.674 41.2577 147.718 41.2577C144.762 41.2577 143.153 39.2325 143.153 36.331V35.5034C143.153 32.709 144.772 30.6157 147.718 30.6157ZM147.718 32.3488C146.119 32.3488 145.324 33.6632 145.324 35.5326V36.3213C145.324 38.1615 146.109 39.5149 147.718 39.5149C149.327 39.5149 150.102 38.1712 150.102 36.3213V35.5326C150.102 33.6535 149.317 32.3488 147.718 32.3488Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M154.08 41.0825V30.791H156.232V32.1443H156.309C156.571 31.5017 157.337 30.6449 158.761 30.6449C159.042 30.6449 159.284 30.6644 159.488 30.7033V32.6117C159.304 32.563 158.926 32.5338 158.567 32.5338C156.842 32.5338 156.261 33.6048 156.261 34.9874V41.0825H154.08Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M164.707 41.2577C161.964 41.2577 160.22 39.437 160.22 36.3895V35.3477C160.22 32.4754 161.926 30.6157 164.62 30.6157C167.353 30.6157 169 32.5435 169 35.445V36.4284H162.342V36.6718C162.342 38.4049 163.273 39.5538 164.736 39.5538C165.831 39.5538 166.577 39.0086 166.839 38.1226H168.884C168.574 39.7875 167.236 41.2577 164.707 41.2577ZM162.342 34.9192H166.897V34.8998C166.897 33.4393 165.996 32.2904 164.629 32.2904C163.243 32.2904 162.342 33.4393 162.342 34.8998V34.9192Z"
                                            fill="white"
                                    />
                                </svg>
                            </a>
                            <meta itemprop="operatingSystem" content="Android">
                            <a href="<?php echo esc_url($google_play_link); ?>" target="_blank"
                               rel="noopener noreferrer"
                               aria-label="<?php echo esc_attr__('Get it on Google Play', 'jn'); ?>"
                               itemprop="downloadUrl"
                            >
                                <svg aria-hidden="true" width="219" height="58" viewBox="0 0 219 58" fill="none">
                                    <rect width="219" height="58" rx="29" fill="#141416"/>
                                    <path
                                            d="M64.0069 28.2374L50.128 43.1751C50.1293 43.1777 50.1293 43.1817 50.1306 43.1843C50.5569 44.8063 52.0168 46 53.7506 46C54.444 46 55.0945 45.8096 55.6524 45.4765L55.6968 45.4501L71.3185 36.309L64.0069 28.2374Z"
                                            fill="#EA4335"
                                    />
                                    <path
                                            d="M78.0473 25.6937L78.0342 25.6845L71.2897 21.7201L63.6913 28.5769L71.317 36.3074L78.0251 32.3827C79.2009 31.7376 80 30.4804 80 29.0316C80 27.5907 79.2126 26.3402 78.0473 25.6937Z"
                                            fill="#FBBC04"
                                    />
                                    <path
                                            d="M50.1277 14.8238C50.0443 15.1358 50 15.4637 50 15.8021V42.1982C50 42.5366 50.0443 42.8644 50.1291 43.175L64.4837 28.6194L50.1277 14.8238Z"
                                            fill="#4285F4"
                                    />
                                    <path
                                            d="M64.1094 28.9999L71.2919 21.7174L55.6884 12.5433C55.1214 12.1983 54.4592 12 53.7514 12C52.0176 12 50.5551 13.1963 50.1288 14.8197C50.1288 14.821 50.1275 14.8223 50.1275 14.8236L64.1094 28.9999Z"
                                            fill="#34A853"
                                    />
                                    <path
                                            d="M96.7352 17.3489C96.7352 18.5521 96.3773 19.5107 95.6614 20.2246C94.8571 21.0749 93.7994 21.5 92.4883 21.5C91.2335 21.5 90.1717 21.0668 89.303 20.2005C88.4343 19.3342 88 18.2674 88 17C88 15.7326 88.4343 14.6658 89.303 13.7995C90.1717 12.9332 91.2335 12.5 92.4883 12.5C93.1237 12.5 93.7229 12.6123 94.286 12.8369C94.849 13.0615 95.3115 13.3783 95.6735 13.7874L94.8772 14.5816C94.6117 14.2607 94.2659 14.012 93.8396 13.8356C93.4213 13.6511 92.9709 13.5588 92.4883 13.5588C91.5472 13.5588 90.7509 13.8837 90.0993 14.5334C89.4559 15.1912 89.1341 16.0134 89.1341 17C89.1341 17.9866 89.4559 18.8088 90.0993 19.4666C90.7509 20.1163 91.5472 20.4412 92.4883 20.4412C93.3489 20.4412 94.0648 20.2005 94.6359 19.7193C95.207 19.238 95.5367 18.5762 95.6252 17.734H92.4883V16.6992H96.6749C96.7151 16.9238 96.7352 17.1404 96.7352 17.3489Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M103.127 12.6925V13.7513H99.1939V16.4826H102.741V17.5174H99.1939V20.2487H103.127V21.3075H98.0839V12.6925H103.127Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M107.567 13.7513V21.3075H106.457V13.7513H104.044V12.6925H109.98V13.7513H107.567Z"
                                            fill="white"
                                    />
                                    <path d="M114.9 21.3075H113.79V12.6925H114.9V21.3075Z" fill="white"/>
                                    <path
                                            d="M119.585 13.7513V21.3075H118.475V13.7513H116.062V12.6925H121.998V13.7513H119.585Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M134.03 17C134.03 18.2754 133.604 19.3422 132.751 20.2005C131.891 21.0668 130.837 21.5 129.59 21.5C128.335 21.5 127.282 21.0668 126.429 20.2005C125.576 19.3422 125.15 18.2754 125.15 17C125.15 15.7246 125.576 14.6578 126.429 13.7995C127.282 12.9332 128.335 12.5 129.59 12.5C130.845 12.5 131.899 12.9372 132.751 13.8115C133.604 14.6698 134.03 15.7326 134.03 17ZM126.284 17C126.284 17.9947 126.598 18.8168 127.225 19.4666C127.861 20.1163 128.649 20.4412 129.59 20.4412C130.531 20.4412 131.315 20.1163 131.943 19.4666C132.578 18.8249 132.896 18.0027 132.896 17C132.896 15.9973 132.578 15.1751 131.943 14.5334C131.315 13.8837 130.531 13.5588 129.59 13.5588C128.649 13.5588 127.861 13.8837 127.225 14.5334C126.598 15.1832 126.284 16.0053 126.284 17Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M136.45 21.3075H135.34V12.6925H136.691L140.89 19.3944H140.938L140.89 17.734V12.6925H142V21.3075H140.842L136.45 14.2807H136.402L136.45 15.9412V21.3075Z"
                                            fill="white"
                                    />
                                    <path
                                            d="M150.959 40.6703H152.742V28.9247H150.959V40.6703ZM167.017 33.1556L164.974 38.2481H164.913L162.791 33.1556H160.871L164.052 40.2729L162.239 44.2322H164.098L169 33.1556H167.017ZM156.907 39.3361C156.322 39.3361 155.508 39.0495 155.508 38.3383C155.508 37.4325 156.522 37.0849 157.398 37.0849C158.181 37.0849 158.551 37.2512 159.027 37.4776C158.888 38.5657 157.936 39.3361 156.907 39.3361ZM157.122 32.8991C155.831 32.8991 154.493 33.4581 153.941 34.6974L155.523 35.3467C155.861 34.6974 156.491 34.4851 157.152 34.4851C158.074 34.4851 159.012 35.0291 159.027 35.9969V36.1171C158.704 35.9358 158.013 35.6642 157.168 35.6642C155.462 35.6642 153.725 36.586 153.725 38.3082C153.725 39.8801 155.124 40.893 156.691 40.893C157.89 40.893 158.551 40.364 158.966 39.7439H159.027V40.6506H160.748V36.1472C160.748 34.0623 159.165 32.8991 157.122 32.8991ZM146.103 34.5856H143.568V30.5595H146.103C147.436 30.5595 148.193 31.6448 148.193 32.5721C148.193 33.4826 147.436 34.5856 146.103 34.5856ZM146.058 28.9247H141.786V40.6703H143.568V36.2205H146.058C148.033 36.2205 149.976 34.813 149.976 32.5721C149.976 30.3312 148.033 28.9247 146.058 28.9247ZM122.762 39.338C121.531 39.338 120.5 38.3242 120.5 36.9317C120.5 35.5243 121.531 34.4945 122.762 34.4945C123.979 34.4945 124.932 35.5243 124.932 36.9317C124.932 38.3242 123.979 39.338 122.762 39.338ZM124.81 33.8133H124.748C124.348 33.3444 123.578 32.9207 122.609 32.9207C120.576 32.9207 118.714 34.6758 118.714 36.9317C118.714 39.1717 120.576 40.9127 122.609 40.9127C123.578 40.9127 124.348 40.489 124.748 40.0041H124.81V40.5801C124.81 42.1088 123.979 42.9262 122.639 42.9262C121.546 42.9262 120.869 42.1539 120.592 41.5028L119.037 42.1389C119.483 43.1987 120.669 44.5 122.639 44.5C124.733 44.5 126.503 43.2889 126.503 40.3377V33.1622H124.81V33.8133ZM127.735 40.6703H129.52V28.9237H127.735V40.6703ZM132.152 36.7955C132.106 35.2518 133.368 34.4644 134.276 34.4644C134.985 34.4644 135.585 34.8121 135.784 35.3119L132.152 36.7955ZM137.693 35.4632C137.355 34.5706 136.323 32.9207 134.215 32.9207C132.121 32.9207 130.382 34.5396 130.382 36.9167C130.382 39.1566 132.106 40.9127 134.414 40.9127C136.277 40.9127 137.355 39.7927 137.801 39.1416L136.416 38.233C135.954 38.8992 135.323 39.338 134.414 39.338C133.507 39.338 132.86 38.9293 132.444 38.1278L137.878 35.917L137.693 35.4632ZM94.4035 34.1468V35.8418H98.5282C98.405 36.7955 98.082 37.4917 97.5899 37.9756C96.989 38.5666 96.0497 39.2177 94.4035 39.2177C91.8629 39.2177 89.8775 37.2042 89.8775 34.7068C89.8775 32.2085 91.8629 30.1959 94.4035 30.1959C95.7736 30.1959 96.774 30.7259 97.5126 31.407L98.7289 30.211C97.697 29.2423 96.3278 28.5 94.4035 28.5C90.9247 28.5 88 31.2858 88 34.7068C88 38.1278 90.9247 40.9127 94.4035 40.9127C96.281 40.9127 97.697 40.3067 98.8053 39.1717C99.9452 38.0517 100.299 36.4779 100.299 35.2057C100.299 34.8121 100.268 34.4494 100.206 34.1468H94.4035ZM104.989 39.338C103.757 39.338 102.695 38.3392 102.695 36.9167C102.695 35.4782 103.757 34.4945 104.989 34.4945C106.22 34.4945 107.282 35.4782 107.282 36.9167C107.282 38.3392 106.22 39.338 104.989 39.338ZM104.989 32.9207C102.741 32.9207 100.909 34.6007 100.909 36.9167C100.909 39.2177 102.741 40.9127 104.989 40.9127C107.236 40.9127 109.068 39.2177 109.068 36.9167C109.068 34.6007 107.236 32.9207 104.989 32.9207ZM113.887 39.338C112.656 39.338 111.593 38.3392 111.593 36.9167C111.593 35.4782 112.656 34.4945 113.887 34.4945C115.119 34.4945 116.18 35.4782 116.18 36.9167C116.18 38.3392 115.119 39.338 113.887 39.338ZM113.887 32.9207C111.64 32.9207 109.808 34.6007 109.808 36.9167C109.808 39.2177 111.64 40.9127 113.887 40.9127C116.134 40.9127 117.966 39.2177 117.966 36.9167C117.966 34.6007 116.134 32.9207 113.887 32.9207Z"
                                            fill="white"
                                    />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <?php if ($image['id']) : ?>
                        <figure class="<?php echo $base_class . '__content-image'; ?>" itemscope
                                itemtype="https://schema.org/ImageObject">
                            <?php
                            get_template_part('/template-parts/advanced-image', null, array(
                                'img_id' => $image['id'],
                                'class' => '',
                                'is_schema' => true,
                                'decorative' => false,
                            ));
                            ?>
                        </figure>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>