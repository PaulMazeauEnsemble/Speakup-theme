<div class="alphabet-navigation fixed bottom-0 w-full p-2 bg-black-bg">
    <div class="flex justify-center flex-wrap space-x-1 sm:space-x-2">
        <?php 
        $all_letters = range('A', 'Z');
        foreach ($all_letters as $letter) : 
            $is_used = in_array($letter, $used_letters);
        ?>
            <?php if ($is_used): ?>
                <a href="#<?php echo $letter; ?>" class="text-xs sm:text-sm md:text-base lg:text-lg alphabet-link font-DM font-thin text-white"><?php echo $letter; ?></a>
            <?php else: ?>
                <span class="text-xs sm:text-sm md:text-base lg:text-lg font-DM font-thin text-gray"><?php echo $letter; ?></span>
            <?php endif; ?>
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
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>
