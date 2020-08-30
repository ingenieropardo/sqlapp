<?php

	header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=bitacoraKPI.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    
	include("../config/funciones.php");
	conectalocal();

	$mes = split(",", "Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre");
	$tipo = $_GET['tipo'];
	if($tipo=="xls") {
		$sql = "SELECT * FROM bitacora ORDER BY ORDEN ";
		$res = mysql_query($sql);
	    $tmp = "";
	    $fila = "";
	    $tabla = "<table border='1' cellpadding='2' cellspacing='0'>";
	    $i=0;
        $nr = mysql_num_rows($res);
        $titulo = "BITACORA KPI";
        $registros = "(No. Registros $nr)";
        $nf = mysql_num_fields($res);
        $fila .= "<tr>";
        for($j=0; $j<53; $j++) {
            $fila .= "<th style='background-color: blue; color:white;'>".mysql_field_name($res, $j)."</th>";
        }	 
        $fila .= "</tr>";   
		$res2 = mysql_query($sql);
        echo "<font style='font-size:22px'>$titulo</font>&nbsp;&nbsp;&nbsp;";
		while ($re = @mysql_fetch_array($res2)) {
			if($re[1]!="") {
				$fila .= "<tr style='height: 20px; '>";
				$i++;
				$fila .= "<td>$i</td>";
				$fila .= "<td>$re[1]</td>";
				for($c=2; $c<52; $c++) {
					$fila .= "<td style='text-align: left'>".$re[$c]."</td>";
				}
					
				$fila .="</tr>";
			}

		}
		$tabla.= $tabla . $fila . "</table>";
		echo $tabla;
	}
?>

