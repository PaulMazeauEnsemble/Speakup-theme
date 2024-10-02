<?php get_header(); ?>

<div id="primary" class=" mt-20 md:mt-40">
    <main id="main" class="site-main text-white">
        <?php
        while ( have_posts() ) :
            the_post();
            the_content(); // Assurez-vous que cette ligne est présente
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>