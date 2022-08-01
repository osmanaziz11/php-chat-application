<?php
// Expected Input 
// { 
//      receiver:"",
// }
include '../db-config.php';
session_start();
// Defined headers 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data=json_decode(file_get_contents("php://input"),true);
$from=(isset($_SESSION['verify_username'])?$_SESSION['verify_username']:'@$#%');
$to=$data['receiver'];
  try {
      $sqlQuery = "INSERT INTO new_chat (sender_ID,receiver_ID) Values(:from,:to)";
      $sql = $conn->prepare($sqlQuery);
      $sql->execute([':from'=>$from,':to'=>$to]);
        echo json_encode(array('result'=>'','status'=>1));
   } catch (Exception $exc) {
        echo json_encode(array('result'=>'','status'=>0));
   }

?>