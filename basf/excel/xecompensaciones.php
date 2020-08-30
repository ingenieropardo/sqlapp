<?php

	require_once 'Excel/reader.php';

	$anio = $_POST['anio'];

	$data = new Spreadsheet_Excel_Reader();

	$data->setOutputEncoding('CP1251');
	$data->read('../archivos/compensaciones_expo'.$anio.'.xls');

	error_reporting(E_ALL ^ E_NOTICE);
	$tmp = "";

	$cont = 0;
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= 12;  $j++) {
			$tmp .=  $data->sheets[0]['cells'][$i][$j]."|";
		}
		$cont++;
	}

	echo utf8_encode($tmp);
  
?>
