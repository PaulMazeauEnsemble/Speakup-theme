<?php

function enqueue_tailwind_styles() {
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/style.css', [], '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_tailwind_styles');

?>