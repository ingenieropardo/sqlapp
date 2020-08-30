<?php
    include ("../config/funciones.php");
    conectalocal();
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
   
    $ch  = curl_init();
    $url = "http://correo.simecomsas.co/sqlapp_reset.php";
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "correo=$correo&usuario=$usuario");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    echo $url;
?>