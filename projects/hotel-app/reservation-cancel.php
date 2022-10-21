<?php 
require "config/connectdb.php";
$reservationID = $_GET['reservationID'];
$roomID = $_GET['roomID'];
echo $reservationID;
echo "room " . $roomID;


$stmt = "DELETE FROM reservations where reservationID = $reservationID";
$stmt2 = $pdo->query($stmt);

$stmt3 = "UPDATE rooms SET availability = 1 WHERE roomID = $roomID;";
$stmt4 = $pdo->query($stmt3);

    if($stmt2 && $stmt4){
      header("Location: adminres.php");  
    };
    
?>