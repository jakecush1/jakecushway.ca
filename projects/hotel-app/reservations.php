
  <?php 

include 'header.php';

    session_start();
    if(isset($_SESSION['id'])==false){
        header("location: login.php");
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
<div class="col-md-4 reservationForm">
  
<h3>Reservation</h3>
<!-- first part of form  -->
    <form action="res.php" method=POST class="wowload fadeInRight">
      
        <div class="form-group">
            <input type="text" class="form-control"  name="firstname" placeholder="First Name">
        </div>      
      
      <div class="form-group">
            <input type="text" class="form-control"  name="lastname" placeholder="Last Name">
        </div>
      
        <div class="form-group">
            <input type="text" class="form-control"  name="creditcard" placeholder="Credit Card">
        </div>
      
        <div class="form-group">
            <input type="Phone" class="form-control"  name="phone" placeholder="Phone">
        </div>     
      
        <div class="form-group">
            <input type="text" class="form-control"  name="postalcode" placeholder="Postal Code">
        </div>       
      
        <div class="form-group">
            <input type="text" class="form-control"  name="email" placeholder="Email">
        </div>   
      
<!--   Check in part  -->
      
        <div class="form-group">
            <div class="row">
              <h4>Check In Date</h4>
            <div class="col-xs-4">
              Day
              <select class="form-control col-sm-2" name="checkInDate" id="expiry-month">
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>
            </div>
              
            <div class="col-xs-4">
              Month
              <select class="form-control col-sm-2" name="checkInMonth" id="expiry-month">
                <option value="01">Jan (01)</option>
                <option value="02">Feb (02)</option>
                <option value="03">Mar (03)</option>
                <option value="04">Apr (04)</option>
                <option value="05">May (05)</option>
                <option value="06">June (06)</option>
                <option value="07">July (07)</option>
                <option value="08">Aug (08)</option>
                <option value="09">Sep (09)</option>
                <option value="10">Oct (10)</option>
                <option value="11">Nov (11)</option>
                <option value="12">Dec (12)</option>
              </select>
            </div>

            <div class="col-xs-4">
              Year
              <select class="form-control" name="checkInYear">
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
              </select>
            </div>
          </div>
        </div>
      
      
    <!-- check out form part -->
      
              <div class="form-group">
            <div class="row">
              <h4>Check Out Date</h4>
            <div class="col-xs-4">
              Day
              <select class="form-control col-sm-2" name="checkOutDate" id="expiry-month">
                <option value="01">1</option>
                <option value="02">2</option>
                <option value="03">3</option>
                <option value="04">4</option>
                <option value="05">5</option>
                <option value="06">6</option>
                <option value="07">7</option>
                <option value="08">8</option>
                <option value="09">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>
            </div>
              
            <div class="col-xs-4">
              Month
              <select class="form-control col-sm-2" name="checkOutMonth" id="expiry-month">
                <option value="01">Jan (01)</option>
                <option value="02">Feb (02)</option>
                <option value="03">Mar (03)</option>
                <option value="04">Apr (04)</option>
                <option value="05">May (05)</option>
                <option value="06">June (06)</option>
                <option value="07">July (07)</option>
                <option value="08">Aug (08)</option>
                <option value="09">Sep (09)</option>
                <option value="10">Oct (10)</option>
                <option value="11">Nov (11)</option>
                <option value="12">Dec (12)</option>
              </select>
            </div>
              
            <div class="col-xs-4">
              Year
              <select class="form-control" name="checkOutYear">
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
              </select>
            </div>
          </div>
        </div>
      
<!--     3rd part of form   -->
      
        <div class="form-group">
            <div class="row">
            <div class="col-xs-6">
              Number Of Guests
            <select type="number" name="numberOfGuests" class="form-control">
              <option value=1>1</option>
              <option value=2>2</option>
              <option value=3>3</option>
              <option value=4>4</option>
              <option value=5>5</option>
            </select>
            </div>
          </div>        
      </div>        
      
      <div class="form-group">
            <div class="row">
            <div class="col-xs-6">
              Type Of Room
            <select name="typeOfRoom" class="form-control">
              <option value=1>1 Double Bed Basic</option>
              <option value=2>1 Double Bed with balcony</option>
              <option value=3>1 Double Bed with kitchen</option>
              <option value=4>1 Double Bed Suite</option>
              <option value=5>2 Double Bed Basic</option>
              <option value=6>2 Double Bed Suite</option>
              <option value=7>1 Queen Bed Basic</option>
              <option value=8>1 Queen Bed with balcony</option>
              <option value=9>1 Queen Bed Suite</option>
              <option value=10>2 Queen Bed Basic</option>
              <option value=11>2 Queen Bed Suite</option>
              <option value=12>1 King Bed Suite</option>
            </select>
            </div>
          </div>        
      </div>
      
        <button class="btn btn-default">Submit</button>
    </form>  
  
</div>
</div>  
</div>
</div>
    
<!-- reservation-information -->
 

  </div>
</div>
                     


</div>
<?php include 'footer.php';?>
