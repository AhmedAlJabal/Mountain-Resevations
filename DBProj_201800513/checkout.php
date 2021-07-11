

<?php
include 'header.php';
include 'nav.php';


if(isset($_POST['submitted'])){
    if(!empty($_POST['cardNumber']) || !empty($_POST['cardName'])||
            !empty($_POST['exDate']) || !empty($_POST['address'])){
        echo "everything is filled";
        $reservation = new Reservation();
        $reservation->setUID($_SESSION['uid']);
        
        $reservation->setCarID($_SESSION['selectedCarID']);
        
        $reservation->setStartDate($_SESSION['startDate']);
        $reservation->setEndDate($_SESSION['endDate']);
        $reservation->setBillingAddress($_POST['address']);
        $reservation->setTotal($_SESSION['$reservationTotal']);
        $reservation->setUniqID(uniqid());
        
        if($reservation->AddReservation()){
            $connection = Database::getInstance()->getConnection();
            $acessList = $_SESSION['$selectedAccessory'];
            $resaces = new ReservationAccesories();
            if(!empty($acessList)){
            $resaces->AddReservationAccessory($acessList);
            }
            
            $subject = "successfully made a reservation";
            $message = "your unique ID is: ".$reservation->getUniqID();
            
            mail($_SESSION['mail'], $subject, $message);
            
            header('Location: selectedReservationDetails.php?id='.$reservation->getUniqID());
            
        }else{
           echo "error occured when deleting"; 
        }
    }else{
        ?>    
        <script>
                alert("you forgot a required field");
        </script>
        <?php
    }
    
}




?>



<div class="container">
    <div class="row" style="margin-top: 5em;text-align: center;">
        <h3>CheckOut</h3>
    </div>

  <div class="row">
<form  method="POST">
  
  <div class="col-12">
    <label for="inputAddress" class="form-label">Credit Card Number</label>
    <input type="text" class="form-control" placeholder="" name="cardNumber">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Credit Card Holder Name:</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="" name="cardName">
  </div>
  <div class="col-md-4">
    <label for="inputCity" class="form-label">Card ExpireDate</label>
    <input type="date" class="form-control" id="inputCity" name="exDate">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Billing Address</label>
    <input type="text" class="form-control" id="inputCity" name="address">
  </div>  

  <div class="col-12">
      <button type="submit" class="btn btn-primary">procede to checkout</button>
    <input type ="hidden" name="submitted" value="TRUE">
  </div>
</form>
    
</div>

</div>
<?php
include 'footer.php';
?>