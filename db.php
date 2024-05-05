<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'login_system';

$connect = mysqli_connect($servername, $username, $password, $database);

if (! $connect){
    echo "connection failed";
}
?>