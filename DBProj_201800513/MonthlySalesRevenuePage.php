<?php
include 'header.php';
include 'nav.php';

?>
<div class="container">
    
       <div class="row" style="margin-top: 5em;text-align: center;">
        <h3>Monthly sales</h3>
    </div> 

<div class="row" style="margin-top: 5em;">
        <form method="POST">
                      <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Start Date:</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="startDate">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">End Date:</label>
                    <input type="date" class="form-control"  id="exampleInputPassword1"name="endDate">
                  </div>

                    <input type="submit"  class="btn btn-warning" value="Search"></a>
                    <input type ="hidden" name="submitted" value="TRUE">

        </form>

 </div>   
 
 <div class="row" style="margin-top: 2em;">   
<?php

if(isset($_POST['submitted'])){
    if($_POST['startDate'] === $_POST['endDate'] || $_POST['startDate'] > $_POST['endDate'] ){
        echo '<br>please select an end date that is bigger than the start date<br>';
    }else{
        $resTotals = new Reservation();
        $rows = $resTotals->monthlySalesRevenue($_POST['startDate'], $_POST['endDate']);
        
        if(!empty($rows)){
            echo '<br />';
            echo '<table align="center" cellspacing = "2" cellpadding = "4" class="table table-light">';
            echo '<tr class="table-light">
                  <td class="table-light"><b>Total Revenue generated</b></td>
                  </tr>';
            
                foreach($rows as $row){
                echo '<tr class="table-light">
                  <td class="table-light">'. $row['generated_revenue'] .' </td>
                  </tr>';
            }
        }        
    }
}

?>
 </div>

</div> 
<?php
include 'footer.php';
?>