<?php
$connection = 'localhost';
$username = '';
$password = '';
$database = '';

session_start();

$conn = mysqli_connect($connection, $username, $password, $database);

// if(isset($conn)){
//     echo 'db is connected';
// }
?>