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
        .line1, .line2 {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .menu-open .line1 {
            transform: rotate(45deg) translate(5px, 5px);
        }
        .menu-open .line2 {
            transform: rotate(-45deg) translate(5px, -5px);
        }
    </style>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/styles.css">
</head>
<body <?php body_class(); ?>>
    <header class="text-white p-4 w-full fixed top-0 left-0 z-10 bg-black-bg">
        <div class="flex items-center justify-between">
            <?php the_custom_logo(); ?>
            <button id="menu-toggle" class="text-white focus:outline-none z-10 relative">
                <svg id="menu-icon" width="35" height="12" viewBox="0 0 35 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line class="line1" y1="1" x2="35" y2="1" stroke="white" stroke-width="2"/>
                    <line class="line2" y1="11" x2="35" y2="11" stroke="white" stroke-width="2"/>
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
            var menuIcon = document.getElementById('menu-icon');
            if (menu.classList.contains('menu-closed')) {
                menu.classList.remove('menu-closed');
                menu.classList.add('menu-open');
                menuIcon.classList.add('menu-open');
            } else {
                menu.classList.remove('menu-open');
                menu.classList.add('menu-closed');
                menuIcon.classList.remove('menu-open');
            }
        });
    </script>
</body>
</html>