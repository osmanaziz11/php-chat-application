<?php
include '../db-config.php';
session_start();

// Defined headers 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$key=(isset($_SESSION['verify_username'])?$_SESSION['verify_username']:'@$#%');
 try {
        $sql = $conn->prepare("SELECT * from users where email IN (SELECT sender_ID from new_chat WHERE receiver_ID='$key')");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);  // Get Assoc array of all new chats
            if (is_countable($result) && count($result) > 0) {
            echo json_encode(array('record'=>$result,'status'=>1));
        } 
        else {
              echo json_encode(array('record'=>'No record found.','status'=>0));
        }
      
    } catch (PDOException $exc) {
    echo json_encode(array('record'=>'','status'=>403));
    }

?>