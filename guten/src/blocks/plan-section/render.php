<?php
$title = $attributes['title'] ?? '';
$subtitle = $attributes['subtitle'] ?? '';
$items = $attributes['items'] ?? [];

$wrapper_attributes = get_block_wrapper_attributes();
$base_class = 'wp-block-journeyo-plan-section';
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
            <div class="<?php echo $base_class . '__items'; ?>">
                <svg viewBox="0 0 1434 452" fill="none" class="<?php echo $base_class . '__items-bg'; ?>">
                    <path d="M535.165 314.633L579.098 390.731C592.714 414.314 617.876 428.842 645.107 428.842H791.032C818.263 428.842 843.425 414.314 857.04 390.731L1048.17 61.7528C1061.79 38.1626 1086.95 23.6357 1114.19 23.6357H1260.12C1287.34 23.6357 1312.5 38.1626 1326.12 61.7528L1399.08 188.126C1412.7 211.717 1412.7 240.77 1399.08 264.349L1326.12 390.734C1312.5 414.313 1287.34 428.84 1260.12 428.84H1114.19C1086.95 428.84 1061.79 414.313 1048.17 390.734L1005.04 315.546M898.649 137.844L854.715 61.7458C841.1 38.1626 815.938 23.6345 788.707 23.6345H642.782C615.551 23.6345 590.389 38.1626 576.773 61.7458L385.639 390.725C372.021 414.315 346.859 428.842 319.624 428.842H173.696C146.472 428.842 121.31 414.315 107.692 390.725L34.7341 264.351C21.1163 240.761 21.1163 211.707 34.7341 188.129L107.692 61.7435C121.31 38.1649 146.472 23.638 173.696 23.638H319.624C346.859 23.638 372.021 38.1649 385.639 61.7435L431.808 137.718"
                          stroke="url(#paint0_linear_52_377)" stroke-width="40" stroke-miterlimit="10"
                          stroke-linecap="round"/>
                    <path d="M1255.68 41H1122.33C1097.44 41 1074.45 54.2659 1062.01 75.7999L995.332 191.2C982.889 212.734 982.889 239.266 995.332 260.8L1062.01 376.2C1074.45 397.734 1097.44 411 1122.33 411H1255.68C1280.56 411 1303.55 397.734 1315.99 376.2L1382.67 260.8C1395.11 239.266 1395.11 212.734 1382.67 191.2L1315.99 75.7999C1303.55 54.2647 1280.56 41 1255.68 41Z"
                          fill="url(#paint1_linear_52_377)"/>
                    <path d="M1252.96 48.5237H1125.04C1101.17 48.5237 1079.11 61.2502 1067.17 81.9083L1003.21 192.616C991.273 213.274 991.273 238.727 1003.21 259.385L1067.17 370.092C1079.11 390.75 1101.17 403.477 1125.04 403.477H1252.96C1276.84 403.477 1298.89 390.75 1310.83 370.092L1374.79 259.385C1386.73 238.727 1386.73 213.274 1374.79 192.616L1310.83 81.9083C1298.89 61.2502 1276.84 48.5237 1252.96 48.5237Z"
                          fill="white"/>
                    <path d="M783.675 41H650.325C625.442 41 602.447 54.2659 590.006 75.7999L523.332 191.2C510.889 212.734 510.889 239.266 523.332 260.8L590.006 376.2C602.449 397.734 625.442 411 650.325 411H783.675C808.559 411 831.553 397.734 843.994 376.2L910.668 260.8C923.111 239.266 923.111 212.734 910.668 191.2L843.994 75.7999C831.553 54.2647 808.559 41 783.675 41Z"
                          fill="url(#paint2_linear_52_377)"/>
                    <path d="M780.963 48.5237H653.037C629.165 48.5237 607.107 61.2502 595.171 81.9083L531.208 192.616C519.273 213.274 519.273 238.727 531.208 259.385L595.171 370.092C607.106 390.75 629.165 403.477 653.037 403.477H780.963C804.835 403.477 826.893 390.75 838.829 370.092L902.792 259.385C914.727 238.727 914.727 213.274 902.792 192.616L838.829 81.9083C826.893 61.2502 804.835 48.5237 780.963 48.5237Z"
                          fill="white"/>
                    <path d="M311.674 41H178.325C153.442 41 130.447 54.2659 118.006 75.7999L51.3318 191.2C38.8894 212.734 38.8894 239.266 51.3318 260.8L118.006 376.2C130.448 397.734 153.442 411 178.325 411H311.675C336.558 411 359.553 397.734 371.994 376.2L438.668 260.8C451.111 239.266 451.111 212.734 438.668 191.2L371.994 75.7999C359.551 54.2647 336.557 41 311.674 41Z"
                          fill="url(#paint3_linear_52_377)"/>
                    <path d="M308.962 48.5237H181.036C157.164 48.5237 135.106 61.2502 123.169 81.9083L59.2069 192.616C47.2715 213.274 47.2715 238.727 59.2069 259.385L123.169 370.092C135.105 390.75 157.164 403.477 181.036 403.477H308.962C332.834 403.477 354.892 390.75 366.828 370.092L430.791 259.385C442.726 238.727 442.726 213.274 430.791 192.616L366.828 81.9083C354.893 61.2502 332.834 48.5237 308.962 48.5237Z"
                          fill="white"/>
                    <defs>
                        <linearGradient id="paint0_linear_52_377" x1="737" y1="-13.9999" x2="741" y2="674"
                                        gradientUnits="userSpaceOnUse">
                            <stop stop-color="#FFCE08"/>
                            <stop offset="1" stop-color="#FF760E"/>
                        </linearGradient>
                        <linearGradient id="paint1_linear_52_377" x1="1048.67" y1="85.7707" x2="1329.13" y2="366.433"
                                        gradientUnits="userSpaceOnUse">
                            <stop stop-color="white"/>
                            <stop offset="0.2964" stop-color="#F6F7F7"/>
                            <stop offset="0.773" stop-color="#DFE0E1"/>
                            <stop offset="1" stop-color="#D1D3D4"/>
                        </linearGradient>
                        <linearGradient id="paint2_linear_52_377" x1="576.669" y1="85.7707" x2="857.128" y2="366.433"
                                        gradientUnits="userSpaceOnUse">
                            <stop stop-color="white"/>
                            <stop offset="0.2964" stop-color="#F6F7F7"/>
                            <stop offset="0.773" stop-color="#DFE0E1"/>
                            <stop offset="1" stop-color="#D1D3D4"/>
                        </linearGradient>
                        <linearGradient id="paint3_linear_52_377" x1="104.668" y1="85.7707" x2="385.127" y2="366.433"
                                        gradientUnits="userSpaceOnUse">
                            <stop stop-color="white"/>
                            <stop offset="0.2964" stop-color="#F6F7F7"/>
                            <stop offset="0.773" stop-color="#DFE0E1"/>
                            <stop offset="1" stop-color="#D1D3D4"/>
                        </linearGradient>
                    </defs>
                </svg>

                <div class="<?php echo $base_class . '__items-wrap'; ?>">
                    <?php foreach ($items as $index => $item) : ?>
                        <article class="<?php echo $base_class . '__item'; ?>">

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
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>