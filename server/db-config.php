<?php

// Host IP Address
$hostname = 'http://localhost:81/Malatist/';
// Database Connection 
try{
    $db_name = 'mysql:host=localhost;dbname=malatist;';
    $username = 'root';
    $passowrd = '';
    $conn = new PDO($db_name, $username, $passowrd);
   
} catch (PDOException $exception) {
    $error = $exception->getMessage();
    echo '<script>alert("' . $error . '")</script>';
}

?>