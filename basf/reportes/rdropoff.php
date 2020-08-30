<?php

	header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=dropoffpagados.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
 
	include("../config/funciones.php");
	conectalocal();
	$tipo = $_GET['tipo'];
	$mes = $_GET['mes'];
	$anno = $_GET['anno'];
	if($tipo=="xls") {

	    $tmp = "";
	    $fila = "";
	    $tabla = "<table border='1' cellpadding='2' cellspacing='0'>";
	    $i=0;
        $titulo = "INFORME DROP OFF PAGADOS - Mes: $mes  A&ntilde;o: $anno";  
       
        echo $titulo;

		require_once '../excel/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read('../archivos/dropoff.xls');

		error_reporting(E_ALL ^ E_NOTICE);
		$tmp = "";
		$cont = 0;
		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			if($i==1) {
					$fila .="<tr>";
					$fila .= "<td>No.</td>";
					for ($j = 1; $j <= 12; $j++) {
							if($data->sheets[0]['cells'][$i][$j]) $cont++;
							for ($j = 1; $j <= 12; $j++) 
								$fila .= "<td>".$data->sheets[0]['cells'][$i][$j]."</td>";
						}
					$fila .="</tr>";
			} else {
				if($anno == "TODOS" && $mes == "TODOS") { 
					$fila .="<tr>";
					$fila .= "<td>$cont</td>";
					for ($j = 1; $j <= 12; $j++) {
							if($data->sheets[0]['cells'][$i][$j]) $cont++;
							for ($j = 1; $j <= 12; $j++) 
								$fila .= "<td>".$data->sheets[0]['cells'][$i][$j]."</td>";
						}
					$fila .="</tr>";
				} // ------------------------------------------------------------	
				
				if($anno != "TODOS" && $mes == "TODOS") { 
					if($data->sheets[0]['cells'][$i][1]=="$anno") {
						$fila .="<tr>";
						$fila .= "<td>$cont</td>";
						
						for ($j = 1; $j <= 12; $j++) {
								if($data->sheets[0]['cells'][$i][$j]) $cont++;
								for ($j = 1; $j <= 12; $j++) 
									$fila .= "<td>".$data->sheets[0]['cells'][$i][$j]."</td>";
							}
						$fila .="</tr>";
					}
				} // ------------------------------------------------------------	

				if($anno == "TODOS" && $mes != "TODOS") { 
					if($data->sheets[0]['cells'][$i][2]=="$mes") {
						$fila .="<tr>";
						$fila .= "<td>$cont</td>";
						
						for ($j = 1; $j <= 12; $j++) {
								if($data->sheets[0]['cells'][$i][$j]) $cont++;
								for ($j = 1; $j <= 12; $j++) 
									$fila .= "<td>".$data->sheets[0]['cells'][$i][$j]."</td>";
							}
						$fila .="</tr>";
					}
				} // ------------------------------------------------------------	

				if($anno != "TODOS" && $mes != "TODOS") { 
					if($data->sheets[0]['cells'][$i][1]=="$anno" && $data->sheets[0]['cells'][$i][2]=="$mes") {
						$fila .="<tr>";
						$fila .= "<td>$cont</td>";
						
						for ($j = 1; $j <= 12; $j++) {
								if($data->sheets[0]['cells'][$i][$j]) $cont++;
								for ($j = 1; $j <= 12; $j++) 
									$fila .= "<td>".$data->sheets[0]['cells'][$i][$j]."</td>";
							}
						$fila .="</tr>";
					}
				} // ------------------------------------------------------------	

			}
		}
		$tabla = $tabla . $fila . "</table>";
		echo $tabla;
	}
?>