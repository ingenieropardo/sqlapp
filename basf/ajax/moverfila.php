<?php
	include ("../config/funciones.php");
	conectalocal();
	$id     = $_POST['id'];
	$antesde = $_POST['antesde'];
    $posi    = $_POST['posicion'];
	
	if($posi=="UP")  $sql = "SELECT ID,ORDEN FROM bitacora ORDER BY ORDEN";
	else $sql = "SELECT ID,ORDEN FROM bitacora ORDER BY ORDEN DESC";
    $OrdenAnt = "0";
    $NumOrden = "0";
	$res = mysql_query($sql);
	while($reg = mysql_fetch_array($res)) {
		if($reg['ID']==$antesde) {
			$OrdenAct = $reg['ORDEN']; break;
		}
		$OrdenAnt = $reg['ORDEN'];
	}
	$NumOrden = ($OrdenAnt + $OrdenAct)/2;
	$sql = "UPDATE bitacora SET ORDEN=$NumOrden WHERE ID=$id";
	mysql_query($sql);
	


?>