<?php 

include 'header.php';

    session_start();
    if(isset($_SESSION['id'])==false){
        header("location: login.php");
    }
?>

<div class="container">

<h2>Rooms</h2>


<!-- form -->

<div class="row">
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/8.jpg" class="img-responsive"><div class="info"><h3>Basic Double</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/9.jpg" class="img-responsive"><div class="info"><h3>Double Deluxe</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/10.jpg" class="img-responsive"><div class="info"><h3>2 Double Beds Basic</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/11.jpg" class="img-responsive"><div class="info"><h3>2 Double Beds deluxe</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/9.jpg" class="img-responsive"><div class="info"><h3>Basic Queen</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/8.jpg" class="img-responsive"><div class="info"><h3>Queens Deluxe</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/10.jpg" class="img-responsive"><div class="info"><h3>2 Queen Beds Basic</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/11.jpg" class="img-responsive"><div class="info"><h3>2 Queen Beds Deluxe</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
  <div class="col-sm-6 wowload fadeInUp"><div class="rooms"><img src="images/photos/9.jpg" class="img-responsive"><div class="info"><h3>1 king Deluxe</h3><p> Missed lovers way one vanity wishes nay but. Use shy seemed within twenty wished old few regret passed. Absolute one hastened mrs any sensible</p><a href="#" class="btn btn-default">Check Details</a></div></div></div>
</div>




</div>
<?php include 'footer.php';?>