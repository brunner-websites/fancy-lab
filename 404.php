<?php

/**
 * The main template for showing archive pages (searches by author, date or category)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Fancy Lab
 */

get_header();
?>
<div class="content-area">
  <main>
    <div class="container">
      <div class="error-404">
        <header>
          <h1><?php esc_html_e('Page not found', 'fancy-lab'); ?></h1>
          <p><?php esc_html_e('Unfortunately the page you searched does not exist', 'fancy-lab'); ?></p>
        </header>
        <?php
        the_widget('WP_Widget_Recent_Posts', array(
          'title'   => esc_html__('Take a Look at Our Latests Posts', 'fancy-lab'),
          'number'  => 3,
        ));
        ?>
      </div>
    </div>
  </main>
</div>
<?php
get_footer();
?>