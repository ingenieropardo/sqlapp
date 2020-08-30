<style>
	 #listado {
	    width: 100%;
	    height: 550px;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    border-radius: 4px;
	}     

	#listado table td { background-color: white; }
	.seccion { 
		padding: 10px;
		background-color: #D3EBF5;
		border-radius: 8px;
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
	  <div class="col-md-3" style="">
	  	<div class="seccion" style="height: 640px">
	  		<div class="panel">DETALLE PETICION</div>
	  		<table>
	  			<tr><td style="width: 130px">Id Soporte</td><td> <input    id="cidsoporte" disabled type="text" name=""></td></tr>
	  			<tr><td>Fecha y Hora</td><td>                    <input    id="cfechehora" disabled type="text" name=""></td></tr>
	  			<tr><td>Usuario</td><td>                         <input    id="cusuario" disabled type="text" name=""></td></tr>
	  			<tr><td>Contacto</td><td>                        <input    id="ccontacto" disabled type="text" name=""></td></tr>
	  			<tr><td>Mensaje</td><td>                         <textarea id="cmensaje" disabled style="width: 250px; height: 100px"></textarea></td></tr>
	  			<tr><td>Telefono</td><td>                        <input    id="ctelefono" disabled type="text" name=""></td></tr>
	  			<tr><td>Correo Electronico</td><td>              <input    id="ccorreo" disabled type="text" name=""></td></tr>	  			
	  		</table><br>
	  		<div class="panel">RESPUESTA SOLICITUD</div>
	  		<table>
	  			<tr>
	  				<td style="width: 130px">Estado</td><td>
		  				<select id="cestado">
		  					<option value="A">ABIERTO</option>		
		  					<option value="C">CERRADO</option>
		  				</select>
		  			</td>
	  			</tr>
	  			<tr><td>Observacion</td><td> <textarea id="crespuesta" style="width: 250px; height: 100px"></textarea></td></tr>
	  			<tr><td></td>
	  				<td>
	  					<button id="cerrarsoporte" class="btn btn-warning"><span class="fa fa-check"></span> Cerrar Soporte</button>
	  				</td></tr>
	  		</table>
	  	</div>
	  </div>
	  <div class="col-md-9" style="">
	  	<div class="seccion">
	  		<div class="panel">LISTADO DE SOPORTES TECNICOS</div>
	  		Ordenar por <select>
	  						<option value="FECHA">FECHA Y HORA</option>
	  						<option value="USUARIO">USUARIO</option>
	  					</select>
	  					&nbsp; &nbsp; &nbsp; 
	  					Mostrar
		  				<select id='pestado'>
		  					<option value="TODOS">TODOS LOS SOPORTES</option>		
		  					<option value="A">ABIERTO</option>		
		  					<option value="C">CERRADO</option>
		  				</select>
	  		<div id="listado"></div>
	  	</div>
	  </div>
	</div>
</div>

<script type="text/javascript">
	verListado();

	$("#listado table tr").click(function(){
		alert("clic")
	})

	$("#cerrarsoporte").click(function(){
		if(confirm("Seguro de cerrar este soporte ahora?\n\nSI - Presione ACEPTAR\nNO - Presione CANCELAR")) {
			$("#cestado").val("C");
			$.ajax({
				url: "ajax/cerrarsoporte.php",
				type: "post",
				data: { 
					id  : $("#cidsoporte").val(),
					resp: $("#crespuesta").val(),
					correo: $("#ccorreo").val(),
					contacto: $("#ccontacto").val(),
					peticion: $("#cmensaje").val()
				},
				success : function(data) {
					verListado();
					alert(data)
					$("#cidsoporte").val("");
					$("#cfechehora").val("");
					$("#cusuario").val("");
					$("#ccontacto").val("");
					$("#cmensaje").val("");
					$("#ctelefono").val("");
					$("#ccorreo").val("");
					$("#crespuesta").val("");

				}
			})
		}
	})

	function vereste(pid) {
		$.ajax({
			type:"post",
			url :"ajax/listasoportes.php",
			data: {
				estado : $("#pestado").val(),
				id     : pid,
				modo   : "Sql"
			},
			success : function (data) {
				datos = [];
				datos = data.split(";");
				$("#cidsoporte").val(datos[0]);
				$("#cfechehora").val(datos[1]);
				$("#cusuario").val(datos[2]);
				$("#ccontacto").val(datos[3]);
				$("#cmensaje").val(datos[4]);
				$("#ccorreo").val(datos[5]);
				$("#ctelefono").val(datos[6]);
				$("#crespuesta").val(datos[7]);
				$("#cestado").val(datos[8]);

				if($("#cestado").val()=="C") $("#cerrarsoporte").attr("disabled",true); else $("#cerrarsoporte").attr("disabled",false);
			},
			error : function () {
				alert("Hubo un error al generar el listado");
			}
		});
	}

	$("#pestado").change(function(){ verListado(); })

	function verListado(pid=0, PMODO="Tabla") {
		$.ajax({
			type:"post",
			url :"ajax/listasoportes.php",
			data: {
				estado : $("#pestado").val(),
				id     : pid,
				modo   : PMODO
			},
			success : function (data) {
				$("#listado").html("<table class='table table-condensed table-bordered'><tr><th>Id</th><th>Fecha y Hora</th><th>Usuario</th><th>Contacto</th><th>Peticion de Soporte</th><th>Correo</th><th>Telefono</th><th>Respuesta</th><th></th></tr>"+data+"</table>")
			},
			error : function () {
				alert("Hubo un error al generar el listado");
			}
		});
	}
</script>