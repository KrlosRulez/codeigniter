<h2>
    <?= esc($title) ?>
</h2>

<?php if (!empty($categories) && is_array($categories)): ?>

    <?php foreach ($categories as $categories_item): ?>

        <br />

        <h3>
            <?= esc($categories_item['category']) ?>
        </h3>

    <?php endforeach ?>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>