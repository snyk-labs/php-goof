<?php
$connection = 'localhost';
$username = 'phpgoof';
$password = 'password';
$database = 'phpgoof';

session_start();

$conn = mysqli_connect($connection, $username, $password, $database);

?>