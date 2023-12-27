<?php

include_once 'include/header.php';
include_once 'include/sidebar.php';
include_once '../classes/Category.php';
$ct = new Category();

$allCat = $ct->AllCategory();

if (isset($_GET['delCat'])) {
    $id = base64_decode($_GET['delCat']);
    $deleteCat = $ct->DeleteCategory($id);
}


?>

<?php
if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
}
?>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <span>
                        <?php
                        if (isset($deleteCat)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?= $deleteCat ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                        <span>

<div class="card">
    <h5 class="card-header">Category List</h5>
    <div class="card-body">

        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody>

                <?php
                if ($allCat) {
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($allCat)) {
                        $i++;
                ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row['catName'] ?></td>
                            <td>
                                <a href="catEdit.php?editId=<?= base64_encode($row['catId']) ?>" class="btn btn-success btn-sm">Edit</a>
                                <a href="?delCat=<?= base64_encode($row['catId']) ?>" onclick="return confirm('Are Your Sure to Delete - <?= $row['catName'] ?>')" class="btn btn-sm btn-danger">Delete</a>
                                <a href="javascript:avoid(0)" data-bs-toggle="modal" data-bs-target="#myModal-<?=$row['catId']?>" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>



            </tbody>
        </table>

    </div>
</div>
                </div> 
            </div> 

        </div>
    </div>
</div>


<?php 

    $category = $ct->modelData();
    if ($category) {
        while ($catRow = mysqli_fetch_assoc($category)) {
            ?>
<div id="myModal-<?=$catRow['catId']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            
            <table class="table table-bordered">
                <tr>
                    <td><label for="">CatName :</label></td>
                    <td><?=$catRow['catName']?></td>
                </tr>
            </table>
                
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
        </div>
    </div>
</div>
</div>
            <?php
        }
    }

?>

 



<?php include_once 'include/footer.php'; ?>