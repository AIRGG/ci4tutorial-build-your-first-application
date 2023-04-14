<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news/edit/<?= $data['id'] ?>" method="post">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <!-- <?php print_r($data) ?> -->
    <input class="form-control" type="input" name="title" value="<?= set_value('title') ?><?= $data['title'] ?>">
    <br>

    <label for="body">Text</label>
    <textarea class="form-control" name="body" cols="45" rows="4"><?= set_value('body') ?><?= $data['body'] ?></textarea>
    <br>

    <input class="btn btn-primary" type="submit" name="submit" value="Edit item">
    <a href="/news">Kembali</a>
</form>
