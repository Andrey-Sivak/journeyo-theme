<?php
/**
 * The header template for the theme
 *
 * This file contains the HTML head section, opening body tag, and top-level site markup
 * such as the site header and navigation. It is included in all front-end pages via get_header().
 *
 * @package {themeName}
 */

declare(strict_types=1);

$journeyo_body_class = '';
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class( $journeyo_body_class ); ?> itemscope itemtype="https://schema.org/WebSite">
<?php wp_body_open(); ?>
<meta itemprop="name" content="<?php echo esc_html(get_bloginfo('name')); ?>">
<meta itemprop="url" content="<?php echo get_home_url(); ?>">
