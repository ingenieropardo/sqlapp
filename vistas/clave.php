<style>
	input[type="password"] { text-align: center; }
</style>

<div class="vistamv" style="color: black; margin-left: -10px">
	<center>
		<img src="img/pwd.png" alt=""><br>
		Contraseña Actual<br>
		<input type="password" id="m_anterior" autofocus><br>
		Nueva Contraseña<br>
		<input type="password" id="m_nueva"><br>
		Repitala<br>
		<input type="password" id="m_repite"><br><br>
		<button class="btn btn-primary" onclick="cambiar(1)">Cambiar Ahora</button>
	</center>
</div>

<div class="vistapc" style="color: black">
	<div class="container" style="color: black">
		<center>
			<img src="img/pwd.png" alt=""><br>
			Contraseña Actual<br>
			<input type="password" id="anterior" autofocus><br>
			Nueva Contraseña<br>
			<input type="password" id="nueva"><br>
			Repitala<br>
			<input type="password" id="repite"><br><br>
			<button class="btn btn-primary" onclick="cambiar(0)">Cambiar Ahora</button>
		</center>
	</div>
</div>


  <!-- ..........................NO COINCIDEN ............................... -->
  <button style="display: none;" type="button" id="ec" class="btn btn-success bex" data-toggle="modal" data-target="#errorpwd">Boton</button>
  <div class="modal fade" id="errorpwd" role="dialog" style="margin-top: 100px; color: black">
    <div class="modal-dialog">
      <div class="modal-content">
      	<center>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <span class="fa fa-warning fa-4x" style="color: grey"></span>
          <h4 class="modal-title">Error en contraseña nueva</h4>
        </div>
        <div class="modal-body">
          <b>Error! </b> no coinciden las contraseñas, intentelo de nuevo
        </div>   
        <div class="modal-footer">
          	<button type="button" id="seleccionarep" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        	<button style="display: none" type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        </div>     
        </center>
      </div>
      
    </div>
  </div>

  <!-- .......................... FALTAN DATOS ............................... -->
  <button style="display: none;" type="button" id="fd" class="btn btn-success bex" data-toggle="modal" data-target="#faltndatos">Boton</button>
  <div class="modal fade" id="faltndatos" role="dialog" style="margin-top: 80px; color: black">
    <div class="modal-dialog">
      <div class="modal-content">
      	<center>
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <span class="fa fa-warning fa-4x" style="color: grey"></span>
          <h4 class="modal-title">Informacion Obligatoria</h4>
       
        </div>
        <div class="modal-body">
          <b>FaltanDatos! </b>	Todos los campos son obligatorios
        </div>   
        <div class="modal-footer">
          	<button type="button" id="seleccionarep" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        	<button style="display: none" type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        </div>     
        </center>
      </div>
      
    </div>
  </div>
<script>

	function datosPCaMV () { 
		$("#anterior").val($("#m_anterior").val());
		$("#nueva").val($("#m_nueva").val());
		$("#repite").val($("#m_repite").val());
	}

	function cambiar(vista=0){
        if(vista==1) datosPCaMV();
		anterior = $("#anterior").val();
		nueva    = $("#nueva").val();
		repite   = $("#repite").val();

		if($("#anterior").val()=="" || $("#nueva").val()=="" || $("#repite").val()=="")
			$("#fd").click();
		else 
			if(nueva != repite ) {
				$("#ec").click();
			} else {
				if(confirm("CONFIRMACION\n\nCambiar contraseña ahora?")) {
					$.ajax({
						type:"post",
						url :"ajax/cambiarpwd.php",
						data: {
							usuario : "<?php echo $_SESSION['ideusuario']; ?>",
							actual  : $("#anterior").val(),
							nueva   : $("#nueva").val()
						},
						success : function(data) {
							alert("Si los datos fueron correctos, puede hacer uso de su nueva clave");
						}
					});
				}
			}
	}
</script>