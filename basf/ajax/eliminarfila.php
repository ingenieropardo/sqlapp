<?php
	include ("../config/funciones.php");
	conectalocal();
	$id = $_POST['id'];
	$sql = "DELETE FROM bitacora WHERE id=$id";   mysql_query($sql);
	$sql = "DELETE FROM coloreshex WHERE c0=$id"; mysql_query($sql);
	echo $sql;
?>