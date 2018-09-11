<?php
include "Database.php";

$sql = "SELECT date, amount, order_number FROM `history_info`";
$result = mysqli_query($conn, $sql);

$data = array();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
        $point = $row;
        array_push($data, $point);
    }
}
$response['data'] = $data;
$fp = fopen('data.json', 'w');
fwrite($fp, json_encode($data));
fclose($fp);
echo json_encode($data);

?>