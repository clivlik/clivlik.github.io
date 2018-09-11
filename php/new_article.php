<?php
include 'database.php';
$name=$_POST['name'];
$article=$_POST['article'];
$stock=$_POST['stock'];
$price=$_POST['price'];
$message = 'Товар успешно добавлен!';
mysqli_set_charset($conn, "utf8");
$sql = "INSERT INTO `stock_info`(`stock_number`,`ID`,`ID_name`,`ID_amount`) VALUES ('$stock','$article','$name','$price')";
$result = mysqli_query($conn, $sql);
header('Location:../confirm.html');