<?php
    define('HOST','8.0.8.0');
    define('USER','root');
    define('PASS','');
    define('DB','user');

    function open_databasse(){
        $conn = new mysqli(HOST,USER,PASS,DB);
        if($conn->connect_error){
            die('Connect error'. $conn->connect_error);
        }
        return $conn;
    }

    function login($user, $pass){
        $sql ="select * from account where username = ?";
        $conn = open_databasse();

        $stm = $conn->prepare($sql);
        $stm->bind_param('s',$user);
        if(!$stm->execute()){
            return null;
        }

        $result = $stm->get_result();
        $data = $result->fetch_assoc();

        $hashed_password = $data['password'];
        if(!password_verify($pass, $hashed_password)){
            return null;
        }else return $data
    }

?>