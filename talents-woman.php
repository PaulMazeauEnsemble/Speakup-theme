<?php
/*
Template Name: Talents Woman
*/

get_header(); ?>

<div class="content py-20">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mx-4">
    <?php
        // Inclure le composant talent-cards
        include get_template_directory() . '/components/talent-cards.php';

        // La boucle pour afficher les talents filtrés par catégorie 'Femme'
        $args = array(
            'post_type' => 'talents',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'talent-category',
                    'field'    => 'slug',
                    'terms'    => 'Femmes',
                ),
            ),
            'orderby' => 'title',
            'order' => 'ASC'
        );
        $talents_query = new WP_Query($args);

        if ($talents_query->have_posts()) :
            while ($talents_query->have_posts()) : $talents_query->the_post();
                $first_letter = strtoupper(get_the_title()[0]);
                ?>
                <div id="<?php echo $first_letter; ?>" class="col-span-1">
                    <?php display_talent_card(get_the_ID()); ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else : ?>
            <p>Aucun talent trouvé.</p>
        <?php endif; ?>
    </div>
</div>

<?php
// Inclure le composant alphabets
include get_template_directory() . '/components/alphabets.php';
?>

<?php get_footer(); ?>