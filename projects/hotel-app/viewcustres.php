<?php include 'header.php';

require "config/connectdb.php";
session_start();
    if(isset($_SESSION['id'])==false){
        header("location: login.php");
    }
$username = $_SESSION['id'];
$sql = "SELECT * FROM useraccount WHERE username = '$username'";
$stmt = $pdo->query($sql);
$info = $stmt->fetch(PDO::FETCH_ASSOC);
$userID = $info['userID'];
echo $userID;

$reservationInfo = "SELECT * FROM reservations where userID = $userID;";
$result = $pdo->query($reservationInfo);

?>


<div class="container">

<h1 class="title">Your Current Reservations </h1>
<table class = "table">
	
	<tr>
		<th>ReservationID</th>
		<th>RoomID</th>  <!--room number would be better-->
		<th># Of Guests</th>
		<th>CheckInDate</th>
		<th>CheckOutDate</th>
		<th>Last Name</th>
		<th>First Name</th>
  </tr>

	<!-- form -->
	<div class="contact">
        <div class="row">
		 <div class="col-sm-6 col-sm-offset-3">
			<div class="spacer">   		
       			<div class="form-group">
					   <?php 
					   //var_dump($result);
					   while($r = $result->fetch(PDO::FETCH_ASSOC)){
					  //var_dump($r);
					 ?>
					<tr>
						<td> <?php echo $r['reservationID'];?> </td>
						<td> <?php echo $r['roomID'];?> </td>
						<td> <?php echo $r['numberofguests'];?> </td>
						<td> <?php echo $r['checkin'];?> </td>
						<td> <?php echo $r['checkout'];?> </td>
						<td> <?php echo $r['lastname'];?> </td>
						<td> <?php echo $r['firstname'];?> </td>
						<td><a href = "reservation-cancel.php?reservationID=<?php echo $r['reservationID'];?>&roomID=<?php echo $r['roomID'];?>"> Cancel </a> </td><br>
						<?php }?>
					</tr>
					</table>
					<?php 
					
 					if($result->rowCount()== 0){
						 echo "none";
					 }
																				
					
					?>
						
				   </div>
				</div>
       		</div> 
      	</div>
   </div>
</div>
<!-- form -->