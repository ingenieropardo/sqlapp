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
	#diarios {
		width: 100%;
	    height: 370px;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 0px;
	    
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
	i fa fa-chevron-right{
		color: orange;
	}
	td, centro {
		text-align: center;
	}
</style>

<div class="contened">
	<div class="row">
		<div class="col-md-1" style="width: 50px">
		</div>
		<div class="col-md-4">
			<font style="font-weight: bold; font-size: 12px; color: #DCA53A"><i class="fa fa-chevron-right"></i> INFORMACION DETALLADA DE SITUACION</font> <br>
			<label for="">Año</label> 
			<select name="" id="danno">
				<option value="0">Seleccione...</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select> 
			<label for="">Id/Numero</label> 
			<input type="text" style="text-align: center;" class="m0" disabled id="xiddiario">
			<input type="text" style="text-align: center;" class="m0" disabled id="xnumero">
			<br>
			<label for="">Fecha Redaccion</label><input id="xfechar" type="date" value="<?php echo fechaactual(0); ?>" disabled><br>
			<label for="">Fecha Situacion</label><input id="xfecha" type="date" value="<?php echo fechaactual(0); ?>"><br>
			<label for="">Docente</label>
		  	<select name="" id="ddocente">
		  		<option value="-1">Seleccione...</option>
		  		<?php echo ListaUsuarios(); ?>
		  	</select> <br>
			<label for="">Grupo</label>
		  	 <select name="" id="dgrupo">
		  	 	<option value="0">Seleccione...</option>
		  	 	<?php
		  	 		echo ListaGrupos();
		  	 	?>
		  	 </select> <br>
		  	 <label for="">Filtrar Estudiantes</label> <input type="text" placeholder="Nombres y/o Apellidos">
		  	 <button class="btn btn-xs btn-success" id="filtrardiario"><i class="fa fa-search"></i> Filtrar</button>  

		</div>
		<div class="col-md-3" style="width: 400px">
			<font style="font-weight: bold; font-size: 12px; color: #DCA53A"><i class="fa fa-chevron-right"></i> ALUMNOS PARTICIPANTES</font> <br>
			<div id="divalumnos">
				<select name="" id="listaparticipantes" style="width: 320px">
					<option value='0'>Seleccione...</option>
				</select> 
			<button class='btn btn-xs btn-success' onclick='agregaralumno()'><i class='fa fa-plus'></i></button>
			</div>
			<font style="font-size: 11px; color: red">Doble click remueve un alumno de la lista</font> <br>
			<select name="" id="participantes" size="7" style="width: 350px; height: 110px"></select>		
		</div>
		<div class="col-md-4">
			<font style="font-weight: bold; font-size: 12px; color: #DCA53A"><i class="fa fa-chevron-right"></i> SITUACION PRESENTADA (Max 200 letras)</font> <br>
			<input type="checkbox" checked id="xtodo">
			<font style="font-size: 12px; color: red">Modificar situacion para todos los estudiantes relacionados</font>
			<textarea name="" id="xsituacion" style ="width: 100%; height: 80px; margin-bottom: 10px"></textarea>	<br>
		  	 <button class="btn btn-warning" id="nuevodiario"><i class="fa fa-plus"></i> Nuevo</button>  
		  	 <button class="btn btn-warning" id="guardardiario"><i class="fa fa-save"></i> Guardar</button>  
		  	 <button class="btn btn-danger" id="eliminardiario"><i class="fa fa-trash-o"></i> Eliminar</button>  
		  	 <button onch class="btn btn-success" id="imprimirdiario"><i class="fa fa-print"></i> Imprimir</button>  
			 
		</div>

	</div>
	<div id="diarios"></div>
</div>

