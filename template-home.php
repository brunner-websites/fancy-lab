<?php

/*
Template Name: Home Page
*/

get_header(); ?>

<div class="content-area">
  <main>
    <section class="slider">
      <div class="flexslider">
        <ul class="slides">
          <?php
          for ($i = 0; $i <= 3; $i++) :
            $slider_pages[$i] =         get_theme_mod('customizer_setting_slider_page_' . $i);
            $slider_button_texts[$i] =  get_theme_mod('customizer_setting_slider_button_text_' . $i);
            $slider_button_urls[$i] =   get_theme_mod('customizer_setting_slider_button_url_' . $i);
          endfor;

          $query_args = array(
            'post_type'       => 'page',
            'posts_per_page'  => 3,
            'post__in'        => $slider_pages,
            'orderby'         => 'post__in'
          );

          $slider_query = new WP_Query($query_args);

          $loop_counter = 1;
          if ($slider_query->have_posts()) :
            while ($slider_query->have_posts()) :
              $slider_query->the_post();

              ?>
              <li>
                <?php the_post_thumbnail('fancy-lab-slider', array('class' => 'img-fluid')); ?>
                <div class="container">
                  <div class="slider-details-container">
                    <div class="slider-title">
                      <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="slider-description">
                      <div class="subtitle">
                        <?php the_content(); ?>
                      </div>
                      <a href="<?php echo esc_url($slider_button_urls[$loop_counter]); ?>" class="link">
                        <?php echo esc_html($slider_button_texts[$loop_counter]); ?>
                      </a>
                    </div>
                  </div>
                </div>
              </li>
          <?php
              $loop_counter++;
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </ul>
      </div>
    </section>
    <?php if (class_exists('WooCommerce')) : ?>
      <section class="popular-products">
        <div class="container">
          <div class="row">
            <div class="section-title">
              <h2> <?php esc_html_e('Popular Products', 'fancy-lab') ?> </h2>
            </div>
            <?php
              $numOfPopularProducts = get_theme_mod('customizer_setting_popular_products_num', 4);
              $numOfColsOfPopularProducts = get_theme_mod('customizer_setting_popular_products_cols', 4);

              echo do_shortcode('[products limit="' . esc_attr($numOfPopularProducts) . '" columns="' . esc_attr($numOfColsOfPopularProducts) . '" orderby="popularity"]');
              ?>
          </div>
        </div>
      </section>
      <section class="new-arrivals">
        <div class="container">
          <div class="row">
            <div class="section-title">
              <h2><?php esc_html_e('New Arrivals', 'fancy-lab'); ?></h2>
            </div>
            <?php
              $numOfNewProducts = get_theme_mod('customizer_setting_new_products_num', 4);
              $numOfColsOfNewProducts = get_theme_mod('customizer_setting_new_products_cols', 4);
              $currency = get_woocommerce_currency_symbol();

              echo do_shortcode('[products limit="' . esc_attr($numOfNewProducts) . '" columns="' . esc_attr($numOfColsOfNewProducts) . '" orderby="date"]');

              ?>
          </div>
        </div>
      </section>
      <?php
        $showDealSection = get_theme_mod('customizer_setting_deal_of_the_week_is_enabled', 0);
        $dealProductId = get_theme_mod('customizer_setting_deal_of_the_week_product_id');
        $regularProductPrice = get_post_meta($dealProductId, '_regular_price', true);
        $saleProductPrice = get_post_meta($dealProductId, '_sale_price', true);

        if ($showDealSection == 1 && !empty($dealProductId) && !empty($saleProductPrice)) :
          $discount_percentage = absint(100 - (($saleProductPrice / $regularProductPrice) * 100));
          ?>
        <section class="deal-of-the-week">
          <div class="container">
            <div class="section-title">
              <h2><?php esc_html_e('Deal of the Week', 'fancy-lab'); ?></h2>
            </div>
            <div class="row d-flex align-items-center">
              <div class="deal-img col-md-6 col-12 ml-auto text-center">
                <?php echo get_the_post_thumbnail($dealProductId, 'large', array('class' => 'img-fluid')); ?>
              </div>
              <div class="deal-desc col-md-4 col-12 mr-auto text-center">
                <span class="discount">
                  <?php echo esc_html($discount_percentage) . '% OFF'; ?>
                </span>
                <h3>
                  <a href="<?php echo esc_url(get_permalink($dealProductId)); ?>">
                    <?php echo esc_html(get_the_title($dealProductId)); ?>
                  </a>
                  <p><?php echo esc_html(get_the_excerpt($dealProductId)); ?></p>
                  <div class="prices">
                    <span class="regular">
                      <?php
                          echo esc_html($currency);
                          echo esc_html($regularProductPrice);
                          ?>
                    </span>
                    <span class="sale">
                      <?php
                          echo esc_html($currency);
                          echo esc_html($saleProductPrice);
                          ?>
                    </span>
                  </div>
                  <a href="<?php echo esc_url('?add-to-cart=' . $dealProductId) ?>" class="add-to-card">
                    <?php esc_html_e('Add to Cart', 'fancy-lab'); ?>
                  </a>
                </h3>
              </div>
            </div>
          </div>
        </section>
      <?php endif; ?>
    <?php endif; ?>
    <section class="lab-blog">
      <div class="container">
        <div class="section-title">
          <h2><?php _e('News from our Blog', 'fancy-lab'); ?></h2>
        </div>
        <div class="row">
          <?php

          $blogPosts = array(
            'post_type'       => 'post',
            'posts_per_page'  => 2
          );

          $query = new WP_Query($blogPosts);

          // If there are any posts
          if ($query->have_posts()) :

            // Load posts loop
            while ($query->have_posts()) : $query->the_post();
              ?>
              <article class='col-12 col-md-6'>
                <a href="<?php the_permalink(); ?>">
                  <?php
                      if (has_post_thumbnail()) :
                        the_post_thumbnail('fancy-lab-blog', array('class' => 'img-fluid'));
                      endif;
                      ?>
                </a>
                <h3>
                  <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                  </a>
                </h3>
                <div class="excerpt"><?php the_excerpt(); ?></div>
              </article>
            <?php
              endwhile;
              wp_reset_postdata();  // VERY IMPORTANT
            else :
              ?>
            <p><?php esc_html_e('Nothing to display', 'fancy-lab'); ?>.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>
</div>
<?php get_footer(); ?>