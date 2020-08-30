<?php
	$anio = $_GET['anio'];
	$mes  = $_GET['mes'];
	error_reporting (E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=ComisionesEmportacion$anio.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
	include("../config/funciones.php");
	conectalocal();
	$tipo = $_GET['tipo'];
	
	if($tipo=="xls") {

	    $fila = "";
	    $tabla = "<table border='1' cellpadding='2' cellspacing='0'>";
        $titulo = "COMISIONES EXPORTACION  - $anio";
  
        echo $titulo;

		require_once '../excel/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read("../archivos/compensaciones_expo$anio.xls");

		error_reporting(E_ALL ^ E_NOTICE);
		
		for ($i = 0; $i <= $data->sheets[0]['numRows']; $i++) {
			if($i==0) $fila .= "<tr style='background: #AAD9F7;>";
				else  $fila .= "<tr style='height: 26px'>";
				
			for ($j = 1; $j <= 12; $j++) {
				$fila .=  "<td>".$data->sheets[0]['cells'][$i][$j]." </td>";
			}
			$fila .= "</tr>";
		}
		
		$tabla.= $tabla . $fila . "</table>";
		echo $tabla;
	}
?>