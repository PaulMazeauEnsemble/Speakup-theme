<?php
/*
Template Name: HomePage
*/

include('header.php');

$image = get_field('image'); // Assurez-vous que le nom du champ est correct
$Image_url = $image['url']; // Accédez à l'URL de l'image

if ($Image_url):
?>
    <div class="md:col-span-6 flex justify-center items-center " style="background-image: url('<?php echo esc_url($Image_url); ?>'); background-size: cover; background-position: center; height: 100%; width: 100%;">
    </div>
<?php
endif;
?>

<div class="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="grid grid-cols-1 md:grid-cols-10 gap-4 h-screen">
            <div class="md:col-span-4 flex items-end">
                <h1 class="text-white text-7xl p-8 font-Instrument font-thin uppercase"><?php the_field('titre'); ?></h1>
            </div>
            <div class="md:col-span-6 flex justify-center items-center " style="background-image: url('<?php echo esc_url($Image_url); ?>'); background-size: cover; background-position: center; height: 100%; width: 100%;">
            </div>
        </div>
    <?php endwhile; endif; ?>
</div>

<?php
include('footer.php');
?>
