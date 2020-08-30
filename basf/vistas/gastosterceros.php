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
				<select onchange="verarchivo()" id="ordenado">
					<option value="gastosterceros.xls">ORDENADO POR FECHA</option>
					<option value="gastostercerosordenado.xls">ORDENADO POR CONCEPTO</option>
				</select>

				<form action="vistas/regresargastosterceros.php" method="post" enctype="multipart/form-data">
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
	<div class="row">
		<div id="resumen" class="col-md-4">
			<table style="margin-left: 10px;margin-top:4px " class="table">
				<tr><th>MES</th><th>CONCEPTO</th><th>VALOR</th></tr>
			</table>
		</div>
		<div class="col-md-8">
			<div id="datos"></div>
		</div>

	</div>
</div>


<a class='btn btn-success' href="reportes/rgastosterceroscon.php?tipo=xls" style='margin-top:10px; margin-left: -30px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Consolidado</a>
<a class='btn btn-success' href="reportes/rgastosercerosdet.php?tipo=xls" style='margin-top:10px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Detalle</a>

 
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
			url : "excel/xgastosterceros.php",
			data : { orden: $("#ordenado").val(), tipo: "detallado" },
			success : function (data) {
				datos = [];
				datos = data.split(";");
				t=20;
				c = (datos.length-1)/t;
				tabla = "<table class='table table-bordered'><tr><th>No</th><th>FECHA</th><th>CONCEPTO</th><th>DOCUMENTO</th><th>DOC. DESTINO</th><th>CREDITO</th></tr>";
				
				for(f=1; f<c;f++) {
					tabla += "<tr><td>"+f.toString()+"</td><td>"+datos[f*t+6]+"</td><td>"+datos[f*t+8]+"</td><td>"+datos[f*t+11]+"</td><td>"+datos[f*t+12]+"</td><td class='der'>"+number_format(datos[f*t+14])+"</td></tr>";	
				}
				$("#datos").html("</table>"+tabla);
			}
		})

		// Consilidado -------------------------------------------------------------------
		$.ajax({
			type:"post",
			url : "excel/xgastosterceros.php",
			data : { orden: $("#ordenado").val(), tipo: "Consolidado" },
			success : function (data) {
				datos = [];
				datos = data.split(";");
				vltotal = parseInt(datos[datos.length-2]);
				t=3;
				c = (datos.length-2)/t;
				
				tabla = "<table style='margin-left:15px' class='table table-bordered'><tr><th>MES</th><th>CONCEPTO</th><th>VALOR</th></tr>";
				
				for(f=0; f<c;f++) {
					tabla += "<tr><td>"+nmes(parseInt(datos[f*t]))+"</td><td>"+datos[f*t+1]+"</td><td class='der'>"+number_format(datos[f*t+2])+"</td></tr>";	
				}
				totalr = "<tr><th colspan=2>TOTAL GENERAL</th><td class='der'><b>"+number_format(vltotal)+"</b></td></tr>";
				$("#resumen").html(tabla+totalr+"</table>");  
				// <td class='der'>"+number_format(datos[f*t+14])+"</td>
				
			}
		})

	}
</script>