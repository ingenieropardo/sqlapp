<style>
  .layo {
        padding: 5px;
        border-style: solid;
        border-width: 2px;
        border-color: white;
      }
  	label {
		font-size: 11px;
		width: 100px;
		text-align: right;
	}
	#divgru {
	    width: 100%;
	    height: 500px;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    
	    border-radius: 4px;
	 } 
	 	table {
		font-size: 12px;
	}
		h5 {
		font-weight: bold;
		color: #BA8300;
	}
	td:hover {
		background: #FFF3D8;
		color: #A02424
	}
	select {
		font-size: 12px;
	}
</style>
<div class="contened">
	<div class="row">
	  <div class="col-md-3">
			<input type="text" id="idgrupo" style="display: none">
		  	<label for="">Nombre Grupo</label><input id="nomgrupo" type="text" class="m0" autofocus> <br>
		  	<label for="">Nivel</label>
		  	<select name="" id="nivel">
		  		<option value="">Seleccione...</option>
		  		<option value="PRIMARIA">PRIMARIA</option>
		  		<option value="BACHILLERATO">BACHILLERATO</option>
		  	</select>		
		  	<br>
		  	<label for="">Grado Escolar</label>
		  	<select name="" id="grado">
		  		<option value="0">Seleccione...</option>
		  		<option value="1">1</option>
		  		<option value="2">2</option>
		  		<option value="3">3</option>
		  		<option value="4">4</option>
		  		<option value="5">5</option>
		  		<option value="6">6</option>
		  		<option value="7">7</option>
		  		<option value="8">8</option>
		  		<option value="9">9</option>
		  		<option value="10">10</option>
		  		<option value="11">11</option>
		  	</select>	<br>	
		  	<label for="">Año Lectivo</label>
		  	<select name="" id="anno">
		  		<option value="0">Seleccione...</option>
		  		<option value="2018">2018</option>
		  		<option value="2019">2019</option>
		  		<option value="2020">2020</option>
		  	</select>
		  	<br>
		  	<label for=""></label>
		  	<input type="checkbox">
		  	<font style="color:red; font-size: 10px ">No mostrar directores de grupos ya asignados en la lista </font>
		  	<br>
		  	<label for="">Director de Grupo</label>
		  	<select name="" id="dirgrupo">
		  		<option value="-1">Seleccione...</option>
		  		<?php echo ListaUsuarios(); ?>
		  	</select>
	  </div>
  	  <div class="col-md-9">
  	  	<label for="">Filtrar por</label>
  	  	<select name="" id="filtroanno">
  	  			<option value="0">TODOS LOS AÑOS</option>
		  		<option value="2018">2018</option>
		  		<option value="2019">2019</option>
		  		<option value="2020">2020</option>
  	  	</select>
	  	<select name="" id="filtronivel">
	  		<option value="0">TODOS LOS NIVELES</option>
	  		<option value="PRIMARIA">PRIMARIA</option>
	  		<option value="BACHILLERATO">BACHILLERATO</option>
	  	</select>
  	  	<div id="divgru"></div>
  	  	 <br>
  	  	 	<button class="btn btn-info refre" id="Refrescar"><span class="glyphicon glyphicon-refresh"></span></button>
			<button class="btn btn-warning" id="nuevogrupo"><span class="glyphicon glyphicon-plus"></span>Nuevo Grupo</button>
			<button class="btn btn-inverse" id="guardargrupo"><span class="glyphicon glyphicon-floppy-disk"></span>Guardar</button>
			<button class="btn btn-inverse" id="imprimirgrupo"><span class="glyphicon glyphicon-print"></span>Listado de Grupos Filtrado</button>

	  </div>
	</div>
</div>

<script>

	$("#Refrescar").click(function(){ mostrargrupo(); });

	$("#nuevogrupo").click(function(){
		$("#idgrupo").val("");
		$("#nomgrupo").val("");
		$("#nivel").val("");
		$("#grado").val("0");
		$("#anno").val("0");
		$("#dirgrupo").val("-1");
		$("#nomgrupo").focus();
	});

	$("#filtroanno").click(function() { mostrargrupo(); });
	$("#filtronivel").click(function(){ mostrargrupo(); });

	$("#guardargrupo").click(function(){
		if($("#nomgrupo").val()=="" || $("#nivel").val()=="" || $("#grado").val()=="" || $("#anno").val()=="0" || $("#dirgrupo").val()=="-1")
			alert("FALTAN CAMPOS\n\nTodos los campos son obligatorios, por favor verifique")
		else {
			if(confirm("CONFIRMACION REQUERIDA\n\nSeguro de guardar estos datos?")) {
				$.ajax({
					type:"post",
					url :"ajax/guardagrupo.php",
					data: {
						idgrupo  : $("#idgrupo").val(),
						nomgrupo : $("#nomgrupo").val(),
						nivel    : $("#nivel").val(),
						grado    : $("#grado").val(),
						anno     : $("#anno").val(),
						dirgrupo : $("#dirgrupo").val()
					},
					success : function (data) {
						$("#nuevogrupo").click();
						mostrargrupo();
						alert(data);
					}
				});
			}
		}
	});

	function vergrupo(idgru) {
		$.ajax({
			type: "post",
			url: "ajax/listagrupos.php",
			data: { 
				idgrupo: idgru,
				fanno : $("#filtroanno").val(),
				fnivel: $("#filtronivel").val()
			},
			success : function (data) {
				datos = data.split(";");
				n = 16;
				canti = (datos.length-1)/n;
				if(canti==1) {
					$("#idgrupo").val(datos[0]);
					$("#nomgrupo").val(datos[1]);
					$("#nivel").val(datos[2]);
					$("#grado").val(datos[3]);
					$("#anno").val(datos[4]);
					$("#dirgrupo").val(datos[5]);
				}
			}
		})	
	}

	function mostrargrupo(idgr=0) {
		$.ajax({
			type: "post",
			url: "ajax/listagrupos.php",
			data: { 
				idgrupo: idgr,
				fanno : $("#filtroanno").val(),
				fnivel: $("#filtronivel").val()
			},
			success : function (data) {
				datos = data.split(";");
				n = 16;
				
				canti = (datos.length-1)/n
				encabezado = "<table class='table table-condensed table-bordered table-striped'>";
		 		titulos = "<tr><th>Accion</th><th>Año</th><th>Nivel</th><th>Grupo</th><th>Director de Grupo</th><th>Correo Electronico</th><th>Telefono</th></tr>";
		 	    cuerpo = "";
		 	    pie = "</table>";
				for(p=0; p<canti; p++) {
					
					if(datos[p*n+12]=="") correo = "";
					else correo = "<a class='' href='mailto:"+datos[p*n+12]+"'> Enviar Correo</a >";
					cuerpo = cuerpo + "<tr><td><button class='btn btn-xs btn-warning' onclick='vergrupo("+datos[p*n]+")'><span class='glyphicon glyphicon-save'></span>Ver</button></td><td>"+datos[p*n+4]+"</td><td>"+datos[p*n+2]+"</td><td>"+datos[p*n+1]+"</td><td>"+datos[p*n+9]+" "+datos[p*n+10]+"</td><td>"+datos[p*n+12]+correo+"</td><td>"+datos[p*n+11]+"</td><tr>";
				}
				tabla = encabezado + titulos + cuerpo + pie;
				$("#divgru").html(tabla);
				
			}
		});
	}

	mostrargrupo();

</script>