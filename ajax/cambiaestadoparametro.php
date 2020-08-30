<?php
	include ("../config/funciones.php");
	conectalocal();
	$numero   = $_POST['numero'];
	$sql = "SELECT * FROM parametros WHERE id=$numero";
	$res = mysql_query($sql);
	$instruccion="nn";
	if($reg = mysql_fetch_array($res))
		if($reg[4]=="A")
			$instruccion = "UPDATE parametros SET estado='X' WHERE id=$numero";
		else
			$instruccion = "UPDATE parametros SET estado='A' WHERE id=$numero";
	mysql_query($instruccion);
?>