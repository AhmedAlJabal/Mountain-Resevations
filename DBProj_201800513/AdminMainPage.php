<?php
include 'header.php';
include 'nav.php';
?>

<div class="container">
    <div class="row" style="margin-top: 5em;text-align: center;">
        <h3>Welcome to the admin main page</h3>
    </div>
    <div class="row" style="margin-top:10em;">    
    <table class="table table-borderless">
        
        <tr>
            <td  style="text-align: center;">
                <a class="btn btn-dark" href="ViewCars.php">View cars</a>
            </td>  
        
        
        
            <td  style="text-align: center;">
                <a class="btn btn-dark" href="MostReservedCarsPage.php">Most popular reserved cars</a>
            </td>  
        
        
        
            <td  style="text-align: center;">
                <a class="btn btn-dark" href="MonthlySalesRevenuePage.php">Monthly sales Revenue</a>
            </td>  
        
        
      
            <td  style="text-align: center;">
                <a class="btn btn-dark" href="AdminCarSearch.php">Search for a car</a>
            </td>  
       
        </tr>
    </table>
    </div>
</div>
    
    <?php
include 'footer.php';
?>