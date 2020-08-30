<?php
$mensaje  = $_POST['texto'];
//$contacto = $_POST['contacto'];
$cel = "57".$_POST['telefono'];
//$usario  = $_POST['usuario'];


$ch  = curl_init();
$url = "http://sistemasmasivos.com/itcloud/api/sendsms/send.php";

curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=jgmo519@hotmail.com&password=-BjmS0OwjZ&SMSText=$mensaje &GSM=$cel");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$respuesta = curl_exec ($ch);

// QUERY de insersion de de registro en soporte tecnico

?>