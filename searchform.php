<?php

/**
 * Template for displaying search forms in Fancy Lab
 *
 * @package Fancy Lab
 */
/*
global $wp_query;
var_dump($wp_query->query);
*/
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'fancy-lab'); ?>" value="<?php echo get_search_query(); ?>" name="s" />

  <button type="submit" class="search-submit"> </button>
  <span class="screen-reader-text">
    <?php echo _x('Search', 'submit button', 'fancy-lab'); ?>
  </span>

  <!-- If WooCommerce plugin is active -->
  <?php if (class_exists('WooCommerce')) : ?>
    <!-- Only search for products (post_type = product) -->
    <input type="hidden" value="product" name="post_type" id="post_type">
  <?php endif; ?>

</form>