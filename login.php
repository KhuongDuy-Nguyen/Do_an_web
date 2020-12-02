<?php
    session_start();

    if(isset($_SESSION['user'])){
        header('Location:index.php');
        exit();
    }
    require_once('dbConnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e8a97a7194.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        $error = '';
        $user = '';
        $pass = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user = $_POST['username'];
            $pass = $_POST['pass'];
            
            if(empty($user)){
                $error = 'Please Enter username';
            }else if(empty($pass)){
                $error = 'Please Enter password';
            }else{
                $data = login($user, $pass);
                if($data){
                    $_SESSION['user'] = $user;
                    $_SESSION['name'] = $data['Name'];

                    header('Location:index.php');
                    exit();
                }else{
                    $error = 'Invalid Login';
                }
            }
    ?>
    <div id="form-container">
        <div id="background"></div>
        <div id="form-overlay">
            <div id="logo"></div>
            <div id="bg-decorate"></div>
            <!--<div id="pattern-line"></div>-->
            <form id="form-content" action="login.php" method="post">
                <div id="content"><h2 id="login-title">Login</h2>
                    <input value="<?$user?>"name ="username "id="input" type="text" placeholder="username">
                    <input value="<?$pass?>"name ="pass" id="input" type="password" placeholder="Password"></div>
                    <a id="forgot" href="">Forgot password?</a>
                    <button type="submit" id="login-button">Login</button>
                    <?php
                        if(!empty($error)){
                            echo '<div class="alert alert-danger">'. $error.'</div>';
                        }
                    ?>
                    <div id="verline"></div>
            </form>
                <div id="information">
                    <div id="text1">Join Us for course!</div>
                    <div><a href="/signup.php" id="signup-button">Sign up</a></div>
                </div>
            
        </div>
    </div>
</body>
</html>