<?php
    session_start();

// Create constants to store non repeating values
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');
    define('SITEURL', 'http://localhost/order-foods/');
    


// Create database connection
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("فشل الاتصال: " . mysqli_connect_error());