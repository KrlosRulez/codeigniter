<h2><?= esc($title) ?></h2>

<?php if (! empty($news) && is_array($news)): ?>

    <?php foreach ($news as $news_item): ?>

        <h3><?= esc($news_item['title']) ?></h3>

        <div class="main">
            <?= esc($news_item['body']) ?>
        </div>
        <h4><?= esc($news_item['category']) ?></h4>
        <p>
            <a href="news/<?= esc($news_item['slug'], 'url') ?>">
                View article
            </a>
            &nbsp;&nbsp;
            <a href="news/del/<?= esc($news_item['id'], 'url') ?>">
                Eliminar Noticia
            </a>
            &nbsp;&nbsp;
            <a href="news/update/<?= esc($news_item['id'], 'url') ?>">
                Actualizar Noticia
            </a>
        </p>

    <?php endforeach ?>

    <a href="news/new">Crear Noticia</a><br />

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>