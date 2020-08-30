<?php
	$servidor  = "localhost";       
	$basedatos = "bdapp";
	$usuario   = "root";
	$clave     = "";

	@mysql_set_charset('utf8');

    mysql_connect($servidor, $usuario, $clave);
    mysql_select_db($basedatos) or die("Error de conexion Local '$servidor'");  

	$fechahora = @date("Y-m-d H:m:s",(strtotime ("-6 Hours")));
	$usuario   = $_POST['usuario'];
	$contacto  = $_POST['contacto'];
	$mensaje   = $_POST['mensaje'];
	$correo    = $_POST['correo'];
	$telefono  = $_POST['telefono'];

	$sql  = "INSERT INTO soportes(fechahora, usuario, contacto, mensaje, correo, telefono, estado) ";
	$sql .= "VALUES('$fechahora','$usuario','$contacto','$mensaje','$correo','$telefono','A')";

    mysql_query($sql);

	echo "{\"datos\":[{\"resultado\":\"Soporte tecnico radicado con exito\nse enviara una notificacion a su correo y movil\"}],\"success\":\"1\",\"message\":\"success\"}";

	$cel = "57".$_POST['telefono'];

	// llamado a envio de SMS
	$ch  = curl_init();

	$url = "http://sistemasmasivos.com/itcloud/api/sendsms/send.php";

	$mensaje = "HUBEMAR SAS informa que el soporte tecnico se registro con exito.  Mensaje Original de soporte: ". $mensaje+".  Proximamente sera contactado como respuesta a dicha peticion, este.";

	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "user=jgmo519@hotmail.com&password=-BjmS0OwjZ&SMSText=$mensaje &GSM=$cel");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$respuesta = curl_exec ($ch);

	
	// llamado a correo
	$ch  = curl_init();
	$url = "http://correo.simecomsas.co/enviar.php";
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "correo=$correo&contacto=$contacto&mensaje=$mensaje");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$respuesta = curl_exec ($ch);

?>