<?php 
 
include 'header.php';

require 'config/connectdb.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['1stPass'];
  $confirmPass = $_POST['2ndPass'];
  
 $checkUsersql = 'SELECT userID FROM useraccount WHERE username = :username;';
  $insertsql ='INSERT INTO useraccount (email,username,userpass) VALUES (:email,:username,:password);';
  
  $statement1 = $pdo->prepare($checkUsersql);
  $statement1->bindParam(":username", $username, PDO::PARAM_STR);
  
 if($statement1->execute()){  //select userID if username already exists
     if($statement1->rowCount() >= 1){ //if username exists there will be atleast1row
       $userCheck = false;
    }
    else {
        $userCheck =true; //no rows exist, means username doesnt exist, set true
    }
 } 
  
  $statement2 = $pdo->prepare($insertsql); //insert statement
  
if($userCheck){ //if username doesnt already exist
  if($password == $confirmPass){ //if passwords match
    $result = $statement2->execute([  //insert into table 
      ':email' => $email,
      ':username' => $username,
      ':password' => $password
    ]);
    
    session_start();
    $_SESSION['id']=$username;   //if both statements are true, will set session ID
    header('Location: index.php');  //  and relocate to index
  }
  else {
      echo "Passwords do not match";
}
} 
  else {
    echo "Username already exists";
  }
 

 
 
} 

?>

<div class="container">

  <!-- RoomCarousel-->

<div class="room-features spacer">
  <div class="row">

<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
<div class="container">
<div class="row">
<div class="col-md-6 reservationForm">
<h3>Sign Up</h3>
    <form method="post" role="form" class="wowload fadeInRight">
        <div class="form-group">
            <input type="text" class="form-control"  placeholder="Username" name="username">
        </div>        
      <div class="form-group">
            <input type="text" class="form-control"  placeholder="Email" name="email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control"  placeholder="Password" name="1stPass">
        </div>        <div class="form-group">
            <input type="password" class="form-control"  placeholder="Confirm Password" name="2ndPass">
        </div>
</div>

</div>
      <button class="btn btn-default">Submit</button>

</div>

</div>
    <br><hr>
  
    </form>    
</div>
</div>  
</div> 

<?php  

  include 'footer.php'; 

 ?>