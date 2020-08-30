<font style="color: black;">
<a href="">Regresar</a>
</font>	
<?php
	$nomarchivo = $_POST['archivoexp'];
	echo $_FILES["archivo"]["name"]."<br>";
	
	$archivo = "../archivos/$nomarchivo";
	if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo))
		echo "Perfecto";
	else
		echo "Error al mover";
	header("location:../index.php?accion=gastosterceros");
?>