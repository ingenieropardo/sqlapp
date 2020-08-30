<?php
	include ("../config/funciones.php");
	conectalocal();
	$usuario   = $_POST['usuario'];
	$sql = "SELECT * FROM usuariosapp WHERE consec=$usuario";
	$res = mysql_query($sql);
	$instruccion="nn";
	if($reg = mysql_fetch_array($res))
		if($reg[7]=="A")
			$instruccion = "UPDATE usuariosapp SET estado='X' WHERE consec=$usuario";
		else
			$instruccion = "UPDATE usuariosapp SET estado='A' WHERE consec=$usuario";
	mysql_query($instruccion);
?>