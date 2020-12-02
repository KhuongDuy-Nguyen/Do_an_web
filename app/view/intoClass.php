<?php
require_once('../base/db.php');
open_database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Classroom</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->
    <link href="../fontawesome/css/all.css" rel="stylesheet">
    <link href="../fontawesome/css/fontawesome.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous" />
    

</head>
<body>
    <!-- Start header --->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample08"
            aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <a class="navbar-brand" href="#">
            <img src="https://img.icons8.com/plasticine/2x/google-classroom.png" width="50" height="50"
                class="d-inline-block " alt="">
            Classroom
        </a>
    
        <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./intoClass.php">Luồng</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./people.php">Mọi người</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="./discuss.php">Thảo luận</a>
                </li>
            </ul>
        </div>
        <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form> -->
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="fas fa-sign-out-alt"></span>  Logout</a></li>
        </ul>
    </nav>


    <?php

    require_once('../base/db.php');

    $error = '';
    $title = '';
    $file = '';
    $content = '';
    $id = '';
    $url = '';

    if (isset($_POST['action'])){
        $action = $_POST['action'];
        if ($action == 'add'){
            if(isset($_POST['title']) && isset($_POST['content']) || isset($_POST['fileToUpload']) || isset($_POST['url'])){
                $title = $_POST['title'];
                $content = $_POST['content'];
                $file = $_POST['file'];
                $url = $_POST['url'];
                if(empty($title)){
                    $error = 'Write something in Title';
                }elseif (empty($content)){
                    $error = 'Write something in content';
                }else{
                    add_poster($title,$content,$url,$file);
                }
            }
        }elseif ($action == 'delete'){
            if(isset($_POST['idPost'])){
                $id = $_POST['idPost'];
                if(empty($id)){
                    $error = 'Choose ID Post you want to delete';
                }else{
                    delete_poster($id);
                }
            }
        }
    }
    ?>


    <div class="container  ">
        <img src="https://gstatic.com/classroom/themes/img_code.jpg" class="img-fluid col-12 mt-3" alt="">
        <div class="card-deck mt-3 ">
            <!-- card message -->
            <div class="col-10 ">
                <?php
                require_once('../base/db.php');
                $content = '';
                $idAsk = '';
                $idPost='';
                $error = '';
                //Vong lap
                $sql_poster = "SELECT * FROM poster";
                if (isset($_GET["IDPost"])) {
                    $post_main = $_GET["IDPost"];
                    $sql_poster .= " WHERE IDPost='$post_main'";
                }
                $result_poster = $conn->query($sql_poster);
                while ($post=$result_poster->fetch_assoc()) {
                    ?>
                <!-- Khu vuc dang bai -->
                <div class="card post mt-3">
                    <div class="card-body">
                        <h4 class="card-title"><?= $post['email'] ?></h4>
                        <h5 class="card-text"><?= $post['title'] ?></h5>
                        <p class="card-text"><?= $post['content'] ?></p>
                        <p class="card-text"><?= $post['url'] ?></p>
                        <p class="card-text"><?= $post['file'] ?></p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text">ID Post: <?= $post['IDPost'] ?></p>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <!-- end card message -->
            <div class="col-2 mt-3">
                <button type="button" class="btn btn-outline-success fas fa-plus" data-toggle="modal" data-target="#new-post-dialog"> Add Post</button>
                <button type="button" class="btn btn-outline-danger fas fa-trash-alt mt-3" data-toggle="modal" data-target="#delete-post-dialog"> Delete Post</button>
            </div>
        </div>
    </div>


    <!-- them bai post -->
    <div class="modal fade" id="new-post-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="" novalidate enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input value="<?= $title ?>" type="text" name="title" placeholder="Title" class="form-control" id="title"/>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content" placeholder="Content" rows="3"><?= $content ?></textarea>
                        </div>
                        <!-- URL -->
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" class="form-control" value="<?= $url ?>" name ="url" id="url" placeholder="https://example.com/">
                        </div>
                        <!-- File -->
                        <div class="form-group">
                            <label for="file"> Select file to upload:</label>
                            <input type="file" name="file" id="file" class="form-control"> <?= $file ?>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <input type="hidden" name="action" value="add">
                            <button type="submit" class="btn btn-success">Add</button>
                        </div>
                        <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Xoa post -->
    <div class="modal fade" id="delete-post-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="" novalidate enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="idPost">ID Post</label>
                            <input value="<?= $id ?>" type="text" name="idPost" placeholder="ID you want to delete" class="form-control" id="idPost"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="form-group">
                            <div class="form-group">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                            <?php
                            if (!empty($error)) {
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>