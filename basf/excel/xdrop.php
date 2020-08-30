<?php

	require_once 'Excel/reader.php';
	$data = new Spreadsheet_Excel_Reader();

	$data->setOutputEncoding('CP1251');
	$data->read('../archivos/dropoff.xls');

	$anno = $_POST['anno'];
	$mes  = $_POST['mes'];

	error_reporting(E_ALL ^ E_NOTICE);
	$tmp = "";

	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		if($anno == "TODOS" && $mes == "TODOS") {
			for ($j = 1; $j <= 12; $j++) 
				$tmp .=  $data->sheets[0]['cells'][$i][$j].";";
		}
		if($anno != "TODOS" && $mes == "TODOS") {
			if($data->sheets[0]['cells'][$i][1]=="$anno")
				for ($j = 1; $j <= 12; $j++) 
					$tmp .=  $data->sheets[0]['cells'][$i][$j].";";
		}
		if($anno == "TODOS" && $mes != "TODOS") {
			if($data->sheets[0]['cells'][$i][2]=="$mes")
				for ($j = 1; $j <= 12; $j++) 
					$tmp .=  $data->sheets[0]['cells'][$i][$j].";";
		}
		if($anno != "TODOS" && $mes != "TODOS") {
			if($data->sheets[0]['cells'][$i][1]=="$anno" && $data->sheets[0]['cells'][$i][2]=="$mes")
				for ($j = 1; $j <= 12; $j++) 
					$tmp .=  $data->sheets[0]['cells'][$i][$j].";";
		}
	}

	echo utf8_encode($tmp);
	//echo "hay ".$cont." vacias";
?>
