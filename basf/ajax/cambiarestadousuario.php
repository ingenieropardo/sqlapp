<?php
	include ("../config/funciones.php");
	conectalocal();
	$usuario   = $_POST['usuario'];
	$sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
	$res = mysql_query($sql);
	if($reg = mysql_fetch_array($res))
		if($reg[7]=="A")
			$instruccion = "UPDATE usuarios SET estado='X' WHERE usuario='$usuario'";
		else
			$instruccion = "UPDATE usuarios SET estado='A' WHERE usuario='$usuario'";
	mysql_query($instruccion);
?>