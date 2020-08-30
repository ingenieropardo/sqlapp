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
	    height: 540px;
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
				<select id="mees">
					<option value="Todos">Todos los meses...</option>
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
				<form action="vistas/regresarcomisionimpo.php" method="post" enctype="multipart/form-data">
					<input style="display: none;" name="archivo" onchange="verarchivo()" id="archivo" type="file" name="adjunto" accept=".xls">
					<input style="display: none;"  type="text" id="archivoexp" name="archivoexp" value="xcomisionimpo.xls">
					<input type="text" style="display: none;" value="2020" id="param" name="param">
					<input style="display: none;" type="submit" id="benviar" valur="subir...">
				</form>
			</td>
		</tr>
	</table>
</div>

<div id="" style="margin-left: -40px; margin-top: -4px; color: black;">
	<div id="datos">
		<?php
		  $co = array ( 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW', 'CX', 'CY', 'CZ', 'DA', 'DB', 'DC', 'DD', 'DE', 'DF', 'DG', 'DH', 'DI', 'DJ', 'DK', 'DL', 'DM', 'DN', 'DO', 'DP', 'DQ', 'DR', 'DS', 'DT', 'DU', 'DV', 'DW', 'DX', 'DY', 'DZ', 'EA', 'EB', 'EC', 'ED', 'EE', 'EF', 'EG', 'EH', 'EI', 'EJ', 'EK', 'EL', 'EM', 'EN', 'EO', 'EP', 'EQ', 'ER', 'ES', 'ET', 'EU', 'EV', 'EW', 'EX', 'EY', 'EZ', 'FA', 'FB', 'FC', 'FD', 'FE', 'FF', 'FG', 'FH', 'FI', 'FJ', 'FK', 'FL', 'FM', 'FN', 'FO', 'FP', 'FQ', 'FR', 'FS', 'FT', 'FU', 'FV', 'FW', 'FX', 'FY', 'FZ');
			require_once("../config/PHPExcel.php");
			$archivo = "./archivos/bitacora2020.xls";
			$inputFileType = PHPExcel_IOFactory::identify($archivo);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($archivo);
			$sheet = $objPHPExcel->getSheet(0); 
			$filas = $sheet->getHighestRow(); 
			$columnas = $sheet->getHighestColumn();
			//echo "$filas Filas y $columnas Columnas";
			$num=0;
			echo "<table class='table table-bordered table-condensed'>";
			for ($fi = 2; $fi <= $filas; $fi++){ 
				$num++;
			    echo "<tr><td>$num</td>";
			    if($fi==2) {
				    for($c=0; $c<=50; $c++)
						    echo "<th>".strtoupper($sheet->getCell($co[$c].$fi)->getValue())."</th>";   
			    } else {
				    for($c=0; $c<=50; $c++)
				    	if($fi > 2 && ($c>=44 && $c<=50 || $c>=21 && $c<=26 || $c>=29 && $c<=33 || $c==37 || $c==41  )) {
				    		$celda = $sheet->getCell($co[$c].$fi)->getValue();
							echo "<td>".date("d-m-Y", PHPExcel_Shared_Date::ExcelToPHP($celda))."</td>";
				    	} else {
						    echo "<td>".$sheet->getCell($co[$c].$fi)->getValue()."</td>";   
						    //echo "<td>".$sheet->getStyle($co[$c].$fi)->getFill()->getStartColor()."</td>";
				    	}
				    }
			    echo "</tr>";
			}
			echo "</table>";
		?>
	</div>
</div>

<style>
	
</style>
	
<!-- <button class='btn btn-success' id='descargadetalle' style='margin-top:10px; margin-left: -30px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Descargar</button>
-->
<a download href="archivos/bitacora2020.xls" style='margin-top:10px; margin-left: -30px; border-radius:20px;' class='btn btn-success'>Descargar</a>

 
<script>
	//verarchivo()
    



	$("#anio").change(function(){
		$("#param").val($(this).val())
	})

	$("#descargadetalle").click(function(){
		location.href="reportes/rcomi_expo.php?tipo=xls&anio="+($("#anio").val()).toString()+"&mes="+$("#mees").val();
	})

	function actualizar() { 
		$("#benviar").click(); 
	}

	$("#mees").change(function(){
		verarchivo()
	})

	function procesararchivo() {
	 $("#archivo").click();
	}

	function verarchivo() {
		// Detalle
		$("#nomarchivo").val($("#archivo").val());
		$("#archivoexp").val($("#ordenado").val());
		$.ajax({
			type:"post",
			url : "excel/xbitacora.php",
			data: { 
				anio: $("#anio").val()
			},
			success : function (data) {
				datos = [];
				datos = data.split("|");
				t=51;
				c = (datos.length-1)/t;
				tabla = "<table class='table table-bordered table-condensed'>";
				
				for(f=1; f<c ;f++) {										
					if(f==1) colorb = "style='background-color:#C8C8C8; font-weight: bold;'"; else colorb = "";	

						tabla += "<tr "+colorb+"><td>"+(f-1)+"</td>";
						 for(p=0; p<=50; p++)
						    tabla += "<td>"+datos[f*t+p]+"</td>";
						tabla += "</tr>";	
					}
				$("#datos").html("</table>"+tabla);

				}			
		})

	}
</script>