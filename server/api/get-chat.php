<?php
// expected input 
// {
//     receiver_ID:""
// }
include '../db-config.php';
session_start();
// Defined headers 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: post");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data=json_decode(file_get_contents("php://input"),true);
$sender=(isset($_SESSION['verify_username'])?$_SESSION['verify_username']:'@$#%');
$receiver=$data['receiver_ID'];

 try {
        $sql = $conn->prepare("SELECT * from messages  where sender_ID='$sender' AND receiver_ID='$receiver' OR sender_ID='$receiver' AND receiver_ID='$sender' ORDER BY `msgId` ASC");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);  // Get Assoc array of all recent chats
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