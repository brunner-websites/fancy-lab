<?php

/**
 * Template for the sidebar containing the MAIN widget area
 *
 * @package Fancy Lab
 */
?>

<?php if (is_active_sidebar('fancy-lab-sidebar-main')) : ?>
  <aside class="col-lg-3 col-md-4 col-12 h-100">
    <?php dynamic_sidebar('fancy-lab-sidebar-main'); ?>
  </aside>
<?php endif;
