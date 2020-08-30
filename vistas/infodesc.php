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
		<div class="col-md-3">
			<font style="font-weight: bold; font-size: 12px; color: #DCA53A"><i class="fa fa-chevron-right"></i> INFORMACION ACADEMICA DEL INFORME</font> <br>
			<label for="">Año</label> 
			<select name="" id="ianno">
				<option value="0">Seleccione...</option>
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
			</select> 
			<br>
			<label for="">Periodo</label>
			<select name="" id="">
				<option value="0">Seleccione...</option>
				<option value="1">Primero</option>
				<option value="2">Segundo</option>
				<option value="3">Tercer</option>
			</select> <br>
			<label for="">Docente</label>
		  	<select name="" id="ddocente">
		  		<option value="-1">Seleccione...</option>
		  		<?php echo ListaUsuarios(); ?>
		  	</select> <br>
			<font style="font-weight: bold; font-size: 12px; color: #DCA53A"><i class="fa fa-chevron-right"></i> CARGA ACADEMICA DOCENTE</font> <br>
			<select name="" size="6" style="width: 400px" id=""></select>

		</div>
		<div class="col-md-4">
			<font style="font-weight: bold; font-size: 12px; color: #DCA53A"><i class="fa fa-chevron-right"></i> ESTUDIANTES</font> <br>
			<table>
				<tr>
					<td>
						<select name="" size="14" style="width: 400px; height: 220px" id=""></select>
					</td>
					<td>
						<img src="fotos/0.gif" id="foto" alt="" width="180" height="220" >
					</td>
				</tr>
			</table>
		</div>
		<div class="col-md-4">
			<font style="font-weight: bold; font-size: 12px; color: #DCA53A"><i class="fa fa-chevron-right"></i> DESCRIPCION</font> <br>
			<textarea name="" id="" style="width: 600px; height: 100px" ></textarea>
		</div>
	</div>
</div>