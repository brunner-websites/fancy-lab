<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header>
    <h1><?php the_title(); ?></h1>
    <div class="meta">
      <p><?php esc_html_e('Published by', 'fancy-lab'); ?> <?php the_author_posts_link(); ?> <?php esc_html_e('on', 'fancy-lab'); ?> <?php echo esc_html(get_the_date()); ?><br />
        <?php _e('Categories', 'fancy-lab'); ?>: <span><?php the_category(' '); ?><br />
          <?php if (has_tag()) : ?>
            <?php esc_html_e('Tags', 'fancy-lab'); ?>: <span><?php the_tags('', ', '); ?></span>
          <?php endif; ?>
      </p>
    </div>
    <div class="post-thumbnail">
      <?php
      if (has_post_thumbnail()) :
        the_post_thumbnail('fancy-lab-blog', array('class' => 'img-fluid'));
      endif;
      ?>
    </div>
  </header>
  <div class="content container">
    <div class="row">
      <div class="col-12">
        <?php

        wp_link_pages(array(
          'before'  => '<p class="inner-pagination">' . esc_html__('Pages', 'fancy-lab'),
          'after'   => '</p>'
        ));

        the_content();
        ?>
      </div>
    </div>
  </div>
</article>