<?php
 	$nombre = $_FILES['archivo']['name'];
	$ruta = "../archivos/cliente/";
	if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta.$nombre))
		echo "Perfecto";
	else
		echo "Error al mover";
	header("location:../index.php?accion=otros");
?>