<?php

    include_once 'include/header.php';
    include_once 'include/sidebar.php';

    include_once '../classes/Category.php';
    $ct = new Category();

    include_once '../classes/Post.php';
    $post = new Post();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $post_add = $post->AddPost($_POST, $_FILES);
    }


?>


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-10">

                    <span>
                        <?php
                        if (isset($post_add)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?= $post_add ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    <span>

                            <div class="card shadow">
                                <h4 class="card-header">Post Add Form</h4>
                                <div class="card-body">


            <form action="" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="userId" class="form-control" value="<?=Session::get('userId')?>" />

                <div class="mb-3">
                    <label class="form-label">Post Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Post Title" />
                </div>

               <div class="mb-3">
                    <label class="form-label">Select Category</label>
                    <div class="form-group">
                      <select class="form-select" name="catId" id="">
                        <option>Select</option>

                        <?php 

                            $allCat = $ct->AllCategory();
                            if ($allCat) {
                                while($row = mysqli_fetch_assoc($allCat)){
                                    ?>
                                    <option value="<?=$row['catId']?>"><?=$row['catName']?></option>
                                    <?php
                                }
                            }

                        ?>

                      </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image One</label>
                    <input type="file" name="imageOne" class="form-control" placeholder="Category Name" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Description One</label>
                    <textarea name="disOne" id="classic-editor"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image Two</label>
                    <input type="file" name="imageTwo" class="form-control" placeholder="Category Name" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Description Two</label>
                    <textarea name="disTwo" id="classic-editor_two"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Post Type</label>
                    <div>
                        <select class="form-select" name="postType">
                            <option>Select</option>
                            <option value="1">Post</option>
                            <option value="2">Slider</option>
                            
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tags</label>
                    <input type="text" name="tags" class="form-control" placeholder="Post Tags" />
                </div>

                <div>
                    <div>
                        <button type="submit" class="btn btn-danger waves-effect waves-light me-1">
                            Add Post
                        </button>

                    </div>
                </div>
            </form>

                                </div>
                            </div>
                </div> <!-- end col -->


            </div> <!-- end row -->


        </div>
    </div>
</div>

<?php include_once 'include/footer.php'; ?>