<?php

include_once 'include/header.php';
include_once 'include/sidebar.php';

include_once '../classes/Category.php';
$ct = new Category();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];

    $catAdd = $ct->AddCategory($catName);
}

?>


<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">

                    <span>
                        <?php
                        if (isset($catAdd)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?=$catAdd?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    <span>

                            <div class="card shadow">
                                <h4 class="card-header">Category Add Form</h4>
                                <div class="card-body">


                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" name="catName" class="form-control" placeholder="Category Name" />
                                        </div>


                                        <div>
                                            <div>
                                                <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                    Add Category
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