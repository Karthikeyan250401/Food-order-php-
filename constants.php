<?php
    //start the session
    session_start();

    // cretae constant to store non repeating value
    define('SITEURL','http://localhost/food-order(PHP)/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order(php)');

    $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());//database connection
    $db_select=mysqli_select_db($conn,DB_NAME) or die(mysqli_error());//selecting database



?>