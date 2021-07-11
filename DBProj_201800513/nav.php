<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <header>
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    </header>

    <body>
        <div class="row">      
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 
  <div class="collapse navbar-collapse" id="navbarText">
      
      <ul class="navbar-nav mr-auto">
      
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>  
      
      <?php
      if(!empty($_SESSION['uid'])){
      echo '    
      <li class="nav-item active">
        <a class="nav-link" href="SearchCar.php">Reserve a car </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ViewReservations.php">View Reservations</a>
      </li>
      ';
      
       if($_SESSION['isAdmin'] == 1){
      
           echo '
      <li class="nav-item">
        <a class="nav-link" href="AdminMainPage.php">Admin Page</a>
      </li> 
           ';
       }   
       
      }
      ?>
      

      <?php
      if(empty($_SESSION['uid'])){
      echo '
        <li class="nav-item">
            <a class="nav-link" href="Register.php">Register</a>
        </li>
        ';
      }  
      ?>
      
      
      <?php
      if(!empty($_SESSION['uid'])){
      echo '    
      <li class="nav-item">       
        <a class="nav-link" href="logout.php">Log-out</a>
      </li>
          ';
      }  
      ?>
      
    </ul>
  

      <span class="navbar-text"   style="margin-left:40em; color: white;">
      <?php
      if(!empty($_SESSION['uid'])){
          echo 'logged in as: ' . $_SESSION['name'];
      }else{
          echo 'not logged in';
      }
      ?>
      </span>
</div>

</nav>
    </div>

        
        


        
        
        
    </body>
</html>
