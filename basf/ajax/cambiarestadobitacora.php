<?php
	include ("../config/funciones.php");
	conectalocal();
	$id   = $_POST['id'];
	$estado = $_POST['estado'];

	$sql = "UPDATE bitacora SET estado='$estado' WHERE id=$id";   
	mysql_query($sql);

	echo $sql;
?>