<?php

include 'header.php';
include 'nav.php';



$todaydate = date("Y-m-d");

$uniqid = $_GET['id'];
//echo"<br>ResID = $resID<br>";

//getting the reservations
$reservation = new Reservation();
$reservation->initWithUniqID($uniqid);

//getting the reservation accessories
$resAcess = new ReservationAccesories();
$resAcess->setReservationID($reservation->getResID());
$rows = $resAcess->getReservationAccessory();


//getting the car ID
$carid = $reservation->getCarID();
$car = new Cars();
$car->initWithid($carid);

//calculating the new total
$newTotal = $reservation->getTotal() + $reservation->getTotal() *0.1;


//setting the reservationaccessories list
//$resAcess = new ReservationAccesories();
//$resAcess->setReservationID($resID);


if (isset($_POST['submitted'])) {
    if($_POST['startDate'] < $todaydate){
        echo"<br> you can't reserve in the past";
    }else{
        if($_POST['startDate'] === $_POST['endDate'] || $_POST['startDate'] > $_POST['endDate'] ){
            echo"<br> reservation can't end in the past or you need to reserve for more than one or more days"; 
        }else{
            $newStart = $_POST['startDate'];
            $newEnd = $_POST['endDate'];
            if($reservation->checkCar($carid, $newStart, $newEnd)){
                echo"dates are available";
                if($reservation->UpdateReservation($reservation->getResID(), $newStart, $newEnd)){
                    $reservation->updateTotal();
                    echo "update succesfully";
                    header('Location: ViewReservations.php');
                }else{
                    echo "error occured while updating";
                }
            }
            else{
                echo" car is unavailable";
            }
        }
    }
}

?>
<div class="container">

    <div class="row" style="margin-top: 5em;">
        <h3> Ammending reservation </h3>
    </div>
    
    <div class="row" >

        <div class="col-md-4">
<?php 
echo '
        <div class="card" style="width: 18rem;background-color:#F8F8F8;">
          <img src="'.$car->getPicture().'" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Amending the following reservation</h5>
            <p class="card-text">ReservationID =' . $uniqid .'</p>
            <p>please select the new starting date and the new ending date</p>

            <p class="card-text"> starting Date:' . $reservation->getStartDate() .'</p>


            <p class="card-text"> ending Date:' . $reservation->getEndDate() .'</p>

          <p>Reservation accesories</p>';

          if(!empty($rows)){
                        foreach($rows as $row){
                             echo $row['AccessoryName'];
                             echo '<br>';
                        }     
                }
          else{echo '<p>there are no accessories for the selected reservation </p>';}
          echo' <br>
          
          <p class="card-text">Total =' . $reservation->getTotal() .'</p>
          </div>
        </div>
       
';
?>
        </div>



        <div class="col-md-4" style="margin-top: 10em;">
<?php

echo '
<form method="POST">

            <label for="exampleInputEmail1" class="form-label">Start Date:</label>
            <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="startDate">

            <label for="exampleInputPassword1" class="form-label">End Date:</label>
            <input type="date" class="form-control"  id="exampleInputPassword1"name="endDate">

          
          <p>amending the following reservation will add 10% to the total value</p>
          <p class="card-text">new Total =' . $newTotal .'</p>
          
          <a href="index.php" class="btn btn-primary">Cancel</a> <input type="submit" name="submitted" class="btn btn-warning" value="Ammend"></a>
          
</form>
';

?>    
        </div>
    
    </div>
</div>


<?php
include 'footer.php';
?>