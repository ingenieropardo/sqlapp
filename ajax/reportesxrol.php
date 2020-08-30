<?php
	include ("../config/funciones.php");
	conectalocal();
	$rol   = $_POST['rol'];
    $idrp  = $_POST['idrp'];
    $idpa  = $_POST['idpa'];

    if($idrp=="0") {
    	$sql = "INSERT INTO rolpar (rol,fk_id) VALUES('$rol',$idpa)";
    } else {
    	$sql = "DELETE FROM rolpar WHERE id=$idrp";
    }
    mysql_query($sql);
    echo $sql;
?>