<?php
include 'header.php';
include 'nav.php';

$todaydate = date("Y-m-d");
?>
<div class="container">

    <div class="row">
    
<div class="col-md-4">        
<div class="card" style="width: 18rem;margin-top:5em;">
      <div class="card-header">
        Search for a Car
      </div>     
    
   <div class="card-body">
<form method="POST">
        <div class="col-6">
        <label for="inputEmail4" class="form-label">Car Make:</label>
        <input type="text" class="form-control" id="inputEmail4" placeholder="car Make" name="make">
      </div>
      <div class="col-6">
        <label for="inputPassword4" class="form-label">Car Model:</label>
        <input type="text" class="form-control" id="inputPassword4" placeholder="Car model" name="model">
      </div>
      <div class="col-6">
        <label for="inputAddress" class="form-label">manafacture year</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="Year " name="year">
      </div>
      <div class="col-6">
        <label for="inputState" class="form-label">Car Type:</label>
        <select id="inputState" class="form-select" name="type">
          <option value ="">car type</option>  
          <option value ="sedan">sedan</option>
          <option value="coupe">coupe</option>
          <option value="sport">sport</option>
          <option value="hatchback">hatchback</option>
          <option value="convertible">convertible</option>
          <option value="truck">truck</option>
        </select>
      </div>
    <br>
        <button type="submit" class="btn btn-primary">Search for available cars</button>
      <input type ="hidden" name="submitted" value="TRUE">
</form>
</div>       
        
</div>

</div>

    <div class="col-md-8" style="float:right;">
        
<?php

if (isset($_POST['submitted'])) {

            $car = new Cars();

            $model = $_POST['model'];
            $make =  $_POST['make'];
            $year = $_POST['year'];
            $type = $_POST['type'];

            $rows = $car->AdminSearchCarAdvanced($model, $make, $year, $type);
            if(!empty($rows)){
                
                
                                echo"<br>rows are not empty<br>";
                                echo '<br />';
                                echo '<table align="center" cellspacing = "2" cellpadding = "4" class="table table-bordered">';
                                echo '<tr class="table table-light">
                                      <td class="table table-light"><b>CarID</b></td>
                                      <td class="table table-light"><b>Type</b></td>
                                      <td class="table table-light"><b>Make</b></td>
                                      <td class="table table-light"><b>Model</b></td>
                                      <td class="table table-light"><b>Year</b></td>
                                      <td class="table table-light"><b>Picture</b></td>
                                      <td class="table table-light"><b>Daily Price</b></td>
                                      </tr>';

                foreach($rows as $row){
                                        echo '<tr class="table-primary">
                                          <td class="table table-light">'. $row['CarID'] .' </td>
                                          <td class="table table-light"><b>'. $row['Type'] .'</b></td>
                                          <td class="table table-light"><b>'. $row['Make'].'</b></td>
                                          <td class="table table-light"><b>'.$row['Model'].'</b></td>
                                          <td class="table table-light"><b>'. $row['Year']. '</b></td>
                                          <td class="table table-light"><b>'.$row['DailyPrice'].'</b></td>
                                          <td class="table table-light"> <img src="'.$row['Picture'].'" class="img-thumbnail" alt="images/pepethefrog.jpg"style="object-fit:contain;
max-width:150px;max-height:100px;"></td>
                                          </tr>';
                                        }
            }
            else{
                echo"no search found";
            }
}
    
     



?>
    </div>


</div>
</div>

<?php
include 'footer.php';
?>