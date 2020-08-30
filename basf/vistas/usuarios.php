<style>
  	.bt {
    	border-radius: 15px;
    	width: 55px;
    }
    .fa:hover {
    	cursor: pointer;
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
		color: black;
	}
	#divusu {
	    width: 100%;
	    height: 470px;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    border-radius: 4px;
	 } 
	#divpar {
	    width: 100%;
	    height: 525px;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    border-radius: 4px;
	 } 
	 	table {
		font-size: 14px;
	}
		h5 {
		font-weight: bold;
		color: #BA8300;
	}
	select {
		font-size: 12px;
	}
    .b1 { width: 100px; }
    hr { padding: 0px; }
	.panel {
		text-align: center; font-size: 12px; background-color: #A1D0E1; color: black;
	}

	hr.style5 {
      border-top: 1px solid #8c8b8b;
    border-bottom: 1px solid #fff;
    margin: 2px;
    padding: 2px;
}

</style>
<div class="vistapc" style="margin-top: -10px; color: black; font-size: 14px;">
	<!-- VISTA PARA COMPUTADOR -->
<div class="contened" style="color: black;">
	<div class="row">
	  <div class="col-md-3">
	  		<div class="seccion">
	  			<div class="panel">INFORMACION</div>
			<table>
				<tr><td>Usuario</td><td>
					<input id="iusuario" type="text" class="" autofocus>
				</td></tr>
				<tr><td>Nombre</td><td><input id="inombre" type="text" class="t1"></td></tr>
				<tr><td>Cargo</td><td><input id="icargo" type="text" class="t1"></td></tr>
				<tr><td>Telefonos</td><td><input id="itelefono" type="text" class="t1"></td></tr>
				<tr><td>Correo Electronico</td><td><input id="icorreo" type="text" class="t1"></td></tr>
				<tr><td>Rol</td><td>&nbsp; 
					 <select name="" id="irol">
				  		<option value="0">Seleccione...</option>
				  		<option value="ROOT">ROOT</option>
				  		<option value="CLIENTE">CLIENTE</option>
				  		<option value="EJECUTIVO1">EJECUTIVO1</option>
				  		<option value="EJECUTIVO2">EJECUTIVO2</option>
				  		<option value="OPERATIVO1">OPERATIVO1</option>
				  		<option value="OPERATIVO2">OPERATIVO2</option>
				  	</select>
				  	<select name="" id="iestado">
				  		<option value="0">Seleccione...</option>
				  		<option value="A">ACTIVO</option>
				  		<option value="X">BLOQUEDADO</option>
				  	</select>		
				</td></tr>
			</table>
			<br>
			<center>
				<button class="btn btn-warning m10" id="nuevousuario"><span class="glyphicon glyphicon-plus"></span></button>
				<button class="btn btn-primary" id="guardarusuario"><span class="glyphicon glyphicon-floppy-disk"></span>Guardar</button>
			</center>
	  </div>
	</div>
  	  <div class="col-md-7">
	  	<div class="seccion">
		  <div class="panel">LISTADO DE USUARIOS</div>
	  		  	Mostrar
		  	  	<select name="" id="roles">
		  	  			<option value="0">TODOS LOS ROLES...</option>
				  		<option value="ROOT">ROOT</option>
				  		<option value="CLIENTE">CLIENTE</option>
				  		<option value="EJECUTIVO1">EJECUTIVO1</option>
				  		<option value="EJECUTIVO2">EJECUTIVO2</option>
				  		<option value="OPERATIVO1">OPERATIVO1</option>
				  		<option value="OPERATIVO2">OPERATIVO2</option>
		  	  	</select>
		  	  	Buscar por:
				<input type="text" autofocus id="buscarpor" placeholder="usuario, logueo, nombre (separe con %)" style="width: 280px;">
				<button class="btn btn-primary" id="buscarahora"><span class="glyphicon glyphicon-search"></span>Filtrar Usuarios</button>
			  	<div id="divusu">
			  		<table class='table table-condensed table-bordered table-striped'>
						<tr><th>Usuario</th><th>Nombre</th><th>Clave</th><th>Rol</th><th>Estado</th></tr>
			  		</table>
			  	</div><br>
			  	<font style="font-weight: bold;">
				<!--
			  	<input type="radio" onchange="verParametros()" onclick="verParametros()" id="rtodos" checked name="filtropar" value="TODOS"> &nbsp;Ver todos &nbsp; &nbsp; &nbsp;
			  	<input type="radio" onchange="verParametros()"  onclick="verParametros()" id="rusuario" name="filtropar" value="USUARIO"> &nbsp;Ver por Usuario &nbsp; &nbsp; &nbsp;
			  	<input type="radio" onchange="verParametros()"  onclick="verParametros()" id="rrol" name="filtropar" value="ROL"> &nbsp;Ver por Rol &nbsp; &nbsp; &nbsp;
			  	<button class="btn btn-primary"><span class="fa fa-refresh"></span>&nbsp; &nbsp;Actualizar</button>
			  	<button class='btn btn-warning' id='aplicaratodos' style='display: none'>Aplicar a Todos los Usuarios</button>
				-->
			  	</font>
			</div>
	  </div>
	  <div class="col-md-2">
	  	<div class="seccion">
	  	<div class="panel">EDITABLES</div>
		  <div id="divpar"></div>
		</div>
	  </div>
	</div>
