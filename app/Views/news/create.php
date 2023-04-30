<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news/create" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <input class="form-control" type="input" name="title" value="<?= set_value('title') ?>">
    <br>

    <label for="body">Text</label>
    <textarea class="form-control" name="body" cols="45" rows="4"><?= set_value('body') ?></textarea>
    <br>

    <label for="image">Image Upload</label>
    <input class="form-control" type="file" name="image" value="<?= set_value('image') ?>" accept=".png, .jpg, .jpeg">
    <br>

    <input class="btn btn-primary" type="submit" name="submit" value="Create news item">
    <a href="/news">Kembali</a>
</form>
