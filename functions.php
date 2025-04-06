<?php
/**
 * Theme functions and definitions
 *
 * This file sets up the theme by registering features, enqueuing assets, and defining
 * utility functions. It is loaded automatically by WordPress on every page load.
 *
 * @package journeyo
 */

declare(strict_types=1);

/**
 * The journeyo functions and definitions
 */

define('_JN_VERSION', '1.0.22');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function journeyo_setup(): void {
	// Make theme available for translation.
	load_theme_textdomain( 'jn', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'jn' ),
		),
	);

	// Switch core markup to HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		),
	);
}
add_action('after_setup_theme', 'journeyo_setup');

/**
 * Get ajax url
 *
 * @return string
 */
function journeyo_get_ajax_url(): string {
	return get_template_directory_uri() . '/inc/front-ajax.php';
}

/**
 * Enqueue scripts and styles.
 */
function journeyo_scripts(): void {
	$ajax_url = journeyo_get_ajax_url();

	$journeyo_options = array(
		'ajax_url' => $ajax_url,
		'home_url' => get_home_url(),
	);

	wp_dequeue_style( 'select2' );
	wp_dequeue_script( 'select2' );
	wp_deregister_script( 'select2' );

	wp_dequeue_script( 'jquery' );
	wp_deregister_script( 'jquery' );

	wp_enqueue_style( 'journeyo-style', get_stylesheet_uri(), array(), _JN_VERSION );
	wp_enqueue_style( 'journeyo-main-style', get_template_directory_uri() . '/dist/css/style.min.css', array(), _JN_VERSION );
	wp_enqueue_style( 'fonts-style', get_template_directory_uri() . '/fonts/fonts.css', array(), _JN_VERSION );

    $manifest_path = get_template_directory() . '/dist/js/manifest.json';

    if ( file_exists( $manifest_path ) ) {
        $manifest = json_decode( file_get_contents( $manifest_path ), true );

        if ( is_array( $manifest ) && !empty( $manifest ) ) {
            foreach ( $manifest as $file ) {
                if ( str_contains( $file, '.js' ) ) {
                    $chunk_handle = 'app-chunk-' . basename( $file, '.js' );
                    $chunk_handle = str_replace( '.chunk', '', $chunk_handle );

                    wp_enqueue_script( $chunk_handle, get_template_directory_uri() . $file, array(), _JN_VERSION, true );

                    if ( str_contains( $file, 'app.min.js' ) ) {
                        wp_localize_script( $chunk_handle, 'options', $journeyo_options );
                    }
                }
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'journeyo_scripts' );

add_action('enqueue_block_assets', function () {
    wp_enqueue_style('journeyo-admin-style', get_template_directory_uri() . '/dist/css/journeyo-admin.min.css', array(), _JN_VERSION);
    wp_enqueue_style('fonts-style', get_template_directory_uri() . '/fonts/fonts.css', array(), _JN_VERSION);
});

require get_template_directory() . '/guten/guten.php';

require_once __DIR__ . '/vendor/autoload.php';

use WebPConvert\WebPConvert;

function convert_to_webp($attachment_id): void {
    $file = get_attached_file($attachment_id);
    $file_info = pathinfo($file);
    $allowed_types = array('image/jpeg', 'image/png');

    // Check if the file is an allowed image type
    if (!in_array(get_post_mime_type($attachment_id), $allowed_types)) {
        return;
    }

    $webp_file = $file_info['dirname'] . '/' . $file_info['filename'] . '.webp';

    // Convert image to WebP
    try {
        WebPConvert::convert($file, $webp_file, [
            'quality' => 'auto',
            'max-quality' => 80,
            'converters' => ['cwebp', 'gd', 'imagick', 'wpc', 'ewww'],
        ]);
    } catch (\Exception $e) {
        // Log error or handle it as needed
        error_log('WebP conversion failed: ' . $e->getMessage());
        return;
    }

    // Add the WebP version to the media library
    $wp_filetype = wp_check_filetype($webp_file, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($file_info['filename'] . '.webp'),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $webp_file);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $webp_file);
    wp_update_attachment_metadata($attach_id, $attach_data);
}

add_action('add_attachment', 'convert_to_webp');

function serve_webp_image($attachment_id, $size = 'full')
{
    $image_url = wp_get_attachment_image_url($attachment_id, $size);
    $upload_dir = wp_upload_dir();
    $file_path = str_replace($upload_dir['baseurl'], $upload_dir['basedir'], $image_url);

    $webp_file = pathinfo($file_path, PATHINFO_DIRNAME) . '/' . pathinfo($file_path, PATHINFO_FILENAME) . '.webp';
    $webp_url = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $webp_file);

    if (file_exists($webp_file)) {
        return $webp_url;
    }

    return $image_url;
}

function filter_out_webp_duplicates($query): void
{
    // Check if we're in the admin area and it's a query for attachments
    if (!is_admin() || $query->get('post_type') !== 'attachment') {
        return;
    }

    // Add our meta query to filter out WebP images
    $meta_query = $query->get('meta_query', array());
    $meta_query[] = array(
        'relation' => 'OR',
        array(
            'key' => '_wp_attached_file',
            'value' => '.webp',
            'compare' => 'NOT LIKE'
        ),
        array(
            'key' => '_wp_attached_file',
            'compare' => 'NOT EXISTS'
        )
    );
    $query->set('meta_query', $meta_query);
}
add_action('pre_get_posts', 'filter_out_webp_duplicates');


// TODO: fix all deletions
function cleanup_webp_on_delete($attachment_id): void
{
    // Get the file path of the deleted attachment
    $file = get_attached_file($attachment_id);

    if (!$file) {
        error_log("Unable to get file path for attachment ID: $attachment_id");
        return;
    }

    // Get file info
    $file_info = pathinfo($file);
    $file_dir = $file_info['dirname'];
    $file_name = $file_info['filename'];

    // Get all files in the directory
    $all_files = scandir($file_dir);

    // Filter and delete all WebP files that start with the original filename
    foreach ($all_files as $file) {
        if (str_starts_with($file, $file_name) && str_contains($file, '.webp')) {
            $webp_file = $file_dir . '/' . $file;
            if (unlink($webp_file)) {
                error_log("Successfully deleted WebP file: $webp_file");
            } else {
                error_log("Failed to delete WebP file: $webp_file");
            }
        }
    }

    // Remove WebP versions from the media library
    $args = array(
        'post_type' => 'attachment',
        'post_status' => 'any',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_wp_attached_file',
                'value' => $file_name . '-.+\.webp',
                'compare' => 'REGEXP'
            )
        )
    );

    $webp_query = new WP_Query($args);

    if ($webp_query->have_posts()) {
        foreach ($webp_query->posts as $webp_attachment) {
            wp_delete_attachment($webp_attachment->ID, true);
            error_log("Deleted WebP attachment from media library with ID: {$webp_attachment->ID}");
        }
    }
}

add_action('delete_attachment', 'cleanup_webp_on_delete');