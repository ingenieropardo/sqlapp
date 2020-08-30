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
	    height: 555px;
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
			<td><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button onclick="procesararchivo()" style="margin-top: -15px"><spam class="fa fa-2x fa-upload"></spam> Cargar Datos XLS</button>
				<button onclick="actualizar();"     style="margin-top: -15px"><spam class="fa fa-2x fa-refresh"></spam></button>
				<input style="display: none;" type="text" id="rol" value="<?php echo $rol; ?>">

				<form action="vistas/regresaruap.php" method="post" enctype="multipart/form-data">
					<input style="display: none;" name="archivo" onchange="verarchivo()" id="archivo" type="file" name="adjunto" accept=".xls,.xlsx">
					<input style="display: none;"  type="text" id="archivoexp" name="archivoexp" value="xconsolidadouap.xls">
					<input type="text" style="display: none;">
					<input style="display: none;" type="submit" id="benviar" valur="subir...">
				</form>

			</td>
		</tr>
	</table>
</div>


	<div class="row">
		<div class="col-md-4">
			<table style="color: black">
				<tr><td></td><th style="padding: 14px">TOTAL ARANCEL</th><th>TOTAL IVA</th></th></tr>
				<tr><td><label for="">Enero</label>      </td><td><input id="sEne" class="der" type="text" disabled><td><input id="iEne" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Febrero</label>    </td><td><input id="sFeb" class="der" type="text" disabled><td><input id="iFeb" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Marzo</label>      </td><td><input id="sMar" class="der" type="text" disabled><td><input id="iMar" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Abril</label>      </td><td><input id="sAbr" class="der" type="text" disabled><td><input id="iAbr" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Mayo</label>       </td><td><input id="sMay" class="der" type="text" disabled><td><input id="iMay" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Junio</label>      </td><td><input id="sJun" class="der" type="text" disabled><td><input id="iJun" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Julio</label>      </td><td><input id="sJul" class="der" type="text" disabled><td><input id="iJul" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Agosto</label>     </td><td><input id="sAgo" class="der" type="text" disabled><td><input id="iAgo" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Septiembre</label> </td><td><input id="sSep" class="der" type="text" disabled><td><input id="iSep" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Octubre</label>    </td><td><input id="sOct" class="der" type="text" disabled><td><input id="iOct" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Noviembre</label>  </td><td><input id="sNov" class="der" type="text" disabled><td><input id="iNov" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Diciembre</label>  </td><td><input id="sDic" class="der" type="text" disabled><td><input id="iDic" class="der" type="text" disabled></td></td></tr>
				<tr><td class="der">TOTAL  </td><td><input id="totala" class="der" type="text"></td><td><input id="totali" class="der" type="text"></td></tr>
			</table>
			<br>

		</div>
		<div class="col-md-8">
			<div id="" style="margin-left: -40px; margin-top: -4px; color: black;">
				<div id="datos"></div>
			</div>
		</div>

	</div>




