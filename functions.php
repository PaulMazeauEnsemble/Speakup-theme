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

// Enregistrement du type de publication personnalisé 'talents'
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

?>
