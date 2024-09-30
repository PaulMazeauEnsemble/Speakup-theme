<?php
/*
Template Name: HomePage
*/

include('header.php');

// Récupérer les champs ACF
$photo = get_field('image');
$titre = get_field('titre');
?>

<div class="grid grid-cols-10 gap-10 h-screen">
    <div class="col-span-4 flex items-end">
        <h1 class="text-7xl text-white"><?php echo esc_html($titre); ?></h1>
    </div>
    <div class="col-span-6 h-full">
        <?php if ($photo) : ?>
            <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>" class="w-full h-full object-cover" /> <!-- Afficher l'image -->
        <?php endif; ?>
    </div>
</div>

<?php
// Inclusion du pied de page
include('footer.php');
?>
