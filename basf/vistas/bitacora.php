<style>
	body        { color: black; }
	table th    { text-align: center; font-size: 12px }
	table       { font-size: 12px;	}
	#datos      { width: 104%;  overflow-x: scroll; overflow-y: scroll;  padding: 5px; white-space: nowrap; border-radius: 4px; } 
	#encabezado { width: 104%; height: 50px; color: black; overflow-x: scroll; overflow: hidden; }
	#enca       { color: black; background-color: #EFEFEF; padding: 5px; margin-top: -18px;	margin-left: -38px;	width: 106%; }
    #info td    { }
	#enca button:hover { background-color: #FCDD88}
	#info td       { display: inline-block; height: 20px ; white-space: nowrap;  overflow: hidden;}
	
</style>
<?php
   @session_start();
   $rol = $_SESSION['rol'];
   $visible = "";
   if($rol=="CLIENTE") {
   		$visible=" style='display:none'; ";
   }
?>  
<p style="border-style: none; color: red; font-size: 14px; padding-bottom: 20px" id="mensaje">Cargando ....</p>

<div id="enca" <?php echo $visible; ?>>
	<table>
		<tr>
			<td> &nbsp;<br><input type="text" id="referencia" disabled style="width: 50px"></td>
			<td>Valor Celda<br><input onkeypress="validar()" id="vcelda"  style="width: 200px; height: 28px;"></td>
			<td><br>
				&nbsp;<button id="insarriba" title="Inserta una fila encima"><spam class="fa fa-1x fa fa-level-up"></spam></button>
				&nbsp;<button id="insabajo"  title="Inserta una fila debajo"><spam class="fa fa-1x fa fa-level-down"></spam></button>
				&nbsp;<button id="eliminafila" title="Elimina la fila seleccionada"><spam class="fa fa-1x fa-remove"></spam></button>
				&nbsp;<button id="paleta" title="Rellena con color la celda"><spam class="fa fa-1x   fa-tint"></spam></button>
				&nbsp;<button id="estecolor" title="Rellena la celda con este color"><spam id="estecolorspan" style="color: white" class="fa fa-1x   fa-circle"></spam></button>
				&nbsp;<button id="clonar" title="Captura el color de la celda seleccionada"><spam class="fa fa-1x   fa-clone"></spam></button>
				&nbsp;<button id="moverfilaup" title="Mueve la fila por encima de la fila destino"><spam class="fa fa-1x fas fa-arrow-up"></spam></button>
				&nbsp;<button id="moverfiladown" title="Mueve la fila por debajo de la fila destino"><spam class="fa fa-1x ffas fa-arrow-down"></spam></button>
				&nbsp;<button id="moverfilaupvarios" title="Mueve varias fila por encima de la fila destino en el mismo orden"><spam class="fa-1x fa fa-angle-double-up"></spam></button>
				&nbsp;<button id="moverfiladownvarios" title="Mueve varias fila por debajo de la fila destino en el mismo orden"><spam class="fa-1x fa fa-angle-double-down"></spam></button>
				&nbsp;<button id="enviarhist" title="Exportar a registro historico"><spam class="fa fa-1x fas fa-toggle-off"></spam></button>
				&nbsp;<button id="enviaracti" title="Exportar a registro activos"><spam class="fa fa-1x fas fa-toggle-on"></spam></button>
				&nbsp;<button id="ocultarcol" title="Oculta la columna seleccionada"><spam class="fa fa-1x  fas fa-eye-slash"></spam></button>
				<input type="color" name="" class="btn" id="colores" style="display: none;">
				&nbsp;<button id="aumentaalto" title="Aumenta el alto de la cuadricula para ver mas filas"><spam class="fa fa-1x   fa-plus"></spam></button>
				&nbsp;<button id="disminuyealto" title="Disminuye el alto de la cuadricula para ver mas filas"><spam class="fa  fa-1x  fa-minus"></spam></button>

				&nbsp;<button id="aumentaancho" title="Aumenta el ancho de la columna"><spam class="fa  fa-1x  fa-search-plus"></spam></button>
				&nbsp;<button id="disminuyeancho"  title="Disminuye el ancho de la columna"><spam class="fa fa-1x   fa-search-minus"></spam></button>
				&nbsp;<button id="refrescar" title="Actualizar datos de la bitacora"><spam class="primary fa  fa-1x  fa-refresh"></spam></button>
				&nbsp;<button id="seleccionar" title="Selecciona mltiples celdas"><spam class="primary fa  fa-1x  fa-arrows"></spam></button>
				&nbsp;&nbsp;
				Filtro
				<select id="yearkpi" style="display: none">
					<option value="2020" selected>2020</option>
					<option value="2019">2019</option>
					<option value="2018">2018</option>
					<option value="2017">2017</option>
					<option value="2016">2016</option>
					<option value="2015">2015</option>
					<option value="2014">2014</option>
					<option value="2013">2013</option>
					<option value="2012">2012</option>
					<option value="2011">2011</option>
				</select>
				<select id="meskpi">
					<option value="TODOS">Mes</option>
					<option value="ENE">Enero</option>
					<option value="FEB">Febrero</option>
					<option value="MAR">Marzo</option>
					<option value="ABR">Abril</option>
					<option value="MAY">Mayo</option>
					<option value="JUN">Junio</option>
					<option value="JUL">Julio</option>
					<option value="AGO">Agosto</option>
					<option value="SEP">Septiembre</option>
					<option value="OCT">Octubre</option>
					<option value="NOV">Noviembre</option>
					<option value="DIC">Diciembre</option>
				</select>
				<select id="tiporeg">
					<option value="T">TODOS</option>
					<option value="A" selected>ACTIVOS</option>
					<option value="H">HISTORICOS</option>
				</select>
				<button class='btn btn-warning' id='filtrabitacora' style="height: 32px"><span class='fa fa-filter'></span></button>
				<a class='btn btn-warning' target="_self" href="reportes/rbitacorar.php?tipo=xls" style='height: 32px;' title="Exporta a formato XLS con color"><span class="fa fa-download"></span></a>
				<input style="display: none;" type="text" id="rol" value="<?php echo $rol; ?>">
				<input style="display: none;" type="text" id="colorcell">
			    <input id="pfila" type="text" style="display:  none; width: 30px">
			    <input id="pcolu" type="text" style="display:  none; width: 30px">
				<input id="nfilas" type="text" style="display: none; width: 30px">
				<input id="ncolus" type="text" style="display: none; width: 30px">
				<input ic="ccelda" type="text" style="display: none; width: 30px"> 
				<input id="finfila" type="text" style="display: none; width: 30px">
				<input id="fincol" type="text" style="display: none; width: 30px">
			</td>
		</tr>
	</table>
