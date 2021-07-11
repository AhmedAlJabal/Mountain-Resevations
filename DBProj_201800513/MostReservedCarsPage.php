<?php
include 'header.php';
include 'nav.php';

$mostPopularCar = new Reservation();

$rows = $mostPopularCar->getPopularCars();




?>

<div class="container">
    <div class="row" style="margin-top: 5em;text-align: center;">
        <h3>Most popular cars</h3>
    </div> 
    
<div class="row" style="margin-top: 2em;">
   <?php
   if(!empty($rows)){
    echo '<br />';
    echo '<table align="center" cellspacing = "2" cellpadding = "4" class="table table-light">';
    echo '<tr class="table-light">
          <td class="table-light"><b>CarID</b></td>
          <td class="table-light"><b>Type</b></td>
          <td class="table-light"><b>Make</b></td>
          <td class="table-light"><b>Model</b></td>
          <td class="table-light"><b>Count</b></td>
          </tr>';
    
    foreach($rows as $row){
        echo '<tr class="table-light">
          <td class="table-light">'. $row['CarID'] .' </td>
          <td class="table-light">'. $row['Type'] .' </td>
          <td class="table-light">'. $row['Make'] .' </td>
          <td class="table-light">'. $row['Model'] .' </td>     
          <td class="table-light">'. $row['count'] .' </td>
          </tr>';
    }
    
    
}else{
    echo"there are no reservations to get the most popular one";
}
   

   ?>

</div>

</div>
<?php
include 'footer.php';
?>