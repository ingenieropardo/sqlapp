<?php
    include ("../config/funciones.php");
    conectalocal();
    
    $mensaje = "ERROR\n\nError al guardar los datos";

    $idusuario   = $_POST['idusuario'];
    $clave       = $_POST['clave'];
    $nomusuario  = $_POST['nomusuario'];
    $clogueo     = $_POST['clogueo']; if($clogueo=="") $clogueo=0;
    $informacion = $_POST['informacion'];
    $telefono    = $_POST['telefono'];
    $correo      = $_POST['correo'];
    $tipou       = $_POST['tipou'];
    $numeroid    = $_POST['numeroid'];
    $fk_idrol    = $_POST['fk_idrol'];
    $estado      = $_POST['estado'];

    $sql = "";

    $clave = md5($idusuario);
    $sq = "SELECT MAX(consec) FROM usuariosapp";
    $re = mysql_query($sq);
    $rg = mysql_fetch_array($re);

    $sql = "INSERT INTO usuariosapp (consec,usuario, rol,     clave,    tipo,    numid,      nombre,       informacion,    estado, logueado,  telefono,correo) ";
	$sql = utf8_decode("$sql VALUES($rg[0],'$idusuario','$fk_idrol','$clave','$tipou','$numeroid','$nomusuario','$informacion','$estado',$clogueo, '$telefono', '$correo')");
	$mensaje = "CREACION DE USUARIO\n\nNuevo usuario registrado exitosamente";
   
    $resul = mysql_query($sql);

    if($resul != 1) {
        $sql = "UPDATE usuariosapp SET  rol='$fk_idrol', tipo='$tipou', numid='$numeroid', nombre='$nomusuario',informacion='$informacion', estado='$estado', logueado=$clogueo, telefono='$telefono',correo='$correo' ";
        $sql = utf8_decode("$sql WHERE usuario='$idusuario'");
        $mensaje = "ACTUALIZACION DE USUARIO\n\nUsuario actualizado con exito";
        mysql_query($sql);
    }
 
    echo $mensaje;
    

?>