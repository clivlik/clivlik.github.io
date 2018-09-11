<?PHP
function cleanData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
 // Имя загружаемого файла файла.
 //В моём примере получится otched_20150331.xls
$filename = "otchet_" . date('Ymd') . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

// Подключение к бд
mysql_connect ("Localhost","user","pass");// Хост юзер и пароль
mysql_select_db("my_bd") or die (mysql_error());// Имя базы данных

//Указать кодировку выводимых данных
mysql_query('SET character_set_database = cp1251_general_ci');
mysql_query ("SET NAMES 'cp1251'");

//запрос и вывод данных
$flag = false;
 $result = mysql_query("SELECT * FROM user ORDER BY Data DESC")
 or die('Запрос не выполнен!');
 while(false !== ($row = mysql_fetch_assoc($result))) {
     if(!$flag) {
         // Вывод заголовков
         echo implode("\t", array_keys($row)) . "\r\n";
         $flag = true;
     }
     //Вывод данных столбцов
     array_walk($row, 'cleanData');
     echo implode("\t", array_values($row)) . "\r\n";
 }
  exit;
?>