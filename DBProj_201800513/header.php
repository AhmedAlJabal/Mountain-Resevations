<?php

session_start();


ini_set('show_errors', 'On');
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

function __autoload($className){
    include_once  $className.'.php';
}


/*
$obj = new Login();
if (!$obj->ok) {
    if($_SERVER['PHP_SELF'] != '/DBProject_201800513/index.php'){
        header('Location: index.php');
        die();
    }    
    
}
*/



?>

