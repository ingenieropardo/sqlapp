<?php

	require_once 'Excel/reader.php';

	$envio = $_POST['envio'];

	$data = new Spreadsheet_Excel_Reader();

	$data->setOutputEncoding('CP1251');
	$data->read('../archivos/xinformeuap'.$envio.'.xls');

	error_reporting(E_ALL ^ E_NOTICE);
	$tmp = "";

	$cont = 0;
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= 15; $j++) {
			if($data->sheets[0]['cells'][$i][$j]) $cont++;
			$tmp .=  $data->sheets[0]['cells'][$i][$j]."|";
		}
		$cont++;
	}

	echo utf8_encode($tmp);
  
?>
