<?php

/**
 * Fancy Lab Theme Customizer
 * 
 * @package Fancy Lab
 */

function fancy_lab_customizer($wp_customize)
{

  /*************************************************/
  /*************** COPYRIGHT SECTION ***************/
  /*************************************************/

  // Copyright Section
  $wp_customize->add_section(
    'customizer_section_copyright',
    array(
      // This is the name of the section
      'title'       => __('Copyright Settings', 'fancy-lab'),

      // This is the title of the section (you'll see it once you've opened the section)
      'description' => __('Coypright Section', 'fancy-lab')
    )
  );

  // Setting 1 - Copyright Textbox
  $wp_customize->add_setting(
    'customizer_setting_copyright',
    array(
      'type'              => 'theme_mod',             // or option
      'default'           => '',
      'sanitize_callback' => 'sanitize_text_field'
    )
  );

  // Control for Setting 1
  $wp_customize->add_control(
    'customizer_setting_copyright',
    array(
      'label'       => __('Copyright', 'fancy-lab'),
      'description' => __('Please enter your copyright information right here', 'fancy-lab'),
      'section'     => 'customizer_section_copyright',
      'type'        => 'text' // could also be 'textarea' or 'checkbox' or many other things
    )
  );

  /*************************************************/
  /*************** SLIDER SECTION ******************/
  /*************************************************/

  // Slider Section
  $wp_customize->add_section(
    'customizer_section_slider',
    array(
      'title'       => __('Slider Settings', 'fancy-lab'),
      'description' => __('Slider Section', 'fancy-lab')
    )
  );

  $numberOfSlides = 3;

  // This LOOP creates for $numberOfSlides times
  // 1 x setting and control for: Slider Page
  // 1 x setting and control for: Slider Button Text
  // 1 x setting and control for: Slider Button URL

  for ($i = 1; $i <= $numberOfSlides; $i++) {
    // Setting 1 - Slider Page Number 1
    $wp_customize->add_setting(
      'customizer_setting_slider_page_' . $i,
      array(
        'type'              => 'theme_mod',
        'default'           => '',
        'sanitize_callback' => 'absint'
      )
    );

    // Control for Setting 1
    $wp_customize->add_control(
      'customizer_setting_slider_page_' . $i,
      array(
        'label'       => __('Set Slider Page ' . $i, 'fancy-lab'),
        'description' => __('Set Slider Page ' . $i, 'fancy-lab'),
        'section'     => 'customizer_section_slider',
        'type'        => 'dropdown-pages'
      )
    );

    // Setting 2 - Button Text 1
    $wp_customize->add_setting(
      'customizer_setting_slider_button_text_' . $i,
      array(
        'type'              => 'theme_mod',
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field'
      )
    );

    // Control for Setting 2
    $wp_customize->add_control(
      'customizer_setting_slider_button_text_' . $i,
      array(
        'label'       => __('Button Text Page ' . $i, 'fancy-lab'),
        'description' => __('Button Text Page ' . $i, 'fancy-lab'),
        'section'     => 'customizer_section_slider',
        'type'        => 'text'
      )
    );

    // Setting 3 - Button URL 1
    $wp_customize->add_setting(
      'customizer_setting_slider_button_url_' . $i,
      array(
        'type'              => 'theme_mod',
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw'
      )
    );

    // Control for Button URL 1
    $wp_customize->add_control(
      'customizer_setting_slider_button_url_' . $i,
      array(
        'label'       => __('Button URL Page ' . $i, 'fancy-lab'),
        'description' => __('Button URL Page ' . $i, 'fancy-lab'),
        'section'     => 'customizer_section_slider',
        'type'        => 'url'
      )
    );
  }

  /*****************************************************************/
  /*************** HOME PAGE PRODUCT LIST SECTION ******************/
  /*****************************************************************/

  $wp_customize->add_section(
    'customizer_section_home_page_product_lists',
    array(
      'title'       => __('Home Page Product List Settings', 'fancy-lab'),
      'description' => __('Home Page Section', 'fancy-lab')
    )
  );

  // POPULAR PRODUCTS: Setting and Control for number of popular products that are displayed
  $wp_customize->add_setting(
    'customizer_setting_popular_products_num',
    array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'absint'
    )
  );

  $wp_customize->add_control(
    'customizer_setting_popular_products_num',
    array(
      'label'       => __('Set number of popular products to be displayed ', 'fancy-lab'),
      'description' => '',
      'section'     => 'customizer_section_home_page_product_lists',
      'type'        => 'number'
    )
  );

  // POPULAR PRODUCTS: Setting and Control for columns of popular products that are displayed
  $wp_customize->add_setting(
    'customizer_setting_popular_products_cols',
    array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'absint'
    )
  );

  $wp_customize->add_control(
    'customizer_setting_popular_products_cols',
    array(
      'label'       => __('Set number of columns of popular products to be displayed ', 'fancy-lab'),
      'description' => '',
      'section'     => 'customizer_section_home_page_product_lists',
      'type'        => 'number'
    )
  );

  // NEW PRODUCTS: Setting and Control for number of new products that are displayed
  $wp_customize->add_setting(
    'customizer_setting_new_products_num',
    array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'absint'
    )
  );

  $wp_customize->add_control(
    'customizer_setting_new_products_num',
    array(
      'label'       => __('Set number of new products to be displayed', 'fancy-lab'),
      'description' => '',
      'section'     => 'customizer_section_home_page_product_lists',
      'type'        => 'number'
    )
  );

  // NEW PRODUCTS: Setting and Control for columns of new products that are displayed
  $wp_customize->add_setting(
    'customizer_setting_new_products_cols',
    array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'absint'
    )
  );

  $wp_customize->add_control(
    'customizer_setting_new_products_cols',
    array(
      'label'       => __('Set number of columns of new products to be displayed', 'fancy-lab'),
      'description' => '',
      'section'     => 'customizer_section_home_page_product_lists',
      'type'        => 'number'
    )
  );


  // DEAL OF THE WEEK: Enabling or disabling deal of the week
  $wp_customize->add_setting(
    'customizer_setting_deal_of_the_week_is_enabled',
    array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'fancy_lab_checkbox_sanitizer'
    )
  );

  $wp_customize->add_control(
    'customizer_setting_deal_of_the_week_is_enabled',
    array(
      'label'       => __('Should the deal of the week section be enabled?', 'fancy-lab'),
      'description' => '',
      'section'     => 'customizer_section_home_page_product_lists',
      'type'        => 'checkbox'
    )
  );

  // DEAL OF THE WEEK: Setting of the product-id of the deal of the week
  $wp_customize->add_setting(
    'customizer_setting_deal_of_the_week_product_id',
    array(
      'type'              => 'theme_mod',
      'default'           => '',
      'sanitize_callback' => 'absint'
    )
  );

  $wp_customize->add_control(
    'customizer_setting_deal_of_the_week_product_id',
    array(
      'label'       => __('Set the Product-ID of the deal of the week', 'fancy-lab'),
      'description' => '',
      'section'     => 'customizer_section_home_page_product_lists',
      'type'        => 'number'
    )
  );
}

add_action('customize_register', 'fancy_lab_customizer');

function fancy_lab_checkbox_sanitizer($checked)
{
  return ((isset($checked) && $checked == true) ? true : false);
}
