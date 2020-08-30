<?php
	include("../config/funciones.php");
	conectalocal();
	$id     = $_POST['id'];
	$posicion = $_POST['posicion'];
	$cantidad = $_POST['cantidad'];
	$sql = "";
	$acusql = "$cantidad registros\n";

	$cadena = ""; $valor = "";
	for($c=1; $c<=50; $c++) {
		$cadena .= "c$c,";
		$valor  .= "'#FFFFFF',";
	}
	$cadena .= "c51"; $valor .= "'#FFFFFF'";

	if($posicion=="ENCIMA")  {
		for($c=1; $c <= $cantidad; $c++) {
		    $OrdenAnt = "0";
		    $NumOrden = "0";
			$sql = "SELECT ID,ORDEN FROM bitacora ORDER BY ORDEN";
			$res = mysql_query($sql);
			while($reg = mysql_fetch_array($res)) {
				if($reg['ID']==$id) {
					$OrdenAct = $reg['ORDEN']; break;
				}
				$OrdenAnt = $reg['ORDEN'];
			}
			$NumOrden = ($OrdenAnt + $OrdenAct)/2;
			$sql = "INSERT INTO bitacora (ESTADO, ORDEN) VALUES ('A', $NumOrden)";
			mysql_query($sql);

			$sql = "INSERT INTO coloreshex ($cadena) VALUES ($valor)";
			mysql_query($sql);
		}
	} else {
		for($c=1; $c <= $cantidad; $c++) {
		    $OrdenSig = "0";
		    $NumOrden = "0";
			$sql = "SELECT ID,ORDEN FROM bitacora ORDER BY ORDEN DESC";
			$res = mysql_query($sql);
			while($reg = mysql_fetch_array($res)) {
				if($reg['ID']==$id) {
					$OrdenAct = $reg['ORDEN']; break;
				}
				$OrdenSig = $reg['ORDEN'];
			}
			$NumOrden = ($OrdenSig + $OrdenAct)/2;
			$sql = "INSERT INTO bitacora (ESTADO, ORDEN) VALUES ('A', $NumOrden)";
			mysql_query($sql);

			$sql = "INSERT INTO coloreshex ($cadena) VALUES ($valor)";
			mysql_query($sql);
		}
	}
	


	echo $NumOrden;
?>