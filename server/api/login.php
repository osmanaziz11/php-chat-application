<?php

include '../db-config.php';

// Defined headers 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data=json_decode(file_get_contents("php://input"),true);
$user=$data['userId'];
$pass=$data['userPassword'];

 try {
        $sql = $conn->prepare("SELECT * FROM users where email=:username AND password=:password");
        $sql->execute([':username'=>$user,':password'=>$pass]);
        $result = $sql->fetch(PDO::FETCH_ASSOC);
      //   if user exist create session
            if (is_countable($result) && count($result) > 0) {
              session_start();
            $_SESSION['verify_name'] = $result['name'];
            $_SESSION['verify_username'] = $user;
            $_SESSION['verify_password'] = $pass;
            echo json_encode(array('record'=>$result,'status'=>1));
        } 
      //   if not send response to 0
        else {
              echo json_encode(array('record'=>'','status'=>0));
        }
      
    } catch (PDOException $exc) {
    echo json_encode(array('record'=>'','status'=>403));
    }

?>