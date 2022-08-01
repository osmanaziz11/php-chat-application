<?php
// Expected Input 
// {
//      message:"",
//      receiver:"",
//      time:"",
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
$msg=$data['message'];
$time=$data['time'];

  try {
      $sqlQuery = "INSERT INTO messages (sender_ID,receiver_ID,msg,time) Values(:from,:to,:msg,:time)";
      $sql = $conn->prepare($sqlQuery);
      $sql->execute([':from'=>$from,':to'=>$to,':msg'=>$msg,':time'=>$time]);
        echo json_encode(array('result'=>'','status'=>1));
   } catch (Exception $exc) {
        echo json_encode(array('result'=>'','status'=>0));
   }

?>