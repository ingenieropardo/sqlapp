<?php
	include("../config/funciones.php");
	conectalocal();
	$iusuario  = $_POST['iusuario'];
	$inombre   = $_POST['inombre'];
	$icargo    = $_POST['icargo'];
	$itelefono = $_POST['itelefono'];
	$icorreo   = $_POST['icorreo'];
	$irol      = $_POST['irol'];
	$iestado   = $_POST['iestado'];

	$sql = "SELECT * FROM usuarios WHERE usuario='$iusuario'";
	$res = mysql_query($sql);
	if($reg = @mysql_fetch_array($res)) {
		$sql = "UPDATE usuarios SET rol='$irol', cargo='$icargo', nombre='$inombre', correo='$icorreo', telefono='$itelefono', estado='$iestado' WHERE usuario='$iusuario'";
		echo "USUARIO EXISTENTE\n\nInformacion actualizada";
	} else {
		for($col=0; $col <= 51; $col++) {
			$sq = "INSERT INTO perfil(usuario,columna,estado) VALUES ('$iusuario',$col,'X')";
			mysql_query($sq);
		}
		$clave = md5("12345");
		$sql = "INSERT INTO usuarios(usuario, clave, rol, cargo, nombre, correo, telefono, estado) VALUES('$iusuario','$clave','$irol','$icargo','$inombre','$icorreo','$itelefono','$iestado')";
		echo "NUEVO USUARIO\n\nUsuario nuevo  registrado";
	}
	mysql_query($sql);
?>