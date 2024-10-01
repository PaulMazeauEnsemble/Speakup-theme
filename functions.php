<?php

function enqueue_tailwind_styles() {
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/style.css', [], '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_tailwind_styles');

function mytheme_custom_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'mytheme_custom_logo_setup');

// Enregistrement du type de post personnalisé 'talents'
function register_talents_post_type() {
    $labels = array(
        'name'               => 'Talents',
        'singular_name'      => 'Talent',
        'menu_name'          => 'Talents',
        'name_admin_bar'     => 'Talent',
        'add_new'            => 'Ajouter Nouveau',
        'add_new_item'       => 'Ajouter Nouveau Talent',
        'new_item'           => 'Nouveau Talent',
        'edit_item'          => 'Éditer Talent',
        'view_item'          => 'Voir Talent',
        'all_items'          => 'Tous les Talents',
        'search_items'       => 'Rechercher Talents',
        'parent_item_colon'  => 'Parent Talents:',
        'not_found'          => 'Aucun talent trouvé.',
        'not_found_in_trash' => 'Aucun talent trouvé dans la corbeille.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'talents'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail')
    );

    register_post_type('talents', $args);
}

add_action('init', 'register_talents_post_type');


// Enregistrement du type de post personnalisé 'projets'
function register_projets_post_type() {
    $labels = array(
        'name'               => 'Projets',
        'singular_name'      => 'projet',
        'menu_name'          => 'Projets',
        'name_admin_bar'     => 'Projet',
        'add_new'            => 'Ajouter Nouveau',
        'add_new_item'       => 'Ajouter Nouveau Projet',
        'new_item'           => 'Nouveau Talent',
        'edit_item'          => 'Éditer Talent',
        'view_item'          => 'Voir Projet',
        'all_items'          => 'Tous les Projets',
        'search_items'       => 'Rechercher Projets',
        'parent_item_colon'  => 'Parent Projets:',
        'not_found'          => 'Aucun projet trouvé.',
        'not_found_in_trash' => 'Aucun projet trouvé dans la corbeille.'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'projets'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail')
    );

    register_post_type('projets', $args);
}

add_action('init', 'register_projets_post_type');

function mytheme_customize_register($wp_customize) {
    // Ajouter une section pour le texte personnalisé du menu
    $wp_customize->add_section('mytheme_custom_text_section', array(
        'title'    => __('Texte Menu', 'mytheme'),
        'priority' => 30,
    ));

    // Ajouter un paramètre pour le texte personnalisé du menu
    $wp_customize->add_setting('mytheme_custom_text', array(
        'default'   => __('Ici texte', 'mytheme'),
        'transport' => 'refresh',
    ));

    // Ajouter un contrôle pour le texte personnalisé du menu
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'mytheme_custom_text_control', array(
        'label'    => __('Texte Menu', 'mytheme'),
        'section'  => 'mytheme_custom_text_section',
        'settings' => 'mytheme_custom_text',
    )));
}

add_action('customize_register', 'mytheme_customize_register');

function register_custom_menus() {
    register_nav_menus(array(
        'nos-talents-menu' => __('Nos Talents Menu', 'speakup'),
        'a-propos-menu' => __('A Propos Menu', 'speakup'),
        'user-menu' => __('User Menu', 'speakup')  // Ajout du nouveau menu
    ));
}
add_action('init', 'register_custom_menus');

?>
