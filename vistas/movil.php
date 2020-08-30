<style type="text/css">
	
  #consulta {
    width: 103%;
    height: 550px;
    overflow-y: scroll;
    margin: 0px;
    padding: 5px;
    color: black;
  } 

  #detalle {
        height: 550px;
        background-color: #E9F9FF;
        overflow-y: scroll;
  }
  #consulta table tr:hover { background: #003399; color: white;  }
  #consulta table tr td button:hover { background: #FEF4CD;  }
  #consulta table tr td { font-size: 13px; }
  #detalle table tr td { font-size: 13px; }
  td { padding: 1px; }
  .seccion { 
    padding: 10px;
    background-color: #D3EBF5;
  }
  .panel {
    text-align: center; font-size: 12px; background-color: #A1D0E1; color: black;
  }
  .bex { width: 125px; }
  
 button { color: black }
</style>

<div class="vistapc" style="margin-top: -30px; color: black; font-size: 14px;">
  <!-- VISTA PARA COMPUTADOR -->

  <div class="row">
      <table >

          <tr>
            <td>Importador</td>
            <td>

              <select id="importador" style="width: 250px;" <?php if($_SESSION['rol']=="CLIENTE") echo "disabled"; ?>>
                <?php 
                  if($_SESSION['rol']!="CLIENTE") { 
                    echo "<option value='-1'>Seleccione...</option>";
                    echo "<option value='0' selected>TODOS</option>";
                    echo listaimportadoresrem(); 
                  }
                  else {
                    echo "<option value='".$_SESSION['idimportador']."'>".$_SESSION['nomusuario']."</option>";
                  }
                ?>
              </select>
              <button class="btn btn-warning" type="button" id="btbuscarimp" data-toggle="modal" data-target="#buscaimp" <?php if($_SESSION['rol']=="CLIENTE") echo "style='display:none'"; ?>><span class="fa fa-search"></span> </button>
          </td>




          <td><input placeholder="Numero DO"  style="width: 100px" type="text" id="numdo" name="" autofocus></td>
          <td><input placeholder="No. Pedido" style="width: 100px" type="text" id="numpedido" name=""></td>
          <td style="width: 30px;"></td>
          <td> Apertura&nbsp;&nbsp;</td>
          <td bgcolor="#A1D0E1" style="padding: 5px; border-radius:5px ">
          <input type="date" id="inicial" name="">  
          <input type="date" id="final" name="">
          </td>
          <td>&nbsp;&nbsp;&nbsp;&nbsp; Regimen</td><td>
            <select id="regimen">
              <option value="TODOS">TODOS</option>
              <option value="I">IMPORTACION</option>
              <option value="E">EXPORTACION</option>
              <option value="T">TRANSITO</option>
              <option value="O">OTROS</option>
            </select>
            &nbsp; &nbsp;&nbsp;&nbsp;
            Estado DO&nbsp;&nbsp;<select id="estado">
              <option value="TODOS">TODOS</option>
              <option value="S">ACTIVO</option>
              <option value="N">CERRADO</option>
            </select>
          </td>
          <td> &nbsp; &nbsp; &nbsp;
            <button type="button" id="btbuscarrep" onclick="verestados()" class="btn btn-warning" data-toggle="modal" data-target="#buscarep">
              <span class="fa fa-refresh"></span> Buscar Ahora
            </button>
          </td></tr>
      </table>
  </div>
  </div>
  <br>
    <div class="row">
      <div class="col-md-6">
        <div class="seccion">
            <div id="consulta"  class="seccion"></div> 
        </div>
      </div> 
      <div class="col-md-6  ">
        <div class="seccion" style="color:black">
            <div id="detalle"></div>
        </div>
      </div> 
    </div>
    <br>
</div>

  <!-- .......................... BUSCAR IMPORTADOR ............................... -->
  <div class="modal fade" id="buscaimp" role="dialog" style="margin-top: 200px; color: black">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Busca Importador</h4>
        </div>
        <div class="modal-body">
          <input type="text" id="textoabuscarimp" autofocus style="width: 100%" placeholder="Escriba descripcion..."> 
        </div>        
        <center>
          <button type="button" id="seleccionaimp" class="btn btn-primary" data-dismiss="modal"><span class="fa fa-check"></span>Buscar</button>
          <button style="display: none" type="button" id="esperacerrarimp" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
          <script>

            $("#seleccionaimp").click(function(){
              texto = $("#textoabuscarimp").val().toUpperCase();
              $("#importador option:contains('')").css("display","none");
              $("#importador option:contains('"+texto+"')").css("display","");
              $("#importador option[value=-1]").css("display",""); 
              $("#importador").val(-1);

            });
          </script>
        </center><br>
      </div>
      
    </div>
  </div>


  <button style="display: none;" type="button" class="btn btn-success bex" data-toggle="modal" id="besperar" data-target="#espere">Boton</button>
  <div class="modal fade" id="espere" role="dialog" style="margin-top: 200px; color:black">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body">
          <br>
          <p style="text-align: center;"><i class="fa fa-spinner fa-spin fa-lg" style="font-size:50px"></i><br><br>Espere un momento por favor<br>mientras se carga la consuta</p>
        </div>        
        <center><button type="button" id="esperacerrar" class="btn btn-warning" data-dismiss="modal">Cancelar</button></center><br>
      </div>
      
    </div>
  </div>


<script type="text/javascript">


	  function verestados() {
      $("#besperar").click();
      $.ajax({
        type:"post",
        url :"json/infoestado.php",
        data: { 
            tipo:1, 
            formato    :"TABLA" ,
            regimen    : $("#regimen").val(),
            numdo      : $("#numdo").val(),
            importador : $("#importador").val(),
            pedido     : $("#numpedido").val(),
            inicial    : $("#inicial").val(),
            final      : $("#final").val(),
            estado     : $("#estado").val()
        }, // JSON  CSV  TABLA
        success : function(data) {
          encabezado = "<table class='table-bordered'><tr><th></th><th>Numero DO</th><th style='width: 300px'>Pedido</th><th style='width: 200px'>Fecha Apertura</th><th>Regimen</th></tr>";
          $("#consulta").html(encabezado+data+"</table>");
          $("#esperacerrar").click();
        }
      })
    }

    function verDO(num, regi) {
      $.ajax({
          type:"post",
          url : "json/infoestado.php",
          data: { 
                tipo:2,
                formato:"VISTA", // VISTA JSON
                numdo : num
              },
          success : function (data) {
              $("#detalle").html(data)
              $("#numdo").val(num);
          }
      })
    }
</script>