</div>
<div id="encabezado" style="margin-left: -35px; color: black">	
	<div style="width: 5450px" id="encatit">
		<table class="table table-bordered" style="font-size: 10px" id="titulos">
			<tr>
				<th style='width:75px'>Regi.</th>
				<th style='width:60px'>Mes</th>
				<th style='width:112px'>Pedido</th>
				<th style='width:64px'>ITM</th>
				<th style='width:64px'>Canal</th>
				<th style='width:154px'>DO</th>
				<th style='width:160px'>BL</th>
				<th style='width:90px'>Pto de<br>embarque</th>
				<th style='width:84px'>Vlr Fac<br>USD</th>
				<th style='width:66px'>Valor<br>Flete</th>
				<th style='width:67px'>Incot</th>
				<th style='width:68px'>Adu</th>
				<th style='width:117px'>Codigo<br>Material</th>
				<th style='width:312px'>Producto</th>
				<th style='width:62px'>BU</th>
				<th style='width:66px'>SBU</th>
				<th style='width:88px'>Cantidad<br>segun fac.</th>
				<th style='width:64px'>UM</th>
				<th style='width:66px'>Unidad<br> de carga</th>
				<th style='width:66px'>Can<br>UC</th>
				<th style='width:110px'>Descripcion<br>embalaje</th>
				<th style='width:160px'>Proveedor</th>
				<th style='width:88px'>Estima<br>arribo</th>
				<th style='width:84px'>ETAR</th>

				<th style='width:90px'>Estima<br>levan</th>
				<th style='width:88px'>Levant</th>
				<th style='width:86px'>Estima<br>bodega</th>
				<th style='width:66px'>En<br>bodega</th>
				<th style='width:66px'>Obs</th>
				<th style='width:162px'>Destino</th>

				<th style='width:86px'>ETD</th>
				<th style='width:86px'>Manif</th>
				<th style='width:86px'>Kit Back<br>Office</th>
				<th style='width:86px'>Kit Comp<br>Basf</th>
				<th style='width:88px'>Consult<br>Invent</th>
				<th style='width:88px'>Ica<br>Invima</th>

				<th style='width:260px'>Comentarios</th>
				<th style='width:86px'>Factura No.</th>
				<th style='width:86px'>Fecha de<br>Factura</th>
				<th style='width:68px'>Plazo</th>
				<th style='width:215px'>Pais Proveedor</th>
				<th style='width:215px'>Motonave</th>

				<th style='width:86px'>Fecha<br>BL</th>
				<th style='width:64px'>Pto de<br>llegada</th>
				<th style='width:216px'>Naviera</th>
				<th style='width:86px'>Fec Rec<br>Original</th>
				<th style='width:86px'>Fec Rec<br>Factura</th>
				<th style='width:86px'>Docum<br>Complet</th>

				<th style='width:86px'>Elabor</th>
				<th style='width:86px'>Acepta</th>
				<th style='width:86px'>Plani</th>
				<th style='width:86px'>Entrega<br>Transp</th>
				<th style='width:124px'></th>
			</tr>
		</table>
	</div>
