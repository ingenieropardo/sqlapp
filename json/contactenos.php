 <?php
 	$nombre = $_REQUEST['nombre'];
 	$correo = $_REQUEST['correo'];
 	$telefono = $_REQUEST['telefono'];
 	$motivo = $_REQUEST['motivo'];
 	$descripcion = $_REQUEST['descripcion'];

	$ch  = curl_init();
	$url = "http://correo.simecomsas.co/enviacontactenos.php";
 
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "nombre=$nombre&correo=$correo&telefono=$telefono&motivo=$motivo&descripcion=$descripcion");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$respuesta = curl_exec ($ch);
 ?>