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
	    height: 200px;
	    overflow-y: scroll;
	    margin: 0px;
	    padding: 5px;
	    border-radius: 4px;
	 } 
	#divpar {
	    width: 100%;
	    height: 280px;
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
<div class="vistapc" style="margin-top: -30px; color: black; font-size: 14px;">
	<!-- VISTA PARA COMPUTADOR -->
<div class="contened" style="color: black;">
	<div class="row">
	  <div class="col-md-3">
	  		<div class="seccion">
	  			<div class="panel">INFORMACION BASICA</div>
			<table>
				<tr><td>Usuario</td><td>
					<input id="idusuario" type="text" class="" autofocus>
					<input type="text" id="numero" style="display: none">
					<input id="clave" type="password" style="display: none;" class="t1">
				</td></tr>
				<tr><td>Codigo Logueo</td><td><input id="clogueo" type="text" class="b1"></td></tr>
				<tr><td>Nombre</td><td><input id="nomusuario" type="text" class="t1"></td></tr>
				<tr><td>Id Importador</td><td><input id="informacion" type="text" style="width: 80px">
						<button class="btn btn-sm btn-warning m10" id="buscaimp"><span class="fa fa-search"></span></button>
				</td></tr>
				<tr><td>Telefonos</td><td><input id="telefono" type="text" class="t1"></td></tr>
				<tr><td>Correo Electronico</td><td><input id="correo" type="text" class="t1"></td></tr>
				<tr><td>Tipo</td><td>
					 <select name="" id="tipou">
				  		<option value="0">Seleccione...</option>
				  		<option value="C">C</option>
				  		<option value="E">E</option>
				  	</select>
				</td></tr>
				<tr><td>NIT / identificacion</td><td><input id="numeroid" type="text" class="t1"></td></tr>
				<tr><td>Rol</td><td>&nbsp; 
					 <select name="" id="fk_idrol">
				  		<option value="0">Seleccione...</option>
				  		<option value="ROOT">ROOT</option>
				  		<option value="DIRECTIVO">DIRECTIVO</option>
				  		<option value="OPERATIVO">OPERATIVO</option>
				  		<option value="CLIENTE">CLIENTE</option>
				  	</select>
				  	<select name="" id="estado">
				  		<option value="0">Seleccione...</option>
				  		<option value="A">ACTIVO</option>
				  		<option value="X">BLOQUEDADO</option>
				  	</select>		
				</td></tr>
			</table>
			<br>
			<center>
				<button class="btn btn-warning m10" id="nuevousuario"><span class="glyphicon glyphicon-plus"></span></button>
				<button class="btn btn-primary" id="asignareportesrol"><span class="glyphicon glyphicon-ok"></span> Asignar Reportes</button>
				<button class="btn btn-primary" id="guardarusuario"><span class="glyphicon glyphicon-floppy-disk"></span>Guardar</button>
			</center>
	  </div>
	</div>
  	  <div class="col-md-9">
	  	<div class="seccion">
	  		  	Mostrar
		  	  	<select name="" id="roles">
		  	  			<option value="0">TODOS LOS ROLES...</option>
				  		<option value="ROOT">ROOT</option>
				  		<option value="DIRECTIVO">DIRECTIVO</option>
				  		<option value="OPERATIVO">OPERATIVO</option>
				  		<option value="CLIENTE">CLIENTE</option>
		  	  	</select>
		  	  	Buscar por:
				<input type="text" autofocus id="buscarpor" placeholder="usuario, logueo, nombre (separe con %)" style="width: 280px;">
				<button class="btn btn-primary" id="buscarahora"><span class="glyphicon glyphicon-search"></span>Filtrar Usuarios</button>
			  	<div id="divusu">
			  		<table class='table table-condensed table-bordered table-striped'>
						<tr><th>Usuario</th><th>Logueo</th><th>Nombre</th><th>Clave</th><th>Rol</th><th>Est</th></tr>
			  		</table>
			  	</div><br>
				<div id="divpar"></div>
			  	<hr class="style5">
			  	<font style="font-weight: bold;">
			  	<input type="radio" onchange="verParametros()" onclick="verParametros()" id="rtodos" checked name="filtropar" value="TODOS"> &nbsp;Ver todos &nbsp; &nbsp; &nbsp;
			  	<input type="radio" onchange="verParametros()"  onclick="verParametros()" id="rusuario" name="filtropar" value="USUARIO"> &nbsp;Ver por Usuario &nbsp; &nbsp; &nbsp;
			  	<input type="radio" onchange="verParametros()"  onclick="verParametros()" id="rrol" name="filtropar" value="ROL"> &nbsp;Ver por Rol &nbsp; &nbsp; &nbsp;
			  	<button class="btn btn-primary"><span class="fa fa-refresh"></span>&nbsp; &nbsp;Actualizar</button>
			  	<button class='btn btn-warning' id='aplicaratodos' style='display: none'>Aplicar a Todos los Usuarios</button>

			  	</font>
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
          <span class="fa fa-warning fa-4x" style="color: grey"></span>
          <h4 class="modal-title">Informacion Obligatorio</h4>
       
        </div>
        <div class="modal-body">
          <b>FaltanDatos! </b>	el usuario, nombre, rol y estado son obligatorios, por favor revise
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
	verParametros();
 
	$("#buscaimp").click(function(){
		nombus = prompt("BUSCAR ID IMPORTADOR\n\nEscriba parte del nombre del usuario\nreemplace los espacios por %");
		$.ajax({
			type:"post",
			url:"ajax/buscaimportador.php",
			data: { filtro : nombus },
			success : function (data) {
				alert (data);
			}
		})
	});

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
				rol: $("#roles").val()
			},
			success : function (data) {
				datos = data.split("|");
				n = 12;
				canti = (datos.length-1)/n;
				encabezado = "<table class='table gris table-condensed table-bordered table-striped'>";
		 		titulos = "<tr><th></th><th>Usuario</th><th>Logueo</th><th>Nombre</th><th>Clave</th><th>Rol</th><th>Est</th></tr>";
		 	    cuerpo = "";
		 	    pie = "</table>";
				for(p=0; p<canti; p++) {
					Activo ="<span onclick='cambiarestadousuario("+datos[p*n+9]+")' style='color:green;'class='fa fa-2x fa-unlock'></span>";
					Inactivo ="<span onclick='cambiarestadousuario("+datos[p*n+9]+")' style='color:red;'class='fa fa-2x fa-lock'></span>";
					if(datos[p*n+7]=="A")  {
						estado = Activo; color=""}
					else {
						estado=Inactivo; color = "style='background-color: #FBF8EC;'"
					}
					cuerpo = cuerpo + "<tr "+color+"><td><button class='btn btn-xs bt btn-warning' onclick='verusuario("+datos[p*n+9]+")'>Ver</button></td><td>"+datos[p*n]+"</td><td>"+datos[p*n+8]+"</td><td>"+datos[p*n+5].toUpperCase()+"</td><td><button class='btn btn-xs bt btn-warning' onclick='resetearusu(\""+datos[p*n+11]+"\",\""+datos[p*n]+"\")'>Reset</button></td><td>"+datos[p*n+1]+"</td><td>"+estado+"</td><tr>";
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
				url :"ajax/cambiaestadousuario.php",
				data: { usuario : iusuario },
				success : function(data) {
					verUsuarios();
				}
			});
		}
	}

	function verParametros(xrol=0, xusuario="") {
			filtro = $("input[name='filtropar']:checked").val();
				$.ajax({
					type:"post",
					url :"ajax/listaparametros.php",
					data: {
						usuario : $("#idusuario").val(),
						rol     : "0",
						verxrol : $("input[name='filtropar']:checked").val()
					},
					success : function (data) {
						datos = data.split("|");
						n = datos[0];
						canti = (datos.length-2)/n;
						encabezado = "<table class='table gris table-condensed table-bordered'>";

						filtro = $("input[name='filtropar']:checked").val();
						switch(filtro) {
							case "TODOS":
							 		titulos = "<tr><th>Id</th><th>Descripcion General de Reportes</th><th>Estado</th></tr>";
							 	    cuerpo = "";
							 	    pie = "</table>";
									for(p=0; p<canti; p++) {
										Activo ="<span onclick='cambiaestadoparametro("+datos[p*n+1]+")' style='color:green;'class='fa fa-2x fa-unlock'></span>";
										Inactivo ="<span  onclick='cambiaestadoparametro("+datos[p*n+1]+")' style='color:red;'class='fa fa-2x fa-lock'></span>";
										centra = " style='text-align: center;'";
										if(datos[p*n+5]=="A")  {
											estado = Activo; color=""}
										else {
											estado=Inactivo; color = "style='background-color: #FBF8EC;'"
										}										
										cuerpo = cuerpo + "<tr "+color+"><td>"+datos[p*n+1]+"</td><td>"+datos[p*n+2].toUpperCase()+"</td><td style='text-align: center;'>"+estado+"</td></tr>";
										
									}
									tabla = encabezado + titulos + cuerpo + pie;
									$("#divpar").html(tabla);
									$("#aplicaratodos").css("display","none");
								break;
							case "USUARIO":
							 		titulos = "<tr><th>Id</th><th>Descripcion de Reportes por Usuario</th><th>Estado</th><th>Permitir</th></tr>";
							 	    cuerpo = "";
							 	    pie = "</table>";
									for(p=0; p<canti; p++) {
										Activo ="<span  onclick='cambiaestadoparametro("+datos[p*n+1]+")' style='color:green;'class='fa fa-2x fa-unlock'></span>";
										Inactivo ="<span  onclick='cambiaestadoparametro("+datos[p*n+1]+")' style='color:red;'class='fa fa-2x fa-lock'></span>";
										centra = " style='text-align: center;'";
										if(datos[p*n+5]=="A")  {
											estado = Activo; color=""}
										else {
											estado=Inactivo; color = "style='background-color: #FBF8EC;'"
										}

										if(datos[p*n+7]=="X") 
											marcado = "<span onclick=permitir('"+$("#idusuario").val()+"','"+datos[p*n+1]+"') class='fa fa-check-square-o fa-2x'></span>";
										else
											marcado = "<span onclick=permitir('"+$("#idusuario").val()+"','"+datos[p*n+1]+"') class='fa fa-square-o fa-2x'></span>";
										
										
										cuerpo = cuerpo + "<tr "+color+"><td>"+datos[p*n+1]+"</td><td>"+datos[p*n+2].toUpperCase()+"</td><td style='text-align: center;'>"+estado+"</td><td style='text-align: center;'>"+marcado+"</td></tr>";
										
									}
									tabla = encabezado + titulos + cuerpo + pie;
									$("#divpar").html(tabla);
									$("#aplicaratodos").css("display","none");
								break;
							case "ROL":
					 				titulos = "<tr><th style='width: 40px'>Id</th><th>Asignacion de Reportes por Rol</th><th class='t30'>Est</th><th class='t30'>Root</th><th class='t30'>Directivo</th><th class='t30'>Operativo</th><th class='t30'>Cliente</th></tr>";
							 	    cuerpo = "";
							 	    pie = "</table>";
									for(p=0; p<canti; p++) {
										Activo ="<span  onclick='cambiaestadoparametro("+datos[p*n+1]+")' style='color:green;'class='fa fa-2x fa-unlock'></span>";
										Inactivo ="<span  onclick='cambiaestadoparametro("+datos[p*n+1]+")' style='color:red;'class='fa fa-2x fa-lock'></span>";
										centra = " style='text-align: center;'";
										if(datos[p*n+5]=="A")  {
											estado = Activo; color=""}
										else {
											estado=Inactivo; color = "style='background-color: #FBF8EC;'"
										}
										
										if(datos[p*n+6]!="0") m1 = "<span onclick=asignar('ROOT',"+datos[p*n+6]+","+datos[p*n+1]+") class='fa fa-check-square-o fa-2x'></span>";
										else  				  m1 = "<span onclick=asignar('ROOT',"+datos[p*n+6]+","+datos[p*n+1]+") class='fa fa-square-o fa-2x'></span>";

										if(datos[p*n+7]!="0") m2 = "<span onclick=asignar('DIRECTIVO',"+datos[p*n+7]+","+datos[p*n+1]+") class='fa fa-check-square-o fa-2x'></span>";
										else  				  m2 = "<span onclick=asignar('DIRECTIVO',"+datos[p*n+7]+","+datos[p*n+1]+") class='fa fa-square-o fa-2x'></span>";

										if(datos[p*n+8]!="0") m3 = "<span onclick=asignar('OPERATIVO',"+datos[p*n+8]+","+datos[p*n+1]+") class='fa fa-check-square-o fa-2x'></span>";
										else  				  m3 = "<span onclick=asignar('OPERATIVO',"+datos[p*n+8]+","+datos[p*n+1]+") class='fa fa-square-o fa-2x'></span>";

										if(datos[p*n+9]!="0") m4 = "<span onclick=asignar('CLIENTE',"+datos[p*n+9]+","+datos[p*n+1]+") class='fa fa-check-square-o fa-2x'></span>";
										else  				  m4 = "<span onclick=asignar('CLIENTE',"+datos[p*n+9]+","+datos[p*n+1]+") class='fa fa-square-o fa-2x'></span>";

										
										cuerpo = cuerpo + "<tr "+color+"><td>"+datos[p*n+1]+"</td><td>"+datos[p*n+2].toUpperCase()+"</td><td style='text-align: center;'>"+estado+"</td><td style='text-align: center;'>"+m1+"</td><td style='text-align: center;'>"+m2+"</td><td style='text-align: center;'>"+m3+"</td><td style='text-align: center;'>"+m4+"</td></tr>";
										
									}
									tabla = encabezado + titulos + cuerpo + pie;
									$("#divpar").html(tabla);
									$("#aplicaratodos").css("display","");
								break;
						}

						
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

	function cambiaestadoparametro(npar) {
		if(confirm("Seguro de cambiar de estado\nal reporte No. "+npar+"? ")) {
			$.ajax({
				type:"post",
				url :"ajax/cambiaestadoparametro.php",
				data: { numero : npar },
				success : function(data) {
					verParametros();
				}
			});
		}
	}
	function permitir(usu, rep) {
		$.ajax({
			type:"post",
			url :"ajax/permitir.php",
			data:{ xusu: usu, xrep: rep },
			success : function (data) {
				//alert(data);
				verParametros();
			}
		})
		//alert(usu+ " "+rep)
	}

	$("#roles").click(function(){
		//mostrar(0,$("#roles").val());
	});

	$("#buscarahora").click(function(){
		verUsuarios();
	});

	$("#nuevousuario").click(function(){
		$("#idusuario").val("");
		$("#clave").val("");
		$("#nomusuario").val("");
		$("#clogueo").val("");
		$("#telefono").val("");
		$("#correo").val("");
		$("#informacion").val("");
		$("#estado").val("0");
		$("#fk_idrol").val("0");
		$("#tipou").val("0");
		$("#idusuario").prop("disabled",false);
		$("#idusuario").focus();
	});

	$("#guardarusuario").click(function(){
		if($("#tipou").val()=="" || $("#idusuario").val()=="" || $("#nomusuario").val()=="" || $("#fk_idrol").val()=="0" || $("#estado").val()=="0")
			//alert("FALTAN DATOS\n\nEl usuario, nombres, rol y estado son obligatorios, revise que se encuentren estos datos");
			$("#fd").click();
		else {
			$.ajax({
				type:"post",
				url :"ajax/guardarusuarios.php",
				data:{
					idusuario   : $("#idusuario").val(),
					clave       : $("#clave").val(),
					clogueo 	: $("#clogueo").val(),
					nomusuario  : $("#nomusuario").val(),
					informacion : $("#informacion").val(),
					telefono    : $("#telefono").val(),
					correo      : $("#correo").val(),
					tipou       : $("#tipou").val(),
					numeroid	: $("#numeroid").val(),
					fk_idrol    : $("#fk_idrol").val(),
					estado      : $("#estado").val()
				},
				success : function (data) {
					alert(data);
					$("#buscarahora").click();
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
			data: { usuario : idus},
			success : function (data)  {
				datos = data.split("|");
				$("#idusuario").val(datos[0]);
				$("#clave").val(datos[2]);
				$("#clogueo").val(datos[8]);
				$("#nomusuario").val(datos[5].toUpperCase());
				$("#informacion").val(datos[6]);
				$("#telefono").val(datos[10]);
				$("#correo").val(datos[11].toLowerCase());
				$("#tipou").val(datos[3]);
				$("#numeroid").val(datos[4]);
				$("#fk_idrol").val(datos[1]);
				$("#estado").val(datos[7]);
				verParametros();
			}
		})	
	}

	function resetearusu(pcorreo, pnomusu)  {
		nueva = prompt("AVISO IMPORTANTE\n\nDigite la nueva contraseña para el usuario, se le enviara un correo a la direccion "+pcorreo+" como notificacion de esta accion\n\nNueva contraseña.",pnomusu)
		if(nueva!=null) {
			$.ajax({
				type:"post",
				url :"ajax/reseteo.php",
				data: {
					usuario: pnomusu,
					correo:  pcorreo
				}, 
				success : function(data) {
					alert(data)
				}
			})
		}

	}
</script>