</div>
<div id="datos" style="margin-left: -40px; margin-top: 0px; color: black">
	<?php

		$tablacue = "";
		$wi = array("75px" ,"60px","112px", "64px", "64px","154px",
					"160px","90px","84px", "66px","67px", "68px",
					"117px","312px","62px","66px","88px","64px", 
					"66px" ,"66px","110px","160px", "88px", "84px", 
					"90px","88px","86px", "66px","66px","162px", 
					"86px", "86px","86px","86px","88px","88px", 
					"260px", "86px","86px", "68px","215px","215px", 
					"86px","64px","216px","86px","86px", "86px", 
					"86px", "86px", "86px", "86px" );
        $tablaenc = "<table class='table-bordered' style='color: black' id='info'><tbody>";
 		$tablafin = "</tbody></table>";
 		$perfil = explode(";",perfilusuario($_SESSION['ideusuario']));
		conectalocal();

		$condicion = "";

	 	if(isset($_GET['est'])) $estado = $_GET['est']; else $estado = "T";
	 	if(isset($_GET['mes'])) {
	 		$mes = $_GET['mes'];
	 		if($mes != "TODOS") $condicion .= " AND MES='$mes' ";
	 	}

		
	    if($estado=="T")
			$sql = "SELECT bitacora.*, coloreshex.* FROM bitacora, coloreshex WHERE bitacora.id=coloreshex.c0 $condicion ORDER BY ORDEN";
		else
			$sql = "SELECT bitacora.*, coloreshex.* FROM bitacora, coloreshex WHERE ESTADO='$estado' AND bitacora.id=coloreshex.c0 $condicion ORDER BY ORDEN";
		$res = mysql_query($sql);
		$cont = 0;
		while ($reg = mysql_fetch_array($res)) {
			$tablacue .= "<tr>";
			if($reg[1]!="") $mostrar = true; else $mostrar = false;
			for($c=0; $c<52; $c++) { 
				$ancho = "style='width:$wi[$c]'"; 

				if($c>0) $color = "bgcolor='".$reg[$c+54]."'"; 	else $color="";

			    if($rol=="CLIENTE") {
			   		if ($mostrar) $tablacue .= "<td $ancho >".$reg[$c]."</td>";
			    } else {
					if($c>0 && $perfil[$c-1]=="A") 
							$tablacue .= "<td $ancho  $color contenteditable >".$reg[$c]."</td>";
						else 
							$tablacue .= "<td $ancho  $color >".$reg[$c]."</td>";
			    }

			}
			$tablacue .= "</tr>";
		}
	
 		echo $tablaenc . $tablacue . $tablafin;
	?>
