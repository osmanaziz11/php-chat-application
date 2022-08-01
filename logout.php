<?php 
include 'server/db-config.php';
session_start();
$user=(isset($_SESSION['verify_username'])?$_SESSION['verify_username']:'@$#%');
$time=date("g:i A");
echo $time;
  try {
      $sqlQuery = "UPDATE `users` SET `last_active` = '$time' WHERE `email` = '$user'";
      $sql = $conn->prepare($sqlQuery);
      $sql->execute();
      $sqlQuery = "DELETE FROM `new_chat` WHERE receiver_ID = '$user'";
      $sql = $conn->prepare($sqlQuery);
      $sql->execute();
       session_unset();
       session_destroy();
        header('Location:http://localhost:81/Malatist/');
   } catch (Exception $exc) {
        echo json_encode(array('result'=>'','status'=>0));
   }

?>