<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD App Using CI 4 and Ajax</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>static/css/bootstrap.min.css">
</head>

<body>
    <!-- add new post modal start -->
    <div class="modal fade" id="add_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" id="add_post_form" novalidate>
                <!-- <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> -->
                <?= csrf_field() ?>
                    <div class="modal-body p-5">
                        <div class="mb-3">
                            <label>Post Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                            <div class="invalid-feedback">Post title is required!</div>
                        </div>

                        <div class="mb-3">
                            <label>Post Category</label>
                            <input type="text" name="category" class="form-control" placeholder="Category" required>
                            <div class="invalid-feedback">Post category is required!</div>
                        </div>

                        <div class="mb-3">
                            <label>Post Body</label>
                            <textarea name="body" class="form-control" rows="4" placeholder="Body" required></textarea>
                            <div class="invalid-feedback">Post body is required!</div>
                        </div>

                        <div class="mb-3">
                            <label>Post Image</label>
                            <input type="file" name="file" id="image" class="form-control" required>
                            <div class="invalid-feedback">Post image is required!</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="add_post_btn">Add Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- add new post modal end -->

    <!-- edit post modal start -->
    <div class="modal fade" id="edit_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" id="edit_post_form" novalidate>
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                    <input type="hidden" name="id" id="pid">
                    <input type="hidden" name="old_image" id="old_image">
                    <div class="modal-body p-5">
                        <div class="mb-3">
                            <label>Post Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title" required>
                            <div class="invalid-feedback">Post title is required!</div>
                        </div>

                        <div class="mb-3">
                            <label>Post Category</label>
                            <input type="text" name="category" id="category" class="form-control" placeholder="Category" required>
                            <div class="invalid-feedback">Post category is required!</div>
                        </div>

                        <div class="mb-3">
                            <label>Post Body</label>
                            <textarea name="body" class="form-control" rows="4" id="body" placeholder="Body" required></textarea>
                            <div class="invalid-feedback">Post body is required!</div>
                        </div>

                        <div class="mb-3">
                            <label>Post Image</label>
                            <input type="file" name="file" class="form-control">
                            <div class="invalid-feedback">Post image is required!</div>
                            <div id="post_image"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="edit_post_btn">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- edit post modal end -->

    <!-- detail post modal start -->
    <div class="modal fade" id="detail_post_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Details of Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img src="" id="detail_post_image" class="img-fluid">
                    <h3 id="detail_post_title" class="mt-3"></h3>
                    <h5 id="detail_post_category"></h5>
                    <p id="detail_post_body"></p>
                    <p id="detail_post_created" class="fst-italic"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- detail post modal end -->

    <div class="container">
        <div class="row my-4">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="text-secondary fw-bold fs-3">All Posts</div>
                        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#add_post_modal">Add New Post</button>
                    </div>
                    <div class="card-body">
                        <div class="row" id="show_posts">
                            <h1 class="text-center text-secondary my-5">Posts Loading..</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type='text/javascript' src="<?php echo base_url(); ?>static/js/jquery.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>static/js/bootstrap.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url(); ?>static/js/sweetalert.min.js"></script>
    <script>
        $(function() {
            // add new post ajax request
            $("#add_post_form").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                // $.get('<?= base_url('post/token') ?>').done((data) => {
                //     console.log(data, 'datanya')
                // })
                // return
                if (!this.checkValidity()) {
                    e.preventDefault();
                    $(this).addClass('was-validated');
                } else {
                    $("#add_post_btn").text("Adding...");
                    $.ajax({
                        url: '<?= base_url('post/add') ?>',
                        method: 'post',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            console.log(response, 'respon')
                            if (response.error) {
                                $("#image").addClass('is-invalid');
                                $("#image").next().text(response.message.image);
                            } else {
                                $("#add_post_modal").modal('hide');
                                $("#add_post_form")[0].reset();
                                $("#image").removeClass('is-invalid');
                                $("#image").next().text('');
                                $("#add_post_form").removeClass('was-validated');
                                Swal.fire(
                                    'Added',
                                    response.message,
                                    'success'
                                );
                                fetchAllPosts();
                            }
                            $("#add_post_btn").text("Add Post");
                        },
                        error: function(err) {
                            console.log(err, 'error nich')
                        }
                    });
                }
            });

            // edit post ajax request
            $(document).delegate('.post_edit_btn', 'click', function(e) {
                e.preventDefault();
                const id = $(this).attr('id');
                $.ajax({
                    url: '<?= base_url('post/edit/') ?>/' + id,
                    method: 'get',
                    success: function(response) {
                        $("#pid").val(response.message.id);
                        $("#old_image").val(response.message.image);
                        $("#title").val(response.message.title);
                        $("#category").val(response.message.category);
                        $("#body").val(response.message.body);
                        $("#post_image").html('<img src="<?= base_url('/images/posts') ?>/' + response.message.image + '" class="img-fluid mt-2 img-thumbnail" width="150">');
                    }
                });
            });

            // update post ajax request
            $("#edit_post_form").submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                if (!this.checkValidity()) {
                    e.preventDefault();
                    $(this).addClass('was-validated');
                } else {
                    $("#edit_post_btn").text("Updating...");
                    $.ajax({
                        url: '<?= base_url('post/update') ?>',
                        method: 'post',
                        data: formData,
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: 'json',
                        success: function(response) {
                            $("#edit_post_modal").modal('hide');
                            Swal.fire(
                                'Updated',
                                response.message,
                                'success'
                            );
                            fetchAllPosts();
                            $("#edit_post_btn").text("Update Post");
                        }
                    });
                }
            });

            // delete post ajax request
            $(document).delegate('.post_delete_btn', 'click', function(e) {
                e.preventDefault();
                const id = $(this).attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '<?= base_url('post/delete/') ?>/' + id,
                            method: 'get',
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                )
                                fetchAllPosts();
                            }
                        });
                    }
                })
            });
            // post detail ajax request
            $(document).delegate('.post_detail_btn', 'click', function(e) {
                e.preventDefault();
                const id = $(this).attr('id');
                $.ajax({
                    url: '<?= base_url('post/detail/') ?>/' + id,
                    method: 'get',
                    dataType: 'json',
                    success: function(response) {
                        $("#detail_post_image").attr('src', '<?= base_url('/images/posts') ?>/' + response.message.image);
                        $("#detail_post_title").text(response.message.title);
                        $("#detail_post_category").text(response.message.category);
                        $("#detail_post_body").text(response.message.body);
                        $("#detail_post_created").text(response.message.created_at);
                    }
                });
            });

            // fetch all posts ajax request
            fetchAllPosts();

            function fetchAllPosts() {
                $.ajax({
                    url: '<?= base_url('post/fetch') ?>',
                    method: 'get',
                    success: function(response) {
                        $("#show_posts").html(response.message);
                    }
                });
            }
        });
    </script>

</body>

</html>
