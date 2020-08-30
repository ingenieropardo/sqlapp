<?php
	include ("../config/funciones.php");
	conectalocal();
	$usu = $_POST['usactual'];
	$ide = $_POST['idactual'];

	$sql = "SELECT * FROM usuariosapp WHERE usuario='$usu' AND logueado='$ide'";
	$res = mysql_query($sql);
	if($reg = @mysql_fetch_array($res))
		echo "Ok";
	else
		echo "Error";
?>