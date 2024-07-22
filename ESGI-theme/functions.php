<?php

add_action('wp_enqueue_scripts', 'esgi_enqueue_assets');
function esgi_enqueue_assets()
{
    wp_enqueue_style('main', get_stylesheet_uri());
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js');

    $values = [
        'ajaxURL' => admin_url('admin-ajax.php')
    ];
    wp_localize_script('main', 'esgiValues', $values);
}

//menus
add_action('after_setup_theme', 'esgi_register_nav_menu', 0);
function esgi_register_nav_menu()
{
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu', 'ESGI'),
        'footer_menu'  => __('Footer Menu', 'ESGI'),
    ));
}

add_action('after_setup_theme', 'esgi_theme_setup');
function esgi_theme_setup()
{
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

//icones
function esgi_get_icon($name)
{
    $facebook = '<svg width="12" height="18" viewBox="0 0 12 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M3.4008 18L3.375 10.125H0V6.75H3.375V4.5C3.375 1.4634 5.25545 0 7.9643 0C9.26187 0 10.3771 0.0966038 10.7021 0.139781V3.3132L8.82333 3.31406C7.35011 3.31406 7.06485 4.01411 7.06485 5.04139V6.75H11.25L10.125 10.125H7.06484V18H3.4008Z" fill="#1A1A1A"/>
    </svg>';

    $linkedin = '<svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M17.9698 0H1.64687C1.19966 0 0.864258 0.335404 0.864258 0.782609V17.2174C0.864258 17.5528 1.19966 17.8882 1.64687 17.8882H18.0816C18.5289 17.8882 18.8643 17.5528 18.8643 17.1056V0.782609C18.7525 0.335404 18.4171 0 17.9698 0ZM3.54749 15.205V6.70807H6.23072V15.205H3.54749ZM4.8891 5.59006C3.99469 5.59006 3.32389 4.80745 3.32389 4.02484C3.32389 3.13043 3.99469 2.45963 4.8891 2.45963C5.78351 2.45963 6.45432 3.13043 6.45432 4.02484C6.34252 4.80745 5.67171 5.59006 4.8891 5.59006ZM16.0692 15.205H13.386V11.0683C13.386 10.0621 13.386 8.8323 12.0444 8.8323C10.7028 8.8323 10.4792 9.95031 10.4792 11.0683V15.3168H7.79593V6.70807H10.3674V7.82609C10.7028 7.15528 11.5972 6.48447 12.827 6.48447C15.5102 6.48447 15.9574 8.27329 15.9574 10.5093V15.205H16.0692Z" fill="#1A1A1A"/>
    </svg>';

    return isset($$name) ? $$name : '';
}

//  AJAX
add_action('wp_ajax_load_posts', 'ajax_load_posts'); 
add_action('wp_ajax_nopriv_load_posts', 'ajax_load_posts');

function ajax_load_posts()
{
    // Récupérer la page demandée (un des parametres du call)
    $paged = $_GET['paged'];

    // Ouvrir le buffer php
    ob_start();

    // Inclusion du template-part posts-list
    include('template-parts/posts-list.php');

    // Renvoie du buffer et suppression de celui-ci

    echo ob_get_clean();
    wp_die();
}

// activation des svg
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];
}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '';
}
add_action( 'admin_head', 'fix_svg' );

