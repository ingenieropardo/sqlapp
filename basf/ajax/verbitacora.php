<?php
	include("../config/funciones.php");
	conectalocal();
	$estado = $_POST['estado'];
	$mes    = $_POST['mes'];

    if($estado=="T")
		$sql = "SELECT bitacora.*, coloreshex.* FROM bitacora, coloreshex WHERE bitacora.id=coloreshex.c0 ORDER BY ORDEN";
	else
		$sql = "SELECT bitacora.*, coloreshex.* FROM bitacora, coloreshex WHERE estado='$estado' AND bitacora.id=coloreshex.c0 ORDER BY ORDEN";
	$res = mysql_query($sql);
    $tmp = "";
	while ($reg = mysql_fetch_array($res)) {
		for($c=0; $c<106; $c++) {
			$tmp .= $reg[$c]."|";
		}
	}
	echo $tmp;
?>