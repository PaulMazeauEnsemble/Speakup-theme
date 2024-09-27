<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="bg-blue-500 text-white p-4">
        <h1 class="text-3xl"><?php bloginfo('name'); ?></h1>
        <nav>
            <?php wp_nav_menu(); ?>
        </nav>
    </header>