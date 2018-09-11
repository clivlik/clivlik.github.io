<?php
$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$dbname = "autoparts";
$conn = new mysqli($servername, $username, $password, $dbname   );

if(mysqli_connect_errno($connect))
{
    echo 'Failed to connect';
}
?>
