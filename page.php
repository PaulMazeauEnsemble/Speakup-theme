<?php get_header(); ?>

<div id="primary" class="mt-20 md:mt-40 grid grid-cols-4 md:grid-cols-10 mx-4 md:mx-8 place-content-center justify-items-center">
    <main id="main" class="site-main text-white col-span-4 md:col-span-4 col-start-1 md:col-start-4 w-full">
        <?php
        while ( have_posts() ) :
            the_post();
            the_content(); // Assurez-vous que cette ligne est présente
        endwhile;
        ?>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>