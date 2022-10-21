<?php 

require 'config/connectdb.php';
session_start();

$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
$creditCard = filter_input(INPUT_POST, 'creditcard', FILTER_SANITIZE_STRING);//varchar
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
$numberOfGuests = (int)filter_input(INPUT_POST, 'numberOfGuests', FILTER_SANITIZE_STRING);
$typeOfRoom = (int)filter_input(INPUT_POST, 'typeOfRoom', FILTER_SANITIZE_STRING);
$postalcode = filter_input(INPUT_POST, 'postalcode', FILTER_SANITIZE_STRING);

$checkInYear = filter_input(INPUT_POST, 'checkInYear', FILTER_SANITIZE_STRING);
$checkInMonth = filter_input(INPUT_POST, 'checkInMonth', FILTER_SANITIZE_STRING);
$checkInDate = filter_input(INPUT_POST, 'checkInDate', FILTER_SANITIZE_STRING);
$checkIn = $checkInYear . "-" . $checkInMonth . "-" . $checkInDate;

$checkOutYear = filter_input(INPUT_POST, 'checkOutYear', FILTER_SANITIZE_STRING);
$checkOutMonth = filter_input(INPUT_POST, 'checkOutMonth', FILTER_SANITIZE_STRING);
$checkOutDate = filter_input(INPUT_POST, 'checkOutDate', FILTER_SANITIZE_STRING);
$checkOut = $checkOutYear . "-" . $checkOutMonth . "-" . $checkOutDate;

//$transactionID = $POST['']; //will auto generate in query insert -- REQUIRES GUEST ID AND ROOM ID 
//$guestID = $POST[''];  //will be established already from sign in

$selectRoomID='SELECT roomID FROM rooms WHERE (roomdescriptionID = :typeofroom AND availability = 1);';
$statement = $pdo->prepare($selectRoomID);
$statement->execute([
  ':typeofroom' => $typeOfRoom,
  ]);
$resultRoom = $statement->fetch();
$roomID = (int)$resultRoom['roomID'];

$selectUserID='SELECT userID FROM useraccount WHERE (username = :sessionID);';
$statement2 = $pdo->prepare($selectUserID);
$statement2->execute([
  ':sessionID' => $_SESSION['id'],
  ]);
$resultUser = $statement2->fetch();
$userID = (int)$resultUser['userID'];



//session ID does not save when switching pages

// var_dump($userID);
// var_dump($roomID);


try {
//NEED HELP

 //guest needs to be added before reservation transaction put through
  
//acquire rateID based off of typeofroom
//create transaction + insert data


//1) creates reservation and inserts the information
//2) updates room availibility to unavailable
//3) select available access card, assign roomID and guestID, mark unavailable
//4) create transaction, insert guestID, and rateID -> based off of typeofroom
//5) add transactionID to reservation --> has some issues

  //create guest transaction
  $createGuestSql='INSERT INTO guests (firstname,lastname,phone,postalcode,userID) VALUES 
(:firstname,:lastname,:phone,:postalcode,:userID);';

$statement4 = $pdo->prepare($createGuestSql);
  
$statement4->execute([
  ':firstname' => $firstname,
  ':lastname' => $lastname,
  ':phone' =>$phone,
  'postalcode' => $postalcode,
  ':userID' => $userID
]);
  
  //insert reservation transaction
  $insertReservationSql='START TRANSACTION;
INSERT INTO reservations (firstname,lastname,creditcard,numberofguests,checkin,checkout,phone,userID,roomID) VALUES (:firstname,:lastname,:creditcard,:guests,:checkin,:checkout,:phone,:userID,:roomID);
UPDATE rooms SET availability = 0 WHERE roomID = :roomID;
SELECT accesscardID into @cardID from accesscards where cardstatus =1 limit 1;
UPDATE accesscards SET roomID = :roomID where accesscardID = @cardID;
UPDATE accesscards SET guestID = :userID where accesscardID = @cardID;
UPDATE accesscards set cardstatus = 0 where accesscardID = @cardID;
COMMIT;';

$statement3 = $pdo->prepare($insertReservationSql);
  
$statement3->execute([
  ':firstname' => $firstname,
  ':lastname' => $lastname,
  ':creditcard' => $creditCard,
  ':guests' => $numberOfGuests,
  ':checkin' => $checkIn,
  ':checkout' =>$checkOut,
  ':phone' =>$phone,
  ':roomID' => $roomID,
  ':userID' => $userID
]);
  
$error = $statement3->errorInfo();
  print_r($error);
  
if ($statement3 && $statement4){
  
header("location: viewcustres.php");


}
else{
  echo"FAIL, TRY AGAIN";
}
  
}
catch(PDOException $e){
  echo $e->getMessage();
};

// -- CREATE TRANSACTION
// SELECT roomdescriptionID into @roomdescriptionID from rooms where roomID = @roomID;
// SELECT rateID into @rateID from roomdescription where roomdescriptionID = @roomdescriptionID;
// INSERT INTO transactions(guestID,rateID,transactionstatus) values 
// (@guestID,@rateID,"unpaid");





//-- starting transaction
// START TRANSACTION;

// -- CREATE RESERVATION
// INSERT INTO reservations(creditcard,checkin,checkout,numberofguests,guestID,roomID) VALUES 
// ("234354324565",CURDATE(),CURDATE()+4,3,@guestID:=2,@roomID:=2);

// -- UPDATE ROOM TO UNAVAILABLE
// UPDATE rooms SET availability = 0 WHERE roomID = @roomID;

// -- ASSIGN ACCESS CARD 
// SELECT accesscardID into @cardID from accesscards where cardstatus =1 limit 1;
// UPDATE accesscards SET roomID = @roomID where accesscardID = @cardID;
// UPDATE accesscards SET guestID = @guestID where accesscardID = @cardID;
// UPDATE accesscards set cardstatus = 0 where accesscardID = @cardID;

// -- CREATE TRANSACTION
// SELECT roomdescriptionID into @roomdescriptionID from rooms where roomID = @roomID;
// SELECT rateID into @rateID from roomdescription where roomdescriptionID = @roomdescriptionID;
// INSERT INTO transactions(guestID,rateID,transactionstatus) values 
// (@guestID,@rateID,"unpaid");

// #need to specify which transaction ID in case guest has multiple transactions
// #alternative is delete the data when the customer pays

// select*from transactions;

// -- ADD TRANSACTIONID TO RESERVATION
// SELECT transactionID from transactions where guestID = @guestID;
// # invalid if guest has past transactions
// update reservations set transactionID = @transactionID where roomID = @roomID;

// -- commits the transaction
// COMMIT;



// echo "check in";
// var_dump($checkIn);
// echo "<br> name";
// var_dump($name);
// echo "<br> typeofroom";
// var_dump($typeOfRoom);
// echo "<br> #guests";
// var_dump($numberOfGuests);
// echo "<br> phone";
// var_dump($phone);
// echo "<br> checkout";
// var_dump($checkOut);
// echo "<br> creditcard";
// var_dump($creditCard);

?>
