<?php

    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Load Composer's autoload
    require '../vendor/autoload.php';

    define('HOST','127.0.0.1');
    define('USER','root');
    define('PASS','');
    define('DB','manager_into_class');

    $conn = new mysqli(HOST,USER,PASS,DB);

    function open_database(){
        $conn = new mysqli(HOST,USER,PASS,DB);
        $conn->set_charset('utf8');
        if($conn->connect_error){
            die('Connect Error'.$conn->connect_error);
        }return $conn;
    };


    function login($user,$pass){
        $sql = "select * from account where username=?";
        $conn = open_database();

        $stm = $conn->prepare($sql);
        $stm->bind_param('s',$user);
        if (!$stm->execute()){
            return array('code' => 1, 'error' => 'Can not execute command:'.$stm->error);
        }

        $result = $stm->get_result();

        if($result->num_rows == 0){
            return array('code' => 1, 'error' => 'User does not exists');
        }

        $data = $result->fetch_assoc();

        $hash_password = $data['password'];
        if(!password_verify($pass,$hash_password)){
            return array('code' => 2, 'error' => 'Invalid password');
        }else if($data['activated'] == 0){
            return array('code' => 3, 'error' => 'This account is not active');
        }else return
            array('code' => 0, 'error' => '','data' => $data );
    }

    function is_email_exists($email){
        $sql = "select ID from user_class where email = ? ";
        $conn = open_database();

        $stm = $conn->prepare($sql);
        $stm->bind_param('s',$email);
        if(!$stm->execute()){
            die('Query error:'.$stm->error);
        }
        $result = $stm->get_result();
        if($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    function register($user,$pass,$first,$last,$email){
        if(is_email_exists($email)){
            return array('code' => 1, 'error' => 'Email exitst');
        }

        $hash = password_hash($pass,PASSWORD_DEFAULT);
        $rand = random_int(0,1000);
        $token = md5($user."+".$rand);

        $sql = 'insert into account(username,firstname,lastname,email,password, activate_token)value(?,?,?,?,?,?)';

        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssssss',$user,$first,$last,$email,$hash,$token);

        if(!$stm->execute()){
            return array('code' => 2, 'error' => 'Can not execute command');
        }
        send_activation_email($email,$token);
        return array('code' => 0, 'error' => 'Create account success');
    }

    function add_poster($title,$content,$url,$file){
        $sql = 'insert into poster(email,title,content,url,file)values("admin@gmail.com",?,?,?,?)';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ssss',$title,$content,$url,$file);

        if(!$stm->execute()){
            return array('code' => 2, 'error' => 'Can not execute command');
        }
        return array('code' => 0, 'error' => 'Create account success');
    }

    function delete_poster($id){
    $sql = 'delete from poster where IDPost = ? ';
    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('s',$id);
    if(!$stm->execute()){
        return array('code' => 2, 'error' => 'Can not execute command');
    }
    return array('code' => 0, 'error' => 'Delete account success');
}

    function ask_answer($idPost,$id,$content){
        $sql = 'insert into ask_answer(IDPost,ID,Content) values(?,?,?)';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('iss',$idPost,$id,$content);
        if(!$stm->execute()){
            return array('code' => 2, 'error' => 'Can not execute command');
        }
        return array('code' => 0, 'error' => 'Add success');
    }

    function invite_user($name,$email){
    if(is_email_exists($email)){
        return array('code' => 1,'error' =>'Email have exist. Try another email');
    }
    $sql = 'insert into user_class(ID,email)values(?,?)';
    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('ss',$name,$email);

    if(!$stm->execute()){
        return array('code' => 2, 'error' => 'Can not execute command');
    }
    return array('code' => 0, 'error' => 'Invite account success');
}

    function kick_user($name,$email){
    if(!is_email_exists($email)){
        return array('code' => 1,'error' =>'Email does not exist');
    }
    $sql = 'delete from user_class where ID = ? and email = ? ';
    $conn = open_database();
    $stm = $conn->prepare($sql);
    $stm->bind_param('ss',$name,$email);
    if(!$stm->execute()){
        return array('code' => 2, 'error' => 'Can not execute command');
    }
    return array('code' => 0, 'error' => 'Delete account success');
}

    function send_activation_email($email, $token){
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';                           // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = 'duyntkhcm@gmail.com';                     // SMTP username
            $mail->Password = 'rkbdfkxznjtmqrcl';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('duyntkhcm@gmail.com', 'Admin');
            $mail->addAddress($email, 'User');     // Add a recipient
            /*$mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');*/

            // Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Kích hoạt tài khoản';
            $mail->Body = "Nhấn vào <a href='http://localhost/Lab8/active.php?email=$email&token=$token'>đây</a> để kích hoạt tài khoản của bạn.";
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    function send_resert_email($email, $token){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->CharSet='UTF-8';
        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   // Enable SMTP authentication
        $mail->Username = 'duyntkhcm@gmail.com';                     // SMTP username
        $mail->Password = 'rkbdfkxznjtmqrcl';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('duyntkhcm@gmail.com', 'Admin');
        $mail->addAddress($email, 'User');     // Add a recipient
        /*$mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');*/

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Khôi phục mật khẩu';
        $mail->Body = "Nhấn vào <a href='http://localhost/Lab8/reset_password.php?email=$email&token=$token'>đây</a> để khôi phục mật khẩu của bạn.";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


    function activate_account($email, $token){
        $sql = 'select  username from account where email = ? and activate_token = ? and activated = 0';

        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ss',$email,$token);

        if(!$stm->execute()){
            return array('code' => 1,'error' => 'Can not execute command');
        }
        $result = $stm->get_result();
        if($result->num_rows == 0){
            return array('code' => 2,'error' => 'Email or token not found');
        }
        //found
        $sql = "update account set activated =1, activate_token='' where email = ?";
        $stm = $conn->prepare($sql);
        $stm->bind_param('s',$email);
        if(!$stm->execute()){
            return array('code' => 1,'error' => 'Can not execute command');
        }
        return array('code' => 0,'message' => 'Account activated');
    }

    function reset_password($email){
        if(!is_email_exists($email)){
            return array('code' => 1,'error' =>'Email does not exist');
        }
        $token = md5($email."+".random_int(1000,2000));
        $sql = 'update reset_token set token=? where email = ?';
        $conn = open_database();
        $stm = $conn->prepare($sql);
        $stm->bind_param('ss',$token,$email);

        if(!$stm->execute()){
            return array('code' => 2,'error' =>'Can not execute command');
        }
        if($stm->affected_rows == 0){
            $exp = time() +3600 *24;    //het han sau 24h

            $sql = 'insert into reset_token values(?,?,?)';
            $stm = $conn->prepare($sql);
            $stm ->bind_param('ssi',$email,$token,$exp);

            if(!$stm->execute()){
                return array('code' => 1,'error' =>'Can not execute command');
            }
        }
        $success = send_resert_email($email,$token);
        return array('code' => 0,'success' =>$success);

    }


?>