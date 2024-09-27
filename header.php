<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="bg-blue-500 text-white p-4">
        <div class="flex items-center">
            <?php the_custom_logo(); ?> <!-- Remplace le nom par le logo -->
        </div>
        <nav>
            <?php wp_nav_menu(); ?>
        </nav>
    </header>