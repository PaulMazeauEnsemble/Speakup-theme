<?php get_header(); ?>

<div class="content">
    <!-- Menu de filtre -->
    <div class="filter-menu flex justify-center space-x-4 mb-8">
        <a href="?filter=all" class="filter-link">Tous</a>
        <a href="?filter=femmes-bilingue" class="filter-link">Femmes Bilingue</a>
        <a href="?filter=femmes-anglaise" class="filter-link">Femmes Anglaise</a>
        <!-- Ajoutez d'autres liens de filtre ici -->
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4 md:px-8 pt-32 pb-20 mt-32">
        <?php
            include get_template_directory() . '/components/talent-cards.php';

            $term = get_queried_object();
            $args = array(
                'post_type' => 'talents',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'talent-category',
                        'field'    => 'slug',
                        'terms'    => $term->slug,
                    ),
                ),
                'orderby' => 'title',
                'order' => 'ASC'
            );
            $talents_query = new WP_Query($args);

            if ($talents_query->have_posts()) :
                while ($talents_query->have_posts()) : $talents_query->the_post();
                    ?>
                    <div class="col-span-1">
                        <?php display_talent_card(get_the_ID()); ?>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="flex justify-center items-center">
                    <p class="text-white">Aucun talent trouvé</p>
                </div>
            <?php endif; ?>
    </div>
</div>

<?php
// Inclure le composant alphabets
include get_template_directory() . '/components/alphabets.php';
?>

<?php get_footer(); ?>