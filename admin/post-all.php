<?php

include_once 'include/header.php';
include_once 'include/sidebar.php';
include_once '../classes/Post.php';
$pt = new Post();

include_once '../helpers/Format.php';
$fr = new Format();

$userId = Session::get('userId');
$allPost = $pt->GetAllPost($userId);

//Active
if (isset($_GET['active'])) {
    $aid = $_GET['active'];
    $active = $pt->activePost($aid);
}

//deactive
if (isset($_GET['deactive'])) {
    $did = $_GET['deactive'];
    $deactive = $pt->deactivePost($did);
}

if (isset($_GET['delpost'])) {
    $id = $_GET['delpost'];
    $deletePost = $pt->deletePost($id);
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
                        if (isset($deletePost)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?= $deletePost ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    <span>

                    <span>
                        <?php
                        if (isset($active)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?= $active ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    <span>

                    <span>
                        <?php
                        if (isset($deactive)) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?= $deactive ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                    <span>

    <div class="card">
        <h5 class="card-header">All Post</h5>
        <div class="card-body">

            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Img 1</th>
                        <th>Img 2</th>
                        <th>PostType</th>
                        <th>Tags</th>
                        <th>Action</th>
                    </tr>
                </thead>


                <tbody>

                    <?php
                    if ($allPost) {
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($allPost)) {
                            $i++;
                    ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['catName'] ?></td>
                                <td><img style="width: 70px;" src="<?=$row['imageOne']?>" alt=""></td>
                                <td><img style="width: 70px;" src="<?=$row['imageTwo']?>" alt=""></td>
                                <td><?php 
                                    if ($row['postType'] == 1) {
                                        echo 'Post';
                                    }else {
                                        echo 'Slider';
                                    }
                                ?></td>
                                <td><?= $fr->textShorten($row['tags'], 4) ?></td>
                                <td>
                                   <a href="postedit.php?editPost=<?=base64_encode($row['postId'])?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                   <a href="?delpost=<?=$row['postId']?>" onclick="return confirm('Are You Sure To Delete')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                   <a href="" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#myModal-<?=$row['postId']?>"><i class="fas fa-eye"></i></a>

                                    <?php 
                                        if ($row['status'] == 0) {
                                            ?>
                                        <a href="?deactive=<?=$row['postId']?>" class="btn btn-sm btn-warning"><i class="fas fa-arrow-down"></i></a>
                                            <?php
                                        }else {
                                            ?>
                                        <a href="?active=<?=$row['postId']?>" class="btn btn-sm btn-success"><i class="fas fa-arrow-up"></i></a>
                                            <?php
                                        }
                                    ?>

                                    
                                   
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
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
</div>


<?php 

    $modelData = $pt->modelData();
    if ($modelData) {
        while ($mrow = mysqli_fetch_assoc($modelData)) {
            ?>
<div id="myModal-<?=$mrow['postId']?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                <td><label for="">Title</label></td>
                <td><?=$mrow['title']?></td>
            </tr>
             <tr>
                <td><label for="">Category</label></td>
                <td><?=$mrow['catName']?></td>
            </tr>
             <tr>
                <td><label for="">Image</label></td>
                <td><img style="width: 200px;" src="<?=$mrow['imageOne']?>" alt=""></td>
            </tr>
            <tr>
                <td><label for="">Details One</label></td>
                <td><?=$mrow['disOne']?></td>
            </tr>
            <tr>
                <td><label for="">Image</label></td>
                <td><img style="width: 200px;" src="<?=$mrow['imageTwo']?>" alt=""></td>
            </tr>
            <tr>
                <td><label for="">Details One</label></td>
                <td><?=$mrow['disTwo']?></td>
            </tr>
            <tr>
                <td><label for="">Post Type</label></td>
                <td><?php 
                    if ($mrow['postType'] == 1) {
                        echo "Post";
                    }else {
                        echo "Slider";
                    }
                ?></td>
            </tr>
            <tr>
                <td><label for="">Tags</label></td>
                <td><?=$mrow['tags']?></td>
            </tr>
        </table>
            
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
            <?php
        }
    }

?>

 



<?php include_once 'include/footer.php'; ?>