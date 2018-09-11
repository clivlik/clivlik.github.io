<?php
include '../database.php';
$login = $_GET['login'];
$password = md5(sha1($_GET['password']));

$sql = "SELECT * FROM `accounts` WHERE login = '$login' AND password = '$password'";
//echo "test";
$result = mysqli_query($conn, $sql);
if($result->num_rows > 0){
    if($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION['auth'] = true;
        $_SESSION['userid'] = $row['id'];
        $_SESSION['login'] = $row['login'];

        header('Location:../../main.html').session_name().'='.session_id();
    }
} else {
    header('Location:../../index.html');
}
