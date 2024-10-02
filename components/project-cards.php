<?php
function display_project_card($post_id) {
    $title = get_the_title($post_id);
    $video = get_field('video', $post_id);
    $first_letter = strtoupper($title[0]);
    ?>
    <div id="<?php echo $first_letter; ?>" class="project-item opacity-0 transform translate-y-4 transition-all duration-700 ease-in-out">
        <div class="relative w-auto max-w-full max-h-full group pointer-events-auto">
            <?php if ($video) : ?>
                <video id="video-<?php echo $post_id; ?>" class="w-full max-w-full h-full max-h-full" playsinline muted>
                    <source src="<?php echo esc_url($video['url']); ?>" type="<?php echo esc_attr($video['mime_type']); ?>">
                    Votre navigateur ne supporte pas l'élément vidéo.
                </video>
                <div class="controls absolute bottom-0 w-full bg-gradient-to-t from-gray-950/35 via-gray-950/25 group-hover:opacity-100 transition-opacity delay-[0.2s] group-hover:delay-0 duration-500 group-hover:duration-150 md:opacity-0 px-4">
                    <div class="px-4 md:px-0 my-3 flex gap-3 items-center text-white text-xs">
                        <button class="play-pause font-DM">Pause</button>
                        <button class="mute-unmute font-DM">Unmute</button>
                        <div class="progress-bar relative group/progress cursor-pointer w-full h-1 flex items-center">
                            <div class="absolute left-0 right-0 h-[0.065rem] group-hover/progress:h-full bg-neutral-500/80"></div>
                            <div class="progress absolute left-0 h-[0.175rem] group-hover/progress:h-full bg-white"></div>
                        </div>
                        <button class="fullscreen">
                            <svg width="16" height="16" viewBox="0 0 16 16" class="stroke-white hover:scale-110 transition-transform" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.5 2.5H0.5V6.5"/>
                                <path d="M9.5 13.5L15.5 13.5L15.5 9.5"/>
                                <path d="M6.5 13.5L0.5 13.5L0.5 9.5"/>
                                <path d="M9.5 2.5L15.5 2.5L15.5 6.5"/>
                            </svg>
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="w-1/2 pl-4 mt-2">
            <h2 class="text-xl text-white font-thin"><?php echo esc_html($title); ?></h2>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('video-<?php echo $post_id; ?>');
            const playPauseButton = video.nextElementSibling.querySelector('.play-pause');
            const muteUnmuteButton = video.nextElementSibling.querySelector('.mute-unmute');
            const fullscreenButton = video.nextElementSibling.querySelector('.fullscreen');
            const progressBar = video.nextElementSibling.querySelector('.progress-bar');
            const progress = video.nextElementSibling.querySelector('.progress');

            let isPlaying = false;
            let isMuted = true;
            let isFullscreen = false;

            const updateProgress = () => {
                const value = (video.currentTime / video.duration) * 100;
                progress.style.width = `${value}%`;
            };

            playPauseButton.addEventListener('click', () => {
                if (isPlaying) {
                    video.pause();
                    playPauseButton.textContent = 'Play';
                } else {
                    video.play();
                    playPauseButton.textContent = 'Pause';
                }
                isPlaying = !isPlaying;
            });

            muteUnmuteButton.addEventListener('click', () => {
                video.muted = !isMuted;
                muteUnmuteButton.textContent = isMuted ? 'Mute' : 'Unmute';
                isMuted = !isMuted;
            });

            fullscreenButton.addEventListener('click', () => {
                if (!isFullscreen) {
                    if (video.requestFullscreen) {
                        video.requestFullscreen();
                    } else if (video.mozRequestFullScreen) {
                        video.mozRequestFullScreen();
                    } else if (video.webkitRequestFullscreen) {
                        video.webkitRequestFullscreen();
                    } else if (video.msRequestFullscreen) {
                        video.msRequestFullscreen();
                    } else if (video.webkitEnterFullscreen) {
                        video.webkitEnterFullscreen();
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    }
                }
                isFullscreen = !isFullscreen;
            });

            video.addEventListener('timeupdate', () => {
                updateProgress();
            });

            video.addEventListener('loadedmetadata', () => {
                updateProgress();
            });

            progressBar.addEventListener('click', (e) => {
                const clickPosition = e.clientX - progressBar.getBoundingClientRect().left;
                const progressBarWidth = progressBar.offsetWidth;
                const seekTime = (clickPosition / progressBarWidth) * video.duration;
                video.currentTime = seekTime;
            });

            video.parentElement.addEventListener('mouseenter', () => {
                video.play();
                isPlaying = true;
                playPauseButton.textContent = 'Pause';
            });

            video.parentElement.addEventListener('mouseleave', () => {
                video.pause();
                isPlaying = false;
                playPauseButton.textContent = 'Play';
            });

            // Intersection Observer for fade-in animation
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.remove('opacity-0', 'translate-y-4');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.project-item').forEach(item => {
                observer.observe(item);
            });
        });
    </script>
    <?php
}
?>