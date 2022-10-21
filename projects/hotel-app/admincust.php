<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>Holiday Crown | Best hotel in Dubai</title>

<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800|Old+Standard+TT' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:300,500,800' rel='stylesheet' type='text/css'>

<!-- font awesome -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


<!-- bootstrap -->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />

<!-- uniform -->
<link type="text/css" rel="stylesheet" href="assets/uniform/css/uniform.default.min.css" />

<!-- animate.css -->
<link rel="stylesheet" href="assets/wow/animate.css" />


<!-- gallery -->
<link rel="stylesheet" href="assets/gallery/blueimp-gallery.min.css">


<!-- favicon -->
<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
<link rel="icon" href="images/favicon.png" type="image/x-icon">

<link rel="stylesheet" href="assets/style.css">

</head>

<body id="home">


<!-- top 
  <form class="navbar-form navbar-left newsletter" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter Your Email Id Here">
        </div>
        <button type="submit" class="btn btn-inverse">Subscribe</button>
    </form>
 top -->

<!-- header -->
<nav class="navbar  navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="images/logo.png"  alt="holiday crown"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
      
      <ul class="nav navbar-nav">        
        <li><a href="adminres.php">Reservations</a></li>
        <li><a href="adminrooms.php">Rooms</a></li>        
        <li><a href="admincust.php">Customers</a></li>
        <li><a href="signout.php">Sign Out</a></li>
      </ul>
    </div><!-- Wnavbar-collapse -->
  </div><!-- container-fluid -->
</nav>
<!-- header -->
  
    <?php
require "config/connectdb.php";
session_start();
      if(isset($_SESSION['id'])==false){
        header("location: adminlogin.php");
    }

$stmt = "SELECT * FROM guests;";
    $result = $pdo->query($stmt);

?>
  
  <h1 style="padding-top:3rem; text-align:center;">Guests
  </h1>
  <div class="container">

<table class = "table">
	<h4>Guests</h4>
	
	<tr>
		<th>GuestID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Phone Number</th>
		<th>Postal Code</th>
		<th>User ID</th>
  </tr>

  

	<!-- form -->
	<div class="contact">
        <div class="row">
		 <div class="col-sm-6 col-sm-offset-3">
       			<div class="form-group">
					   <?php 
              $stmt = "SELECT * FROM guests";
              $result = $pdo->prepare($stmt);
              $result->execute();
					   while($r = $result->fetch(PDO::FETCH_ASSOC)){
					 ?>
					<tr>
						<td> <?php echo $r['guestID'];?> </td>
						<td> <?php echo $r['firstname'];?> </td>
						<td> <?php echo $r['lastname'];?> </td>
						<td> <?php echo $r['phone'];?> </td>
						<td> <?php echo $r['postalcode'];?> </td>
						<td> <?php echo $r['userID'];?> </td>
						<td><a href = "customer-cancel.php?guestID=<?php echo $r['guestID'];?>"> Delete </a></td>
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
<!-- form -->
  
  </body>
</html>