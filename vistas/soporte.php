<?php
	if($_SESSION['rol']=="ROOT")
		include("soporteadmin.php");
	else
		include("soportenormal.php");
?>