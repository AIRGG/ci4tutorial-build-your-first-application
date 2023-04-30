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
            <td>
                <img src="/images/<?= esc($news_item['img']) ?>" alt="" style="height: 100px; width: auto">
            </td>
            <td class="text-nowrap">
                <a href="/news/<?= esc($news_item['slug'], 'url') ?>">View</a>
                <a class="btn btn-warning" href="/news/edit/<?= esc($news_item['id'], 'url') ?>">Edit</a>
                <!-- <a class="btn btn-danger" onclick="return confirm('Yakin??')" href="/news/delete/<?= esc($news_item['id']) ?>">Delete</a> -->
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#alertModal<?= esc($news_item['id']) ?>" >Delete</button>
            </td>
            <!-- Modal -->
            <div class="modal fade" id="alertModal<?= esc($news_item['id']) ?>" tabindex="-1" aria-labelledby="<?= esc($news_item['id']) ?>" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?= esc($news_item['id']) ?>">Yakin Delete?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?= esc($news_item['title']) ?>
                        <hr/>
                        <?= esc($news_item['body']) ?>
                        <hr/>
                        <?= esc($news_item['slug']) ?>
                        <hr/>
                        <img src="/images/<?= esc($news_item['img']) ?>" alt="" style="height: 100px; width: auto">
                        <br/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a  class="btn btn-danger" href="/news/delete/<?= esc($news_item['id']) ?>">Delete</a>
                    </div>
                    </div>
                </div>
            </div>
        </tr>
    <?php endforeach ?>

        </tbody>
    </table>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>
