<?php
include 'header.php';


if (isset($_POST['submitted'])) {
    
    $lgnObj = new Login();
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if ($lgnObj->login($email, $password)) {
        header('Location: index.php');
       
    } else {
        echo $error = 'Wrong Login Values';
    }
    
}

include "nav.php";


?>

<div class="container">

    <div class="row" style="margin-top: 5em;text-align: center;">
        <h3>Welcome to Mountain reservations</h3>
        <p>best place to rent yourself a  car for the weekend</p>
    </div> 
    <div class="row" style="margin-top: 5em;">    
<?php 

if(empty($_SESSION['uid'])){
    
   echo '
       
     <div>
        <form method="POST">
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
        <small id="emailHelp" class="form-text text-muted">We\'ll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
      </div>
      <div class="form-group form-check">

        <a class="form-check-label" href="Register.php">Register a new user</a>
      </div>
      <button type="submit" class="btn btn-primary">Log in</button>
      <input type ="hidden" name="submitted" value="TRUE">

    </form>
    </div>
   
     ';
   
}else{
    echo '
    <div>
    <table class="table table-borderless">
        
        <tr class="">
            <td class="" style="text-align: center;">
                <a class="btn btn-dark" href="SearchCar.php">Reserve a car</a>
            </td>  
        
        
        
            <td class="" style="text-align: center;">
                <a class="btn btn-dark" href="ViewReservations.php">view Reservations</a>
            </td>  
        
        

    ';
    if($_SESSION['isAdmin'] == 1){
        echo '


            <td class="" style="text-align: center;">
                <a class="btn btn-dark" href="AdminMainPage.php">Admin website</a>
            </td>  


        ';
    }
    echo '
        </tr>
        </table>
        </div>
    ';
}
    
 ?>

</div>
        
</div>

<?php
include 'footer.php';
?>