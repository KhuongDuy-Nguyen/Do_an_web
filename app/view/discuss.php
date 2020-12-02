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
            <li class="nav-item ">
                <a class="nav-link" href="intoClass.php">Luồng</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="people.php">Mọi người</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="discuss.php">Thảo luận</a>
            </li>
        </ul>
    </div>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="fas fa-sign-out-alt"></span>  Logout</a></li>
    </ul>
</nav>

<!-- khu vuc hoi va tra loi -->
<div class="container mt-3">
    <div class="row">
        <div class="col-7">
            <!-- khu vuc post bai -->
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
                </div>
                <?php
            }
            ?>
        </div>

        <div class="col-5">
            <!-- khu vuc thao luan -->
        </div>
    </div>
</div>

<?php
$sql_ask = "SELECT * FROM discuss";
if (isset($_GET["IDPost"])) {
    $post_ask = $_GET["IDPost"];
    $sql_ask .= " WHERE IDPost='$post_ask'";
}
$result_ask = $conn->query($sql_ask);
while ($ask=$result_ask->fetch_assoc()) {
?>
    <div class="card-body">
        <a class="card-title"><?= $ask['email'] ?></a>
        <p class="card-text"><?= $ask['content'] ?></p>
    </div>
<?php
}
?>
<div class="ask_and_answer">

    <!-- End vong lap trao doi -->
    <form method="post" novalidate enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" id="idPost" name="idPost" value="<?=$idPost = 1?>">
            <input type="hidden" id="id" name="id" value="<?=$idAsk = 1?>">
            <div class="form-group">
                <label for="content"></label>
                <input type="text" id="content" name="content" value="<?=$content?>" class="form-control" placeholder="Message"></div>
            <button type="submit" class="btn btn-success">Send</button>
        </div>
    </form>
</div>
</body>