add_action('customize_register', 'esgi_customize_register_extended');
function esgi_customize_register_extended($wp_customize) {
    // 
    $wp_customize->add_section('esgi_our_team_section', [
        'title' => __('Our Members', 'ESGI'),
        'description' => __('Team members\' photos, roles, and contact infos'),
        'priority' => 160,
    ]);

    for ($i = 1; $i <= 4; $i++) {
        // Photos
        $wp_customize->add_setting("member_{$i}_photo", [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "member_{$i}_photo", [
            'label' => __("Member #{$i} photo", 'ESGI'),
            'section' => 'esgi_our_team_section',
        ]));

        // Role + contact
        $wp_customize->add_setting("member_{$i}_job_title", [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("member_{$i}_job_title", [
            'label' => __("Member #{$i} role", 'ESGI'),
            'section' => 'esgi_our_team_section',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("member_{$i}_contact_info", [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("member_{$i}_contact_info", [
            'label' => __("Member #{$i} contact infos", 'ESGI'),
            'section' => 'esgi_our_team_section',
            'type' => 'textarea',
        ]);
    }

    // Partners
    $wp_customize->add_section('esgi_our_partners_section', [
        'title' => __('Our Partners', 'ESGI'),
        'description' => __('Partner\'s logos'),
        'priority' => 170,
    ]);

    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting("partner_{$i}_logo", [
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'default' => '',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "partner_{$i}_logo", [
            'label' => __("Partner {$i} Logo", 'ESGI'),
            'section' => 'esgi_our_partners_section',
        ]));
    }
}

function display_esgi_members() {
    echo '<div class="members-list">';
    for ($i = 1; $i <= 4; $i++) {
        $photo = get_theme_mod("member_{$i}_photo");
        $job_title = get_theme_mod("member_{$i}_job_title");
        $contact_info = get_theme_mod("member_{$i}_contact_info");

        if ($photo || $job_title || $contact_info) {
            echo '<div class="member">';
            if ($photo) {
                echo '<img src="' . esc_url($photo) . '" alt="' . esc_attr($job_title) . '">';
            }
            if ($job_title) {
                echo '<h3>' . esc_html($job_title) . '</h3>';
            }
            if ($contact_info) {
                echo '<p>' . esc_html($contact_info) . '</p>';
            }
            echo '</div>';
        }
    }
    echo '</div>';
}

function display_esgi_partners() {
    echo '<div class="partners-list">';
    for ($i = 1; $i <= 4; $i++) {
        $logo = get_theme_mod("partner_{$i}_logo");

        if ($logo) {
            echo '<div class="partner">';
            echo '<img src="' . esc_url($logo) . '" alt=" ' . $i . ' Logo">';
            echo '</div>';
        }
    }
    echo '</div>';
}

// shortcodes à récupérer
add_shortcode('esgi_members', 'display_esgi_members');
add_shortcode('esgi_partners', 'display_esgi_partners');

//section about us
add_action('customize_register', 'esgi_customize_about_us');
function esgi_customize_about_us($wp_customize) {
    $wp_customize->add_section('about_us_section', [
        'title' => __('About Us Settings', 'ESGI'),
        'priority' => 160,
    ]);

    $wp_customize->add_setting('about_us_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_us_image', [
        'label' => __('About Us Image', 'ESGI'),
        'section' => 'about_us_section',
    ]));

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("about_us_item_{$i}_title", [
            'default' => "Item {$i} Title",
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("about_us_item_{$i}_title", [
            'label' => __("Item {$i} Title", 'ESGI'),
            'section' => 'about_us_section',
            'type' => 'text',
        ]);
        $wp_customize->add_setting("about_us_item_{$i}_description", [
            'default' => "Item {$i} Description",
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("about_us_item_{$i}_description", [
            'label' => __("Item {$i} Description", 'ESGI'),
            'section' => 'about_us_section',
            'type' => 'textarea',
        ]);
    }
}

//Params section services
add_action('customize_register', 'esgi_customize_our_services');
function esgi_customize_our_services($wp_customize) {
    $wp_customize->add_section('our_services_section', [
        'title' => __('Our Services', 'ESGI'),
        'priority' => 160,
    ]);

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("service_{$i}_title", [
            'default' => __("Service {$i} Title", 'ESGI'),
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("service_{$i}_title", [
            'label' => __("Service {$i} Title", 'ESGI'),
            'section' => 'our_services_section',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("service_{$i}_description", [
            'default' => __("Service {$i} Description", 'ESGI'),
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("service_{$i}_description", [
            'label' => __("Service {$i} Description", 'ESGI'),
            'section' => 'our_services_section',
            'type' => 'textarea',
        ]);

        $wp_customize->add_setting("service_{$i}_image", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "service_{$i}_image", [
            'label' => __("Service {$i} Image", 'ESGI'),
            'section' => 'our_services_section',
        ]));

        $wp_customize->add_setting("service_{$i}_order", [
            'default' => $i,
            'sanitize_callback' => 'absint',
        ]);
        $wp_customize->add_control("service_{$i}_order", [
            'label' => __("Service {$i} Order", 'ESGI'),
            'section' => 'our_services_section',
            'type' => 'number',
        ]);
    }
}



//Params section services
add_action('customize_register', 'esgi_customize_contact');
function esgi_customize_contact($wp_customize) {
    $wp_customize->add_section('contact_section', [
        'title' => __('Contact', 'ESGI'),
        'priority' => 190,
    ]);

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("contact_{$i}_role", [
            'default' => 'Manager',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("contact_{$i}_role", [
            'label' => __("Contact #{$i} role", 'ESGI'),
            'section' => 'contact_section',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("contact_{$i}_contacts", [
            'default' => '+33 1 53 31 25 23 info@company.com',
            'sanitize_callback' => 'sanitize_textarea_field',
    
        ]);
        $wp_customize->add_control("contact_{$i}_contacts", [
            'label' => __("Contact #{$i} contacts", 'ESGI'),
            'section' => 'contact_section',
            'type' => 'textarea',
        ]);

    }
}

add_action('wp_ajax_foobar', 'esgi_search_posts');
function esgi_search_posts($search_query)
{
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        's' => $search_query,
    );

    $query = new WP_Query($args);
    $result = [];

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $categories = get_the_category();
            $categories_name = [];
            foreach ($categories as $category) {
                array_push($categories_name, $category->name);
            }
            $current_post = array(
                'title' => get_the_title(),
                'content' => get_the_excerpt(),
                'permalink' => get_the_permalink(),
                'date' => get_the_date(),
                'category' => $categories_name,
            );
            array_push($result, $current_post);
        }
    } else {
        return 'No search results available';
    }
    wp_reset_postdata();
    return $result;
}

