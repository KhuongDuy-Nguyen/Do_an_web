<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Active</title>
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
<?php
require_once ('../base/db.php');
    $message = '';
    $active ='';
    $email = '';
    if(isset($_GET['email'])){
        $email = $_GET['email'];

        $result = active_invite($email);
        if ($result['code'] == 0){
            $message = 'Your account has been joined.';

        }else{
            $error = $result['error'];
        }
    }

?>

    <div class="container">
        <div class="container d-flex justify-content-center mt-5">
            <img src="https://img.icons8.com/plasticine/2x/google-classroom.png" width="100" height="100"
                class="d-inline-block " alt="">
        </div>
        <div class="text">
            <div class="text-center">
                <h4>Hi, have a good day!</h4 >
                <p class="text-success"><?= $message ?></p>
                Click the button below to join the classroom
                <hr>
            </div>
            <form action="" method="post" >
                <div class="d-flex justify-content-center">
                    <input type="hidden" name="active" value="oke">
                    <a class="btn btn-primary btn-lg" href="intoClass.php">Join Now</a>
                </div>
            </form>




        </div>
    </div>
    
    
    
</body>
</html>