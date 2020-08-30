<?php

	header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=GastosTercerosConsolidado.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    
	include("../config/funciones.php");
	conectalocal();
	$tipo = $_GET['tipo'];
	if($tipo=="xls") {

	    $fila = "";
	    $tabla = "<table border='1' cellpadding='2' cellspacing='0'>";
        $titulo = "GASTOS TERCEROS - CONSOLIDADO";
  
        echo $titulo;

		require_once '../excel/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read('../archivos/gastostercerosordenado.xls');

		error_reporting(E_ALL ^ E_NOTICE);
		
		$anterior = "";
		$suma = 0;
		$total = 0;

		$fila .= "<tr>";
		for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
			
			$total += (int)($data->sheets[0]['cells'][$i][15]);
			$mes = substr($data->sheets[0]['cells'][$i][7],3,2);
			if($i==2) {
				$fila .=  "<td>".$mes."</td><td>".$data->sheets[0]['cells'][$i][9]."</td>";
				$anterior = $data->sheets[0]['cells'][$i][9];

			} else {
				if($anterior != $data->sheets[0]['cells'][$i][9]) {	
					$anterior = $data->sheets[0]['cells'][$i][9];
					$fila .=  "<td>$suma</td></tr><tr><td>".$mes."</td><td>".$data->sheets[0]['cells'][$i][9]."</td>";
					$suma = (int)($data->sheets[0]['cells'][$i][15]);
				} else {
					$suma += (int)($data->sheets[0]['cells'][$i][15]);
				}
			}
		}
		$total = "<tr><td colspan=2>TOTAL GENERAL</td><td>$total</td></tr>";
		$tabla.= $tabla . $fila . "<td>$suma</td>$total</table>";
		echo $tabla;
	}
?>