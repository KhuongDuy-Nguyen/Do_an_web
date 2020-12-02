<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/e8a97a7194.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <div id="form-container">
        <div id="background"></div>
        <div id="form-overlay">
            <div id="logo"></div>
            <div id="bg-decorate"></div>
            <!--<div id="pattern-line"></div>-->
            <form id="form-content" action="login.php" method="post">
                <div id="content"><h2 id="login-title">Sign Up</h2>
                    <input name ="name" id="input" type="text" placeholder="Name">
                    <input name ="username "id="input" type="text" placeholder="username">
                    <input name ="pass" id="input" type="password" placeholder="Password"></div>
                    <button type="submit" id="login-button">Signup</button>
                    
                    <div id="verline"></div>
            </form>
            
        </div>
    </div>
</body>
</html>