<style>	

	table th {
		text-align: center;
		font-size: 12px
	}
	table {
		font-size: 12px;
	}
	h5 {
		font-weight: bold;
		color: #BA8300;
	}
	label {
		font-size: 11px;
		width: 100px;
		text-align: right;
		color: black
	}
		body { color: black }
	#listado {
		margin-top: 40px;
	    margin-right: 50px;
	    overflow-y: scroll;
	    height: 400px;
	    padding: 5px;
	    color: black;
	    padding: 15px;
	    background: #EAEAEA;
	    border-radius: 4px;
	    text-align: center;
	 } 
	 #enca { 
		color: black;
		background-color: #EFEFEF;
		padding: 5px;
		margin-top: -18px;
		margin-left: -38px;
		width: 104%;
	 }
	#listado table tr { height: 30px }
	#listado table tr:hover { background: #FFFFD7 }
     .a20 { width: 20px; }
     .a70 { width: 70px; }   
	 .bot { width: 50px;  }
	button { border-style: none; background-color: #A2CADE }
</style>
<?php
   @session_start();
   $rol = $_SESSION['rol'];
   $visible = "";
   if($rol=="CLIENTE") {
   		$visible=" display:none; ";
   }
?>
<div id="enca" style="margin-top: -20px; width: 110%;<?php echo $visible; ?>">
	<table>
		<tr>
			<td valign="top">
				<form action="vistas/regresararchivo.php" method="post" enctype="multipart/form-data">
					Archivo a importar &nbsp; 
					<input                        id="nomarchivo" name ="nomarchivo" style="width: 340px; height: 28px; margin-top: 8px">
					<input style="display: none;" type="text"    id="rol"      name="xrol" value="<?php echo $rol; ?>">
					<input style="display: none;" name="archivo" id="archivo"   type="file" name="adjunto" >
					<input style="display: none;"  type="text"   id="archivoexp" name="archivoexp">
					<input style="display: none;" type="text"    id="param"  value="2020"name="param">
					<input style="display: none;" type="submit"  id="benviar" value="subir...">
				</form>
			</td>
			<td>
					<button onclick="procesararchivo()" style="margin-top: 0px">
						<spam class="fa fa-2x fa-upload"></spam>&nbsp; Seleccionar Archivo...
					</button>
					<button onclick="actualizar();" style="margin-top: 0px"><spam class="fa fa-2x fa-refresh"></spam>&nbsp; Subir</button>

			</td>
		</tr>
	</table>
</div>
<div id="listado">	
	<table class="table table-bordered table-condensed" style="background: white">
		<tr>
			<th>No.</th><th>Nombre de Archivo</th><th>Descargar</th>
		</tr>
		<?php
			$path="archivos/cliente/";
			$cont = 0;
			$directorio=dir($path);
			while ($archivo = strtoupper($directorio->read())) {
				if($archivo!="." AND $archivo!=".." AND strtolower(substr($archivo, -3) != "PHP")) {
					$cont++;
					echo "<tr><td>$cont</td><td>$archivo</td>";
					$botonsubir = "<td><a download href='archivos/cliente/$archivo' style='color: black' class='bot btn btn-warning'><span class='fa fa-check'></span></a></td>";
					if($rol!="CLIENTE")
						$botoneliminar = "<td><button onclick='eliminaarchivo(\"$archivo\")' class=' btn btn-danger'><span class='fa fa-close'></span> Eliminar</button></td>";					
					else 
						$botoneliminar = "";
					echo "$botonsubir $botoneliminar ";
					echo "</tr>";
				}
				//if (strtolower(substr($archivo, -3) == "xls"))
			
			}
			$directorio->close();
		?>
	</table>
</div>

<script>

	function eliminaarchivo(na) {
		if (confirm("CONFIRMACION REQUERIDA\nSeguro de eliminar "+na+"?")) {
			$.ajax({
				type:"post",
				url :"archivos/eliminar.php",
				data: { archivo : na },
				success : function (data) {
					alert("Arhivo "+na+" eliminado...");
				}
			})
			location.reload();
		}
	}

	$("#archivo").change(function(){
		$("#nomarchivo").val($("#archivo").val());
		$("#archivoexp").val($("#ordenado").val());
	})


	function actualizar() { 
		$("#benviar").click(); 
	}

	function procesararchivo() {
	 $("#archivo").click();
	}

</script>