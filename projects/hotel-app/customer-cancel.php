<?php 
require "config/connectdb.php";
$guestID = $_GET['guestID'];
echo $guestID;

$stmt = "DELETE FROM guests where guestID = $guestID";
echo $stmt;
$stmt2 = $pdo->prepare($stmt);
$stmt2->execute();


    if($stmt2){
      header("Location: admincust.php");  
    }
    
?>