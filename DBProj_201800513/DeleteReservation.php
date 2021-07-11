<?php
include 'header.php';
include 'nav.php';

$uniqid = $_GET['id'];

$reservation = new Reservation();
$reservation->initWithUniqID($uniqid);

$resAces = new ReservationAccesories();

$resAces->setReservationID($reservation->getResID());

$carid = $reservation->getCarID();

$car = new Cars();

$car->initWithid($carid);

if(isset($_POST['submitted'])){
    echo"deleting record";
    if($resAces->DeleteAccessories()){
        echo "<br>deleted the accessories<br>";
        if($reservation->DeleteReservation()){
            echo "deleted the reservation";
            header('Location: ViewReservations.php');
        }else{
            echo " an error occured when deleting the reservation";
        }
       
        
    }else{
        echo "an error occured when deleting your reservation please try again later";
    }
}
           
?>

<div class="position-absolute top-50 start-50 translate-middle">
<?php

echo '
<form method="POST">
<div class="card" style="width: 18rem;">
  <img src="'.$car->getPicture().'" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title">are you sure you want to delete this reservation?</h5>
    <p class="card-text">ReservationID =' . $uniqid .'</p>
    <p>if you delete your reservation you will not get your money back</p>
    <a href="ViewReservations.php" onclick=alert("deletion canceled returning to the view reservation page") class="btn btn-primary">Cancel</a>
    <input type="submit"  class="btn btn-danger" value="Delete" name="submitted" onclick=alert("the reservation has ben deleted successfully")></a>
  </div>
</div>
</form>
';

?>

</div>

<?php
include 'footer.php';
?>