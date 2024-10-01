<?php
/*
Template Name: Talents Internationaux
*/
$login_page = home_url('/inscription/');

if (!is_user_logged_in()) {
    wp_redirect($login_page);
    exit;
}

get_header(); ?>

<div class="content">
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 px-8 pt-32 pb-20">
    <?php
        include get_template_directory() . '/components/talent-cards.php';

        $args = array(
            'post_type' => 'talents',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'talent-category',
                    'field'    => 'slug',
                    'terms'    => 'Internationaux',
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
        endif; ?>
    </div>
</div>

<?php if (!$talents_query->have_posts()) : ?>
    <div class="flex justify-center items-center">
        <p class="text-white">Aucun talent trouvé</p>
    </div>
<?php endif; ?>

<?php
// Inclure le composant alphabets
include get_template_directory() . '/components/alphabets.php';
?>

<?php get_footer(); ?>