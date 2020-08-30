<?php
    include ("../config/funciones.php");
    conectalocal();
    
    $mensaje = "ERROR\n\nError en la asignacion de reportes";

    $idusuario   = $_POST['idusuario'];
    $fk_idrol    = $_POST['fk_idrol'];

    $sql = "DELETE FROM perfiles WHERE fk_usuario='$idusuario'";
    mysql_query($sql);

    $sql = "SELECT * FROM rolpar WHERE rol='$fk_idrol'";
    $res = mysql_query($sql);
    $cont = 0;
    while($reg = @mysql_fetch_array($res)) {
    	$sq = "INSERT INTO perfiles (fk_usuario, fk_id) VALUES ('$idusuario',$reg[2])";
    	mysql_query($sq);
    	$cont++;
    }
    echo "$sql\n\n$sq\n\nPROCESO EXITOSO\nSe asignaron $cont reportes";
?>