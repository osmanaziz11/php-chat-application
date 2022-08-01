<?php
// Expected Input 
// {
//      name:"",
//      email:"",
//      password:"",
//      phone:""
// }
include '../db-config.php';

// Defined headers 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data=json_decode(file_get_contents("php://input"),true);
$name=$data['name'];
$user=$data['email'];
$pass=$data['password'];
$phone=$data['phone'];

  try {
      $sqlQuery = "INSERT INTO users (name,email,password,phone) Values(:name,:email,:password,:phone)";
      $sql = $conn->prepare($sqlQuery);
      $sql->execute([':name'=>$name,':email'=>$user,':password'=>$pass,':phone'=>$phone]);
        echo json_encode(array('result'=>'','status'=>1));
   } catch (Exception $exc) {
        echo json_encode(array('result'=>'','status'=>0));
   }

?>