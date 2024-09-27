<div class="alphabet-navigation fixed bottom-0 w-full p-4">
    <div class="flex justify-center space-x-2">
        <?php foreach (range('A', 'Z') as $letter) : ?>
            <a href="#<?php echo $letter; ?>" class="text-white hover:text-gray-400"><?php echo $letter; ?></a>
        <?php endforeach; ?>
    </div>
</div>
