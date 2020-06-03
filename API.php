<?php
// Read the file contents into a string variable,
// and parse the string into a data structure

//$str_data = file_get_contents("https://www.smrl.com/contadorDioxi/dato.json");

$url = "https://www.smrl.com/contadorDioxi/dato.json";
$ctx = stream_context_create(array('http' => array('timeout' => 5))); //Con este metodo "stream_context_create()"
//hacemos que la llamada a la URL se haga a traves de HTTP y no HTTPS que es lo que estaba dando el error "file_get_contents(): SSL: Handshake timed out"
//tambien le especificamos que haya un timeout de 5s.
//https://www.experts-exchange.com/questions/26187506/Function-file-get-contents-connection-time-out.html
$str_data=file_get_contents($url, 0, $ctx);


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

