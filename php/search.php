<?php
include 'database.php';
function goback()
{
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

$article=$_GET['article'];
$name=$_GET['name'];

if ($name == "") {
    $name="1488";
}

$sql = "SELECT * FROM `stock_info` where ID_name like '%$name%' or ID = '$article'";

if ($article == "all") {
    $sql = "SELECT * FROM `stock_info`";
}

$result = $conn->query($sql);

//формировка файла для экспорта
require_once 'export/PHPExcel-1.8/Classes/PHPExcel.php';
require_once 'export/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel5.php';
$xls = new PHPExcel();
$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();
$sheet->setCellValue("A1", 'Номер склада');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->setCellValue("B1", 'Артикул');
$sheet->getStyle('B1')->getFont()->setBold(true)->setSize(14);
$sheet->setCellValue("C1", 'Наименование');
$sheet->getStyle('C1')->getFont()->setBold(true)->setSize(14);
$sheet->setCellValue("D1", 'Стоимость');
$sheet->getStyle('D1')->getFont()->setBold(true)->setSize(14);
$sheet->getColumnDimension('A')->setAutoSize(true);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
//конец формировки файла

if($result->num_rows > 0){
    echo '<table border="1" cellspacing="15" cellpadding="20" align="center">';
    echo '<th><b>Номер склада</b></th>';
    echo '<th><b>Артикул</b></th>';
    echo '<th><b>Наименование</b></th>';
    echo '<th><b>Стоимость</b></th>';
    echo '<hr>';
    echo '<tbody>';
    $row = 2;
	  while($row_data = $result->fetch_assoc()) {
          $col = 0;
          foreach($row_data as $key=>$value) {
              $sheet->setCellValueByColumnAndRow($col, $row, $value);
              $col++;
          }
          $row++;
          echo '<tr>';
          echo '<td>' . $row_data['stock_number'] . '</td>';
          echo '<td>' . $row_data['ID'] . '</td>';
          echo '<td>' . $row_data['ID_name'] . '</td>';
          echo '<td>' . $row_data['ID_amount'] . '</td>';
          echo '</tr>';
      }
    echo '</tbody>';
    echo '</table>';
    $sheet->setTitle('Поиск по запросу');
    $objWriter = new PHPExcel_Writer_Excel5($xls);
    $objWriter->save("file.xls");
    echo '<br><center><button type="button" onclick="window.open(\'https://docs.google.com/spreadsheets/d/1ExJehlxKQ5-i2riHSxHrfZp51UiO-lMHe1hJiSC6Ie4/edit?usp=sharing\');" class="btn btn-secondary">Экспорт в Excel</button></a></center>';
} else {
        echo "<br><center>Товар не найден!</center>";
        echo "<br>";
        echo "";
    }
echo '<br><center><button onclick="window.location.href=\'/../search.html\'" type="button" class="btn btn-secondary">Вернуться назад</button></center>';
echo
<<< html
     <style>
        @import url("../style/index.css"); 
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
      
html;
?>