<?php
// Read the file contents into a string variable,
// and parse the string into a data structure
$str_data = file_get_contents("https://www.sumr.com/contadorDioxi/dato.json");
$data = json_decode($str_data,true);

$numero = $data["dato"]["co2"];
$numeroNue = (float)$numero+3.24;
//echo $numeroNue;
 
// Modify the value, and write the structure to a file "data_out.json"
//

$data["dato"]["co2"] = $numeroNue;

$fh = fopen("dato.json", 'w')
      or die("Error opening output file");
fwrite($fh, json_encode($data,JSON_UNESCAPED_UNICODE));
fclose($fh);
?>
