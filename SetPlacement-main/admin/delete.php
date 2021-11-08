<?php
session_start();
require_once'../connect.php';

$id = $_GET['id']; // get id through query string

try{
    $del = $conn->prepare("DELETE FROM setplacement.student s WHERE rollNo = $id"); // delete query
    if($del->execute()){
        $count=$del->rowcount();
        echo "$count";
        echo "\nUser deleted";
    }
}catch(Execption $err){
          echo $err->getMessage();

}

?>