<h2><?= esc($title) ?></h2>

<a href="../news">Volver al listado de noticias</a>
<br /><br /><br />

<?php if (! empty($news) && is_array($news)) { ?>

<form action="./updated/<?= esc($news['id']) ?>" method="post">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <input type="text" name="title" value="<?= esc($news['title']) ?>">
    <br />

    <label for="body">Text</label>
    <textarea name="body" cols="45" rows="4">
            <?= esc($news['body']) ?>
        </textarea>
    <br />

    <label for="id_category">Category</label>
    <select name="id_category">

        <?php if (!empty($category) && is_array($category)) : ?>

        <?php foreach ($category as $category_item): ?>

        <option value="<?= $category_item['id'] ?>" <?php if ($category_item['id'] == esc($news['id_category'])): ?>
            selected <?php endif ?>>
            <?= $category_item['category'] ?>
        <option>

            <?php endforeach ?>

            <?php endif ?>

    </select>
    <br />
    <input type="submit" name="submit" value="Update item">
</form>

<?php } ?>