</div>
<a class='btn btn-success' href="reportes/rbitacora.php?tipo=xls" style='margin-top:10px;  margin-left: -30px;border-radius:20px;'><spam class='fa fa-arrow-down'></spam> Descargar Reporte XLS</a>
<input type="text" style="color: black; display: none;" id="margen" > 
<input type="text" style="color: black; display: none;" id="margenvertical" >


<!-- ESPERANDO INFORMACION -->

  <button style="display: none;" type="button" class="btn btn-success bex" data-toggle="modal" id="besperar" data-target="#espere">Boton</button>
  <div class="modal fade" id="espere" role="dialog" style="margin-top: 200px; color:black">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <br>
          <p style="text-align: center;"><i class="fa fa-spinner fa-spin fa-lg" style="font-size:50px; color: black;"></i><br><br>Espere un momento por favor<br>mientras se carga la consuta</p>
        </div>        
        <center><button type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cancelar</button></center><br>
      </div>
      
    </div>
  </div>


<!-- .......................... EDITAR CELDA GRANDE ............................... -->
 <button style="display: none;" type="button" class="btn btn-success bex" data-toggle="modal" id="editagrande" data-target="#vistagrande">Boton</button>
  <div class="modal fade" id="vistagrande" role="dialog" style="height: 400px; margin-top: 150px; color: black; ">
    <div class="modal-dialog" style="height: 450px;">
      <div class="modal-content">
      	<center>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Editar Valor de Celda</b></h4>
       
        </div>
        <div class="modal-body">
            <textarea id="textogrande" style="width: 570px; height: 220px; font-size: 14px;"></textarea>
        </div>   
        <div class="modal-footer">
        	<button type="button" id="enviaredicion" class="btn btn-warning">Enviar</button>
        	<button type="button" id="editacerrar" class="btn" data-dismiss="modal">Cerrar</button>
        </div>     
        </center>
      </div>
      
    </div>
  </div>
<!-- .......................... ERROR. DEBE SELECCIONAR UNA CELDA ............................... -->
 <button style="display: none;" type="button" class="btn btn-success bex" data-toggle="modal" id="bsleccionecelda" data-target="#seleccionecelda">Boton</button>
  <div class="modal fade" id="seleccionecelda" role="dialog" style="margin-top: 150px; color: black; ">
    <div class="modal-dialog">
      <div class="modal-content">
      	<center>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Advertencia</b></h4>		
        </div>
        <div class="modal-body">
        	<span class="fa fa-warning fa-4x" style="color: #F5C47D"></span><br><br>
            Debe seleccionar una celda <br> para ejecutar esta acción
        </div>   
        <div class="modal-footer">
        	<button type="button" id="esperacerrar" class="btn" data-dismiss="modal">Cerrar</button>
        </div>     
        </center>
      </div>
      
    </div>
  </div>
