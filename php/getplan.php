<?php
include "database.php";
$sql = "SELECT sum(amount) FROM `history_info` WHERE date >= LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH
  AND date < LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY";
$result = mysqli_query($conn, $sql);
$data = array();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data =  $row['sum(amount)'];
    }
}
$response['data'] = $data;
echo $data;