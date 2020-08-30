<style>
	 #listado {
	    width: 100%;
	    height: 550px;
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
	.panel {
		text-align: center; font-size: 12px; background-color: #A1D0E1; color: black;
	}
	.bex { width: 125px; }
	input[type=date] { color: #EBEBEB; }
</style>
<div class="vistapc" style="margin-top: -30px; color: black; font-size: 14px;">
	<div class="row">
		<div class="col-md-3"></div>
	    <div class="col-md-6">
	  		<br><br><br>
		  	<div class="seccion">
		  		<div class="panel">SOLICITUD DE SOPORTE TECNICO</div>
		  		<table> 
		  			<tr><td style="width: 200px">Nombre de Contacto</td><td>
		  				<input  type="text" class="t1" id="contacto" placeholder="Quien solicita el soporte" name=""></td></tr>
		  			<tr><td>Correo Electronico</td><td><input type="text" id="correo" class="t1" name=""></td></tr>
		  			<tr><td>Telefono(s)</td><td><input type="text" id="telefono">
		  				no puede haber espacios, ni puntos ni guiones
		  			</td></tr>
		  			<tr><td>Mensaje y/o solicitud</td><td>
		  				<textarea style="width: 470px; height: 100px;" id="mensaje"></textarea>
		  			</td></tr>
		  			<tr><td></td><td>
		  				<br>
		  				<button id="enviar" class="btn btn-warning"><span class="fa fa-send"></span> &nbsp;Enviar Soporte</button>
		  			</td></tr>
		  		</table>
		  	</div>
	    </div>
	</div>
</div>

<script type="text/javascript">
	$("#enviar").click(function() {
		$.ajax({
			type:"post",
			url :"ajax/enviosoporte.php",
			data : {
				usuario  : "jpardo",
				contacto : $("#contacto").val(),
				correo   : $("#correo").val(),
				telefono : $("#telefono").val(),
				mensaje  : $("#mensaje").val()
			},
			success : function (data) {
				alert("IMPORTANTE\n\nSu soporte tecnico se radico con exito le sera enviada una notificacion por SMS y correo electronico sea en la bandeja de entrada o correos no deseados (Spam), asi mismo recibira otra como respuesta de su peticion");
				$("#contacto").val("");
				$("#correo").val("");
				$("#telefono").val("");
				$("#mensaje").val("");
				$("#contacto").focus();
			}
		}) 
	})
</script>