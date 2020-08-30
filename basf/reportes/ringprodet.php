<?php
	header('Content-type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=ingpropiosDetallado.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
	include("../config/funciones.php");
	conectalocal();
	$tipo = $_GET['tipo'];
	if($tipo=="xls") {
		$sql = $sql = "SELECT * FROM ingpropios";
		$res = mysql_query($sql);
	    $tmp = "";
	    $fila = "";
	    $tabla = "<table border='1' cellpadding='2' cellspacing='0'>";
	    $i=0;
        $nr = mysql_num_rows($res);
        $titulo = "INGRESOS PROPIOS - DETALLE DE REGISTROS";
        $registros = "(No. Registros $nr)";
        $nf = mysql_num_fields($res);
        $fila .= "<tr>";
        for($j=0; $j<$nf-1; $j++) {
            $fila .= "<th>".mysql_field_name($res, $j)."</th>";
        }	 
        $fila .= "</tr>";   
        echo $titulo." ".$registros;

		require_once '../excel/Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setOutputEncoding('CP1251');
		$data->read('../archivos/comision.xls');

		error_reporting(E_ALL ^ E_NOTICE);
		$tmp = "";

		$cont = 0; $nfilas=0;
		for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
			if($data->sheets[0]['cells'][$i][0]!="") $nfilas++;
			$fila .="<tr>";
			$fila .= "<td>$i</td>";
			for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
				if($data->sheets[0]['cells'][$i][$j]) $cont++;
				$tmp .=  $data->sheets[0]['cells'][$i][$j].";";
				$fila .= "<td>".$data->sheets[0]['cells'][$i][$j]."</td>";
			}
			$fila .="</tr>";
			$cont++;
		}
        /*
		while ($reg = mysql_fetch_array($res)) {
			$fila .= "<tr>";
			$i++;
			for($c=0; $c<$nf-1; $c++) {
				$fila .= "<td>".$reg[$c]."</td>";
			}
			$fila .="</tr>";
		}
		*/
		$tabla.= $tabla . $fila . "</table>";
		echo $tabla;
	}
?>