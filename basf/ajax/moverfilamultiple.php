<?php
	include ("../config/funciones.php");
	conectalocal();
	$ids     = $_POST['ids'];
	$antesde = $_POST['destino'];
    $posi    = $_POST['posicion'];
	
	$tmp="";	

	$id = explode(",", $ids);

    for($f = 0; $f < count($id); $f++) {
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
		$sql = "UPDATE bitacora SET ORDEN=$NumOrden WHERE ID=".$id[$f];
		$tmp .= $sql."\n";
		mysql_query($sql);
    }

   echo $tmp;

?>