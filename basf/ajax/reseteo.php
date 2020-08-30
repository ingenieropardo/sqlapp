<?php
    include ("../config/funciones.php");
    conectalocal();

    $respuesta = "ERROR\n\nEl usuario NO existe o esta mal escrito, por favor revise";

	$iusuario = $_POST['iusuario'];
	$claveoriginal = rand(10000,99999);
    $clave = md5($claveoriginal);

	$sql = "UPDATE usuarios SET clave='$clave' WHERE usuario='$iusuario'";
	mysql_query($sql);
	
	if(mysql_affected_rows()>0)  {
	   
       $respuesta = "CONTRASEÑA RESTAURADA\n\nVerifique su correo electronico en la bandeja de entrada o SPAM (no deseados o notificaciones)";
	    $sql = "SELECT * FROM usuarios WHERE usuario = '$iusuario'";
	    $res = mysql_query($sql);
	    $reg = mysql_fetch_array($res);
	    $correo = $reg['correo'];
    	
    	$to = $correo;
    	$subject = "RECUPERACION CONTRASEÑA - BASF App 1.0";
        $message = "<br>Señor(a)<br>$reg[4]<br>$reg[3]<br><br>Estimado usuario.<br><br>";
        $message = $message."Su contraseña ha sido cambiada, ingrese con el numero $claveoriginal, se le recomienda que la cambie periodicamente<br><br>";
        $message = $message."<br>Atentamente,<br><br><br><b>Equipo de Soporte Tecnico<br><font color='#7A7C8F'>Agencia de Aduanas Hubemar SAS Nivel 1</b></font><br>";
        
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: HUBEMAR BASF App 1.0 <nocontestar@hubemar.co>' . "\r\n";
        
        mail($to,$subject,$message,$headers);
        
	}

    echo $respuesta;
?>