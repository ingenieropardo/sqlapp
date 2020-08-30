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
	#u1 {
	    width: 100%;
	    height: 450px;
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
	</div>
	  <div class="col-md-5">
	  		<h5>INFORMACION DE ASIGNATURA</h5>
		  	<label for="">Abreviatura</label><input id="abreviatura" type="text" class="ttexto" autofocus> 
			<input type="text" id="idasignatura" style="display: none">
		  	<br>
		  	<label for="">Descripcion</label><input id="descripcion" type="text" class="t100" autofocus> 
		  	<br>
		  	<label for=""></label>
			<button class="btn btn-warning" id="nuevaasignatura"><span class="glyphicon glyphicon-plus"></span>Nueva Asignatura</button>
			<button class="btn btn-inverse" id="guardarasignatura"><span class="glyphicon glyphicon-floppy-disk"></span>Guardar</button>
			<button class="btn btn-inverse" id="imprimir"><span class="glyphicon glyphicon-print"></span>Imprimir Listado</button>
		  	<div id="u1">
	  	  	 </div>
	  </div>
  	  
	</div>
</div>

<script>
	$("#nuevaasignatura").click(function(){
		$("#idasignatura").val("");
		$("#abreviatura").val("");
		$("#descripcion").val("");
		$("#abreviatura").focus();
	});

	$("#guardarasignatura").click(function(){
		$.ajax({
			type: "post",
			url: "ajax/guardaasignatura.php",
			data: { 
				idasignatura : $("#idasignatura").val(),
				abreviatura  : $("#abreviatura").val(),
				descripcion  : $("#descripcion").val()
			},
			success : function(data) {
				$("#nuevaasignatura").click();
				mostrar();
				alert(data);
			}
		});
	});

	function verasignatura(idasig) {
		$.ajax({
			type: "post",
			url: "ajax/listaasignaturas.php",
			data: { 
				idasignatura : idasig
			},
			success : function (data) {
				datos = data.split(";");
				n = 3;
				canti = (datos.length-1)/n;
				if(canti==1) {
					$("#idasignatura").val(datos[0]);
					$("#abreviatura").val(datos[2]);
					$("#descripcion").val(datos[1]);
				}
			}
		});		
	}

	function mostrar(idasig=0) {
		$.ajax({
			type: "post",
			url: "ajax/listaasignaturas.php",
			data: { 
				idasignatura : idasig
			},
			success : function (data) {
				datos = data.split(";");
				n = 3;
				canti = (datos.length-1)/n
				encabezado = "<table class='table table-condensed table-bordered table-striped'>";
		 		titulos = "<tr><th>Accion</th><th>Abreviatura</th><th>Descripcion de Asignatura</th></tr>";
		 	    cuerpo = "";
		 	    pie = "</table>";
				for(p=0; p<canti; p++) {
					cuerpo = cuerpo + "<tr><td><button class='btn btn-xs btn-warning' onclick='verasignatura("+datos[p*n]+")'><span class='glyphicon glyphicon-save'></span>Ver</button></td><td>"+datos[p*n+2]+"</td><td>"+datos[p*n+1]+"</td><tr>";
				}
				tabla = encabezado + titulos + cuerpo + pie;
				$("#u1").html(tabla);
			}
		});
	}

	mostrar();
</script>