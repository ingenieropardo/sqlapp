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
				<select id="nenvio" onchange="verarchivo()">
					<option value="1">Envio No. 1</option>
					<option value="2">Envio No. 2</option>
					<option value="3">Envio No. 3</option>
					<option value="4">Envio No. 4</option>
					<option value="5">Envio No. 5</option>
				</select>
				<form action="vistas/regresarinfouap.php" method="post" enctype="multipart/form-data">
					<input style="display: none;" name="archivo" onchange="verarchivo()" id="archivo" type="file" name="adjunto" accept=".xls,.xlsx">
					<input style="display: none;"  type="text" id="archivoexp" name="archivoexp" value="xinformeuap.xls">
					<input type="text" style="display: none;" value="1" id="param" name="param">
					<input style="display: none;" type="submit" id="benviar" valur="subir...">
				</form>

			</td>
		</tr>
	</table>
</div>

<div id="" style="margin-left: -40px; margin-top: -4px; color: black;">
	<div id="datos"></div>
</div>
	
<button class='btn btn-success' id='descargadetalle' style='margin-top:10px; margin-left: -30px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Detalle</button>

 
<script>
	verarchivo()

	$("#nenvio").change(function(){
		$("#param").val($(this).val())
	})

	$("#descargadetalle").click(function(){
		location.href="reportes/rinfouapdet.php?tipo=xls&envio="+($("#nenvio").val()).toString();
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
			url : "excel/xinfouap.php",
			data: { envio: $("#nenvio").val() },
			success : function (data) {
				datos = [];
				datos = data.split("|");
				t=15;
				c = (datos.length-1)/t;
				tabla = "<table class='table table-bordered table-condensed'><tr><th>No.</th><th>CIUDAD</th><th>EXPORTADOR<br>PROVEEDOR</th><th>% ARANCEL</th><th>% IVA</th><th>VALOR<BR>ARANCEL</th><th>VALOR<BR>IVA</th><th>TOTAL<BR>TRIBUTOS</th><th>No. OC</th><th>ITM OC</th><th>PRODUCTO</th><TH>No. FACTURA<BR>IMPORTACION</TH><th>PARTIDA ARANCELARIA</th><th>CODIGO SAP</th><th>UB</th></tr>";
				
				aEne=0; aFeb=0; aMar=0; aAbr=0; aMay=0; aJun=0; aJul=0; aAgo=0; aSep=0; aOct=0; aNov=0; aDic=0;
				iEne=0; iFeb=0; iMar=0; iAbr=0; iMay=0; iJun=0; iJul=0; iAgo=0; iSep=0; iOct=0; iNov=0; iDic=0;
				fila = 0;
				for(f=1; f<c ;f++) {
					
										
					if(datos[f*t].substr(0,5)=="Total") {
						entidad = "<b>"+datos[f*t]+"</b>";
						colorb = "style='background-color:#D0F7D5'";
					} else {
						entidad = datos[f*t];
						colorb = "";
					}
					tabla += "<tr "+colorb+"><td>"+f+"</td><td>"+datos[f*t]+"</td><td>"+datos[f*t+1]+"</td><td>"+datos[f*t+2]+"</td><td>"+datos[f*t+3]+"</td><td>"+datos[f*t+4]+"</td><td class='der'>"+number_format(datos[f*t+5])+"</td><td class='der'>"+number_format(datos[f*t+6])+"</td><td class='der'>"+number_format(datos[f*t+7])+"</td><td>"+datos[f*t+8]+"</td><td>"+datos[f*t+9]+"</td><td>"+datos[f*t+10]+"</td><td>"+datos[f*t+11]+"</td><td>"+datos[f*t+12]+"</td><td>"+datos[f*t+13]+"</td><td>"+datos[f*t+14]+"</td></tr>";	
				}
				
				$("#datos").html("</table>"+tabla);
			}
		})

	}
</script>