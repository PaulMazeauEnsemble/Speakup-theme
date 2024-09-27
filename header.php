<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <style>
        .menu-open {
            display: block;
        }
        .menu-closed {
            display: none;
        }
    </style>
</head>
<body <?php body_class(); ?>>
    <header class="text-white p-4 w-full">
        <div class="flex items-center justify-between">
            <?php the_custom_logo(); ?>
            <button id="menu-toggle" class="text-white focus:outline-none z-10 relative">
                <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path id="menu-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
        <nav id="menu" class="fixed inset-0 bg-black-bg text-white p-4 menu-closed z-8">
            <?php the_custom_logo(); ?>
            <div class="grid grid-cols-[3fr_4fr]">
                <div class="p-4">
                    <p class="text-white">Ici texte</p>
                </div>
                <div class="p-4">
                    <p class="text-white"><?php wp_nav_menu(); ?></p>
                </div>
            </div>
        </nav>
    </header>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var menu = document.getElementById('menu');
            var menuIconPath = document.getElementById('menu-icon-path');
            if (menu.classList.contains('menu-closed')) {
                menu.classList.remove('menu-closed');
                menu.classList.add('menu-open');
                menuIconPath.setAttribute('d', 'M6 18L18 6M6 6l12 12'); // Icône de croix
            } else {
                menu.classList.remove('menu-open');
                menu.classList.add('menu-closed');
                menuIconPath.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7'); // Icône de menu burger
            }
        });
    </script>
</body>
</html>