<?php
    header('Access-Control-Allow-Origin: *');

    $usuarioapp  = $_REQUEST['usuario'];
    $nombre   = $_REQUEST['nombre'];
    $correo   = $_REQUEST['correo'];
    $telefono = $_REQUEST['telefono'];

    include_once("../config/funciones.php");
    conectalocal();

    $sql = "UPDATE usuariosapp SET nombre='$nombre', correo='$correo', telefono='$telefono' WHERE usuario='$usuarioapp'";
    $res = mysql_query($sql);
    echo '{"estado":[{"enviado":"ok"}],"success":"1","message":"success"}';
?>