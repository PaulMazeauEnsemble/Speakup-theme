<?php
function display_talent_card($post_id) {
    $title = get_the_title($post_id);
    $photo = get_field('photo', $post_id);
    $audios = get_field('audio', $post_id);
    $first_letter = strtoupper($title[0]);
    ?>
    <div id="<?php echo $first_letter; ?>" class="talent-item flex opacity-0 transform translate-y-4 transition-all duration-700 ease-in-out">
        <div class="talent-photo w-2/5 aspect-square overflow-hidden">
            <?php if ($photo) : ?>
                <img src="<?php echo esc_url($photo['url']); ?>" alt="<?php echo esc_attr($photo['alt']); ?>" class="object-cover w-full h-full" />
            <?php endif; ?>
        </div>
        <div class="w-3/5 pl-4">
            <h2 class="text-xl text-white uppercase font-DM font-thin"><?php echo esc_html($title); ?></h2>
            <div class="talent-audio space-y-4">
                <?php if ($audios) : ?>
                    <?php foreach ($audios as $index => $audio) : ?>
                        <div class="custom-audio-player w-full mt-4">
                            <div class="flex w-full justify-between items-center">
                                <div class="flex content-center">
                                    <button class="play-pause-btn">
                                        <svg class="play-icon w-3 h-3" viewBox="0 0 8 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 5L0.5 9.33013L0.5 0.669873L8 5Z" fill="white"/>
                                        </svg>
                                        <svg class="pause-icon hidden w-3 h-3" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <line x1="1" y1="4.37114e-08" x2="1" y2="9" stroke="white" stroke-width="2"/>
                                            <line x1="5" y1="4.37114e-08" x2="5" y2="9" stroke="white" stroke-width="2"/>
                                        </svg>
                                    </button>
                                    <p class="text-white text-sm ml-2 uppercase font-DM font-thin"><?php echo esc_html($audio['titre']); ?></p>
                                </div>

                                <div class="w-3 h-3">
                                    <a href="<?php echo esc_url($audio['extrait']['url']); ?>" download>
                                        <svg class="w-3 h-3" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.71716 9.28284C2.87337 9.43905 3.12663 9.43905 3.28284 9.28284L5.82843 6.73726C5.98464 6.58105 5.98464 6.32778 5.82843 6.17157C5.67222 6.01536 5.41895 6.01536 5.26274 6.17157L3 8.43431L0.737258 6.17157C0.581048 6.01536 0.327783 6.01536 0.171573 6.17157C0.0153632 6.32778 0.0153632 6.58105 0.171573 6.73726L2.71716 9.28284ZM2.6 0L2.6 9H3.4L3.4 0L2.6 0Z" fill="white"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="progress-bar bg-gray-700 mt-2 h-px flex items-center">
                                <div class="progress bg-white h-0.5"></div>
                            </div>
                            <audio class="audio-element">
                                <source src="<?php echo esc_url($audio['extrait']['url']); ?>" type="<?php echo esc_attr($audio['extrait']['mime_type']); ?>">
                                Votre navigateur ne supporte pas l'élément audio.
                            </audio>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
}
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const players = document.querySelectorAll('.custom-audio-player');
    let currentAudio = null;

    players.forEach(player => {
        const audio = player.querySelector('.audio-element');
        const playPauseBtn = player.querySelector('.play-pause-btn');
        const playIcon = player.querySelector('.play-icon');
        const pauseIcon = player.querySelector('.pause-icon');
        const progressBar = player.querySelector('.progress-bar');
        const progress = player.querySelector('.progress');

        playPauseBtn.addEventListener('click', () => {
            if (audio.paused) {
                if (currentAudio && currentAudio !== audio) {
                    currentAudio.pause();
                    currentAudio.closest('.custom-audio-player').querySelector('.play-icon').classList.remove('hidden');
                    currentAudio.closest('.custom-audio-player').querySelector('.pause-icon').classList.add('hidden');
                }
                audio.play();
                playIcon.classList.add('hidden'); 
                pauseIcon.classList.remove('hidden'); 
                currentAudio = audio;
            } else {
                audio.pause();
                playIcon.classList.remove('hidden');
                pauseIcon.classList.add('hidden');
                currentAudio = null;
            }
        });

        audio.addEventListener('timeupdate', () => {
            const percentage = (audio.currentTime / audio.duration) * 100;
            progress.style.width = percentage + '%';
        });
    });

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-4');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.talent-item').forEach(item => {
        observer.observe(item);
    });
});
</script>