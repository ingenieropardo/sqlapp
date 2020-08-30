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
	    height: 545px;
	    overflow-x: scroll;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    white-space: nowrap;
	    border-radius: 4px;
	} 
	#resumen {
	    height: 560px;
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
<div id="enca" style="width: 110%;" <?php echo $visible; ?>>
	<table>
		<tr>
			<td>Archivo a importar &nbsp; <input id="nomarchivo" style="width: 300px; height: 28px; margin-top: 8px"></td>
			<td valign="top"><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button onclick="procesararchivo()" style="margin-top: 0px"><spam class="fa fa-2x fa-upload"></spam> Cargar Datos XLS</button>
				<button onclick="actualizar();"     style="margin-top: 0px"><spam class="fa fa-2x fa-refresh"></spam></button>
				<input style="display: none;" type="text" id="rol" value="<?php echo $rol; ?>">
				<select id="anio" onchange="verarchivo()">
					<option value="2017">Año 2017</option>
					<option value="2018">Año 2018</option>
					<option value="2019">Año 2019</option>
					<option value="2020" selected>Año 2020</option>
				</select>
				<form action="vistas/regresarflete.php" method="post" enctype="multipart/form-data">
					<input style="display: none;" name="archivo" onchange="verarchivo()" id="archivo" type="file" name="adjunto" accept=".xls">
					<input style="display: none;"  type="text" id="archivoexp" name="archivoexp" value="xflete.xls">
					<input type="text" style="display: none;" value="2020" id="param" name="param">
					<input style="display: none;" type="submit" id="benviar" valur="subir...">
				</form>
			</td>
		</tr>
	</table>
</div>

<div id="" style="margin-left: -40px; margin-top: -4px; color: black;">
	<div id="datos"></div>
</div>

<style>
	
</style>
	
<button class='btn btn-success' id='descargadetalle' style='margin-top:10px; margin-left: -30px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Detalle</button>

 
<script>
	verarchivo()

	$("#anio").change(function(){
		$("#param").val($(this).val())
	})

	$("#descargadetalle").click(function(){
		location.href="reportes/rfletedet.php?tipo=xls&anio="+($("#anio").val()).toString();
	})

	function actualizar() { 
		$("#benviar").click(); 
	}

	function procesararchivo() {
	 $("#archivo").click();
	}

	function verarchivo() {
		// Detalle
		$("#nomarchivo").val($("#archivo").val());
		$("#archivoexp").val($("#ordenado").val());
		$.ajax({
			type:"post",
			url : "excel/xflete.php",
			data: { anio: $("#anio").val() },
			success : function (data) {
				datos = [];
				datos = data.split("|");
				t=11;
				c = (datos.length-1)/t;
				tabla = "<table class='table table-bordered table-condensed'><tr><th>No.</th><th>MES</th><th>ETA</th><th>OC</th><th>PROVEEDOR</th><th>CODIGO</th><th>PRODUCTO</th><th>BU</th><th>CANTIDAD</th><th>ICOTERM</th><th>VALOR FLETE USD</th></tr>";
				
				for(f=1; f<c ;f++) {									
					
					if(f==0) colorb = "style='background-color:#D0F7D5'";
					 	else colorb = "";
					
					tabla += "<tr "+colorb+"><td>"+f+"</td><td>"+datos[f*t]+"</td><td>"+datos[f*t+1]+"</td><td>"+datos[f*t+2]+"</td><td>"+datos[f*t+3]+"</td><td>"+datos[f*t+4]+"</td><td>"+datos[f*t+5]+"</td><td>"+datos[f*t+6]+"</td><td>"+datos[f*t+7]+"</td><td>"+datos[f*t+8]+"</td><td class='der'>"+number_format(datos[f*t+9])+"</td></tr>";	
				}
				
				$("#datos").html("</table>"+tabla);
			}
		})

	}
</script>