</div>
</div> <!-- FIN VISTA PC -->

<div class="vistamv" style="color: black">
	Parametrizacion de Usuarios <br>
	VISTA MOVIL EN DESARROLLO !...
</div> <!-- Fin div Vista Movil-->


  <!-- .......................... FALTAN DATOS ............................... -->
  <button style="display: none;" type="button" id="fd" class="btn btn-success bex" data-toggle="modal" data-target="#faltndatos">Boton</button>
  <div class="modal fade" id="faltndatos" role="dialog" style="margin-top: 200px; color: black">
    <div class="modal-dialog">
      <div class="modal-content">
      	<center>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <span class="fa fa-warning fa-4x" style="color: orange"></span>
          <h4 class="modal-title">Informacion Obligatorio</h4>
       
        </div>
        <div class="modal-body">
          <b>FaltanDatos! </b>	el usuario, nombre, rol y estado son obligatorios, por favor revise e intente de nuevo
        </div>   
        <div class="modal-footer">
          	<button type="button" id="seleccionarep" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        	<button style="display: none" type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        </div>     
        </center>
      </div>
      
    </div>
  </div>

   
<style>
	.gris {
		background: #F8FAFA;
	}
</style>
<script>
	verUsuarios();
	
 
    $("#aplicaratodos").click(function(){
    	if(confirm("ATENCION\n\nEsta opcion asocia los reportes a los usuarios\nsegun el rol que tengan, cualquier parametrizacion\nprevia sera borrada\n\nSeguro de aplicar a todos los usuarios ahora?")) {

    	}
    })

    $("#asignareportesrol").click(function(){
		if($("#idusuario").val()=="")
			alert("Debe seleccionar un usuario o crear uno");
		else {
	    	if(confirm("CONFIRMACION\n\nDesea asigar los reportes del rol "+$("#fk_idrol").val()+" a este usuario?")) {
	    		$.ajax({
	    			type:"post"	,
	    			url :"ajax/asignareportes.php",
	    			data: { 
	    				idusuario : $("#idusuario").val(),
	    				fk_idrol  : $("#fk_idrol").val()
	    			},
	    			success : function (data) {
	    				alert(data);
	    			}
	    		});
			}
    	}
    })

	function verUsuarios() {
		$.ajax({
			type:"post",
			url:"ajax/listausuarios.php",
			data: {
				filtro: $("#buscarpor").val(),
			},
			success : function (data) {
				//alert(data);
				datos = data.split(";");
				n = 8;
				canti = (datos.length-1)/n;
				encabezado = "<table class='table gris table-condensed table-bordered table-striped'>";
		 		titulos = "<tr><th></th><th>Usuario</th><th>Nombre</th><th>Clave</th><th>Rol</th><th>Estado</th></tr>";
		 	    cuerpo = "";
		 	    pie = "</table>";
				for(p=0; p<canti; p++) {
					Activo ="<span onclick='cambiarestadousuario(\""+datos[p*n]+"\")' style='color:green;'class='fa fa-2x fa-unlock'></span>";
					Inactivo ="<span onclick='cambiarestadousuario(\""+datos[p*n]+"\")' style='color:red;'class='fa fa-2x fa-lock'></span>";
					if(datos[p*n+7]=="A")  {
						estado = Activo; color=""}
					else {
						estado=Inactivo; color = "style='background-color: #FBF8EC;'"
					}
					cuerpo = cuerpo + "<tr "+color+"><td><span onclick='verusuario(\""+datos[p*n]+"\")' class='fa fa-pencil'></span></td><td>"+datos[p*n]+"</td><td>"+datos[p*n+4]+"</td><td style='text-align: center'><button class='btn btn-xs bt btn-warning' onclick='resetearusu(\""+datos[p*n]+"\")'>Reset</button></td><td>"+datos[p*n+3]+"</td><td style='text-align: center'>"+estado+"</td><tr>";
				}
				tabla = encabezado + titulos + cuerpo + pie;
				$("#divusu").html(tabla);
				
				
			}
		});
	}

	function cambiarestadousuario(iusuario) {
		if(confirm("Seguro de cambiar de estado? ")) {
			$.ajax({
				type:"post",
				url :"ajax/cambiarestadousuario.php",
				data: { usuario : iusuario },
				success : function(data) {
					verUsuarios();
				}
			});
		}
	}

	function verParametros(xusuario="") {
			//filtro = $("input[name='filtropar']:checked").val();
				$.ajax({
					type:"post",
					url :"ajax/listaparametros.php",
					data: { pusuario : xusuario },
					success : function (data) {
						datos = data.split(";");
						canti = 52;
						cuerpo="";
						for(f=0; f<canti; f++) {
							if(datos[f+53]=="A")
								cuerpo += "<tr><td>"+datos[f]+"</td><td><span onclick=permitir('X',"+(f)+") class='fa fa-check-square-o fa-2x'></span></td></tr>";
							else
								cuerpo += "<tr><td>"+datos[f]+"</td><td><span onclick=permitir('A',"+(f)+") class='fa fa-square-o fa-2x'></span></td></tr>";
						}
						encabezado = "<table class='table gris table-condensed table-bordered'>";
						pie="</table>";
						tabla=encabezado+cuerpo+pie;	
						//alert(tabla)
						$("#divpar").html(tabla);
						
					}
				}); // Fin Ajax

	} // Fin VerParametros()

	function asignar(rol,idrp, idpa) {
		$.ajax({
			type:"post",
			url :"ajax/reportesxrol.php",
			data : { 
				rol  : rol,
				idrp : idrp,
				idpa : idpa
			},
			success : function (data) {
				verParametros();
			}
		});
	}

	function permitir(estado,columna) {
		$.ajax({
			type:"post",
			url :"ajax/permitir.php",
			data:{ pusuario: $("#iusuario").val(), 
				   pestado : estado,
				   pcolumna: columna
				 },
			success : function (data) {
				verParametros($("#iusuario").val());
			}
		})
	}

	$("#roles").click(function(){
		//mostrar(0,$("#roles").val());
	});

	$("#buscarahora").click(function(){
		verUsuarios();
	});

	$("#nuevousuario").click(function(){
		$("#iusuario").val("");
		$("#inombre").val("");
		$("#icargo").val("");
		$("#itelefono").val("");
		$("#icorreo").val("");
		$("#estado").val("0");
		$("#irol").val("0");
		$("#iusuario").focus();
	});

	$("#guardarusuario").click(function(){
		if($("#iusuario").val()=="" || $("#inombre").val()=="" || $("#irol").val()=="0" || $("#iestado").val()=="0")
			//alert("FALTAN DATOS\n\nEl usuario, nombres, rol y estado son obligatorios, revise que se encuentren estos datos");
			$("#fd").click();
		else {
			$.ajax({
				type:"post",
				url :"ajax/guardarusuario.php",
				data:{
					iusuario   : $("#iusuario").val(),
					inombre    : $("#inombre").val(),
					icargo 	   : $("#icargo").val(),
					itelefono  : $("#itelefono").val(),
					icorreo    : $("#icorreo").val(),
					irol       : $("#irol").val(),
					iestado    : $("#iestado").val()
				},
				success : function (data) {
					verUsuarios();
					$("#nuevousuario").click();
				}
			});
		}
	});

	function verusuario(idus) {
		$("#idusuario").prop("disabled",true);
		$.ajax({
			type:"post",
			url:"ajax/listausuarios.php",
			data: { filtro : "usuario ='"+idus+"'" },
			success : function (data)  {
				datos = data.split(";");
				$("#iusuario").val(datos[0]);
				$("#inombre").val(datos[4].toUpperCase());
				$("#icargo").val(datos[3].toUpperCase());
				$("#itelefono").val(datos[6]);
				$("#icorreo").val(datos[5].toLowerCase());
				$("#irol").val(datos[2].toUpperCase());
				$("#iestado").val(datos[7]);
				verParametros(idus);
			}
		})	
	}

	function resetearusu(idus)  {
		if(confirm("CONFIRMACION REQUERIDA\n\nEste proceso genera una contraseña numerica aleatoria la cual sera enviada al correo del usuario unicamente\n\nSeguro de resetear contraseña?")) {
				$.ajax({
					type:"post",
					url :"ajax/reseteo.php",
					data : { 
						iusuario : idus
					},
					success : function(data) {
						alert(data);
					}
				})
		}
	}
</script>