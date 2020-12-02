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
<?php
    $email = '';
    $content = '';
    if (isset($_POST['content'])){

        $content = $_POST['content'];
        $email = $_POST['email'];
        if(empty($content)){
            $error = 'ask something...';
        }else{
            discuss($email,$content);
        }
    }
?>


<!-- khu vuc hoi va tra loi -->
<div class="container mt-3">
    <div class="screen">
        <div class="card">
            <?php
            $sql_discuss= "SELECT * FROM discuss ";
            if (isset($_GET["email"])) {
                $email = $_GET["email"];
                $sql_discuss .= " WHERE email='$email'";
            }
            $result = $conn->query($sql_discuss);
            while ($post=$result->fetch_assoc()) {
                ?>
                <div class="card-body">
                    <h5 class="card-text"><?= $post['email'] ?></h5>
                    <p class="card-text"><?= $post['content'] ?></p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="discuss">
        <form method="post" novalidate enctype="multipart/form-data">
            <div class="form-group">
                <input type="hidden" id="email" name="email" value="ad@gmail.com">
                <div class="input-group">
                    <label for="content"></label>
                    <input type="text" id="content" name="content" value="<?=$content?>" class="form-control" placeholder="Ask something...">
                    <button type="submit" class="btn btn-success">Send</button>
                </div>

            </div>
        </form>
    </div>
</div>



</body>
