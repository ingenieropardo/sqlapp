<?php
require_once 'Excel/reader.php';

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');

error_reporting(E_ALL ^ E_NOTICE);
$tmp = "";

if ($_POST['tipo']=="detallado") {
	$orden = $_POST['orden'];
	$data->read("../archivos/$orden");

	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= 20; $j++) {
			$tmp .=  $data->sheets[0]['cells'][$i][$j].";";
		}
	}	
} else {
	$data->read("../archivos/gastostercerosordenado.xls");
	$anterior = "";
	$suma = 0;
	$total = 0;
	for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
		
		$total += (int)($data->sheets[0]['cells'][$i][15]);
		$mes = substr($data->sheets[0]['cells'][$i][7],3,2);

		if($i==2) {
			$tmp .=  $mes.";".$data->sheets[0]['cells'][$i][9].";";
			$anterior = $data->sheets[0]['cells'][$i][9];

		} else {
			if($anterior != $data->sheets[0]['cells'][$i][9]) {	
				$anterior = $data->sheets[0]['cells'][$i][9];
				$tmp .=  "$suma;".$mes.";".$data->sheets[0]['cells'][$i][9].";";
				$suma = (int)($data->sheets[0]['cells'][$i][15]);
			} else {
				$suma += (int)($data->sheets[0]['cells'][$i][15]);
			}
		}
	}
	$tmp .= "$suma;$total;";
}

echo utf8_encode($tmp);

?>
