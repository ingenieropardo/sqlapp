<?php
	mysql_connect("localhost","root","");
	mysql_select_db("basf");
	$usuario = $_GET['usuario'];
	for($col=0; $col <= 51; $col++) {
		$sql = "INSERT INTO perfil(usuario,columna,estado) VALUES ('$usuario',$col,'X')";
		mysql_query($sql);
	}
	echo "Usuario $usuario Listo";
?>