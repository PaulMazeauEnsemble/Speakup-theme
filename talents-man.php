<?php
/*
Template Name: Talents Woman
*/
$login_page = home_url('/inscription/');

if (!is_user_logged_in()) {
    wp_redirect($login_page);
    exit;
}

get_header(); ?>

<div class="content">
    <!-- Menu de filtre -->
    <div class="filter-menu flex justify-center mt-52 text-white gap-6">
        <button class="filter-btn" data-filter="all">Tous</button>
        <?php
            // Récupérer l'ID de la catégorie "Hommes"
            $hommes_category = get_term_by('slug', 'hommes', 'talent-category');

            if ($hommes_category) {
                // Récupérer dynamiquement toutes les sous-catégories de "Hommes"
                $subcategories = get_terms(array(
                    'taxonomy' => 'talent-category',
                    'hide_empty' => true,
                    'parent' => $hommes_category->term_id,
                ));

                // Inclure la catégorie principale "Hommes" dans les termes
                $terms = array_merge(array($hommes_category->slug), wp_list_pluck($subcategories, 'slug'));
            }
        ?>
        <?php if (!empty($subcategories)) : ?>
            <?php foreach ($subcategories as $subcategory) : ?>
                <button class="filter-btn" data-filter="<?php echo esc_attr($subcategory->slug); ?>">
                    <?php echo esc_html($subcategory->name); ?>
                </button>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-4 md:px-8 pt-32 pb-20">
        <?php
            include get_template_directory() . '/components/talent-cards.php';

            $args = array(
                'post_type' => 'talents',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'talent-category',
                        'field'    => 'slug',
                        'terms'    => $terms, // Inclure la catégorie principale et les sous-catégories
                        'operator' => 'IN',
                    ),
                ),
                'orderby' => 'title',
                'order' => 'ASC'
            );
            $talents_query = new WP_Query($args);

            $used_letters = array();

            if ($talents_query->have_posts()) :
                while ($talents_query->have_posts()) : $talents_query->the_post();
                    $first_letter = strtoupper(get_the_title()[0]);
                    $used_letters[] = $first_letter;
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const talentItems = document.querySelectorAll('.talent-item');
    const alphabetLinks = document.querySelectorAll('.alphabet-link');
    const allLetters = Array.from(alphabetLinks).map(link => link.textContent);

    function updateAlphabet() {
        const visibleItems = Array.from(talentItems).filter(item => !item.closest('.col-span-1').classList.contains('hidden'));
        const usedLetters = new Set(visibleItems.map(item => item.id[0]));

        allLetters.forEach(letter => {
            const link = document.querySelector(`.alphabet-link[href="#${letter}"]`);
            if (usedLetters.has(letter)) {
                link.classList.remove('text-black');
                link.classList.add('text-white', 'transition', 'duration-300');
                link.style.pointerEvents = 'auto';
            } else {
                link.classList.remove('text-white');
                link.classList.add('text-black');
                link.style.pointerEvents = 'none';
            }
        });
    }

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const filter = button.getAttribute('data-filter');

            // Accessibilité
            filterButtons.forEach(btn => btn.setAttribute('aria-pressed', 'false'));
            button.setAttribute('aria-pressed', 'true');

            talentItems.forEach(item => {
                const parentDiv = item.closest('.col-span-1');
                if (filter === 'all' || item.classList.contains(filter)) {
                    parentDiv.classList.remove('hidden');
                } else {
                    parentDiv.classList.add('hidden');
                }
            });

            updateAlphabet();
        });
    });

    // Afficher tous les éléments par défaut au chargement de la page
    talentItems.forEach(item => item.closest('.col-span-1').classList.remove('hidden'));
    updateAlphabet(); // Réinitialisation de l'alphabet avec les lettres disponibles
});
</script>