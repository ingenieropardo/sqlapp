<style>
  .btn {
  	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 4px 10px 0 rgba(0, 0, 0, 0.19);
  	border-radius: 10px;
  }
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
	#todaslascargas {
		width: 750px;
	    height: 520px;
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
		<div class="col-md-1">
		</div>
		<div class="col-md-4">
			<font style="font-weight: bold; font-size: 12px; color: #DCA53A"><i class="fa fa-chevron-right"></i> INFORMACION DE CARGA ACADEMICA</font> <br>
			<label for="">Año</label> 
			<select name="" id="canno">
				<option value="0">Seleccione...</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select> 
			<input type="text" id="cidcarga" style="display: none">
			<br>
			<label for="">Docente</label>
		  	<select name="" id="cdocente">
		  		<option value="-1">Seleccione...</option>
		  		<?php echo ListaUsuarios(); ?>
		  	</select> <br>
			<label for="">Grupo</label>
		  	 <select name="" id="cgrupo">
		  	 	<option value="0">Seleccione...</option>
		  	 	<?php
		  	 		echo ListaGrupos();
		  	 	?>
		  	 </select> <br>
			<label for="">Asignatura</label>
		  	 <select name="" id="casignatura">
		  	 	<option value="0">Seleccione...</option>
		  	 	<?php
		  	 		echo ListaAsignaturas();
		  	 	?>
		  	 </select> <br><br>
		  	 <label for=""></label>
		  	 <button class="btn btn-warning" id="nuevacarga"><i class="fa fa-plus"></i> Nuevo</button>  
		  	 <button class="btn btn-warning" id="guardarcarga"><i class="fa fa-save"></i> Guardar</button>  
		  	 <button class="btn btn-success" id="filtrarcarga"><i class="fa fa-search"></i> Filtrar</button>  
		  	 <button class="btn btn-success" id="imprimircargas"><i class="fa fa-print"></i> Imprimir</button>  
		</div>
		<div class="col-md-6" id="todaslascargas">
			<table class='table table-condensed'>
				<th>Accion</th>
				<th>Año</th>
				<th>Docente</th>
				<th>Grupo</th>
				<th>Asignatura</th>
			</table>
		</div>
	</div>

</div>


<script>
	mostrarcargas();

	$("#filtrarcarga").click(function(){
		condicion = "";
		condicion1 = ""; condicion2 = ""; condicion3 = ""; condicion4 = "";
		if($("#canno").val()!="0")	{  
			condicion1 = " AND cargas.anno="+$("#canno").val();
		}
		if($("#cdocente").val()!="-1")	{  
			condicion2 = " AND cargas.fk_idusuario="+$("#cdocente").val();
		}
		if($("#cgrupo").val()!="0")	{  
			condicion3 = " AND cargas.fk_idgrupo="+$("#cgrupo").val();
		}
		if($("#casignatura").val()!="0")	{  
			condicion4 = " AND cargas.fk_idasignatura="+$("#casignatura").val();
		}

		condicion =  condicion1 + condicion2 + condicion3 + condicion4;
		mostrarcargas(0,condicion);

	});

	function mostrarcargas(idcar=0,condi="") {
		$.ajax({
			type: "post",
			url: "ajax/listacargas.php",
			data: { 
				idcarga  : idcar,
				condicion: condi,
				ordena   : "usuario.apellidos, usuario.nombres, grupos.idgrupo"
			},
			success : function (data) {

				datos = data.split(";");
				n = 24;
				
				canti = (datos.length-1)/n;
				
				encabezado = "<table class='table table-condensed table-bordered table-striped'>";
		 		titulos = "<tr><th>Accion</th><th>Año</th><th>Docente</th><th>Grupo</th><th>Asignatura</th></tr>";
		 	    cuerpo = "";
		 	    pie = "</table>";
				for(p=0; p<canti; p++) {
					cuerpo = cuerpo + "<tr><td><button class='btn btn-xs btn-success' onclick='vercarga("+datos[p*n]+")'> Ver</button> <button class='btn btn-xs btn-danger' onclick='eliminacarga("+datos[p*n]+")'><i class='fa fa-trash-o'></i>  Eliminar</button></td><td>"+datos[p*n+1]+"</td><td>"+datos[p*n+18]+" "+datos[p*n+17]+"</td><td>"+datos[p*n+9]+"</td><td>"+datos[p*n+6]+"</td><tr>";
				}
				tabla = encabezado + titulos + cuerpo + pie;
				$("#todaslascargas").html(tabla);
				
			}
		});
	}

	function vercarga(idcar, condi="") {
		$.ajax({
			type: "post",
			url: "ajax/listacargas.php",
			data: { 
				idcarga  : idcar,
				condicion: condi,
				ordena   : "grupos.anno DESC, usuario.apellidos, usuario.nombres, grupos.idgrupo"
			},
			success : function (data) {
				datos = data.split(";");
				$("#cidcarga").val(datos[0]);
				$("#canno").val(datos[1]);
				$("#cdocente").val(datos[2]);
				$("#cgrupo").val(datos[3]);
				$("#casignatura").val(datos[4]);
			}
		});
	}

	$("#nuevacarga").click(function(){
		$("#cidcarga").val("");
		$("#canno").val("0");
		$("#cdocente").val("-1");
		$("#cgrupo").val("0");
		$("#casignatura").val("0");
		$("#canno").focus();
	});

	$("#guardarcarga").click(function(){
		faltandatos = false;
		if($("#canno").val()=="0" || $("#cdocente").val()=="-1")
			faltandatos = true;
		if(faltandatos) alert("FALTAN DATOS\nTodos los campos son obligatorios, por favor revise");
		else
		{
			$.ajax({
				type:"post",
				url :"ajax/guardacarga.php",
				data: {
					idcarga        : $("#cidcarga").val(),
					anno           : $("#canno").val(),
					fk_idusuario   : $("#cdocente").val(),
					fk_idgrupo     : $("#cgrupo").val(),
					fk_idasignatura: $("#casignatura").val()
				},
				success : function (data) {
					mostrarcargas();
					alert(data);
				}
			});
		}
	});

</script>