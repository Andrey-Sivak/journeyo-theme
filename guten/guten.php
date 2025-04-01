<?php
function journeyo_custom_gutenberg_block_init(): void
{

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
