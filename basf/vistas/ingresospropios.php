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
	#foto {
		border-radius: 10px;
		box-shadow: 0 6px 12px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
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
	.campo {
		border-style: none;
		background-color: transparent;
		
	}
	.der { text-align: right; }
	#enca { 
		color: black;
		background-color: #EFEFEF;
		padding: 5px;
		margin-top: -18px;
		margin-left: -38px;
		width: 104%;
	 }
	#sEne, #sFeb, #sMar, #sAbr, #sMay, #sJun, #sJul, #sAgo, #sSep, #sOct, #sNov, #sDic { border-style: none; background: #E9E9E9; }
	#datos table td:hover { border-bottom: solid; border-color: #1F1F1F; background-color: #A6A6A6; border-width:1px; padding: 4px; }
    #datos table td {}
    #datos table td input { margin: 0px; }
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
				<button onclick="actualizar()"><spam class="fa fa-2x fa-refresh"></spam>Importar datos</button>
				<button onclick="verarchivo()"><spam class="fa fa-2x fa-refresh"></spam> Recalcular</button>
				<input style="display: none;" type="text" id="rol" value="<?php echo $rol; ?>">
				<form action="vistas/regresar.php" method="post" enctype="multipart/form-data">
					<input style="display: none;" name="archivo" onchange="verarchivo()" id="archivo" type="file" name="adjunto" accept=".xls,.xlsx">
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
		<div class="col-md-4">
			<table>
				<tr><td><label for="">Año</label> </td>
					<td><select name="" id="">
						<option value="2019">2019</option>
					</select>
					
				</td>
				<td><input type="text" id="valorbase" class="der" value="3506"></td>
				</tr>
				<tr><td><label for="">Enero</label>      </td><td><input id="sEne" class="der" type="text"><td><input id="v01" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Febrero</label>    </td><td><input id="sFeb" class="der" type="text"><td><input id="v02" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Marzo</label>      </td><td><input id="sMar" class="der" type="text"><td><input id="v03" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Abril</label>      </td><td><input id="sAbr" class="der" type="text"><td><input id="v04" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Mayo</label>       </td><td><input id="sMay" class="der" type="text"><td><input id="v05" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Junio</label>      </td><td><input id="sJun" class="der" type="text"><td><input id="v06" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Julio</label>      </td><td><input id="sJul" class="der" type="text"><td><input id="v07" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Agosto</label>     </td><td><input id="sAgo" class="der" type="text"><td><input id="v08" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Septiembre</label> </td><td><input id="sSep" class="der" type="text"><td><input id="v09" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Octubre</label>    </td><td><input id="sOct" class="der" type="text"><td><input id="v10" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Noviembre</label>  </td><td><input id="sNov" class="der" type="text"><td><input id="v11" class="der" type="text" disabled></td></td></tr>
				<tr><td><label for="">Diciembre</label>  </td><td><input id="sDic" class="der" type="text"><td><input id="v12" class="der" type="text" disabled></td></td></tr>
				<tr><td class="der">TOTAL  </td><td><input id="total" class="der" type="text"><td></td></td></tr>
			</table>
			<br>

		</div>
		<div class="col-md-8">
			<div id="datos">
				
			</div>
		</div>

	</div>
</div>

<button class='btn btn-success' id="consolidado" style='margin-top:10px; margin-left: -30px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Consolidado</button>
<script>
	$("#consolidado").click(function(){
		location.href="reportes/ringprocon.php?tipo=xls&valor="+$("#valorbase").val();
	})
</script>
<a class='btn btn-success' href="reportes/ringprodet.php?tipo=xls" style='margin-top:10px; border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Detalle</a>
<style>
	#pale  td { width: 30px; height: 30px; }
	#pale  td:hover { border-style: solid; border-color: white; border-width: 2px; }
</style>
 
<script>
	verarchivo()

	function procesararchivo() {
	 $("#archivo").click();
	}

	function verarchivo() {
		$("#nomarchivo").val($("#archivo").val());
		$.ajax({
			type:"post",
			url : "excel/xcomision.php",
			success : function (data) {
				datos = [];
				datos = data.split(";");
				canti = (datos.length - 1)/5
				//alert(canti);
				cEne=0; cFeb=0; cMar=0; cAbr=0; cMay=0; cJun=0; cJul=0; cAgo=0; cSep=0; cOct=0; cNov=0; cDic=0;
				tabla = "<table class='table table-bordered'><tr><th></th><th>Entidad</th><th>Fecha</th><th>Concepto</th><th>Documento</th><th>Credito</th></tr>";
				for(f=1; f<=canti;f++) {
					if(datos[f*5]!="") {
						tabla += "<tr><td>"+f.toString()+"</td><td>"+datos[f*5]+"</td><td>"+datos[f*5+1]+"</td><td>"+datos[f*5+2]+"</td><td>"+datos[f*5+3]+"</td><td>"+datos[f*5+4]+"</td></tr>";
						if(datos[f*5+1]=="Enero")      cEne += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Febrero")    cFeb += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Marzo")      cMar += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Abril")      cAbr += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Mayo")       cMay += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Junio")      cJun += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Julio")      cJul += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Agosto")     cAgo += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Septiembre") cSep += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Octubre")    cOct += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Noviembre")  cNov += parseInt(datos[f*5+4]);
						if(datos[f*5+1]=="Diciembre")  cDic += parseInt(datos[f*5+4]);
						
					}
				}
				$("#datos").html("</table>"+tabla);
				base = $("#valorbase").val();
				total = cEne+cFeb+cMar+cAbr+cMay+cJun+cJul+cAgo+cSep+cOct+cNov+cDic;
				$("#sEne").val(number_format(cEne)); $("#v01").val(number_format(Math.round(cEne/base,0)));
				$("#sFeb").val(number_format(cFeb)); $("#v02").val(number_format(Math.round(cFeb/base,0)));
				$("#sMar").val(number_format(cMar)); $("#v03").val(number_format(Math.round(cMar/base,0)));
				$("#sAbr").val(number_format(cAbr)); $("#v04").val(number_format(Math.round(cAbr/base,0)));
				$("#sMay").val(number_format(cMay)); $("#v05").val(number_format(Math.round(cMay/base,0)));
				$("#sJun").val(number_format(cJun)); $("#v06").val(number_format(Math.round(cJun/base,0)));
				$("#sJul").val(number_format(cJul)); $("#v07").val(number_format(Math.round(cJul/base,0)));
				$("#sAgo").val(number_format(cAgo)); $("#v08").val(number_format(Math.round(cAgo/base,0)));
				$("#sSep").val(number_format(cSep)); $("#v09").val(number_format(Math.round(cSep/base,0)));
				$("#sOct").val(number_format(cOct)); $("#v10").val(number_format(Math.round(cOct/base,0)));
				$("#sNov").val(number_format(cNov)); $("#v11").val(number_format(Math.round(cNov/base,0)));
				$("#sDic").val(number_format(cDic)); $("#v12").val(number_format(Math.round(cDic/base,0)));
				$("#total").val(number_format(total));
			}
		})
	}
</script>