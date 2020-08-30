<?php
    $anio = $_POST['param'];
	$archivo = "../archivos/xflete$anio.xls";
	if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo))
		echo "Perfecto";
	else
		echo "Error al mover";
	header("location:../index.php?accion=flete");
?>