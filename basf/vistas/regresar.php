<font style="color: black;">
<a href="">Regresar</a>
</font>	

<?php
	echo $_FILES["archivo"]["name"]."<br>";
	
	$archivo = "../archivos/comision.xls";
	if(move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo))
		echo "Perfecto";
	else
		echo "Error al mover";
	header("location:../index.php?accion=ingresospropios");
?>