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
            transform: rotate(45deg);
        }
        .menu-open .line2 {
            transform: rotate(-45deg);
        }
        .menu-open #menu-icon line {
            transform-origin: center;
        }
        .custom-menu li {
            padding-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/src/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Instrument+Serif:ital@0;1&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
</head>
<body <?php body_class(); ?>>
    <header class="text-white p-8 w-full fixed top-0 left-0 z-10 bg-black-bg">
        <div class="flex items-center justify-between">
            <?php the_custom_logo(); ?>
            <button id="menu-toggle" class="text-white focus:outline-none z-10 relative">
                <svg id="menu-icon" width="35" height="12" viewBox="0 0 35 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line class="line1" y1="1" x2="35" y2="1" stroke="white" stroke-width="2"/>
                    <line class="line2" y1="11" x2="35" y2="11" stroke="white" stroke-width="2"/>
                </svg>
            </button>
        </div>
        <nav id="menu" class="fixed inset-0 bg-black-bg text-white p-8 menu-closed z-8">
            <?php the_custom_logo(); ?>
            <div class="grid grid-cols-1 md:grid-cols-10 gap-4 place-content-center h-[calc(100vh-110px)]">
                <div class="col-span-3">
                    <p class="text-white font-Space uppercase text-base md:text-xl pb-16">
                        <?php echo get_theme_mod('mytheme_custom_text', __('Ici texte', 'mytheme')); ?>
                    </p>
                        <?php wp_nav_menu(array(
                            'theme_location' => 'user-menu',
                            'menu_class' => 'text-white font-Space uppercase text-base md:text-xl',
                            'container_class' => 'custom-menu-container'
                        )); ?>
                        <a href="<?php echo wp_logout_url(); ?>" class="text-white font-Space uppercase text-base md:text-xl">Se déconnecter</a>
                </div>
                <div class="col-span-1">
                    <!-- Colonne vide -->
                </div>
                <div class="col-span-3">
                    <h2 class="text-white text-base md:text-4xl font-Instrument uppercase underline pb-10 decoration-2 underline-offset-4">Nos talents</h2>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'nos-talents-menu',
                        'menu_class' => 'text-white text-base text-base md:text-4xl font-Instrument uppercase custom-menu',
                        'container_class' => 'custom-menu-container'
                    )); ?>
                </div>
                <div class="col-span-3">
                    <h2 class="text-white text-base md:text-4xl font-Instrument uppercase underline pb-10 decoration-2 underline-offset-4">A propos</h2>
                    <?php wp_nav_menu(array(
                        'theme_location' => 'a-propos-menu',
                        'menu_class' => 'text-white text-base text-base md:text-4xl font-Instrument uppercase custom-menu',
                        'container_class' => 'custom-menu-container'
                    )); ?>
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