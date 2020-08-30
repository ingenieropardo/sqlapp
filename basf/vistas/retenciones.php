<style>
	body { color: black; }
	table th {
		text-align: center;
		font-size: 12px
	}
	table {
		font-size: 12px;
	}
	h5 {
		font-weight: bold;
		color: #BA8300;
	}
	label {
		font-size: 11px;
		width: 100px;
		text-align: right;
		color: black
	}

	#datos {
	    height: 575px;
	    overflow-x: scroll;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    white-space: nowrap;
	    border-radius: 4px;
	} 
	#resumen {
	    height: 575px;
	    overflow-x: scroll;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    white-space: nowrap;
	    border-radius: 4px;
	} 
	.campo {
		border-style: none;
		background-color: transparent;
		
	}
	.der { text-align: right; color: red;}
	#enca { 
		color: black;
		background-color: #EFEFEF;
		padding: 5px;
		margin-top: -18px;
		margin-left: -38px;
		width: 104%;
	 }
	#resumen table tr:hover { background: #FFFFD7 }
     .a20 { width: 20px; }
     .a70 { width: 70px; }   
	button { border-style: none; background-color: #A2CADE }
</style>
<?php
   @session_start();
   $rol = $_SESSION['rol'];
   $visible = "";
   if($rol=="CLIENTE") {
   		$visible=" style='display:none'; ";
   }
?>
<div id="enca" <?php echo $visible; ?>>
	<table>
		<tr>
			<td>Archivo a importar<br><input id="nomarchivo" style="width: 300px; height: 28px;"></td>
			<td><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button onclick="procesararchivo()"><spam class="fa fa-2x fa-upload"></spam> Cargar Datos IB</button>
				<button onclick="actualizar();"><spam class="fa fa-2x fa-refresh"></spam></button>
				<input style="display: none;" type="text" id="rol" value="<?php echo $rol; ?>">

				<form action="vistas/regresarretenciones.php" method="post" enctype="multipart/form-data">
					<input style="display: none;" name="archivo" onchange="verarchivo()" id="archivo" type="file" name="adjunto" accept=".xls,.xlsx">
					<input style="display: none;"  type="text" id="archivoexp" name="archivoexp" value="gastosterceros.xls">
					<input type="text" style="display: none;">
					<input style="display: none;" type="submit" id="benviar" valur="subir...">
				</form>

			</td>
		</tr>
	</table>
</div>
<script>
	function actualizar() { $("#benviar").click(); }
</script>

<div id="" style="margin-left: -40px; margin-top: -4px; color: black;">
	<div id="datos"></div>
</div>


<a class='btn btn-success' href="reportes/rgastosterceroscon.php?tipo=xls" style='margin-top:10px; margin-left: -30px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Descargar</a>


 
<script>
	verarchivo()

	function procesararchivo() {
	 $("#archivo").click();
	}

	function verarchivo() {
		// Detalle
		$("#nomarchivo").val($("#archivo").val());
		$("#archivoexp").val($("#ordenado").val());
		$.ajax({
			type:"post",
			url : "excel/xretenciones.php",
			success : function (data) {
				datos = [];
				datos = data.split(";");
				t=15;
				c = (datos.length-1)/t;
				tabla = "<table class='table table-bordered'><tr><th>ENTIDAD</th><th>NIT ENTIDAD</th><th>DV</th><th>NIT TERCERO</th><th>FECHA</th><th>OBSERVACION</th><th>DOCUMENTO</th><th>DEBITO</th><th>CREDITO</th><th>SALDO</th><TH>BASE</TH></tr>";
				
				for(f=1; f<c ;f++) {
					if(datos[f*t].substr(0,5)=="Total") {
						entidad = "<b>"+datos[f*t]+"</b>";
						colorb = "style='background-color:#D0F7D5'";
					} else {
						entidad = datos[f*t];
						colorb = "";
					}
					tabla += "<tr "+colorb+"><td>"+entidad+"</td><td>"+datos[f*t+2]+"</td><td>"+datos[f*t+3]+"</td><td>"+datos[f*t+4]+"</td><td>"+datos[f*t+5]+"</td><td>"+datos[f*t+6]+"</td><td>"+datos[f*t+7]+"</td><td>"+datos[f*t+8]+"</td><td class='der'>"+number_format(datos[f*t+9])+"</td><td class='der'>"+number_format(datos[f*t+10])+"</td><td class='der'>"+number_format(datos[f*t+11])+"</td></tr>";	
				}
				
				$("#datos").html("</table>"+tabla);
			}
		})

	}
</script>