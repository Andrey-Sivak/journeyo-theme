<?php
/**
 * Template file for archive.php
 *
 * This file is part of the Journeyo theme.
 *
 * @package Journeyo
 */
 
declare(strict_types=1);?>

    <main class="site-main">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                get_template_part('/template-parts/post', 'card');
            endwhile;
        endif;
        ?>
    </main>

<?php
get_footer();