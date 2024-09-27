<?php
function display_talent_card($post_id) {
    
    $title = get_the_title($post_id);
    $photo = get_field('photo', $post_id);
    $audios = array();
    for ($i = 1; $i <= 4; $i++) {
        $audio = get_field('audio_' . $i, $post_id);
        if ($audio) {
            $audios[] = $audio;
        }
    }
    $first_letter = strtoupper($title[0]);
    ?>
    <div id="<?php echo $first_letter; ?>" class="talent-item flex">
        <div class="talent-photo w-1/2">
            <?php if ($photo) : ?>
                <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>" />
            <?php endif; ?>
        </div>
        <div class="w-1/2 pl-4">
            <h2 class="text-xl text-white"><?php echo esc_html($title); ?></h2>
            <div class="talent-audio space-y-4">
                <?php $audio_counter = 1; ?>
                <?php foreach ($audios as $audio) : ?>
                    <div class="custom-audio-player w-full mt-4">
                        <div class="flex w-full">
                            <button class="play-pause-btn">
                                <svg class="play-icon w-3 h-3" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 5L0.5 9.33013L0.5 0.669873L8 5Z" fill="white"/>
                                </svg>
                                <svg class="pause-icon hidden w-3 h-3" viewBox="0 0 4 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 0V6" stroke="white"/>
                                    <path d="M3 0V6" stroke="white"/>
                                </svg>
                            </button>
                            <p class="text-white text-sm ml-2">Extrait <?php echo $audio_counter; ?></p>
                        </div>
                        <div class="progress-bar bg-gray-700 mt-2 h-px flex items-center">
                            <div class="progress bg-white h-0.5"></div>
                        </div>
                        <audio class="audio-element">
                            <source src="<?php echo esc_url($audio['url']); ?>" type="<?php echo esc_attr($audio['mime_type']); ?>">
                            Votre navigateur ne supporte pas l'élément audio.
                        </audio>
                    </div>
                    <?php $audio_counter++; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
}

?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const players = document.querySelectorAll('.custom-audio-player');

    players.forEach(player => {
        const audio = player.querySelector('.audio-element');
        const playPauseBtn = player.querySelector('.play-pause-btn');
        const playIcon = player.querySelector('.play-icon');
        const pauseIcon = player.querySelector('.pause-icon');
        const progressBar = player.querySelector('.progress-bar');
        const progress = player.querySelector('.progress');

        playPauseBtn.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                playIcon.classList.add('hidden'); // Cacher l'icône de lecture
                pauseIcon.classList.remove('hidden'); // Afficher l'icône de pause
            } else {
                audio.pause();
                playIcon.classList.remove('hidden'); // Afficher l'icône de lecture
                pauseIcon.classList.add('hidden'); // Cacher l'icône de pause
            }
        });

        audio.addEventListener('timeupdate', () => {
            const percentage = (audio.currentTime / audio.duration) * 100;
            progress.style.width = percentage + '%';
        });
    });
});
</script>