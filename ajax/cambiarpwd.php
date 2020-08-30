<?php
    include ("../config/funciones.php");
    conectalocal();
    $usuario = $_POST['usuario'];
    $actual = $_POST['actual'];
    $nueva  = $_POST['nueva' ]; 

    $actual = md5($actual);
    $nueva  = md5($nueva);

    $sql = "UPDATE usuariosapp SET clave='$nueva' WHERE usuario='$usuario' AND clave='$actual'";
    $res = mysql_query($sql);
    if($res) {
    	echo "{\"datos\":[{\"resultado\":\"Cambio de contraseña exitosa\"}],\"success\":\"1\",\"message\":\"success\"}";
    } else {
        echo "{\"datos\":[{\"resultado\":\"No pudo realizarse la operacion\"}],\"success\":\"0\",\"message\":\"success\"}";
    }
?>