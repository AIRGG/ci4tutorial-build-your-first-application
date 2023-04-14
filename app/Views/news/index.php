<h2><?= esc($title) ?></h2>

<?php if (! empty($news) && is_array($news)): ?>

    <a href="/news/create">Tambah</a>
    <table class="table table-bordered">
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
            <td class="text-nowrap">
                <a href="/news/<?= esc($news_item['slug'], 'url') ?>">View</a>
                <a class="btn btn-warning" href="/news/edit/<?= esc($news_item['id'], 'url') ?>">Edit</a>
                <a class="btn btn-danger" onclick="return confirm('Yakin??')" href="/news/delete/<?= esc($news_item['id']) ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach ?>

        </tbody>
    </table>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>
