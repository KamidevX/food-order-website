<?php
// start session

session_start();

// create constants to store database values
define('SITEURL', 'http://localhost/food-order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // empty password
define('DB_NAME', 'food_order');

// database connection

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));

// selecting database

$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

?>