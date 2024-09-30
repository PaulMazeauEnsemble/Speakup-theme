<div class="alphabet-navigation fixed bottom-0 w-full p-2 bg-black-bg">
    <div class="flex justify-center flex-wrap space-x-1 sm:space-x-2">
        <?php foreach (range('A', 'Z') as $letter) : ?>
            <a href="#<?php echo $letter; ?>" class="text-white text-xs sm:text-sm md:text-base lg:text-lg hover:text-gray-400 alphabet-link font-Space font-thin"><?php echo $letter; ?></a>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.alphabet-link');
    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Ajustez cette valeur selon la hauteur de votre header fixe
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
