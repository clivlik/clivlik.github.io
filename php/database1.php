<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "root";
$dbname = "accounts";
$conn = new mysqli($servername, $username, $password, $dbname   );

if(mysqli_connect_errno($connect))
{
    echo 'Failed to connect';
}
?>
