<h2><?= esc($title) ?></h2>

<?php if (! empty($news) && is_array($news)): ?>

    <a href="/news/create">Tambah</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <th>Title</th>
            <th>Description</th>
            <th>Slug</th>
            <th>Action</th>
        </thead>
        <tbody>
    <?php foreach ($news as $news_item): ?>
        <tr>
            <td><?= esc($news_item['title']) ?></td>
            <td><?= esc($news_item['body']) ?></td>
            <td><?= esc($news_item['slug']) ?></td>
            <td>
                <a href="/news/<?= esc($news_item['slug'], 'url') ?>">View</a>
                <a href="/news/edit/<?= esc($news_item['id'], 'url') ?>">Edit</a>
                <a href="/news/delete/<?= esc($news_item['id']) ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach ?>

        </tbody>
    </table>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>