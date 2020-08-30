<?php
	include ("../config/funciones.php");
	conectalocal();

	$id    = $_POST['id'];
	$colu  = $_POST['columna'];
	$dato  = $_POST['dato'];
	if(isset($_POST['colorcel'])) $color = $_POST['colorcel']; else $color = "";

	$sql = "SELECT * FROM bitacora";
	$tmp = $sql;

	$res = mysql_query($sql);
	$campo = mysql_field_name($res, $colu);
	$sql = "UPDATE bitacora SET $campo = '$dato' WHERE id=$id";
	$tmp .= "\n$sql";
	mysql_query($sql);
	
	if($color != "") {
		if(substr($color, 0,1)=="#") { $colorh = $color; }
	    else {
	    	$c = substr($color, 4, trim(strlen($color)));
			 $rgbarr = explode(",",$c,3);
			 $colorh = sprintf("#%02x%02x%02x", $rgbarr[0], $rgbarr[1], $rgbarr[2]);
	    }
		$colucolor = "c$colu";
		$sql = "UPDATE coloreshex SET $colucolor='$colorh' WHERE c0=$id";
		$tmp .= "\n$sql";
		mysql_query($sql);
	}

	echo $sql;
?>