<style>
	body { color: black; }
	table th {
		text-align: center;
		font-size: 12px
	}
	table {
		font-size: 12px;
		border-color: black;
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
	.der { text-align: right; color: black ;}
	#enca { 
		color: black;
		background-color: #EFEFEF;
		padding: 5px;
		margin-top: -18px;
		margin-left: -38px;
		width: 108%;
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
				Filtrar por
				<select name="" id="pAno">
					<option value="TODOS">Todos los años...</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option>
					<option value="2019">2019</option>
				</select>
				&nbsp;
				<select name="" id="pMes">
					<option value="TODOS">Totos los meses...</option>
					<option value="Enero">Enero</option>
					<option value="Febrero">Febrero</option>
					<option value="Marzo">Marzo</option>
					<option value="Abril">Abril</option>
					<option value="Mayo">Mayo</option>
					<option value="Junio">Junio</option>
					<option value="Julio">Julio</option>
					<option value="Agosto">Agosto</option>
					<option value="Septiembre">Septiembre</option>
					<option value="Octubre">Octubre</option>
					<option value="Noviembre">Noviembre</option>
					<option value="Diciembre">Diciembre</option>
				</select>
				<form action="vistas/regresardrop.php" method="post" enctype="multipart/form-data">
					<input style="display: none;" name="archivo" onchange="verarchivo()" id="archivo" type="file" name="adjunto" accept=".xls,.xlsx">
					<input style="display: none;"  type="text" id="archivoexp" name="archivoexp" value="dropoff.xls">
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


<button class='btn btn-success' id='descargar' style='margin-top:10px; margin-left: -30px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Descargar</button>


 
<script>
	verarchivo()

	$("#descargar").click(function(){
		location.href="reportes/rdropoff.php?tipo=xls&anno="+$("#pAno").val()+"&mes="+$("#pMes").val();
	})

	$("#pAno").change(function() {
		verarchivo();
	});

	$("#pMes").change(function() {
		verarchivo();
	})

	function procesararchivo() {
	 $("#archivo").click();
	}

	function verarchivo() {
		// Detalle
		$.ajax({
			type:"post",
			url : "excel/xdrop.php",
			data : { 
				anno : $("#pAno").val(),
				mes  : $("#pMes").val(),
			},
			success : function (data) {
				datos = [];
				datos = data.split(";");
				t=12;
				c = (datos.length-1)/t;
				tabla = "<table class='table table-bordered'><tr><th>AÑO</th><th>MES</th><th>SBU</th><th>No. CONTAINER</th><th>TIPO CONT.</th><th>NAVIERA</th><th>DO</th><th>LUGAR ENTREGA</th><th>FECHA ENTREGA</th><th>VALOR DROP</th><th>COSTO DEVOL.</th><TH>DIFERENCIA</TH></tr>";
				
				for(f=1; f<c ;f++) {
					tabla += "<tr><td>"+datos[f*t]+"</td><td>"+datos[f*t+1]+"</td><td>"+datos[f*t+2]+"</td><td bgcolor='#EBF1DE'>"+datos[f*t+3]+"</td><td bgcolor='#EBF1DE'>"+datos[f*t+4]+"</td><td bgcolor='#EBF1DE'>"+datos[f*t+5]+"</td><td bgcolor='#EBF1DE'>"+datos[f*t+6]+"</td><td bgcolor='#EBF1DE'>"+datos[f*t+7]+"</td><td bgcolor='#EBF1DE'>"+datos[f*t+8]+"</td><td class='der'  bgcolor='#DCE6F1'>"+number_format(datos[f*t+9])+"</td><td class='der'  bgcolor='#DCE6F1'>"+number_format(datos[f*t+10])+"</td><td class='der'  bgcolor='#FDE9D9'>"+number_format(datos[f*t+11])+"</td></tr>";	
				}
				
				$("#datos").html(tabla+"</table>");
			},
			error : function() {
				$("#datos").html("No hay informacion para cargar...");
			}
		})

	}
</script>