<script>
		mostrardiarios();

		function verdiario(id,num) {
			$("#participantes").empty();
			$("#xiddiario").val(id);
			$("#xnumero").val(num);
			$.ajax({
				type: "post",
				url: "ajax/listadiarios.php",
				data: { 
					iddiario  : 0,
					condicion: " AND diarios.numero="+num,
					ordena   : "diarios.numero DESC, diarios.fecha, diarios.fk_idgrupo"
				},
				success : function (data) {
					dato = data.split(";");
					$("#xfechar").val(dato[3]);
					$("#xfecha").val(dato[2]);
					$("#ddocente").val(dato[5]);
					$("#dgrupo").val(dato[4]);
					$("#xsituacion").val(dato[7]);
					$("#danno").val($("#dgrupo option:selected").text().substr(0,4));
					$("#dgrupo").change();
					n = 42;
					canti = (datos.length-1)/n;
					for(p=0; p<canti; p++) {
						codigo = dato[p*n+6];
						if(codigo==null) break;
						nombre = dato[p*n+17]+ " "+dato[p*n+18];
						$("#participantes").append("<option value='"+codigo+"'>"+nombre+"</option>");
					}

				}
			});

		}

		$("#nuevodiario").click(function(){
			$("#danno").val("0");
			$("#xfecha").val("<?php echo fechaactual(0); ?>");
			$("#ddocente").val("-1");
			$("#dgrupo").val("0");
			$("#participantes").empty();
			$("#listaparticipantes").val("0");
			$("#xiddiario").val("");
			$("#xnumero").val("");
			$("#xsituacion").val("");
			$("#danno").focus();
		});

		$("#guardardiario").click(function(){
			datoscompletos = true;
			if($("#ddocente").val()=="-1") datoscompletos = false;
			if($("#dgrupo").val()=="0") datoscompletos = false;
			xidalumno = ""; numalu = 0;
			$("#participantes option").each(function(){
			   xidalumno = xidalumno + ($(this).val()) + ",";
			   numalu++;
			});
			xidalumno = xidalumno.substr(0,xidalumno.length-1);
			if(numalu==0) datoscompletos = false;

			if(!datoscompletos) alert("FALTAN DATOS\nTodos los datos son obligatorios, por favor verifique");
				else
					if(confirm("CONFIRMACION REQUERIDA\nDesea registrar esta situacion ahora?")) {
						$.ajax({
							type:"post",
							url :"ajax/guardadiario.php",
							data: {
								todo           : $("#xtodo").is(":checked")?"todo":"solo",
								iddiario       : $("#xiddiario").val(),
								numero         : $("#xnumero").val(),
								fecha          : $("#xfecha").val(),
								fecharedaccion : $("#xfechar").val(),
								fk_idgrupo     : $("#dgrupo").val(),
								fk_idusuario   : $("#ddocente").val(),
								alumnos        : xidalumno,
								situacion      : $("#xsituacion").val()
							},
							success : function (data) {
								alert(data);
								mostrardiarios();
							}
						});
					}
		});

		function agregaralumno() {
			nombre = $("#dalumnos option:selected").text();
			codigo = $("#dalumnos").val();
			$("#participantes").append("<option value='"+codigo+"'>"+nombre+"</option>");
		}

		$("#participantes").dblclick(function(){
			codigo = this.value;
			$("#participantes option[value='"+codigo+"']").remove();
		});

		$("#dgrupo").change(function(){
			idgrupo = $("#dgrupo").val();
			anno = $("#danno").val();
			llenaralumnos("grupos.anno="+anno+" AND grupos.idgrupo="+idgrupo,"alumnos.apealumno, alumnos.nomalumno");
		}) ;

		function llenaralumnos(condicion="", ordenapor="") {
			$.ajax({
				type:"post",
				url :"ajax/llenaralumnos.php",
				data: { 
					criterio : condicion,
					ordena   : ordenapor
				},
				success : function (data) {
					datos = data.split(";");
					n = 28;
					canti = (datos.length-1)/n;
					cuerpo = "<option value='0'>Seleccione...</option>";
					for(p=0; p<canti; p++) {
						cuerpo = cuerpo + "<option value="+datos[p*n+1]+">"+datos[p*n+3]+" "+datos[p*n+4]+"</option>";
					}
					cuerpo = "<select id='dalumnos' style='width:320px'>"+cuerpo+"</select> <button class='btn btn-xs btn-success' onclick='agregaralumno()'><i class='fa fa-plus'></i></button>";
					$("#divalumnos").html(cuerpo);		
					
				}
			});
		}

		function mostrardiarios(iddia=0,condi="") {
		$.ajax({
			type: "post",
			url: "ajax/listadiarios.php",
			data: { 
				iddiario  : iddia,
				condicion: condi,
				ordena   : "diarios.numero DESC, diarios.fecha, diarios.fk_idgrupo"
			},
			success : function (data) {
				//alert(data)
				datos = data.split(";");
				n = 42;
				
				canti = (datos.length-1)/n;
				
				encabezado = "<table class='table table-condensed table-bordered table-striped'>";
		 		titulos = "<table class='table table-condensed'><th>Accion</th><th>Id.</th><th>No. Diario</th><th>Grupo<br><i class='fa fa-2x fa-arrow-circle-o-down'></i></th><th>Fecha Situacion<br><i class='fa fa-2x fa-arrow-circle-o-down'></i></th><th>Fecha Redaccion<br><i class='fa fa-2x fa-arrow-circle-o-down'></i></th><th>Apellidos y Nombres<br><i class='fa fa-2x fa-arrow-circle-o-down'></i></th><th>Docente<br><i class='fa fa-2x fa-arrow-circle-o-down'></i></th><th>Situacion Presentada</th>";
		 	    cuerpo = "";
		 	    pie = "</table>";
		 	    cont = 0;
				for(p=0; p<canti; p++) {

					cuerpo = cuerpo + "<tr><td><button class='btn btn-xs btn-success' onclick='verdiario("+datos[p*n]+","+datos[p*n+1]+")'> Ver</button> <button class='btn btn-xs btn-danger' onclick='eliminacarga("+datos[p*n]+")'><i class='fa fa-trash-o'></i>  Eliminar</button></td><td>"+datos[p*n]+"</td><td>"+datos[p*n+1]+"</td><td>"+datos[p*n+9]+"</td><td>"+datos[p*n+2]+"</td><td>"+datos[p*n+3]+"</td><td>"+datos[p*n+17]+" "+datos[p*n+18]+"</td><td>"+datos[p*n+35]+" "+datos[p*n+36]+"</td><td>"+datos[p*n+7]+"</td><tr>";
				}
				tabla = encabezado + titulos + cuerpo + pie;
				$("#diarios").html(tabla);
			}
		});
	}

</script>