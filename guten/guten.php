<?php
function journeyo_custom_gutenberg_block_init(): void
{
    register_block_type(__DIR__ . '/build/hero-section');
    register_block_type(__DIR__ . '/build/benefits-section');
    register_block_type(__DIR__ . '/build/plan-section');
    register_block_type(__DIR__ . '/build/reviews-section');
    register_block_type(__DIR__ . '/build/promo-banner-section');
    register_block_type(__DIR__ . '/build/team-section');
}

add_action('init', 'journeyo_custom_gutenberg_block_init');

//function journeyo_enqueue_regenerator_runtime()
//{
//    wp_enqueue_script(
//        'regenerator-runtime',
//        'https://cdnjs.cloudflare.com/ajax/libs/regenerator-runtime/0.13.7/regenerator-runtime.min.js',
//        array('wp-polyfill'),
//        '0.13.7',
//        true
//    );
//}

//add_action('wp_enqueue_scripts', 'journeyo_enqueue_regenerator_runtime');
