<style>
	 #limpo {
	    width: 100%;
	    height: 250px;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    border-radius: 4px;
	}     

	td { padding: 1px; }
	.seccion { 
		padding: 10px;
		background-color: #D3EBF5;
		border-radius: 8px;
	}
	h2{
		text-align: center !important;
	}
	.panel {
		text-align: center; font-size: 12px; background-color: #A1D0E1; color: black;
	}
	.bex { width: 125px; }
	input[type=date] { color: #EBEBEB; }
</style>
<div class="vistapc" style="margin-top: -30px; color: black; font-size: 14px;">
	<!-- VISTA PARA COMPUTADOR -->
	<div class="row">
	  <div class="col-md-4" style="width: 560px">
	  	<div class="seccion">
	  		<div class="panel">PARAMETROS BASICOS</div>
			<table>
				<tr>
					<td width="110px">Sucursal</td>			
					<td><select id="cbxSucursal">
						<option value="0">TODAS...</option>
						<option value="BQ">BARRANQUILLA</option>
						<option value="BG">BOGOTA</option>
						<option value="BV">BUENAVENTURA</option>
						<option value="CG">CARTAGENA</option>
						<option value="MD">MEDELLIN</option>
						<option value="SM">SANTA MARTA</option>
					</select></td>
				</tr>
				<tr>
					<td>Importador</td>			
					<td><select id="cbxImportador1" style="width: 350px;" <?php if($_SESSION['rol']=="CLIENTE") echo "disabled"; ?>>
							<?php 
								if($_SESSION['rol']!="CLIENTE")	{ 
									echo "<option value='-1'>Seleccione...</option>";
									echo "<option value='0' selected>TODOS</option>";
									echo listaimportadoresrem(); 
								}
								else {
									echo "<option value='".$_SESSION['idimportador']."'>".$_SESSION['nomusuario']."</option>";
								}
							?>
						</select>
					<button <?php if($_SESSION['rol']=="CLIENTE") echo "style='display:none'"; ?> type="button" id="btbuscarimp" class="buscar" data-toggle="modal" data-target="#buscaimp"><span class="fa fa-search"></span></button>
					<script>
						$("#btbuscarimp").click(function(){ 
							$("#textoabuscarimp").val("");
							$("#textoabuscarimp").focus();
						})
					</script>
					</td>
				</tr>
				<tr>
					<td>Tercero</td>			
					<td><select id="cbxTercero1" style="width: 350px;" <?php if($_SESSION['rol']=="CLIENTE") echo "disabled"; ?>>
							<option value="0">TODOS</option>
							<?php echo listar(0,4,"select * from terceros"); ?>
						</select>
						<button <?php if($_SESSION['rol']=="CLIENTE") echo "style='display:none'"; ?>  class="buscar"><span class="fa fa-search"></span></button>
					</td>
				</tr>
				<tr>
					<td>Ejecutivo</td>			
					<td><select id="cbxEjecutivo1" disabled>
							<option value="0">TODOS...</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Reporte</td>			
					<td><select id="cbxReporte1" style="width: 350px;">
						
						<!-- Llenar el combo con los reporte de Importaciones  -->
						<?php echo listaparametros($_SESSION['ideusuario'],'D'); ?>
						<option value="-1">Seleccione...</option>
					</select>
					<button type="button" id="btbuscarrep" class="buscar" data-toggle="modal" data-target="#buscarep"><span class="fa fa-search"></span></button>
					<script>
						$("#btbuscarrep").click(function(){ 
							$("#textoabuscarrep").val("");
							$("#textoabuscarrep").focus();
						})
					</script>
				</td>
				</tr>
			</table>
	  	</div> <br>
	  	<div class="seccion">
	  		<div class="panel">INFORMACION ESPECIFICA</div>
			<table>
				<tr>
					<td width="200px">Numero Do</td>			
					<td><input type="text" id="txtNro_Do"></td>
				</tr>
				<tr>
					<td>Número Pedido</td>			
					<td><input type="text" id="txtNro_pedido"></td>
				</tr>
				<tr>
					<td>Orden de Compra</td>			
					<td><input type="text" id="txtOrden_Compra"></td>
				</tr>
				<tr>
					<td>Doc. Transporte</td>			
					<td><input type="text" id="txtdoctrans"></td>
				</tr>
			</table>
	  	</div>
	  </div>


  	<div class="col-md-6" style="width: 620px; ">
	  	<div class="seccion">
	  		<div class="panel">MODALIDAD ADUANERA</div>
			<h2 align="center">Dtas</h2>
	  	</div>
		<br>
	  	<div class="seccion" style="font-size: 14px;">
	  		<div class="panel">FILTROS PARA INFORME</div>
			<table>
				<tr><td width="250px">
					    Fecha de Apertura</td>

					    <td><input type="date" id="txtAperturaI"> 
					    	<input type="date" id="txtAperturaF">
					    </td></tr>
				<tr><td>Fecha de Levante / DEX</td>
						<td><input type="date" id="txtLevanteI">
							<input type="date" id="txtLevanteF">
						</td></tr>
				<tr><td>Fecha de Aceptacion / SAE</td>
						<td><input type="date" id="txtAceptacionI">
							<input type="date" id="txtAceptacionF">
						</td></tr>
				<tr><td>Fecha Mcia en Planta / ETA Expo</td>
						<td><input type="date" id="txtMercanciaI">
							<input type="date" id="txtMercanciaF">
						</td></tr>
				<tr><td>Fecha Retiro Total / Cargue en planta</td>
						<td><input type="date" id="txtRetiroI">
							<input type="date" id="txtRetiroF">
						</td></tr>	
				<tr><td>Fecha de Sticker /Fecha Zarpe</td>
						<td><input type="date" id="txtZarpeI">
							<input type="date" id="txtZarpeF">
						</td></tr>	
				<tr><td>Fecha de Factura</td>
						<td><input type="date" id="txtFacturaI">
							<input type="date" id="txtFacturaF">
						</td></tr>	
			</table>
	  	</div>

	  </div>
	  <div class="col-md-2" style="width: 300px;">
	  	<div class="seccion">
	  		<div class="panel">DATOS DEL INFORME</div>
	  		<textarea name="" id="datosdelinforme" cols="30" rows="10" style="height: 150px; width: 260px"></textarea>
	  		<br><br>
			  <center>

				<!-- <button id="generarpdf" class="btn bex btn-primary"><span style="font-size:40px;" class="fa fa-file-pdf-o"></span><br>Generar PDF</button>  -->
			  	
			  	<button id="generaxls" class="btn bex btn-primary"><span style="font-size:40px;" class="fa fa-file-excel-o"></span><br>Generar XLS</button><br><br>
			  	<button id="generatxt" class="btn bex btn-primary"><span style="font-size:40px;" class="fa fa-file-code-o"></span><br>Generar TXT</button> 
			  	<button id="generahtml" class="btn bex btn-primary" style="background: #193A68;"><span style=" font-size:40px;" class="fa fa-file-code-o"></span><br>Ver como HTML</button> 
				<button style="display: none;" type="button" class="btn btn-success bex" data-toggle="modal" data-target="#myModal">Boton</button>
				<button style="display: none;" type="button" id="btnesperar" class="btn btn-success bex" data-toggle="modal" data-target="#espere"><span style="font-size:36px;" class="glyphicon glyphicon-question-sign"></span><br>Espere</button>
				<button style="display: none;" type="button" id="btnnoreporte" class="btn btn-success bex" data-toggle="modal" data-target="#noreporte"><span style="font-size:36px;" class="glyphicon glyphicon-question-sign"></span><br>Espere</button>
			  </center>
	  	</div>
	  </div>
	</div>
</div> <!-- Fin div Vista PC-->

<div class="vistamv" style="color: black">
	Vista Movil NO disponible
</div> <!-- Fin div Vista Movil-->


<!-- ventana modal -->
<div class="container" style="color: black;">
  <!-- ......................................................... -->
  <div class="modal fade" id="myModal" role="dialog" style="margin-top: 100px;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ayuda</h4>
        </div>
        <div class="modal-body">
          <p>Consulte a su DBA sobre como generar reportes</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  <!-- ............................ MENSAJE DE ESPERA ............................. -->
  <div class="modal fade" id="espere" role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <p style="text-align: center;"><i class="fa fa-spinner fa-spin fa-lg" style="font-size:24px"></i><br>Espere un momento por favor...</p>
        </div>        
        <center><button type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cerrar</button></center><br>
      </div>
      
    </div>
  </div>
  <!-- ..........................  MENSAJE DE NO REPORTE ............................... -->
  <div class="modal fade" id="noreporte" role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <p style="text-align: center;">
			<span class="fa fa-exclamation-triangle fa-4x"></span><br>
          	<b>Atencion</b><br>Reporte No instalado o no tiene autorizacion</p>
        </div>        
        <center><button type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cerrar</button></center><br>
      </div>
      
    </div>
  </div>
  <!-- .......................... BUSCAR IMPORTADOR ............................... -->
  <div class="modal fade" id="buscaimp" role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Busca Importador</h4>
        </div>
        <div class="modal-body">
          <input type="text" id="textoabuscarimp" autofocus style="width: 100%" placeholder="Escriba descripcion...">	
        </div>        
        <center>
        	<button type="button" id="seleccionaimp" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-check"></span>Buscar</button>
        	<button style="display: none" type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        	<script>

        		$("#seleccionaimp").click(function(){
			        texto = $("#textoabuscarimp").val().toUpperCase();
			        $("#cbxImportador1 option:contains('')").css("display","none");
			        $("#cbxImportador1 option:contains('"+texto+"')").css("display","");
			        $("#cbxImportador1 option[value=-1]").css("display",""); 
			        $("#cbxImportador1").val(-1);
        		});
        	</script>
        </center><br>
      </div>
      
    </div>
  </div>
  <!-- .......................... REPORTES MULTIPLES ............................... -->
  <button style="display: none;" type="button" class="btn btn-success bex" data-toggle="modal" data-target="#repmultiples">Boton</button>
  <div class="modal fade" id="repmultiples" role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reportes Multiples</h4>
        </div>
        <div class="modal-body">
          Esta opcion genera multiples reportes	
        </div>        
        <center>
        	<button type="button" id="seleccionarep" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-check"></span>Buscar</button>
        	<button style="display: none" type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        </center><br>
      </div>
      
    </div>
  </div>
  <!-- .......................... BUSCAR REPORTE ............................... -->
  <div class="modal fade" id="buscarep" role="dialog" style="margin-top: 200px;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Busca Reporte</h4>
        </div>
        <div class="modal-body">
		  <font size="2">Escriba el nombre del reporte a buscar</font>
          <input type="text" id="textoabuscarrep" autofocus style="width: 100%" placeholder="Escriba descripcion...">	
        </div>        
        <center>
        	<button type="button" id="seleccionarep" onclick="filtrarep()" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-check"></span>Buscar</button>
        	<button style="display: none" type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        	<script>
			   function filtrarep() {
				texto = $("#textoabuscarrep").val();
			        $("#cbxReporte1 option:contains('')").css("display","none");
			        $("#cbxReporte1 option:contains('"+texto+"')").css("display","");
			        $("#cbxReporte1 option[value=-1]").css("display",""); 
			        $("#cbxReporte1").val(-1);
			   }
        	</script>
        </center><br>
      </div>
      
    </div>
  </div>
  <!-- ......................................................... -->

</div>

<script>
	$("#cbxReporte1").change(function(){
		//($("#cbxReporte1").val());

	})

	$("#generarpdf").click(function(){	generarreporte("PDF");  });
	$("#generaxls").click(function() {  generarreporte("XLS");  });
	$("#generatxt").click(function(){	generarreporte("TXT");	});
	$("#generahtml").click(function(){	generarreporte("HTML");	});

	function generarreporte(tiporep) {
		modalidad = 0;
		$("#datosdelinforme").val("Ejecutando consulta...");

		/*if($("#mod_imp").is(':checked')) modalidad = "I";
		if($("#mod_dta").is(':checked')) modalidad = "T";
		if($("#mod_tra").is(':checked')) modalidad = "I";
		if($("#mod_exp").is(':checked')) modalidad = "E";
		if($("#mod_otr").is(':checked')) modalidad = "O";
		if($("#mod_tod").is(':checked')) modalidad = ""; */

		modalidad = "T";
       	parametro  = "?p_sucursal="   +$("#cbxSucursal").val();
       	parametro += "&p_importador=" +$("#cbxImportador1").val();
       	parametro += "&p_tercero=" +$("#cbxTercero1").val();
       	parametro += "&p_ejecutivo="  +$("#cbxEjecutivo1").val();
       	parametro += "&p_reporte="    +$("#cbxReporte1").val();
       	parametro += "&p_tipo="       +tiporep;
       	
      
       	parametro += "&p_numerodo="   +$("#txtNro_Do").val();
       	parametro += "&p_numeroped="  +$("#txtNro_pedido").val();
       	parametro += "&p_ordencompra="+$("#txtOrden_Compra").val();
       	parametro += "&p_numeroacep=" +$("#txtAceptacion").val();
       	parametro += "&p_doctrans="   +$("#txtdoctrans").val();
       	parametro += "&p_modalidad="  +modalidad;
       	parametro += "&p_faperturai=" +$("#txtAperturaI").val();
       	parametro += "&p_faperturaf=" +$("#txtAperturaF").val();
       	parametro += "&p_flevantei="  +$("#txtLevanteI").val();
       	parametro += "&p_flevantef="  +$("#txtLevanteF").val();
       	parametro += "&p_faceptai="   +$("#txtAceptacionI").val();
       	parametro += "&p_faceptaf="   +$("#txtAceptacionF").val();
       	parametro += "&p_fmercanciai="+$("#txtMercanciaI").val();
       	parametro += "&p_fmercanciaf="+$("#txtMercanciaF").val();
       	parametro += "&p_fretiroi="   +$("#txtRetiroI").val();
       	parametro += "&p_fretirof="   +$("#txtRetiroF").val();
       	parametro += "&p_fstickeri="  +$("#txtZarpeI").val();
       	parametro += "&p_fstickerf="  +$("#txtZarpeF").val();
       	parametro += "&p_ffacturai="  +$("#txtFacturaI").val();
       	parametro += "&p_ffacturaf="  +$("#txtFacturaF").val();
       	

       	numr = $("#cbxReporte1").val().trim();
       	switch(numr) {
       		case "102": 
       			alert("Esta opcion genera multiples informes los cuales se descargaran como archivos y pestañas separadas del navegador asi:\n\n1. PCDEPT00\n2. PDDEPT00\n3. NACIONALIZACION MERCK\n4. DIM MERCK\n5. CONTROLADOS")
       			archivo = "reportes/reporte"+numr+"a.php"; w1 = window.open(archivo+parametro,'_blank');
       			archivo = "reportes/reporte"+numr+"b.php"; w2 = window.open(archivo+parametro,'_blank');
       			archivo = "reportes/reporte"+numr+"c.php"; w3 = window.open(archivo+parametro,'_blank');
       			archivo = "reportes/reporte"+numr+"d.php"; w4 = window.open(archivo+parametro,'_blank');
       			archivo = "reportes/reporte"+numr+"e.php"; w5 = window.open(archivo+parametro,'_blank');
				break;
       		default : 
       			archivo = "reportes/reporte"+numr+".php";
       			wnuevo = window.open(archivo+parametro,'_blank');
       	}

		//$("#btnesperar").click();
		//$("#esperacerrar").click();

    }

     // CSS para campos de fechas vacios y con valor
	$("#txtAperturaI").change(function() { $("#txtAperturaI").css("color","black"); });
	$("#txtAperturaI").blur(function(){ if($("#txtAperturaI").val()=="") $("#txtAperturaI").css("color","#EBEBEB"); }); 
	$("#txtAperturaF").change(function() { $("#txtAperturaF").css("color","black"); });
	$("#txtAperturaF").blur(function(){ if($("#txtAperturaF").val()=="") $("#txtAperturaF").css("color","#EBEBEB"); }); 

	$("#txtLevanteI").change(function() { $("#txtLevanteI").css("color","black"); });
	$("#txtLevanteI").blur(function(){ if($("#txtLevanteI").val()=="") $("#txtLevanteI").css("color","#EBEBEB"); }); 
	$("#txtLevanteF").change(function() { $("#txtLevanteF").css("color","black"); });
	$("#txtLevanteF").blur(function(){ if($("#txtLevanteF").val()=="") $("#txtLevanteF").css("color","#EBEBEB"); }); 

	$("#txtAceptacionI").change(function() { $("#txtAceptacionI").css("color","black"); });
	$("#txtAceptacionI").blur(function(){ if($("#txtAceptacionI").val()=="") $("#txtAceptacionI").css("color","#EBEBEB"); }); 
	$("#txtAceptacionF").change(function() { $("#txtAceptacionF").css("color","black"); });
	$("#txtAceptacionF").blur(function(){ if($("#txtAceptacionF").val()=="") $("#txtAceptacionF").css("color","#EBEBEB"); }); 

	$("#txtMercanciaI").change(function() { $("#txtMercanciaI").css("color","black"); });
	$("#txtMercanciaI").blur(function(){ if($("#txtMercanciaI").val()=="") $("#txtMercanciaI").css("color","#EBEBEB"); }); 
	$("#txtMercanciaF").change(function() { $("#txtMercanciaF").css("color","black"); });
	$("#txtMercanciaF").blur(function(){ if($("#txtMercanciaF").val()=="") $("#txtMercanciaF").css("color","#EBEBEB"); }); 

	$("#txtRetiroI").change(function() { $("#txtRetiroI").css("color","black"); });
	$("#txtRetiroI").blur(function(){ if($("#txtRetiroI").val()=="") $("#txtRetiroI").css("color","#EBEBEB"); }); 
	$("#txtRetiroF").change(function() { $("#txtRetiroF").css("color","black"); });
	$("#txtRetiroF").blur(function(){ if($("#txtRetiroF").val()=="") $("#txtRetiroF").css("color","#EBEBEB"); }); 

	$("#txtZarpeI").change(function() { $("#txtZarpeI").css("color","black"); });
	$("#txtZarpeI").blur(function(){ if($("#txtZarpeI").val()=="") $("#txtZarpeI").css("color","#EBEBEB"); }); 
	$("#txtZarpeF").change(function() { $("#txtZarpeF").css("color","black"); });
	$("#txtZarpeF").blur(function(){ if($("#txtZarpeF").val()=="") $("#txtZarpeF").css("color","#EBEBEB"); }); 

	$("#txtFacturaI").change(function() { $("#txtFacturaI").css("color","black"); });
	$("#txtFacturaI").blur(function(){ if($("#txtFacturaI").val()=="") $("#txtFacturaI").css("color","#EBEBEB"); }); 
	$("#txtFacturaF").change(function() { $("#txtFacturaF").css("color","black"); });
	$("#txtFacturaF").blur(function(){ if($("#txtFacturaF").val()=="") $("#txtFacturaF").css("color","#EBEBEB"); }); 

</script>