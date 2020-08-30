<?php

	header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=bitacoraKPIinterna.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    
	include("../config/funciones.php");
	conectalocal();

	$mes = split(",", "Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre");
	$tipo = $_GET['tipo'];
	if($tipo=="xls") {
		$sql = "SELECT bitacora.*, coloreshex.* FROM bitacora, coloreshex WHERE bitacora.estado='A' AND bitacora.id=coloreshex.c0 ORDER BY ORDEN";
		$res = mysql_query($sql);
	    $tmp = "";
	    $fila = "";
	    $tabla = "<table border='1' cellpadding='2' cellspacing='0'>";
	    $i=0;
        $nr = mysql_num_rows($res);
        $titulo = "BITACORA KPI INTERNA";
        $registros = "(No. Registros $nr)";
        $nf = mysql_num_fields($res);
        $fila .= "<tr>";
        for($j=0; $j<53; $j++) {
            $fila .= "<th style='background-color: blue; color:white;'>".mysql_field_name($res, $j)."</th>";
        }	 
        $fila .= "</tr>";   
		$res2 = mysql_query($sql);
        echo "<font style='font-size:22px'>$titulo</font>&nbsp;&nbsp;&nbsp;".$registros;
		while ($re = @mysql_fetch_array($res2)) {
			$fila .= "<tr style='height: 20px;'>";
			$i++;
			$fila .= "<td style='height: 20px;'>$i</td>";
			for($c=1; $c<52; $c++) {
				$fila .= "<td style='background-color:".$re[$c+54]."'>".$re[$c]."</td>";
			}
				
			$fila .="</tr>";
		}
		$tabla.= $tabla . $fila . "</table>";
		echo $tabla;
	}
?>

	