<?php
	include ("../config/funciones.php");
	conectalocal();
	$id = $_POST['id'];
	$resp = $_POST['resp'];
	$correo = $_POST['correo'];
	$contacto = $_POST['contacto'];
	$peticion = $_POST['peticion'];

	$sql = "UPDATE soportes SET respuesta='$resp', estado='C' WHERE idsoporte=$id";
	mysql_query($sql);

	// llamado a correo
	$ch  = curl_init();
	$url = "http://correo.simecomsas.co/respuesta.php";
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "correo=$correo&contacto=$contacto&mensaje=$resp&id=$id&peticion=$peticion");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$respuesta = curl_exec ($ch);

	echo "IMPORTANTE\n\nSoporte $id Cerrado, se envio un correo electronico al usuario como respuesta a su peticion de soporte";
?>