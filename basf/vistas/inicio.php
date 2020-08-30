<style>
    .olvide:hover { color:red; cursor: pointer; }

</style>
<center style="color: black;">
		<img src="img/logo-hubemar.png" style="width: 150px" alt="" class="logoresponsivo"><br>
    <img src="img/basf.jpg" alt="" class="logoresponsivo">
		<form action="index.php" method="post">
			<input type="text" placeholder="Usuario" name="usuario" id="usuario" autofocus class="rusuario" style="color: black;" required><br>
			<input type="password" placeholder="Contraseña" name="clave" class="rusuario" style="color: black;"  required><br>
		    <label style="font-size: 12px" class='olvide' onclick='resetear()'>Recordar contraseña</label>
		    <div class="form-item">
		        <input type="submit" class="btn btn-inverse" name="conecta" value="Entrar" >
		        <button class="btn btn-primary">Cancelar</button>
		    </div>
		</form>
		<div style="display: <?php echo $error; ?>;">
			<br>
			<span class="label upper default" style="color: black; width: 100%; padding: 10px;">
			<img src="img/advertencia.png" style="width: 40px" alt=""><br>
			<b>Usuario invalido o contrase&ntilde;a incorrecta</b></span>
		</div>
</center>
 
 
<script>
    function resetear() {
        usuario = document.getElementById("usuario").value;
        if(usuario=="") {
            alert("FALTAN DATOS\n\nPor favor escriba el nombre de usuario");
            document.getElementById("usuario").focus();
        }
        else    
            if(confirm("ADVERTENCIA\n\nSe creara una clave aleatoria y sera enviada al correo del usuario\n\nSeguro de realizar esta operacion")) {
                $.ajax({
                   type: "post" ,
                   url : "ajax/reseteo.php",
                   data: { usuario : $("#usuario").val() },
                   success : function (data) {
                       alert(data);
                   }
                });
            }
    }
</script>

