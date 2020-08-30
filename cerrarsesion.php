<?php
	include("config/config.php");
	include("config/funciones.php");
	/*
	$ip = get_client_ip();

	$sql = "SELECT usuario FROM conexion WHERE ipcliente='$ip'";
	$res = mysql_query($sql);
	if($reg = @mysql_fetch_array($res)) {
		$usu = $reg[0];
		$sql = "DELETE FROM conexion WHERE usuario='$usu'"		;
		mysql_query($sql);
	}
	*/
	@session_start();
	session_unset();
	session_destroy();
	header("location:index.php?accion=iniciarsesion");
    
?>