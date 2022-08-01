<?php
// Expected Input 
// {
//     searchKey:""
// }
include '../db-config.php';

// Defined headers 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data=json_decode(file_get_contents("php://input"),true);
$key=$data['searchKey'];

 try {
        $sql = $conn->prepare("SELECT * FROM users where name Like '%$key%' LIMIT 5");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
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