<!-- ............................................................................................... --> 
<script>
	var columnas = "<?php echo(perfilusuario($_SESSION['ideusuario'])); ?>";
	var vcolumnas = [];
	var vcolumnas = columnas.split(";");
	var guardaColor = "";
	var xseleccionar = false;

    ajustaresolucion();

	window.onkeydown = compruebaTecla;
	var mover = false;

	function compruebaTecla (e) {
		var keyCode = document.all ? e.which : e.keyCode; 
		if (keyCode == 40) alert("Abajo")
		if (keyCode == 39) alert("Derecha")
		if (keyCode == 38) alert("Arrriba")
		if (keyCode == 37) alert("Izquierda")

		document.getElementById("info").rows[4].cells[4].focus();
	}

    function ajustaresolucion() {
    
    }

	$("#document").ready(function(){
		$("#mensaje").css("display","none")
		sh = parseInt(getParametro('h'));
		sv = parseInt(getParametro('v'));
		$("#encabezado").scrollLeft(sh)
		$("#datos").scrollTop(sv)
		$("#datos").scrollLeft(sh)
	
      $("#datos").css("height",window.screen.height-410)
	})
// ------------------------------------------------------- BLOQUE 1: Control DOM --- -------------------------------------
	function getParametro(name) {
	    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
	    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
	    results = regex.exec(location.search);
	    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

	$("#info td").keypress(function(){
		salto = false
		fi = parseInt($("#pfila").val())+1
		co = $("#pcolu").val()
		if(event.keyCode==13) {
			salto = true
			event.preventDefault();	
		}
		if(salto==true) {
			$.ajax({
				type:"post",
				url :"ajax/guardacelda.php",
				data: { 
					id      : $("#referencia").val(), 
					columna : $("#pcolu").val(),
					dato    : document.getElementById("info").rows[fi-1].cells[co].innerHTML
				},
				success: function (data) { },
				error:   function ()     { alert("No pudo guardarse..."); }

			})
			document.getElementById("info").rows[fi].cells[co].focus()	
			$("#fila").val(fi)
		}
	})

	$("#info tbody td").change(function(){
		$("#vcelda").val(this.val())
	})

	$("#vcelda").dblclick(function(){
		$("#textogrande").val($("#vcelda").val())
		$("#textogrande").focus()
		$("#editagrande").click()
	})

	$("#enviaredicion").click(function(){
		$("#vcelda").val($("#textogrande").val())
		colu = $("#pcolu").val()
		fila = $("#pfila").val()
		document.getElementById("info").rows[fila].cells[colu].innerHTML = $("#textogrande").val()

		cambiarcolorcelda();
		$("#editacerrar").click()

	})

	$("#seleccionar").click(function(){
		xseleccionar = true;
	})

	$("#info tbody td").focus(function(){
		
		colu = $(this).index();
		fila = $(this).parent('tr').index();
		$("#pfila").val(fila);
		$("#pcolu").val(colu)
		nFilas = $("#info tr").length;
        nColumnas = $("#info tr:last td").length;
        
        $("#nfilas").val(nFilas);
        $("#ncolus").val(nColumnas);
		$("#referencia").val(document.getElementById("info").rows[fila].cells[0].innerHTML);
		$("#vcelda").val(document.getElementById("info").rows[fila].cells[colu].innerHTML);
		
		if(!xseleccionar) {
			$("#finfila").val(fila);
			$("#fincol").val(colu);
		} else {
			xseleccionar = false;
		}
	})

	$("#info tbody td").click(function(){
		
		colu = $(this).index();
		fila = $(this).parent('tr').index();
		$("#pfila").val(fila);
		$("#pcolu").val(colu)
		nFilas = $("#info tr").length;
        nColumnas = $("#info tr:last td").length;
        guardaColor = $(this).css("backgroundColor")
        $("#nfilas").val(nFilas);
        $("#ncolus").val(nColumnas);
	})

	$("#paleta").click(function(){
		$("#colores").click()
	})

	$("#colores").change(function(){

		colu = $("#pcolu").val()
		fila = $("#pfila").val()
		coluf = $("#fincol").val()
		filaf = $("#finfila").val()
		colorcelda = $(this).val()
		guardaColor = colorcelda

		if(fila==filaf && colu==coluf) {
			document.getElementById("info").rows[fila].cells[colu].style.backgroundColor = colorcelda;
			$("#estecolorspan").css("color",colorcelda);
			$("#colorcell").val($("#estecolorspan").css("color"))
			cambiarcolorcelda();		
		} else {
			if(parseInt (fila)< parseInt (filaf)) { desdefila = fila; hastafila = filaf; } else { desdefila = filaf; hastafila = fila; }
			if(parseInt(colu) < parseInt(coluf)) { desdecolu = colu; hastacolu = coluf; } else { desdecolu = coluf; hastacolu = colu; }
			iFila = parseInt(desdefila); iColu = parseInt(desdecolu);
			fFila = parseInt(hastafila); fColu = parseInt(hastacolu);

			for(f= iFila; f<=fFila; f++ ) {
				for(c=iColu; c<= fColu; c++) {
					document.getElementById("info").rows[f].cells[c].style.backgroundColor = colorcelda;
				}
			}
			$.ajax({
				type:"post",
				url :"ajax/guardarcolores.php",
				data: { 
					Fila1   : iFila,
					Fila2   : fFila,
					Colu1   : iColu,
					Colu2   : fColu,
					colorcel: colorcelda
				},
				success : function (data) {
					
				}
			})
		}



	})

// ------------------------------------------------------- Fin BLOQUE 1 -------------------------------------------------
// ------------------------------------------------------- BLOQUE 2: Manejo de Datos -------------------------------------
	$("#datos").scroll(function(){
		$("#margen").val($("#datos").scrollLeft())
		$("#margenvertical").val($("#datos").scrollTop())
		$("#encabezado").scrollLeft($("#datos").scrollLeft())
	})

	$("#filtrabitacora").click(function(){
		location.href = "index.php?accion=bitacora&mes="+$("#meskpi").val()+"&est="+$("#tiporeg").val()
	})

	$("#refrescar").click(function(){ 
		location.href="index.php?accion=bitacora&h="+$("#margen").val()+"&v="+$("#margenvertical").val()+"&est="+$("#tiporeg").val()+"&anno="+$("#yearkpi").val()+"&mes="+$("#meskpi").val();	
	})

	$("#clonar").click(function(){ 
		$("#estecolorspan").css("color",guardaColor) 
		$("#colorcell").val($("#estecolorspan").css("color"))
	})
// ------------------------------------------------------- BLOQUE 2: Manejo de Datos -------------------------------------

	$("#estecolor").click(function(){
		colorcelda = $("#estecolorspan").css("color")
		colu = $("#pcolu").val()
		fila = $("#pfila").val()
		document.getElementById("info").rows[fila].cells[colu].style.backgroundColor = colorcelda

		cambiarcolorcelda();
	})

	$("#aumentaalto").click(function(){
		$("#datos").height($("#datos").height()+10)
	})

	$("#disminuyealto").click(function(){
		$("#datos").height($("#datos").height()-10)
	})

  $("#aumentaancho").click(function(){
  	  $("#encabezado").width($("#encabezado").width()+10);
  	  $("#datos").width($("#datos").width()+10)
  })
   

     $("#disminuyeancho").click(function(){
  	  $("#encabezado").width($("#encabezado").width()-10);
  	  $("#datos").width($("#datos").width()-10)
    })

   $("#ocultarcol").click(function()
    { num =  parseInt(prompt("Columna a Ocultar?",$("#pcolu").val()));
      ancho = document.getElementById("info").rows[fila].cells[colu].style.width
      ancho = ancho.substr(0,ancho.length-2);
      $("#encatit").width($("#encatit").width()-ancho)
      filatabla=document.getElementById('info').getElementsByTagName('tr');
      for(i=0;i<filatabla.length;i++)
            if (filatabla[i].getElementsByTagName('td')[num].style.display=='none') 
                  filatabla[i].getElementsByTagName('td')[num].style.display='';      
            else  filatabla[i].getElementsByTagName('td')[num].style.display='none'

      filatabla=document.getElementById('titulos').getElementsByTagName('tr');
      for(i=0;i<filatabla.length;i++)
            if (filatabla[i].getElementsByTagName('th')[num].style.display=='none') 
                  filatabla[i].getElementsByTagName('th')[num].style.display='';      
            else  filatabla[i].getElementsByTagName('th')[num].style.display='none'

    })



// Funciones OK ------------------------------------------------------------------------------------------------------
	$("#moverfilaupvarios").click(function(){
		filas = prompt("Digile los ID de las filas a mover separado por coma\nEjemplo: 5,18,21")
		desti = prompt("Digire ID de fila destino para el traslado")
		if(confirm("CONFIRMACION REQUERIDA\n\nDesea mover las filas "+filas+" por encima del ID "+desti+" ahora?")) {
			$.ajax({
				type:"post",
				url :"ajax/moverfilamultiple.php",
				data: {
					ids     : filas,
					destino : desti,
					posicion: "UP"
				},
				success : function(data) {
					$("#refrescar").click();
				}
			})
		}
	})

	$("#moverfiladownvarios").click(function(){
		filas = prompt("Digile los ID de las filas a mover separado por coma\nEjemplo: 5,18,21")
		desti = prompt("Digire ID de fila destino para el traslado")
				if(confirm("CONFIRMACION REQUERIDA\n\nDesea mover las filas "+filas+" por encima del ID "+desti+" ahora?")) {
			$.ajax({
				type:"post",
				url :"ajax/moverfilamultiple.php",
				data: {
					ids     : filas,
					destino : desti,
					posicion: "DOWN"
				},
				success : function(data) {
					$("#refrescar").click();
				}
			})
		}
	})

	$("#moverfilaup").click(function(){
		refe = $("#referencia").val();
		if(refe=="#c") 
		    $("#bsleccionecelda").click();
		else {
			$.ajax({
				type:"post",
				url :"ajax/moverfila.php",
				data: {
					id        : refe,
					antesde   : prompt("DESTINO\nDigite ID de la Fila Destino","0"),
					posicion  : "UP"
				},
				success : function(data){
					if(data != "error") $("#refrescar").click();
						else
							alert("Cancelo la opeacion u Ocurrio un error, verifique de haber seleccionado\nuna celda y escrito un ID destino correcto")
				},
				error : function() {
					alert("ERROR\n\nNo pudo moverse la fila")
				}
			})
		}
	})

	$("#moverfiladown").click(function(){
		refe = $("#referencia").val();
		if(refe=="#c") 
		    $("#bsleccionecelda").click();
		else {
			$.ajax({
				type:"post",
				url :"ajax/moverfila.php",
				data: {
					id        : refe,
					antesde   : prompt("DESTINO\nDigite ID de la Fila Destino","0"),
					posicion  : "DOWN"
				},
				success : function(data){
					if(data != "error") $("#refrescar").click();
						else
							alert("Cancelo la opeacion u Ocurrio un error, verifique de haber seleccionado\nuna celda y escrito un ID destino correcto")
				},
				error : function() {
					alert("ERROR\n\nNo pudo moverse la fila")
				}
			})
		}
	})

	$("#enviarhist").click(function(){
		refe = $("#referencia").val();
		if(refe=="#c") 
		    $("#bsleccionecelda").click();
		else {
			$.ajax({
				type:"post",
				url :"ajax/cambiarestadobitacora.php",
				data: {
					id    : refe,
					estado: "H"
				},
				success : function(data){
					$("#refrescar").click();
				},
				error : function() {
					alert("ERROR\n\nNo pudo enviarse a historico")
				}
			})
		}
	})

	$("#enviaracti").click(function(){
		refe = $("#referencia").val();
		if(refe=="#c") 
		    $("#bsleccionecelda").click();
		else {
			$.ajax({
				type:"post",
				url :"ajax/cambiarestadobitacora.php",
				data: {
					id: refe,
					estado: "A"
				},
				success : function(data){
					$("#refrescar").click();
				},
				error : function() {
					alert("ERROR\n\nNo pudo enviarse a historico")
				}
			})
		}
	})

	function cambiarcolorcelda() {
			$.ajax({
				type:"post",
				url :"ajax/guardacelda.php",
				data: { 
					id      : $("#referencia").val(), 
					columna : $("#pcolu").val(),
					dato    : document.getElementById("info").rows[parseInt($("#pfila").val())].cells[parseInt($("#pcolu").val())].innerHTML, 
					colorcel: $("#colorcell").val() },
				success: function (data) {  },
				error:   function ()     { alert("No pudo guardarse..."); }

			})
	}

	//location.reload();

	$("#eliminafila").click(function(){
		refe = "#c".concat($("#referencia").val());
		if(refe=="#c") 
				alert("ERROR\n\nDebe seleccionar uan celda")
			else {
				if(confirm("ADVERTENCIA: Esta opcion no tiene deshacer, revise que sea la fila correcta antes de ejecutar\n\nesta seguro de querer eliminar esta fila?\n\nSi [ACEPTAR]\nNo [CANCELAR]")) {
						$.ajax({
							type    :"post",
							url     :"ajax/eliminarfila.php",
							data    : { id: $("#referencia").val() },
							success : function(data) { $("#refrescar").click(); },
							error   : function() { alert("ERROR\n\nNo se pudo eliminar la fila"); }
						})
				}
			}
		
	})

	$("#insarriba").click(function(){
		refe = "#c".concat($("#referencia").val());
		if(refe=="#c") 
				$("#bsleccionecelda").click()
			else {
				nf = parseInt(prompt("CONFIRME\n\nNumero de filas a insertar por encima?","0"));
				if(nf>0)
					$.ajax({
						type:"post",
						url :"ajax/insertarfila.php",
						data: {
							id: $("#referencia").val(),
							posicion: "ENCIMA",
							cantidad: nf
						},
						success : function(data) {
							$("#refrescar").click();
						}
					})
			}
	})

	$("#insabajo").click(function(){
		refe = "#c".concat($("#referencia").val());
		if(refe=="#c") 
				alert("ERROR\n\nDebe seleccionar uan celda")
			else {
				nf = prompt("CONFIRME\n\nNumero de filas a insertar por debajo?","0")
				if(nf>0)
					$.ajax({
						type:"post",
						url :"ajax/insertarfila.php",
						data: {
							id: $("#referencia").val(),
							posicion: "DEBAJO",
							cantidad: nf
						},
						success : function(data) {
							$("#refrescar").click();
						}
					})
			}
	})

	$("#quitarcolor").click(function() {
		refe = "#c".concat($("#referencia").val());
		$(refe).css("background-color","white");
		$("#esperacerrar").click();
	})

	function pintarcelda(colorcelda) {
		refe = "#c".concat($("#referencia").val());
		$(refe).css("background-color",colorcelda);
		$("#esperacerrar").click();
		//alert(refe)

	}
    
	function validar() {
		if(event.keyCode==13 || event.keyCode==10) {
			$.ajax({
				type:"post",
				url :"ajax/guardacelda.php",
				data: { 
					id      : $("#referencia").val(), 
					columna : $("#pcolu").val(),
					dato    : $("#vcelda").val()
				},
				success: function (data) { },
				error:   function ()     { alert("No pudo guardarse..."); }

			})
		}
	}


	function zeros(num,can) {
		n = num.toString().trim();
		valor = "0";
		for(c=1; c<(can-n.length); c++) { valor = valor.concat("0");  }
		return valor.concat(n);
	}
</script>