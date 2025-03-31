<?php
/**
 * Template file for single.php
 *
 * This file is part of the Journeyo theme.
 *
 * @package Journeyo
 */
 
declare(strict_types=1);?>

    <main class="site-main">
        <?php
        while ( have_posts() ) :
            the_content();
        endwhile;
        ?>
    </main>

<?php
get_footer();