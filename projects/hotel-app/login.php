<?php include 'header.php';

require 'config/connectdb.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
$username = $_POST['username'];
$password = $_POST['password'];
  
$sql = 'SELECT * FROM useraccount WHERE username = :username';
$statement = $pdo->prepare($sql);
$statement->execute([
  ':username'=> $username
]);

$result = $statement->fetch(PDO::FETCH_ASSOC);

if($password == $result['userpass']) {
    session_start();
    $_SESSION['id']=$username;
//   var_dump($_SESSION['id']);
    header("location: index.php");
}
else {
   echo "Invalid User ID or Password";
        
};
};

?>

<div class="container">

  <!-- RoomCarousel-->

<div class="room-features spacer">
  <h2>
  Please Log In First
  </h2>
  <div class="row">

<!-- reservation-information -->
<div id="information" class="spacer reserve-info ">
<div class="container">
<div class="row">
<div class="col-md-6 reservationForm">
<h3>Login</h3>
    <form method="post" role="form" class="wowload fadeInRight">
        <div class="form-group">
            <input type="text" class="form-control"  placeholder="Username" name="username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control"  placeholder="Password" name="password">
        </div>
</div>

</div>
      <button class="btn btn-default">Submit</button>

</div>

</div>
    <br><hr>
  <div class="row">
  <div class="col-md-4">
    <h3>
      Dont have an account?  <a href="signup.php">Sign Up!</a>
    </h3>
  </div>
  </div>
  
    </form>    
</div>
</div>  
</div>
</div>
</div>
</div>
                     
</div>
<?php include 'footer.php';?>