<?php

/**
 * Fancy Lab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fancy Lab
 */


/**
 * Include Customizer
 */
require_once get_template_directory() . '/inc/customizer.php';


/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
  require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');

/**
 * Enqueue scripts and styles.
 */
function fancy_lab_scripts()
{
  //Bootstrap javascript and CSS files
  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/inc/bootstrap.min.js', array('jquery'), '4.3.1', true);
  wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Rajdhani:400,500,600,700|Seaweed+Script&display=swap');

  wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/inc/bootstrap.min.css', array(), '4.3.1', 'all');

  // Theme's main stylesheet
  wp_enqueue_style('fancy-lab-style', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css'), 'all');

  // Flexslider CSS and JS
  wp_enqueue_script('flexslider-min-js', get_template_directory_uri() . '/inc/flexslider/jquery.flexslider-min.js', array('jquery'), '', true);
  wp_enqueue_script('fancylab-flexslider-js', get_template_directory_uri() . '/inc/flexslider/fancylab-flexslider.js', array('jquery'), '', true);
  wp_enqueue_style('flexslider-css', get_template_directory_uri() . '/inc/flexslider/flexslider.css', array(), '', 'all');
}

add_action('wp_enqueue_scripts', 'fancy_lab_scripts');


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fancy_lab_config()
{

  // This theme uses wp_nav_menu() in two locations.
  register_nav_menus(
    array(
      'fancy_lab_main_menu'   => esc_html__('Fancy Lab Main Menu', 'fancy-lab'),
      'fancy_lab_footer_menu' => esc_html__('Fancy Lab Footer Menu', 'fancy-lab'),
    )
  );

  // This theme is WooCommerce compatible, so we're adding support to WooCommerce
  add_theme_support('woocommerce', array(
    'thumbnail_image_width' => 255,
    'single_image_width'  => 255,
    'product_grid'       => array(
      'default_rows'    => 10,
      'min_rows'        => 5,
      'max_rows'        => 10,
      'default_columns' => 1,
      'min_columns'     => 1,
      'max_columns'     => 1,
    )
  ));
  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');

  // Wordpress Theme Support
  add_theme_support('custom-logo', array(
    'height'      => 85,
    'width'       => 160,
    'flex-height' => true,
    'flex-width'  => true
  ));

  add_theme_support('post-thumbnails');

  add_image_size('fancy-lab-slider', 1920, 800, array('center', 'center'));
  add_image_size('fancy-lab-blog', 960, 640, array('center', 'center'));

  if (!isset($content_width)) {
    $content_width = 600;
  }

  add_theme_support('title-tag');

  // Enable Translation
  $textdomain = 'fancy-lab';
  load_textdomain($textdomain, get_stylesheet_directory('/languages')); // needed for possible child-themes
  load_textdomain($textdomain, get_template_directory('/languages'));
}

add_action('after_setup_theme', 'fancy_lab_config', 0);


if (class_exists('WooCommerce')) {
  require get_template_directory() . '/inc/wc-modifications.php';
}


/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'fancy_lab_woocommerce_header_add_to_cart_fragment');

function fancy_lab_woocommerce_header_add_to_cart_fragment($fragments)
{
  global $woocommerce;

  ob_start();

  ?>
  <span class="items"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
<?php

  $fragments['span.items'] = ob_get_clean();

  return $fragments;
}


/**
 * Add css-class to custom-logo
 */
add_filter('get_custom_logo', 'change_custom_logo_class');

function change_custom_logo_class($html)
{

  $html = str_replace('custom-logo', 'custom-logo img-fluid', $html);

  return $html;
}


/**
 * Register Sidebars / Widget Areas
 */

add_action('widgets_init', 'fancylab_sidebars');

function fancylab_sidebars()
{
  register_sidebar(array(
    'name'          => esc_html__('Fancy Lab Main Sidebar', 'fancy-lab'),
    'id'            => 'fancy-lab-sidebar-main',
    'description'   => esc_html__('Drag and drop your content here', 'fancy-lab'),
    'before_widget'  => '<div id="%1$s" class="widget widget-wrapper %2$s ">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));


  register_sidebar(array(
    'name'          => esc_html__('Sidebar WooCommerce Shop', 'fancy-lab'),
    'id'            => 'fancy-lab-sidebar-shop',
    'description'   => esc_html__('Drag and drop your WooCommerce content here', 'fancy-lab'),
    'before_widget'  => '<div id="%1$s" class="widget widget-wrapper %2$s ">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));


  register_sidebar(array(
    'name'          => __('Fancy Lab Footer Sidebar 1', 'fancy-lab'),
    'id'            => 'fancy-lab-sidebar-footer-1',
    'description'   => __('Drag and drop your content here', 'fancy-lab'),
    'before_widget'  => '<div id="%1$s" class="widget widget-wrapper %2$s ">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name'          => esc_html__('Fancy Lab Footer Sidebar 2', 'fancy-lab'),
    'id'            => 'fancy-lab-sidebar-footer-2',
    'description'   => esc_html__('Drag and drop your content here', 'fancy-lab'),
    'before_widget'  => '<div id="%1$s" class="widget widget-wrapper %2$s ">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'name'            => esc_html__('Fancy Lab Footer Sidebar 3', 'fancy-lab'),
    'id'              => 'fancy-lab-sidebar-footer-3',
    'description'     => esc_html__('Drag and drop your content here', 'fancy-lab'),
    'before_widget'   => '<div id="%1$s" class="widget widget-wrapper %2$s ">',
    'after_widget'    => '</div>',
    'before_title'    => '<h4 class="widget-title">',
    'after_title'     => '</h4>',
  ));
}