<a class='btn btn-success' href="reportes/ruapdet.php?tipo=xls" style='margin-top:10px; margin-left: -30px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Detalle</a>
<a class='btn btn-success' href="reportes/ruapcon.php?tipo=xls" style='margin-top:10px;  border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Resumen</a>


 
<script>
	verarchivo()

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
			url : "excel/xuap.php",
			success : function (data) {
				datos = [];
				datos = data.split("|");
				t=15;
				c = (datos.length-1)/t;
				tabla = "<table class='table table-bordered table-condensed'><tr><th>No.</th><th>MES</th><th>CIUDAD</th><th>EXPORTADOR<BR>PROVEEDOR</th>";
				tabla += "<th>% ARANCEL</th><th>% IVA</th><th>VALOR<BR>ARANCEL</th><th>VALOR<BR>IVA</th><th>TOTAL<BR>TRIBUTOS</th><th>No. OC</th><th>ITM OC</th><th>PRODUCTO</th><TH>No. FACTURA<BR>IMPORTACION</TH><th>PARTIDA ARANCELARIA</th><th>CODIGO SAP</th><th>UB</th></tr>";
				
				aEne=0; aFeb=0; aMar=0; aAbr=0; aMay=0; aJun=0; aJul=0; aAgo=0; aSep=0; aOct=0; aNov=0; aDic=0;
				iEne=0; iFeb=0; iMar=0; iAbr=0; iMay=0; iJun=0; iJul=0; iAgo=0; iSep=0; iOct=0; iNov=0; iDic=0;
				fila = 0;
				for(f=1; f<c ;f++) {
					
					if(datos[f*15+0]=="Enero")      { aEne += parseInt(datos[f*15+5]); iEne += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Febrero")    { aFeb += parseInt(datos[f*15+5]); iFeb += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Marzo")      { aMar += parseInt(datos[f*15+5]); iMar += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Abril")      { aAbr += parseInt(datos[f*15+5]); iAbr += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Mayo")       { aMay += parseInt(datos[f*15+5]); iMay += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Junio")      { aJun += parseInt(datos[f*15+5]); iJun += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Julio")      { aJul += parseInt(datos[f*15+5]); iJul += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Agosto")     { aAgo += parseInt(datos[f*15+5]); iAgo += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Septiembre") { aSep += parseInt(datos[f*15+5]); iSep += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Octubre")    { aOct += parseInt(datos[f*15+5]); iOct += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Noviembre")  { aNov += parseInt(datos[f*15+5]); iNov += parseInt(datos[f*15+6]); }
					if(datos[f*15+0]=="Diciembre")  { aDic += parseInt(datos[f*15+5]); iDic += parseInt(datos[f*15+6]); }	
										
					if(datos[f*t].substr(0,5)=="Total") {
						entidad = "<b>"+datos[f*t]+"</b>";
						colorb = "style='background-color:#D0F7D5'";
					} else {
						entidad = datos[f*t];
						colorb = "";
					}
					tabla += "<tr "+colorb+"><td>"+f+"</td><td>"+datos[f*t]+"</td><td>"+datos[f*t+1]+"</td><td>"+datos[f*t+2]+"</td><td>"+datos[f*t+3]+"</td><td>"+datos[f*t+4]+"</td><td class='der'>"+number_format(datos[f*t+5])+"</td><td class='der'>"+number_format(datos[f*t+6])+"</td><td class='der'>"+number_format(datos[f*t+7])+"</td><td>"+datos[f*t+8]+"</td><td>"+datos[f*t+9]+"</td><td>"+datos[f*t+10]+"</td><td>"+datos[f*t+11]+"</td><td>"+datos[f*t+12]+"</td><td>"+datos[f*t+13]+"</td><td>"+datos[f*t+14]+"</td></tr>";	

					total_a = aEne+aFeb+aMar+aAbr+aMay+aJun+aJul+aAgo+aSep+aOct+aNov+aDic;
					total_i = iEne+iFeb+iMar+iAbr+iMay+iJun+iJul+iAgo+iSep+iOct+iNov+iDic;
				}
				
				$("#sEne").val(number_format(aEne));      $("#iEne").val(number_format(iEne)); 
				$("#sFeb").val(number_format(aFeb));      $("#iFeb").val(number_format(iFeb)); 
				$("#sMar").val(number_format(aMar));      $("#iMar").val(number_format(iMar)); 
				$("#sAbr").val(number_format(aAbr));      $("#iAbr").val(number_format(iAbr)); 
				$("#sMay").val(number_format(aMay));      $("#iMay").val(number_format(iMay)); 
				$("#sJun").val(number_format(aJun));      $("#iJun").val(number_format(iJun)); 
				$("#sJul").val(number_format(aJul));      $("#iJul").val(number_format(iJul)); 
				$("#sAgo").val(number_format(aAgo));      $("#iAgo").val(number_format(iAgo)); 
				$("#sSep").val(number_format(aSep));      $("#iSep").val(number_format(iSep)); 
				$("#sOct").val(number_format(aOct));      $("#iOct").val(number_format(iOct)); 
				$("#sNov").val(number_format(aNov));      $("#iNov").val(number_format(iNov)); 
				$("#sDic").val(number_format(aDic));      $("#iDic").val(number_format(iDic)); 
				$("#totala").val(number_format(total_a)); $("#totali").val(number_format(total_i));
				
				$("#datos").html("</table>"+tabla);
			}
		})

	}
</script>