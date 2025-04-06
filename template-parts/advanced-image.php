<?php
$img_id = $args['img_id'];
$img_class = $args['class'];

if ($img_id) :
    $image_url = wp_get_attachment_url($img_id);
    $file_ext = pathinfo($image_url, PATHINFO_EXTENSION);

    $image_alt = get_post_meta($img_id, '_wp_attachment_image_alt', true);

    if (strtolower($file_ext) === 'svg') :
        $meta = wp_get_attachment_metadata($img_id);
        $width = $meta['width'];
        $height = $meta['height'];
        ?>
        <img src="<?php echo esc_url($image_url); ?>"
             alt="<?php echo esc_attr($image_alt); ?>"
             width="<?php echo esc_attr($width); ?>"
             height="<?php echo esc_attr($height); ?>"
             loading="lazy"
             class="<?php echo esc_attr($img_class); ?>">
    <?php
    else :
        $image_sizes = ['medium', 'large', 'full'];
        $original_srcset = [];
        $webp_srcset = [];
        $sizes = [];

        foreach ($image_sizes as $size) {
            $original_image = wp_get_attachment_image_src($img_id, $size);

            if ($original_image) {
                $original_srcset[] = $original_image[0] . ' ' . $original_image[1] . 'w';

                $webp_url = preg_replace('/\.(jpe?g|png)$/i', '.webp', $original_image[0]);
                $webp_srcset[] = $webp_url . ' ' . $original_image[1] . 'w';

                $sizes[] = '(max-width: ' . $original_image[1] . 'px) 100vw';
            }
        }

        $default_image = wp_get_attachment_image_src($img_id, 'large');
        $default_url = $default_image[0];
        $webp_default_url = preg_replace('/\.(jpe?g|png)$/i', '.webp', $default_url);
        $width = $default_image[1];
        $height = $default_image[2];

        $original_srcset_attr = implode(', ', $original_srcset);
        $webp_srcset_attr = implode(', ', $webp_srcset);
        $sizes_attr = implode(', ', array_reverse($sizes)) . ', 100vw';
        ?>
        <picture>
            <source srcset="<?php echo esc_attr($webp_srcset_attr); ?>"
                    sizes="<?php echo esc_attr($sizes_attr); ?>"
                    type="image/webp">
            <source srcset="<?php echo esc_attr($original_srcset_attr); ?>"
                    sizes="<?php echo esc_attr($sizes_attr); ?>"
                    type="image/<?php echo pathinfo($default_url, PATHINFO_EXTENSION); ?>">
            <img src="<?php echo esc_url($webp_default_url); ?>"
                 srcset="<?php echo esc_attr($webp_srcset_attr); ?>"
                 sizes="<?php echo esc_attr($sizes_attr); ?>"
                 alt="<?php echo esc_attr($image_alt); ?>"
                 width="<?php echo esc_attr($width); ?>"
                 height="<?php echo esc_attr($height); ?>"
                 loading="lazy"
                 class="<?php echo esc_attr($img_class); ?>">
        </picture>
    <?php endif; ?>
<?php endif; ?>