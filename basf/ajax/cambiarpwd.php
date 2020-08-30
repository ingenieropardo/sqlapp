<?php
    include ("../config/funciones.php");
    conectalocal();
    $usuario = $_POST['usuario'];
    $actual = $_POST['actual'];
    $nueva  = $_POST['nueva' ]; 

    $actual = md5($actual);
    $nueva  = md5($nueva);

    $sql = "UPDATE usuarios SET clave='$nueva' WHERE usuario='$usuario' AND clave='$actual'";
    $res = mysql_query($sql);

?>