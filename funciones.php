<?php
    function enviarSMS($contenido) {

    	$cel = "573013662700";
    	$telefonos = "573013851596,573002401436,573023835520,573043429127,573004555877";
		$Fecha= date("Y-m-d H:i:s");
		$mensaje="$contenido";

		$ch = curl_init();
        $url = "http://sistemasmasivos.com/itcloud/api/sendsms/send.php";

	    curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, "user=jgmo519@hotmail.com&password=-BjmS0OwjZ&SMSText=$mensaje &GSM=$cel");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	    $respuesta = curl_exec ($ch);
	    $ResultadoEnvio=      str_replace( ',', '',strstr($respuesta, ","));

	    if (!$ResultadoEnvio){
	      $ResultadoEnvio=  $respuesta;
	    }

		return "Aviso enviado con exito...";
    }

    function fechaactual($tipo) {
    	$fecha = "";
    	if($tipo==0) $fecha = date("Y-m-d",(strtotime ("-6 Hours")));
    	if($tipo==1) $fecha = date("H:m:s",(strtotime ("-6 Hours")));
    	if($tipo==2) $fecha = date("Y-m-d H:m:s",(strtotime ("-6 Hours")));

    	return $fecha;
    }
?>