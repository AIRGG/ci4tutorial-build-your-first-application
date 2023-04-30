<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/news/edit/<?= $data['id'] ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <label for="title">Title</label>
    <!-- <?php print_r($data) ?> -->
    <input class="form-control" type="input" name="title" value="<?= set_value('title') ?><?= $data['title'] ?>">
    <br>

    <label for="body">Text</label>
    <textarea class="form-control" name="body" cols="45" rows="4"><?= set_value('body') ?><?= $data['body'] ?></textarea>
    <br>

    <label for="image">Change Image?</label>
    <input class="form-control" type="file" name="image" value="<?= set_value('image') ?>" accept=".png, .jpg, .jpeg">
    <br>
    <input class="form-control" type="hidden" name="image-old" value="<?= set_value('img') ?><?= $data['img'] ?>">
    <img src="/images/<?= esc($data['img']) ?>" alt="" style="height: 100px; width: auto">
    <input type="checkbox" id="image-delete" name="image-delete" value="yes"> <label for="image-delete">Delete Image?</label>
    <br>
    <br>

    <input class="btn btn-primary" type="submit" name="submit" value="Edit item">
    <a href="/news">Kembali</a>
</form>
