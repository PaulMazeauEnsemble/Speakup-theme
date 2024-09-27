<?php
function display_project_card($post_id) {
    $title = get_the_title($post_id);
    $video = get_field('video', $post_id);
    $first_letter = strtoupper($title[0]);
    ?>
    <div id="<?php echo $first_letter; ?>" class="project-item flex flex-col">
        <div class="project-video">
            <?php if ($video) : ?>
                <video controls class="w-full">
                    <source src="<?php echo esc_url($video['url']); ?>" type="<?php echo esc_attr($video['mime_type']); ?>">
                    Votre navigateur ne supporte pas l'élément vidéo.
                </video>
            <?php endif; ?>
        </div>
        <div class="w-1/2 pl-4 mt-2">
            <h2 class="text-xl text-white font-thin"><?php echo esc_html($title); ?></h2>
        </div>
    </div>
    <?php
}
?>
