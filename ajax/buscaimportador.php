<?php
	include ("../config/funciones.php");
	conectaremoto();
	$filtro = $_POST['filtro'];
	$sql = "SELECT id_importador, nombre_importador FROM importadores 
			WHERE  nombre_importador LIKE '%$filtro%' OR nombre_importador LIKE UPPER('%$filtro%') 
			ORDER BY nombre_importador";
	$res = mysql_query($sql);
	$tmp = "";
	while($reg = @mysql_fetch_array($res)) {
		$tmp .= "$reg[0] - $reg[1]\n";
	}

	echo "Resultado de busqueda...\n".$tmp;
?>