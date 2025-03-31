<?php
/**
 * Template file for 404.php
 *
 * This file is part of the Journeyo theme.
 *
 * @package Journeyo
 */
 
declare(strict_types=1);?>

    <main class="site-main">
        <header class="">
            <h1 class="">
                <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rl' ); ?>
            </h1>
        </header>
    </main>

<?php
get_footer();