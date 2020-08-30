<?php
	include("../config/funciones.php");
	conectalocal();
    $pusuario = $_POST['pusuario'];
    $pestado  = $_POST['pestado'];
    $pcolumna = $_POST['pcolumna']-1;
    $sql = "UPDATE perfil SET estado = '$pestado' WHERE usuario = '$pusuario' AND columna=$pcolumna";
    $res = mysql_query($sql);
	echo $sql;
?>