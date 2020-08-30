<?php
	include ("../config/funciones.php");
	conectalocal();
	$usu   = $_POST['xusu'];
    $rep   = $_POST['xrep'];

    $sql = "SELECT * FROM perfiles WHERE fk_usuario='$usu' AND fk_id='$rep'";
    $existe = "no";
    $res = mysql_query($sql);
    if($reg = mysql_fetch_array($res)) {
    	$sql = "DELETE FROM perfiles WHERE fk_usuario='$usu' AND fk_id='$rep'";
    } else {
    	$sql = "INSERT INTO perfiles (fk_usuario, fk_id) VALUES ('$usu','$rep')";
    }
    mysql_query($sql);

    echo $existe;
?>