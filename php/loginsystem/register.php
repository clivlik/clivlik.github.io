<?php
include '../database.php';
$login=$_POST['login'];
$password=md5(sha1($_POST['password']));



$email=$_POST['email'];
mysqli_set_charset($conn, "utf8");
$sql = "INSERT INTO `accounts`(`login`,`password`,`email`) VALUES ('$login','$password','$email')";
$result = mysqli_query($conn, $sql);
header('Location: http://manko.com/main.html');
exit;
